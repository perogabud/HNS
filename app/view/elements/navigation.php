<nav id="menu">

  <?php if (isset ($navPages)): ?>
	<ul>
      <?php foreach ($navPages as $page): ?>
        <li><a href="<?php echo $page->Url; ?>"><?php echo $page->NavigationName; ?></a>
        <?php if ($page->Subpages): ?>
          <ul>
              <?php $count = count ($page->Subpages); for ($i = 0; $i < $count; $i++): $subPage = $page->Subpages[$i]; ?>
                <li>
                  <a href="<?php echo $subPage->Url; ?>"><?php echo $subPage->NavigationName; ?></a>
                  <small><?php echo $subPage->NavigationDescription; ?></small>
                </li>
              <?php endfor; ?>
          </ul>
        <?php endif; ?>
        </li>
      <?php endforeach; ?>
      <li class="lang"><a href="#" class="hr">HRV</a> <a href="#" class="en">ENG</a></li>
    </ul>
  <?php endif; ?>

</nav>