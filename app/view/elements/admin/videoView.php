<div class="column">
  <fieldset>
    <legend>Video <strong><?php echo $video->Title; ?></strong></legend>
    <?php TableHelper::globalMessages (); ?>
    <ul class="actions">
      <li><a href="<?php echo Config::read('siteUrlRoot') ?>admin/video"><?php TableHelper::icon ('arrowLeft'); ?> Back to Videos</a></li>
      <li><a href="/admin/video/edit/<?php echo $video->Id; ?>"><?php TableHelper::icon ('edit'); ?> Edit this Video</a></li>
    </ul>
    <dl class="info">
      <dt>Youtube URL</dt>
      <?php if ($video->getYoutubeUrl ()): ?>
      <dd><?php echo $video->getYoutubeUrl (); ?></dd>
      <?php endif; ?>
      <?php foreach (Config::read ('supportedLangs') as $lang): ?>
      <dt<?php echo !$video->getTitle ($lang) ? ' class="empty"' : '' ?>>Naslov [<?php echo strtoupper ($lang); ?>]</dt>
      <?php if ($video->getTitle ($lang)): ?>
      <dd><?php echo $video->getTitle ($lang); ?></dd>
      <?php endif; ?>
      <dt<?php echo !$video->getCategory ($lang) ? ' class="empty"' : '' ?>>Category [<?php echo strtoupper ($lang); ?>]</dt>
      <?php if ($video->getCategory ($lang)): ?>
      <dd><?php echo $video->getCategory ($lang); ?></dd>
      <?php endif; ?>
      <?php endforeach; ?>
      <dt>Created On</dt>
      <dd>
        <?php echo $video->Created; ?>
      </dd>
      <dt>Modified On</dt>
      <dd>
        <?php echo $video->Created == $video->Created ? $video->Modified : '-'; ?>
      </dd>
    </dl>
    <div>
    </div>
  </fieldset>
</div>