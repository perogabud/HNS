<form id="userRoleAdd" method="post"  action="">
  <fieldset>
    <legend>New User Role</legend>
    <?php TableHelper::globalMessages (); ?>
    <ul class="actions">
    </ul>
    <?php
    FormHelper::input ('text', 'name', 'name', array ('label' => array ('text' => 'Role Name * ')));
    ?>
    <p class="info">Fields marked with * are required.</p>
    <?php FormHelper::input ('submit', 'submit', 'submit', array ('value' => 'Submit')); ?>
    </fieldset>
</form>