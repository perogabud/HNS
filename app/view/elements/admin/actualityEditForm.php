<form id="actualityEdit" method="post"  action="">
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
    ?>
    <p class="info">Fields marked with * are required.</p>
    <?php FormHelper::input ('submit', 'submit', 'submit', array ('value' => 'Submit')); ?>
    </fieldset>
</form>