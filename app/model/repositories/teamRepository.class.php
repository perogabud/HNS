<?php
class TeamRepository extends Repository {

  public function __construct () {
    parent::__construct ();
  }

  /**
   * Method returns a single Team object.
   * @param array $params An array of parameters for query generation.
   * @return Team The requested Team object or NULL if none found.
   */
  public function getTeam ($params = array ()) {
    if (empty ($params)) {
        return NULL;
      }

    $query = "
      SELECT *
      FROM ". DBP ."vw_team AS t
      WHERE 1 = 1
    ";

    $queryParams = array ();

    if (array_key_exists ('teamId', $params)) {
      $query .= "
        AND t.teamId = :teamId
      ";
      $queryParams[':teamId'] = array (intval ($params['teamId']), PDO::PARAM_INT);
    }

    if (array_key_exists ('slug', $params)) {
      $query .= "
        AND t.slug = :slug
      ";
      $queryParams[':slug'] = trim ($params['slug']);
    }

    try {
      $results = $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
    }
    catch (Exception $e) {
      $message = 'An error occurred while fetching team record';
      throw new Exception ($message . $e->getMessage());
    }

    if (!$results || empty ($results)) {
      return NULL;
    }

    $team = Factory::getTeam ($results);

    if (!isset ($params['simple'])) {
      $memberRepository = new MemberRepository ();
      $members = $memberRepository->getMembers (
        array (
          'teamId' => $team->getId (),
          'relationName' => 'member'
        )
      );
      $team->setMembers ($members);
    }

    return $team;
  }

  /**
   * Method returns a count of Team records in the database.
   * @param array $params An array of parameters for query generation.
   * @return integer A count of Team records in the database.
   */
  public function getTeamCount ($params = array ()) {

    $query = "
      SELECT COUNT(teamId) AS teamCount
      FROM ". DBP ."vw_team AS t
      WHERE languageId = :languageId
    ";
    $queryParams = array (
      ':languageId' => Config::read ('lang')
    );
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

    }

    try {
      $results = $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
    }
    catch (Exception $e) {
      $message = 'An error occurred while fething a count of team records';
      throw new Exception ($message . $e->getMessage());
    }

    return intval ($results[0]['teamCount']);
  }
  /**
   * Method returns an array of Team objects.
   * @param array $params An array of parameters for query generation.
   * @return array An array of Team objects.
   */
  public function getTeams ($params = array ()) {

    $query = "
      SELECT *
      FROM ". DBP ."vw_team
      WHERE languageId = :languageId
    ";
    $queryParams = array (
      ':languageId' => Config::read ('lang')
    );
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

    }
    ;
		$query .= $this->_getOrderAndLimit ($params);

		$teams = array ();
    try {
      $results = $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
    }
    catch (Exception $e) {
      $message = 'An error occurred while fetching team records';
      throw new Exception ($message . $e->getMessage());
    }

    foreach ($results as &$result) {

    }

    return Factory::getTeams ($results);
  }

  /**
   * Method inserts a new team into the database.
   * @param array $data Data for the new team.
   * @return integer teamId of the newly inserted team.
   */
  public function addTeam ($data) {
    if (empty ($data) || !$this->_validateTeamData ($data)) {
      throw new Exception ('Team did not pass validation.', 10);
    }

    try {
      $this->startTransaction ();

      $query = "
        INSERT INTO " . DBP . "team
        SET
            `created` = NOW(),
            `modified` = NOW()
      ";
      $queryParams = array (

      );
      $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);

      $teamId = $this->lastInsertId ();

      foreach (Config::read ('supportedLangs') as $lang) {
        $query = "
          INSERT INTO " . DBP . "teamI18n
          SET `name` = :name,
              `slug` = :slug,
              `created` = NOW(),
              `modified` = NOW(),
              `languageId` = :languageId,
              `teamId` = :teamId
        ";
        $queryParams = array (
          ':name' => Tools::stripTags (trim ($data['name_' . $lang])),
          ':slug' => Tools::formatURI (Tools::stripTags (trim ($data['name_' . $lang]))),
          ':languageId' => $lang,
          ':teamId' => $teamId
        );
        $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
      }

      $this->commit ();
    }
    catch (Exception $e) {
      $this->rollback ();
      $message = 'An error occurred while adding team record';
      throw new Exception ($message . $e->getMessage());
    }
    return $this->getTeam (array ('teamId' => $teamId));
  }

  /**
   * Method edits an existing team database record.
   * @param array $data New data for the team.
   * @return bool Success flag; TRUE if editing was successful, FALSE if not.
   */
  public function editTeam ($teamId, $data) {
    if (empty ($data) || !$this->_validateTeamData ($data)) {
      throw new Exception ('Invalid data.', 10);
    }
    try {
      $this->startTransaction ();
      $query = "
        UPDATE " . DBP . "team
        SET
            `modified` = NOW()
        WHERE `teamId` = :teamId
      ";
      $queryParams = array (
        ':teamId' => array ($teamId, PDO::PARAM_INT)
      );
      $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);

      foreach (Config::read ('supportedLangs') as $lang) {
        $query = "
          INSERT INTO " . DBP . "teamI18n
          SET `name` = :name,
              `slug` = :slug,
              `modified` = NOW(),
              `teamId` = :teamId,
              `languageId` = :languageId,
              `created` = NOW()
          ON DUPLICATE KEY UPDATE
              `name` = :name,
              `slug` = :slug,
              `modified` = NOW()
        ";
        $queryParams = array (
          ':name' => Tools::stripTags (trim ($data['name_' . $lang])),
          ':slug' => Tools::formatURI (Tools::stripTags (trim ($data['name_' . $lang]))),
          ':teamId' => array ($teamId, PDO::PARAM_INT),
          ':languageId' => $lang
        );
        $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
      }
      $this->commit ();
    }
    catch (Exception $e) {
      $this->rollback ();
      $message = 'An error occurred while updating team record';
      throw new Exception ($message . $e->getMessage());
    }

    return TRUE;
  }

  /**
   * Method deletes an existing team database record.
   * @param integer $teamId team database ID.
   * @return bool Success flag; TRUE if deleting was successful, FALSE if not.
   */
  public function deleteTeam ($teamId) {
    try {
      $this->startTransaction ();
      $query = "
        DELETE FROM " . DBP . "team
        WHERE `teamId` = :teamId
      ";
      $queryParams = array (
        ':teamId' => array ($teamId, PDO::PARAM_INT)
      );
      $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);

      $this->commit ();

      return TRUE;
     }
      catch (Exception $e) {
        $this->rollback ();
        $message = 'An error occurred while deleting team record';
        throw new Exception ($message . $e->getMessage());
      }
  }


  private function _validateTeamData ($input) {
    if (!$this->checkSetData (
        $input,
        array (),
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

          ),
          'notEmptyLang' => array (
            'name' => 'name cannot be empty.'
          )
        )
      )
    );
  }

}
?>