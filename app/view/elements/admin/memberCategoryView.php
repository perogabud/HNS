<div class="column">
  <fieldset>
    <legend>Member Category <strong><?php echo $memberCategory->Name; ?></strong></legend>
    <?php TableHelper::globalMessages (); ?>
    <ul class="actions">
      <li><a href="/admin/memberCategory/edit/<?php echo $memberCategory->Id; ?>"><?php TableHelper::icon ('edit'); ?> Edit this Member Category</a></li>
    </ul>
    <dl class="info">
      <?php foreach (Config::read ('supportedLangs') as $lang): ?>
      <dt<?php echo !$memberCategory->getName ($lang) ? ' class="empty"' : '' ?>>Name [<?php echo strtoupper ($lang); ?>]</dt>
      <?php if ($memberCategory->getName ($lang)): ?>
      <dd><?php echo $memberCategory->getName ($lang); ?></dd>
      <?php endif; ?>
      <?php endforeach; ?>
      <dt>Created On</dt>
      <dd>
        <?php echo $memberCategory->Created; ?>
      </dd>
      <dt>Modified On</dt>
      <dd>
        <?php echo $memberCategory->Created == $memberCategory->Created ? $memberCategory->Modified : '-'; ?>
      </dd>
    </dl>
    <div>
    </div>
  </fieldset>
</div>