<form id="userEdit" method="post"  action="">
  <fieldset>
    <legend>Edit User <strong><?php echo $user->Username; ?></strong></legend>
    <?php TableHelper::globalMessages (); ?>
    <ul class="actions">
    </ul>
    <?php
    FormHelper::multipleSelect ('userRoleId', 'userRoleId', $userRoles, array ('label' => array ('text' => 'User Roles'), 'selected' => $user->UserRoles));
    ?>
    <ul class="actions">
      <li><a href="/admin/userRole"><?php TableHelper::icon ('view'); ?> View all User Roles</a></li>
      <li><a href="/admin/userRole/add"><?php TableHelper::icon ('add'); ?> Add new User Role</a></li>
    </ul>
    <?php
    FormHelper::input ('text', 'username', 'username', array ('label' => array ('text' => 'Username * '), 'value' => $user->getUsername ()));
    FormHelper::input ('password', 'password', 'password', array ('label' => array ('text' => 'Password * '), 'value' => '', 'info' => 'Leave empty to keep current password.'));
    ?>
    <p class="info">Polja označena sa zvijezdicom (*) moraju biti ispunjena.</p>
    <?php FormHelper::input ('submit', 'submit', 'submit', array ('value' => 'Spremi')); ?>
    </fieldset>
</form>