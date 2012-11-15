<?php
class NewsItemRepository extends Repository {

  public function __construct () {
    parent::__construct ();
  }

  /**
   * Method returns a single NewsItem object.
   * @param array $params An array of parameters for query generation.
   * @return NewsItem The requested NewsItem object or NULL if none found.
   */
  public function getNewsItem ($params = array ()) {
    if (empty ($params)) {
        return NULL;
      }

    $query = "
      SELECT *
      FROM ". DBP ."newsItem AS n
      WHERE 1 = 1
    ";

    $queryParams = array ();

    if (array_key_exists ('newsItemId', $params)) {
      $query .= "
        AND n.newsItemId = :newsItemId
      ";
      $queryParams[':newsItemId'] = array (intval ($params['newsItemId']), PDO::PARAM_INT);
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

    $coverImage = $this->getCoverImage ($results[0]['newsItemId']);
    $results[0]['coverImage'] = $coverImage;

    $results[0]['language'] = $this->getLanguage (array ('languageId' => $results[0]['languageId']));

    $newsItem = Factory::getNewsItem ($results[0]);

    return $newsItem;
  }

  /**
   * Method returns a single NewsItemCoverImage object.
   * @param integer $newsItemId News Item ID.
   * @return NewsItemCoverImage The requested NewsItem object or NULL if none found.
   */
  public function getCoverImage ($newsItemId) {
    $query = "
      SELECT *
      FROM ". DBP ."newsItemCoverImage
      WHERE `newsItemId` = :newsItemId
    ";

    $queryParams = array (
      ':newsItemId' => array ($newsItemId, PDO::PARAM_INT)
    );

    try {
      $results = $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
      return !empty ($results) ? Factory::getNewsItemCoverImage ($results[0]) : NULL;
    }
    catch (Exception $e) {
      $message = 'An error occurred while fetching news item record';
      throw new Exception ($message . ': ' . $e->getMessage(), 1, $e);
    }
  }

  /**
   * Method returns a count of NewsItem records in the database.
   * @param array $params An array of parameters for query generation.
   * @return integer A count of NewsItem records in the database.
   */
  public function getNewsItemCount ($params = array ()) {

    $query = "
      SELECT COUNT(newsItemId) AS newsItemCount
      FROM ". DBP ."newsItem AS n
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
      $message = 'An error occurred while fething a count of news item records';
      throw new Exception ($message . ': ' . $e->getMessage(), 2, $e);
    }

    return intval ($results[0]['newsItemCount']);
  }
  /**
   * Method returns an array of NewsItem objects.
   * @param array $params An array of parameters for query generation.
   * @return array An array of NewsItem objects.
   */
  public function getNewsItems ($params = array ()) {

    $query = "
      SELECT *
      FROM ". DBP ."newsItem AS n
      JOIN ". DBP ."language AS l
        ON n.languageId = l.languageId
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
              AND n.$attrName = :$attrName
            ";
            $queryParams[":$attrName"] = isset ($params['filterParams'][$attrName]) ? '1' : '0';
          }
          elseif (isset ($params['filterParams'][$attrName])) {
            $query .= "
              AND n.$attrName LIKE :$attrName
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

		$newsItems = array ();
    try {
      $results = $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
    }
    catch (Exception $e) {
      $message = 'An error occurred while fetching news item records';
      throw new Exception ($message . ': ' . $e->getMessage(), 2, $e);
    }

    foreach ($results as &$result) {
      $result['language'] = Factory::getLanguage ($result);
      $coverImage = $this->getCoverImage ($result['newsItemId']);
      $result['coverImage'] = $coverImage;
    }

    return Factory::getNewsItems ($results);
  }

  /**
   * Method inserts a new newsItem into the database.
   * @param array $data Data for the new newsItem.
   * @return integer newsItemId of the newly inserted newsItem.
   */
  public function addNewsItem ($data) {
    if (empty ($data) || !$this->_validateNewsItemData ($data)) {
      throw new Exception ('News Item did not pass validation.', 10);
    }

    try {
      $this->startTransaction ();

      $query = "
        INSERT INTO " . DBP . "newsItem
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
        ':lead' => empty ($data['lead']) ? NULL : Tools::stripTags (trim ($data['lead']), 'loose'),
        ':content' => empty ($data['content']) ? NULL : Tools::stripTags (trim ($data['content']), 'loose'),
        ':isPublished' => isset ($data['isPublished']) ? '1' : '0',
        ':publishDate' => array ($data['publishDate'], PDO::PARAM_INT)
      );
      $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
      $newsItemId = $this->lastInsertId ();

      // Upload coverImage
      $coverImageData = Tools::uploadImages (
        array (
          'name' => 'coverImage',
          'maxCount' => 1,
          'types' => array (
            'coverImage' => array (
              'directory' => Config::read ('newsItemCoverImagePath'),
              'dimensions' => Config::read ('newsItemCoverImageDimensions')
            ),
            'largeThumbnail' => array (
              'directory' => Config::read ('newsItemCoverImageLargeThumbnailPath'),
              'dimensions' => Config::read ('newsItemCoverImageLargeThumbnailDimensions')
            ),
            'smallThumbnail' => array (
              'directory' => Config::read ('newsItemCoverImageSmallThumbnailPath'),
              'dimensions' => Config::read ('newsItemCoverImageSmallThumbnailDimensions')
            ),
          )
        )
      );
      $coverImageData = isset ($coverImageData[0]) ? $coverImageData[0] : NULL;

      if (!is_null ($coverImageData)) {
        $query = "
          INSERT INTO " . DBP . "newsItemCoverImage
          SET `newsItemId` = :newsItemId,
              `filename` = :filename,
              `width` = :width,
              `height` = :height,
              `created` = NOW()
        ";
        $queryParams = array (
          ':newsItemId' => array ($newsItemId, PDO::PARAM_INT),
          ':filename' => $coverImageData['filename'],
          ':width' => array ($coverImageData['width'], PDO::PARAM_INT),
          ':height' => array ($coverImageData['height'], PDO::PARAM_INT)
        );
        $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
      }

      $this->commit ();
    }
    catch (Exception $e) {
      $this->rollback ();
      $message = 'An error occurred while adding news item record';
      throw new Exception ($message . ': ' . $e->getMessage(), 3, $e);
    }
    return $this->getNewsItem (array ('newsItemId' => $newsItemId));
  }

  /**
   * Method edits an existing newsItem database record.
   * @param array $data New data for the newsItem.
   * @return bool Success flag; TRUE if editing was successful, FALSE if not.
   */
  public function editNewsItem ($newsItemId, $data) {
    if (empty ($data) || !$this->_validateNewsItemData ($data)) {
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
              'directory' => Config::read ('newsItemCoverImagePath'),
              'dimensions' => Config::read ('newsItemCoverImageDimensions')
            ),
            'largeThumbnail' => array (
              'directory' => Config::read ('newsItemCoverImageLargeThumbnailPath'),
              'dimensions' => Config::read ('newsItemCoverImageLargeThumbnailDimensions')
            ),
            'smallThumbnail' => array (
              'directory' => Config::read ('newsItemCoverImageSmallThumbnailPath'),
              'dimensions' => Config::read ('newsItemCoverImageSmallThumbnailDimensions')
            ),
          )
        )
      );
      $coverImageData = isset ($coverImageData[0]) ? $coverImageData[0] : NULL;
      if (!empty ($coverImageData) || isset ($data['deleteCoverImage'])) {
        $this->_deleteCoverImage ($newsItemId);
        if (!empty ($coverImageData)) {
          $query = "
            INSERT INTO " . DBP . "newsItemCoverImage
            SET `newsItemId` = :newsItemId,
                `filename` = :filename,
                `width` = :width,
                `height` = :height,
                `created` = NOW()
          ";
          $queryParams = array (
            ':newsItemId' => array ($newsItemId, PDO::PARAM_INT),
            ':filename' => $coverImageData['filename'],
            ':width' => array ($coverImageData['width'], PDO::PARAM_INT),
            ':height' => array ($coverImageData['height'], PDO::PARAM_INT)
          );
          $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
        }
      }

      $query = "
        UPDATE " . DBP . "newsItem
        SET `languageId` = :languageId,
            `title` = :title,
            `slug` = :slug,
            `lead` = :lead,
            `content` = :content,
            `isPublished` = :isPublished,
            `publishDate` = :publishDate,
            `modified` = NOW(),
            modified = NOW()
        WHERE `newsItemId` = :newsItemId
      ";
      $queryParams = array (
        ':languageId' => Tools::stripTags (trim ($data['languageId'])),
        ':title' => Tools::stripTags (trim ($data['title']), 'strict'),
        ':slug' => Tools::formatURI (Tools::stripTags (trim ($data['title']))),
        ':lead' => empty ($data['lead']) ? NULL : Tools::stripTags (trim ($data['lead']), 'loose'),
        ':content' => empty ($data['content']) ? NULL : Tools::stripTags (trim ($data['content']), 'loose'),
        ':isPublished' => isset ($data['isPublished']) ? '1' : '0',
        ':publishDate' => array ($data['publishDate'], PDO::PARAM_INT),
        ':newsItemId' => array ($newsItemId, PDO::PARAM_INT)
      );
      $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
      $this->commit ();
    }
    catch (Exception $e) {
      $this->rollback ();
      $message = 'An error occurred while updating news item record';
      throw new Exception ($message . ': ' . $e->getMessage(), 4, $e);
    }

    return TRUE;
  }

  /**
   * Method deletes an existing newsItem database record.
   * @param integer $newsItemId newsItem database ID.
   * @return bool Success flag; TRUE if deleting was successful, FALSE if not.
   */
  public function deleteNewsItem ($newsItemId) {
    try {
      $this->startTransaction ();
      $this->_deleteCoverImage ($newsItemId);
      $query = "
        DELETE FROM " . DBP . "newsItem
        WHERE `newsItemId` = :newsItemId
      ";
      $queryParams = array (
        ':newsItemId' => array ($newsItemId, PDO::PARAM_INT)
      );
      $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);

      $this->commit ();

      return TRUE;
     }
      catch (Exception $e) {
        $this->rollback ();
        $message = 'An error occurred while deleting news item record';
        throw new Exception ($message . ': ' . $e->getMessage(), 5, $e);
      }
  }

  private function _validateNewsItemData ($input) {
    if (!$this->checkSetData (
        $input,
        array ('languageId', 'title', 'publishDate')
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
              'publishDate' => 'Publish Date cannot be empty.'
          ),
          'notEmptyLang' => array (

          )
        )
      )
    );
  }

  private function _deleteCoverImage ($newsItemId) {
    // Delete image files on server
    $newsItem = $this->getNewsItem (array ('newsItemId' => $newsItemId));
    if (is_null ($newsItem)) {
      throw new Exception ("Trying to delete coverImage for a non-existant newsItem");
    }
    if ($newsItem->getCoverImage ()) {
      $newsItem->getCoverImage ()->deleteFiles ();

      // Delete coverImage from database
      $query = "
        DELETE FROM " . DBP . "newsItemCoverImage
        WHERE `newsItemId` = :newsItemId
      ";
      $queryParams = array (
        ':newsItemId' => array ($newsItemId, PDO::PARAM_INT)
      );
      $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
      }
  }

}
?>