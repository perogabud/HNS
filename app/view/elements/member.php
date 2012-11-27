<?php if (isset ($member)): ?>
	<section class="main">
		<figure>
			<img src="<?php echo $member->Image->Url ?>" width="719" height="429" alt=""/>
			<figcaption><?php echo $member->Name; ?> </figcaption>
		</figure>
		
		<section class="member">
	    <dl>
	      <dt>Ime</dt>
	      <dd><?php echo $member->Name; ?></dd>
	      <dt>Pozicija</dt>
	      <dd><?php echo $member->Position; ?></dd>
	      <dt>Klub</dt>
	      <dd><?php echo $member->Club; ?></dd>
	    </dl>
	    
	    <?php if ($member->Biography): ?>
	   		<h3>Biografija</h3>
	   		<article>
	   			<?php echo $member->Biography; ?>
	   		</article>
	    <?php endif ?>
    </section>
	</section>
<?php endif; ?>
