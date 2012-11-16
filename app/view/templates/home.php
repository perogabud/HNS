<!DOCTYPE html>
<html lang="hr">
  <head>
    <title><?php echo $pageTitle; ?></title>
    <meta name="Description" content="" />
    <meta name="Keywords" content="" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script type="text/javascript">document.documentElement.className = 'js';</script>
    <link rel="stylesheet" href="/css/style.css" type="text/css" />
  </head>
  <body>
  	<div role="wrapper">
	  <?php $this->getElement ('header'); ?>
	  <?php $this->getElement ('navigation'); ?>
	    <div>
	      <p>Homepage here!</p>
	      <?php if (isset ($newsItems)): ?>
	      <h3>Novosti</h3>
	      <ul>
	        <?php foreach ($newsItems as $newsItem): ?>
	        <li>
	          <?php if ($newsItem->CoverImage): ?>
	          <img src="<?php echo $newsItem->CoverImage->LargeThumbnailUrl; ?>" width="300" height="200" alt="Slika za novost <?php echo $newsItem->Title; ?>"/>
	          <?php endif; ?>
	          <a href="<?php echo $newsItem->Url; ?>"><?php echo $newsItem->Title; ?></a>
	          <small><time datetime="<?php echo $newsItem->getPublishDate ('Y-m-d'); ?>"><?php echo $newsItem->getPublishDate ('d.m.Y.'); ?></time></small>
	          <?php echo $newsItem->Lead; ?>
	        </li>
	        <?php endforeach; ?>
	      </ul>
	      <?php endif; ?>
	      <!--<p>Sample form:</p>
	      <form action="" method="post">
	        <fieldset>
	          <legend>Forma</legend>
	          <?php
	          FormHelper::input ('text', 'fieldName1', 'fieldId1', array ('label' => array ('text' => 'Labela'), 'class' => 'klasa'));
	          FormHelper::input ('textarea', 'fieldName2', 'fieldId2', array ('label' => array ('text' => 'Labela'), 'class' => 'klasa', 'info' => 'Info tekst ovdje.'));
	          FormHelper::input ('checkbox', 'fieldName3', 'fieldId3', array ('label' => array ('text' => 'Labela'), 'class' => 'klasa'));
	          FormHelper::input ('radio', 'fieldName4', 'fieldId4', array ('label' => array ('text' => 'Labela'), 'class' => 'klasa'));
	          ?>
	        </fieldset>
	      </form>-->
	    </div>
	  <?php $this->getElement ('footer'); ?>
	  <?php $this->getElement ('scripts'); ?>
	  </div>
  </body>
</html>