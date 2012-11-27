<?php
class CustomModuleImageRepository extends Repository {

  public function __construct () {
    parent::__construct ();
  }

  /**
   * Method returns a single CustomModuleImage object.
   * @param array $params An array of parameters for query generation.
   * @return CustomModuleImage The requested CustomModuleImage object or NULL if none found.
   */
  public function getCustomModuleImage ($params = array ()) {
    if (empty ($params)) {
        return NULL;
      }

    $query = "
      SELECT *
      FROM ". DBP ."customModuleImage AS c
      WHERE 1 = 1
    ";

    $queryParams = array ();

    if (array_key_exists ('customModuleImageId', $params)) {
      $query .= "
        AND c.customModuleImageId = :customModuleImageId
      ";
      $queryParams[':customModuleImageId'] = array (intval ($params['customModuleImageId']), PDO::PARAM_INT);
    }

    try {
      $results = $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
    }
    catch (Exception $e) {
      $message = 'An error occurred while fetching custom module image record';
      throw new Exception ($message . $e->getMessage());
    }

    if (!$results || empty ($results)) {
      return NULL;
    }

    $image = $this->getImage ($results[0]['customModuleImageId']);
    $results[0]['image'] = $image;

    $customModuleImage = Factory::getCustomModuleImage ($results[0]);

    return $customModuleImage;
  }
  /**
   * Method returns a single CustomModuleImageImage object.
   * @param integer $customModuleImageId custom Module Image ID.
   * @return CustomModuleImageImage The requested CustomModuleImage object or NULL if none found.
   */
  public function getImage ($customModuleImageId) {
    $query = "
      SELECT *
      FROM ". DBP ."customModuleImageImage
      WHERE `customModuleImageId` = :customModuleImageId
    ";

    $queryParams = array (
      ':customModuleImageId' => array ($customModuleImageId, PDO::PARAM_INT)
    );

    try {
      $results = $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
      return !empty ($results) ? Factory::getCustomModuleImageImage ($results[0]) : NULL;
    }
    catch (Exception $e) {
      $message = 'An error occurred while fetching custom module image record';
      throw new Exception ($message . $e->getMessage());
    }
  }


  /**
   * Method returns a count of CustomModuleImage records in the database.
   * @param array $params An array of parameters for query generation.
   * @return integer A count of CustomModuleImage records in the database.
   */
  public function getCustomModuleImageCount ($params = array ()) {

    $query = "
      SELECT COUNT(customModuleImageId) AS customModuleImageCount
      FROM ". DBP ."customModuleImage AS c
      WHERE 1 = 1
    ";
    $queryParams = array ();
    // Handle filter parameters
    if (isset ($params['filterParams']) && is_array ($params['filterParams'])
      && isset ($params['filterParams']['inSearch']) && is_array ($params['filterParams']['inSearch'])) {
      foreach ($params['filterParams']['inSearch'] as $attrName) {
        if (in_array ($attrName, array ('title'))) {
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
      $message = 'An error occurred while fething a count of custom module image records';
      throw new Exception ($message . $e->getMessage());
    }

    return intval ($results[0]['customModuleImageCount']);
  }
  /**
   * Method returns an array of CustomModuleImage objects.
   * @param array $params An array of parameters for query generation.
   * @return array An array of CustomModuleImage objects.
   */
  public function getCustomModuleImages ($params = array ()) {

    $query = "
      SELECT *
      FROM ". DBP ."customModuleImage AS c
      WHERE 1 = 1
    ";
    $queryParams = array ();
    // Handle filter parameters
    if (isset ($params['filterParams']) && is_array ($params['filterParams'])
      && isset ($params['filterParams']['inSearch']) && is_array ($params['filterParams']['inSearch'])) {
      foreach ($params['filterParams']['inSearch'] as $attrName) {
        if (in_array ($attrName, array ('title'))) {
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

		$customModuleImages = array ();
    try {
      $results = $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
    }
    catch (Exception $e) {
      $message = 'An error occurred while fetching custom module image records';
      throw new Exception ($message . $e->getMessage());
    }

    foreach ($results as &$result) {

    if (isset ($params['image'])) {
      $image = $this->getImage ($result['customModuleImageId']);
      $result['image'] = $image;
    }

    }

    return Factory::getCustomModuleImages ($results);
  }

  /**
   * Method inserts a new customModuleImage into the database.
   * @param array $data Data for the new customModuleImage.
   * @return integer customModuleImageId of the newly inserted customModuleImage.
   */
  public function addCustomModuleImage ($data) {
    if (!$this->_validateCustomModuleImageData ($data)) {
      throw new Exception ('custom Module Image did not pass validation.', 10);
    }

    try {
      $this->startTransaction ();

      // Delete all prior to inserting new for itemId?

      $query = "
        INSERT INTO " . DBP . "customModuleImage
        SET `customModuleItemId` = :customModuleItemId,
            `title` = :title,
            `created` = NOW(),
            `modified` = NOW()
      ";
      $queryParams = array (
        ':title' => empty ($data['title']) ? NULL : Tools::stripTags (trim ($data['title'])),
        ':customModuleItemId' => array ($data['customModuleItemId'], PDO::PARAM_INT)
      );
      $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
      $customModuleImageId = $this->lastInsertId ();

      // Upload image
      $imageData = Tools::uploadImages (
        array (
          'name' => 'image',
          'maxCount' => 1,
          'types' => array (
            'image' => array (
              'directory' => Config::read ('customModuleImageImagePath'),
              'dimensions' => Config::read ('customModuleImageImageDimensions')
            ),
            'smallImage' => array (
              'directory' => Config::read ('customModuleImageImageSmallImagePath'),
              'dimensions' => Config::read ('customModuleImageImageSmallImageDimensions')
            ),
            'thumbnail' => array (
              'directory' => Config::read ('customModuleImageImageThumbnailPath'),
              'dimensions' => Config::read ('customModuleImageImageThumbnailDimensions')
            ),
            'smallThumbnail' => array (
              'directory' => Config::read ('customModuleImageImageSmallThumbnailPath'),
              'dimensions' => Config::read ('customModuleImageImageSmallThumbnailDimensions')
            ),
          )
        )
      );
      $imageData = isset ($imageData[0]) ? $imageData[0] : NULL;

      if (!is_null ($imageData)) {
        $query = "
          INSERT INTO " . DBP . "customModuleImageImage
          SET `customModuleImageId` = :customModuleImageId,
              `filename` = :filename,
              `width` = :width,
              `height` = :height,
              `created` = NOW()
        ";
        $queryParams = array (
          ':customModuleImageId' => array ($customModuleImageId, PDO::PARAM_INT),
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
      $message = 'An error occurred while adding custom module image record';
      throw new Exception ($message . $e->getMessage());
    }
    return $this->getCustomModuleImage (array ('customModuleImageId' => $customModuleImageId));
  }

  /**
   * Method edits an existing customModuleImage database record.
   * @param array $data New data for the customModuleImage.
   * @return bool Success flag; TRUE if editing was successful, FALSE if not.
   */
  public function editCustomModuleImage ($customModuleImageId, $data) {
    if (empty ($data) || !$this->_validateCustomModuleImageData ($data)) {
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
              'directory' => Config::read ('customModuleImageImagePath'),
              'dimensions' => Config::read ('customModuleImageImageDimensions')
            ),
            'smallImage' => array (
              'directory' => Config::read ('customModuleImageImageSmallImagePath'),
              'dimensions' => Config::read ('customModuleImageImageSmallImageDimensions')
            ),
            'thumbnail' => array (
              'directory' => Config::read ('customModuleImageImageThumbnailPath'),
              'dimensions' => Config::read ('customModuleImageImageThumbnailDimensions')
            ),
            'smallThumbnail' => array (
              'directory' => Config::read ('customModuleImageImageSmallThumbnailPath'),
              'dimensions' => Config::read ('customModuleImageImageSmallThumbnailDimensions')
            ),
          )
        )
      );
      $imageData = isset ($imageData[0]) ? $imageData[0] : NULL;
      if (!empty ($imageData) || isset ($data['deleteImage'])) {
        $this->_deleteImage ($customModuleImageId);
        if (!empty ($imageData)) {
          $query = "
            INSERT INTO " . DBP . "customModuleImageImage
            SET `customModuleImageId` = :customModuleImageId,
                `filename` = :filename,
                `width` = :width,
                `height` = :height,
                `created` = NOW()
          ";
          $queryParams = array (
            ':customModuleImageId' => array ($customModuleImageId, PDO::PARAM_INT),
            ':filename' => $imageData['filename'],
            ':width' => array ($imageData['width'], PDO::PARAM_INT),
            ':height' => array ($imageData['height'], PDO::PARAM_INT)
          );
          $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
        }
      }

      $query = "
        UPDATE " . DBP . "customModuleImage
        SET `title` = :title,
            `customModuleItemId` = :customModuleItemId,
            `modified` = NOW()
        WHERE `customModuleImageId` = :customModuleImageId
      ";
      $queryParams = array (
        ':title' => empty ($data['title']) ? NULL : Tools::stripTags (trim ($data['title'])),
        ':customModuleItemId' => array ($params['customModuleItemId'], PDO::PARAM_INT),
        ':customModuleImageId' => array ($customModuleImageId, PDO::PARAM_INT)
      );
      $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
      $this->commit ();
    }
    catch (Exception $e) {
      $this->rollback ();
      $message = 'An error occurred while updating custom module image record';
      throw new Exception ($message . $e->getMessage());
    }

    return TRUE;
  }

  /**
   * Method deletes an existing customModuleImage database record.
   * @param integer $customModuleImageId customModuleImage database ID.
   * @return bool Success flag; TRUE if deleting was successful, FALSE if not.
   */
  public function deleteCustomModuleImage ($customModuleImageId) {
    try {
      $this->startTransaction ();
      $this->_deleteImage ($customModuleImageId);

      $query = "
        DELETE FROM " . DBP . "customModuleImage
        WHERE `customModuleImageId` = :customModuleImageId
      ";
      $queryParams = array (
        ':customModuleImageId' => array ($customModuleImageId, PDO::PARAM_INT)
      );
      $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);

      $this->commit ();

      return TRUE;
     }
      catch (Exception $e) {
        $this->rollback ();
        $message = 'An error occurred while deleting custom module image record';
        throw new Exception ($message . $e->getMessage());
      }
  }


  private function _validateCustomModuleImageData ($input) {
    if (!$this->checkSetData (
        $input,
        array ()
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

          )
        )
      )
    );
  }
  private function _deleteImage ($customModuleImageId) {
    // Delete image files on server
    $customModuleImage = $this->getCustomModuleImage (array ('customModuleImageId' => $customModuleImageId));
    if (is_null ($customModuleImage)) {
      throw new Exception ("Trying to delete image for a non-existant customModuleImage");
    }
    if ($customModuleImage->getImage ()) {
      $customModuleImage->getImage ()->deleteFiles ();

      // Delete image from database
      $query = "
        DELETE FROM " . DBP . "customModuleImageImage
        WHERE `customModuleImageId` = :customModuleImageId
      ";
      $queryParams = array (
        ':customModuleImageId' => array ($customModuleImageId, PDO::PARAM_INT)
      );
      $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
      }
  }


}
?>