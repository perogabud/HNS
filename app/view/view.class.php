<?php

class View {

  private $uri = '';
  private $params = array ();
  private $options = array ();
  private $manager;
  private $data = array ();

  /**
   * Main process controller
   */
  public function process ($uri) {
    $this->uri = $uri;
    $requestHandleTime = 0;
    $prepareCommonDataTime = 0;
    $processTemplateTime = 0;
    try {
      $this->_prepareApplication ();
      FB::group ('Parameters');
      FB::info ($this->params, 'params');
      FB::info ($_GET, '_GET');
      FB::info ($_POST, '_POST');
      FB::info ($_REQUEST, '_REQUEST');
      FB::info ($_FILES, '_FILES');
      FB::info ($_SESSION, '_SESSION');
      FB::info ($_COOKIE, '_COOKIE');
      FB::info (dirname (__FILE__), 'dirname');
      FB::groupEnd ();
      $this->_handleDebugOptions ();
      // Handle request
      $startTime = Tools::microtimeFloat ();
      $this->_handleRequest ();
      $endTime = Tools::microtimeFloat ();
      $requestHandleTime = $endTime - $startTime;
      // Prepare common data
      $this->_prepareCommonData ();
      // Process template
      $startTime = Tools::microtimeFloat ();
      $this->_processTemplate ();
      $endTime = Tools::microtimeFloat ();
      $processTemplateTime = $endTime - $startTime;
      $totalTime = $requestHandleTime + $processTemplateTime;
      FB::group ('Total time ['. sprintf ("%2.5f", $totalTime) .']', array ('Color' => $totalTime > 0.5 ? 'red' : 'green'));
      FB::info (sprintf ("%2.5f", $requestHandleTime) . ' sec', 'Handle request');
      FB::info (sprintf ("%2.5f", $processTemplateTime) . ' sec', 'Process template');
      FB::groupEnd ();
      //echo '<span style="display:none;">'. sprintf ("%2.5f", $totalTime) .' sec</span>';
      FB::info ($_SESSION, '_SESSION (final)');
      if (!isset ($_SESSION['redirect'])) {
        MessageManager::clearMessages ();
      }
      unset ($_SESSION['redirect']);
      FB::info ($this->data, 'ViewData');
    }
    catch (Exception $e) {
      if (Config::read ('debug')) {
        FB::error ($e->getMessage ());
      }
      else {
        // Send email to admin
        error_log ($e->getMessage (), 1, 'martin@fiktiv.hr');
      }
      error_log ($e->getMessage ());
      MessageManager::setGlobalMessage ($e->getMessage ());
    }
  }

  /**
   * Prepares the URI parameters.
   */
  private function _prepareApplication () {
    $request = explode (Config::read ('optionsDelimiter'), $this->uri);
    $uri = $request[0];
    // Handle debug options
    if (count ($request) == 2) {
      $options = explode (';', $request[1]);
      foreach ($options as $option) {
        $option = explode ('=', $option);
        $this->options[$option[0]] = $option[1];
      }
    }
    $this->params = explode ('/', $uri);
    // Handle trailing slash and remove last parameter if empty
    // unless it is the only parameter
    $paramsCount = count ($this->params);
    if (empty ($this->params[$paramsCount - 1]) && $paramsCount != 1) {
      unset ($this->params[$paramsCount - 1]);
    }


    if (in_array ($this->params[0], Config::read ('supportedLangs'))) {
      if ($this->params[0] == Config::read ('defaultLang')) {
        unset ($this->params[0]);
        Tools::redirect ('/' . implode ('/', $this->params));
      }
      Config::write ('lang', $this->params[0]);
      Config::write ('siteUrl', Config::read ('siteUrl') . '/' . Config::read ('lang'));
      Config::write ('siteUrlRoot', Config::read ('siteUrlRoot') . Config::read ('lang') . '/');
      if (count ($this->params) == 1) {
        $this->params[] = '';
      }
      unset ($this->params[0]);
      $this->params = array_values ($this->params);
    }
  }

  /**
   * Handles any debug options.
   */
  private function _handleDebugOptions () {
    if (Config::read ('options')) {
      // Override cache config
      foreach ($this->options as $option => $value) {
        if ($value == '1') {
          Config::write ($option, true);
        }
        elseif ($value == '0') {
          Config::write ($option, false);
        }
      }
    }
  }

  /**
   * Parses the URI parameters and sets templates and output.
   */
  private function _handleRequest () {
    switch ($this->params[0]) {
      case 'admin':
        $this->_setManager ('admin');
        break;
      case 'ajax':
        $this->_setManager ('ajax');
        break;
      default:
        $this->_setManager ('standard');
        break;
    }
    $this->manager->route ($this->params);
  }

  /**
   * Sets the appropriate content manager class.
   */
  private function _setManager ($name) {

    $filename = Config::read ('managersPath') . $name . 'ContentManager.class.php';

    if (is_file ($filename)) {
      require_once ($filename);
      $className = ucfirst ($name) . 'ContentManager';
      $this->manager = new $className ($this->params);
    }
    else {
      Tools::error ('File ' . $filename . ' doesn\'t exist!');
    }
  }

  private function _prepareCommonData () {
    $data = $this->manager->getData ();
    foreach ($data as $name => $value) {
      $this->data[$name] = $value;
    }
  }

  /**
   * Outputs currently set template.
   */
  private function _processTemplate () {
    extract ($this->data, EXTR_REFS);
    if (!include (Config::read ('templatesPath') . $this->manager->getTemplate () . '.php')) {
      throw new Exception ("No template (" . $this->manager->getTemplate () . ")");
    }
  }

  /**
   * Outputs an element to a template from which the method was called.
   */
  public function getElement ($name) {
    $startTime = Tools::microtimeFloat();
    // Check if requested element was explicitly
    // set in the content manager object
    $element = $this->manager->getElement ($name);
    if ($element == null) {
      $element = array ('filename' => $name);
    }
    // Check if element's filename was explicitly set,
    // if not, use element's name as filename
    else if (!isset ($element['filename'])) {
      $element['filename'] = $name;
    }
    $filename = Config::read ('elementsPath') . $element['filename'] . '.php';
    // FB::log ($element);
    // Check if caching is enables
    if (Config::read ('cache') == true
      && isset ($element['cache']['active'])
      && $element['cache']['active'] == true) {
      // Check for cache parameters
      $cacheParams = array ();
      if (isset ($element['cache']['params'])) {
        $cacheParams = $element['cache']['params'];
      }
      // Check for cached output file;
      // If element is cached by days check if cache expired
      $cacheFilename = Tools::getCacheFilename ($name, $cacheParams);
      //FB::log ($cacheFilename, 'cacheFilename');
      if (isset ($element['cache']['days'])) {
        $days = $element['cache']['days'];
        $cacheFilename = Tools::getDatedCacheFilename ($name, $cacheParams, $days);
        //FB::log ($cacheFilename, 'dateCacheFilename');
        //FB::log (file_exists ($cacheFilename), 'cachedFileExists');
      }
      // If cache file doesn't exist
      // create it and output it
      if (!include ($cacheFilename)) {
        $this->_setOutputData ($element);
        ob_start ();
        extract ($this->data, EXTR_REFS);
        if (!include ($filename)) {
          ob_end_clean ();
          Tools::error ('Element file "' . $filename . '" doesn\'t exist!');
          return NULL;
        }
        $output = ob_get_contents ();
        ob_end_clean ();
        FB::log ($cacheFilename, 'Creating cache file');
        // Delete cache files with old dates if any exist
        if (isset ($element['cache']['days'])) {
          $tempCacheFilename = explode ('.cch', Tools::getCacheFilename ($name, $cacheParams));
          //FB::log ($tempCacheFilename, 'tempCacheFilename');
          $filesToDelete = glob ($tempCacheFilename[0] . '*');
          //FB::log ($filesToDelete);
          if (!empty ($filesToDelete)) {
            foreach ($filesToDelete as $file) {
              unlink ($file);
            }
          }
        }
        // Write cache file
        $fileHandle = fopen ($cacheFilename, 'w');
        fwrite ($fileHandle, $output);
        fclose ($fileHandle);
        chmod ($cacheFilename, 0777);
        echo $output;
      }
      else {
        FB::log ($cacheFilename, 'Loading cache file');
      }
    }
    else {
      $this->_setOutputData ($element);
      extract ($this->data, EXTR_REFS);
      if (!include ($filename)) {
        FB::error ('Element file "' . $filename . '" doesn\'t exist!');
      }
    }
    /*
    elseif (is_file ($filename)) {
      // If element caching is not enabled, set
      // element data and include element file

      include ($filename);
    }
    else {
    }
    */
    $endTime = Tools::microtimeFloat ();
    FB::log (sprintf ("%2.5f", $endTime - $startTime) . ' sec', "Load element: $name");
  }

  /**
   * Sets output data for elements
   */
  private function _setOutputData ($element) {
    // Get cache parameters, if any exist
    $cacheParams = array ();
    if (isset ($element['cache']['params'])) {
      $cacheParams = $element['cache']['params'];
    }
    // If caching is disabled or no cache file for
    // current element exists, generate output data
    if (!Config::read ('cache') || !Tools::cacheExists ($element['filename'], $cacheParams)) {
      if (isset ($element['data'])) {
        foreach ($element['data'] as $name => $data) {
          // If element data should be generated by a controller method, populate
          // element data by calling that method
          if (is_array ($data) && isset ($data['controller']) && isset ($data['method'])) {
            $params = array ();
            if (isset ($data['params'])) {
              $params = $data['params'];
            }
            $controller = call_user_func_array ($data['controller'] . '::getInstance', array ($data['controller']));
            try {
              $this->data[$name] = call_user_func_array (
                array ($controller, $data['method']), $params
              );
            }
            catch (Exception $e) {
              Tools::error ($e->getMessage ());
            }
          }
          // If element data was not passed as a controller method, populate
          // element data with passed data
          else {
            $this->data[$name] = $data;
          }
          FB::warn ($this->data[$name], 'Data "'. $name .'" set for element "'. $element['filename'] .'"');
        }
      }
    }
  }

}

?>