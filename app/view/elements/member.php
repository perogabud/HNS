<?php if (isset ($member)): ?>
	<section class="main">
		<figure class="header">
			<img src="<?php echo $member->Image->Url ?>" width="719" height="429" alt=""/>
			<figcaption><?php echo $member->Name; ?> </figcaption>
		</figure>

		<section class="member">
	    <dl>
        <?php if ($member->getFirstName ()): ?>
	      <dt>Ime</dt>
        <dd><?php echo $member->getFirstName (); ?></dd>
        <?php endif; ?>
        <?php if ($member->getLastName ()): ?>
        <dt>Prezime</dt>
        <dd><?php echo $member->getLastName (); ?></dd>
        <?php endif; ?>
        <?php if ($member->getPosition ()): ?>
        <dt>Pozicija</dt>
        <dd><?php echo $member->getPosition (); ?></dd>
        <?php endif; ?>
        <?php if ($member->getBirthDate ()): ?>
        <dt>Datum rođenja</dt>
        <dd><?php echo $member->getBirthDate ('d.m.Y.'); ?></dd>
        <?php endif; ?>
        <?php if ($member->getBirthPlace ()): ?>
        <dt>Mjesto rođenja</dt>
        <dd><?php echo $member->getBirthPlace (); ?></dd>
        <?php endif; ?>
        <?php if ($member->getHeight ()): ?>
        <dt>Visina</dt>
        <dd><?php echo $member->getHeight (); ?></dd>
        <?php endif; ?>
        <?php if ($member->getClub ()): ?>
        <dt>Klub</dt>
        <dd><?php echo $member->getClub (); ?></dd>
        <?php endif; ?>
        <?php if ($member->getPastClubs ()): ?>
        <dt>Prijašnji klubovi</dt>
        <dd><?php echo $member->getPastClubs (); ?></dd>
        <?php endif; ?>
        <?php if ($member->getPlayCount ()): ?>
        <dt>Broj nastupa</dt>
        <dd><?php echo $member->getPlayCount (); ?></dd>
        <?php endif; ?>
        <?php if ($member->getFirstPlayDate ()): ?>
        <dt>Prvi nastup</dt>
        <dd><?php echo $member->getFirstPlayDate ('d.m.Y.'); ?></dd>
        <?php endif; ?>
	    </dl>

	    <?php if ($member->Biography): ?>
	   		<h3>Biografija</h3>
	   		<article>
	   			<?php echo $member->Biography; ?>
	   		</article>
	    <?php endif; ?>
    </section>
    <div class="content_bottom_bg"></div>
	</section>
<?php endif; ?>
