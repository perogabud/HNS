<form id="newsItemEdit" method="post" enctype="multipart/form-data" action="">
  <fieldset>
    <legend>Edit News Item <strong><?php echo $newsItem->Title; ?></strong></legend>
    <?php TableHelper::globalMessages (); ?>
    <ul class="actions">
      <li><a href="<?php echo Config::read('siteUrlRoot') ?>admin/newsItem/view/<?php echo $newsItem->getId (); ?>"><?php TableHelper::icon ('view'); ?> View this News Item</a></li>
      <li><a href="<?php echo Config::read('siteUrlRoot') ?>admin/newsItem"><?php TableHelper::icon ('arrowLeft'); ?> Back to News Items</a></li>
    </ul>
    <?php
    FormHelper::select ('languageId', 'languageId', 'Language *', $languages, $newsItem->getLanguage ());
    FormHelper::input ('textarea', 'title', 'title', array ('label' => array ('text' => 'Title * '), 'value' => $newsItem->getTitle (), 'class' => 'simpleEditor'));
    FormHelper::input ('textarea', 'lead', 'lead', array ('label' => array ('text' => 'Lead  '), 'value' => $newsItem->getLead (), 'class' => 'editor'));
    FormHelper::input ('textarea', 'content', 'content', array ('label' => array ('text' => 'Content  '), 'value' => $newsItem->getContent (), 'class' => 'editor'));
    FormHelper::input ('checkbox', 'isPublished', 'isPublished', array ('label' => array ('text' => 'Published * '), 'checked' => $newsItem->getIsPublished ()));
    FormHelper::input ('text', 'publishDate', 'publishDate', array ('label' => array ('text' => 'Publish Date * '), 'class' => 'date', 'value' => $newsItem->getPublishDate ()));
    if ($newsItem->getCoverImage ()) {
      echo '<div class="input"><img src="' . $newsItem->getCoverImage ()->getUrl () . '" /></div>';
      FormHelper::input ('file', 'coverImage[]', 'coverImage', array ('label' => array ('text' => 'Cover Image '), 'info' => 'Leave empty to keep current image.<br />The image will be resized and cropped to the following dimensions: <strong>729px width</strong> and <strong>429px height</strong>.<br/>These are also minimum dimensions.'));
      FormHelper::input ('checkbox', 'deleteCoverImage', 'deleteCoverImage', array ('label' => array ('text' => 'Delete coverImage')));
    }
    else {
      FormHelper::input ('file', 'coverImage[]', 'coverImage', array ('label' => array ('text' => 'Cover Image '), 'info' => 'The image will be resized and cropped to the following dimensions: <strong>719px width</strong> and <strong>429px height</strong>.<br/>These are also minimum dimensions.'));
    }
    ?>
    <p class="info">Polja označena sa zvijezdicom (*) moraju biti ispunjena.</p>
    <?php FormHelper::input ('submit', 'submit', 'submit', array ('value' => 'Spremi')); ?>
    </fieldset>
</form>