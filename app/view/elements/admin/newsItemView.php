<div class="column">
  <fieldset>
    <legend>News Item <strong><?php echo $newsItem->Title; ?></strong></legend>
    <?php TableHelper::globalMessages (); ?>
    <ul class="actions">
      <li><a href="<?php echo Config::read('siteUrlRoot') ?>admin/newsItem"><?php TableHelper::icon ('arrowLeft'); ?> Back to News Items</a></li>
      <li><a href="/admin/newsItem/edit/<?php echo $newsItem->Id; ?>"><?php TableHelper::icon ('edit'); ?> Edit this News Item</a></li>
    </ul>
    <dl class="info">
      <dt>Language</dt>
      <?php if ($newsItem->getLanguage ()): ?>
      <dd><?php echo $newsItem->getLanguage ()->getName(); ?></dd>
      <?php endif; ?>
      <dt>Title</dt>
      <?php if ($newsItem->getTitle ()): ?>
      <dd><?php echo $newsItem->getTitle (); ?></dd>
      <?php endif; ?>
      <dt>Lead</dt>
      <?php if ($newsItem->getLead ()): ?>
      <dd><?php echo $newsItem->getLead (); ?></dd>
      <?php endif; ?>
      <dt>Content</dt>
      <?php if ($newsItem->getContent ()): ?>
      <dd><?php echo $newsItem->getContent (); ?></dd>
      <?php endif; ?>
      <dt>Published</dt>
      <dd class="check"><?php TableHelper::iconYesNo ($newsItem->getIsPublished ()); ?></dd>
      <dt>Publish Date</dt>
      <?php if ($newsItem->getPublishDate ()): ?>
      <dd><?php echo $newsItem->getPublishDate (); ?></dd>
      <?php endif; ?>
      <?php foreach (Config::read ('supportedLangs') as $lang): ?>
      <?php endforeach; ?>
      <?php if ($newsItem->CoverImage): ?>
      <dt>Cover Image</dt>
      <dd class="check"><img src="<?php echo $newsItem->getCoverImage () ? $newsItem->getCoverImage ()->getUrl () : ''; ?>" /></dd>
      <?php endif; ?>
      <dt>Created On</dt>
      <dd>
        <?php echo $newsItem->Created; ?>
      </dd>
      <dt>Modified On</dt>
      <dd>
        <?php echo $newsItem->Created == $newsItem->Created ? $newsItem->Modified : '-'; ?>
      </dd>
    </dl>
    <div>
    </div>
  </fieldset>
</div>