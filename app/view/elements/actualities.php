<?php if (isset ($actualitys)): ?>
<h3>Aktualnosti</h3>
<ul>
  <?php foreach ($actualitys as $actuality): ?>
  <li>
    <?php if ($actuality->CoverImage): ?>
    <img src="<?php echo $actuality->CoverImage->LargeThumbnailUrl; ?>" width="300" height="200" alt="Slika za novost <?php echo $actuality->Title; ?>"/>
    <?php endif; ?>
    <a href="<?php echo $actuality->Url; ?>"><?php echo $actuality->Title; ?></a>
    <small><time datetime="<?php echo $actuality->getPublishDate ('Y-m-d'); ?>"><?php echo $actuality->getPublishDate ('d.m.Y.'); ?></time></small>
    <?php echo $actuality->Lead; ?>
  </li>
  <?php endforeach; ?>
</ul>
<?php endif; ?>