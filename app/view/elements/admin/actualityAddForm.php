<form id="actualityAdd" method="post" enctype="multipart/form-data" action="">
  <fieldset>
    <legend>New Actuality</legend>
    <?php TableHelper::globalMessages (); ?>
    <ul class="actions">
      <li><a href="<?php echo Config::read('siteUrlRoot') ?>admin/actuality"><?php TableHelper::icon ('arrowLeft'); ?> Back to Actualitys</a></li>
    </ul>
    <?php
    FormHelper::input ('text', 'languageId', 'languageId', array ('label' => array ('text' => 'Language * ')));
    FormHelper::input ('textarea', 'title', 'title', array ('label' => array ('text' => 'Title * '), 'class' => 'simpleEditor'));
    FormHelper::input ('textarea', 'lead', 'lead', array ('label' => array ('text' => 'Lead *'), 'class' => 'editor'));
    FormHelper::input ('textarea', 'content', 'content', array ('label' => array ('text' => 'Content *'), 'class' => 'editor'));
    FormHelper::input ('text', 'isPublished', 'isPublished', array ('label' => array ('text' => 'Published  ')));
    FormHelper::input ('text', 'publishDate', 'publishDate', array ('label' => array ('text' => 'Publish Date * ')));
    FormHelper::input ('file', 'coverImage[]', 'coverImage', array ('label' => array ('text' => 'Cover Image '), 'info' => 'The image will be resized and cropped to the following dimensions: <strong>719px width</strong> and <strong>429px height</strong>.<br/>These are also minimum dimensions.'));
    ?>
    <p class="info">Polja označena sa zvijezdicom (*) moraju biti ispunjena.</p>
    <?php FormHelper::input ('submit', 'submit', 'submit', array ('value' => 'Spremi')); ?>
    </fieldset>
</form>