<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="hr" lang="hr">
  <head>
    <title><?php echo $pageTitle; ?></title>
    <meta name="Description" content="" />
    <meta name="Keywords" content="" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script type="text/javascript">document.documentElement.className = 'js';</script>
    <link rel="stylesheet" href="/css/style.css" type="text/css" />
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
			  		<li class="hns-shop"><a href="" ><img src="/img/hns_shop_160.png" alt="" style="border: 1px solid #999;"></a></li>
			  		<li><a href="" ><img src="/img/ulaznice_80.png" alt="" ></a></li>
			  		<li><a href="" ><img src="/img/raspored_80.png" alt="" ></a></li>
			  		<li><a href="" ><img src="/img/hns_tv_80.png" alt="" ></a></li>
			  		<li><a href="" ><img src="/img/galerija_80.png" alt="" ></a></li>
			  		<li><a href="/info-centar/aktualnosti" ><img src="/img/aktualno_80.png" alt="" ></a></li>
			  		<li><a href="" ><img src="/img/a_reprezentacija_80.png" alt="" ></a></li>
			  		<li><a href="" ><img src="/img/brojac_80.png" alt="" style="border: 1px solid #999;" ></a></li>
			  	</ul>
			  </section>
			  <section class="subpage_categories">
          <?php if (isset ($sideNavPages[0])): ?>
          <h3><?php echo $sideNavPages[0]->NavigationName; ?></h3>
          <?php if (isset ($sideNavPages[0]->Subpages)) FrontHelper::printSidePages ($sideNavPages[0]->Subpages); ?>
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