<div class="column">
  <fieldset>
    <legend>Banner <strong><?php echo $banner->Name; ?></strong></legend>
    <?php TableHelper::globalMessages (); ?>
    <ul class="actions">
      <li><a href="<?php echo Config::read('siteUrlRoot') ?>admin/banner"><?php TableHelper::icon ('arrowLeft'); ?> Back to Banners</a></li>
      <li><a href="/admin/banner/edit/<?php echo $banner->Id; ?>"><?php TableHelper::icon ('edit'); ?> Edit this Banner</a></li>
    </ul>
    <dl class="info">
      <dt>Name</dt>
      <?php if ($banner->getName ()): ?>
      <dd><?php echo $banner->getName (); ?></dd>
      <?php endif; ?>
      <dt>Link</dt>
      <?php if ($banner->getLink ()): ?>
      <dd><?php echo $banner->getLink (); ?></dd>
      <?php endif; ?>
      <?php foreach (Config::read ('supportedLangs') as $lang): ?>
      <?php endforeach; ?>
      <dt>Image</dt>
      <dd class="check"><img src="<?php echo $banner->getImage () ? $banner->getImage ()->getUrl () : ''; ?>" /></dd>
      <dt>Created On</dt>
      <dd>
        <?php echo $banner->Created; ?>
      </dd>
      <dt>Modified On</dt>
      <dd>
        <?php echo $banner->Created == $banner->Created ? $banner->Modified : '-'; ?>
      </dd>
    </dl>
    <div>
    </div>
  </fieldset>
</div>