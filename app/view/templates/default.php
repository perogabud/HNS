<!DOCTYPE html>
<html lang="hr">
  <head>
    <title><?php echo $pageTitle; ?></title>
    <meta name="Description" content="" />
    <meta name="Keywords" content="" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script type="text/javascript">document.documentElement.className = 'js';</script>
    <link rel="stylesheet" href="/css/style.css" type="text/css" />
		<!--[if lte IE 9]>
	    <script src="/js/html5shiv.js"></script>
	  <![endif]-->
	  <!--[if lt IE 7]>
	    <script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE7.js"></script>
	  <![endif]-->
	  <!--[if lt IE 8]>
	    <script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE8.js"></script>
	  <![endif]-->
	  <!--[if lt IE 9]>
	    <script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
	  <![endif]-->
	  <!--[if IE 8]>
	    <link rel="stylesheet" href="/css/ie8.css" type="text/css" />
	  <![endif]-->
  </head>
  <body>
  	<div id="bg_box" class="bg<?php echo rand(1,3)?>">
  	<div id="wrapper">
	  	<div class="bg_left"></div>
  		<div class="bg_right"></div>
  		<aside id="sidebar">
			  <?php $this->getElement ('header'); ?>
			  <section class="subpage_nav">
			  	<ul>
			  		<li class="hns-shop"></li>
			  		<li class="ulaznice"><a href="/selekcije/ulaznice" ></a></li>
			  		<li class="raspored"><a href="/selekcije/raspored-utakmica" ></a></li>
			  		<li class="hnstv"><a href="/info-centar/hns-tv" ></a></li>
			  		<li class="galerija"><a href="/info-centar/galerija" ></a></li>
			  		<li class="aktualnosti"><a href="/info-centar/aktualnosti" ></a></li>
			  		<li class="areprezentacija"><a href="/selekcije/a-reprezentacija" ></a></li>
			  		<li class="brojac"><a href="/selekcije/raspored-utakmica" ></a></li>
			  	</ul>
			  </section>
			  <section class="subpage_categories">
          <?php if (isset ($videos)): ?>
          <h3>HNS TV</h3>
          <ul>
            <?php foreach ($videos as $video): ?>
            <li><a href="<?php echo $video->Url; ?>"><?php echo $video->Title; ?></a></li>
            <?php endforeach; ?>
          </ul>
          <?php elseif (isset ($sideNewsItems)): ?>
          <h3>Novosti</h3>
          <ul>
            <?php foreach ($sideNewsItems as $newsItem): ?>
            <li><a href="<?php echo $newsItem->Url; ?>"><?php echo $newsItem->Title; ?></a></li>
            <?php endforeach; ?>
          </ul>
          <?php elseif (isset ($galleries)): ?>
          <h3>Galerija</h3>
          <ul>
            <?php foreach ($galleries as $gallery): ?>
            <li><a href="<?php echo $gallery->Url; ?>"><?php echo $gallery->Title; ?></a></li>
            <?php endforeach; ?>
          </ul>
          <?php elseif (isset ($sideNavPages[0])): ?>
          <h3><?php echo $sideNavPages[0]->NavigationName; ?></h3>
          <?php if (isset ($sideNavPages[0]->Subpages)) FrontHelper::printSidePages ($sideNavPages[0]->Subpages, $activePage); ?>
          <?php endif; ?>
				</section>
		  </aside>
		  <?php $this->getElement ('navigation'); ?>
		  <?php $this->getElement ('mainContent'); ?>
		  <?php $this->getElement ('footer'); ?>
		  <?php $this->getElement ('scripts'); ?>
  </div>
	  </div>
  </body>
</html>
