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
      <h3>Registracija novog korisnika</h3>
      <?php FormHelper::input('text', 'name', 'name', array('label' => array('text' => 'Ime:'))); ?>
      <?php FormHelper::input('text', 'surname', 'surname', array('label' => array('text' => 'Prezime:'))); ?>
      <?php FormHelper::input('text', 'editorial', 'editorial', array('label' => array('text' => 'Redakcija:'))); ?>
      <?php FormHelper::input('text', 'phone', 'phone', array('label' => array('text' => 'Broj telefona:'))); ?>
      <?php FormHelper::input('text', 'email', 'email', array('label' => array('text' => 'E-mail:'))); ?>

      <?php FormHelper::input('submit', 'submitPressApplication', 'submitPressApplication', array('value' => 'Registriraj se')); ?>
    </form>
  <?php endif; ?>
</section>
<?php endif; ?>
	<?php endif; ?>
	<div class="content_bottom_bg"></div>
</section>
</div>