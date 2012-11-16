<form id="newsItemAdd" method="post" enctype="multipart/form-data" action="">
  <fieldset>
    <legend>Nova novost</legend>
    <?php TableHelper::globalMessages (); ?>
    <ul class="actions">
      <li><a href="<?php echo Config::read('siteUrlRoot') ?>admin/newsItem"><?php TableHelper::icon ('arrowLeft'); ?> Natrag na novosti</a></li>
    </ul>
    <?php
    FormHelper::select ('languageId', 'languageId', 'Jezik *', $languages, 'hrv');
    FormHelper::input ('textarea', 'title', 'title', array ('label' => array ('text' => 'Naslov * '), 'class' => 'simpleEditor'));
    FormHelper::input ('textarea', 'lead', 'lead', array ('label' => array ('text' => 'Uvodni tekst '), 'class' => 'editor'));
    FormHelper::input ('textarea', 'content', 'content', array ('label' => array ('text' => 'Sadržaj '), 'class' => 'editor'));
    FormHelper::input ('checkbox', 'isPublished', 'isPublished', array ('label' => array ('text' => 'Objavljeno'), 'checked' => TRUE));
    FormHelper::input ('text', 'publishDate', 'publishDate', array ('label' => array ('text' => 'Datum objave * '), 'class' => 'date', 'value' => date ('Y-m-d')));
    FormHelper::input ('file', 'coverImage[]', 'coverImage', array ('label' => array ('text' => 'Naslovna slika '), 'info' => 'The image will be resized and cropped to the following dimensions: <strong>729px width</strong> and <strong>429px height</strong>.<br/>These are also minimum dimensions.'));
    ?>
    <p class="info">Polja označena sa zvijezdicom (*) moraju biti ispunjena.</p>
    <?php FormHelper::input ('submit', 'submit', 'submit', array ('value' => 'Spremi')); ?>
    </fieldset>
</form>