<section class="main">
<?php if (isset ($page)): ?>
  <?php if ($page->CoverImage): ?>
  <img src="<?php echo $page->CoverImage->Url; ?>" width="720" height="430" alt=""/>
  <?php else: ?>
  <img src="http://placehold.it/719x429/E30101/FFFFFF&text=<?php echo urlencode ($page->Title); ?>" width="719" height="429" alt=""/>
  <?php endif; ?>
<section class="subpage">
  <h2 style="margin-top: 1em; font: 2em Oswald, sans-serif; color: #005ca8;"><?php echo $page->Title; ?></h2>
  <time datetime="<?php echo $page->getCreated ('Y-m-d'); ?>"></time>
  <div class="lead">
    <?php echo $page->Lead; ?>
  </div>
  <?php echo $page->getContent (NULL, TRUE); ?>
</section>
<?php endif; ?>
</section>