<?php if (isset ($gallerys)): ?>
<h3>Aktualnosti</h3>
<ul>
  <?php foreach ($gallerys as $gallery): ?>
  <li>
    <?php if ($gallery->CoverImage): ?>
    <img src="<?php echo $gallery->CoverImage->LargeThumbnailUrl; ?>" width="300" height="200" alt="Slika za novost <?php echo $gallery->Title; ?>"/>
    <?php endif; ?>
    <small><?php echo $gallery->Category; ?></small>
    <a href="<?php echo $gallery->Url; ?>"><?php echo $gallery->Title; ?></a>
  </li>
  <?php endforeach; ?>
</ul>
<?php endif; ?>