$().ready (function () {

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
    $('input.date').datepicker ({dateFormat : 'yy-mm-dd'});
  }
  if ($('input.dateTime').length > 0) {
    $('input.dateTime').datetimepicker ({dateFormat : 'yy-mm-dd'});
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
        ['HorizontalRule'],
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
        width : '898px'
      }
    );
  });

  $('.simpleEditor').ckeditor (
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
      width : '459px'
    }
    );

});