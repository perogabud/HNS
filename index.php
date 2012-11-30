<?php

// Handle magic quotes
if (get_magic_quotes_gpc()) {
    $process = array(&$_GET, &$_POST, &$_COOKIE, &$_REQUEST);
    while (list($key, $val) = each($process)) {
        foreach ($val as $k => $v) {
            unset($process[$key][$k]);
            if (is_array($v)) {
                $process[$key][stripslashes($k)] = $v;
                $process[] = &$process[$key][stripslashes($k)];
            } else {
                $process[$key][stripslashes($k)] = stripslashes($v);
            }
        }
    }
    unset($process);
}

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
