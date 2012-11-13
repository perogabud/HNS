<?php

ob_start ();

require_once ('app/core/config.class.php');
require_once ('app/core/bootstrap.php');


// Get object
$uri = isset ($_GET['object']) ? $_GET['object'] : '';
$view = new View ();

// Run process
$view->process ($uri);

ob_end_flush ();

?>
