<div style="float: left;">
<section class="main">
<?php if (isset ($page)): ?>
	<header>
		<figure class="header">
  <?php if ($page->CoverImage): ?>
		  <img src="<?php echo $page->CoverImage->Url; ?>" width="719" height="429" alt=""/>
  <?php else: ?>
		  <img src="/img/default.jpg" width="719" height="429" alt="<?php echo $page->Title; ?>"/>
  <?php endif; ?>
		</figure>
  </header>
  <?php if (!isset ($newsItems)): ?>
<section class="subpage">
  
	  <h2><?php echo $page->Title; ?></h2>
  <time datetime="<?php echo $page->getCreated ('Y-m-d'); ?>"></time>
  <div class="lead">
    <?php echo $page->Lead; ?>
  </div>
  
  <?php if (MessageManager::globalMessageIsSet ()) : ?>
    <p><?php echo MessageManager::getGlobalMessage (); ?></p>
  <?php elseif (MessageManager::successMessageIsSet()) : ?>
    <p><?php echo MessageManager::getSuccessMessage (); ?></p>
  <?php endif; ?>
  
  <?php if (!$submittedSuccess) : ?>
    <form action="" method="post" class="examApplication">
      <h3>Prijava za polaganje ispita</h3>
      <?php FormHelper::input('text', 'examName', 'examName', array('label' => array('text' => 'Ime i prezime:'))); ?>
      <?php FormHelper::input('text', 'examAddress', 'examAddress', array('label' => array('text' => 'Adresa:'))); ?>
      <?php FormHelper::input('text', 'examOib', 'examOib', array('label' => array('text' => 'OIB:'))); ?>
      <?php FormHelper::input('text', 'examPhone', 'examPhone', array('label' => array('text' => 'Kontakt telefon:'))); ?>
      <?php FormHelper::input('text', 'examEmail', 'examEmail', array('label' => array('text' => 'Kontakt e-mail:'))); ?>

      <div class="input custom">
        <label>Prijavljujem se za polaganje ispita na tečaju:</label>
      </div>

      <?php FormHelper::input('radio', 'examClass', NULL, array('label' => array('text' => 'UEFA B'), 'value' => 'uefaB')); ?>
      <?php FormHelper::input('radio', 'examClass', NULL, array('label' => array('text' => 'UEFA A'), 'value' => 'uefaA')); ?>
      <?php FormHelper::input('radio', 'examClass', NULL, array('label' => array('text' => 'UEFA PRO'), 'value' => 'uefaPro')); ?>
      <?php FormHelper::input('radio', 'examClass', NULL, array('label' => array('text' => 'Futsal B'), 'value' => 'futsalB')); ?>

      <?php FormHelper::input('submit', 'submitExamApplication', 'submitExamApplication', array('value' => 'Pošalji')); ?>
    </form>
    <hr />
    <form action="" method="post" class="classApplication">
      <h3>Prijava za tečajeve</h3>

      <?php FormHelper::input('text', 'name', 'name', array('label' => array('text' => 'Ime i prezime:'))); ?>
      <?php FormHelper::input('text', 'address', 'address', array('label' => array('text' => 'Adresa:'))); ?>
      <?php FormHelper::input('text', 'oib', 'oib', array('label' => array('text' => 'OIB:'))); ?>
      <?php FormHelper::input('text', 'phone', 'phone', array('label' => array('text' => 'Kontakt telefon:'))); ?>
      <?php FormHelper::input('text', 'email', 'email', array('label' => array('text' => 'Kontakt e-mail:'))); ?>
      <?php FormHelper::input('text', 'education', 'education', array('label' => array('text' => 'Stručna sprema:'))); ?>

      <div class="input custom">
        <label>Konfekcijski broj:</label>
      </div>

      <?php FormHelper::input('radio', 'confection', NULL, array('label' => array('text' => 'M'), 'value' => 'm')); ?>
      <?php FormHelper::input('radio', 'confection', NULL, array('label' => array('text' => 'L'), 'value' => 'l')); ?>
      <?php FormHelper::input('radio', 'confection', NULL, array('label' => array('text' => 'XL'), 'value' => 'xl')); ?>
      <?php FormHelper::input('radio', 'confection', NULL, array('label' => array('text' => 'XXL'), 'value' => 'xxl')); ?>

      <div class="input custom">
        <label>Prijavljujem se za tečaj:</label>
      </div>

      <?php FormHelper::input('radio', 'class', NULL, array('label' => array('text' => 'UEFA B'), 'value' => 'uefaB')); ?>
      <?php FormHelper::input('radio', 'class', NULL, array('label' => array('text' => 'UEFA A'), 'value' => 'uefaA')); ?>
      <?php FormHelper::input('radio', 'class', NULL, array('label' => array('text' => 'UEFA PRO'), 'value' => 'uefaPro')); ?>
      <?php FormHelper::input('radio', 'class', NULL, array('label' => array('text' => 'Futsal'), 'value' => 'futsal')); ?>
      <?php FormHelper::input('radio', 'class', NULL, array('label' => array('text' => 'Tečaj za vratare'), 'value' => 'vratar')); ?>
      <?php FormHelper::input('radio', 'class', NULL, array('label' => array('text' => 'Adaptacija - UEFA A'), 'value' => 'adaptacija')); ?>

      <div class="input custom">
        <label>Završen tečaj:</label>
      </div>

      <?php FormHelper::input('radio', 'completedClass', NULL, array('label' => array('text' => 'Niti jedan'), 'value' => 'niti_jedan')); ?>
      <?php FormHelper::input('radio', 'completedClass', NULL, array('label' => array('text' => 'C'), 'value' => 'c')); ?>
      <?php FormHelper::input('radio', 'completedClass', NULL, array('label' => array('text' => 'UEFA B'), 'value' => 'uefaB')); ?>
      <?php FormHelper::input('radio', 'completedClass', NULL, array('label' => array('text' => 'UEFA A'), 'value' => 'uefaA')); ?>

      <div class="input custom">
        <label>Ovime potvrđujem da ću svu potrebnu dokumentaciju dostaviti na vrijeme u:</label>
      </div>

      <?php FormHelper::input('radio', 'documentation', NULL, array('label' => array('text' => 'Nogometnu akademiju'), 'value' => 'akademija')); ?>
      <?php FormHelper::input('radio', 'documentation', NULL, array('label' => array('text' => 'Nogometno središte'), 'value' => 'srediste')); ?>

      <?php FormHelper::input('checkbox', 'confirmation', 'confirmation', array('label' => array('text' => 'Potvrđujem da ću prema rasporedu održavanja Tečaja, predviđenu kotizaciju za svaki dio Tečaja uplatiti najkasnije 10 dana prije početka svakog dijela tečaja koji polazim.'), 'value' => '1')); ?>

      <?php FormHelper::input('submit', 'submitClassApplication', 'submitClassApplication', array('value' => 'Pošalji')); ?>
    </form>
  <?php endif; ?>
</section>
<?php endif; ?>
	<?php endif; ?>
	<div class="content_bottom_bg"></div>
</section>
</div>