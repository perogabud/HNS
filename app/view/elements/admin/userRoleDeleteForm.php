<form id="userRoleDelete" method="post" action="">
  <fieldset>
    <legend>Delete User Role</legend>
    <?php TableHelper::globalMessages (); ?>
    <ul class="actions">
    </ul>
    <div class="input"><label>Are you sure you want to delete <strong> User Role <?php echo $userRole->Name; ?></strong>?</label></div>
    <?php FormHelper::input ('submit', 'submitYes', 'deleteYesSpremi', array ('value' => 'Yes')); ?>
    <?php FormHelper::input ('submit', 'submitNo', 'deleteNoSpremi', array ('value' => 'No')); ?>
  </fieldset>
</form>