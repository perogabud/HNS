<?php

class Repository {

  protected static $_dbh = NULL;

  public function __construct () {
    if (!self::$_dbh) {

      try {
        self::$_dbh = new PDO (
            'mysql:host=' . Config::read ('dbhost') . ';dbname=' . Config::read ('dbname'),
            Config::read ('dbuser'),
            Config::read ('dbpass'),
            array (PDO::ATTR_PERSISTENT => TRUE)
        );
        self::$_dbh->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      }
      catch (PDOException $e) {
        throw $e;
      }
    }
    if (!defined ('DBP')) {
      define ('DBP', Config::read ('dbprefix'));
    }
    if (!is_null (Config::read ('lang')) && !defined ('LANG')) {
      define ('LANG', Config::read ('lang'));
    }
  }

  protected function changeDatabase (array $params) {
    $databaseName = $params['databaseName'];
    try {
      self::$_dbh = new PDO (
          'mysql:host=' . Config::read ('dbhost') . ';dbname=' . $databaseName,
          Config::read ('dbuser'),
          Config::read ('dbpass'),
          array (PDO::ATTR_PERSISTENT => TRUE)
      );
      self::$_dbh->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (PDOException $e) {
      throw $e;
    }
  }

  public function __call ($methodName, $args) {
    // Automatically handle 'getObject' methods
    $match = array ();
    if (preg_match ('/get(.+)Object/', $methodName, $match) && count ($args) >= 1) {
      $name = $match[1];
      $getCleanDataFunction = 'getClean' . $name . 'Data';
      $input = $args[0];
      if (count ($args) == 2) {
        $prefix = $args[1];
        foreach ($input as $key => $value) {
          $data[str_replace ($prefix, '', $key)] = $value;
        }
        $data = $this->$getCleanDataFunction ($data);
      }
      else {
        $data = $this->$getCleanDataFunction ($input);
      }
      return new $name ($data);
    }
  }

  public function dateInput ($array, $key) {
    if (isset ($array[$key . '_day'])
      && isset ($array[$key . '_month'])
      && isset ($array[$key . '_year'])
      && checkdate ($array[$key . '_month'], $array[$key . '_day'], $array[$key . '_year'])) {
      return $array[$key . '_year'] . '-' . $array[$key . '_month'] . '-' . $array[$key . '_day'];
    }
    else {
      return date ('Y-m-d');
    }
  }

  public function chkinput ($array, $key) {
    if (isset ($array[$key])) {
      return '1';
    }
    else {
      return '0';
    }
  }

  public function dbinput ($value) {
    $value = trim ($value);
    //if (get_magic_quotes_gpc ()) {
    //  $value = stripslashes ($value);
    //}
    //check if this static public function exists
    //if (function_exists ("mysql_real_escape_string")) {
    //$value = self::$_dbh->real_escape_string ($value);
    //}
    //for PHP version < 4.3.0 use addslashes
    //else {
    //  $value = addslashes ($value);
    //}
    return $value;
  }

  public function nullInput ($quote, $data, $key = NULL) {
    $q = "";
    if ($quote) {
      $q = "'";
    }
    if ($key === NULL) {
      return empty ($data) ? "NULL" : $q . ($quote ? $this->dbinput ($data) : $data) . $q;
    }
    elseif (is_array ($data)) {
      return empty ($data[$key]) ? "NULL" : $q . ($quote ? $this->dbinput ($data[$key]) : $data[$key]) . $q;
    }
    else {
      return empty ($data) ? "NULL" : $q . ($quote ? $this->dbinput ($key) : $key) . $q;
    }
  }

  /**
   *
   * @param string $query
   * @param string $fileName
   * @param int $lineNumber
   * @param boolean $die
   * @return mysqli_result
   */
  protected function query ($query, $fileName = null, $lineNumber = null, $die = TRUE) {
    if (!Config::read ('debug')) {
      $die = FALSE;
    }
    try {
      $startTime = Tools::microtimeFloat ();
      $statement = self::$_dbh->query ($query);
      $numRows = NULL;
      if ($statement) {
        $numRows = $statement->rowCount ();
      }
      $endTime = Tools::microtimeFloat ();
      $time = $endTime - $startTime;
      FB::group ('QueryDebug [' . sprintf ("%2.5f", $time) . ' sec][' . $numRows . ']', array ('Color' => $numRows ? 'green' : 'gray'));
      FB::info (sprintf ("%2.5f", $time) . ' sec', 'Time');
      FB::info ($numRows, 'Rows');
      FB::log ($query);
      FB::groupEnd ();
      $results = TRUE;
      if ($numRows) {
        $results = $statement->fetchAll (PDO::FETCH_ASSOC);
        FB::log ($results, 'Results');
        foreach ($results as &$result) {
          foreach ($result as &$attribute) {
            $attribute = stripslashes ($attribute);
          }
        }
      }
      return $results;
    }
    catch (PDOException $e) {
      if ($fileName != null && $lineNumber != null) {
          $message = "
          <strong>[" . $fileName . " (" . $lineNumber . ")]</strong>: <br />Error in query:<br /><br /> " .
            $query . '<br /><br />' .
            '<em>' . $e->getMessage () . '</em>
        ';
          if ($die) {
            die ($message);
          }
          else {
            FB::error ($e);
            throw $e;
          }
      }
      else {
          $message = "
          Error in query: <br /><br /> " .
            $query . '<br /><br />' .
            '<em>' . $e->getMessage () . '</em>
        ';
          if ($die) {
            die ();
          }
          else {
            FB::error ($e);
            throw $e;
          }
        }
    }
  }

  protected function _preparedQuery ($query, $params, $fileName = null, $lineNumber = null, $message = NULL, $die = FALSE) {
    if (!Config::read ('debug')) {
      $die = FALSE;
    }

    $result = NULL;
    try {
      $statement = self::$_dbh->prepare ($query);
      foreach ($params as $name => &$value) {
        if (is_array ($value)) {
          $statement->bindValue ($name, $value[0], $value[1]);
        }
        else {
          $statement->bindValue ($name, $value);
        }
      }

      $startTime = Tools::microtimeFloat ();
      $result = $statement->execute ();
      $endTime = Tools::microtimeFloat ();

      $numRows = $statement->rowCount ();
      $time = $endTime - $startTime;

      // Log data
      FB::group ('QueryDebug [' . sprintf ("%2.5f", $time) . ' sec][' . $numRows . '] ' . $message, array ('Color' => $numRows ? 'green' : 'gray'));
      FB::info (sprintf ("%2.5f", $time) . ' sec', 'Time');
      FB::info ($numRows, 'Rows');
      FB::info ($params, 'Params');

      // Get debug string
      if (Config::read ('debug')) {
        ob_start ();
        $statement->debugDumpParams ();
        $output = ob_get_contents ();
        ob_end_clean ();
      }
      //FB::log ($output);
      FB::log ($query);

      $results = array ();
      if ($statement->columnCount ()) {
        $results = $statement->fetchAll (PDO::FETCH_ASSOC);
        if (Config::read ('debug') == 2) {
          FB::log ($results, 'Results');
        }
        FB::groupEnd ();
        return $results;
      }
      FB::groupEnd ();
      return $result;
    }
    catch (PDOException $e) {
      FB::error ($e);
      if ($die) {
        die ($message);
      }
      else {
        throw $e;
      }
    }
  }

  protected function prepareQueryForOrderAndLimit ($query, $params, $fields) {
    if (!isset ($params['rowsPerPage'])) {
      $params['rowsPerPage'] = Config::read ('adminItemsPerPage');
    }
    // Handle order field
    if (isset ($fields) && isset ($params['order']) && in_array ($params['order'], $fields)) {
      $query .= "
        ORDER BY " . $params['order'] . "
      ";
      // Handle order direction
      if (isset ($params['direction']) && in_array ($params['direction'], array ('asc', 'desc'))) {
        $query .= " " . $params['direction'];
      }
    }
    // Handle limit
    if (isset ($params['start'])) {
      $query .= " LIMIT " . $params['start'] . ", " . ($params['start'] + $params['rowsPerPage']);
    }
    elseif (isset ($params['page']) && $params['page'] > 0 && isset ($params['rowsPerPage'])) {
      $query .= " LIMIT " . (($params['page'] - 1) * $params['rowsPerPage']) . ", " . ($params['page'] * $params['rowsPerPage']);
    }
    return $query;
  }

  protected function getCount ($countQuery) {
    $result = $this->query ($countQuery, __FILE__, __LINE__);
    if ($result) {
      $row = $result->fetch_array ();
      return intval ($row[0]);
    }
    else {
      return 0;
    }
  }

  protected function startTransaction () {
    self::$_dbh->beginTransaction ();
  }

  protected function rollback () {
    self::$_dbh->rollBack ();
  }

  protected function commit () {
    self::$_dbh->commit ();
  }

  protected function lastInsertId () {
    return self::$_dbh->lastInsertId ();
  }

  protected function _moveEntry ($params = array ()) {
    if (!isset ($params['attributeName'])
      || !isset ($params['tableName'])
      || !isset ($params['direction'])
      || !isset ($params['entryId'])) {
      return FALSE;
    }
    $parentAttributeName = NULL;
    $parentId = NULL;
    $entryAttributeName = 'id';
    extract ($params);
    // Get position
    $query = "
      SELECT $attributeName
      FROM " . DBP . "$tableName
      WHERE $entryAttributeName = :$entryAttributeName
    ";
    $queryParams = array (
      ":$entryAttributeName" => array ($entryId, PDO::PARAM_INT)
    );
    if ($parentAttributeName && $parentId) {
      $query .= "
        AND $parentAttributeName = :$parentAttributeName
      ";
      $queryParams[":$parentAttributeName"] = array ($parentId, PDO::PARAM_INT);
    }
    $result = $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
    if (!$result) {
      $_SESSION['message'] = 'An error occured while moving entry!';
      return FALSE;
    }
    $position = $result[0]['position'];
    // Get max position
    $query = "
      SELECT MAX($attributeName) as max_position
      FROM " . DBP . "$tableName
    ";
    $queryParams = array ();
    if ($parentAttributeName && $parentId) {
      $query .= "
        WHERE $parentAttributeName = :$parentAttributeName
      ";
      $queryParams[":$parentAttributeName"] = array ($parentId, PDO::PARAM_INT);
    }
    $result = $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
    if (!$result) {
      $_SESSION['message'] = 'An error occurred while moving entry!';
      return FALSE;
    }
    $maxPosition = $result[0]['max_position'];
    $minPosition = 1;

    $this->startTransaction ();
    switch ($direction) {
      case 'up':
        // Move selected item
        $newPosition = $position - 1;
        if ($position == $minPosition) {
          $newPosition = $maxPosition;
          $query = "
            UPDATE " . DBP . "$tableName
            SET $attributeName = :$attributeName
            WHERE $entryAttributeName = :$entryAttributeName
          ";
          $queryParams = array (
            ":$entryAttributeName" => array ($entryId, PDO::PARAM_INT),
            ":$attributeName" => array ($newPosition + 1, PDO::PARAM_INT)
          );
          if ($parentAttributeName && $parentId) {
            $query .= "
              AND $parentAttributeName = :$parentAttributeName
            ";
            $queryParams[":$parentAttributeName"] = array ($parentId, PDO::PARAM_INT);
          }
          $query .= "
            LIMIT 1
          ";
          $result = $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
          if (!$result) {
            $_SESSION['message'] = 'An error occurred while moving entry!';
            $this->rollback ();
            return FALSE;
          }
          // Move all other items
          $query = "
            UPDATE " . DBP . "$tableName
            SET $attributeName = $attributeName - 1
          ";
          $queryParams = array (
          );
          if ($parentAttributeName && $parentId) {
            $query .= "
              WHERE $parentAttributeName = :$parentAttributeName
            ";
            $queryParams[":$parentAttributeName"] = array ($parentId, PDO::PARAM_INT);
          }
          $result = $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
          if (!$result) {
            $_SESSION['message'] = 'An error occurred while moving entry!';
            $this->rollback ();
            return FALSE;
          }
        }
        else {
          $query = "
            UPDATE " . DBP . "$tableName
            SET $attributeName = :position
            WHERE $attributeName = :newPosition
          ";
          $queryParams = array (
            ":position" => array ($position, PDO::PARAM_INT),
            ":newPosition" => array ($newPosition, PDO::PARAM_INT)
          );
          if ($parentAttributeName && $parentId) {
            $query .= "
              AND $parentAttributeName = :$parentAttributeName
            ";
            $queryParams[":$parentAttributeName"] = array ($parentId, PDO::PARAM_INT);
          }
          $query .= "
            LIMIT 1
          ";
          $result = $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
          if (!$result) {
            $_SESSION['message'] = 'An error occurred while moving entry!';
            $this->rollback ();
            return FALSE;
          }
          // Move second page
          $query = "
            UPDATE " . DBP . "$tableName
            SET $attributeName = :$attributeName
            WHERE $entryAttributeName = :$entryAttributeName
          ";
          $queryParams = array (
            ":$entryAttributeName" => array ($entryId, PDO::PARAM_INT),
            ":$attributeName" => array ($newPosition, PDO::PARAM_INT)
          );
          if ($parentAttributeName && $parentId) {
            $query .= "
              AND $parentAttributeName = :$parentAttributeName
            ";
            $queryParams[":$parentAttributeName"] = array ($parentId, PDO::PARAM_INT);
          }
          $query .= "
            LIMIT 1
          ";
          $result = $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
          if (!$result) {
            $_SESSION['message'] = 'An error occurred while moving entry!';
            $this->rollback ();
            return FALSE;
          }
        }
        break;
      case 'down':
        // Move first page
        $newPosition = $position + 1;
        if ($position == $maxPosition) {
          $newPosition = $minPosition;
          $query = "
            UPDATE " . DBP . "$tableName
            SET $attributeName = :$attributeName
            WHERE $entryAttributeName = :$entryAttributeName
          ";
          $queryParams = array (
            ":$entryAttributeName" => array ($entryId, PDO::PARAM_INT),
            ":$attributeName" => array ($newPosition - 1, PDO::PARAM_INT)
          );
          if ($parentAttributeName && $parentId) {
            $query .= "
              AND $parentAttributeName = :$parentAttributeName
            ";
            $queryParams[":$parentAttributeName"] = array ($parentId, PDO::PARAM_INT);
          }
          $query .= "
            LIMIT 1
          ";
          $result = $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
          if (!$result) {
            $_SESSION['message'] = 'An error occurred while moving entry!';
            $this->rollback ();
            return FALSE;
          }
          // Move all other items
          $query = "
            UPDATE " . DBP . "$tableName
            SET $attributeName = $attributeName + 1
          ";
          $queryParams = array (
          );
          if ($parentAttributeName && $parentId) {
            $query .= "
              WHERE $parentAttributeName = :$parentAttributeName
            ";
            $queryParams[":$parentAttributeName"] = array ($parentId, PDO::PARAM_INT);
          }
          $result = $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
          if (!$result) {
            $_SESSION['message'] = 'An error occurred while moving entry!';
            $this->rollback ();
            return FALSE;
          }
        }
        else {
          $query = "
            UPDATE " . DBP . "$tableName
            SET $attributeName = :position
            WHERE $attributeName = :newPosition
          ";
          $queryParams = array (
            ":position" => array ($position, PDO::PARAM_INT),
            ":newPosition" => array ($newPosition, PDO::PARAM_INT)
          );
          if ($parentAttributeName && $parentId) {
            $query .= "
              AND $parentAttributeName = :$parentAttributeName
            ";
            $queryParams[":$parentAttributeName"] = array ($parentId, PDO::PARAM_INT);
          }
          $query .= "
            LIMIT 1
          ";
          $result = $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
          if (!$result) {
            $_SESSION['message'] = 'An error occurred while moving entry!';
            $this->rollback ();
            return FALSE;
          }
          // Move second page
          $query = "
            UPDATE " . DBP . "$tableName
            SET $attributeName = :$attributeName
            WHERE $entryAttributeName = :$entryAttributeName
          ";
          $queryParams = array (
            ":$entryAttributeName" => array ($entryId, PDO::PARAM_INT),
            ":$attributeName" => array ($newPosition, PDO::PARAM_INT)
          );
          if ($parentAttributeName && $parentId) {
            $query .= "
              AND $parentAttributeName = :$parentAttributeName
            ";
            $queryParams[":$parentAttributeName"] = array ($parentId, PDO::PARAM_INT);
          }
          $query .= "
            LIMIT 1
          ";
          $result = $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
          if (!$result) {
            $_SESSION['message'] = 'An error occurred while moving entry!';
            $this->rollback ();
            return FALSE;
          }
        }
        break;
    }
    $this->commit ();
    return TRUE;
  }

  protected function validateInput ($input, $rules) {
    if (isset ($rules['notEmpty']) && is_array ($rules['notEmpty'])) {
      foreach ($rules['notEmpty'] as $name) {
        if ($input[$name] == '') {
          $_SESSION['message'] = 'One or more required fields are empty!';
          return FALSE;
        }
      }
    }
    if (isset ($rules['notEmptyLang']) && is_array ($rules['notEmptyLang'])) {
      foreach ($rules['notEmptyLang'] as $name) {
        foreach (LANG as $lang) {
          if ($input[$name . '_' . $lang] == '') {
            $_SESSION['message'] = 'One or more required fields are empty!';
            return FALSE;
          }
        }
      }
    }
    return TRUE;
  }

  protected function getCleanData (array $input, array $fields) {
    $data = array ();
    foreach ($input as $name => $value) {
      // Data that needs slash stripping
      if (isset ($fields['stripData']) && in_array ($name, $fields['stripData'])
        && !is_object ($value)) {
        $data[$name] = stripslashes ($value);
      }
      // Handle language columns
      elseif (isset ($fields['stripLangData']) && in_array ($name, $fields['stripLangData'])) {
        foreach (Config::read ('supportedLangs') as $lang) {
          if (isset ($input[$name . '_' . $lang])) {
            $data[$name . '_' . $lang] = stripslashes ($input[$name . '_' . $lang]);
          }
        }
      }
      // Data that's already clean
      else {
        $data[$name] = $value;
      }
    }
    return $data;
  }

  public function validateData ($input, $rules) {
    $valid = TRUE;
    // Not empty
    if (isset ($rules['rules']['notEmpty'])) {
      foreach ($rules['rules']['notEmpty'] as $name => $message) {
        if (trim (strip_tags ($input[$name])) == '') {
          $valid = FALSE;
          MessageManager::setInputMessage ($name, $message);
        }
      }
    }
    // Not empty language
    if (isset ($rules['rules']['notEmptyLang'])) {
      foreach (Config::read ('supportedLangs') as $lang) {
        foreach ($rules['rules']['notEmptyLang'] as $name => $message) {
          if (trim (strip_tags ($input[$name . '_' . $lang])) == '') {
            $valid = FALSE;
            MessageManager::setInputMessage ($name . '_' . $lang, $message);
          }
        }
      }
    }

    // Max length
    if (isset ($rules['rules']['maxLength'])) {
      foreach ($rules['rules']['maxLength'] as $name => $data) {
        if (strlen (trim ($input[$name])) > intval ($data[0])) {
          $valid = FALSE;
          MessageManager::setInputMessage ($name, $data[1]);
        }
      }
    }
    // Max length language
    if (isset ($rules['rules']['maxLengthLang'])) {
      foreach (Config::read ('supportedLangs') as $lang) {
        foreach ($rules['rules']['maxLengthLang'] as $name => $data) {
          if (strlen (trim ($input[$name . '_' . $lang])) > intval ($data[0])) {
            $valid = FALSE;
            MessageManager::setInputMessage ($name . '_' . $lang, $data[1]);
          }
        }
      }
    }

    // Unique
    if (isset ($rules['rules']['unique'])) {
      foreach ($rules['rules']['unique'] as $name => $data) {
        if (isset ($data[0])) {
          $query = "
            SELECT '1'
            FROM " . $data[1] . "
            WHERE 1 = 1
              " . ($data[0] ? "AND id <> " . intval ($data[0]) : '') . "
              AND " . $name . " = '" . $this->dbinput ($input[$name]) . "'
            LIMIT 1
          ";
          $result = $this->query ($query, __FILE__, __LINE__);
          if ($result && $result->num_rows > 0) {
            $valid = FALSE;
            if (isset ($data[3])) {
              MessageManager::setInputMessage ($data[3], $data[2]);
            }
            else {
              MessageManager::setInputMessage ($name, $data[2]);
            }
          }
        }
      }
    }
    // Unique language
    if (isset ($rules['rules']['uniqueLang'])) {
      foreach (Config::read ('supportedLangs') as $lang) {
        foreach ($rules['rules']['uniqueLang'] as $name => $data) {
          if (isset ($data[0])) {
            $query = "
            SELECT '1'
            FROM " . $data[1] . "
            WHERE 1 = 1
              " . ($data[0] ? "AND id <> " . intval ($data[0]) : '') . "
              AND " . $name . '_' . $lang . " = '" . $this->dbinput ($input[$name . '_' . $lang]) . "'
            LIMIT 1
          ";
            $result = $this->query ($query, __FILE__, __LINE__);
            if ($result && $result->num_rows > 0) {
              $valid = FALSE;
              MessageManager::setInputMessage ($name . '_' . $lang, $data[2]);
            }
          }
        }
      }
    }
    // Email
    if (isset ($rules['rules']['email'])) {
      foreach ($rules['rules']['email'] as $name => $message) {
        if (isset ($input[$name])) {
          if (!preg_match ('/^[A-Za-z0-9!#$%&\'*+-=?^_`{|}~]+@[A-Za-z0-9-]+(\.[A-Za-z0-9-]+)+[A-Za-z]$/i', $input[$name])) {
            $valid = FALSE;
            MessageManager::setInputMessage ($name, $message);
          }
        }
      }
    }
    // Uri
    if (isset ($rules['rules']['uri'])) {
      foreach ($rules['rules']['uri'] as $name => $message) {
        if (isset ($input[$name])) {
          if (!preg_match ('/^[a-z0-9_\-]+$/', $input[$name])) {
            $valid = FALSE;
            MessageManager::setInputMessage ($name, $message);
          }
        }
      }
    }
    // Date
    if (isset ($rules['rules']['date'])) {
      foreach ($rules['rules']['date'] as $name => $message) {
        if (isset ($input[$name]) && !empty ($input[$name])) {
          if (strtotime ($input[$name]) === FALSE) {
            $valid = FALSE;
            MessageManager::setInputMessage ($name, $message);
          }
        }
      }
    }
    if (!$valid) {
      MessageManager::setGlobalMessage ($rules['message']);
    }
    return $valid;
  }

  protected function checkSetData ($input, array $keys) {
    foreach ($keys as $key) {
      if (!isset ($input[$key])) {
        FB::error ('dataNotSet: ' . $key);
        return FALSE;
      }
    }
    return TRUE;
  }

  protected function getCleanModelCodeData ($input) {
    return $this->getCleanData (
      $input, array (
      'stripData' => array (
        'name'
      )
      )
    );
  }

  /**
   * Adds a condition to the SQL query WHERE statement.
   * @param string $query SQL Query
   * @param array $queryParams An array of parameters for the prepared PDO Statement
   * @param array $params An array of parameters
   * @param string $paramName Parameter name
   * @param string $sqlColName SQL column name
   * @param int $type PDO::PARAM constant describing the type parameter, PARAM_STR is default
   */
  protected function _prepQueryForParam (&$query, &$queryParams, $sqlColName, &$params, $paramName, $type = PDO::PARAM_STR, $value = NULL) {
    if (isset ($params[$paramName])) {
      if (is_null ($value)) {
        $value = $params[$paramName];
      }
      if ($type == PDO::PARAM_INT && !is_numeric ($value)) {
        throw new Exception ("Parameter \"$paramName\" not numeric!");
      }
      $query .= "
        AND $sqlColName = :$paramName
      ";
      $queryParams[':' . $paramName] = array ($value, $type);
    }
  }

  protected function _getOrderAndLimit ($params) {
    FB::log ($params);
    $order = 'created';
    if (isset ($params['orderBy'])) {
      $order = trim ($params['orderBy']);
    }
    $direction = 'DESC';
    if (isset ($params['orderDirection']) && in_array (strtoupper ($params['orderDirection']), array ('ASC', 'DESC'))) {
      $direction = strtoupper ($params['orderDirection']);
    }

    $limit = NULL;
    if (isset ($params['limit'])) {
      $limit = intval ($params['limit']);
    }
    $iteration = 1;
    if (isset ($params['iteration'])) {
      $iteration = intval ($params['iteration']);
      if ($iteration < 1) {
        $iteration = 1;
      }
    }

    $query = "
			ORDER BY $order $direction
		";
    if (isset ($params['limitStart']) && !is_null ($limit)) {
      $query .= "
				LIMIT " . intval ($params['limitStart']) . ", $limit
			";
    }
    elseif (!is_null ($limit)) {
      $query .= "
				LIMIT " . ($iteration - 1) * $limit . ", $limit
			";
    }
    return $query;
  }

  public function getLanguage ($params = array ()) {
    if (empty ($params)) {
        return NULL;
      }

    $query = "
      SELECT *
      FROM ". DBP ."language AS l
      WHERE 1 = 1
    ";

    $queryParams = array ();

    if (array_key_exists ('languageId', $params)) {
      $query .= "
        AND l.languageId = :languageId
      ";
      $queryParams[':languageId'] = trim ($params['languageId']);
    }

    try {
      $results = $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
    }
    catch (Exception $e) {
      $message = 'An error occurred while fetching news item record';
      throw new Exception ($message . ': ' . $e->getMessage(), 1, $e);
    }

    if (!$results || empty ($results)) {
      return NULL;
    }

    return Factory::getLanguage ($results[0]);
  }

  public function getLanguages ($params = array ()) {

    $query = "
      SELECT *
      FROM ". DBP ."language AS l
      WHERE 1 = 1
    ";
    $queryParams = array ();

		$languages = array ();
    try {
      $results = $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
    }
    catch (Exception $e) {
      $message = 'An error occurred while fetching news item records';
      throw new Exception ($message . ': ' . $e->getMessage(), 2, $e);
    }

    return Factory::getLanguages ($results);
  }

}

?>