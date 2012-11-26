<?php if (isset ($member)): ?>

    <dl>
      <dt>Slika</dt>
      <dd><img src="<?php echo $member->Image->Url ?>" width="719" height="429" alt=""/></dd>
      <dt>Ime</dt>
      <dd><?php echo $member->Name; ?></dd>
      <dt>Pozicija</dt>
      <dd><?php echo $member->Position; ?></dd>
      <dt>Klub</dt>
      <dd><?php echo $member->Club; ?></dd>
      <dt>Ostali podaci</dt>
      <dd>
        <pre>
        <?php print_r ($member); ?>
        </pre>
      </dd>
    </dl>

<?php endif; ?>
