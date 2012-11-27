<?php if (isset ($page)): ?>
<section class="subpage">
  <?php if ($page->CoverImage): ?>
  <img src="<?php echo $page->CoverImage->Url; ?>" width="719" height="429" alt=""/>
  <?php else: ?>
  <img src="http://placehold.it/719x429/E30101/FFFFFF&text=<?php echo urlencode ($page->Title); ?>" width="719" height="429" alt=""/>
  <?php endif; ?>
  <h2 style="margin-top: 1em; font-size: 2em;"><?php echo $page->Title; ?></h2>
  <time datetime="<?php echo $page->getCreated ('Y-m-d'); ?>"></time>
  <div class="lead">
    <?php echo $page->Lead; ?>
  </div>
  <?php echo $page->getContent (NULL, TRUE); ?>
</section>
<?php endif; ?>
