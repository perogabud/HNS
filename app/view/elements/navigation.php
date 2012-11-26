<?php if (isset ($navPages)): ?>
<nav id="menu">
  <ul>
  <?php foreach ($navPages as $page): ?>
    <li><a href="<?php echo $page->Url; ?>"><?php echo $page->NavigationName; ?></a>
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
    </li>
  <?php endforeach; ?>
  	<li class="lang"><a href="" >HRV</a><a href="" >ENG</a></li>
  </ul>
</nav>
<?php endif; ?>