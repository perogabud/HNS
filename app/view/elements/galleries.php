<section class="main">
<?php if (isset ($gallerys[0])): ?>
<section class="ad-gallery">
	<div class="ad-image-wrapper"></div>
  <div class="ad-controls"></div>
  <div class="ad-nav">
    <div class="ad-thumbs">
      <ul class="ad-thumb-list">
  			<?php foreach ($gallerys[0]->Images as $image): ?>
  			<li><a href="<?php echo $image->Url; ?>" ><img src="<?php echo $image->SmallThumbnailUrl; ?>" width="79" height="79" alt=""/></a></li>
  			<?php endforeach; ?>
  		</ul>
  		<small>Aktualna galerija</small>
    	<h3><?php echo $gallerys[0]->Title; ?></h3>
  	</div>
	</div>
</section>
<?php endif; ?>

<section class="content">
<?php if (isset ($gallerys)): ?>
<h2>GALERIJE</h2>
<ul class="galleries">
  <?php foreach ($gallerys as $gallery): ?>
  <li>
    <?php if ($gallery->CoverImage): ?>
    <img src="<?php echo $gallery->CoverImage->LargeThumbnailUrl; ?>" width="300" height="200" alt="Slika za novost <?php echo $gallery->Title; ?>"/>
    <?php endif; ?>
    <small><?php echo $gallery->Category; ?></small>
    <h3><a href="<?php echo $gallery->Url; ?>"><?php echo $gallery->Title; ?></a></h3>
  </li>
  <?php endforeach; ?>
</ul>
<?php endif; ?>
</section>
</section>