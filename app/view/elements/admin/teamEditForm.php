<form id="teamEdit" method="post"  action="">
  <fieldset>
    <legend>Edit Team <strong><?php echo $team->Name; ?></strong></legend>
    <?php TableHelper::globalMessages (); ?>
    <ul class="actions">
      <li><a href="<?php echo Config::read('siteUrlRoot') ?>admin/team/view/<?php echo $team->getId (); ?>"><?php TableHelper::icon ('view'); ?> Pregledaj ovu momčad</a></li>
      <li><a href="<?php echo Config::read('siteUrlRoot') ?>admin/team"><?php TableHelper::icon ('arrowLeft'); ?> Natrag na sve momčadi</a></li>
    </ul>
    <?php
    foreach (Config::read ('supportedLangs') as $lang) {
      echo '<h3 class="langContent">Podaci za '. Config::read ("langNamesCroatian", $lang) .' jezik</h3>';
      FormHelper::input ('text', 'name', 'name', array ('label' => array ('text' => 'Naziv * '), 'value' => $team->getName ($lang), 'lang' => $lang));
    }
    ?>
    <p class="info">Polja označena sa zvijezdicom (*) moraju biti ispunjena.</p>
    <?php FormHelper::input ('submit', 'submit', 'submit', array ('value' => 'Spremi')); ?>
    </fieldset>
</form>