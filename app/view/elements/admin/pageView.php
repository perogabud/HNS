<div class="column">
  <fieldset>
    <legend>Page <strong><?php echo $page->NavigationName; ?></strong></legend>
    <?php TableHelper::globalMessages (); ?>
    <ul class="actions">
      <li><a href="<?php echo Config::read('siteUrlRoot') ?>admin/page"><?php TableHelper::icon ('arrowLeft'); ?> Back to Pages</a></li>
      <li><a href="/admin/page/edit/<?php echo $page->Id; ?>"><?php TableHelper::icon ('edit'); ?> Edit this Page</a></li>
    </ul>
    <dl class="info">
      <?php if (Config::read ('debug')): ?>
      <dt>Exception</dt>
      <dd class="check"><?php TableHelper::iconYesNo ($page->getIsException ()); ?></dd>
      <?php endif; ?>
      <?php if (Config::read ('debug')): ?>
      <dt>Visible</dt>
      <dd class="check"><?php TableHelper::iconYesNo ($page->getIsVisible ()); ?></dd>
      <?php endif; ?>
      <?php if (Config::read ('debug')): ?>
      <dt>Editable</dt>
      <dd class="check"><?php TableHelper::iconYesNo ($page->getIsEditable ()); ?></dd>
      <?php endif; ?>
      <?php if (Config::read ('debug')): ?>
      <dt>Published</dt>
      <dd class="check"><?php TableHelper::iconYesNo ($page->getIsPublished ()); ?></dd>
      <?php endif; ?>
      <?php if (Config::read ('debug')): ?>
      <dt>Can Add Children</dt>
      <dd class="check"><?php TableHelper::iconYesNo ($page->getCanAddChildren ()); ?></dd>
      <?php endif; ?>
      <?php if (Config::read ('debug')): ?>
      <dt>Can Add Children</dt>
      <dd class="check"><?php TableHelper::iconYesNo ($page->getCanBeDeleted ()); ?></dd>
      <?php endif; ?>
      <?php if (Config::read ('debug')): ?>
      <dt>Class</dt>
      <?php if ($page->getClass ()): ?>
      <dd><?php echo $page->getClass (); ?></dd>
      <?php endif; ?>
      <?php endif; ?>
      <?php if ($page->CoverImage): ?>
      <dt>Cover Image</dt>
      <dd class="check"><img src="<?php echo $page->getCoverImage () ? $page->getCoverImage ()->getUrl () : ''; ?>" /></dd>
      <?php endif; ?>
      <?php foreach (Config::read ('supportedLangs') as $lang): ?>
      <dt<?php echo !$page->getTitle ($lang) ? ' class="empty"' : '' ?>>Title [<?php echo strtoupper ($lang); ?>]</dt>
      <?php if ($page->getTitle ($lang)): ?>
      <dd><?php echo $page->getTitle ($lang); ?></dd>
      <?php endif; ?>
      <dt<?php echo !$page->getNavigationName ($lang) ? ' class="empty"' : '' ?>>Navigation Name [<?php echo strtoupper ($lang); ?>]</dt>
      <?php if ($page->getNavigationName ($lang)): ?>
      <dd><?php echo $page->getNavigationName ($lang); ?></dd>
      <?php endif; ?>
      <dt<?php echo !$page->getContent ($lang) ? ' class="empty"' : '' ?>>Content [<?php echo strtoupper ($lang); ?>]</dt>
      <?php if ($page->getContent ($lang)): ?>
      <dd><?php echo $page->getContent ($lang); ?></dd>
      <?php endif; ?>
      <dt<?php echo !$page->getLead ($lang) ? ' class="empty"' : '' ?>>Lead [<?php echo strtoupper ($lang); ?>]</dt>
      <?php if ($page->getLead ($lang)): ?>
      <dd><?php echo $page->getLead ($lang); ?></dd>
      <?php endif; ?>
      <dt<?php echo !$page->getMetaTitle ($lang) ? ' class="empty"' : '' ?>>Meta Title [<?php echo strtoupper ($lang); ?>]</dt>
      <?php if ($page->getMetaTitle ($lang)): ?>
      <dd><?php echo $page->getMetaTitle ($lang); ?></dd>
      <?php endif; ?>
      <dt<?php echo !$page->getMetaDescription ($lang) ? ' class="empty"' : '' ?>>Meta Description [<?php echo strtoupper ($lang); ?>]</dt>
      <?php if ($page->getMetaDescription ($lang)): ?>
      <dd><?php echo $page->getMetaDescription ($lang); ?></dd>
      <?php endif; ?>
      <dt<?php echo !$page->getMetaKeywords ($lang) ? ' class="empty"' : '' ?>>Meta Keywords [<?php echo strtoupper ($lang); ?>]</dt>
      <?php if ($page->getMetaKeywords ($lang)): ?>
      <dd><?php echo $page->getMetaKeywords ($lang); ?></dd>
      <?php endif; ?>
      <?php if (Config::read ('debug')): ?>
      <?php endif; ?>
      <?php if (Config::read ('debug')): ?>
      <?php endif; ?>
      <?php if (Config::read ('debug')): ?>
      <?php endif; ?>
      <?php if (Config::read ('debug')): ?>
      <?php endif; ?>
      <?php if (Config::read ('debug')): ?>
      <?php endif; ?>
      <?php if (Config::read ('debug')): ?>
      <?php endif; ?>
      <?php if (Config::read ('debug')): ?>
      <?php endif; ?>
      <dt<?php echo !$page->getNavigationDescription ($lang) ? ' class="empty"' : '' ?>>Navigation Description [<?php echo strtoupper ($lang); ?>]</dt>
      <?php if ($page->getNavigationDescription ($lang)): ?>
      <dd><?php echo $page->getNavigationDescription ($lang); ?></dd>
      <?php endif; ?>
      <?php endforeach; ?>
      <dt>Created On</dt>
      <dd>
        <?php echo $page->Created; ?>
      </dd>
      <dt>Modified On</dt>
      <dd>
        <?php echo $page->Created == $page->Created ? $page->Modified : '-'; ?>
      </dd>
    </dl>
    <div>
    </div>
  </fieldset>
</div>