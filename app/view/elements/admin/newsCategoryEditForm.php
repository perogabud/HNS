<form id="newsItemEdit" method="post" enctype="multipart/form-data" action="">
  <fieldset>
    <legend>Uredi kategoriju <strong><?php echo $newsCategory->Title; ?></strong></legend>
    <?php TableHelper::globalMessages (); ?>
    <ul class="actions">
      <li><a href="<?php echo Config::read('siteUrlRoot') ?>admin/newsCategory/view/<?php echo $newsCategory->getId (); ?>"><?php TableHelper::icon ('view'); ?> Pregledaj ovu kategoriju</a></li>
      <li><a href="<?php echo Config::read('siteUrlRoot') ?>admin/newsCategory"><?php TableHelper::icon ('arrowLeft'); ?> Natrag na kategorije</a></li>
    </ul>
    <?php
    FormHelper::input ('text', 'title', 'title', array ('label' => array ('text' => 'Naslov kategorije * '), 'value' => $newsCategory->getTitle ()));
    ?>
    <p class="info">Polja označena sa zvijezdicom (*) moraju biti ispunjena.</p>
    <?php FormHelper::input ('submit', 'submit', 'submit', array ('value' => 'Spremi')); ?>
    </fieldset>
</form>