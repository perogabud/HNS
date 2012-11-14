<?php
class UserRoleRepository extends Repository {

  public function __construct () {
    parent::__construct ();
  }

  /**
   * Method returns a single UserRole object.
   * @param array $params An array of parameters for query generation.
   * @return UserRole The requested UserRole object or NULL if none found.
   */
  public function getUserRole ($params = array ()) {
    if (empty ($params)) {
        return NULL;
      }
    
    $query = "
      SELECT *
      FROM ". DBP ."userRole AS u
      WHERE 1 = 1
    ";

    $queryParams = array ();

    if (array_key_exists ('userRoleId', $params)) {
      $query .= "
        AND u.userRoleId = :userRoleId
      ";
      $queryParams[':userRoleId'] = array (intval ($params['userRoleId']), PDO::PARAM_INT);
    }
    
    
    if (array_key_exists ('userId', $params)
      && is_numeric ($params['userId'])) {
      $query = "
        SELECT DISTINCT u.* 
          FROM ". DBP ."userRole AS u
          JOIN ". DBP ."userHasUserRole AS uRel
            ON u.userRoleId = uRel.userRoleId
          WHERE uRel.`userId` = :userId
       ";
      $queryParams[':userId'] = array ($params['userId'], PDO::PARAM_INT);
    }
    
    try {
      $results = $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
    }
    catch (Exception $e) {
      $message = 'An error occurred while fetching user role record';
      throw new Exception ($message . ': ' . $e->getMessage(), 1, $e);
    }

    if (!$results || empty ($results)) {
      return NULL;
    }
    
    $userRole = Factory::getUserRole ($results[0]);
      
    return $userRole;
  }

  /**
   * Method returns a count of UserRole records in the database.
   * @param array $params An array of parameters for query generation.
   * @return integer A count of UserRole records in the database.
   */
  public function getUserRoleCount ($params = array ()) {
    
    $query = "
      SELECT COUNT(userRoleId) AS userRoleCount
      FROM ". DBP ."userRole AS u
      WHERE 1 = 1
    ";
    $queryParams = array ();
    // Handle filter parameters
    if (isset ($params['filterParams']) && is_array ($params['filterParams'])
      && isset ($params['filterParams']['inSearch']) && is_array ($params['filterParams']['inSearch'])) {
      foreach ($params['filterParams']['inSearch'] as $attrName) {
        if (in_array ($attrName, array ('name'))) {
          if (in_array ($attrName, array ())) {
            $query .= "
              AND $attrName = :$attrName
            ";
            $queryParams[":$attrName"] = isset ($params['filterParams'][$attrName]) ? '1' : '0';
          }
          elseif (isset ($params['filterParams'][$attrName])) {
            $query .= "
              AND $attrName LIKE :$attrName
            ";
            $queryParams[":$attrName"] = '%'. $params['filterParams'][$attrName] .'%';
          }
        }
      }
    }
    else {
      // Handle parameters
      
    
    if (array_key_exists ('userId', $params)
      && is_numeric ($params['userId'])) {
      $query = "
        SELECT DISTINCT u.* 
          FROM ". DBP ."userRole AS u
          JOIN ". DBP ."userHasUserRole AS uRel
            ON u.userRoleId = uRel.userRoleId
          WHERE uRel.`userId` = :userId
       ";
      $queryParams[':userId'] = array ($params['userId'], PDO::PARAM_INT);
    }
    
    }

    try {
      $results = $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
    }
    catch (Exception $e) {
      $message = 'An error occurred while fething a count of user role records';
      throw new Exception ($message . ': ' . $e->getMessage(), 2, $e);
    }

    return intval ($results[0]['userRoleCount']);
  }
  /**
   * Method returns an array of UserRole objects.
   * @param array $params An array of parameters for query generation.
   * @return array An array of UserRole objects.
   */
  public function getUserRoles ($params = array ()) {
    
    $query = "
      SELECT *
      FROM ". DBP ."userRole AS u
      WHERE 1 = 1
    ";
    $queryParams = array ();
    // Handle filter parameters
    if (isset ($params['filterParams']) && is_array ($params['filterParams'])
      && isset ($params['filterParams']['inSearch']) && is_array ($params['filterParams']['inSearch'])) {
      foreach ($params['filterParams']['inSearch'] as $attrName) {
        if (in_array ($attrName, array ('name'))) {
          if (in_array ($attrName, array ())) {
            $query .= "
              AND $attrName = :$attrName
            ";
            $queryParams[":$attrName"] = isset ($params['filterParams'][$attrName]) ? '1' : '0';
          }
          elseif (isset ($params['filterParams'][$attrName])) {
            $query .= "
              AND $attrName LIKE :$attrName
            ";
            $queryParams[":$attrName"] = '%'. $params['filterParams'][$attrName] .'%';
          }
        }
      }
    }
    else {
      // Handle parameters
      
    
    if (array_key_exists ('userId', $params)
      && is_numeric ($params['userId'])) {
      $query = "
        SELECT DISTINCT u.* 
          FROM ". DBP ."userRole AS u
          JOIN ". DBP ."userHasUserRole AS uRel
            ON u.userRoleId = uRel.userRoleId
          WHERE uRel.`userId` = :userId
       ";
      $queryParams[':userId'] = array ($params['userId'], PDO::PARAM_INT);
    }
    
    }
    ;
		$query .= $this->_getOrderAndLimit ($params);

		$userRoles = array ();
    try {
      $results = $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
    }
    catch (Exception $e) {
      $message = 'An error occurred while fetching user role records';
      throw new Exception ($message . ': ' . $e->getMessage(), 2, $e);
    }

    foreach ($results as &$result) {
      
    }

    return Factory::getUserRoles ($results);
  }

  /**
   * Method inserts a new userRole into the database.
   * @param array $data Data for the new userRole.
   * @return integer userRoleId of the newly inserted userRole.
   */
  public function addUserRole ($data) {
    if (empty ($data) || !$this->_validateUserRoleData ($data)) {
      throw new Exception ('User Role did not pass validation.', 10);
    }

    try {
      $this->startTransaction ();
    
      $query = "
        INSERT INTO " . DBP . "userRole
        SET `name` = :name,
            `slug` = :slug,
            `created` = NOW(),
            `modified` = NOW()
      ";
      $queryParams = array (
        ':name' => Tools::stripTags (trim ($data['name'])),
        ':slug' => Tools::formatURI (Tools::stripTags (trim ($data['name'])))
      );
      $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
      $userRoleId = $this->lastInsertId ();
      
      $this->commit ();
    }
    catch (Exception $e) {
      $this->rollback ();
      $message = 'An error occurred while adding user role record';
      throw new Exception ($message . ': ' . $e->getMessage(), 3, $e);
    }
    return $this->getUserRole (array ('userRoleId' => $userRoleId));
  }

  /**
   * Method edits an existing userRole database record.
   * @param array $data New data for the userRole.
   * @return bool Success flag; TRUE if editing was successful, FALSE if not.
   */
  public function editUserRole ($userRoleId, $data) {
    if (empty ($data) || !$this->_validateUserRoleData ($data)) {
      throw new Exception ('Invalid data.', 10);
    }
    try {
      $this->startTransaction ();
      $query = "
        UPDATE " . DBP . "userRole
        SET `name` = :name,
            `slug` = :slug,
            `modified` = NOW(),
            modified = NOW()
        WHERE `userRoleId` = :userRoleId
      ";
      $queryParams = array (
        ':name' => Tools::stripTags (trim ($data['name'])),
        ':slug' => Tools::formatURI (Tools::stripTags (trim ($data['name']))),
        ':userRoleId' => array ($userRoleId, PDO::PARAM_INT)
      );
      $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
      $this->commit ();
    }
    catch (Exception $e) {
      $this->rollback ();
      $message = 'An error occurred while updating user role record';
      throw new Exception ($message . ': ' . $e->getMessage(), 4, $e);
    }

    return TRUE;
  }

  /**
   * Method deletes an existing userRole database record.
   * @param integer $userRoleId userRole database ID.
   * @return bool Success flag; TRUE if deleting was successful, FALSE if not.
   */
  public function deleteUserRole ($userRoleId) {
    try {
      $this->startTransaction ();
      $query = "
        DELETE FROM " . DBP . "userRole
        WHERE `userRoleId` = :userRoleId
      ";
      $queryParams = array (
        ':userRoleId' => array ($userRoleId, PDO::PARAM_INT)
      );
      $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
    
      $this->commit ();

      return TRUE;
     }
      catch (Exception $e) {
        $this->rollback ();
        $message = 'An error occurred while deleting user role record';
        throw new Exception ($message . ': ' . $e->getMessage(), 5, $e);
      }
  }
  

  private function _validateUserRoleData ($input) {
    if (!$this->checkSetData (
        $input,
        array ('name')
      )
    ) {
      return FALSE;
    }
    return $this->validateData (
      $input,
       array (
        'message' => 'Not all required fields have been filled in.',
        'rules' => array (
          'notEmpty' => array (
            'name' => 'Role Name cannot be empty.'
          ),
          'notEmptyLang' => array (
            
          )
        )
      )
    );
  }

}
?>