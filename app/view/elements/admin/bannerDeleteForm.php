<form id="bannerDelete" method="post" action="">
  <fieldset>
    <legend>Delete Banner</legend>
    <?php TableHelper::globalMessages (); ?>
    <ul class="actions">
      <li><a href="<?php echo Config::read('siteUrlRoot') ?>admin/banner"><?php TableHelper::icon ('arrowLeft'); ?> Back to Banners</a></li>
    </ul>
    <div class="input"><label>Are you sure you want to delete <strong> Banner <?php echo $banner->Name; ?></strong>?</label></div>
    <?php FormHelper::input ('submit', 'submitYes', 'deleteYesSubmit', array ('value' => 'Yes')); ?>
    <?php FormHelper::input ('submit', 'submitNo', 'deleteNoSubmit', array ('value' => 'No')); ?>
  </fieldset>
</form>