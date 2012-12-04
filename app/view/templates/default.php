<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="hr" lang="hr">
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
  </head>
  <body>
  	<div id="wrapper">
	  	<div class="bg_left"></div>
  		<div class="bg_right"></div>
  		<aside id="sidebar">
			  <?php $this->getElement ('header'); ?>
			  <section class="subpage_nav">
			  	<ul>
			  		<li class="hns-shop"><a href="" ><img src="/img/hns_shop_160.png" alt="" ></a></li>
			  		<li><a href="" ><img src="/img/ulaznice_80.png" alt="" ></a></li>
			  		<li><a href="" ><img src="/img/raspored_80.png" alt="" ></a></li>
			  		<li><a href="" ><img src="/img/hns_tv_80.png" alt="" ></a></li>
			  		<li><a href="" ><img src="/img/galerija_80.png" alt="" ></a></li>
			  		<li><a href="/info-centar/aktualnosti" ><img src="/img/aktualno_80.png" alt="" ></a></li>
			  		<li><a href="" ><img src="/img/a_reprezentacija_80.png" alt="" ></a></li>
			  		<li><a href="" ><img src="/img/hns_casopis_80.png" alt="" ></a></li>
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
  </body>
</html>
