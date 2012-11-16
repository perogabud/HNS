<?php
class GalleryRepository extends Repository {

  public function __construct () {
    parent::__construct ();
  }

  /**
   * Method returns a single Gallery object.
   * @param array $params An array of parameters for query generation.
   * @return Gallery The requested Gallery object or NULL if none found.
   */
  public function getGallery ($params = array ()) {
    if (empty ($params)) {
        return NULL;
      }

    $query = "
      SELECT *
      FROM ". DBP ."vw_gallery AS g
      WHERE 1 = 1
    ";

    $queryParams = array ();

    if (array_key_exists ('galleryId', $params)) {
      $query .= "
        AND g.galleryId = :galleryId
      ";
      $queryParams[':galleryId'] = array (intval ($params['galleryId']), PDO::PARAM_INT);
    }

    if (array_key_exists ('slug', $params)) {
      $query .= "
        AND g.slug = :slug
      ";
      $queryParams[':slug'] = trim ($params['slug']);
    }

    try {
      $results = $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
    }
    catch (Exception $e) {
      $message = 'An error occurred while fetching gallery record';
      throw new Exception ($message . ': ' . $e->getMessage(), 1, $e);
    }

    if (!$results || empty ($results)) {
      return NULL;
    }

    $images = $this->getImages ($results[0]['galleryId']);
    $results[0]['images'] = $images;

    $gallery = Factory::getGallery ($results);

    return $gallery;
  }
  /**
   * Method returns an array of GalleryImage objects.
   * @param integer $galleryId Gallery ID.
   * @return GalleryImage The requested Gallery object or NULL if none found.
   */
  public function getImages ($galleryId) {
    $query = "
      SELECT *
      FROM ". DBP ."galleryImage
      WHERE `galleryId` = :galleryId
      ORDER BY `position` ASC
    ";

    $queryParams = array (
      ':galleryId' => array ($galleryId, PDO::PARAM_INT)
    );

    try {
      $results = $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
      return !empty ($results) ? Factory::getGalleryImages ($results) : NULL;
    }
    catch (Exception $e) {
      $message = 'An error occurred while fetching gallery records';
      throw new Exception ($message . ': ' . $e->getMessage(), 1, $e);
    }
  }


  /**
   * Method returns a count of Gallery records in the database.
   * @param array $params An array of parameters for query generation.
   * @return integer A count of Gallery records in the database.
   */
  public function getGalleryCount ($params = array ()) {

    $query = "
      SELECT COUNT(galleryId) AS galleryCount
      FROM ". DBP ."vw_gallery AS g
      WHERE languageId = :languageId
    ";
    $queryParams = array (
      ':languageId' => Config::read ('lang')
    );
    // Handle filter parameters
    if (isset ($params['filterParams']) && is_array ($params['filterParams'])
      && isset ($params['filterParams']['inSearch']) && is_array ($params['filterParams']['inSearch'])) {
      foreach ($params['filterParams']['inSearch'] as $attrName) {
        if (in_array ($attrName, array ('title', 'category'))) {
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
      $message = 'An error occurred while fething a count of gallery records';
      throw new Exception ($message . ': ' . $e->getMessage(), 2, $e);
    }

    return intval ($results[0]['galleryCount']);
  }
  /**
   * Method returns an array of Gallery objects.
   * @param array $params An array of parameters for query generation.
   * @return array An array of Gallery objects.
   */
  public function getGallerys ($params = array ()) {

    $query = "
      SELECT *
      FROM ". DBP ."vw_gallery
      WHERE languageId = :languageId
    ";
    $queryParams = array (
      ':languageId' => Config::read ('lang')
    );
    // Handle filter parameters
    if (isset ($params['filterParams']) && is_array ($params['filterParams'])
      && isset ($params['filterParams']['inSearch']) && is_array ($params['filterParams']['inSearch'])) {
      foreach ($params['filterParams']['inSearch'] as $attrName) {
        if (in_array ($attrName, array ('title', 'category'))) {
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

		$gallerys = array ();
    try {
      $results = $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
    }
    catch (Exception $e) {
      $message = 'An error occurred while fetching gallery records';
      throw new Exception ($message . ': ' . $e->getMessage(), 2, $e);
    }

    foreach ($results as &$result) {
      $images = $this->getImages ($result['galleryId']);
      $result['images'] = $images;
    }

    return Factory::getGallerys ($results);
  }

  /**
   * Method inserts a new gallery into the database.
   * @param array $data Data for the new gallery.
   * @return integer galleryId of the newly inserted gallery.
   */
  public function addGallery ($data) {
    if (empty ($data) || !$this->_validateGalleryData ($data)) {
      throw new Exception ('Gallery did not pass validation.', 10);
    }

    try {
      $this->startTransaction ();

      $query = "
        INSERT INTO " . DBP . "gallery
        SET
            `created` = NOW(),
            `modified` = NOW()
      ";
      $queryParams = array (

      );
      $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);

      $galleryId = $this->lastInsertId ();

      foreach (Config::read ('supportedLangs') as $lang) {
        $query = "
          INSERT INTO " . DBP . "galleryI18n
          SET `title` = :title,
              `slug` = :slug,
              `category` = :category,
              `created` = NOW(),
              `modified` = NOW(),
              `languageId` = :languageId,
              `galleryId` = :galleryId
        ";
        $queryParams = array (
          ':title' => Tools::stripTags (trim ($data['title_' . $lang]), 'strict'),
          ':slug' => Tools::formatURI (Tools::stripTags (trim ($data['title_' . $lang]))),
          ':category' => empty ($data['category_' . $lang]) ? NULL : Tools::stripTags (trim ($data['category_' . $lang])),
          ':languageId' => $lang,
          ':galleryId' => $galleryId
        );
        $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
      }

      $this->commit ();
    }
    catch (Exception $e) {
      $this->rollback ();
      $message = 'An error occurred while adding gallery record';
      throw new Exception ($message . ': ' . $e->getMessage(), 3, $e);
    }
    return $this->getGallery (array ('galleryId' => $galleryId));
  }

  /**
   * Method edits an existing gallery database record.
   * @param array $data New data for the gallery.
   * @return bool Success flag; TRUE if editing was successful, FALSE if not.
   */
  public function editGallery ($galleryId, $data) {
    if (empty ($data) || !$this->_validateGalleryData ($data)) {
      throw new Exception ('Invalid data.', 10);
    }
    try {
      $this->startTransaction ();
      $query = "
        UPDATE " . DBP . "gallery
        SET
            `modified` = NOW()
        WHERE `galleryId` = :galleryId
      ";
      $queryParams = array (
        ':galleryId' => array ($galleryId, PDO::PARAM_INT)
      );
      $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);

      foreach (Config::read ('supportedLangs') as $lang) {
        $query = "
          INSERT INTO " . DBP . "galleryI18n
          SET `title` = :title,
              `slug` = :slug,
              `category` = :category,
              `modified` = NOW(),
              `galleryId` = :galleryId,
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
          ':galleryId' => array ($galleryId, PDO::PARAM_INT),
          ':languageId' => $lang
        );
        $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
      }
      $this->commit ();
    }
    catch (Exception $e) {
      $this->rollback ();
      $message = 'An error occurred while updating gallery record';
      throw new Exception ($message . ': ' . $e->getMessage(), 4, $e);
    }

    return TRUE;
  }

  /**
   * Method deletes an existing gallery database record.
   * @param integer $galleryId gallery database ID.
   * @return bool Success flag; TRUE if deleting was successful, FALSE if not.
   */
  public function deleteGallery ($galleryId) {
    try {
      $this->startTransaction ();
      $query = "
        DELETE FROM " . DBP . "gallery
        WHERE `galleryId` = :galleryId
      ";
      $queryParams = array (
        ':galleryId' => array ($galleryId, PDO::PARAM_INT)
      );
      $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);

      $this->commit ();

      return TRUE;
     }
      catch (Exception $e) {
        $this->rollback ();
        $message = 'An error occurred while deleting gallery record';
        throw new Exception ($message . ': ' . $e->getMessage(), 5, $e);
      }
  }


  private function _validateGalleryData ($input) {
    if (!$this->checkSetData (
        $input,
        array (),
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

          ),
          'notEmptyLang' => array (
            'title' => 'Title cannot be empty.'
          )
        )
      )
    );
  }
  public function addImage ($galleryId) {
    $imageData = Tools::uploadImages (
      array (
        'name' => 'image',
        'maxCount' => 1,
        'types' => array (
          'image' => array (
            'directory' => Config::read ('galleryImagePath'),
            'dimensions' => Config::read ('galleryImageDimensions')
          ),
          'largeThumbnail' => array (
            'directory' => Config::read ('galleryImageLargeThumbnailPath'),
            'dimensions' => Config::read ('galleryImageLargeThumbnailDimensions')
          ),
          'smallThumbnail' => array (
            'directory' => Config::read ('galleryImageSmallThumbnailPath'),
            'dimensions' => Config::read ('galleryImageSmallThumbnailDimensions')
          ),
        )
      )
    );

    if (empty ($imageData)) {
      return FALSE;
    }
    else {
      $imageData = $imageData[0];
    }

    // Get max position value
    $query = "
      SELECT MAX(position) as maxPosition
      FROM " . DBP . "galleryImage
    ";
    $queryParams = array ();
    $maxPosition = NULL;
    $results = $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
    $maxPosition = $results[0]['maxPosition'];

    $query = "
      INSERT INTO " . DBP . "galleryImage
      SET `galleryId` = :galleryId,
          `position` = :position,
          `filename` = :filename,
          `width` = :width,
          `height` = :height,
          `created` = NOW(),
          `modified` = NOW()
    ";
    $queryParams = array (
      ':galleryId' => array ($galleryId, PDO::PARAM_INT),
      ':position' => array ($maxPosition + 1, PDO::PARAM_INT),
      ':filename' => $imageData['filename'],
      ':width' => array ($imageData['width'], PDO::PARAM_INT),
      ':height' => array ($imageData['height'], PDO::PARAM_INT)
    );
    $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);

    return array (
      'filename' => $imageData['filename'],
      'imageId' => $this->lastInsertId ()
    );
  }

  public function moveImage ($galleryId, $imageId, $direction) {
    return $this->_moveEntry (
      array (
        'attributeName' => 'position',
        'tableName' => 'galleryImage',
        'direction' => $direction,
        'entryAttributeName' => 'imageId',
        'entryId' => $imageId,
        'parentAttributeName' => 'galleryId',
        'parentId' => $galleryId
      )
    );
  }

  public function deleteImage ($galleryId, $imageId) {
    try {
      $this->startTransaction ();
      $gallery = $this->getGallery (array ('galleryId' => $galleryId));

      // Get position
      $query = "
        SELECT position
        FROM " . DBP . "galleryImage
        WHERE `galleryId` = :galleryId
      ";
      $queryParams = array (
        ':galleryId' => array ($galleryId, PDO::PARAM_INT)
      );
      $position = NULL;
      $results = $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
      $position = $results[0]['position'];

      // Delete database record
      $query = "
        DELETE FROM " . DBP . "galleryImage
        WHERE `imageId` = :imageId
      ";
      $queryParams = array (
        ':imageId' => array ($imageId, PDO::PARAM_INT)
      );
      $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);

      // Delete image file on server
      foreach ($gallery->getImages () as $image) {
        if ($image->Id == $imageId) {
          $image->deleteFiles ();
          break;
        }
      }

      // Update position for remaining images
      $query = "
        UPDATE " . DBP . "galleryImage
          SET position = position - 1
          WHERE position > :position
      ";
      $queryParams = array (
        ':position' => array ($position, PDO::PARAM_INT)
      );
      $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);

      $this->commit ();
      return TRUE;
    }
    catch (Exception $e) {
      $this->rollback ();
      $message = 'An error occurred while deleting image record';
      throw new Exception ($message . ': ' . $e->getMessage(), 5, $e);
    }
  }

}
?>