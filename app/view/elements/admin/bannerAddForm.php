<form id="bannerAdd" method="post" enctype="multipart/form-data" action="">
  <fieldset>
    <legend>New Banner</legend>
    <?php TableHelper::globalMessages (); ?>
    <ul class="actions">
      <li><a href="<?php echo Config::read('siteUrlRoot') ?>admin/banner"><?php TableHelper::icon ('arrowLeft'); ?> Back to Banners</a></li>
    </ul>
    <?php
    FormHelper::input ('text', 'name', 'name', array ('label' => array ('text' => 'Name * ')));
    FormHelper::input ('textarea', 'link', 'link', array ('label' => array ('text' => 'Link * ')));
    FormHelper::input ('file', 'image[]', 'image', array ('label' => array ('text' => 'Image '), 'info' => 'The image will be resized and cropped to the following dimensions: <strong>120px width</strong> and <strong>120px height</strong>.<br/>These are also minimum dimensions.'));
    ?>
    <p class="info">Polja označena sa zvijezdicom (*) moraju biti ispunjena.</p>
    <?php FormHelper::input ('submit', 'submit', 'submit', array ('value' => 'Spremi')); ?>
    </fieldset>
</form>