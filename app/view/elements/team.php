<?php if (isset ($team)): ?>
<section class="subpage">
  <img src="http://placehold.it/719x429/E30101/FFFFFF&text=<?php echo urlencode ($team->Name); ?>" width="719" height="429" alt=""/>
  <h2 style="margin-top: 1em; font-size: 2em;"><?php echo $team->Name; ?></h2>
  <?php foreach ($team->Members as $member): ?>
  <dl>
    <dt>Ime</dt>
    <dd><?php echo $member->Name; ?></dd>
    <dt>Pozicija</dt>
    <dd><?php echo $member->MemberCategory->Name . ', ' . $member->Position; ?></dd>
  </dl>
  <?php endforeach; ?>
</section>
<?php endif; ?>
