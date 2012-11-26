<div class="column">
  <fieldset>
    <legend>Igrač / član <strong><?php echo $member->FirstName; ?></strong></legend>
    <?php TableHelper::globalMessages (); ?>
    <ul class="actions">
      <li><a href="<?php echo Config::read('siteUrlRoot') ?>admin/member"><?php TableHelper::icon ('arrowLeft'); ?> Natrag na sve igrače / članove</a></li>
      <li><a href="/admin/member/edit/<?php echo $member->Id; ?>"><?php TableHelper::icon ('edit'); ?> Uredi ovog igrača / člana</a></li>
    </ul>
    <dl class="info">
      <dt<?php echo !$member->getTeam () ? ' class="empty"' : '' ?>>Momčad</dt>
      <dd><?php echo $member->getTeam () ? $member->getTeam ()->getName () : 'Ovaj igrač / član nije dodijeljen momčadi.'; ?></dd>
      <dt>Ime</dt>
      <?php if ($member->getFirstName ()): ?>
      <dd><?php echo $member->getFirstName (); ?></dd>
      <?php endif; ?>
      <dt>Prezime</dt>
      <?php if ($member->getLastName ()): ?>
      <dd><?php echo $member->getLastName (); ?></dd>
      <?php endif; ?>
      <dt>Pozicija</dt>
      <?php if ($member->getPosition ()): ?>
      <dd><?php echo $member->getPosition (); ?></dd>
      <?php endif; ?>
      <dt>Datum rođenja</dt>
      <?php if ($member->getBirthDate ()): ?>
      <dd><?php echo $member->getBirthDate (); ?></dd>
      <?php endif; ?>
      <dt>Mjesto rođenja</dt>
      <?php if ($member->getBirthPlace ()): ?>
      <dd><?php echo $member->getBirthPlace (); ?></dd>
      <?php endif; ?>
      <dt>Visina</dt>
      <?php if ($member->getHeight ()): ?>
      <dd><?php echo $member->getHeight (); ?></dd>
      <?php endif; ?>
      <dt>Klub</dt>
      <?php if ($member->getClub ()): ?>
      <dd><?php echo $member->getClub (); ?></dd>
      <?php endif; ?>
      <dt>Prijašnji klubovi</dt>
      <?php if ($member->getPastClubs ()): ?>
      <dd><?php echo $member->getPastClubs (); ?></dd>
      <?php endif; ?>
      <dt>Broj nastupa</dt>
      <?php if ($member->getPlayCount ()): ?>
      <dd><?php echo $member->getPlayCount (); ?></dd>
      <?php endif; ?>
      <dt>Prvi nastup</dt>
      <?php if ($member->getFirstPlayDate ()): ?>
      <dd><?php echo $member->getFirstPlayDate (); ?></dd>
      <?php endif; ?>
      <?php foreach (Config::read ('supportedLangs') as $lang): ?>
      <dt<?php echo !$member->getBiography ($lang) ? ' class="empty"' : '' ?>>Biografija [<?php echo strtoupper ($lang); ?>]</dt>
      <?php if ($member->getBiography ($lang)): ?>
      <dd><?php echo $member->getBiography ($lang); ?></dd>
      <?php endif; ?>
      <?php endforeach; ?>
      <dt>Slika</dt>
      <dd class="check"><img src="<?php echo $member->getImage () ? $member->getImage ()->getUrl () : ''; ?>" /></dd>
      <dt>Zapis stvoren</dt>
      <dd>
        <?php echo $member->Created; ?>
      </dd>
      <dt>Zapis uređen</dt>
      <dd>
        <?php echo $member->Created == $member->Created ? $member->Modified : '-'; ?>
      </dd>
    </dl>
    <div>
    </div>
  </fieldset>
</div>