<form id="memberDelete" method="post" action="">
  <fieldset>
    <legend>Izbriši igrača / člana</legend>
    <?php TableHelper::globalMessages (); ?>
    <ul class="actions">
      <li><a href="<?php echo Config::read('siteUrlRoot') ?>admin/member"><?php TableHelper::icon ('arrowLeft'); ?> Natrag na sve igrače / članove</a></li>
    </ul>
    <div class="input"><label>Jeste li sigurni da želite izbrisati <strong> igrača / člana <?php echo $member->Name; ?></strong>?</label></div>
    <?php FormHelper::input ('submit', 'submitYes', 'deleteYesSubmit', array ('value' => 'Da')); ?>
    <?php FormHelper::input ('submit', 'submitNo', 'deleteNoSubmit', array ('value' => 'Ne')); ?>
  </fieldset>
</form>