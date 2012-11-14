<div class="column">
  <fieldset>
    <legend>User Role <strong><?php echo $userRole->Name; ?></strong></legend>
    <?php TableHelper::globalMessages (); ?>
    <ul class="actions">
      <li><a href="/admin/userRole/edit/<?php echo $userRole->Id; ?>"><?php TableHelper::icon ('edit'); ?> Edit this User Role</a></li>
    </ul>
    <dl class="info">
      <dt>Role Name</dt>
      <?php if ($userRole->getName ()): ?>
      <dd><?php echo $userRole->getName (); ?></dd>
      <?php endif; ?>
      <?php foreach (Config::read ('supportedLangs') as $lang): ?>
      <?php endforeach; ?>
      <dt>Created On</dt>
      <dd>
        <?php echo $userRole->Created; ?>
      </dd>
      <dt>Modified On</dt>
      <dd>
        <?php echo $userRole->Created == $userRole->Created ? $userRole->Modified : '-'; ?>
      </dd>
    </dl>
    <div>
    </div>
  </fieldset>
</div>