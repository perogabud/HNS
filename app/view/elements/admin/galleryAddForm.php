<form id="galleryAdd" method="post"  action="">
  <fieldset>
    <legend>New Gallery</legend>
    <?php TableHelper::globalMessages (); ?>
    <ul class="actions">
      <li><a href="<?php echo Config::read('siteUrlRoot') ?>admin/gallery"><?php TableHelper::icon ('arrowLeft'); ?> Back to Gallerys</a></li>
    </ul>
    <div class="tabs">
      <?php
      $this->getElement ('admin/languageTabs');
      foreach (Config::read ('supportedLangs') as $lang) {
        echo '<div id="tabs-'.$lang.'">';
        echo '<h3 class="langContent">Data in '. Config::read ("langNamesEnglish", $lang) .' Jezik</h3>';
        FormHelper::input ('textarea', 'title', 'title', array ('label' => array ('text' => 'Naslov * '), 'lang' => $lang, 'class' => 'simpleEditor'));
        FormHelper::input ('text', 'category', 'category', array ('label' => array ('text' => 'Category  '), 'lang' => $lang));
        echo '</div>';
      }
      ?>
    </div>
    <p class="info">Polja označena sa zvijezdicom (*) moraju biti ispunjena.</p>
    <?php FormHelper::input ('submit', 'submit', 'submit', array ('value' => 'Spremi')); ?>

    </fieldset>
</form>