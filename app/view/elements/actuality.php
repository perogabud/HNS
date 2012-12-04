<?php if (isset ($actuality)): ?>
<div style="float: left;">
<section class="main">
  <header>
    <?php if ($actuality->CoverImage): ?>
    <img src="<?php echo $actuality->CoverImage->Url; ?>" width="719" height="429" alt="Slika za novost <?php echo $actuality->Title; ?>"/>
    <?php endif; ?>
    <h2><?php echo $actuality->Title; ?></h2>
    <time datetime="<?php echo $actuality->getPublishDate ('Y-m-d'); ?>"></time>
  </header>
  <section class="content">
	  <div class="lead">
	    <?php echo $actuality->Lead; ?>
	  </div>
	  <?php echo $actuality->Content; ?>
	</section>
</section>
<div style="float: left;">
<?php endif; ?>
