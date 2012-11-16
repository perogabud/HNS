<form id="pageAdd" method="post" enctype="multipart/form-data" action="">
  <fieldset>
    <legend>New Page</legend>
    <?php TableHelper::globalMessages (); ?>
    <ul class="actions">
      <li><a href="<?php echo Config::read('siteUrlRoot') ?>admin/page"><?php TableHelper::icon ('arrowLeft'); ?> Back to Pages</a></li>
    </ul>
    <?php
    FormHelper::input (Config::read ('debug') ? 'checkbox' : 'hidden', 'isException', 'isException', array ('label' => array ('text' => 'Exception  [DEBUG]')));
    FormHelper::input (Config::read ('debug') ? 'checkbox' : 'hidden', 'isVisible', 'isVisible', array ('label' => array ('text' => 'Visible  [DEBUG]')));
    FormHelper::input (Config::read ('debug') ? 'checkbox' : 'hidden', 'isEditable', 'isEditable', array ('label' => array ('text' => 'Editable  [DEBUG]')));
    FormHelper::input (Config::read ('debug') ? 'checkbox' : 'hidden', 'isPublished', 'isPublished', array ('label' => array ('text' => 'Objavljeno  [DEBUG]')));
    FormHelper::input (Config::read ('debug') ? 'checkbox' : 'hidden', 'canAddChildren', 'canAddChildren', array ('label' => array ('text' => 'Can Add Children  [DEBUG]')));
    FormHelper::input (Config::read ('debug') ? 'checkbox' : 'hidden', 'canBeDeleted', 'canBeDeleted', array ('label' => array ('text' => 'Can Be Deleted  [DEBUG]')));
    FormHelper::input (Config::read ('debug') ? 'text' : 'hidden', 'class', 'class', array ('label' => array ('text' => 'Class  [DEBUG]')));
    FormHelper::input ('file', 'coverImage[]', 'coverImage', array ('label' => array ('text' => 'Cover Image '), 'info' => 'The image will be resized and cropped to the following dimensions: <strong>719px width</strong> and <strong>429px height</strong>.<br/>These are also minimum dimensions.'));
    echo '<div class="tabs">';
    $this->getElement ('admin/languageTabs');
    foreach (Config::read ('supportedLangs') as $lang) {
      echo '<div id="tabs-'.$lang.'">';
      echo '<h3 class="langContent">Data in '. Config::read ("langNamesEnglish", $lang) .' Jezik</h3>';
      FormHelper::input ('textarea', 'title', 'title', array ('label' => array ('text' => 'Naslov * '), 'lang' => $lang, 'class' => 'simpleEditor'));
      FormHelper::input ('textarea', 'navigationName', 'navigationName', array ('label' => array ('text' => 'Navigation Name * '), 'lang' => $lang, 'class' => 'simpleEditor'));
      FormHelper::input ('textarea', 'navigationDescription', 'navigationDescription', array ('label' => array ('text' => 'Navigation Description  '), 'lang' => $lang, 'class' => 'simpleEditor'));
      FormHelper::input ('textarea', 'lead', 'lead', array ('label' => array ('text' => 'Uvodni tekst  '), 'lang' => $lang, 'class' => 'editor'));
      FormHelper::input ('textarea', 'content', 'content', array ('label' => array ('text' => 'Content  '), 'lang' => $lang, 'class' => 'editor'));
      FormHelper::input ('text', 'metaTitle', 'metaTitle', array ('label' => array ('text' => 'Meta Naslov  '), 'lang' => $lang));
    FormHelper::input ('textarea', 'metaDescription', 'metaDescription', array ('label' => array ('text' => 'Meta Description  ')));
      FormHelper::input ('text', 'metaKeywords', 'metaKeywords', array ('label' => array ('text' => 'Meta Keywords  '), 'lang' => $lang));
      echo '</div>';
    }
    echo '</div>';
    ?>
    <p class="info">Polja označena sa zvijezdicom (*) moraju biti ispunjena.</p>
    <?php FormHelper::input ('submit', 'submit', 'submit', array ('value' => 'Spremi')); ?>
    </fieldset>
</form>