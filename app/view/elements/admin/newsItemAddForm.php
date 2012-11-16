<form id="newsItemAdd" method="post" enctype="multipart/form-data" action="">
  <fieldset>
    <legend>New News Item</legend>
    <?php TableHelper::globalMessages (); ?>
    <ul class="actions">
      <li><a href="<?php echo Config::read('siteUrlRoot') ?>admin/newsItem"><?php TableHelper::icon ('arrowLeft'); ?> Back to News Items</a></li>
    </ul>
    <?php
    FormHelper::select ('languageId', 'languageId', 'Language *', $languages, 'hrv');
    FormHelper::input ('textarea', 'title', 'title', array ('label' => array ('text' => 'Title * '), 'class' => 'simpleEditor'));
    FormHelper::input ('textarea', 'lead', 'lead', array ('label' => array ('text' => 'Lead '), 'class' => 'editor'));
    FormHelper::input ('textarea', 'content', 'content', array ('label' => array ('text' => 'Content '), 'class' => 'editor'));
    FormHelper::input ('checkbox', 'isPublished', 'isPublished', array ('label' => array ('text' => 'Published'), 'checked' => TRUE));
    FormHelper::input ('text', 'publishDate', 'publishDate', array ('label' => array ('text' => 'Publish Date * '), 'class' => 'date', 'value' => date ('Y-m-d')));
    FormHelper::input ('file', 'coverImage[]', 'coverImage', array ('label' => array ('text' => 'Cover Image '), 'info' => 'The image will be resized and cropped to the following dimensions: <strong>729px width</strong> and <strong>429px height</strong>.<br/>These are also minimum dimensions.'));
    ?>
    <p class="info">Polja označena sa zvijezdicom (*) moraju biti ispunjena.</p>
    <?php FormHelper::input ('submit', 'submit', 'submit', array ('value' => 'Spremi')); ?>
    </fieldset>
</form>