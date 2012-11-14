<form id="userRoleEdit" method="post"  action="">
  <fieldset>
    <legend>Edit User Role <strong><?php echo $userRole->Name; ?></strong></legend>
    <?php TableHelper::globalMessages (); ?>
    <ul class="actions">
    </ul>
    <?php
    FormHelper::input ('text', 'name', 'name', array ('label' => array ('text' => 'Role Name * '), 'value' => $userRole->getName ()));
    ?>
    <p class="info">Fields marked with * are required.</p>
    <?php FormHelper::input ('submit', 'submit', 'submit', array ('value' => 'Submit')); ?>
    </fieldset>
</form>