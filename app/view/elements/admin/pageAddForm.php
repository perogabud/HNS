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
    FormHelper::multipleSelect ('customModuleId', 'customModuleId', array (), array ('class' => 'hidden', 'label' => array()));
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

    <a class="addContentModule buttonTeal" data-field="content" href="javascript:void(0)">Dodaj modul</a>
    <ul class="contentModules">
    </ul>
    <script type="text/javascript">
      $().ready (function () {

        $('a.addContentModule').click (function () {

          var menuHtml = '<div id="contentModuleMenu"><div class="wrapper"><ul><li class="moduleItem small"><a class="newItem" href="#">Dodaj tekst/sliku</a></li></ul></div><a id="contentModuleMenuSave" href="javascript:void(0)">Spremi</a><a id="contentModuleMenuCancel" href="javascript:void(0)">Izbriši modul</a></div>',
            newItemHtml = '<li class="moduleItem small"><select class="size"><option value="1">Usko</option><option value="2">Široko</option></select><a class="addText">Dodaj tekst</a><a class="addImage">Dodaj sliku</a> <a class="remove">Obriši</a><a class="moveUp">Gore</a><a class="moveDown">Dolje</a></li>',
            $menu = $(menuHtml);

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
                $('#contentModuleMenu a.newItem').attr('data-module-id', data.moduleId);
                $('#contentModuleMenuCancel').attr('data-module-id', data.moduleId);
              }
            },
            error: function (jqXHR, textStatus, errorThrown) {
              console.log ('Error: ', textStatus, errorThrown);
            },
            complete: function (jqXHR, textStatus) {}
          });
          
          $('body').append ($menu);
          
          $('#contentModuleMenu div.wrapper').first().mCustomScrollbar ({
            set_height: '100%'
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