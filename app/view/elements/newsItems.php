<section class="main">
	<figure class="news">
		<img src="/img/utakmica_hrv-svi_(166).jpg" width="719" height="429" alt=""/>
		<figcaption>VIJESTI</figcaption>
	</figure>
	<?php if (isset ($newsItems)): ?>
	<section class="content">
		<?php for ($i = 0; $i < count ($newsItems); $i++): $newsItem = $newsItems[$i]; ?>
		<article>
			<time pubdate="pubdate" datetime="<?php echo $newsItem->getPublishDate ('Y-m-d'); ?>"><?php echo $newsItem->getPublishDate ('m.d.Y.'); ?></time>
			<h3><a href="<?php echo $newsItem->Url; ?>"><?php echo $newsItem->Title; ?></a></h3>
			<?php if ($i < 2): ?>
				<?php echo $newsItem->Lead; ?>
			<?php endif; ?>
		</article>
		<?php endfor; ?>
		
		<ul class="archive">
			<li><h3><a href="#"><time datetime="2011">2011</time>arhiva &gt;</a></h3></li>
			<li><h3><a href="#"><time datetime="2010">2010</time>arhiva &gt;</a></h3></li>
			<li><h3><a href="#"><time datetime="2009">2009</time>arhiva &gt;</a></h3></li>
		</ul>
	</section>
	<?php endif; ?>
</section>