<form id="newsItemDelete" method="post" action="">
  <fieldset>
    <legend>Delete News Category</legend>
    <?php TableHelper::globalMessages (); ?>
    <ul class="actions">
      <li><a href="<?php echo Config::read('siteUrlRoot') ?>admin/newsCategory"><?php TableHelper::icon ('arrowLeft'); ?> Natrag na kategorije</a></li>
    </ul>
    <div class="input"><label>Are you sure you want to delete <strong> News Category <?php echo $newsCategory->Title; ?></strong>?</label></div>
    <?php FormHelper::input ('submit', 'submitYes', 'deleteYesSpremi', array ('value' => 'Yes')); ?>
    <?php FormHelper::input ('submit', 'submitNo', 'deleteNoSpremi', array ('value' => 'No')); ?>
  </fieldset>
</form>