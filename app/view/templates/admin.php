<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

  <head>
    <meta http-equiv="content-type" content="application/xhtml+xml; charset=utf-8" />
    <title><?php echo $this->data['pageTitle']; ?></title>
    <link rel="stylesheet" href="<?php echo Config::read ('siteUrlRoot'); ?>css/admin/style.css" media="screen,projection" type="text/css" />
    <link rel="stylesheet" href="<?php echo Config::read ('siteUrlRoot'); ?>js/chosen/chosenAdmin.css" media="screen,projection" type="text/css" />
    <link rel="shortcut icon" href="/img/favicon.png" type="image/png" />
    <script type="text/javascript">document.documentElement.className = 'js';</script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
    <script type="text/javascript" src="/js/chosen/chosen.jquery.min.js"></script>
    <link rel="stylesheet" href="<?php echo Config::read ('siteUrlRoot'); ?>js/admin/css/flick/jquery-ui-1.8.9.custom.css" media="screen,projection" type="text/css" />
  </head>

  <body>
    <div id="wrapper">
      <div id="header">
        <h1>Admin Panel</h1>
        <?php $activeClass = 'class="active"'; ?>
        <ul id="tabs">
          <li <?php echo $activeTab == 'newsItem' ? $activeClass : ''; ?>><a href="/admin/newsItem">News Items</a></li>
          <li <?php echo $activeTab == 'page' ? $activeClass : ''; ?>><a href="/admin/page">Pages</a></li>
          <li <?php echo $activeTab == 'actuality' ? $activeClass : ''; ?>><a href="/admin/actuality">Actualitys</a></li>
          <li <?php echo $activeTab == 'video' ? $activeClass : ''; ?>><a href="/admin/video">Videos</a></li>
          <li <?php echo $activeTab == 'gallery' ? $activeClass : ''; ?>><a href="/admin/gallery">Gallerys</a></li>
          <li <?php echo $activeTab == 'banner' ? $activeClass : ''; ?>><a href="/admin/banner">Banners</a></li>
          <li class="logout"><a href="/admin/logout">Log out</a></li>
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