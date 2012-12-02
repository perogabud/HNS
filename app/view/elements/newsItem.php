<?php if (isset ($newsItem)): ?>
<section class="main">
  <header>
    <?php if ($newsItem->CoverImage): ?>
    <figure class="header">
    	<img src="<?php echo $newsItem->CoverImage->Url; ?>" width="719" height="429" alt="Slika za novost <?php echo $newsItem->Title; ?>"/>
    </figure>
    <?php endif; ?>
  </header>
  <section class="content">
  	<h2><?php echo $newsItem->Title; ?></h2>
    <time datetime="<?php echo $newsItem->getPublishDate ('Y-m-d'); ?>"></time>
	  <div class="lead">
	    <?php echo $newsItem->Lead; ?>
	  </div>
	  <?php echo $newsItem->Content; ?>
	  <div class="content_bottom_bg"></div>
	</section>
</section>
<?php endif; ?>
