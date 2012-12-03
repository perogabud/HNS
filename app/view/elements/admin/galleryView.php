<div class="column">
  <fieldset>
    <legend>Galerija <strong><?php echo $gallery->Title; ?></strong></legend>
    <?php TableHelper::globalMessages (); ?>
    <ul class="actions">
      <li><a href="<?php echo Config::read('siteUrlRoot') ?>admin/gallery"><?php TableHelper::icon ('arrowLeft'); ?> Natrag na galerije</a></li>
      <li><a href="/admin/gallery/edit/<?php echo $gallery->Id; ?>"><?php TableHelper::icon ('edit'); ?> Uredi ovu galeriju</a></li>
    </ul>
    <dl class="info">
      <?php foreach (Config::read ('supportedLangs') as $lang): ?>
      <dt<?php echo !$gallery->getTitle ($lang) ? ' class="empty"' : '' ?>>Naslov [<?php echo strtoupper ($lang); ?>]</dt>
      <?php if ($gallery->getTitle ($lang)): ?>
      <dd><?php echo $gallery->getTitle ($lang); ?></dd>
      <?php endif; ?>
      <dt<?php echo !$gallery->getCategory ($lang) ? ' class="empty"' : '' ?>>Kategorija [<?php echo strtoupper ($lang); ?>]</dt>
      <?php if ($gallery->getCategory ($lang)): ?>
      <dd><?php echo $gallery->getCategory ($lang); ?></dd>
      <?php endif; ?>
      <?php endforeach; ?>
      <dt>Zapis stvoren</dt>
      <dd>
        <?php echo $gallery->getCreated ('m.d.Y. H:i:s'); ?>
      </dd>
      <dt>Zapis uređen</dt>
      <dd>
        <?php echo $gallery->Created == $gallery->Created ? $gallery->getModified ('m.d.Y. H:i:s') : '-'; ?>
      </dd>
    </dl>
    <div>
    </div>
  </fieldset>
</div>
<div class="column">
  <fieldset>
    <legend>Slike</legend>
    <p class="info">Minimalne dimenzije za slike su <strong>729px</strong> širina i <strong>419px</strong> visina.</p>
    <?php
      FormHelper::input ('file', 'image[]', 'image');
      FormHelper::input ('hidden', 'sessid', 'sessid', array ('value' => session_id()));
      FormHelper::input ('hidden', 'galleryId', 'galleryId', array ('value' => $gallery->Id));
    ?>
    <ul class="imageList" id="imagesList">
      <?php if (count ($gallery->Images)) foreach ($gallery->Images as $image): ?>
      <li>
            <a target="blank" href="<?php echo $image->getUrl (); ?>"><img src="<?php echo $image->getLargeThumbnailUrl (); ?>" alt=""/></a>

        <a id="moveUpImage<?php echo $image->Id; ?>" class="moveUp"><?php TableHelper::icon('moveUp'); ?></a>
        <a id="moveDownImage<?php echo $image->Id; ?>" class="moveDown" ><?php TableHelper::icon('moveDown'); ?></a>
        <a id="removeImage<?php echo $image->Id; ?>" class="remove"><?php TableHelper::icon ('delete'); ?> Obriši</a>
        <script type="text/javascript">
          $('a#removeImage<?php echo $image->Id; ?>, a#moveUpImage<?php echo $image->Id; ?>, a#moveDownImage<?php echo $image->Id; ?>').data (
           'imageId', '<?php echo $image->Id; ?>'
          );
        </script>
      </li>
      <?php endforeach; ?>
    </ul>
    <script type="text/javascript">
    $().ready (function () {
    if ($('#image').length == 1) {
      $('#image').uploadify ({
        'uploader'        : '/js/uploadify/uploadify.swf',
        'script'          : '/admin/gallery/uploadImage/' + $('input#galleryId').val (),
        'scriptData'      : {
          'SESSION_ID' : $('input#sessid').val (),
          'galleryId' : $('input#galleryId').val ()
        },
        'cancelImg'       : '/js/uploadify/cancel.png',
        'auto'            : true,
        'fileDataName'    : 'image[]',
        'fileExt'         : '*.jpg',
        'fileDesc'        : 'JPEG Image Files',
        'multi'           : true,
        'removeCompleted' : true,
        'onComplete'      : function (event, ID, fileObj, response, data) {
          $('body').append ('<pre style="display:none;">Complete - '+ response +'</pre>');
          imageUploadOnComplete (event, ID, fileObj, response, data);
        },
        'onOpen'          : function (event, ID, fileObj) {
          imageUploadOnOpen (event, ID, fileObj);
        },
        'onError'         : function (event, ID, fileObj, errorObj) {
          $('body').append ('<pre style="display:none;">Error</pre>');
        }
      });

      $('ul.imageList a.remove').click (function () { removeImageClick (this); return false; });
      $('ul.imageList a.moveUp').click (function () { moveImageClick (this, 'up'); return false; });
      $('ul.imageList a.moveDown').click (function () { moveImageClick (this, 'down'); return false; });
    }
    });

    function showLoader ($element) {
      $element.append ('<img class="loader" src="/img/admin/ajax-loader.gif" alt="Loading..." />');
    }

    function removeLoader ($element) {
      $element.find ('img.loader').remove ();
    }

    function imageUploadOnComplete (event, ID, fileObj, response, data) {
      response = jQuery.parseJSON (response);
      if (response.error !== undefined) {
        alert (response.error);
      }
      else {
        $('#imagesList').append ('<li>' + getUploadedImageHTML (response.filename, '', '')
          + '<a id="moveUp' + ID +'" class="moveUp"><img src="/img/admin/arrowUp.png" alt="arrow up"></a>'
          + '<a id="moveDown' + ID +'" class="moveDown"><img src="/img/admin/arrowDown.png" alt="arrow down"></a>'
          + '<a id="remove' + ID +'" class="remove"><img src="/img/admin/binClosed.png" alt="delete"> Obriši</a></li>');
        $('#loader' + ID).remove ();
        $('a#remove' + ID + ', a#moveUp' + ID + ', a#moveDown' + ID).data ('imageId', response.imageId);
        $('ul.imageList a#remove' + ID).click (function () {removeImageClick (this);return false;});
        $('ul.imageList a#moveUp' + ID).click (function () { moveImageClick (this, 'up'); return false; });
        $('ul.imageList a#moveDown'+ ID).click (function () { moveImageClick (this, 'down'); return false; });
      }
    }

    function imageUploadOnOpen (event, ID, fileObj) {
      $('div#image' + ID).append ('<img id="loader'+ID+'" style="position: absolute; top: 10px; right: 30px;" src="/img/admin/ajax-loader.gif">');
    }

    function getUploadedImageHTML (filename, className, id) {
      return '<img id="'+id+'" src="/img/gallery/image/largeThumbnail/'+ filename +'" class="'+ className +'" alt="" />';
    }

    function removeImageClick (clickedElement) {
      var $this = $(clickedElement);
      $this.unbind ('click');
      showLoader($this);
      $.ajax ({
        type : 'POST',
        url : '/admin/gallery/removeImage/<?php echo $gallery->getId (); ?>',
        data : (
          {
            'imageId' : $this.data ('imageId'),
            'galleryId' : <?php echo $gallery->getId (); ?>
          }
        ),
        dataType: 'json',
        complete : function (XMLHttpRequest, textStatus) {
        },
        error : function (XMLHttpRequest, textStatus, errorThrown) {
          alert ('Error: ' + textStatus);
        removeLoader ($this);
        },
        success : function (data, XMLHttpRequest, textStatus) {
          if (data.success) {
            $this.parents ('li').remove ();
          }
        }
      });
    }

    function moveImageClick (clickedElement, direction) {
      var $this = $(clickedElement);
      $this.unbind ('click');
      showLoader($this);
      $.ajax ({
        type : 'POST',
        url : '/admin/gallery/moveImage/<?php echo $gallery->getId (); ?>',
        data : (
          {
            'imageId' : $this.data ('imageId'),
            'galleryId' : <?php echo $gallery->getId (); ?>,
            'direction' : direction
          }
        ),
        dataType: 'json',
        complete : function (XMLHttpRequest, textStatus) {
        },
        error : function (XMLHttpRequest, textStatus, errorThrown) {
          alert ('Error: ' + textStatus);
        removeLoader ($this);
        },
        success : function (data, XMLHttpRequest, textStatus) {
          if (data.success) {
            $this.click (function () { moveImageClick (clickedElement, direction); return false; });
            removeLoader ($this);
            if (direction == 'up') {
              var $button = $(clickedElement);
              var $li = $button.parents ('li');
              var $switchLi;
              if ($li.prev ().length == 0) {
                $switchLi = $li.siblings (':last-child');
                $li.insertAfter ($switchLi);
              }
              else {
                $switchLi = $li.prev ();
                $li.insertBefore ($li.prev ());
              }
            }
            else if (direction == 'down') {
              var $button = $(clickedElement);
              var $li = $button.parents ('li');
              var $switchLi;
              if ($li.next ().length == 0) {
                $switchLi = $li.siblings (':first-child');
                $li.insertBefore ($switchLi);
              }
              else {
                $switchLi = $li.next ();
                $li.insertAfter ($switchLi);
              }
            }
          }
        }
      });
    }
    </script>
  </fieldset>
</div>
