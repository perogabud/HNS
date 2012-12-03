<section class="main">
	<figure class="news header">
		<img src="/img/utakmica_hrv-svi_(166).jpg" width="719" height="429" alt=""/>
	</figure>
	<?php if (isset ($actualitys)): ?>
	<section class="content actualities">
	  <h2>AKTUALNOSTI</h2>
	  <?php for ($i = 0; $i < count ($actualitys); $i++): $actuality = $actualitys[$i]; ?>
	  <article>
	    <?php if($i < 2) : ?>
				<time pubdate="pubdate" datetime="<?php echo $actuality->getPublishDate ('Y-m-d'); ?>"><?php echo $actuality->getPublishDate ('d.m.') ?> <br /> <?php echo $actuality->getPublishDate ('Y.'); ?></time>
				<?php else : ?>
				<time pubdate="pubdate" datetime="<?php echo $actuality->getPublishDate ('Y-m-d'); ?>"><?php echo $actuality->getPublishDate ('d.m.Y.'); ?></time>
				<?php endif; ?>
	    <h3><a href="<?php echo $actuality->Url; ?>"><?php echo $actuality->Title; ?></a></h3>
	    
			<?php if ($i < 2): ?>
				<?php echo $actuality->Lead; ?>
			<?php endif; ?>
			<div style="clear: both;"></div>
	  </article>
	  <?php endfor; ?>
	</section>
	<?php endif; ?>
	<div class="content_bottom_bg"></div>
</section>