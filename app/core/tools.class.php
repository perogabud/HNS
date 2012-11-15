<?php

class Tools {

  static public function microtimeFloat () {
    list ($usec, $sec) = explode (" ", microtime ());
    return ((float) $usec + (float) $sec);
  }

  static public function error ($message, $level = 0, $filename = null, $lineNumber = null) {
    switch ($level) {
      default:
        FB::error ($message);
        break;
    }
  }

  static public function getCacheFilename ($filename, $params) {
    $cacheParams = '';
    foreach ($params as $name => $value) {
      $cacheParams .= '_' . $name . '-' . $value;
    }
    return Config::read ('elementsCachePath') . $filename . $cacheParams . '.cch';
  }

  static function getDatedCacheFilename ($filename, $params, $days) {
    $cacheParams = '';
    foreach ($params as $name => $value) {
      $cacheParams .= '_' . $name . '-' . $value;
    }
    // ($days - 1) to handle today
    $date = date ('Y-m-d', strtotime ('+' . ($days - 1) . ' days'));
    return Config::read ('elementsCachePath') . $filename . $cacheParams . '_' . $date . '.cch';
  }

  static public function cacheExists ($name, $params = array ()) {
    if (file_exists (self::getCacheFilename ($name, $params))) {
      return true;
    }
    else {
      return false;
    }
  }

  static public function clearCache ($name, $params = array ()) {
    $filename = self::getCacheFilename ($name, $params);
    if (file_exists ($filename)) {
      return unlink ($filename);
    }
  }

  static public function stripTags ($string, $type = NULL) {
    $tags = NULL;
    $string = htmlspecialchars_decode ($string);
    $string = html_entity_decode ($string);
    $string = str_replace ("&scaron;", "š", $string);
    $string = str_replace ("&Scaron;", "Š", $string);
    switch ($type) {
      case 'strict':
        $tags = '<strong><em><ul><b><i>';
        break;
      case 'loose':
        $tags = '<strong><em><ul><b><i><p><a><img><ul><ol><li><dl><dd><dt><table><td><tr><th><tbody><thead><tfoot><h1><h2><h3><h4><h5><h6><span><blockquote><br>';
        break;
    }
    return strip_tags ($string, $tags);
  }

  static public function formatURI ($string) {
    $slug = trim ($string);
    $slug = htmlspecialchars_decode ($slug);
    $slug = html_entity_decode ($slug);
    // HTML decode
    $slug = str_replace ("&scaron;", "s", $slug);
    $slug = str_replace ("&Scaron;", "s", $slug);
    // Special characters
    $slug = str_replace ("&", "and", $slug);
    $slug = str_replace ("'", "", $slug);
    $slug = str_replace (".", "-", $slug);
    $slug = str_replace ("?", "-", $slug);
    $slug = str_replace ("!", "-", $slug);
    $slug = str_replace (":", "-", $slug);
    $slug = str_replace ("-", "", $slug);
    $slug = str_replace (",", "", $slug);
    $slug = str_replace ("\"", "", $slug);
    $slug = str_replace ("ć", "c", $slug);
    $slug = str_replace ("č", "c", $slug);
    $slug = str_replace ("š", "s", $slug);
    $slug = str_replace ("ž", "z", $slug);
    $slug = str_replace ("đ", "dj", $slug);
    $slug = str_replace ("Č", "c", $slug);
    $slug = str_replace ("Ć", "c", $slug);
    $slug = str_replace ("Š", "s", $slug);
    $slug = str_replace ("Ž", "z", $slug);
    $slug = str_replace ("Đ", "dj", $slug);
    $slug = str_replace (" ", "-", $slug);
    $slug = preg_replace ('/[^a-zA-Z0-9\-\s]/', '', $slug);
    $slug = preg_replace ('/(\s+|-+)/', '-', $slug);
    $slug = strtolower ($slug);
    return $slug;
  }

  static public function utf8wordwrap ($str, $len=50, $break=" ", $cut=false) {
    if (empty ($str))
      return "";
    $pattern = "";
    if (!$cut)
      $pattern = "/(\S{" . $len . "})/u";
    else
      $pattern="/(.{" . $len . "})/u";
    return preg_replace ($pattern, "\${1}" . $break, $str);
  }

  /**
   * word-sensitive substring static public function with html tags awareness
   * @param text The text to cut
   * @param len The maximum length of the cut string
   * @returns string
   * */
  static public function mb_substrws ($text, $len=180) {
    if ((mb_strlen ($text) > $len)) {
      $whitespaceposition = mb_strpos ($text, " ", $len) - 1;
      if ($whitespaceposition > 0) {
        $chars = count_chars (mb_substr ($text, 0, ($whitespaceposition + 1)), 1);
        if ($chars[ord ('<')] > $chars[ord ('>')])
          $whitespaceposition = mb_strpos ($text, ">", $whitespaceposition) - 1;
        $text = mb_substr ($text, 0, ($whitespaceposition + 1));
      }
      // close unclosed html tags
      if (preg_match_all ("|<([a-zA-Z]+)|", $text, $aBuffer)) {
        if (!empty ($aBuffer[1])) {
          preg_match_all ("|</([a-zA-Z]+)>|", $text, $aBuffer2);
          if (count ($aBuffer[1]) != count ($aBuffer2[1])) {
            foreach ($aBuffer[1] as $index => $tag) {
              if (empty ($aBuffer2[1][$index]) || $aBuffer2[1][$index] != $tag)
                $text .= '</' . $tag . '>';
            }
          }
        }
      }
    }
    return $text;
  }

  public static function getSmartTime ($from_time) {
    $to_time = strtotime (date ("Y-m-d H:i:s"));
    $from_time = strtotime ($from_time);
    $when = round (($to_time - $from_time) / 60);
    if ($when < 60) {
      $last = intval (substr ($when . "", -1));
      if ($when == 1)
        $when.=" minute ago";
      elseif ($last > 1 && $last < 5 && ($when > 14 || $when < 5))
        $when.=" minutes ago";
      else
        $when.=" minutes ago";
    }
    elseif ($when < 1440) {
      $when = round ($when / 60);
      $last = intval (substr ($when . "", -1));
      if ($when == 1)
        $when.=" hour ago";
      elseif ($last > 1 && $last < 5 && ($when > 14 || $when < 5))
        $when.=" hours ago";
      else
        $when.=" hours ago";
    }
    else {
      $when = round ($when / 1440);
      $when.=" days ago";
    }
    return $when;
  }

  static public function redirect ($url) {
    if (Config::read ('debug') === 2) {
      echo '<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="hr" lang="hr">
      <head>
        <title>Redirect</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="/css/redirect.css" media="screen,projection" type="text/css" />
      </head>
      <body>
      <div id="wrapper">';
      echo '<p>[DEBUG] You are being redirected to: <a href="' . $url . '">' . $url . '</a></p>';
      echo '<h3>$_GET</h3>';
      echo '<pre>';
      print_r ($_GET);
      echo '</pre>';
      echo '<h3>$_POST</h3>';
      echo '<pre>';
      print_r ($_POST);
      echo '</pre>';
      echo '<h3>$_FILES</h3>';
      echo '<pre>';
      print_r ($_FILES);
      echo '</pre>';
      echo '</div>
        </body>
        </html>';
      die ();
    }
    else {
      header ('Location: ' . $url . '');
      die;
    }
  }

  static function generatePassword ($numChars) {
    if (is_numeric ($numChars)
      && $numChars > 0
      && !is_null ($numChars)) {

      $password = '';
      $acceptedChars = 'abcdefghijklmnopqrstuvwxyz1234567890';

      for ($i = 0; $i < $numChars; $i++) {
        $random = rand (0, strlen ($acceptedChars) - 1);
        $password .= $acceptedChars[$random];
      }

      return $password;
    }
  }

  public static function specStrtolower ($string) {
    $output = strtolower ($string);
    $output = str_replace ('Č', 'č', $output);
    $output = str_replace ('Ć', 'ć', $output);
    $output = str_replace ('Ž', 'ž', $output);
    $output = str_replace ('Š', 'š', $output);
    $output = str_replace ('Đ', 'đ', $output);
    return $output;
  }

  public static function cutContent ($input, $maxLength = 800, $cutString = '...', $paragraph = TRUE) {
    //$output = strip_tags ($input, '<a><img><strong><em>');
    $output = $input;
    if (strlen ($output) > $maxLength) {
      $output = explode ('</p>', $output);
      $stripped = strip_tags ($output[0]);
      if (strlen ($stripped) > $maxLength) {
        $output = substr ($stripped, 0, $maxLength) . $cutString . '</p>';
      }
      else {
        if (substr (trim ($output[0]), -1) == '.' && $cutString == '...') {
          $cutString = '..';
        }
        $output = $output[0] . $cutString;
      }
    }
    if ($paragraph) {
      $output = '<p>' . $output . '</p>';
    }
    return $output;
  }

  public static function toggleClass ($first = FALSE, $class1 = 'odd', $class2 = 'even') {
    static $class;
    if ($first || $class == $class2 || empty ($class)) {
      $class = $class1;
    }
    else {
      $class = $class2;
    }
    return $class;
  }

  public static function getValidTimeZone ($string) {
    switch ($string) {
      case 'CEST':
        return 'CST';
        break;
      case 'CEDT':
        return 'CDT';
        break;
      default:
        return $string;
    }
  }

  public static function uploadFiles ($params) {
    $returnData = array ();
    FB::info ($params, 'uploadFilesDebug [params]');
    if (!isset ($params['name']) || !key_exists ($params['name'], $_FILES)) {
      FB::info ('Name error!', 'uploadFilesDebug [checkName]');
      return FALSE;
    }
    $filenames = array ();
    // Process files one by one
    if (!isset ($params['maxCount'])) {
      $params['maxCount'] = count ($_FILES[$params['name']]['name']);
    }
    for ($i = 0; $i < $params['maxCount']; $i++) {
      FB::log ('uploadFilesDebug [' . $i . ']');
      // Skip empty empty fields
      if ($_FILES[$params['name']]['name'][$i] == NULL) {
        FB::info ('Skipping file', 'uploadFilesDebug [error]');
        continue;
      }

      if (!isset ($params['type'])) {
        FB::info ($_FILES[$params['name']]['type'][$i], 'uploadFilesDebug [typeError]');
        return FALSE;
      }
      $fileExtension = explode ('.', $_FILES[$params['name']]['name'][$i]);
      $fileExtension = strtolower (end ($fileExtension));
      $fileType = $_FILES[$params['name']]['type'][$i];
      // Check extensions
      $type = '';
      $extension = '';
      switch ($params['type']) {
        case 'pdf':
          $type = 'application/pdf';
          $extension = 'pdf';
          break;
        case 'mp3':
          $type = 'audio/mp3';
          $extension = 'mp3';
          break;
        case 'ALL':
          $type = $fileType;
          $extension = $fileExtension;
          break;
        default:
          FB::info ($params['type'], 'uploadFilesDebug [unknownExtension]');
          return FALSE;
      }
      if (($fileType != $type
        && $extension != $fileExtension)) {
        FB::log ($extension . '/' . $fileExtension, 'uploadFilesDebug [extensionError]');
        return FALSE;
      }
      else {
        if (isset ($params['filenames']) && $params['filenames'] == 'KEEP_FILENAME') {
          $filename = explode ('.', $_FILES[$params['name']]['name'][$i]);
          unset ($filename[count ($filename) - 1]);
          $filename = implode ('.', $filename);
          $filenames[$i] = Tools::formatURI ($filename);
        }
        elseif (isset ($params['filenames'])) {
          $filenames = $params['filenames'];
        }
        else {
          do {
            $filename = Tools::generatePassword (28);
            FB::info ($filename, 'uploadFilesDebug [filename]');
            $filenames[$i] = $filename;
            break;
          } while (TRUE);
        }

        $filenames[$i] .= '.' . $extension;
        $destination = $params['directory'] . $filenames[$i];
        FB::info ($destination, 'uploadFilesDebug [destination]');
        $name = isset ($_FILES[$params['name']]['tmp_name'][$i]) ? $_FILES[$params['name']]['tmp_name'][$i] : $_FILES[$params['name']]['name'][$i];
        if (!move_uploaded_file ($name, $destination)) {
          FB::info ('Move file failed', 'uploadFilesDebug [moveUploadFile]');
          return FALSE;
        }
        $returnData[] = array (
            'filename' => $filenames[$i],
            'type' => $_FILES[$params['name']]['type'][$i],
            'size' => $_FILES[$params['name']]['size'][$i]
          );
      }
    }
    return $returnData;
  }

  public static function uploadImages ($params) {
    FB::info ($params, 'uploadImagesDebug [params]');
    if (!isset ($params['name']) || !key_exists ($params['name'], $_FILES)) {
      FB::info ('Name error!', 'uploadImagesDebug [checkName]');
      return FALSE;
    }
    $filenames = array ();
    $returnData = array ();
    // Process files one by one
    if (!isset ($params['maxCount'])) {
      $params['maxCount'] = count ($_FILES[$params['name']]['name']);
    }
    for ($i = 0; $i < $params['maxCount']; $i++) {
      FB::log ('uploadImagesDebug [' . $i . ']');
      // Skip empty empty fields
      if ($_FILES[$params['name']]['name'][$i] == NULL) {
        continue;
      }
      // Check if image is JPG
      $fileExtension = explode ('.', $_FILES[$params['name']]['name'][$i]);
      $fileExtension = strtolower (end ($fileExtension));
      FB::info ($_FILES[$params['name']]['type'][$i], 'uploadImagesDebug [type]');
      if (($_FILES[$params['name']]['type'][$i] == "image/jpeg")
        || ($_FILES[$params['name']]['type'][$i] == "image/pjpeg")
        || ($_FILES[$params['name']]['type'][$i] == "image/png")
        || ($_FILES[$params['name']]['type'][$i] == "application/octet-stream")) {

        if (isset ($params['filenames'])) {
          $filenames = $params['filenames'];
        }
        else {
          do {
            $filename = Tools::generatePassword (32) . '.' . $fileExtension;
            foreach ($params['types'] as $type) {
              if (file_exists ($type['directory'] . $filename)) {
                continue;
              }
            }
            FB::info ($filename, 'uploadImagesDebug [filename]');
            $filenames[$i] = $filename;
            break;
          } while (TRUE);
        }

        $dimensions = getimagesize ($_FILES[$params['name']]['tmp_name'][$i]);
        FB::info ($dimensions, 'uploadImagesDebug [uploadDimensions]');

        foreach ($params['types'] as $type) {
          // Check if directory exists
          if (!file_exists ($type['directory'])) {
            mkdir ($type['directory'], 0777, TRUE);
          }

          $targetPath = $type['directory'] . $filenames[$i];
          FB::info ($targetPath, 'uploadImagesDebug [targetPath]');

          // Set dimensions
          if (isset ($type['dimensions']) && ($type['dimensions']['width'] || $type['dimensions']['height'])) {
            if (!isset ($type['dimensions']['width'])) {
              $type['width'] = ($dimensions[0] / $dimensions[1]) * $type['dimensions']['height'];
              $type['height'] = $type['dimensions']['height'];
            }
            elseif (!isset ($type['dimensions']['height'])) {
              $type['height'] = $type['dimensions']['width'] / ($dimensions[0] / $dimensions[1]);
              $type['width'] = $type['dimensions']['width'];
            }
            else {
              $type['width'] = $type['dimensions']['width'];
              $type['height'] = $type['dimensions']['height'];
            }
          }
          else {
            $type['width'] = $dimensions[0];
            $type['height'] = $dimensions[1];
          }
          FB::info (array ('width' => $type['width'], 'height' => $type['height']), 'uploadImagesDebug [targetDimensions]');

          if ($dimensions[0] < $type['width'] || $dimensions[1] < $type['height']) {
            FB::warn ('uploadImagesDebug [invalidDimension(s)]');
            MessageManager::setInputMessage ($params['name'] . '[]', "Incorrect image dimensions, must be at least " . $type['width'] . " x " . $type['height'] . " px.");
            return FALSE;
          }

          if ($fileExtension == 'png') {
            $thumb = imagecreatetruecolor ($type['width'], $type['height']);
            imagealphablending ($thumb, false);
            imagesavealpha ($thumb, true);

            $source = imagecreatefrompng ($_FILES[$params['name']]['tmp_name'][$i]);
            imagealphablending ($source, true);

            imagecopyresampled ($thumb, $source, 0, 0, 0, 0, $type['width'], $type['height'], $dimensions[0], $dimensions[1]);

            imagepng ($thumb, $targetPath);
          }
          else {
            require_once (Config::read ('vendorsPath') . 'imageSnapshot.class.php');
            $myimage = new ImageSnapshot; //new instance
            $myimage->ImageFile = $_FILES[$params['name']]['tmp_name'][$i];
            $myimage->Width = $type['width']; //width of output image
            $myimage->Height = $type['height']; //height of output image
            $myimage->Resize = true; // resize image before crop
            $myimage->ResizeScale = 100; // between 1 and 100, 0 for no resizing before crop, 100 to shrink image completely before crop
            $myimage->Position = 'center';
            $myimage->Compression = 100; //jpg compression level
            $result = $myimage->SaveImageAs ($targetPath);
            FB::info ($result, 'uploadImagesDebug [result]');
          }
          $returnData[] = array (
            'filename' => $filename,
            'width' => $type['width'],
            'height' => $type['height']
          );
        }
      }
      else {
        MessageManager::setInputMessage ($params['name'] . '[]', 'Error: Invalid image file type!');
        return FALSE;
      }
    }
    return $returnData;
  }

  public static function setCookie ($name, $value) {
    setcookie (
      $name, $value, time () + 60 * 60 * 24 * 30, Config::read ('siteurl')
    );
  }

  public static function deleteCookie ($name) {
    setcookie (
      $name, 0, -1, Config::read ('siteurl')
    );
  }

  public static function getCookie ($name) {
    return isset ($_COOKIE[$name]) ? $_COOKIE[$name] : NULL;
  }

  public static function humanImplode ($seporator, array $array) {
    $array = array_values ($array);
    $string = '';
    $count = count ($array);
    for ($i = 0; $i < $count; $i++) {
      $string .= ( $i < $count - 1 || $count == 1) ? ($i == 0) ? $array[$i] : $seporator . $array[$i]  : ' and ' . $array[$i];
    }
    return $string;
  }

}

?>