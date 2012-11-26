<?php
class BannerRepository extends Repository {

  public function __construct () {
    parent::__construct ();
  }

  /**
   * Method returns a single Banner object.
   * @param array $params An array of parameters for query generation.
   * @return Banner The requested Banner object or NULL if none found.
   */
  public function getBanner ($params = array ()) {
    if (empty ($params)) {
        return NULL;
      }
    
    $query = "
      SELECT *
      FROM ". DBP ."banner AS b
      WHERE 1 = 1
    ";

    $queryParams = array ();

    if (array_key_exists ('bannerId', $params)) {
      $query .= "
        AND b.bannerId = :bannerId
      ";
      $queryParams[':bannerId'] = array (intval ($params['bannerId']), PDO::PARAM_INT);
    }
    
    try {
      $results = $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
    }
    catch (Exception $e) {
      $message = 'An error occurred while fetching banner record';
      throw new Exception ($message . $e->getMessage());
    }

    if (!$results || empty ($results)) {
      return NULL;
    }
    
    $image = $this->getImage ($results[0]['bannerId']);
    $results[0]['image'] = $image;
    
    $banner = Factory::getBanner ($results[0]);
      
    return $banner;
  }
  /**
   * Method returns a single BannerImage object.
   * @param integer $bannerId Banner ID.
   * @return BannerImage The requested Banner object or NULL if none found.
   */
  public function getImage ($bannerId) {
    $query = "
      SELECT *
      FROM ". DBP ."bannerImage
      WHERE `bannerId` = :bannerId
    ";

    $queryParams = array (
      ':bannerId' => array ($bannerId, PDO::PARAM_INT)
    );

    try {
      $results = $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
      return !empty ($results) ? Factory::getBannerImage ($results[0]) : NULL;
    }
    catch (Exception $e) {
      $message = 'An error occurred while fetching banner record';
      throw new Exception ($message . $e->getMessage());
    }
  }


  /**
   * Method returns a count of Banner records in the database.
   * @param array $params An array of parameters for query generation.
   * @return integer A count of Banner records in the database.
   */
  public function getBannerCount ($params = array ()) {
    
    $query = "
      SELECT COUNT(bannerId) AS bannerCount
      FROM ". DBP ."banner AS b
      WHERE 1 = 1
    ";
    $queryParams = array ();
    // Handle filter parameters
    if (isset ($params['filterParams']) && is_array ($params['filterParams'])
      && isset ($params['filterParams']['inSearch']) && is_array ($params['filterParams']['inSearch'])) {
      foreach ($params['filterParams']['inSearch'] as $attrName) {
        if (in_array ($attrName, array ('name', 'link'))) {
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
      $message = 'An error occurred while fething a count of banner records';
      throw new Exception ($message . $e->getMessage());
    }

    return intval ($results[0]['bannerCount']);
  }
  /**
   * Method returns an array of Banner objects.
   * @param array $params An array of parameters for query generation.
   * @return array An array of Banner objects.
   */
  public function getBanners ($params = array ()) {
    
    $query = "
      SELECT *
      FROM ". DBP ."banner AS b
      WHERE 1 = 1
    ";
    $queryParams = array ();
    // Handle filter parameters
    if (isset ($params['filterParams']) && is_array ($params['filterParams'])
      && isset ($params['filterParams']['inSearch']) && is_array ($params['filterParams']['inSearch'])) {
      foreach ($params['filterParams']['inSearch'] as $attrName) {
        if (in_array ($attrName, array ('name', 'link'))) {
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
    
    if (!isset ($params['orderBy'])) {
      $params['orderBy'] = 'position';
      $params['orderDirection'] = 'asc';
    };
		$query .= $this->_getOrderAndLimit ($params);

		$banners = array ();
    try {
      $results = $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
    }
    catch (Exception $e) {
      $message = 'An error occurred while fetching banner records';
      throw new Exception ($message . $e->getMessage());
    }

    foreach ($results as &$result) {
      
    if (isset ($params['image'])) {
      $image = $this->getImage ($result['bannerId']);
      $result['image'] = $image;
    }
    
    }

    return Factory::getBanners ($results);
  }

  /**
   * Method inserts a new banner into the database.
   * @param array $data Data for the new banner.
   * @return integer bannerId of the newly inserted banner.
   */
  public function addBanner ($data) {
    if (empty ($data) || !$this->_validateBannerData ($data)) {
      throw new Exception ('Banner did not pass validation.', 10);
    }

    try {
      $this->startTransaction ();
    
      // Get max position value
      $query = "
        SELECT MAX(position) as maxPosition
        FROM " . DBP . "banner
      ";
      $queryParams = array ();
      $maxPosition = NULL;
      $results = $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
      $maxPosition = $results[0]['maxPosition'];

      $query = "
        INSERT INTO " . DBP . "banner
        SET `name` = :name,
            `link` = :link,
            `created` = NOW(),
            `modified` = NOW(),
            `position` = :position
      ";
      $queryParams = array (
        ':name' => Tools::stripTags (trim ($data['name'])),
        ':link' => Tools::stripTags (trim ($data['link'])),
        ':position' => array ($maxPosition + 1, PDO::PARAM_INT)
      );
      $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
      $bannerId = $this->lastInsertId ();
      
      // Upload image
      $imageData = Tools::uploadImages (
        array (
          'name' => 'image',
          'maxCount' => 1,
          'types' => array (
            'image' => array (
              'directory' => Config::read ('bannerImagePath'),
              'dimensions' => Config::read ('bannerImageDimensions')
            ),
          )
        )
      );
      $imageData = isset ($imageData[0]) ? $imageData[0] : NULL;

      if (!is_null ($imageData)) {
        $query = "
          INSERT INTO " . DBP . "bannerImage
          SET `bannerId` = :bannerId,
              `filename` = :filename,
              `width` = :width,
              `height` = :height,
              `created` = NOW()
        ";
        $queryParams = array (
          ':bannerId' => array ($bannerId, PDO::PARAM_INT),
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
      $message = 'An error occurred while adding banner record';
      throw new Exception ($message . $e->getMessage());
    }
    return $this->getBanner (array ('bannerId' => $bannerId));
  }

  /**
   * Method edits an existing banner database record.
   * @param array $data New data for the banner.
   * @return bool Success flag; TRUE if editing was successful, FALSE if not.
   */
  public function editBanner ($bannerId, $data) {
    if (empty ($data) || !$this->_validateBannerData ($data)) {
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
              'directory' => Config::read ('bannerImagePath'),
              'dimensions' => Config::read ('bannerImageDimensions')
            ),
          )
        )
      );
      $imageData = isset ($imageData[0]) ? $imageData[0] : NULL;
      if (!empty ($imageData) || isset ($data['deleteImage'])) {
        $this->_deleteImage ($bannerId);
        if (!empty ($imageData)) {
          $query = "
            INSERT INTO " . DBP . "bannerImage
            SET `bannerId` = :bannerId,
                `filename` = :filename,
                `width` = :width,
                `height` = :height,
                `created` = NOW()
          ";
          $queryParams = array (
            ':bannerId' => array ($bannerId, PDO::PARAM_INT),
            ':filename' => $imageData['filename'],
            ':width' => array ($imageData['width'], PDO::PARAM_INT),
            ':height' => array ($imageData['height'], PDO::PARAM_INT)
          );
          $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
        }
      }

      $query = "
        UPDATE " . DBP . "banner
        SET `name` = :name,
            `link` = :link,
            `modified` = NOW(),
            modified = NOW()
        WHERE `bannerId` = :bannerId
      ";
      $queryParams = array (
        ':name' => Tools::stripTags (trim ($data['name'])),
        ':link' => Tools::stripTags (trim ($data['link'])),
        ':bannerId' => array ($bannerId, PDO::PARAM_INT)
      );
      $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
      $this->commit ();
    }
    catch (Exception $e) {
      $this->rollback ();
      $message = 'An error occurred while updating banner record';
      throw new Exception ($message . $e->getMessage());
    }

    return TRUE;
  }

  /**
   * Method deletes an existing banner database record.
   * @param integer $bannerId banner database ID.
   * @return bool Success flag; TRUE if deleting was successful, FALSE if not.
   */
  public function deleteBanner ($bannerId) {
    try {
      $this->startTransaction ();
      $this->_deleteImage ($bannerId);
      
      $banner = $this->getBanner (
        array ('bannerId' => $bannerId)
      );
      if (is_null ($banner)) {
        throw new Exception ("Trying to delete non-existing banner");
      }

      // Delete record
      $query = "
        DELETE FROM " . DBP . "banner
        WHERE `bannerId` = :bannerId
      ";
      $queryParams = array (
        ':bannerId' => array ($bannerId, PDO::PARAM_INT)
      );
      $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);

      // Update position for remaining records
      $query = "
        UPDATE " . DBP . "banner
          SET position = position - 1
          WHERE position > :position
      ";
      $queryParams = array (
        ':position' => $banner->getPosition ()
      );
      $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
    
      $this->commit ();

      return TRUE;
     }
      catch (Exception $e) {
        $this->rollback ();
        $message = 'An error occurred while deleting banner record';
        throw new Exception ($message . $e->getMessage());
      }
  }
  

  private function _validateBannerData ($input) {
    if (!$this->checkSetData (
        $input,
        array ('name', 'link')
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
            'name' => 'Name cannot be empty.',
              'link' => 'Link cannot be empty.'
          ),
          'notEmptyLang' => array (
            
          )
        )
      )
    );
  }
  private function _deleteImage ($bannerId) {
    // Delete image files on server
    $banner = $this->getBanner (array ('bannerId' => $bannerId));
    if (is_null ($banner)) {
      throw new Exception ("Trying to delete image for a non-existant banner");
    }
    if ($banner->getImage ()) {
      $banner->getImage ()->deleteFiles ();

      // Delete image from database
      $query = "
        DELETE FROM " . DBP . "bannerImage
        WHERE `bannerId` = :bannerId
      ";
      $queryParams = array (
        ':bannerId' => array ($bannerId, PDO::PARAM_INT)
      );
      $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
      }
  }

  public function moveBanner ($bannerId, $direction) {
    return $this->_moveEntry (
      array (
        'attributeName' => 'position',
        'entryAttributeName' => 'bannerId',
        'tableName' => 'banner',
        'direction' => $direction,
        'entryId' => $bannerId
      )
    );
  }

}
?>