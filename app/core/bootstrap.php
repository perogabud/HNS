<?php

if (get_magic_quotes_gpc ()) {
  $process = array (&$_GET, &$_POST, &$_COOKIE, &$_REQUEST);
  while (list($key, $val) = each ($process)) {
    foreach ($val as $k => $v) {
      unset ($process[$key][$k]);
      if (is_array ($v)) {
        $process[$key][stripslashes ($k)] = $v;
        $process[] = &$process[$key][stripslashes ($k)];
      }
      else {
        $process[$key][stripslashes ($k)] = stripslashes ($v);
      }
    }
  }
  unset ($process);
}

// Bootstraping logic
Config::write ('sitePath', str_replace ('app' . DIRECTORY_SEPARATOR . 'core', '', dirname (__FILE__)));
#set_include_path (Config::read ('sitePath'));
require_once (Config::read ('sitePath') . 'app/configuration.php');
require_once (Config::read ('sitePath') . 'app/core/configuration.php');
require_once (Config::read ('sitePath') . 'app/core/messageManager.class.php');
require_once (Config::read ('sitePath') . 'app/model/factories/factory.class.php');
require_once (Config::read ('sitePath') . 'app/view/managers/contentManager.class.php');
require_once (Config::read ('sitePath') . 'app/model/repositories/repository.class.php');
require_once (Config::read ('sitePath') . 'app/view/view.class.php');

require_once (Config::read ('sitePath') . 'app/vendors/FirePHPCore/fb.php');
FB::setEnabled (Config::read ('debug'));

ini_set ('url_rewriter.tags', '');

if (key_exists ('SESSION_ID', $_POST) && !empty ($_POST['SESSION_ID'])) {
  session_id ($_POST['SESSION_ID']);
}

date_default_timezone_set ('Europe/Zagreb');

session_start ();

/**
 * __autoload function setup for easy class file inclusion.
 * @param string $className Class name
 */
function __autoload ($className) {
  if ($className == '_P') {
    require_once (Config::read ('sitePath') . 'app/helpers/_P.class.php');
  }
  else {
    $filename = $className;
    $filename[0] = strtolower ($filename[0]);
    $filename .= '.class.php';
    if (strpos ($className, 'Helper')) {
      require_once (Config::read ('helpersPath') . $filename);
    }
    elseif (strpos ($className, 'Controller') !== FALSE) {
      require_once (Config::read ('controllersPath') . $filename);
    }
    elseif (strpos ($className, 'Repository') !== FALSE) {
      require_once (Config::read ('repositoriesPath') . $filename);
    }
    elseif (in_array ($className, array ('Tools', 'Response', 'Dict'))) {
      require_once (Config::read ('sitePath') . 'app/core/' . $filename);
    }
    elseif (is_file (Config::read ('sitePath') . 'app/model/' . $filename)) {
      require_once (Config::read ('sitePath') . 'app/model/' . $filename);
    }
    else {
      die ('Cannot find class ' . $className . '!');
    }
  }
}

?>
