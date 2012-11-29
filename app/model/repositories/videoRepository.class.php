<?php
class VideoRepository extends Repository {

  public function __construct () {
    parent::__construct ();
  }

  /**
   * Method returns a single Video object.
   * @param array $params An array of parameters for query generation.
   * @return Video The requested Video object or NULL if none found.
   */
  public function getVideo ($params = array ()) {
    if (empty ($params)) {
        return NULL;
      }
    
    $query = "
      SELECT *
      FROM ". DBP ."video AS v
      JOIN ". DBP ."videoI18n AS vi18n
        ON v.videoId = vi18n.videoId
      WHERE 1 = 1
    ";

    $queryParams = array ();

    if (array_key_exists ('videoId', $params)) {
      $query .= "
        AND v.videoId = :videoId
      ";
      $queryParams[':videoId'] = array (intval ($params['videoId']), PDO::PARAM_INT);
    }
    
    try {
      $results = $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
    }
    catch (Exception $e) {
      $message = 'An error occurred while fetching video record';
      throw new Exception ($message . $e->getMessage());
    }

    if (!$results || empty ($results)) {
      return NULL;
    }
    
    $video = Factory::getVideo ($results);
      
    return $video;
  }

  /**
   * Method returns a count of Video records in the database.
   * @param array $params An array of parameters for query generation.
   * @return integer A count of Video records in the database.
   */
  public function getVideoCount ($params = array ()) {
    
    $query = "
      SELECT COUNT(videoId) AS videoCount
      FROM ". DBP ."vw_video AS v
      WHERE languageId = :languageId
    ";
    $queryParams = array (
      ':languageId' => Config::read ('lang')
    );
    // Handle filter parameters
    if (isset ($params['filterParams']) && is_array ($params['filterParams'])
      && isset ($params['filterParams']['inSearch']) && is_array ($params['filterParams']['inSearch'])) {
      foreach ($params['filterParams']['inSearch'] as $attrName) {
        if (in_array ($attrName, array ('title', 'category', 'youtubeUrl', 'isPublished'))) {
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
      $message = 'An error occurred while fething a count of video records';
      throw new Exception ($message . $e->getMessage());
    }

    return intval ($results[0]['videoCount']);
  }
  /**
   * Method returns an array of Video objects.
   * @param array $params An array of parameters for query generation.
   * @return array An array of Video objects.
   */
  public function getVideos ($params = array ()) {
    
    $query = "
      SELECT *
      FROM ". DBP ."vw_video
      WHERE languageId = :languageId
    ";
    $queryParams = array (
      ':languageId' => Config::read ('lang')
    );
    // Handle filter parameters
    if (isset ($params['filterParams']) && is_array ($params['filterParams'])
      && isset ($params['filterParams']['inSearch']) && is_array ($params['filterParams']['inSearch'])) {
      foreach ($params['filterParams']['inSearch'] as $attrName) {
        if (in_array ($attrName, array ('title', 'category', 'youtubeUrl', 'isPublished'))) {
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

		$videos = array ();
    try {
      $results = $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
    }
    catch (Exception $e) {
      $message = 'An error occurred while fetching video records';
      throw new Exception ($message . $e->getMessage());
    }

    foreach ($results as &$result) {
      
    }

    return Factory::getVideos ($results);
  }

  /**
   * Method inserts a new video into the database.
   * @param array $data Data for the new video.
   * @return integer videoId of the newly inserted video.
   */
  public function addVideo ($data) {
    if (empty ($data) || !$this->_validateVideoData ($data)) {
      throw new Exception ('Video did not pass validation.', 10);
    }

    try {
      $this->startTransaction ();
    
      $query = "
        INSERT INTO " . DBP . "video
        SET `youtubeUrl` = :youtubeUrl,
            `isPublished` = :isPublished,
            `publishDate` = :publishDate,        
            `created` = NOW(),
            `modified` = NOW()
      ";
      $queryParams = array (
        ':youtubeUrl' => Tools::stripTags (trim ($data['youtubeUrl'])),
        ':isPublished' => isset ($data['isPublished']) ? '1' : '0',
        ':publishDate' => array ($data['publishDate'], PDO::PARAM_INT)
      );
      $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);

      $videoId = $this->lastInsertId ();

      foreach (Config::read ('supportedLangs') as $lang) {
        $query = "
          INSERT INTO " . DBP . "videoI18n
          SET `title` = :title,
              `slug` = :slug,
              `category` = :category,
              `created` = NOW(),
              `modified` = NOW(),
              `languageId` = :languageId,
              `videoId` = :videoId
        ";
        $queryParams = array (
          ':title' => Tools::stripTags (trim ($data['title_' . $lang]), 'strict'),
          ':slug' => Tools::formatURI (Tools::stripTags (trim ($data['title_' . $lang]))),
          ':category' => empty ($data['category_' . $lang]) ? NULL : Tools::stripTags (trim ($data['category_' . $lang])),
          ':languageId' => $lang,
          ':videoId' => $videoId
        );
        $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
      }
    
      $this->commit ();
    }
    catch (Exception $e) {
      $this->rollback ();
      $message = 'An error occurred while adding video record';
      throw new Exception ($message . $e->getMessage());
    }
    return $this->getVideo (array ('videoId' => $videoId));
  }

  /**
   * Method edits an existing video database record.
   * @param array $data New data for the video.
   * @return bool Success flag; TRUE if editing was successful, FALSE if not.
   */
  public function editVideo ($videoId, $data) {
    if (empty ($data) || !$this->_validateVideoData ($data)) {
      throw new Exception ('Invalid data.', 10);
    }
    try {
      $this->startTransaction ();
      $query = "
        UPDATE " . DBP . "video
        SET `youtubeUrl` = :youtubeUrl,
            `isPublished` = :isPublished,
            `publishDate` = :publishDate,
            `modified` = NOW()
        WHERE `videoId` = :videoId
      ";
      $queryParams = array (
        ':youtubeUrl' => Tools::stripTags (trim ($data['youtubeUrl'])),
        ':videoId' => array ($videoId, PDO::PARAM_INT),
        ':isPublished' => isset ($data['isPublished']) ? '1' : '0',
        ':publishDate' => array ($data['publishDate'], PDO::PARAM_INT)
      );
      $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);

      foreach (Config::read ('supportedLangs') as $lang) {
        $query = "
          INSERT INTO " . DBP . "videoI18n
          SET `title` = :title,
              `slug` = :slug,
              `category` = :category,
              `modified` = NOW(),
              `videoId` = :videoId,
              `languageId` = :languageId,
              `created` = NOW()
          ON DUPLICATE KEY UPDATE
              `title` = :title,
              `slug` = :slug,
              `category` = :category,
              `modified` = NOW()
        ";
        $queryParams = array (
          ':title' => Tools::stripTags (trim ($data['title_' . $lang]), 'strict'),
          ':slug' => Tools::formatURI (Tools::stripTags (trim ($data['title_' . $lang]))),
          ':category' => empty ($data['category_' . $lang]) ? NULL : Tools::stripTags (trim ($data['category_' . $lang])),
          ':videoId' => array ($videoId, PDO::PARAM_INT),
          ':languageId' => $lang
        );
        $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
      }
      $this->commit ();
    }
    catch (Exception $e) {
      $this->rollback ();
      $message = 'An error occurred while updating video record';
      throw new Exception ($message . $e->getMessage());
    }

    return TRUE;
  }

  /**
   * Method deletes an existing video database record.
   * @param integer $videoId video database ID.
   * @return bool Success flag; TRUE if deleting was successful, FALSE if not.
   */
  public function deleteVideo ($videoId) {
    try {
      $this->startTransaction ();
      $query = "
        DELETE FROM " . DBP . "video
        WHERE `videoId` = :videoId
      ";
      $queryParams = array (
        ':videoId' => array ($videoId, PDO::PARAM_INT)
      );
      $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
    
      $this->commit ();

      return TRUE;
     }
      catch (Exception $e) {
        $this->rollback ();
        $message = 'An error occurred while deleting video record';
        throw new Exception ($message . $e->getMessage());
      }
  }
  

  private function _validateVideoData ($input) {
    if (!$this->checkSetData (
        $input,
        array ('youtubeUrl'),
        array ('title')
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
            'youtubeUrl' => 'Youtube URL cannot be empty.'
          ),
          'notEmptyLang' => array (
            'title' => 'Title cannot be empty.'
          )
        )
      )
    );
  }

}
?>