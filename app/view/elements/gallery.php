<?php if (isset ($gallery)): ?>
<section>
  <header>
    <?php if ($gallery->CoverImage): ?>
    <img src="<?php echo $gallery->CoverImage->Url; ?>" width="719" height="429" alt="Slika za novost <?php echo $gallery->Title; ?>"/>
    <?php endif; ?>
    <h1><?php echo $gallery->Title; ?></h1>

  </header>
  <?php foreach ($gallery->Images as $image): ?>
  <div>
    <img src="<?php echo $image->Url; ?>" width="719" height="429" alt=""/>
    <img src="<?php echo $image->LargeThumbnailUrl; ?>" width="300" height="200" alt=""/>
    <img src="<?php echo $image->SmallThumbnailUrl; ?>" width="79" height="79" alt=""/>
  </div>
  <?php endforeach; ?>
</section>
<?php endif; ?>
