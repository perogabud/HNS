<form id="videoDelete" method="post" action="">
  <fieldset>
    <legend>Delete Video</legend>
    <?php TableHelper::globalMessages (); ?>
    <ul class="actions">
      <li><a href="<?php echo Config::read('siteUrlRoot') ?>admin/video"><?php TableHelper::icon ('arrowLeft'); ?> Back to Videos</a></li>
    </ul>
    <div class="input"><label>Are you sure you want to delete <strong> Video <?php echo $video->Title; ?></strong>?</label></div>
    <?php FormHelper::input ('submit', 'submitYes', 'deleteYesSpremi', array ('value' => 'Yes')); ?>
    <?php FormHelper::input ('submit', 'submitNo', 'deleteNoSpremi', array ('value' => 'No')); ?>
  </fieldset>
</form>