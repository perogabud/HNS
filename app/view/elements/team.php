<section class="main">
<?php if (isset ($team)): ?>
	<header>
		<figure class="header">
		  <img src="/img/default.jpg" width="719" height="429" alt=""/>
		</figure>
	</header>
	<section class="subpage team">
  <h2><?php echo $team->Name; ?></h2>
  
  <?php 
  $groupedMembers = array ();
  foreach ($team->Members as $member):
    if (!isset ($groupedMembers[$member->MemberCategory->Id])) {
      $groupedMembers[$member->MemberCategory->Id] = array (
        'name' => $member->MemberCategory->Name,
        'members' => array ()
      );
    }  
    $groupedMembers[$member->MemberCategory->Id]['members'][] = $member;
  endforeach; 
  ksort ($groupedMembers);
  
  echo '<pre style="display:none;">';
  print_r ($groupedMembers);
  echo '</pre>';
  
  foreach ($groupedMembers as $groupId => $data): 
  ?>
  <h3><?php echo $data['name']; ?></h3>
  <?php if (in_array ($groupId, array (6, 7))) echo '<section class="stozer">'; ?>
  <ul>
    <?php foreach ($data['members'] as $member): ?>
  	<li><span class="name"><a href="<?php echo $member->Url; ?>"><?php echo $member->Name; ?></a></span><span class="position"><?php echo $member->Position; ?></span></li>
    <?php endforeach; ?>
  </ul>
  <?php if (in_array ($groupId, array (6, 7))) echo '</section>'; ?>
  <?php endforeach; ?>
  
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
<div class="content_bottom_bg"></div>
</section>