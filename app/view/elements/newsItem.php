<?php if (isset ($newsItem)): ?>
<section class="main">
  <header>
    <?php if ($newsItem->CoverImage): ?>
    <img src="<?php echo $newsItem->CoverImage->Url; ?>" width="719" height="429" alt="Slika za novost <?php echo $newsItem->Title; ?>"/>
    <?php endif; ?>
    <h2><?php echo $newsItem->Title; ?></h2>
    <time datetime="<?php echo $newsItem->getPublishDate ('Y-m-d'); ?>"></time>
  </header>
  <section class="content">
	  <div class="lead">
	    <?php echo $newsItem->Lead; ?>
	  </div>
	  <?php echo $newsItem->Content; ?>
	</section>
</section>
<?php endif; ?>
