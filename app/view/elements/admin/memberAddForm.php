<form id="memberAdd" method="post" enctype="multipart/form-data" action="">
  <fieldset>
    <?php if (isset ($_GET['teamId'])): ?>
    <legend>New Member <span class="related">for Team <strong><?php echo $team->Name; ?></strong></span></legend>
    <?php TableHelper::globalMessages (); ?>
    <?php else: ?>
    <legend>New Member</legend>
    <?php TableHelper::globalMessages (); ?>
    <?php endif; ?>
    <ul class="actions">
      <li><a href="<?php echo Config::read('siteUrlRoot') ?>admin/member"><?php TableHelper::icon ('arrowLeft'); ?> Back to Members</a></li>
      <?php if (isset ($_GET['teamId'])): ?>
      <li><a href="<?php echo Config::read('siteUrlRoot') ?>admin/team/view/<?php echo $_GET['teamId']; ?>"><?php TableHelper::icon ('arrowLeft'); ?> Back to team <strong><?php echo $team->Name; ?></strong></a></li>
      <?php endif; ?>
    </ul>
    <?php
    FormHelper::select ('memberCategoryId', 'memberCategoryId', 'Uloga', $memberCategorys, 'getName');
    FormHelper::select ('teamId', 'teamId', 'Momčad', $teams, NULL, 'getName');
    ?>
    <ul class="actions">
      <li><a href="/admin/team"><?php TableHelper::icon ('view'); ?> Vidi sve momčadi</a></li>
      <li><a href="/admin/team/add"><?php TableHelper::icon ('add'); ?> Dodaj novu momčad</a></li>
    </ul>
    <?php
    FormHelper::input ('text', 'firstName', 'firstName', array ('label' => array ('text' => 'Ime * ')));
    FormHelper::input ('text', 'lastName', 'lastName', array ('label' => array ('text' => 'Prezime * ')));
    FormHelper::input ('text', 'position', 'position', array ('label' => array ('text' => 'Position  ')));
    FormHelper::input ('text', 'birthDate', 'birthDate', array ('label' => array ('text' => 'Datum rođenja  '), 'class' => 'date'));
    FormHelper::input ('text', 'birthPlace', 'birthPlace', array ('label' => array ('text' => 'Mjesto rođenja  ')));
    FormHelper::input ('text', 'height', 'height', array ('label' => array ('text' => 'Visina')));
    FormHelper::input ('text', 'club', 'club', array ('label' => array ('text' => 'Klub  ')));
    FormHelper::input ('text', 'pastClubs', 'pastClubs', array ('label' => array ('text' => 'Prijašnji klubovi  ')));
    FormHelper::input ('text', 'playCount', 'playCount', array ('label' => array ('text' => 'Broj nastupa  ')));
    FormHelper::input ('text', 'firstPlayDate', 'firstPlayDate', array ('label' => array ('text' => 'Prvi nastup  '), 'class' => 'date'));
    FormHelper::input ('file', 'image[]', 'image', array ('label' => array ('text' => 'Image '), 'info' => 'The image will be resized and cropped to the following dimensions: <strong>719px width</strong> and <strong>429px height</strong>.<br/>These are also minimum dimensions.'));
    foreach (Config::read ('supportedLangs') as $lang) {
      echo '<h3 class="langContent">Podaci za '. Config::read ("langNamesCroatian", $lang) .' jezik</h3>';
      FormHelper::input ('textarea', 'biography', 'biography', array ('label' => array ('text' => 'Biografija  '), 'lang' => $lang, 'class' => 'editor'));
    }
    ?>
    <p class="info">Polja označena sa zvijezdicom (*) moraju biti ispunjena.</p>
    <?php FormHelper::input ('submit', 'submit', 'submit', array ('value' => 'Spremi')); ?>
    </fieldset>
</form>