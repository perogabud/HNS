<?php if (isset ($actuality)): ?>
<section class="main">
  <header>
    <?php if ($actuality->CoverImage): ?>
    <figure class="header">
    	<img src="<?php echo $actuality->CoverImage->Url; ?>" width="719" height="429" alt="Slika za novost <?php echo $actuality->Title; ?>"/>
    </figure>
    <?php else: ?>
    <figure class="header">
    	<img src="/img/actuality.jpg" width="719" height="429" alt="Slika za novost <?php echo $actuality->Title; ?>"/>
    </figure>
    <?php endif; ?>
  </header>
  <section class="content">
    <h2><?php echo $actuality->Title; ?></h2>
    <time datetime="<?php echo $actuality->getPublishDate ('Y-m-d'); ?>"></time>
	  <div class="lead">
	    <?php echo $actuality->Lead; ?>
	  </div>
	  <?php echo $actuality->Content; ?>
	</section>
	<div class="content_bottom_bg"></div>
</section>
<?php endif; ?>