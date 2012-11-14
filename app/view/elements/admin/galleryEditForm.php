<form id="galleryEdit" method="post"  action="">
  <fieldset>
    <legend>Edit Gallery <strong><?php echo $gallery->Title; ?></strong></legend>
    <?php TableHelper::globalMessages (); ?>
    <ul class="actions">
      <li><a href="<?php echo Config::read('siteUrlRoot') ?>admin/gallery/view/<?php echo $gallery->getId (); ?>"><?php TableHelper::icon ('view'); ?> View this Gallery</a></li>
      <li><a href="<?php echo Config::read('siteUrlRoot') ?>admin/gallery"><?php TableHelper::icon ('arrowLeft'); ?> Back to Gallerys</a></li>
    </ul>
    <?php
    foreach (Config::read ('supportedLangs') as $lang) {
      echo '<h3 class="langContent">Data in '. Config::read ("langNamesEnglish", $lang) .' Language</h3>';
      FormHelper::input ('textarea', 'title', 'title', array ('label' => array ('text' => 'Title * '), 'lang' => $lang, 'value' => $gallery->getTitle ($lang), 'class' => 'simpleEditor'));
      FormHelper::input ('text', 'category', 'category', array ('label' => array ('text' => 'Category  '), 'value' => $gallery->getCategory ($lang), 'lang' => $lang));
    }
    ?>
    <p class="info">Fields marked with * are required.</p>
    <?php FormHelper::input ('submit', 'submit', 'submit', array ('value' => 'Submit')); ?>
    </fieldset>
</form>