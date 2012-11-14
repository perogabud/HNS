<form id="newsItemDelete" method="post" action="">
  <fieldset>
    <legend>Delete News Item</legend>
    <?php TableHelper::globalMessages (); ?>
    <ul class="actions">
      <li><a href="<?php echo Config::read('siteUrlRoot') ?>admin/newsItem"><?php TableHelper::icon ('arrowLeft'); ?> Back to News Items</a></li>
    </ul>
    <div class="input"><label>Are you sure you want to delete <strong> News Item <?php echo $newsItem->Title; ?></strong>?</label></div>
    <?php FormHelper::input ('submit', 'submitYes', 'deleteYesSubmit', array ('value' => 'Yes')); ?>
    <?php FormHelper::input ('submit', 'submitNo', 'deleteNoSubmit', array ('value' => 'No')); ?>
  </fieldset>
</form>