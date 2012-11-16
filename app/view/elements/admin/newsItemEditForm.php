<form id="newsItemEdit" method="post" enctype="multipart/form-data" action="">
  <fieldset>
    <legend>Uredi novost <strong><?php echo $newsItem->Title; ?></strong></legend>
    <?php TableHelper::globalMessages (); ?>
    <ul class="actions">
      <li><a href="<?php echo Config::read('siteUrlRoot') ?>admin/newsItem/view/<?php echo $newsItem->getId (); ?>"><?php TableHelper::icon ('view'); ?> Pregledaj ovu novost</a></li>
      <li><a href="<?php echo Config::read('siteUrlRoot') ?>admin/newsItem"><?php TableHelper::icon ('arrowLeft'); ?> Natrag na novosti</a></li>
    </ul>
    <?php
    FormHelper::select ('languageId', 'languageId', 'Jezik *', $languages, $newsItem->getLanguage ());
    FormHelper::input ('textarea', 'title', 'title', array ('label' => array ('text' => 'Naslov * '), 'value' => $newsItem->getTitle (), 'class' => 'simpleEditor'));
    FormHelper::input ('textarea', 'lead', 'lead', array ('label' => array ('text' => 'Uvodni tekst  '), 'value' => $newsItem->getLead (), 'class' => 'editor'));
    FormHelper::input ('textarea', 'content', 'content', array ('label' => array ('text' => 'Sadržaj  '), 'value' => $newsItem->getContent (), 'class' => 'editor'));
    FormHelper::input ('checkbox', 'isPublished', 'isPublished', array ('label' => array ('text' => 'Objavljeno * '), 'checked' => $newsItem->getIsPublished ()));
    FormHelper::input ('text', 'publishDate', 'publishDate', array ('label' => array ('text' => 'Datum objave * '), 'class' => 'date', 'value' => $newsItem->getPublishDate ()));
    if ($newsItem->getCoverImage ()) {
      echo '<div class="input"><img src="' . $newsItem->getCoverImage ()->getUrl () . '" /></div>';
      FormHelper::input ('file', 'coverImage[]', 'coverImage', array ('label' => array ('text' => 'Naslovna slika '), 'info' => 'Leave empty to keep current image.<br />The image will be resized and cropped to the following dimensions: <strong>729px width</strong> and <strong>429px height</strong>.<br/>These are also minimum dimensions.'));
      FormHelper::input ('checkbox', 'deleteCoverImage', 'deleteCoverImage', array ('label' => array ('text' => 'Obriši naslovnu sliku')));
    }
    else {
      FormHelper::input ('file', 'coverImage[]', 'coverImage', array ('label' => array ('text' => 'Naslovna slika '), 'info' => 'The image will be resized and cropped to the following dimensions: <strong>719px width</strong> and <strong>429px height</strong>.<br/>These are also minimum dimensions.'));
    }
    ?>
    <p class="info">Polja označena sa zvijezdicom (*) moraju biti ispunjena.</p>
    <?php FormHelper::input ('submit', 'submit', 'submit', array ('value' => 'Spremi')); ?>
    </fieldset>
</form>