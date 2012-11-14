<form id="newsItemEdit" method="post"  action="">
  <fieldset>
    <legend>Edit News Item <strong><?php echo $newsItem->Title; ?></strong></legend>
    <?php TableHelper::globalMessages (); ?>
    <ul class="actions">
      <li><a href="<?php echo Config::read('siteUrlRoot') ?>admin/newsItem/view/<?php echo $newsItem->getId (); ?>"><?php TableHelper::icon ('view'); ?> View this News Item</a></li>
      <li><a href="<?php echo Config::read('siteUrlRoot') ?>admin/newsItem"><?php TableHelper::icon ('arrowLeft'); ?> Back to News Items</a></li>
    </ul>
    <?php
    FormHelper::input ('text', 'languageId', 'languageId', array ('label' => array ('text' => 'Language * '), 'value' => $newsItem->getLanguageId ()));
    FormHelper::input ('textarea', 'title', 'title', array ('label' => array ('text' => 'Title * '), 'value' => $newsItem->getTitle (), 'class' => 'simpleEditor'));
    FormHelper::input ('textarea', 'lead', 'lead', array ('label' => array ('text' => 'Lead  '), 'value' => $newsItem->getLead (), 'class' => 'editor'));
    FormHelper::input ('textarea', 'content', 'content', array ('label' => array ('text' => 'Content  '), 'value' => $newsItem->getContent (), 'class' => 'editor'));
    FormHelper::input ('checkbox', 'isPublished', 'isPublished', array ('label' => array ('text' => 'Published * '), 'checked' => $newsItem->getIsPublished ()));
    FormHelper::input ('text', 'publishDate', 'publishDate', array ('label' => array ('text' => 'Publish Date * '), 'value' => $newsItem->getPublishDate ()));
    ?>
    <p class="info">Fields marked with * are required.</p>
    <?php FormHelper::input ('submit', 'submit', 'submit', array ('value' => 'Submit')); ?>
    </fieldset>
</form>