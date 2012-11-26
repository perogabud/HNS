<?php
class ActualityRepository extends Repository {

  public function __construct () {
    parent::__construct ();
  }

  /**
   * Method returns a single Actuality object.
   * @param array $params An array of parameters for query generation.
   * @return Actuality The requested Actuality object or NULL if none found.
   */
  public function getActuality ($params = array ()) {
    if (empty ($params)) {
        return NULL;
      }

    $query = "
      SELECT *
      FROM ". DBP ."actuality AS a
      WHERE 1 = 1
    ";

    $queryParams = array ();

    if (array_key_exists ('actualityId', $params)) {
      $query .= "
        AND a.actualityId = :actualityId
      ";
      $queryParams[':actualityId'] = array (intval ($params['actualityId']), PDO::PARAM_INT);
    }

    if (array_key_exists ('slug', $params)) {
      $query .= "
        AND a.slug = :slug
      ";
      $queryParams[':slug'] = trim ($params['slug']);
    }

    try {
      $results = $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
    }
    catch (Exception $e) {
      $message = 'An error occurred while fetching actuality record';
      throw new Exception ($message . $e->getMessage());
    }

    if (!$results || empty ($results)) {
      return NULL;
    }

    $coverImage = $this->getCoverImage ($results[0]['actualityId']);
    $results[0]['coverImage'] = $coverImage;

    $results[0]['language'] = $this->getLanguage (array ('languageId' => $results[0]['languageId']));

    $actuality = Factory::getActuality ($results[0]);

    $customModuleRepository = new CustomModuleRepository ();
    $customModules = $customModuleRepository->getCustomModules (
      array (
        'actualityId' => $actuality->getId (),
        'relationName' => 'customModule'
      )
    );
    $actuality->setCustomModules ($customModules);

    return $actuality;
  }

  /**
   * Method returns a single ActualityCoverImage object.
   * @param integer $actualityId Actuality ID.
   * @return ActualityCoverImage The requested Actuality object or NULL if none found.
   */
  public function getCoverImage ($actualityId) {
    $query = "
      SELECT *
      FROM ". DBP ."actualityCoverImage
      WHERE `actualityId` = :actualityId
    ";

    $queryParams = array (
      ':actualityId' => array ($actualityId, PDO::PARAM_INT)
    );

    try {
      $results = $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
      return !empty ($results) ? Factory::getActualityCoverImage ($results[0]) : NULL;
    }
    catch (Exception $e) {
      $message = 'An error occurred while fetching actuality record';
      throw new Exception ($message . $e->getMessage());
    }
  }

  /**
   * Method returns a count of Actuality records in the database.
   * @param array $params An array of parameters for query generation.
   * @return integer A count of Actuality records in the database.
   */
  public function getActualityCount ($params = array ()) {

    $query = "
      SELECT COUNT(actualityId) AS actualityCount
      FROM ". DBP ."actuality AS a
      WHERE 1 = 1
    ";
    $queryParams = array ();
    // Handle filter parameters
    if (isset ($params['filterParams']) && is_array ($params['filterParams'])
      && isset ($params['filterParams']['inSearch']) && is_array ($params['filterParams']['inSearch'])) {
      foreach ($params['filterParams']['inSearch'] as $attrName) {
        if (in_array ($attrName, array ('languageId', 'title', 'lead', 'content', 'isPublished', 'publishDate'))) {
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
      $message = 'An error occurred while fething a count of actuality records';
      throw new Exception ($message . $e->getMessage());
    }

    return intval ($results[0]['actualityCount']);
  }
  /**
   * Method returns an array of Actuality objects.
   * @param array $params An array of parameters for query generation.
   * @return array An array of Actuality objects.
   */
  public function getActualitys ($params = array ()) {

    $query = "
      SELECT *
      FROM ". DBP ."actuality AS a
      JOIN ". DBP ."language AS l
        ON a.languageId = l.languageId
      WHERE 1 = 1
    ";
    $queryParams = array ();
    // Handle filter parameters
    if (isset ($params['filterParams']) && is_array ($params['filterParams'])
      && isset ($params['filterParams']['inSearch']) && is_array ($params['filterParams']['inSearch'])) {
      foreach ($params['filterParams']['inSearch'] as $attrName) {
        if (in_array ($attrName, array ('languageId', 'title', 'lead', 'content', 'isPublished', 'publishDate'))) {
          if (in_array ($attrName, array ('isPublished'))) {
            $query .= "
              AND a.$attrName = :$attrName
            ";
            $queryParams[":$attrName"] = isset ($params['filterParams'][$attrName]) ? '1' : '0';
          }
          elseif (isset ($params['filterParams'][$attrName])) {
            $query .= "
              AND a.$attrName LIKE :$attrName
            ";
            $queryParams[":$attrName"] = '%'. $params['filterParams'][$attrName] .'%';
          }
        }
      }
    }
    if (isset ($params['isPublished']) && $params['isPublished'] === TRUE) {
      $query .= "
        AND n.isPublished = 1
      ";
    }
    if (!isset ($params['orderBy'])) {
      $params['orderBy'] = 'publishDate';
      $params['orderDirection'] = 'DESC';
    }
		$query .= $this->_getOrderAndLimit ($params);

		$actualitys = array ();
    try {
      $results = $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
    }
    catch (Exception $e) {
      $message = 'An error occurred while fetching actuality records';
      throw new Exception ($message . $e->getMessage());
    }

    foreach ($results as &$result) {
      $result['language'] = Factory::getLanguage ($result);
      $coverImage = $this->getCoverImage ($result['actualityId']);
      $result['coverImage'] = $coverImage;
    }

    return Factory::getActualitys ($results);
  }

  /**
   * Method inserts a new actuality into the database.
   * @param array $data Data for the new actuality.
   * @return integer actualityId of the newly inserted actuality.
   */
  public function addActuality ($data) {
    if (empty ($data) || !$this->_validateActualityData ($data)) {
      throw new Exception ('Actuality did not pass validation.', 10);
    }

    try {
      $this->startTransaction ();

      $query = "
        INSERT INTO " . DBP . "actuality
        SET `languageId` = :languageId,
            `title` = :title,
            `slug` = :slug,
            `lead` = :lead,
            `content` = :content,
            `isPublished` = :isPublished,
            `publishDate` = :publishDate,
            `created` = NOW(),
            `modified` = NOW()
      ";
      $queryParams = array (
        ':languageId' => Tools::stripTags (trim ($data['languageId'])),
        ':title' => Tools::stripTags (trim ($data['title']), 'strict'),
        ':slug' => Tools::formatURI (Tools::stripTags (trim ($data['title']))),
        ':lead' => Tools::stripTags (trim ($data['lead']), 'loose'),
        ':content' => Tools::stripTags (trim ($data['content']), 'loose'),
        ':isPublished' => isset ($data['isPublished']) ? '1' : '0',
        ':publishDate' => array ($data['publishDate'], PDO::PARAM_INT)
      );
      $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
      $actualityId = $this->lastInsertId ();

      // Upload coverImage
      $coverImageData = Tools::uploadImages (
        array (
          'name' => 'coverImage',
          'maxCount' => 1,
          'types' => array (
            'coverImage' => array (
              'directory' => Config::read ('actualityCoverImagePath'),
              'dimensions' => Config::read ('actualityCoverImageDimensions')
            ),
            'largeThumbnail' => array (
              'directory' => Config::read ('actualityCoverImageLargeThumbnailPath'),
              'dimensions' => Config::read ('actualityCoverImageLargeThumbnailDimensions')
            ),
            'smallThumbnail' => array (
              'directory' => Config::read ('actualityCoverImageSmallThumbnailPath'),
              'dimensions' => Config::read ('actualityCoverImageSmallThumbnailDimensions')
            ),
          )
        )
      );
      $coverImageData = isset ($coverImageData[0]) ? $coverImageData[0] : NULL;

      if (!is_null ($coverImageData)) {
        $query = "
          INSERT INTO " . DBP . "actualityCoverImage
          SET `actualityId` = :actualityId,
              `filename` = :filename,
              `width` = :width,
              `height` = :height,
              `created` = NOW()
        ";
        $queryParams = array (
          ':actualityId' => array ($actualityId, PDO::PARAM_INT),
          ':filename' => $coverImageData['filename'],
          ':width' => array ($coverImageData['width'], PDO::PARAM_INT),
          ':height' => array ($coverImageData['height'], PDO::PARAM_INT)
        );
        $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
      }

      // Handle many-to-many Custom Module relation
      if (isset ($data['customModuleId']) && is_array ($data['customModuleId'])) {
        foreach ($data['customModuleId'] as $customModuleId) {
          $query = "
            INSERT INTO " . DBP . "actualityHasCustomModule
            SET `actualityId` = :actualityId,
                `customModuleId` = :customModuleId
          ";
          $queryParams = array (
            ':actualityId' => array ($actualityId, PDO::PARAM_INT),
            ':customModuleId' => array ($customModuleId, PDO::PARAM_INT),
          );
          $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
        }
      }

      $this->commit ();
    }
    catch (Exception $e) {
      $this->rollback ();
      $message = 'An error occurred while adding actuality record';
      throw new Exception ($message . $e->getMessage());
    }
    return $this->getActuality (array ('actualityId' => $actualityId));
  }

  /**
   * Method edits an existing actuality database record.
   * @param array $data New data for the actuality.
   * @return bool Success flag; TRUE if editing was successful, FALSE if not.
   */
  public function editActuality ($actualityId, $data) {
    if (empty ($data) || !$this->_validateActualityData ($data)) {
      throw new Exception ('Invalid data.', 10);
    }
    try {
      $this->startTransaction ();

      // Upload coverImage
      $coverImageData = Tools::uploadImages (
        array (
          'name' => 'coverImage',
          'maxCount' => 1,
          'types' => array (
            'coverImage' => array (
              'directory' => Config::read ('actualityCoverImagePath'),
              'dimensions' => Config::read ('actualityCoverImageDimensions')
            ),
            'largeThumbnail' => array (
              'directory' => Config::read ('actualityCoverImageLargeThumbnailPath'),
              'dimensions' => Config::read ('actualityCoverImageLargeThumbnailDimensions')
            ),
            'smallThumbnail' => array (
              'directory' => Config::read ('actualityCoverImageSmallThumbnailPath'),
              'dimensions' => Config::read ('actualityCoverImageSmallThumbnailDimensions')
            ),
          )
        )
      );
      $coverImageData = isset ($coverImageData[0]) ? $coverImageData[0] : NULL;
      if (!empty ($coverImageData) || isset ($data['deleteCoverImage'])) {
        $this->_deleteCoverImage ($actualityId);
        if (!empty ($coverImageData)) {
          $query = "
            INSERT INTO " . DBP . "actualityCoverImage
            SET `actualityId` = :actualityId,
                `filename` = :filename,
                `width` = :width,
                `height` = :height,
                `created` = NOW()
          ";
          $queryParams = array (
            ':actualityId' => array ($actualityId, PDO::PARAM_INT),
            ':filename' => $coverImageData['filename'],
            ':width' => array ($coverImageData['width'], PDO::PARAM_INT),
            ':height' => array ($coverImageData['height'], PDO::PARAM_INT)
          );
          $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
        }
      }

      $query = "
        UPDATE " . DBP . "actuality
        SET `languageId` = :languageId,
            `title` = :title,
            `slug` = :slug,
            `lead` = :lead,
            `content` = :content,
            `isPublished` = :isPublished,
            `publishDate` = :publishDate,
            `modified` = NOW(),
            modified = NOW()
        WHERE `actualityId` = :actualityId
      ";
      $queryParams = array (
        ':languageId' => Tools::stripTags (trim ($data['languageId'])),
        ':title' => Tools::stripTags (trim ($data['title']), 'strict'),
        ':slug' => Tools::formatURI (Tools::stripTags (trim ($data['title']))),
        ':lead' => Tools::stripTags (trim ($data['lead']), 'loose'),
        ':content' => Tools::stripTags (trim ($data['content']), 'loose'),
        ':isPublished' => isset ($data['isPublished']) ? '1' : '0',
        ':publishDate' => array ($data['publishDate'], PDO::PARAM_INT),
        ':actualityId' => array ($actualityId, PDO::PARAM_INT)
      );
      $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);

      // Handle many-to-many Custom Module relation
      $customModuleIdParams = array ();
      $queryParams = array (
        ':actualityId' => array ($actualityId, PDO::PARAM_INT)
      );
      for ($i = 0; $i < count ($data['customModuleId']); $i++) {
        $customModuleIdParams[] = ':id' . $i;
        $queryParams[':id' . $i] = $data['customModuleId'][$i];
      }
      $query = "
        DELETE FROM " . DBP . "actualityHasCustomModule
        WHERE `actualityId` = :actualityId
          AND `customModuleId` NOT IN (". implode (', ', $customModuleIdParams) .")
      ";
      $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
      if (isset ($data['customModuleId']) && is_array ($data['customModuleId'])) {
        foreach ($data['customModuleId'] as $customModuleId) {
          $query = "
            INSERT INTO " . DBP . "actualityHasCustomModule
            SET `actualityId` = :actualityId,
                `customModuleId` = :customModuleId
            ON DUPLICATE KEY UPDATE
                `actualityId` = `actualityId`
          ";
          $queryParams = array (
            ':actualityId' => array ($actualityId, PDO::PARAM_INT),
            ':customModuleId' => array ($customModuleId, PDO::PARAM_INT),
          );
          $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
          }
      }

      $this->commit ();
    }
    catch (Exception $e) {
      $this->rollback ();
      $message = 'An error occurred while updating actuality record';
      throw new Exception ($message . $e->getMessage());
    }

    return TRUE;
  }

  /**
   * Method deletes an existing actuality database record.
   * @param integer $actualityId actuality database ID.
   * @return bool Success flag; TRUE if deleting was successful, FALSE if not.
   */
  public function deleteActuality ($actualityId) {
    try {
      $this->startTransaction ();
      $this->_deleteCoverImage ($actualityId);
      $query = "
        DELETE FROM " . DBP . "actuality
        WHERE `actualityId` = :actualityId
      ";
      $queryParams = array (
        ':actualityId' => array ($actualityId, PDO::PARAM_INT)
      );
      $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);

      $this->commit ();

      return TRUE;
     }
      catch (Exception $e) {
        $this->rollback ();
        $message = 'An error occurred while deleting actuality record';
        throw new Exception ($message . $e->getMessage());
      }
  }


  private function _validateActualityData ($input) {
    if (!$this->checkSetData (
        $input,
        array ('languageId', 'title', 'lead', 'content', 'publishDate')
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
            'languageId' => 'Language cannot be empty.',
              'title' => 'Title cannot be empty.',
              'lead' => 'Lead cannot be empty.',
              'content' => 'Content cannot be empty.',
              'publishDate' => 'Publish Date cannot be empty.'
          ),
          'notEmptyLang' => array (

          )
        )
      )
    );
  }

  private function _deleteCoverImage ($actualityId) {
    // Delete image files on server
    $actuality = $this->getActuality (array ('actualityId' => $actualityId));
    if (is_null ($actuality)) {
      throw new Exception ("Trying to delete coverImage for a non-existant actuality");
    }
    if ($actuality->getCoverImage ()) {
      $actuality->getCoverImage ()->deleteFiles ();

      // Delete coverImage from database
      $query = "
        DELETE FROM " . DBP . "actualityCoverImage
        WHERE `actualityId` = :actualityId
      ";
      $queryParams = array (
        ':actualityId' => array ($actualityId, PDO::PARAM_INT)
      );
      $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
      }
  }

}
?>