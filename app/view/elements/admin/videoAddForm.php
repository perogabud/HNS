<form id="videoAdd" method="post"  action="">
  <fieldset>
    <legend>New Video</legend>
    <?php TableHelper::globalMessages (); ?>
    <ul class="actions">
      <li><a href="<?php echo Config::read('siteUrlRoot') ?>admin/video"><?php TableHelper::icon ('arrowLeft'); ?> Back to Videos</a></li>
    </ul>
    <?php
    FormHelper::input ('textarea', 'youtubeUrl', 'youtubeUrl', array ('label' => array ('text' => 'Youtube URL * ')));
    foreach (Config::read ('supportedLangs') as $lang) {
      echo '<h3 class="langContent">Data in '. Config::read ("langNamesEnglish", $lang) .' Language</h3>';
      FormHelper::input ('textarea', 'title', 'title', array ('label' => array ('text' => 'Title * '), 'lang' => $lang, 'class' => 'simpleEditor'));
      FormHelper::input ('text', 'category', 'category', array ('label' => array ('text' => 'Category  '), 'lang' => $lang));
    }
    ?>
    <p class="info">Polja označena sa zvijezdicom (*) moraju biti ispunjena.</p>
    <?php FormHelper::input ('submit', 'submit', 'submit', array ('value' => 'Spremi')); ?>
    </fieldset>
</form>