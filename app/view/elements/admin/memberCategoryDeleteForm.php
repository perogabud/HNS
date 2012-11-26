<form id="memberCategoryDelete" method="post" action="">
  <fieldset>
    <legend>Delete Member Category</legend>
    <?php TableHelper::globalMessages (); ?>
    <ul class="actions">
    </ul>
    <div class="input"><label>Are you sure you want to delete <strong> Member Category <?php echo $memberCategory->Name; ?></strong>?</label></div>
    <?php FormHelper::input ('submit', 'submitYes', 'deleteYesSubmit', array ('value' => 'Yes')); ?>
    <?php FormHelper::input ('submit', 'submitNo', 'deleteNoSubmit', array ('value' => 'No')); ?>
  </fieldset>
</form>