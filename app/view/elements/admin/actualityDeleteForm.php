<form id="actualityDelete" method="post" action="">
  <fieldset>
    <legend>Delete Actuality</legend>
    <?php TableHelper::globalMessages (); ?>
    <ul class="actions">
      <li><a href="<?php echo Config::read('siteUrlRoot') ?>admin/actuality"><?php TableHelper::icon ('arrowLeft'); ?> Back to Actualitys</a></li>
    </ul>
    <div class="input"><label>Are you sure you want to delete <strong> Actuality <?php echo $actuality->Title; ?></strong>?</label></div>
    <?php FormHelper::input ('submit', 'submitYes', 'deleteYesSpremi', array ('value' => 'Yes')); ?>
    <?php FormHelper::input ('submit', 'submitNo', 'deleteNoSpremi', array ('value' => 'No')); ?>
  </fieldset>
</form>