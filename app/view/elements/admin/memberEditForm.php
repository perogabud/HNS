<form id="memberEdit" method="post" enctype="multipart/form-data" action="">
  <fieldset>
    <legend>Uredi igrača / člana <strong><?php echo $member->Name; ?></strong></legend>
    <?php TableHelper::globalMessages (); ?>
    <ul class="actions">
      <li><a href="<?php echo Config::read('siteUrlRoot') ?>admin/member/view/<?php echo $member->getId (); ?>"><?php TableHelper::icon ('view'); ?> Pregledaj ovog igrača / člana</a></li>
      <li><a href="<?php echo Config::read('siteUrlRoot') ?>admin/member"><?php TableHelper::icon ('arrowLeft'); ?> Natrag na igrače / članove</a></li>
      <?php
      $team = $member->getTeam ();
      if (!is_null ($team)):
      ?>
      <li><a href="<?php echo Config::read('siteUrlRoot') ?>admin/team/view/<?php echo $team->getId (); ?>"><?php TableHelper::icon ('arrowLeft'); ?> Natrag na momčad <strong><?php echo $team->Name; ?></strong></a></li>
      <?php endif; ?>
    </ul>
    <?php
    FormHelper::select ('memberCategoryId', 'memberCategoryId', 'Uloga', $memberCategorys, $member->MemberCategory->Id);
    FormHelper::select ('teamId', 'teamId', 'Momčad', $teams, is_null ($team) ? NULL : $team->getId ());
    ?>
    <ul class="actions">
      <li><a href="/admin/team"><?php TableHelper::icon ('view'); ?> Vidi sve momčadi</a></li>
      <li><a href="/admin/team/add"><?php TableHelper::icon ('add'); ?> Dodaj novu momčad</a></li>
    </ul>
    <?php
    FormHelper::input ('text', 'firstName', 'firstName', array ('label' => array ('text' => 'Ime * '), 'value' => $member->getFirstName ()));
    FormHelper::input ('text', 'lastName', 'lastName', array ('label' => array ('text' => 'Prezime * '), 'value' => $member->getLastName ()));
    FormHelper::input ('text', 'position', 'position', array ('label' => array ('text' => 'Pozicija  '), 'value' => $member->getPosition ()));
    FormHelper::input ('text', 'birthDate', 'birthDate', array ('label' => array ('text' => 'Datum rođenja  '), 'class' => 'date', 'value' => $member->getBirthDate ('d.m.Y.')));
    FormHelper::input ('text', 'birthPlace', 'birthPlace', array ('label' => array ('text' => 'Mjesto rođenja  '), 'value' => $member->getBirthPlace ()));
    FormHelper::input ('text', 'height', 'height', array ('label' => array ('text' => 'Visina  '), 'value' => $member->getHeight ()));
    FormHelper::input ('text', 'club', 'club', array ('label' => array ('text' => 'Klub  '), 'value' => $member->getClub ()));
    FormHelper::input ('text', 'pastClubs', 'pastClubs', array ('label' => array ('text' => 'Prijašnji klubovi  '), 'value' => $member->getPastClubs ()));
    FormHelper::input ('text', 'playCount', 'playCount', array ('label' => array ('text' => 'Broj nastupa  '), 'value' => $member->getPlayCount ()));
    FormHelper::input ('text', 'firstPlayDate', 'firstPlayDate', array ('label' => array ('text' => 'Prvi nastup  '), 'class' => 'date', 'value' => $member->getFirstPlayDate ('d.m.Y.')));
    if ($member->getImage ()) {
      echo '<div class="input"><img src="' . $member->getImage ()->getUrl () . '" /></div>';
      FormHelper::input ('file', 'image[]', 'image', array ('label' => array ('text' => 'Slika '), 'info' => 'Leave empty to keep current image.<br />The image will be resized and cropped to the following dimensions: <strong>719px width</strong> and <strong>429px height</strong>.<br/>These are also minimum dimensions.'));
      FormHelper::input ('checkbox', 'deleteImage', 'deleteImage', array ('label' => array ('text' => 'Izbriši sliku')));
    }
    else {
      FormHelper::input ('file', 'image[]', 'image', array ('label' => array ('text' => 'Slika ')));
    }
    foreach (Config::read ('supportedLangs') as $lang) {
      echo '<h3 class="langContent">Podaci za '. Config::read ("langNamesCroatian", $lang) .' jezik</h3>';
      FormHelper::input ('textarea', 'biography', 'biography', array ('label' => array ('text' => 'Biografija  '), 'lang' => $lang, 'value' => $member->getBiography ($lang), 'class' => 'editor'));
    }
    ?>
    <p class="info">Polja označena sa zvijezdicom (*) moraju biti ispunjena.</p>
    <?php FormHelper::input ('submit', 'submit', 'submit', array ('value' => 'Spremi')); ?>
    </fieldset>
</form>