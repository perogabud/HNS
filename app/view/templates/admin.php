<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

  <head>
    <meta http-equiv="content-type" content="application/xhtml+xml; charset=utf-8" />
    <title><?php echo $this->data['pageTitle']; ?></title>
    <link rel="stylesheet" href="<?php echo Config::read ('siteUrlRoot'); ?>js/chosen/chosenAdmin.css" media="screen,projection" type="text/css" />
    <link rel="stylesheet" href="<?php echo Config::read ('siteUrlRoot'); ?>js/admin/jquery-ui-1.9.1.custom/css/custom-theme/jquery-ui-1.9.1.custom.min.css" media="screen,projection" type="text/css" />
    <link href="/js/admin/custom-scrollbar-plugin/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" href="/img/favicon.png" type="image/png" />
    <link rel="stylesheet" href="<?php echo Config::read ('siteUrlRoot'); ?>css/admin/style.css" media="screen,projection" type="text/css" />
    <script type="text/javascript">document.documentElement.className = 'js';</script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
    <script type="text/javascript" src="/js/chosen/chosen.jquery.min.js"></script>
    <script src="/js/admin/custom-scrollbar-plugin/jquery.mousewheel.min.js"></script>
    <script src="/js/admin/custom-scrollbar-plugin/jquery.mCustomScrollbar.js"></script>
  </head>

  <body>
    <div id="wrapper">
      <div id="header">
        <h1>HNS Administracija</h1>
        <?php $activeClass = 'class="active"'; ?>
        <ul id="tabs">
          <li <?php echo $activeTab == 'page' ? $activeClass : ''; ?>><a href="/admin/page">Stranice</a></li>
          <li <?php echo $activeTab == 'newsItem' ? $activeClass : ''; ?>><a href="/admin/newsItem">Novosti</a></li>
          <li <?php echo $activeTab == 'newsCategory' ? $activeClass : ''; ?>><a href="/admin/newsCategory">Kategorije</a></li>
          <li <?php echo $activeTab == 'actuality' ? $activeClass : ''; ?>><a href="/admin/actuality">Aktualnosti</a></li>
          <!--<li <?php echo $activeTab == 'video' ? $activeClass : ''; ?>><a href="/admin/video">HNS TV</a></li>-->
          <li <?php echo $activeTab == 'gallery' ? $activeClass : ''; ?>><a href="/admin/gallery">Galerije</a></li>
          <!--<li <?php echo $activeTab == 'banner' ? $activeClass : ''; ?>><a href="/admin/banner">Baneri</a></li>-->
          <!--<li <?php echo $activeTab == 'team' ? $activeClass : ''; ?>><a href="/admin/team">Reprezentacije</a></li>-->
          <li <?php echo $activeTab == 'member' ? $activeClass : ''; ?>><a href="/admin/member">Igrači i članovi momčadi</a></li>
          <li class="logout"><a href="/admin/logout">Odjava</a></li>
        </ul>
      </div>
      <div id="mainContent">
        <?php $this->getElement ('mainContent'); ?>
      </div>
    </div>
    <script type="text/javascript" src="<?php echo Config::read ('siteUrlRoot'); ?>js/ckeditor/ckeditor.js"></script>
    <script type="text/javascript" src="<?php echo Config::read ('siteUrlRoot'); ?>js/ckeditor/adapters/jquery.js"></script>
    <script src="<?php echo Config::read ('siteUrlRoot'); ?>js/admin/scripts.js" type="text/javascript"></script>
    <!-- Uploadify -->
    <link href="/js/uploadify/uploadify.css" type="text/css" rel="stylesheet" />
    <script type="text/javascript" src="/js/uploadify/swfobject.js"></script>
    <script type="text/javascript" src="/js/uploadify/jquery.uploadify.v2.1.4.min.js"></script>
  </body>
</html>
