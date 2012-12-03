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
      SELECT n.*, nk.title AS newsCategoryTitle
      FROM ". DBP ."newsItem AS n
      LEFT OUTER JOIN ". DBP ."newsCategory AS nk
        ON n.newsCategoryId = nk.newsCategoryId
      WHERE 1 = 1
    ";

    $queryParams = array ();

    if (array_key_exists ('newsItemId', $params)) {
      $query .= "
        AND n.newsItemId = :newsItemId
      ";
      $queryParams[':newsItemId'] = array (intval ($params['newsItemId']), PDO::PARAM_INT);
    }

    if (array_key_exists ('slug', $params)) {
      $query .= "
        AND n.slug = :slug
      ";
      $queryParams[':slug'] = trim ($params['slug']);
    }

    try {
      $results = $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
    }
    catch (Exception $e) {
      $message = 'An error occurred while fetching news item record';
      throw new Exception ($message . $e->getMessage());
    }

    if (!$results || empty ($results)) {
      return NULL;
    }

    $coverImage = $this->getCoverImage ($results[0]['newsItemId']);
    $results[0]['coverImage'] = $coverImage;

    $results[0]['language'] = $this->getLanguage (array ('languageId' => $results[0]['languageId']));

    $newsItem = Factory::getNewsItem ($results[0]);

    $customModuleRepository = new CustomModuleRepository ();
    $customModules = $customModuleRepository->getCustomModules (
      array (
        'newsItemId' => $newsItem->getId (),
        'relationName' => 'customModule'
      )
    );
    $newsItem->setCustomModules ($customModules);

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
      throw new Exception ($message . $e->getMessage());
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
      throw new Exception ($message . $e->getMessage());
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
      SELECT n.*, nk.title AS newsCategoryTitle
      FROM ". DBP ."newsItem AS n
      JOIN ". DBP ."language AS l
        ON n.languageId = l.languageId
      LEFT OUTER JOIN ". DBP ."newsCategory AS nk
        ON n.newsCategoryId = nk.newsCategoryId
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
    if (isset ($params['languageId'])) {
      $query .= "
        AND n.languageId = :languageId
      ";
      $queryParams[':languageId'] = trim ($params['languageId']);
    }
    
    if (isset ($params['isPublished']) && $params['isPublished'] === TRUE) {
      $query .= "
        AND n.isPublished = 1
      ";
    }
    
    if (isset ($params['isFeatured']) && $params['isFeatured']) {
      $query .= "
        AND n.isFeatured = 1
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
      throw new Exception ($message . $e->getMessage());
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
            `newsCategoryId` = :newsCategoryId,
            `slug` = :slug,
            `lead` = :lead,
            `content` = :content,
            `isPublished` = :isPublished,
            `isFeatured` = :isFeatured,
            `publishDate` = :publishDate,
            `created` = NOW(),
            `modified` = NOW()
      ";
      $queryParams = array (
        ':languageId' => Tools::stripTags (trim ($data['languageId'])),
        ':title' => Tools::stripTags (trim ($data['title']), 'strict'),
        ':newsCategoryId' => array ($data['newsCategoryId'], PDO::PARAM_INT),
        ':slug' => Tools::formatURI (Tools::stripTags (trim ($data['title']))),
        ':lead' => empty ($data['lead']) ? NULL : Tools::stripTags (trim ($data['lead']), 'loose'),
        ':content' => empty ($data['content']) ? NULL : Tools::stripTags (trim ($data['content']), 'loose'),
        ':isPublished' => isset ($data['isPublished']) ? '1' : '0',
        ':isFeatured' => isset ($data['isFeatured']) ? '1' : '0',
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

      // Handle many-to-many Custom Module relation
      if (isset ($data['customModuleId']) && is_array ($data['customModuleId'])) {
        foreach ($data['customModuleId'] as $customModuleId) {
          $query = "
            INSERT INTO " . DBP . "customModuleHasNewsItem
            SET `newsItemId` = :newsItemId,
                `customModuleId` = :customModuleId
          ";
          $queryParams = array (
            ':newsItemId' => array ($newsItemId, PDO::PARAM_INT),
            ':customModuleId' => array ($customModuleId, PDO::PARAM_INT),
          );
          $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
        }
      }

      $this->commit ();
    }
    catch (Exception $e) {
      $this->rollback ();
      $message = 'An error occurred while adding news item record';
      throw new Exception ($message . $e->getMessage());
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
            `newsCategoryId` = :newsCategoryId,
            `slug` = :slug,
            `lead` = :lead,
            `content` = :content,
            `isPublished` = :isPublished,
            `isFeatured` = :isFeatured,
            `publishDate` = :publishDate,
            `modified` = NOW(),
            modified = NOW()
        WHERE `newsItemId` = :newsItemId
      ";
      $queryParams = array (
        ':languageId' => Tools::stripTags (trim ($data['languageId'])),
        ':title' => Tools::stripTags (trim ($data['title']), 'strict'),
        ':newsCategoryId' => array ($data['newsCategoryId'], PDO::PARAM_INT),
        ':slug' => Tools::formatURI (Tools::stripTags (trim ($data['title']))),
        ':lead' => empty ($data['lead']) ? NULL : Tools::stripTags (trim ($data['lead']), 'loose'),
        ':content' => empty ($data['content']) ? NULL : Tools::stripTags (trim ($data['content']), 'loose'),
        ':isPublished' => isset ($data['isPublished']) ? '1' : '0',
        ':isFeatured' => isset ($data['isFeatured']) ? '1' : '0',
        ':publishDate' => array ($data['publishDate'], PDO::PARAM_INT),
        ':newsItemId' => array ($newsItemId, PDO::PARAM_INT)
      );
      $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);

      // Handle many-to-many Custom Module relation
      $customModuleIdParams = array (0);
      $queryParams = array (
        ':newsItemId' => array ($newsItemId, PDO::PARAM_INT)
      );
      for ($i = 0; $i < count ($data['customModuleId']); $i++) {
        $customModuleIdParams[] = ':id' . $i;
        $queryParams[':id' . $i] = $data['customModuleId'][$i];
      }
      $query = "
        DELETE FROM " . DBP . "customModuleHasNewsItem
        WHERE `newsItemId` = :newsItemId
          AND `customModuleId` NOT IN (". implode (', ', $customModuleIdParams) .")
      ";
      $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
      if (isset ($data['customModuleId']) && is_array ($data['customModuleId'])) {
        foreach ($data['customModuleId'] as $customModuleId) {
          $query = "
            INSERT INTO " . DBP . "customModuleHasNewsItem
            SET `newsItemId` = :newsItemId,
                `customModuleId` = :customModuleId
            ON DUPLICATE KEY UPDATE
                `newsItemId` = `newsItemId`
          ";
          $queryParams = array (
            ':newsItemId' => array ($newsItemId, PDO::PARAM_INT),
            ':customModuleId' => array ($customModuleId, PDO::PARAM_INT),
          );
          $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
          }
      }
      $this->commit ();
    }
    catch (Exception $e) {
      $this->rollback ();
      $message = 'An error occurred while updating news item record';
      throw new Exception ($message . $e->getMessage());
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
        throw new Exception ($message . $e->getMessage());
      }
  }
  
  public function getNewsCategories ($params = array ()) {

    $query = "
      SELECT *
      FROM ". DBP ."newsCategory AS nk
      WHERE 1 = 1
    ";
    $queryParams = array ();
    // Handle filter parameters
    if (isset ($params['filterParams']) && is_array ($params['filterParams'])
      && isset ($params['filterParams']['inSearch']) && is_array ($params['filterParams']['inSearch'])) {
      foreach ($params['filterParams']['inSearch'] as $attrName) {
        if (in_array ($attrName, array ('title'))) {
          if (isset ($params['filterParams'][$attrName])) {
            $query .= "
              AND n.$attrName LIKE :$attrName
            ";
            $queryParams[":$attrName"] = '%'. $params['filterParams'][$attrName] .'%';
          }
        }
      }
    }
    
		$query .= $this->_getOrderAndLimit ($params);

    try {
      $results = $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
    }
    catch (Exception $e) {
      $message = 'An error occurred while fetching news category records';
      throw new Exception ($message . $e->getMessage());
    }

    foreach ($results as &$result) {
      // Empty ...
    }

    return Factory::getNewsCategories ($results);
  }
  
  public function getNewsCategoryCount ($params = array ()) {

    $query = "
      SELECT COUNT(newsCategoryId) AS newsCategoryCount
      FROM ". DBP ."newsCategory AS nk
      WHERE 1 = 1
    ";
    $queryParams = array ();
    // Handle filter parameters
    if (isset ($params['filterParams']) && is_array ($params['filterParams'])
      && isset ($params['filterParams']['inSearch']) && is_array ($params['filterParams']['inSearch'])) {
      foreach ($params['filterParams']['inSearch'] as $attrName) {
        if (in_array ($attrName, array ('title'))) {
          if (isset ($params['filterParams'][$attrName])) {
            $query .= "
              AND n.$attrName LIKE :$attrName
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
      $message = 'An error occurred while fething a count of news category records';
      throw new Exception ($message . $e->getMessage());
    }

    return intval ($results[0]['newsCategoryCount']);
  }
  
  public function getNewsCategory ($params = array ()) {
    if (empty ($params)) {
      return NULL;
    }

    $query = "
      SELECT *
      FROM ". DBP ."newsCategory AS nk
      WHERE 1 = 1
    ";
    $queryParams = array ();
    
    if (array_key_exists ('newsCategoryId', $params)) {
      $query .= "
        AND nk.newsCategoryId = :newsCategoryId
      ";
      $queryParams[':newsCategoryId'] = array (intval ($params['newsCategoryId']), PDO::PARAM_INT);
    }
    
		$query .= $this->_getOrderAndLimit ($params);

    try {
      $results = $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
    }
    catch (Exception $e) {
      $message = 'An error occurred while fetching news category record';
      throw new Exception ($message . $e->getMessage());
    }

    return Factory::getNewsCategory ($results[0]);
  }
  
  public function editNewsCategory ($newsCategoryId, $data) {
    if (empty ($data) || !$this->_validateNewsCategoryData ($data)) {
      throw new Exception ('Invalid data.', 10);
    }
    try {
      $this->startTransaction ();
      $query = "
        UPDATE " . DBP . "newsCategory
        SET `title` = :title,
            `modified` = NOW()
        WHERE `newsCategoryId` = :newsCategoryId
      ";
      $queryParams = array (
        ':title' => Tools::stripTags (trim ($data['title']), 'strict'),
        ':newsCategoryId' => array ($newsCategoryId, PDO::PARAM_INT)
      );
      $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);

      $this->commit ();
    }
    catch (Exception $e) {
      $this->rollback ();
      $message = 'An error occurred while updating news category record';
      throw new Exception ($message . $e->getMessage());
    }

    return TRUE;
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
  
  public function deleteNewsCategory ($newsCategoryId) {
    try {
      $this->startTransaction ();
      
      $query = "
        DELETE FROM " . DBP . "newsCategory
        WHERE `newsCategoryId` = :newsCategoryId
      ";
      $queryParams = array (
        ':newsCategoryId' => array ($newsCategoryId, PDO::PARAM_INT)
      );
      $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);

      $this->commit ();

      return TRUE;
     }
      catch (Exception $e) {
        $this->rollback ();
        $message = 'An error occurred while deleting news category record';
        throw new Exception ($message . $e->getMessage());
      }
  }
  
  public function addNewsCategory ($data) {
    if (empty ($data) || !$this->_validateNewsCategoryData ($data)) {
      throw new Exception ('News Category did not pass validation.', 10);
    }

    try {
      $this->startTransaction ();

      $query = "
        INSERT INTO " . DBP . "newsCategory
        SET `title` = :title,
            `created` = NOW(),
            `modified` = NOW()
      ";
      $queryParams = array (
        ':title' => Tools::stripTags (trim ($data['title']), 'strict')
      );
      $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
      $newsCategoryId = $this->lastInsertId ();

      $this->commit ();
    }
    catch (Exception $e) {
      $this->rollback ();
      $message = 'An error occurred while adding news category record';
      throw new Exception ($message . $e->getMessage());
    }
    return $this->getNewsCategory (array ('newsCategoryId' => $newsCategoryId));
  }
  
  private function _validateNewsCategoryData ($input) {
    if (!$this->checkSetData (
        $input,
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
            'title' => 'Title cannot be empty.',
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