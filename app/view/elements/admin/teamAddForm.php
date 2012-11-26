<form id="teamAdd" method="post"  action="">
  <fieldset>
    <legend>Nova momčad</legend>
    <?php TableHelper::globalMessages (); ?>
    <ul class="actions">
      <li><a href="<?php echo Config::read('siteUrlRoot') ?>admin/team"><?php TableHelper::icon ('arrowLeft'); ?> Natrag na sve momčadi</a></li>
    </ul>
    <?php
    foreach (Config::read ('supportedLangs') as $lang) {
      echo '<h3 class="langContent">Podaci za '. Config::read ("langNamesEnglish", $lang) .' jezik</h3>';
      FormHelper::input ('text', 'name', 'name', array ('label' => array ('text' => 'Naziv * '), 'lang' => $lang));
    }
    ?>
    <p class="info">Polja označena sa zvijezdicom (*) moraju biti ispunjena.</p>
    <?php FormHelper::input ('submit', 'submit', 'submit', array ('value' => 'Spremi')); ?>
    </fieldset>
</form>