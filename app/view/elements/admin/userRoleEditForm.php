<form id="userRoleEdit" method="post"  action="">
  <fieldset>
    <legend>Edit User Role <strong><?php echo $userRole->Name; ?></strong></legend>
    <?php TableHelper::globalMessages (); ?>
    <ul class="actions">
    </ul>
    <?php
    FormHelper::input ('text', 'name', 'name', array ('label' => array ('text' => 'Role Name * '), 'value' => $userRole->getName ()));
    ?>
    <p class="info">Polja označena sa zvijezdicom (*) moraju biti ispunjena.</p>
    <?php FormHelper::input ('submit', 'submit', 'submit', array ('value' => 'Spremi')); ?>
    </fieldset>
</form>