<form id="teamDelete" method="post" action="">
  <fieldset>
    <legend>Izbriši momčad</legend>
    <?php TableHelper::globalMessages (); ?>
    <ul class="actions">
      <li><a href="<?php echo Config::read('siteUrlRoot') ?>admin/team"><?php TableHelper::icon ('arrowLeft'); ?> Natrag na sve momčadi</a></li>
    </ul>
    <div class="input"><label>Jeste li sigurni da želite izbrisati <strong> momčad <?php echo $team->Name; ?></strong>?</label></div>
    <?php FormHelper::input ('submit', 'submitYes', 'deleteYesSubmit', array ('value' => 'Da')); ?>
    <?php FormHelper::input ('submit', 'submitNo', 'deleteNoSubmit', array ('value' => 'Ne')); ?>
  </fieldset>
</form>