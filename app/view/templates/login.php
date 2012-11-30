<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

  <head>
    <meta http-equiv="content-type" content="application/xhtml+xml; charset=utf-8" />
    <title><?php echo $this->data['pageTitle']; ?></title>
    <link rel="stylesheet" href="<?php echo Config::read ('siteUrlRoot'); ?>css/admin/style.css" media="screen,projection" type="text/css" />
    <link rel="shortcut icon" href="/img/favicon.png" type="image/png" />
    <script type="text/javascript">document.documentElement.className = 'js';</script>
    <link rel="stylesheet" href="<?php echo Config::read ('siteUrlRoot'); ?>js/admin/css/flick/jquery-ui-1.8.9.custom.css" media="screen,projection" type="text/css" />
  </head>

  <body>    
    <div id="wrapper">
      <div id="header">
        <h1>Admin Panel</h1>
        <br />
      </div>      
      <div id="mainContent">
        <?php if (isset ($this->data['message']) && !is_null ($this->data['message'])): ?>
          <p class="warning"><strong><?php echo $this->data['message']; ?></strong></p>
        <?php endif; ?>
        <form action="<?php echo Config::read ('siteUrlRoot') . 'admin/login'; ?>" method="post">
          <fieldset>
            <legend>Login</legend>
            <?php
            FormHelper::input ('text', 'adminUsername', 'adminUsername', array ('label' => array ('text' => 'Username')));
            FormHelper::input ('password', 'adminPassword', 'adminPassword', array ('label' => array ('text' => 'Password')));
            FormHelper::input ('submit', 'submit', 'submit', array ('value' => 'Submit'));
            ?>
          </fieldset>
        </form>
      </div>

    </div>
  </body>

</html>