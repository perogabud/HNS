<?php header("HTTP/1.0 404 Not Found"); ?>
<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en-US">
  <head>
    <title><?php echo $pageTitle; ?></title>
    <meta http-equiv="content-type" content="application/xhtml+xml; charset=utf-8" />
    <meta name="Robots" content="none" />
    <link rel="stylesheet" href="/css/style.css" media="screen,projection" type="text/css" />
  </head>

  <body>
    <h1>404</h1>
		<p>Stranica nije pronađena.</p>
    <pre style="display:none;">
    <?php print_r ($_GET); ?>
    </pre>
  </body>
</html>