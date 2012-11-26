<div class="column">
  <fieldset>
    <legend>Momčad <strong><?php echo $team->Name; ?></strong></legend>
    <?php TableHelper::globalMessages (); ?>
    <ul class="actions">
      <li><a href="<?php echo Config::read('siteUrlRoot') ?>admin/team"><?php TableHelper::icon ('arrowLeft'); ?> Natrag na momčadi</a></li>
      <li><a href="/admin/team/edit/<?php echo $team->Id; ?>"><?php TableHelper::icon ('edit'); ?> Uredi ovu momčad</a></li>
    </ul>
    <dl class="info">
      <?php foreach (Config::read ('supportedLangs') as $lang): ?>
      <dt<?php echo !$team->getName ($lang) ? ' class="empty"' : '' ?>>Naziv [<?php echo strtoupper ($lang); ?>]</dt>
      <?php if ($team->getName ($lang)): ?>
      <dd><?php echo $team->getName ($lang); ?></dd>
      <?php endif; ?>
      <?php endforeach; ?>
      <dt>Zapis stvoren</dt>
      <dd>
        <?php echo $team->Created; ?>
      </dd>
      <dt>Zapis uređen</dt>
      <dd>
        <?php echo $team->Created == $team->Created ? $team->Modified : '-'; ?>
      </dd>
    </dl>
    <div>
    </div>
  </fieldset>
</div>
<div class="column side">
  <fieldset>
    <legend>Igrači / članovi</legend>
    <ul class="actions">
      <li><a href="<?php echo Config::read('siteUrlRoot') ?>admin/member/add?teamId=<?php echo $team->getId (); ?>"><?php TableHelper::icon('add'); ?> Dodaj igrača / člana</a></li>
    </ul>
    <?php
     $members = $team->getMembers ();
     if (!count ($members)):
     ?>
    <p>Ova momčad trenutno nema igrača / članova.</p>
    <?php else: ?>
    <table>
      <thead>
        <tr>
          <th>Ime</th>
          <th>Controls</th>
        </tr>
      </thead>
      <tfoot>
      </tfoot>
      <tbody>
        <?php foreach ($members as $member): ?>
        <tr class="<?php echo Tools::toggleClass (); ?>">
          <td><?php echo $member->Name; ?></td>
          <td class="controls3">
            <a class="view" href="<?php echo Config::read ('siteUrlRoot'); ?>admin/member/view/<?php echo $member->Id; ?>?teamId=<?php echo $team->getId (); ?>"><?php TableHelper::icon('view'); ?></a>
            <a class="edit" href="<?php echo Config::read ('siteUrlRoot'); ?>admin/member/edit/<?php echo $member->Id; ?>?teamId=<?php echo $team->getId (); ?>"><?php TableHelper::icon('edit'); ?></a>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <?php endif; ?>
  </fieldset>
</div>