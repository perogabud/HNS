<section class="main">
<?php if (isset ($team)): ?>
	<header>
		<figure class="header">
		  <img src="http://placehold.it/719x429/E30101/FFFFFF&text=<?php echo urlencode ($team->Name); ?>" width="719" height="429" alt=""/>
		</figure>
	</header>
	<section class="subpage team">
  <h2><?php echo $team->Name; ?></h2>
  
  <h3>Izbornik</h3>
  
  <dl>
  	<dt>IGOR ŠTIMAC</dt><dd>izbornik</dd>
  </dl>
  
  <h3>Vratari</h3>
  
  <h3>Obrana</h3>
  
  <h3>Vezni red</h3>
  
  <h3>Napad</h3>
  
	<section class="stozer">
	  <h3>Stručni stožer</h3>
	  
	  <h3>Širi stručni stožer</h3>
  </section>
  
<!--  <?php foreach ($team->Members as $member): ?>
  <dl>
    <dt>Ime</dt>
    <dd><?php echo $member->Name; ?></dd>
    <dt>Pozicija</dt>
    <dd><?php echo $member->MemberCategory->Name . ', ' . $member->Position; ?></dd>
  </dl>
  <?php endforeach; ?>-->
</section>
<?php endif; ?>
</section>