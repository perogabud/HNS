<?php
class MemberRepository extends Repository {

  public function __construct () {
    parent::__construct ();
  }

  /**
   * Method returns a single Member object.
   * @param array $params An array of parameters for query generation.
   * @return Member The requested Member object or NULL if none found.
   */
  public function getMember ($params = array ()) {
    if (empty ($params)) {
        return NULL;
      }

    $query = "
      SELECT *
      FROM ". DBP ."member AS m
      JOIN ". DBP ."memberI18n AS mi18n
        ON m.memberId = mi18n.memberId
      WHERE 1 = 1
    ";

    $queryParams = array ();

    if (array_key_exists ('memberId', $params)) {
      $query .= "
        AND m.memberId = :memberId
      ";
      $queryParams[':memberId'] = array (intval ($params['memberId']), PDO::PARAM_INT);
    }


      if (array_key_exists ('memberCategoryId', $params) && is_numeric ($params['memberCategoryId'])) {
        $query .= "
          AND `memberCategoryId` = :memberCategoryId
         ";
        $queryParams['memberCategoryId'] = array ($params['memberCategoryId'], PDO::PARAM_INT);
      }

    if (array_key_exists ('teamId', $params) && is_numeric ($params['teamId'])) {
      $query .= "
        AND `teamId` = :teamId
       ";
      $queryParams['teamId'] = array ($params['teamId'], PDO::PARAM_INT);
    }

    try {
      $results = $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
    }
    catch (Exception $e) {
      $message = 'An error occurred while fetching member record';
      throw new Exception ($message . ': ' . $e->getMessage(), 1, $e);
    }

    if (!$results || empty ($results)) {
      return NULL;
    }

    $memberCategoryRepository = new MemberCategoryRepository ();
    $memberCategory = $memberCategoryRepository->getMemberCategory (array ('memberCategoryId' => $results[0]['memberCategoryId']));
    $results[0]['memberCategory'] = $memberCategory;

    $teamRepository = new TeamRepository ();
    $team = $teamRepository->getTeam (array ('teamId' => $results[0]['teamId']));
    $results[0]['team'] = $team;

    $image = $this->getImage ($results[0]['memberId']);
    $results[0]['image'] = $image;

    $member = Factory::getMember ($results);

    return $member;
  }
  /**
   * Method returns a single MemberImage object.
   * @param integer $memberId Member ID.
   * @return MemberImage The requested Member object or NULL if none found.
   */
  public function getImage ($memberId) {
    $query = "
      SELECT *
      FROM ". DBP ."memberImage
      WHERE `memberId` = :memberId
    ";

    $queryParams = array (
      ':memberId' => array ($memberId, PDO::PARAM_INT)
    );

    try {
      $results = $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
      return !empty ($results) ? Factory::getMemberImage ($results[0]) : NULL;
    }
    catch (Exception $e) {
      $message = 'An error occurred while fetching member record';
      throw new Exception ($message . ': ' . $e->getMessage(), 1, $e);
    }
  }


  /**
   * Method returns a count of Member records in the database.
   * @param array $params An array of parameters for query generation.
   * @return integer A count of Member records in the database.
   */
  public function getMemberCount ($params = array ()) {

    $query = "
      SELECT COUNT(memberId) AS memberCount
      FROM ". DBP ."vw_member AS m
      WHERE languageId = :languageId
    ";
    $queryParams = array (
      ':languageId' => Config::read ('lang')
    );
    // Handle filter parameters
    if (isset ($params['filterParams']) && is_array ($params['filterParams'])
      && isset ($params['filterParams']['inSearch']) && is_array ($params['filterParams']['inSearch'])) {
      foreach ($params['filterParams']['inSearch'] as $attrName) {
        if (in_array ($attrName, array ('firstName', 'lastName', 'position', 'birthDate', 'birthPlace', 'height', 'club', 'pastClubs', 'playCount', 'firstPlayDate', 'biography'))) {
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


      if (array_key_exists ('memberCategoryId', $params) && is_numeric ($params['memberCategoryId'])) {
        $query .= "
          AND `memberCategoryId` = :memberCategoryId
         ";
        $queryParams['memberCategoryId'] = array ($params['memberCategoryId'], PDO::PARAM_INT);
      }

    if (array_key_exists ('teamId', $params) && is_numeric ($params['teamId'])) {
      $query .= "
        AND `teamId` = :teamId
       ";
      $queryParams['teamId'] = array ($params['teamId'], PDO::PARAM_INT);
    }

    }

    try {
      $results = $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
    }
    catch (Exception $e) {
      $message = 'An error occurred while fething a count of member records';
      throw new Exception ($message . ': ' . $e->getMessage(), 2, $e);
    }

    return intval ($results[0]['memberCount']);
  }
  /**
   * Method returns an array of Member objects.
   * @param array $params An array of parameters for query generation.
   * @return array An array of Member objects.
   */
  public function getMembers ($params = array ()) {

    $query = "
      SELECT *
      FROM ". DBP ."vw_member
      WHERE languageId = :languageId
    ";
    $queryParams = array (
      ':languageId' => Config::read ('lang')
    );
    // Handle filter parameters
    if (isset ($params['filterParams']) && is_array ($params['filterParams'])
      && isset ($params['filterParams']['inSearch']) && is_array ($params['filterParams']['inSearch'])) {
      foreach ($params['filterParams']['inSearch'] as $attrName) {
        if (in_array ($attrName, array ('firstName', 'lastName', 'position', 'birthDate', 'birthPlace', 'height', 'club', 'pastClubs', 'playCount', 'firstPlayDate', 'biography'))) {
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


      if (array_key_exists ('memberCategoryId', $params) && is_numeric ($params['memberCategoryId'])) {
        $query .= "
          AND `memberCategoryId` = :memberCategoryId
         ";
        $queryParams['memberCategoryId'] = array ($params['memberCategoryId'], PDO::PARAM_INT);
      }

    if (array_key_exists ('teamId', $params) && is_numeric ($params['teamId'])) {
      $query .= "
        AND `teamId` = :teamId
       ";
      $queryParams['teamId'] = array ($params['teamId'], PDO::PARAM_INT);
    }

    }
    ;
		$query .= $this->_getOrderAndLimit ($params);

		$members = array ();
    try {
      $results = $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
    }
    catch (Exception $e) {
      $message = 'An error occurred while fetching member records';
      throw new Exception ($message . ': ' . $e->getMessage(), 2, $e);
    }

    foreach ($results as &$result) {

    if (isset ($params['memberCategory'])) {
      $memberCategoryRepository = new MemberCategoryRepository ();
      $memberCategory = $memberCategoryRepository->getMemberCategory (array ('memberCategoryId' => $result['memberCategoryId']));
      $result['memberCategory'] = $memberCategory;
    }

    if (isset ($params['team'])) {
      $teamRepository = new TeamRepository ();
      $team = $teamRepository->getTeam (array ('teamId' => $result['teamId']));
      $result['team'] = $team;
    }

    if (isset ($params['image'])) {
      $image = $this->getImage ($result['memberId']);
      $result['image'] = $image;
    }

    }

    return Factory::getMembers ($results);
  }

  /**
   * Method inserts a new member into the database.
   * @param array $data Data for the new member.
   * @return integer memberId of the newly inserted member.
   */
  public function addMember ($data) {
    if (empty ($data) || !$this->_validateMemberData ($data)) {
      throw new Exception ('Member did not pass validation.', 10);
    }

    try {
      $this->startTransaction ();

      $query = "
        INSERT INTO " . DBP . "member
        SET `memberCategoryId` = :memberCategoryId,
            `teamId` = :teamId,
            `firstName` = :firstName,
            `slug` = :slug,
            `lastName` = :lastName,
            `position` = :position,
            `birthDate` = :birthDate,
            `birthPlace` = :birthPlace,
            `height` = :height,
            `club` = :club,
            `pastClubs` = :pastClubs,
            `playCount` = :playCount,
            `firstPlayDate` = :firstPlayDate,
            `created` = NOW(),
            `modified` = NOW()
      ";
      $queryParams = array (
        ':memberCategoryId' => array ($data['memberCategoryId'], PDO::PARAM_INT),':teamId' => array ($data['teamId'], PDO::PARAM_INT),
        ':firstName' => Tools::stripTags (trim ($data['firstName'])),
        ':slug' => Tools::formatURI (Tools::stripTags (trim ($data['firstName']))),
        ':lastName' => Tools::stripTags (trim ($data['lastName'])),
        ':position' => empty ($data['position']) ? NULL : Tools::stripTags (trim ($data['position'])),
        ':birthDate' => empty ($data['birthDate']) ? NULL : array ($data['birthDate'], PDO::PARAM_INT),
        ':birthPlace' => empty ($data['birthPlace']) ? NULL : Tools::stripTags (trim ($data['birthPlace'])),
        ':height' => empty ($data['height']) ? NULL : Tools::stripTags (trim ($data['height'])),
        ':club' => empty ($data['club']) ? NULL : Tools::stripTags (trim ($data['club'])),
        ':pastClubs' => empty ($data['pastClubs']) ? NULL : Tools::stripTags (trim ($data['pastClubs'])),
        ':playCount' => empty ($data['playCount']) ? NULL : Tools::stripTags (trim ($data['playCount'])),
        ':firstPlayDate' => empty ($data['firstPlayDate']) ? NULL : array ($data['firstPlayDate'], PDO::PARAM_INT)
      );
      $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);

      $memberId = $this->lastInsertId ();

      foreach (Config::read ('supportedLangs') as $lang) {
        $query = "
          INSERT INTO " . DBP . "memberI18n
          SET `biography` = :biography,
              `created` = NOW(),
              `modified` = NOW(),
              `languageId` = :languageId,
              `memberId` = :memberId
        ";
        $queryParams = array (
          ':biography' => empty ($data['biography_' . $lang]) ? NULL : Tools::stripTags (trim ($data['biography_' . $lang]), 'loose'),
          ':languageId' => $lang,
          ':memberId' => $memberId
        );
        $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
      }

      // Upload image
      $imageData = Tools::uploadImages (
        array (
          'name' => 'image',
          'maxCount' => 1,
          'types' => array (
            'image' => array (
              'directory' => Config::read ('memberImagePath'),
              'dimensions' => Config::read ('memberImageDimensions')
            ),
            'thumbnail' => array (
              'directory' => Config::read ('memberImageThumbnailPath'),
              'dimensions' => Config::read ('memberImageThumbnailDimensions')
            ),
          )
        )
      );
      $imageData = isset ($imageData[0]) ? $imageData[0] : NULL;

      if (!is_null ($imageData)) {
        $query = "
          INSERT INTO " . DBP . "memberImage
          SET `memberId` = :memberId,
              `filename` = :filename,
              `width` = :width,
              `height` = :height,
              `created` = NOW()
        ";
        $queryParams = array (
          ':memberId' => array ($memberId, PDO::PARAM_INT),
          ':filename' => $imageData['filename'],
          ':width' => array ($imageData['width'], PDO::PARAM_INT),
          ':height' => array ($imageData['height'], PDO::PARAM_INT)
        );
        $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
      }

      $this->commit ();
    }
    catch (Exception $e) {
      $this->rollback ();
      $message = 'An error occurred while adding member record';
      throw new Exception ($message . ': ' . $e->getMessage(), 3, $e);
    }
    return $this->getMember (array ('memberId' => $memberId));
  }

  /**
   * Method edits an existing member database record.
   * @param array $data New data for the member.
   * @return bool Success flag; TRUE if editing was successful, FALSE if not.
   */
  public function editMember ($memberId, $data) {
    if (empty ($data) || !$this->_validateMemberData ($data)) {
      throw new Exception ('Invalid data.', 10);
    }
    try {
      $this->startTransaction ();
      // Upload image
      $imageData = Tools::uploadImages (
        array (
          'name' => 'image',
          'maxCount' => 1,
          'types' => array (
            'image' => array (
              'directory' => Config::read ('memberImagePath'),
              'dimensions' => Config::read ('memberImageDimensions')
            ),
            'thumbnail' => array (
              'directory' => Config::read ('memberImageThumbnailPath'),
              'dimensions' => Config::read ('memberImageThumbnailDimensions')
            ),
          )
        )
      );
      $imageData = isset ($imageData[0]) ? $imageData[0] : NULL;
      if (!empty ($imageData) || isset ($data['deleteImage'])) {
        $this->_deleteImage ($memberId);
        if (!empty ($imageData)) {
          $query = "
            INSERT INTO " . DBP . "memberImage
            SET `memberId` = :memberId,
                `filename` = :filename,
                `width` = :width,
                `height` = :height,
                `created` = NOW()
          ";
          $queryParams = array (
            ':memberId' => array ($memberId, PDO::PARAM_INT),
            ':filename' => $imageData['filename'],
            ':width' => array ($imageData['width'], PDO::PARAM_INT),
            ':height' => array ($imageData['height'], PDO::PARAM_INT)
          );
          $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
        }
      }

      $query = "
        UPDATE " . DBP . "member
        SET `memberCategoryId` = :memberCategoryId,
            `teamId` = :teamId,
            `firstName` = :firstName,
            `slug` = :slug,
            `lastName` = :lastName,
            `position` = :position,
            `birthDate` = :birthDate,
            `birthPlace` = :birthPlace,
            `height` = :height,
            `club` = :club,
            `pastClubs` = :pastClubs,
            `playCount` = :playCount,
            `firstPlayDate` = :firstPlayDate,
            `modified` = NOW()
        WHERE `memberId` = :memberId
      ";
      $queryParams = array (
        ':memberCategoryId' => array ($data['memberCategoryId'], PDO::PARAM_INT),
        ':teamId' => array ($data['teamId'], PDO::PARAM_INT),
        ':firstName' => Tools::stripTags (trim ($data['firstName'])),
        ':slug' => Tools::formatURI (Tools::stripTags (trim ($data['firstName']))),
        ':lastName' => Tools::stripTags (trim ($data['lastName'])),
        ':position' => empty ($data['position']) ? NULL : Tools::stripTags (trim ($data['position'])),
        ':birthDate' => empty ($data['birthDate']) ? NULL : array ($data['birthDate'], PDO::PARAM_INT),
        ':birthPlace' => empty ($data['birthPlace']) ? NULL : Tools::stripTags (trim ($data['birthPlace'])),
        ':height' => empty ($data['height']) ? NULL : Tools::stripTags (trim ($data['height'])),
        ':club' => empty ($data['club']) ? NULL : Tools::stripTags (trim ($data['club'])),
        ':pastClubs' => empty ($data['pastClubs']) ? NULL : Tools::stripTags (trim ($data['pastClubs'])),
        ':playCount' => empty ($data['playCount']) ? NULL : Tools::stripTags (trim ($data['playCount'])),
        ':firstPlayDate' => empty ($data['firstPlayDate']) ? NULL : array ($data['firstPlayDate'], PDO::PARAM_INT),
        ':memberId' => array ($memberId, PDO::PARAM_INT)
      );
      $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);

      foreach (Config::read ('supportedLangs') as $lang) {
        $query = "
          INSERT INTO " . DBP . "memberI18n
          SET `biography` = :biography,
              `modified` = NOW(),
              `memberId` = :memberId,
              `languageId` = :languageId,
              `created` = NOW()
          ON DUPLICATE KEY UPDATE
              `biography` = :biography,
              `modified` = NOW()
        ";
        $queryParams = array (
          ':biography' => empty ($data['biography_' . $lang]) ? NULL : Tools::stripTags (trim ($data['biography_' . $lang]), 'loose'),
          ':memberId' => array ($memberId, PDO::PARAM_INT),
          ':languageId' => $lang
        );
        $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
      }
      $this->commit ();
    }
    catch (Exception $e) {
      $this->rollback ();
      $message = 'An error occurred while updating member record';
      throw new Exception ($message . ': ' . $e->getMessage(), 4, $e);
    }

    return TRUE;
  }

  /**
   * Method deletes an existing member database record.
   * @param integer $memberId member database ID.
   * @return bool Success flag; TRUE if deleting was successful, FALSE if not.
   */
  public function deleteMember ($memberId) {
    try {
      $this->startTransaction ();
      $this->_deleteImage ($memberId);

      $query = "
        DELETE FROM " . DBP . "member
        WHERE `memberId` = :memberId
      ";
      $queryParams = array (
        ':memberId' => array ($memberId, PDO::PARAM_INT)
      );
      $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);

      $this->commit ();

      return TRUE;
     }
      catch (Exception $e) {
        $this->rollback ();
        $message = 'An error occurred while deleting member record';
        throw new Exception ($message . ': ' . $e->getMessage(), 5, $e);
      }
  }


  private function _validateMemberData ($input) {
    if (!$this->checkSetData (
        $input,
        array ('firstName', 'lastName')
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
            'firstName' => 'Ime je obavezno.',
              'lastName' => 'Prezime je obavezno.'
          ),
          'notEmptyLang' => array (

          )
        )
      )
    );
  }
  private function _deleteImage ($memberId) {
    // Delete image files on server
    $member = $this->getMember (array ('memberId' => $memberId));
    if (is_null ($member)) {
      throw new Exception ("Trying to delete image for a non-existant member");
    }
    if ($member->getImage ()) {
      $member->getImage ()->deleteFiles ();

      // Delete image from database
      $query = "
        DELETE FROM " . DBP . "memberImage
        WHERE `memberId` = :memberId
      ";
      $queryParams = array (
        ':memberId' => array ($memberId, PDO::PARAM_INT)
      );
      $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
      }
  }


}
?>