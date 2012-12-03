<section class="main">
<?php if (isset ($page)): ?>
	<header>
		<figure class="header">
		  <?php if ($page->CoverImage): ?>
		  <img src="<?php echo $page->CoverImage->Url; ?>" width="719" height="429" alt=""/>
		  <?php else: ?>
		  <img src="/img/default.jpg" width="719" height="429" alt="<?php echo $page->Title; ?>"/>
		  <?php endif; ?>
		</figure>
  </header>
  <?php if (!isset ($newsItems)): ?>
	<section class="subpage">
	  <h2><?php echo $page->Title; ?></h2>
	  <time datetime="<?php echo $page->getCreated ('Y-m-d'); ?>"></time>
	  <div class="lead">
	    <?php echo $page->Lead; ?>
	  </div>
	  <?php echo $page->getContent (NULL, TRUE); ?>
	</section>
  <?php else: ?>
	<section class="content actualities">
		<h2><?php echo $page->Title; ?></h2>
		<?php for ($i = 0; $i < count ($newsItems); $i++): $newsItem = $newsItems[$i]; ?>
		<article>
			<?php if($i < 2) : ?>
			<time pubdate="pubdate" datetime="<?php echo $newsItem->getPublishDate ('Y-m-d'); ?>"><?php echo $newsItem->getPublishDate ('d.m.') ?> <br /> <?php echo $newsItem->getPublishDate ('Y.'); ?></time>
			<?php else : ?>
			<time pubdate="pubdate" datetime="<?php echo $newsItem->getPublishDate ('Y-m-d'); ?>"><?php echo $newsItem->getPublishDate ('d.m.Y.'); ?></time>
			<?php endif; ?>
			<h3><a href="<?php echo $newsItem->Url; ?>"><?php echo $newsItem->Title; ?></a></h3>
			<?php if ($i < 2): ?>
				<?php echo $newsItem->Lead; ?>
			<?php endif; ?>
			<div style="clear: both;"></div>
		</article>
		<?php endfor; ?>
		
		<!--<ul class="archive">
			<li><h3><a href="#"><time datetime="2011">2011</time>arhiva &gt;</a></h3></li>
			<li><h3><a href="#"><time datetime="2010">2010</time>arhiva &gt;</a></h3></li>
			<li><h3><a href="#"><time datetime="2009">2009</time>arhiva &gt;</a></h3></li>
		</ul>-->
		<div class="content_bottom_bg"></div>
	</section>
	<?php endif; ?>
	<?php endif; ?>
	<div class="content_bottom_bg"></div>
</section>
