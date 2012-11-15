<form id="pageEdit" method="post" enctype="multipart/form-data" action="">
  <fieldset>
    <legend>Edit Page <strong><?php echo $page->NavigationName; ?></strong></legend>
    <?php TableHelper::globalMessages (); ?>
    <ul class="actions">
      <li><a href="<?php echo Config::read('siteUrlRoot') ?>admin/page/view/<?php echo $page->getId (); ?>"><?php TableHelper::icon ('view'); ?> View this Page</a></li>
      <li><a href="<?php echo Config::read('siteUrlRoot') ?>admin/page"><?php TableHelper::icon ('arrowLeft'); ?> Back to Pages</a></li>
    </ul>
    <?php
    FormHelper::input (Config::read ('debug') ? 'checkbox' : 'hidden', 'isException', 'isException', array ('label' => array ('text' => 'Exception * [DEBUG]'), 'checked' => $page->getIsException ()));
    FormHelper::input (Config::read ('debug') ? 'checkbox' : 'hidden', 'isVisible', 'isVisible', array ('label' => array ('text' => 'Visible * [DEBUG]'), 'checked' => $page->getIsVisible ()));
    FormHelper::input (Config::read ('debug') ? 'checkbox' : 'hidden', 'isEditable', 'isEditable', array ('label' => array ('text' => 'Editable * [DEBUG]'), 'checked' => $page->getIsEditable ()));
    FormHelper::input (Config::read ('debug') ? 'checkbox' : 'hidden', 'isPublished', 'isPublished', array ('label' => array ('text' => 'Published * [DEBUG]'), 'checked' => $page->getIsPublished ()));
    FormHelper::input (Config::read ('debug') ? 'checkbox' : 'hidden', 'canAddChildren', 'canAddChildren', array ('label' => array ('text' => 'Can Add Children * [DEBUG]'), 'checked' => $page->getCanAddChildren ()));
    FormHelper::input (Config::read ('debug') ? 'checkbox' : 'hidden', 'canBeDeleted', 'canBeDeleted', array ('label' => array ('text' => 'Can Add Children * [DEBUG]'), 'checked' => $page->getCanBeDeleted ()));
    FormHelper::input (Config::read ('debug') ? 'text' : 'hidden', 'class', 'class', array ('label' => array ('text' => 'Class  [DEBUG]'), 'value' => $page->getClass ()));
    if ($page->getCoverImage ()) {
      echo '<div class="input"><img src="' . $page->getCoverImage ()->getUrl () . '" /></div>';
      FormHelper::input ('file', 'coverImage[]', 'coverImage', array ('label' => array ('text' => 'Cover Image '), 'info' => 'Leave empty to keep current image.<br />The image will be resized and cropped to the following dimensions: <strong>719px width</strong> and <strong>429px height</strong>.<br/>These are also minimum dimensions.'));
      FormHelper::input ('checkbox', 'deleteCoverImage', 'deleteCoverImage', array ('label' => array ('text' => 'Delete coverImage')));
    }
    else {
      FormHelper::input ('file', 'coverImage[]', 'coverImage', array ('label' => array ('text' => 'Cover Image '), 'info' => 'The image will be resized and cropped to the following dimensions: <strong>719px width</strong> and <strong>429px height</strong>.<br/>These are also minimum dimensions.'));
    }
    foreach (Config::read ('supportedLangs') as $lang) {
      echo '<h3 class="langContent">Data in '. Config::read ("langNamesEnglish", $lang) .' Language</h3>';
      FormHelper::input ('textarea', 'title', 'title', array ('label' => array ('text' => 'Title * '), 'lang' => $lang, 'value' => $page->getTitle ($lang), 'class' => 'simpleEditor'));
      FormHelper::input ('textarea', 'navigationName', 'navigationName', array ('label' => array ('text' => 'Navigation Name * '), 'lang' => $lang, 'value' => $page->getNavigationName ($lang), 'class' => 'simpleEditor'));
      FormHelper::input ('textarea', 'navigationDescription', 'navigationDescription', array ('label' => array ('text' => 'Navigation Description  '), 'lang' => $lang, 'value' => $page->getNavigationDescription ($lang), 'class' => 'simpleEditor'));
      FormHelper::input ('textarea', 'lead', 'lead', array ('label' => array ('text' => 'Lead  '), 'lang' => $lang, 'value' => $page->getLead ($lang), 'class' => 'editor'));
      FormHelper::input ('textarea', 'content', 'content', array ('label' => array ('text' => 'Content  '), 'lang' => $lang, 'value' => $page->getContent ($lang), 'class' => 'editor'));
      FormHelper::input ('text', 'metaTitle', 'metaTitle', array ('label' => array ('text' => 'Meta Title  '), 'value' => $page->getMetaTitle ($lang), 'lang' => $lang));
      FormHelper::input ('textarea', 'metaDescription', 'metaDescription', array ('label' => array ('text' => 'Meta Description  '), 'value' => $page->getMetaDescription ($lang), 'lang' => $lang));
      FormHelper::input ('text', 'metaKeywords', 'metaKeywords', array ('label' => array ('text' => 'Meta Keywords  '), 'value' => $page->getMetaKeywords ($lang), 'lang' => $lang));
    }
    ?>
    <p class="info">Fields marked with * are required.</p>
    <?php FormHelper::input ('submit', 'submit', 'submit', array ('value' => 'Submit')); ?>
    </fieldset>
</form>