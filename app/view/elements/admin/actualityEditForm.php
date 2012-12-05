<form id="actualityEdit" method="post" enctype="multipart/form-data" action="">
  <fieldset>
    <legend>Edit Actuality <strong><?php echo $actuality->Title; ?></strong></legend>
    <?php TableHelper::globalMessages (); ?>
    <ul class="actions">
      <li><a href="<?php echo Config::read('siteUrlRoot') ?>admin/actuality/view/<?php echo $actuality->getId (); ?>"><?php TableHelper::icon ('view'); ?> View this Actuality</a></li>
      <li><a href="<?php echo Config::read('siteUrlRoot') ?>admin/actuality"><?php TableHelper::icon ('arrowLeft'); ?> Back to Actualitys</a></li>
    </ul>
    <?php
    FormHelper::select ('languageId', 'languageId', 'Jezik *', $languages, $actuality->getLanguage ());
    FormHelper::input ('textarea', 'title', 'title', array ('label' => array ('text' => 'Naslov * '), 'value' => $actuality->getTitle (), 'class' => 'simpleEditor'));
    FormHelper::input ('textarea', 'lead', 'lead', array ('label' => array ('text' => 'Uvodni tekst * '), 'value' => $actuality->getLead (), 'class' => 'editor'));
    FormHelper::input ('textarea', 'content', 'content', array ('label' => array ('text' => 'Sadržaj * '), 'value' => $actuality->getContent (), 'class' => 'editor'));
    FormHelper::input ('checkbox', 'isPublished', 'isPublished', array ('label' => array ('text' => 'Objavljeno  '), 'checked' => $actuality->getIsPublished ()));
    FormHelper::input ('text', 'publishDate', 'publishDate', array ('label' => array ('text' => 'Datum objave * '), 'value' => $actuality->getPublishDate ('d.m.Y. H:i'), 'class' => 'dateTime'));
    if ($actuality->getCoverImage ()) {
      echo '<div class="input"><img src="' . $actuality->getCoverImage ()->getUrl () . '" /></div>';
      FormHelper::input ('file', 'coverImage[]', 'coverImage', array ('label' => array ('text' => 'Naslovna slika '), 'info' => 'Leave empty to keep current image.<br />The image will be resized and cropped to the following dimensions: <strong>719px width</strong> and <strong>429px height</strong>.<br/>These are also minimum dimensions.'));
      FormHelper::input ('checkbox', 'deleteCoverImage', 'deleteCoverImage', array ('label' => array ('text' => 'Delete coverImage')));
    }
    else {
      FormHelper::input ('file', 'coverImage[]', 'coverImage', array ('label' => array ('text' => 'Naslovna slika '), 'info' => 'The image will be resized and cropped to the following dimensions: <strong>719px width</strong> and <strong>429px height</strong>.<br/>These are also minimum dimensions.'));
    }
    ?>
    <p class="info">Polja označena sa zvijezdicom (*) moraju biti ispunjena.</p>
    <?php FormHelper::input ('submit', 'submit', 'submit', array ('value' => 'Spremi')); ?>
    </fieldset>
</form>