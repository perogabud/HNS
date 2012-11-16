<?php if (isset ($navPages)): ?>
<nav>
  <ul>
  <?php foreach ($navPages as $page): ?>
    <li><a href="<?php echo $page->Url; ?>"><?php echo $page->NavigationName; ?></a></li>
    <?php if ($page->Subpages): ?>
      <ul>
      <?php foreach ($page->Subpages as $subPage): ?>
        <li>
          <a href="<?php echo $subPage->Url; ?>"><?php echo $subPage->NavigationName; ?></a>
          <small><?php echo $subPage->NavigationDescription; ?></small>
        </li>
      <?php endforeach; ?>
      </ul>
    <?php endif; ?>
  <?php endforeach; ?>
  </ul>
</nav>
<?php endif; ?>