<form id="galleryDelete" method="post" action="">
  <fieldset>
    <legend>Delete Gallery</legend>
    <?php TableHelper::globalMessages (); ?>
    <ul class="actions">
      <li><a href="<?php echo Config::read('siteUrlRoot') ?>admin/gallery"><?php TableHelper::icon ('arrowLeft'); ?> Back to Gallerys</a></li>
    </ul>
    <div class="input"><label>Are you sure you want to delete <strong> Gallery <?php echo $gallery->Title; ?></strong>?</label></div>
    <?php FormHelper::input ('submit', 'submitYes', 'deleteYesSpremi', array ('value' => 'Yes')); ?>
    <?php FormHelper::input ('submit', 'submitNo', 'deleteNoSpremi', array ('value' => 'No')); ?>
  </fieldset>
</form>