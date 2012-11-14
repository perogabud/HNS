<form id="userAdd" method="post"  action="">
  <fieldset>
    <legend>New User</legend>
    <?php TableHelper::globalMessages (); ?>
    <ul class="actions">
    </ul>
    <?php
    FormHelper::multipleSelect ('userRoleId', 'userRoleId', $userRoles, array ('label' => array ('text' => 'User Roles')));
    ?>
    <ul class="actions">
      <li><a href="/admin/userRole"><?php TableHelper::icon ('view'); ?> View all User Roles</a></li>
      <li><a href="/admin/userRole/add"><?php TableHelper::icon ('add'); ?> Add new User Role</a></li>
    </ul>
     <?php
    FormHelper::input ('text', 'username', 'username', array ('label' => array ('text' => 'Username * ')));
    FormHelper::input ('password', 'password', 'password', array ('label' => array ('text' => 'Password * ')));
    ?>
    <p class="info">Fields marked with * are required.</p>
    <?php FormHelper::input ('submit', 'submit', 'submit', array ('value' => 'Submit')); ?>
    </fieldset>
</form>