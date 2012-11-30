<div class="column">
  <fieldset>
    <legend>User <strong><?php echo $user->Username; ?></strong></legend>
    <?php TableHelper::globalMessages (); ?>
    <ul class="actions">
      <li><a href="/admin/user/edit/<?php echo $user->Id; ?>"><?php TableHelper::icon ('edit'); ?> Edit this User</a></li>
    </ul>
    <dl class="info">
      <dt>Username</dt>
      <?php if ($user->getUsername ()): ?>
      <dd><?php echo $user->getUsername (); ?></dd>
      <?php endif; ?>
      <dt>Password</dt>
      <?php if ($user->getPassword ()): ?>
      <dd><?php echo $user->getPassword (); ?></dd>
      <?php endif; ?>
      <?php foreach (Config::read ('supportedLangs') as $lang): ?>
      <?php endforeach; ?>
      <dt>Created On</dt>
      <dd>
        <?php echo $user->Created; ?>
      </dd>
      <dt>Modified On</dt>
      <dd>
        <?php echo $user->Created == $user->Created ? $user->Modified : '-'; ?>
      </dd>
    </dl>
    <div>
    </div>
  </fieldset>
</div>
<div class="column side">
  <fieldset>
    <legend>User Roles</legend>
    <ul class="actions">
      <li><a href="<?php echo Config::read('siteUrlRoot') ?>admin/userRole"><?php TableHelper::icon('view'); ?> View all User Roles</a></li>
    </ul>
    <?php
     $userRoles = $user->getUserRoles ();
     if (!count ($userRoles)):
     ?>
    <p>This user has no user roles at the moment.</p>
    <?php else: ?>
    <table>
      <thead>
        <tr>
          <th>Role Name</th>
          <th>Created</th>
          <th>Modified</th>
          <th>Controls</th>
        </tr>
      </thead>
      <tfoot>
      </tfoot>
      <tbody>
        <?php foreach ($userRoles as $userRole): ?>
        <tr class="<?php echo Tools::toggleClass (); ?>">
          <td><?php echo $userRole->Name; ?></td>
          <td><?php echo $userRole->Created; ?></td>
          <td><?php echo ($userRole->Created == $userRole->Modified) ? '-' : $userRole->Modified; ?></td>
          <td class="controls3">
            <a class="view" href="<?php echo Config::read ('siteUrlRoot'); ?>admin/userRole/view/<?php echo $userRole->Id; ?>?userId=<?php echo $user->getId (); ?>"><?php TableHelper::icon('view'); ?></a>
            <a class="edit" href="<?php echo Config::read ('siteUrlRoot'); ?>admin/userRole/edit/<?php echo $userRole->Id; ?>?userId=<?php echo $user->getId (); ?>"><?php TableHelper::icon('edit'); ?></a>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <?php endif; ?>
    <ul class="actions">
      <li><a href="/admin/user/edit/<?php echo $user->Id; ?>#userRoleId"><?php TableHelper::icon ('edit'); ?> Edit this User</a> to add or remove User Roles.</li>
    </ul>
  </fieldset>
</div>