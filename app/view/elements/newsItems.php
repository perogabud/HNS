<?php if (isset ($newsItems)): ?>
<h3>Novosti</h3>
<ul>
  <?php foreach ($newsItems as $newsItem): ?>
  <li>
    <?php if ($newsItem->CoverImage): ?>
    <img src="<?php echo $newsItem->CoverImage->LargeThumbnailUrl; ?>" width="300" height="200" alt="Slika za novost <?php echo $newsItem->Title; ?>"/>
    <?php endif; ?>
    <a href="<?php echo $newsItem->Url; ?>"><?php echo $newsItem->Title; ?></a>
    <small><time datetime="<?php echo $newsItem->getPublishDate ('Y-m-d'); ?>"><?php echo $newsItem->getPublishDate ('d.m.Y.'); ?></time></small>
    <?php echo $newsItem->Lead; ?>
  </li>
  <?php endforeach; ?>
</ul>
<?php endif; ?>