<?php if (isset ($page)): ?>
<section>
  <header>
    <h1><?php echo $page->Title; ?></h1>
    <time datetime="<?php echo $page->getCreated ('Y-m-d'); ?>"></time>
  </header>
  <div class="lead">
    <?php echo $page->Lead; ?>
  </div>
  <?php echo $page->getContent (NULL, TRUE); ?>
</section>
<?php endif; ?>
