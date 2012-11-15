<form id="bannerEdit" method="post" enctype="multipart/form-data" action="">
  <fieldset>
    <legend>Edit Banner <strong><?php echo $banner->Name; ?></strong></legend>
    <?php TableHelper::globalMessages (); ?>
    <ul class="actions">
      <li><a href="<?php echo Config::read('siteUrlRoot') ?>admin/banner/view/<?php echo $banner->getId (); ?>"><?php TableHelper::icon ('view'); ?> View this Banner</a></li>
      <li><a href="<?php echo Config::read('siteUrlRoot') ?>admin/banner"><?php TableHelper::icon ('arrowLeft'); ?> Back to Banners</a></li>
    </ul>
    <?php
    FormHelper::input ('text', 'name', 'name', array ('label' => array ('text' => 'Name * '), 'value' => $banner->getName ()));
    FormHelper::input ('textarea', 'link', 'link', array ('label' => array ('text' => 'Link * '), 'value' => $banner->getLink ()));
    if ($banner->getImage ()) {
      echo '<div class="input"><img src="' . $banner->getImage ()->getUrl () . '" /></div>';
      FormHelper::input ('file', 'image[]', 'image', array ('label' => array ('text' => 'Image '), 'info' => 'Leave empty to keep current image.<br />The image will be resized and cropped to the following dimensions: <strong>120px width</strong> and <strong>120px height</strong>.<br/>These are also minimum dimensions.'));
      FormHelper::input ('checkbox', 'deleteImage', 'deleteImage', array ('label' => array ('text' => 'Delete image')));
    }
    else {
      FormHelper::input ('file', 'image[]', 'image', array ('label' => array ('text' => 'image ')));
    }
    ?>
    <p class="info">Fields marked with * are required.</p>
    <?php FormHelper::input ('submit', 'submit', 'submit', array ('value' => 'Submit')); ?>
    </fieldset>
</form>