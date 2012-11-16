<?php if (isset ($actuality)): ?>
<section>
  <header>
    <?php if ($actuality->CoverImage): ?>
    <img src="<?php echo $actuality->CoverImage->Url; ?>" width="719" height="429" alt="Slika za novost <?php echo $actuality->Title; ?>"/>
    <?php endif; ?>
    <h1><?php echo $actuality->Title; ?></h1>
    <time datetime="<?php echo $actuality->getPublishDate ('Y-m-d'); ?>"></time>
  </header>
  <div class="lead">
    <?php echo $actuality->Lead; ?>
  </div>
  <?php echo $actuality->Content; ?>
</section>
<?php endif; ?>
