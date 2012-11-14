<div class="column">
  <fieldset>
    <legend>Actuality <strong><?php echo $actuality->Title; ?></strong></legend>
    <?php TableHelper::globalMessages (); ?>
    <ul class="actions">
      <li><a href="<?php echo Config::read('siteUrlRoot') ?>admin/actuality"><?php TableHelper::icon ('arrowLeft'); ?> Back to Actualitys</a></li>
      <li><a href="/admin/actuality/edit/<?php echo $actuality->Id; ?>"><?php TableHelper::icon ('edit'); ?> Edit this Actuality</a></li>
    </ul>
    <dl class="info">
      <dt>Language</dt>
      <?php if ($actuality->getLanguageId ()): ?>
      <dd><?php echo $actuality->getLanguageId (); ?></dd>
      <?php endif; ?>
      <dt>Title</dt>
      <?php if ($actuality->getTitle ()): ?>
      <dd><?php echo $actuality->getTitle (); ?></dd>
      <?php endif; ?>
      <dt>Lead</dt>
      <?php if ($actuality->getLead ()): ?>
      <dd><?php echo $actuality->getLead (); ?></dd>
      <?php endif; ?>
      <dt>Content</dt>
      <?php if ($actuality->getContent ()): ?>
      <dd><?php echo $actuality->getContent (); ?></dd>
      <?php endif; ?>
      <dt>Published</dt>
      <?php if ($actuality->getIsPublished ()): ?>
      <dd><?php echo $actuality->getIsPublished (); ?></dd>
      <?php endif; ?>
      <dt>Publish Date</dt>
      <?php if ($actuality->getPublishDate ()): ?>
      <dd><?php echo $actuality->getPublishDate (); ?></dd>
      <?php endif; ?>
      <?php foreach (Config::read ('supportedLangs') as $lang): ?>
      <?php endforeach; ?>
      <dt>Created On</dt>
      <dd>
        <?php echo $actuality->Created; ?>
      </dd>
      <dt>Modified On</dt>
      <dd>
        <?php echo $actuality->Created == $actuality->Created ? $actuality->Modified : '-'; ?>
      </dd>
    </dl>
    <div>
    </div>
  </fieldset>
</div>