<section class="main">
<?php if (isset ($actualitys)): ?>
<section class="content actualities">
  <h2>AKTUALNOSTI</h2>
  <?php for ($i = 0; $i < count ($actualitys); $i++): $actuality = $actualitys[$i]; ?>
  <article>
    <?php if($i < 2) : ?>
			<time pubdate="pubdate" datetime="<?php echo $actuality->getPublishDate ('Y-m-d'); ?>"><?php echo $actuality->getPublishDate ('m.d.') ?> <br /> <?php echo $actuality->getPublishDate ('Y.'); ?></time>
			<?php else : ?>
			<time pubdate="pubdate" datetime="<?php echo $actuality->getPublishDate ('Y-m-d'); ?>"><?php echo $actuality->getPublishDate ('m.d.Y.'); ?></time>
			<?php endif; ?>
    <h3><a href="<?php echo $actuality->Url; ?>"><?php echo $actuality->Title; ?></a></h3>
    
		<?php if ($i < 2): ?>
			<?php echo $actuality->Lead; ?>
		<?php endif; ?>
		<div style="clear: both;"></div>
  </article>
  <?php endfor; ?>
  <div class="content_bottom_bg"></div>
</section>
<?php endif; ?>
</section>