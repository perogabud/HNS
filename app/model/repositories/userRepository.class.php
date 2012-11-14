<?php
class UserRepository extends Repository {

  public function __construct () {
    parent::__construct ();
  }

  /**
   * Method returns a single User object.
   * @param array $params An array of parameters for query generation.
   * @return User The requested User object or NULL if none found.
   */
  public function getUser ($params = array ()) {
    if (empty ($params)) {
        return NULL;
      }
    
    $query = "
      SELECT *
      FROM ". DBP ."user AS u
      WHERE 1 = 1
    ";

    $queryParams = array ();

    if (array_key_exists ('userId', $params)) {
      $query .= "
        AND u.userId = :userId
      ";
      $queryParams[':userId'] = array (intval ($params['userId']), PDO::PARAM_INT);
    }
    
    if (isset ($params['username']) && isset ($params['password'])) {
      $query .= "
        AND `username` = :username
        AND `password` = :password
       ";
      $queryParams[':username'] = trim ($params['username']);
      $queryParams[':password'] = md5 ($params['password']);
    }
                    
    try {
      $results = $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
    }
    catch (Exception $e) {
      $message = 'An error occurred while fetching user record';
      throw new Exception ($message . ': ' . $e->getMessage(), 1, $e);
    }

    if (!$results || empty ($results)) {
      return NULL;
    }
    
    $user = Factory::getUser ($results[0]);
      
    $userRoleRepository = new UserRoleRepository ();
    $userRoles = $userRoleRepository->getUserRoles (
      array (
        'userId' => $user->getId (),
        'relationName' => 'userRole'
      )
    );
    $user->setUserRoles ($userRoles);
    
    return $user;
  }

  /**
   * Method returns a count of User records in the database.
   * @param array $params An array of parameters for query generation.
   * @return integer A count of User records in the database.
   */
  public function getUserCount ($params = array ()) {
    
    $query = "
      SELECT COUNT(userId) AS userCount
      FROM ". DBP ."user AS u
      WHERE 1 = 1
    ";
    $queryParams = array ();
    // Handle filter parameters
    if (isset ($params['filterParams']) && is_array ($params['filterParams'])
      && isset ($params['filterParams']['inSearch']) && is_array ($params['filterParams']['inSearch'])) {
      foreach ($params['filterParams']['inSearch'] as $attrName) {
        if (in_array ($attrName, array ('username', 'password'))) {
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
      
    if (isset ($params['username']) && isset ($params['password'])) {
      $query .= "
        AND `username` = :username
        AND `password` = :password
       ";
      $queryParams[':username'] = trim ($params['username']);
      $queryParams[':password'] = md5 ($params['password']);
    }
                    
    }

    try {
      $results = $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
    }
    catch (Exception $e) {
      $message = 'An error occurred while fething a count of user records';
      throw new Exception ($message . ': ' . $e->getMessage(), 2, $e);
    }

    return intval ($results[0]['userCount']);
  }
  /**
   * Method returns an array of User objects.
   * @param array $params An array of parameters for query generation.
   * @return array An array of User objects.
   */
  public function getUsers ($params = array ()) {
    
    $query = "
      SELECT *
      FROM ". DBP ."user AS u
      WHERE 1 = 1
    ";
    $queryParams = array ();
    // Handle filter parameters
    if (isset ($params['filterParams']) && is_array ($params['filterParams'])
      && isset ($params['filterParams']['inSearch']) && is_array ($params['filterParams']['inSearch'])) {
      foreach ($params['filterParams']['inSearch'] as $attrName) {
        if (in_array ($attrName, array ('username', 'password'))) {
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
      
    if (isset ($params['username']) && isset ($params['password'])) {
      $query .= "
        AND `username` = :username
        AND `password` = :password
       ";
      $queryParams[':username'] = trim ($params['username']);
      $queryParams[':password'] = md5 ($params['password']);
    }
                    
    }
    ;
		$query .= $this->_getOrderAndLimit ($params);

		$users = array ();
    try {
      $results = $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
    }
    catch (Exception $e) {
      $message = 'An error occurred while fetching user records';
      throw new Exception ($message . ': ' . $e->getMessage(), 2, $e);
    }

    foreach ($results as &$result) {
      
    }

    return Factory::getUsers ($results);
  }

  /**
   * Method inserts a new user into the database.
   * @param array $data Data for the new user.
   * @return integer userId of the newly inserted user.
   */
  public function addUser ($data) {
    if (empty ($data) || !$this->_validateUserData ($data)) {
      throw new Exception ('User did not pass validation.', 10);
    }

    try {
      $this->startTransaction ();
    
      $query = "
        INSERT INTO " . DBP . "user
        SET `username` = :username,
            `slug` = :slug,
            `password` = :password,
            `created` = NOW(),
            `modified` = NOW()
      ";
      $queryParams = array (
        ':username' => Tools::stripTags (trim ($data['username'])),
        ':slug' => Tools::formatURI (Tools::stripTags (trim ($data['username']))),
        ':password' => md5 ($data['password'])
      );
      $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
      $userId = $this->lastInsertId ();
      
      // Handle many-to-many User Role relation
      if (isset ($data['userRoleId']) && is_array ($data['userRoleId'])) {
        foreach ($data['userRoleId'] as $userRoleId) {
          $query = "
            INSERT INTO " . DBP . "userHasUserRole
            SET `userId` = :userId,
                `userRoleId` = :userRoleId
          ";
          $queryParams = array (
            ':userId' => array ($userId, PDO::PARAM_INT),
            ':userRoleId' => array ($userRoleId, PDO::PARAM_INT),
          );
          $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
        }
      }
      else {
        throw new Exception ('No User Role(s) selected.');
        MessageManager::setInputMessage ('userRoleId[]', 'At least one User Role must be selected.');
      }
      $this->commit ();
    }
    catch (Exception $e) {
      $this->rollback ();
      $message = 'An error occurred while adding user record';
      throw new Exception ($message . ': ' . $e->getMessage(), 3, $e);
    }
    return $this->getUser (array ('userId' => $userId));
  }

  /**
   * Method edits an existing user database record.
   * @param array $data New data for the user.
   * @return bool Success flag; TRUE if editing was successful, FALSE if not.
   */
  public function editUser ($userId, $data) {
    if (empty ($data) || !$this->_validateUserData ($data)) {
      throw new Exception ('Invalid data.', 10);
    }
    try {
      $this->startTransaction ();
      $query = "
        UPDATE " . DBP . "user
        SET `username` = :username,
            `slug` = :slug,
            `password` = :password,
            `modified` = NOW(),
            modified = NOW()
        WHERE `userId` = :userId
      ";
      $queryParams = array (
        ':username' => Tools::stripTags (trim ($data['username'])),
        ':slug' => Tools::formatURI (Tools::stripTags (trim ($data['username']))),
        ':password' => empty ($data['password']) ? $this->getUser (array ('userId' => $userId))->getPassword () : md5 ($data['password']),
        ':userId' => array ($userId, PDO::PARAM_INT)
      );
      $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
      // Handle many-to-many User Role relation
      $userRoleIdParams = array ();
      $queryParams = array (
        ':userId' => array ($userId, PDO::PARAM_INT)
      );
      for ($i = 0; $i < count ($data['userRoleId']); $i++) {
        $userRoleIdParams[] = ':id' . $i;
        $queryParams[':id' . $i] = $data['userRoleId'][$i];
      }
      $query = "
        DELETE FROM " . DBP . "userHasUserRole
        WHERE `userId` = :userId
          AND `userRoleId` NOT IN (". implode (', ', $userRoleIdParams) .")
      ";
      $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
      if (isset ($data['userRoleId']) && is_array ($data['userRoleId'])) {
        foreach ($data['userRoleId'] as $userRoleId) {
          $query = "
            INSERT INTO " . DBP . "userHasUserRole
            SET `userId` = :userId,
                `userRoleId` = :userRoleId
            ON DUPLICATE KEY UPDATE
                `userId` = `userId`
          ";
          $queryParams = array (
            ':userId' => array ($userId, PDO::PARAM_INT),
            ':userRoleId' => array ($userRoleId, PDO::PARAM_INT),
          );
          $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
          }
      }
      else {
        throw new Exception ('No User Role(s) selected.');
        MessageManager::setInputMessage ('userRoleId[]', 'At least one User Role must be selected.');
      }
      $this->commit ();
    }
    catch (Exception $e) {
      $this->rollback ();
      $message = 'An error occurred while updating user record';
      throw new Exception ($message . ': ' . $e->getMessage(), 4, $e);
    }

    return TRUE;
  }

  /**
   * Method deletes an existing user database record.
   * @param integer $userId user database ID.
   * @return bool Success flag; TRUE if deleting was successful, FALSE if not.
   */
  public function deleteUser ($userId) {
    try {
      $this->startTransaction ();
      $query = "
        DELETE FROM " . DBP . "user
        WHERE `userId` = :userId
      ";
      $queryParams = array (
        ':userId' => array ($userId, PDO::PARAM_INT)
      );
      $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
    
      $this->commit ();

      return TRUE;
     }
      catch (Exception $e) {
        $this->rollback ();
        $message = 'An error occurred while deleting user record';
        throw new Exception ($message . ': ' . $e->getMessage(), 5, $e);
      }
  }
  

  private function _validateUserData ($input) {
    if (!$this->checkSetData (
        $input,
        array ('username', 'password')
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
            'username' => 'Username cannot be empty.'
          ),
          'notEmptyLang' => array (
            
          )
        )
      )
    );
  }

}
?>