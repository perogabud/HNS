<?php if (isset ($newsItem)): ?>
<section>
  <header>
    <?php if ($newsItem->CoverImage): ?>
    <img src="<?php echo $newsItem->CoverImage->Url; ?>" width="719" height="429" alt="Slika za novost <?php echo $newsItem->Title; ?>"/>
    <?php endif; ?>
    <h1><?php echo $newsItem->Title; ?></h1>
    <time datetime="<?php echo $newsItem->getPublishDate ('Y-m-d'); ?>"></time>
  </header>
  <div class="lead">
    <?php echo $newsItem->Lead; ?>
  </div>
  <?php echo $newsItem->Content; ?>
</section>
<?php endif; ?>
