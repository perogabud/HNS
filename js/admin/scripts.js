$().ready (function () {

  $('a#contentModuleMenuSave').live('click', function () {

      $('li.moduleItem').each (function () {
        var $this = $(this),
            index = $this.index (),
            itemId = $(this).attr ('data-item-id'),
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
                  $('#contentModuleMenu a.newItem').attr('data-module-id', data.moduleId);
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
              url: "/admin/ajax/customModule/uploadText/" + $('#contentModuleMenu a.newItem').attr('data-module-id'),
              data: {
                itemId : itemId,
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
                  $('#contentModuleMenu a.newItem').attr('data-module-id', data.moduleId);
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
      url: "/admin/ajax/customModule/" + $('#contentModuleMenu a.newItem').attr('data-module-id'),
      dataType: 'html',
      beforeSend: function (jqXHR, settings) {
        //showLoader ($institutionProfiles.siblings ('label'));
      },
      success: function (data, textStatus, jqXHR) {
        if (data) {
          if ($('ul.contentModules div#module' + $moduleId).size() == 0) {
            $('ul.contentModules').prepend (data);
            $('#customModuleId').append ('<option selected="selected" value="'+ $('#contentModuleMenu a.newItem').attr('data-module-id') +'"></option>');
          } else {
            $('ul.contentModules div#module' + $moduleId).parents('li').first().replaceWith(data);
            $('#customModuleId option').attr('selected', false);
            $('#customModuleId option[value="'+ $('#contentModuleMenu a.newItem').attr('data-module-id') +'"]').attr('selected', 'selected');
          }
        }
        $('#contentModuleMenu').fadeOut (200, function () { $('#contentModuleMenu').remove (); });
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.log ('Error: ', textStatus, errorThrown);
      },
      complete: function (jqXHR, textStatus) {}
    });
    return false;
  });

  $('a.deleteModuleButton').live('click', function() {
    var diagRes = confirm('Jeste li sigurni da želite izbrisati ovaj modul?');

    if (diagRes) {
      $moduleId = $(this).attr('data-module-id');

      $.ajax ({
        type: 'GET',
        url: "/admin/ajax/customModule/delete/" + $moduleId,
        dataType: 'json',
        beforeSend: function (jqXHR, settings) {
          //showLoader ($institutionProfiles.siblings ('label'));
        },
        success: function (data, textStatus, jqXHR) {
          $('div#module' + $moduleId).parents('li').first().fadeOut(300);
        },
        error: function (jqXHR, textStatus, errorThrown) {
          console.log ('Error: ', textStatus, errorThrown);
        },
        complete: function (jqXHR, textStatus) {}
      });

    }
  });

  $('a#contentModuleMenuCancel').live('click', function () {
      var diagRes = confirm('Jeste li sigurni da želite izbrisati ovaj modul?');

      if (diagRes) {
        $moduleId = $(this).attr('data-module-id');

        $.ajax ({
          type: 'GET',
          url: "/admin/ajax/customModule/delete/" + $moduleId,
          dataType: 'json',
          beforeSend: function (jqXHR, settings) {
            //showLoader ($institutionProfiles.siblings ('label'));
          },
          success: function (data, textStatus, jqXHR) {
            $('#contentModuleMenu').remove();
            $('div#module' + $moduleId).parents('li').first().fadeOut(300, function() {
              $(this).remove();
            });
          },
          error: function (jqXHR, textStatus, errorThrown) {
            console.log ('Error: ', textStatus, errorThrown);
          },
          complete: function (jqXHR, textStatus) {}
        });

      }
  });

  $('#contentModuleMenu a.newItem').live('click', function () {
    var $newItem = $('<li class="moduleItem small"><select class="size"><option value="1">Usko</option><option value="2">Široko</option></select><a class="addText">Dodaj tekst</a><a class="addImage">Dodaj sliku</a> <a class="remove">Obriši</a><a class="moveUp">Gore</a><a class="moveDown">Dolje</a></li>');

    $moduleId = $(this).attr('data-module-id');

    // Add image behavior
    $newItem.find ('a.addImage').click (function () {
      var inputId = 'upload'+ parseInt (Math.random() * (1000 - 1) + 1);
      $newItem.find ('a.addImage, a.addText').remove ();
      $newItem.attr ('data-type', 'image');
      $newItem.append ('<input type="file" name="image[]" id="'+ inputId +'" class="newImage" />');
      $newItem.find ('input#' + inputId).uploadify ({
        'uploader'        : '/js/uploadify/uploadify.swf',
        'script'          : '/admin/ajax/customModule/uploadImage/' + $moduleId,
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
          $newItem.attr ('data-item-id', response.itemId);
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
      $newItem.append ('<div class="input"><label for="">Sadržaj</label><textarea class="content textarea" name="content" id="" rows="5" cols="50"></textarea></div>');
      $newItem.append ('<div class="input"><label for="">Fusnota</label><textarea class="footnote textarea" name="footnote" id="" rows="5" cols="50"></textarea></div>');
    });

    $(this).parents ('li').before ($newItem);
    $('#contentModuleMenu div.wrapper').first().mCustomScrollbar ('update');
    return false;
  });

  // Remove behaviour
  $('#contentModuleMenu a.remove').live('click', function () {
    $itemId = $(this).parents('li').first().attr('data-item-id');

    if ($itemId) {
      $.ajax ({
        type: 'GET',
        url: "/admin/ajax/customModuleItemDelete/?itemId=" + $itemId,
        dataType: 'json',
        error: function (jqXHR, textStatus, errorThrown) {
          console.log ('Error: ', textStatus, errorThrown);
        },
        complete: function (jqXHR, textStatus) {

        }
      });

      $(this).parents('li').first().remove();
    }
  });
  // Move up
  $('#contentModuleMenu a.moveUp').live('click', function () {
    if ($(this).parents('li').first().prev()) {
      $(this).parents('li').first().insertBefore ($(this).parents('li').first().prev());
    }
  });
  // Move down
  $('#contentModuleMenu a.moveDown').live('click', function () {
    if ($(this).parents('li').first().next()) {
      $(this).parents('li').first().insertAfter ($(this).parents('li').first().next());
    }
  });

  $('#contentModuleMenu select.size').live('change', function () {
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

  $('a.editModuleButton').live('click', function() {
    $moduleId = $(this).attr('data-module-id');

    $.ajax ({
      type: 'GET',
      url: "/admin/ajax/editCustomModule/" + $moduleId,
      success: function (data, textStatus, jqXHR) {
        $('body').append(data)
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.log ('Error: ', textStatus, errorThrown);
      },
      complete: function (jqXHR, textStatus) {}
    });
  });

  if ($('input.datetime').length > 0) {
    $('input.datetime').datetimepicker ({
      timeFormat : 'hh:mm TT',
      ampm: true
    });
  }

  if ($('div.table table').length) {
    var dataTables = $('div.table table').dataTable ({
      "sScrollY": "200px",
      "bPaginate": false,
      "bScrollCollapse": true,
      "oSearch": {
        "sSearch": "",
        "bSmart" : false
      }
    });
  }

  $('.tabs').tabs ();

  $(dataTables).data ('alwaysDisplayed', []);

  // Always display selected items even if filter would not include them
  $('div.table td:first-child input[type="checkbox"]').bind ('change', function () {
    var $this = $(this),
        alwaysDisplayed = $(dataTables).data ('alwaysDisplayed');
    if ($this.attr ('checked')) {
      alwaysDisplayed.splice (0, 0, parseInt ($this.attr ('data-index')));
    }
    else {
      alwaysDisplayed.splice (parseInt ($this.attr ('data-index')), 1);
    }
    $(dataTables).data ('alwaysDisplayed', alwaysDisplayed);
  });

  $(dataTables).bind ('filter', function (e, o) {
    //console.log (e, o);
    var alwaysDisplayed = $(dataTables).data ('alwaysDisplayed'),
        pos = 0;
    for (var i = 0; i < alwaysDisplayed.length; i++) {
      pos = $.inArray (alwaysDisplayed[i], o.aiDisplay);
      if (pos >= 0) {
        o.aiDisplay.splice (pos, 1);
      }
      o.aiDisplay.splice (0, 0, alwaysDisplayed[i]);
    }
    //console.log ('alwaysDisplayed', alwaysDisplayed);
    //console.log ('aiDisplay', o.aiDisplay);
  });

  if ($('input.date').length > 0) {
    $('input.date').datepicker ({dateFormat : 'dd.mm.yy.'});
  }
  if ($('input.dateTime').length > 0) {
    $('input.dateTime').datetimepicker ({dateFormat : 'dd.mm.yy. HH:mm'});
  }

  $('select').chosen ();

  $('textarea.editor').each (function () {
    var $this = $(this),
        height = '200px',
        name = $this.attr ('name');

    if (/^content.*/.test (name)) {
      height = '400px';
    }
    else if (/^lead.*/.test (name)) {
      height = '100px';
    }

    $this.ckeditor (
      function () {
        this.dataProcessor.writer.setRules ('p',
        {
          indent : false,
          breakBeforeOpen : true,
          breakAfterOpen : false,
          breakBeforeClose : false,
          breakAfterClose : true
        });
      },
      {
        // Set taskbar buttons
        toolbar : [
        ['Source'],
        ['Undo', 'Redo'],
        ['Bold', 'Italic'],
        ['NumberedList', 'BulletedList'],
        ['Blockquote', 'HorizontalRule'],
        ['Link','Unlink','Anchor', 'Image'],
        ['Format']
        ],
        format_tags : 'p;h3;h4',
        // Skin
        skin : 'admin',
        resize_minHeight : 100,
        resize_minWidth : 550,
        resize_maxWidth : 898,
        height : height,
        width : '898px',
        readOnly : $this.attr ('readonly') ? true : false
      }
    );
  });

  $('textarea.simpleEditor').each (function () {
    var $this = $(this);

    $this.ckeditor (
    function (element) {
      this.dataProcessor.writer.setRules ('br',
      {
        indent : false,
        breakBeforeOpen : false,
        breakAfterOpen : false,
        breakBeforeClose : false,
        breakAfterClose : false
      });
    },
    {
      blockedKeystrokes: [1066, 1073, 1085, 13, 2013],
      keystrokes: [
        // Disable enter
        [ 13 /*Enter*/, 'blur' ],
        [ CKEDITOR.SHIFT + 13 /*Enter*/, 'blur' ],
        // Other keystrokes
        [ CKEDITOR.ALT + 121 /*F10*/, 'toolbarFocus' ],
        [ CKEDITOR.SHIFT + 121 /*F10*/, 'contextMenu' ],
        [ CKEDITOR.CTRL + 90 /*Z*/, 'undo' ],
        [ CKEDITOR.CTRL + 89 /*Y*/, 'redo' ],
        [ CKEDITOR.CTRL + CKEDITOR.SHIFT + 90 /*Z*/, 'redo' ],
        [ CKEDITOR.CTRL + 66 /*B*/, 'bold' ],
        [ CKEDITOR.CTRL + 73 /*I*/, 'italic' ],
        [ CKEDITOR.CTRL + 85 /*U*/, 'underline' ],
        [ CKEDITOR.ALT + 109 /*-*/, 'toolbarCollapse' ]
      ],
      // Set taskbar buttons
      toolbar : [
        ['Bold', 'Italic', 'Underline'],
      ],
      enterMode : CKEDITOR.ENTER_BR,
      removePlugins: 'elementspath',
      resize_enabled: false,
      // Enabling only paragraphs
      format_tags : 'p',
      // Skin
      skin : 'admin',
      height : '26px',
      width : '459px',
      readOnly : $this.attr ('readonly') ? true : false
    }
    );
  });

});