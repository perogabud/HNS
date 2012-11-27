<?php
class CustomModuleItemRepository extends Repository {

  public function __construct () {
    parent::__construct ();
  }

  /**
   * Method returns a single CustomModuleItem object.
   * @param array $params An array of parameters for query generation.
   * @return CustomModuleItem The requested CustomModuleItem object or NULL if none found.
   */
  public function getCustomModuleItem ($params = array ()) {
    if (empty ($params)) {
        return NULL;
      }

    $query = "
      SELECT *
      FROM ". DBP ."customModuleItem AS c
      WHERE 1 = 1
    ";

    $queryParams = array ();

    if (array_key_exists ('customModuleItemId', $params)) {
      $query .= "
        AND c.customModuleItemId = :customModuleItemId
      ";
      $queryParams[':customModuleItemId'] = array (intval ($params['customModuleItemId']), PDO::PARAM_INT);
    }


      if (array_key_exists ('customModuleItemSizeId', $params) && is_numeric ($params['customModuleItemSizeId'])) {
        $query .= "
          AND `customModuleItemSizeId` = :customModuleItemSizeId
         ";
        $queryParams['customModuleItemSizeId'] = array ($params['customModuleItemSizeId'], PDO::PARAM_INT);
      }

    if (array_key_exists ('customModuleId', $params) && is_numeric ($params['customModuleId'])) {
      $query .= "
        AND `customModuleId` = :customModuleId
       ";
      $queryParams['customModuleId'] = array ($params['customModuleId'], PDO::PARAM_INT);
    }

    try {
      $results = $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
    }
    catch (Exception $e) {
      $message = 'An error occurred while fetching custom module item record';
      throw new Exception ($message . $e->getMessage());
    }

    if (!$results || empty ($results)) {
      return NULL;
    }

    $customModuleItemSizeRepository = new CustomModuleItemSizeRepository ();
    $customModuleItemSize = $customModuleItemSizeRepository->getCustomModuleItemSize (array ('customModuleItemSizeId' => $results[0]['customModuleItemSizeId']));
    $results[0]['customModuleItemSize'] = $customModuleItemSize;

    $customModuleRepository = new CustomModuleRepository ();
    $customModule = $customModuleRepository->getCustomModule (array ('customModuleId' => $results[0]['customModuleId']));
    $results[0]['customModule'] = $customModule;

    $customModuleItem = Factory::getCustomModuleItem ($results[0]);

    $customModuleImageRepository = new CustomModuleImageRepository ();
    $customModuleItemImage = $customModuleImageRepository->getCustomModuleImage (array ('customModuleItemId' => $customModuleItem->getId (), 'relationName' => 'customModuleItemImage'));
    $customModuleItem->setCustomModuleImage ($customModuleItemImage);

    $customModuleTextRepository = new CustomModuleTextRepository ();
    $customModuleText = $customModuleTextRepository->getCustomModuleText (array ('customModuleItemId' => $customModuleItem->getId (), 'relationName' => 'customModuleItemText'));
    $customModuleItem->setCustomModuleText ($customModuleText);

    return $customModuleItem;
  }

  /**
   * Method returns a count of CustomModuleItem records in the database.
   * @param array $params An array of parameters for query generation.
   * @return integer A count of CustomModuleItem records in the database.
   */
  public function getCustomModuleItemCount ($params = array ()) {

    $query = "
      SELECT COUNT(customModuleItemId) AS customModuleItemCount
      FROM ". DBP ."customModuleItem AS c
      WHERE 1 = 1
    ";
    $queryParams = array ();
    // Handle filter parameters
    if (isset ($params['filterParams']) && is_array ($params['filterParams'])
      && isset ($params['filterParams']['inSearch']) && is_array ($params['filterParams']['inSearch'])) {
      foreach ($params['filterParams']['inSearch'] as $attrName) {
        if (in_array ($attrName, array ('class'))) {
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


      if (array_key_exists ('customModuleItemSizeId', $params) && is_numeric ($params['customModuleItemSizeId'])) {
        $query .= "
          AND `customModuleItemSizeId` = :customModuleItemSizeId
         ";
        $queryParams['customModuleItemSizeId'] = array ($params['customModuleItemSizeId'], PDO::PARAM_INT);
      }

    if (array_key_exists ('customModuleId', $params) && is_numeric ($params['customModuleId'])) {
      $query .= "
        AND `customModuleId` = :customModuleId
       ";
      $queryParams['customModuleId'] = array ($params['customModuleId'], PDO::PARAM_INT);
    }

    }

    try {
      $results = $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
    }
    catch (Exception $e) {
      $message = 'An error occurred while fething a count of custom module item records';
      throw new Exception ($message . $e->getMessage());
    }

    return intval ($results[0]['customModuleItemCount']);
  }
  /**
   * Method returns an array of CustomModuleItem objects.
   * @param array $params An array of parameters for query generation.
   * @return array An array of CustomModuleItem objects.
   */
  public function getCustomModuleItems ($params = array ()) {

    $query = "
      SELECT c.*,
             s.name AS `customModuleItemSize.name`,
             s.key AS `customModuleItemSize.key`,
             i.customModuleImageId AS `customModuleImage.customModuleImageId`,
             i.title AS `customModuleImage.title`,
             ii.filename AS `customModuleImageImage.filename`,
             ii.width AS `customModuleImageImage.width`,
             ii.height AS `customModuleImageImage.height`,
             t.customModuleTextId AS `customModuleText.customModuleTextId`,
             t.content AS `customModuleText.content`,
             t.footnote AS `customModuleText.footnote`
      FROM ". DBP ."customModuleItem AS c
      JOIN ". DBP ."customModuleItemSize AS s
        ON c.customModuleItemSizeId = s.customModuleItemSizeId
      LEFT JOIN ". DBP ."customModuleImage AS i
        ON c.customModuleItemId = i.customModuleItemId
      LEFT JOIN ". DBP ."customModuleImageImage AS ii
        ON i.customModuleImageId = ii.customModuleImageId
      LEFT JOIN ". DBP ."customModuleText AS t
        ON c.customModuleItemId = t.customModuleItemId
      WHERE 1 = 1
    ";
    $queryParams = array ();
    // Handle filter parameters
    if (isset ($params['filterParams']) && is_array ($params['filterParams'])
      && isset ($params['filterParams']['inSearch']) && is_array ($params['filterParams']['inSearch'])) {
      foreach ($params['filterParams']['inSearch'] as $attrName) {
        if (in_array ($attrName, array ('class'))) {
          if (in_array ($attrName, array ())) {
            $query .= "
              AND c.$attrName = :$attrName
            ";
            $queryParams[":$attrName"] = isset ($params['filterParams'][$attrName]) ? '1' : '0';
          }
          elseif (isset ($params['filterParams'][$attrName])) {
            $query .= "
              AND c.$attrName LIKE :$attrName
            ";
            $queryParams[":$attrName"] = '%'. $params['filterParams'][$attrName] .'%';
          }
        }
      }
    }
    // Handle parameters
    if (array_key_exists ('customModuleItemSizeId', $params) && is_numeric ($params['customModuleItemSizeId'])) {
      $query .= "
        AND `customModuleItemSizeId` = :customModuleItemSizeId
       ";
      $queryParams['customModuleItemSizeId'] = array ($params['customModuleItemSizeId'], PDO::PARAM_INT);
    }
    if (array_key_exists ('customModuleId', $params) && is_numeric ($params['customModuleId'])) {
      $query .= "
        AND `customModuleId` = :customModuleId
       ";
      $queryParams['customModuleId'] = array ($params['customModuleId'], PDO::PARAM_INT);
    }

    if (!isset ($params['orderBy'])) {
      $params['orderBy'] = 'position';
      $params['orderDirection'] = 'asc';
    };
		$query .= $this->_getOrderAndLimit ($params);

    try {
      $results = $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
    }
    catch (Exception $e) {
      $message = 'An error occurred while fetching custom module item records';
      throw new Exception ($message . $e->getMessage());
    }

    foreach ($results as &$result) {
      $sizeArray = array (
        'name' => $result['customModuleItemSize.name'],
        'key' => $result['customModuleItemSize.key']
      );
      $result['customModuleItemSize'] = Factory::getCustomModuleItemSize ($sizeArray);

      if ($result['customModuleImage.customModuleImageId']) {
        $imageFileArray = array (
          'filename' => $result['customModuleImageImage.filename'],
          'width' => $result['customModuleImageImage.width'],
          'height' => $result['customModuleImageImage.height']
        );
        $imageFile = Factory::getCustomModuleImageImage ($imageFileArray);

        $imageArray = array (
          'title' => $result['customModuleImage.title'],
          'image' => $imageFile
        );
        $result['customModuleImage'] = Factory::getCustomModuleImage ($imageArray);
      }

      if ($result['customModuleText.customModuleTextId']) {
        $textArray = array (
          'content' => $result['customModuleText.content'],
          'footnote' => $result['customModuleText.footnote']
        );
        $result['customModuleText'] = Factory::getCustomModuleText ($textArray);
      }

      if (isset ($params['customModule'])) {
        $customModuleRepository = new CustomModuleRepository ();
        $customModule = $customModuleRepository->getCustomModule (array ('customModuleId' => $result['customModuleId']));
        $result['customModule'] = $customModule;
      }
    }

    return Factory::getCustomModuleItems ($results);
  }

  /**
   * Method inserts a new customModuleItem into the database.
   * @param array $data Data for the new customModuleItem.
   * @return integer customModuleItemId of the newly inserted customModuleItem.
   */
  public function addCustomModuleItem ($data) {
    if (empty ($data) || !$this->_validateCustomModuleItemData ($data)) {
      throw new Exception ('Custom Module Item did not pass validation.', 10);
    }

    try {
      $this->startTransaction ();

      // Get max position value
      $query = "
        SELECT MAX(position) as maxPosition
        FROM " . DBP . "customModuleItem
      ";
      $queryParams = array ();
      $maxPosition = NULL;
      $results = $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
      $maxPosition = $results[0]['maxPosition'];

      $query = "
        INSERT INTO " . DBP . "customModuleItem
        SET `customModuleItemSizeId` = :customModuleItemSizeId,
            `customModuleId` = :customModuleId,
            `class` = :class,
            `created` = NOW(),
            `modified` = NOW(),
            `position` = :position
      ";
      $queryParams = array (
        ':customModuleItemSizeId' => array ($data['customModuleItemSizeId'], PDO::PARAM_INT),
        ':customModuleId' => array ($data['customModuleId'], PDO::PARAM_INT),
        ':class' => empty ($data['class']) ? NULL : Tools::stripTags (trim ($data['class'])),
        ':position' => array (isset ($data['position']) ? $data['position'] : $maxPosition + 1, PDO::PARAM_INT)
      );
      $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
      $customModuleItemId = $this->lastInsertId ();

      $this->commit ();
    }
    catch (Exception $e) {
      $this->rollback ();
      $message = 'An error occurred while adding custom module item record';
      throw new Exception ($message . $e->getMessage());
    }
    return $this->getCustomModuleItem (array ('customModuleItemId' => $customModuleItemId));
  }

  /**
   * Method edits an existing customModuleItem database record.
   * @param array $data New data for the customModuleItem.
   * @return bool Success flag; TRUE if editing was successful, FALSE if not.
   */
  public function editCustomModuleItem ($customModuleItemId, $data) {
    if (empty ($data) || !$this->_validateCustomModuleItemData ($data)) {
      throw new Exception ('Invalid data.', 10);
    }
    try {
      $this->startTransaction ();
      $query = "
        UPDATE " . DBP . "customModuleItem
        SET `customModuleItemSizeId` = :customModuleItemSizeId,
            `class` = :class,
            `position` = ". (isset ($data['position']) ? ':position' : '`position`') .",
            `modified` = NOW(),
            modified = NOW()
        WHERE `customModuleItemId` = :customModuleItemId
      ";
      $queryParams = array (
        ':customModuleItemSizeId' => array ($data['customModuleItemSizeId'], PDO::PARAM_INT),
        ':class' => empty ($data['class']) ? NULL : Tools::stripTags (trim ($data['class'])),
        ':customModuleItemId' => array ($customModuleItemId, PDO::PARAM_INT),
      );
      if (isset ($data['position'])) {
        $queryParams[':position'] = array ($data['position'], PDO::PARAM_INT);
      }
      $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
      $this->commit ();
    }
    catch (Exception $e) {
      $this->rollback ();
      $message = 'An error occurred while updating custom module item record';
      throw new Exception ($message . $e->getMessage());
    }

    return TRUE;
  }

  /**
   * Method deletes an existing customModuleItem database record.
   * @param integer $customModuleItemId customModuleItem database ID.
   * @return bool Success flag; TRUE if deleting was successful, FALSE if not.
   */
  public function deleteCustomModuleItem ($customModuleItemId) {
    try {
      $this->startTransaction ();
      $customModuleItem = $this->getCustomModuleItem (
        array ('customModuleItemId' => $customModuleItemId)
      );
      if (is_null ($customModuleItem)) {
        throw new Exception ("Trying to delete non-existing customModuleItem");
      }

      // Delete record
      $query = "
        DELETE FROM " . DBP . "customModuleItem
        WHERE `customModuleItemId` = :customModuleItemId
      ";
      $queryParams = array (
        ':customModuleItemId' => array ($customModuleItemId, PDO::PARAM_INT)
      );
      $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);

      // Update position for remaining records
      $query = "
        UPDATE " . DBP . "customModuleItem
          SET position = position - 1
          WHERE position > :position
      ";
      $queryParams = array (
        ':position' => $customModuleItem->getPosition ()
      );
      $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);

      $this->commit ();

      return TRUE;
     }
      catch (Exception $e) {
        $this->rollback ();
        $message = 'An error occurred while deleting custom module item record';
        throw new Exception ($message . $e->getMessage());
      }
  }


  private function _validateCustomModuleItemData ($input) {
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
  public function moveCustomModuleItem ($customModuleId, $customModuleItemId, $direction) {
    return $this->_moveEntry (
      array (
        'attributeName' => 'position',
        'tableName' => 'customModuleItem',
        'direction' => $direction,
        'entryAttributeName' => 'customModuleItemId',
        'entryId' => $customModuleItemId,
        'parentAttributeName' => 'customModuleId',
        'parentId' => $customModuleId
      )
    );
  }

}
?>