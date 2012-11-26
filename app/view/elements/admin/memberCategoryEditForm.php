<form id="memberCategoryEdit" method="post"  action="">
  <fieldset>
    <legend>Edit Member Category <strong><?php echo $memberCategory->Name; ?></strong></legend>
    <?php TableHelper::globalMessages (); ?>
    <ul class="actions">
    </ul>
    <?php
    foreach (Config::read ('supportedLangs') as $lang) {
      echo '<h3 class="langContent">Data in '. Config::read ("langNamesEnglish", $lang) .' Language</h3>';
      FormHelper::input ('text', 'name', 'name', array ('label' => array ('text' => 'Name * '), 'value' => $memberCategory->getName ($lang), 'lang' => $lang));
    }
    ?>
    <p class="info">Polja označena sa zvijezdicom (*) moraju biti ispunjena.</p>
    <?php FormHelper::input ('submit', 'submit', 'submit', array ('value' => 'Submit')); ?>
    </fieldset>
</form>