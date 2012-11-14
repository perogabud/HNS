<form id="galleryAdd" method="post"  action="">
  <fieldset>
    <legend>New Gallery</legend>
    <?php TableHelper::globalMessages (); ?>
    <ul class="actions">
      <li><a href="<?php echo Config::read('siteUrlRoot') ?>admin/gallery"><?php TableHelper::icon ('arrowLeft'); ?> Back to Gallerys</a></li>
    </ul>
    <?php
    foreach (Config::read ('supportedLangs') as $lang) {
      echo '<h3 class="langContent">Data in '. Config::read ("langNamesEnglish", $lang) .' Language</h3>';
      FormHelper::input ('textarea', 'title', 'title', array ('label' => array ('text' => 'Title * '), 'lang' => $lang, 'class' => 'simpleEditor'));
      FormHelper::input ('text', 'category', 'category', array ('label' => array ('text' => 'Category  '), 'lang' => $lang));
    }
    ?>
    <p class="info">Fields marked with * are required.</p>
    <?php FormHelper::input ('submit', 'submit', 'submit', array ('value' => 'Submit')); ?>
    </fieldset>
</form>