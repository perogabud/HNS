<form id="videoEdit" method="post"  action="">
  <fieldset>
    <legend>Edit Video <strong><?php echo $video->Title; ?></strong></legend>
    <?php TableHelper::globalMessages (); ?>
    <ul class="actions">
      <li><a href="<?php echo Config::read('siteUrlRoot') ?>admin/video/view/<?php echo $video->getId (); ?>"><?php TableHelper::icon ('view'); ?> View this Video</a></li>
      <li><a href="<?php echo Config::read('siteUrlRoot') ?>admin/video"><?php TableHelper::icon ('arrowLeft'); ?> Back to Videos</a></li>
    </ul>
    <?php
    FormHelper::input ('textarea', 'youtubeUrl', 'youtubeUrl', array ('label' => array ('text' => 'Youtube URL * '), 'value' => $video->getYoutubeUrl ()));
    FormHelper::input ('text', 'publishDate', 'publishDate', array ('label' => array ('text' => 'Datum objave * '), 'class' => 'date', 'value' => $video->getPublishDate ()));
    FormHelper::input ('checkbox', 'isPublished', 'isPublished', array ('label' => array ('text' => 'Objavljeno * '), 'checked' => $video->getIsPublished ()));
    foreach (Config::read ('supportedLangs') as $lang) {
      echo '<h3 class="langContent">Data in '. Config::read ("langNamesEnglish", $lang) .' Jezik</h3>';
      FormHelper::input ('textarea', 'title', 'title', array ('label' => array ('text' => 'Naslov * '), 'lang' => $lang, 'value' => $video->getTitle ($lang), 'class' => 'simpleEditor'));
      FormHelper::input ('text', 'category', 'category', array ('label' => array ('text' => 'Category  '), 'value' => $video->getCategory ($lang), 'lang' => $lang));
    }
    ?>
    <p class="info">Polja označena sa zvijezdicom (*) moraju biti ispunjena.</p>
    <?php FormHelper::input ('submit', 'submit', 'submit', array ('value' => 'Spremi')); ?>
    </fieldset>
</form>