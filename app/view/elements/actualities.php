<section class="main">
<?php if (isset ($actualitys)): ?>
<section class="content actualities">
  <h2>AKTUALNOSTI</h2>
  <?php foreach ($actualitys as $actuality): ?>
  <article>
    <time pubdate="pubdate" datetime="<?php echo $actuality->getPublishDate ('Y-m-d'); ?>"><?php echo $actuality->getPublishDate ('d.m.Y.'); ?></time>
    <h3><a href="<?php echo $actuality->Url; ?>"><?php echo $actuality->Title; ?></a></h3>
    <?php echo $actuality->Lead; ?>
  </article>
  <?php endforeach; ?>
</ul>
<?php endif; ?>
</section>
