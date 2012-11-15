<form id="actualityEdit" method="post" enctype="multipart/form-data" action="">
  <fieldset>
    <legend>Edit Actuality <strong><?php echo $actuality->Title; ?></strong></legend>
    <?php TableHelper::globalMessages (); ?>
    <ul class="actions">
      <li><a href="<?php echo Config::read('siteUrlRoot') ?>admin/actuality/view/<?php echo $actuality->getId (); ?>"><?php TableHelper::icon ('view'); ?> View this Actuality</a></li>
      <li><a href="<?php echo Config::read('siteUrlRoot') ?>admin/actuality"><?php TableHelper::icon ('arrowLeft'); ?> Back to Actualitys</a></li>
    </ul>
    <?php
    FormHelper::input ('text', 'languageId', 'languageId', array ('label' => array ('text' => 'Language * '), 'value' => $actuality->getLanguageId ()));
    FormHelper::input ('textarea', 'title', 'title', array ('label' => array ('text' => 'Title * '), 'value' => $actuality->getTitle (), 'class' => 'simpleEditor'));
    FormHelper::input ('textarea', 'lead', 'lead', array ('label' => array ('text' => 'Lead * '), 'value' => $actuality->getLead (), 'class' => 'editor'));
    FormHelper::input ('textarea', 'content', 'content', array ('label' => array ('text' => 'Content * '), 'value' => $actuality->getContent (), 'class' => 'editor'));
    FormHelper::input ('text', 'isPublished', 'isPublished', array ('label' => array ('text' => 'Published  '), 'value' => $actuality->getIsPublished ()));
    FormHelper::input ('text', 'publishDate', 'publishDate', array ('label' => array ('text' => 'Publish Date * '), 'value' => $actuality->getPublishDate ()));
    if ($actuality->getCoverImage ()) {
      echo '<div class="input"><img src="' . $actuality->getCoverImage ()->getUrl () . '" /></div>';
      FormHelper::input ('file', 'coverImage[]', 'coverImage', array ('label' => array ('text' => 'Cover Image '), 'info' => 'Leave empty to keep current image.<br />The image will be resized and cropped to the following dimensions: <strong>719px width</strong> and <strong>429px height</strong>.<br/>These are also minimum dimensions.'));
      FormHelper::input ('checkbox', 'deleteCoverImage', 'deleteCoverImage', array ('label' => array ('text' => 'Delete coverImage')));
    }
    else {
      FormHelper::input ('file', 'coverImage[]', 'coverImage', array ('label' => array ('text' => 'Cover Image '), 'info' => 'The image will be resized and cropped to the following dimensions: <strong>719px width</strong> and <strong>429px height</strong>.<br/>These are also minimum dimensions.'));
    }
    ?>
    <p class="info">Fields marked with * are required.</p>
    <?php FormHelper::input ('submit', 'submit', 'submit', array ('value' => 'Submit')); ?>
    </fieldset>
</form>