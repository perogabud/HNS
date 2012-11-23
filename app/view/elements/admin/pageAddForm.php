<form id="pageAdd" method="post" enctype="multipart/form-data" action="">
  <fieldset>
    <legend>New Page</legend>
    <?php TableHelper::globalMessages (); ?>
    <ul class="actions">
      <li><a href="<?php echo Config::read('siteUrlRoot') ?>admin/page"><?php TableHelper::icon ('arrowLeft'); ?> Back to Pages</a></li>
    </ul>
    <?php
    FormHelper::input (Config::read ('debug') ? 'checkbox' : 'hidden', 'isException', 'isException', array ('label' => array ('text' => 'Exception  [DEBUG]')));
    FormHelper::input (Config::read ('debug') ? 'checkbox' : 'hidden', 'isVisible', 'isVisible', array ('label' => array ('text' => 'Visible  [DEBUG]')));
    FormHelper::input (Config::read ('debug') ? 'checkbox' : 'hidden', 'isEditable', 'isEditable', array ('label' => array ('text' => 'Editable  [DEBUG]')));
    FormHelper::input (Config::read ('debug') ? 'checkbox' : 'hidden', 'isPublished', 'isPublished', array ('label' => array ('text' => 'Objavljeno  [DEBUG]')));
    FormHelper::input (Config::read ('debug') ? 'checkbox' : 'hidden', 'canAddChildren', 'canAddChildren', array ('label' => array ('text' => 'Can Add Children  [DEBUG]')));
    FormHelper::input (Config::read ('debug') ? 'checkbox' : 'hidden', 'canBeDeleted', 'canBeDeleted', array ('label' => array ('text' => 'Can Be Deleted  [DEBUG]')));
    FormHelper::input (Config::read ('debug') ? 'text' : 'hidden', 'class', 'class', array ('label' => array ('text' => 'Class  [DEBUG]')));
    FormHelper::input (Config::read ('debug') ? 'text' : 'hidden', 'sessid', 'sessid', array ('label' => array ('text' => 'PHP SESSION'), 'value' => session_id ()));
    FormHelper::input ('file', 'coverImage[]', 'coverImage', array ('label' => array ('text' => 'Cover Image '), 'info' => 'The image will be resized and cropped to the following dimensions: <strong>719px width</strong> and <strong>429px height</strong>.<br/>These are also minimum dimensions.'));
    FormHelper::multipleSelect ('customModuleId', 'customModuleId', array (), array ('class' => 'hidden'));
    echo '<div class="tabs">';
    $this->getElement ('admin/languageTabs');
    foreach (Config::read ('supportedLangs') as $lang) {
      echo '<div id="tabs-'.$lang.'">';
      echo '<h3 class="langContent">Data in '. Config::read ("langNamesEnglish", $lang) .' Jezik</h3>';
      FormHelper::input ('textarea', 'title', 'title', array ('label' => array ('text' => 'Naslov * '), 'lang' => $lang, 'class' => 'simpleEditor'));
      FormHelper::input ('textarea', 'navigationName', 'navigationName', array ('label' => array ('text' => 'Navigation Name * '), 'lang' => $lang, 'class' => 'simpleEditor'));
      FormHelper::input ('textarea', 'navigationDescription', 'navigationDescription', array ('label' => array ('text' => 'Navigation Description  '), 'lang' => $lang, 'class' => 'simpleEditor'));
      FormHelper::input ('textarea', 'lead', 'lead', array ('label' => array ('text' => 'Uvodni tekst  '), 'lang' => $lang, 'class' => 'editor'));
      FormHelper::input ('textarea', 'content', 'content', array ('label' => array ('text' => 'Content  '), 'lang' => $lang, 'class' => 'editor'));
      ?>

    <a class="addContentModule" data-field="content" href="#">Dodaj modul</a>
    <ul class="contentModules">
    </ul>
    <script type="text/javascript">
      $().ready (function () {

        $('a.addContentModule').click (function () {

          var menuHtml = '<div id="contentModuleMenu"><div class="wrapper"><ul><li class="moduleItem small"><a class="newItem" href="#">Dodaj tekst/sliku</a></li></ul></div><a id="contentModuleMenuSave" href="#">Spremi</a><a id="contentModuleMenuCancel" href="#">Odustani</a></div>',
            newItemHtml = '<li class="moduleItem small"><select class="size"><option value="1">Usko</option><option value="2">Široko</option></select><a class="addText">Dodaj tekst</a><a class="addImage">Dodaj sliku</a> <a class="remove">Obriši</a><a class="moveUp">Gore</a><a class="moveDown">Dolje</a></li>',
            $menu = $(menuHtml),
            $wrapper = $menu.find ('div.wrapper'),
            $moduleList = $(this).next('ul.contentModules'),
            moduleId;

            // Create module and get moduleId
          $.ajax ({
            type: 'GET',
            url: "/admin/ajax/customModule/add",
            //data: {pageId},
            dataType: 'json',
            beforeSend: function (jqXHR, settings) {
              //showLoader ($institutionProfiles.siblings ('label'));
            },
            success: function (data, textStatus, jqXHR) {
              if (data && data.moduleId) {
                moduleId = data.moduleId;
              }
            },
            error: function (jqXHR, textStatus, errorThrown) {
              console.log ('Error: ', textStatus, errorThrown);
            },
            complete: function (jqXHR, textStatus) {}
          });

          $wrapper.mCustomScrollbar ({
            set_height: '100%'
          });

          $menu.find ('a.newItem').click (function (e) {
            var $newItem = $(newItemHtml);
            // Select behavior
            $newItem.find ('select').change (function () {
              var $sibling = $(this).siblings ('img');
              if ($(this).val () == '1') {
                $(this).parents ('li.moduleItem').addClass ('small');
                $sibling.attr ('src', $sibling.attr ('data-small'));
              }
              else {
                $(this).parents ('li.moduleItem').removeClass ('small');
                $sibling.attr ('src', $sibling.attr ('data-wide'));
              }
            });
            // Add image behavior
            $newItem.find ('a.addImage').click (function () {
              var inputId = 'upload'+ parseInt (Math.random() * (1000 - 1) + 1);
              $newItem.find ('a.addImage, a.addText').remove ();
              $newItem.attr ('data-type', 'image');
              $newItem.append ('<input type="file" name="image[]" id="'+ inputId +'" class="newImage" />');
              $newItem.find ('input#' + inputId).uploadify ({
                'uploader'        : '/js/uploadify/uploadify.swf',
                'script'          : '/admin/ajax/customModule/uploadImage/' + moduleId,
                'scriptData'      : {
                  'SESSION_ID' : $('input#sessid').val ()
                },
                'cancelImg'       : '/js/uploadify/cancel.png',
                'auto'            : true,
                'fileDataName'    : 'image[]',
                'fileExt'         : '*.jpg',
                'fileDesc'        : 'JPEG Image Files',
                'multi'           : false,
                'removeCompleted' : true,
                'onComplete'      : function (event, ID, fileObj, response, data) {
                  $newItem.find ('img').remove ();
                  response = $.parseJSON (response);
                  console.log ('completed', response, data);
                  $newItem.data ('itemId', response.itemId);
                  var $img = $('<img src="'+ response.imageUrl.small +'" data-wide="'+ response.imageUrl.wide +'" data-small="'+ response.imageUrl.small +'" alt=""/>');
                  $newItem.append ($img);
                },
                'onOpen'          : function (event, ID, fileObj) {
                  console.log ('OnOpen', ID, fileObj);
                },
                'onError'         : function (event, ID, fileObj, errorObj) {
                  console.log ('Error', event, Id, fileObj, errorObj);
                }
              });
            });
            // Add text behavior
            $newItem.find ('a.addText').click (function () {
              $newItem.attr ('data-type', 'text');
              $newItem.find ('a.addImage, a.addText').remove ();
              $newItem.append ('<?php echo str_replace ("\n", "", FormHelper::input ('textarea', 'content', NULL, array ('label' => array ('text' => 'Sadržaj'), 'class' => 'content'), TRUE)); ?>');
              $newItem.append ('<?php echo str_replace ("\n", "", FormHelper::input ('textarea', 'footnote', NULL, array ('label' => array ('text' => 'Fusnota'), 'class' => 'footnote'), TRUE)); ?>');
            });
            // Remove behaviour
            $newItem.find ('a.remove').click (function () {
              $newItem.remove ();
            });
            // Move up
            $newItem.find ('a.moveUp').click (function () {
              if ($newItem.prev ()) {
                $newItem.insertBefore ($newItem.prev ());
              }
            });
            // Move down
            $newItem.find ('a.moveDown').click (function () {
              if ($newItem.next ()) {
                $newItem.insertAfter ($newItem.next ());
              }
            });

            $(this).parents ('li').before ($newItem);
            $wrapper.mCustomScrollbar ('update');
            return false;
          });

          $('body').append ($menu);

          $('a#contentModuleMenuSave').click (function () {
            $('li.moduleItem').each (function () {
              var $this = $(this),
                  index = $this.index (),
                  itemId = $this.data ('itemId'),
                  size = $this.find ('select.size').val ();
              switch ($this.attr ('data-type')) {
                case 'image':
                  $.ajax ({
                    type: 'POST',
                    url: "/admin/ajax/customModule/updateImage/" + itemId,
                    data: {
                      position : index + 1,
                      size: size
                    },
                    dataType: 'json',
                    beforeSend: function (jqXHR, settings) {
                      //showLoader ($institutionProfiles.siblings ('label'));
                    },
                    success: function (data, textStatus, jqXHR) {
                      if (data && data.moduleId) {
                        moduleId = data.moduleId;
                      }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                      console.log ('Error: ', textStatus, errorThrown);
                    },
                    complete: function (jqXHR, textStatus) {}
                  });
                  break;
                case 'text':
                  $.ajax ({
                    type: 'POST',
                    url: "/admin/ajax/customModule/uploadText/" + moduleId,
                    data: {
                      content : $this.find ('textarea.content').val (),
                      footnote : $this.find ('textarea.footnote').val (),
                      position : index + 1,
                      size : size
                    },
                    dataType: 'json',
                    beforeSend: function (jqXHR, settings) {
                      //showLoader ($institutionProfiles.siblings ('label'));
                    },
                    success: function (data, textStatus, jqXHR) {
                      if (data && data.moduleId) {
                        moduleId = data.moduleId;
                      }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                      console.log ('Error: ', textStatus, errorThrown);
                    },
                    complete: function (jqXHR, textStatus) {}
                  });
                  break;
              }
            });
            // Place HTML for module
            $.ajax ({
              type: 'GET',
              url: "/admin/ajax/customModule/" + moduleId,
              dataType: 'html',
              beforeSend: function (jqXHR, settings) {
                //showLoader ($institutionProfiles.siblings ('label'));
              },
              success: function (data, textStatus, jqXHR) {
                if (data) {
                  $moduleList.prepend (data);
                }
                $('#customModuleId').append ('<option selected="selected" value="'+moduleId+'"></option>');
                $menu.fadeOut (200, function () { $menu.remove (); });
              },
              error: function (jqXHR, textStatus, errorThrown) {
                console.log ('Error: ', textStatus, errorThrown);
              },
              complete: function (jqXHR, textStatus) {}
            });
            return false;
          });

          $('a#contentModuleMenuCancel').click (function () {
            $.ajax ({
              type: 'GET',
              url: "/admin/ajax/customModule/delete/" + moduleId,
              data: {
                content : $this.find ('textarea.content').val (),
                footnote : $this.find ('textarea.footnote').val (),
                position : index + 1,
                size : size
              },
              dataType: 'json',
              beforeSend: function (jqXHR, settings) {
                //showLoader ($institutionProfiles.siblings ('label'));
              },
              success: function (data, textStatus, jqXHR) {
                $menu.remove ();
              },
              error: function (jqXHR, textStatus, errorThrown) {
                console.log ('Error: ', textStatus, errorThrown);
              },
              complete: function (jqXHR, textStatus) {}
            });
            return false;
          });

          // Stvori modul - AJAX
          // Uhvati moduleId
          // Prikaži izbornik za odabir (slika/tekst)
          // Ako slika, prikaži uploadify i odaberi veličinu
          // Ako tekst, prikaži textaree i odabir veličine
          // Spremi item
          // Prikaži izbornik ponovo

          return false;
        });

      });
    </script>

      <?php
      FormHelper::input ('text', 'metaTitle', 'metaTitle', array ('label' => array ('text' => 'Meta Naslov  '), 'lang' => $lang));
    FormHelper::input ('textarea', 'metaDescription', 'metaDescription', array ('label' => array ('text' => 'Meta Description  ')));
      FormHelper::input ('text', 'metaKeywords', 'metaKeywords', array ('label' => array ('text' => 'Meta Keywords  '), 'lang' => $lang));
      echo '</div>';
    }
    echo '</div>';
    ?>
    <p class="info">Polja označena sa zvijezdicom (*) moraju biti ispunjena.</p>
    <?php FormHelper::input ('submit', 'submit', 'submit', array ('value' => 'Spremi')); ?>
    </fieldset>
</form>