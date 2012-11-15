<?php
class PageRepository extends Repository {

  public function __construct () {
    parent::__construct ();
  }

  public function getNavigation () {
    return $this->getSubPages (NULL, 2, NULL,
      array (
        'isVisible' => TRUE,
        'fields' => array (
          'pageId', 'lft', 'rgt', 'languageId', 'depth', 'fullUri', 'navigationName', 'slug', 'navigationDescription'
        )
      )
    );
  }

  /**
   * Method returns a single PageCoverImage object.
   * @param integer $pageId Page ID.
   * @return PageCoverImage The requested Page object or NULL if none found.
   */
  public function getCoverImage ($pageId) {
    $query = "
      SELECT *
      FROM ". DBP ."pageCoverImage
      WHERE `pageId` = :pageId
    ";

    $queryParams = array (
      ':pageId' => array ($pageId, PDO::PARAM_INT)
    );

    try {
      $results = $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
      return !empty ($results) ? Factory::getPageCoverImage ($results[0]) : NULL;
    }
    catch (Exception $e) {
      $message = 'An error occurred while fetching page record';
      throw new Exception ($message . ': ' . $e->getMessage(), 1, $e);
    }
  }

  /**
   * Method returns a count of Page records in the database.
   * @param array $params An array of parameters for query generation.
   * @return integer A count of Page records in the database.
   */
  public function getPageCount ($params = array ()) {

    $query = "
      SELECT COUNT(pageId) AS pageCount
      FROM ". DBP ."vw_page AS p
      WHERE languageId = :languageId
    ";
    $queryParams = array (
      ':languageId' => Config::read ('lang')
    );
    // Handle filter parameters
    if (isset ($params['filterParams']) && is_array ($params['filterParams'])
      && isset ($params['filterParams']['inSearch']) && is_array ($params['filterParams']['inSearch'])) {
      foreach ($params['filterParams']['inSearch'] as $attrName) {
        if (in_array ($attrName, array ('title', 'navigationName', 'content', 'lead', 'metaTitle', 'metaDescription', 'metaKeywords', 'isException', 'isVisible', 'isEditable', 'isPublished', 'canAddChildren', 'canBeDeleted', 'class', 'navigationDescription'))) {
          if (in_array ($attrName, array ('isException', 'isVisible', 'isEditable', 'isPublished', 'canAddChildren', 'canBeDeleted'))) {
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
      $message = 'An error occurred while fething a count of page records';
      throw new Exception ($message . ': ' . $e->getMessage(), 2, $e);
    }

    return intval ($results[0]['pageCount']);
  }
  public function getSubPages ($uri = NULL, $depth = NULL, $page = NULL, $params = array ()) {
    $fields = '*';
    if (isset ($params['fields']) && is_array ($params['fields'])) {
      $fields = implode (', ', $params['fields']);
    }
    $query = "
      SELECT $fields
      FROM " . DBP . "vw_pageTree AS pageTree
      WHERE depth > 0
        AND languageId = :lang
        AND isPublished = '1'
    ";
    $queryParams[':lang'] = LANG;
    if (!is_null ($depth)) {
      $query .= "
        AND depth <= :depth
      ";
      $queryParams[':depth'] = array ($depth, PDO::PARAM_INT);
    }
    if (!is_null ($uri)) {
      if (is_null ($page)) {
        $page = $this->getPage (array ('uri' => $uri));
      }
      $query .= "
        AND lft >= :lft
        AND rgt <= :rgt
      ";
      $queryParams[':lft'] = array ($page->Lft, PDO::PARAM_INT);
      $queryParams[':rgt'] = array ($page->Rgt, PDO::PARAM_INT);
    }

    if (isset ($params['isVisible']) && $params['isVisible']) {
      $query .= "
        AND isVisible = 1
      ";
    }

    $results = $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
    foreach ($results as &$result) {

    }
    return $this->buildPageTree ($results, $depth);
  }

  /**
   * Returns a single Page object.
   * @param <array> $uniqueUris URL parameters, unique_uris
   * @return <Page> Requeste page object, or NULL if it doesn't exist
   */
  public function getPage ($params = array ()) {
    $query = "
      SELECT *
      FROM " . DBP . "vw_pageTree AS pageTree
      WHERE 1 = 1
    ";
    $queryParams = array ();
    if (isset ($params['uri']) && is_array ($params['uri'])) {
      $query = "
        SELECT pageTree.pageId
        FROM " . DBP . "vw_pageTree AS pageTree
        WHERE fullUri = :fullUri
          AND languageId = :lang
        LIMIT 1
      ";
      $queryParams = array (
        ':fullUri' => is_array ($params['uri']) ? '/' . implode ('/', $params['uri']) : $params['uri'],
        ':lang' => isset ($params['lang']) ? $params['lang'] : LANG
      );
      $results = $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
      if (!$results) {
        return NULL;
      }
      $pageId = $results[0]['pageId'];
      $query = "
        SELECT pageTree.*
        FROM " . DBP . "vw_pageTree AS pageTree
        WHERE pageId = :pageId
      ";
      $queryParams = array (
        ':pageId' => array ($pageId, PDO::PARAM_INT)
      );
    }

    if (array_key_exists ('pageId', $params)) {
      $query .= "
        AND pageId = :pageId
      ";
      $queryParams = array (
        ':pageId' => $params['pageId']
      );
    }

    $results = $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);

    if (!$results || empty ($results)) {
      return NULL;
    }
    else {

      $coverImage = $this->getCoverImage ($results[0]['pageId']);
      $results[0]['coverImage'] = $coverImage;

      $page = Factory::getPage ($results);

      return $page;
    }
  }

    /**
   * DO NOT EDIT
   *
   * Creates a hierarhical page tree.
   * @return <array> Array of Page objects representing the page tree
   */
  public function getPageTree () {
    $query = "SELECT * FROM " . DBP . "vw_pageTree AS pageTree WHERE languageId = :lang";
    $queryParams = array (
      ':lang' => Config::read ('defaultLang')
    );
    $result = $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
    return $this->buildPageTree ($result);
  }

  /**
   * DO NOT EDIT
   *
   * Recursive function, builds a hierarhical page tree from the given database result.
   * @param mysqli_result $result
   * @param array $pages
   * @param <type> $depth
   * @param <type> $row
   * @return <type>
   */
  private function buildPageTree ($result, $depth = 0, &$i = 0, array &$pages = array (), $row = array (), $recursionCall = FALSE) {
    if (empty ($result)) {
      return NULL;
    }
    if (empty ($row)) {
      $row = $result[$i];
    }
    if (!$recursionCall && isset ($row['depth'])) {
      $depth = $row['depth'];
    }
    if ($row !== NULL) {
      while (true) {
        if ($row['depth'] == $depth) {
          do {
            $pageRows = array ($row);
            $pages[] = Factory::getPage ($pageRows);
            $row = NULL;
            if (isset ($result[++$i])) {
              $row = $result[$i];
            }
          } while ($row !== NULL && intval ($row['depth']) === intval ($depth));
        }
        if ($row !== NULL && intval ($row['depth']) == $depth + 1) {
          $page = $pages[count ($pages) - 1];
          $subpages = array ();
          $row = $this->buildPageTree ($result, intval ($row['depth']), $i, $subpages, $row, TRUE);
          $page->Subpages = $subpages;
          $pages[count ($pages) - 1] = $page;
          if (intval ($row['depth']) != $depth || $row == NULL) {
            break;
          }
        }
        else {
          break;
        }
      }
    }
    if (!$recursionCall) {
      return $pages;
    }
    else {
      return $row;
    }
  }

  /**
   * Add a new page as a child of $parentId.
   * @param <int> $parentId Id of the parent page
   * @return <mixed> FALSE if operation failed or id of new page inf operation successfull
   */
  public function addPage ($parentId, $data = NULL) {
    if (empty ($data) || !$this->_validatePageData ($data, $parentId)) {
      throw new Exception ('Invalid data.', 10);
    }
    try {
      $this->startTransaction ();
      // Find 'rgt' value of last sibling page
      $query = "
        SELECT MAX(rgt) AS rgt
        FROM " . DBP . "page
        WHERE parentId = :parentId
        GROUP BY parentId
      ";
      $queryParams[':parentId'] = array ($parentId, PDO::PARAM_INT);
      $results = $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);

      $num = 0;
      if (count ($results) == 1) {
        $num = $results[0]['rgt'];
      }
      else {
        // If there are no siblings under parent page, fint 'lft' value of parent
        $query = "
          SELECT lft
          FROM " . DBP . "page
          WHERE pageId = " . intval ($parentId) . "
        ";
        $queryParams[':parendId'] = array ($parentId, PDO::PARAM_INT);

        $results = $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
        $num = $results[0]['lft'];
      }

      // Update 'lft' and 'rgt' values of other pages
      $query = "
        UPDATE " . DBP . "page
        SET rgt = rgt + 2
        WHERE rgt > :num
      ";
      $queryParams = array ();
      $queryParams[':num'] = array ($num, PDO::PARAM_INT);
      $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
      $query = "
        UPDATE " . DBP . "page
        SET lft = lft + 2
        WHERE lft > :num
      ";
      $queryParams = array ();
      $queryParams[':num'] = array ($num, PDO::PARAM_INT);
      $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);

      // Insert page row

      $query = "
        INSERT INTO " . DBP . "page
        SET parentId = :parentId,
            lft = :lft,
            rgt = :rgt,
            `isException` = :isException,
            `isVisible` = :isVisible,
            `isEditable` = :isEditable,
            `isPublished` = :isPublished,
            `canAddChildren` = :canAddChildren,
            `canBeDeleted` = :canBeDeleted,
            `class` = :class,
            `created` = NOW(),
            `modified` = NOW()
      ";
      $queryParams = array (
        ':parentId' => array ($parentId, PDO::PARAM_INT),
        ':lft' => array ($num + 1, PDO::PARAM_INT),
        ':rgt' => array ($num + 2, PDO::PARAM_INT),
        ':isException' => Config::read ('debug') ? (isset ($data['isException']) ? '1' : '0') : '',
        ':isVisible' => Config::read ('debug') ? (isset ($data['isVisible']) ? '1' : '0') : '',
        ':isEditable' => Config::read ('debug') ? (isset ($data['isEditable']) ? '1' : '0') : '',
        ':isPublished' => Config::read ('debug') ? (isset ($data['isPublished']) ? '1' : '0') : '',
        ':canAddChildren' => Config::read ('debug') ? (isset ($data['canAddChildren']) ? '1' : '0') : '',
        ':canBeDeleted' => Config::read ('debug') ? (isset ($data['canBeDeleted']) ? '1' : '0') : '',
        ':class' => empty ($data['class']) ? NULL : Tools::stripTags ($data['class'])
      );
      $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);

      $pageId = $this->lastInsertId ();

      foreach (Config::read ('supportedLangs') as $lang) {
        $query = "
          INSERT INTO " . DBP . "pageI18n
          SET `title` = :title,
              `navigationName` = :navigationName,
              `slug` = :slug,
              `content` = :content,
              `lead` = :lead,
              `metaTitle` = :metaTitle,
              `metaDescription` = :metaDescription,
              `metaKeywords` = :metaKeywords,
              `navigationDescription` = :navigationDescription,
              `created` = NOW(),
              `modified` = NOW(),
              `languageId` = :languageId,
              `pageId` = :pageId
        ";
        $queryParams = array (
          ':title' => Tools::stripTags (trim ($data['title_' . $lang]), 'strict'),
          ':navigationName' => Tools::stripTags (trim ($data['navigationName_' . $lang]), 'strict'),
          ':slug' => Tools::formatURI (Tools::stripTags (trim ($data['navigationName_' . $lang]))),
          ':content' => empty ($data['content_' . $lang]) ? NULL : Tools::stripTags (trim ($data['content_' . $lang]), 'loose'),
          ':lead' => empty ($data['lead_' . $lang]) ? NULL : Tools::stripTags (trim ($data['lead_' . $lang]), 'loose'),
          ':metaTitle' => empty ($data['metaTitle_' . $lang]) ? NULL : Tools::stripTags (trim ($data['metaTitle_' . $lang])),
          ':metaDescription' => empty ($data['metaDescription_' . $lang]) ? NULL : Tools::stripTags (trim ($data['metaDescription_' . $lang])),
          ':metaKeywords' => empty ($data['metaKeywords_' . $lang]) ? NULL : Tools::stripTags (trim ($data['metaKeywords_' . $lang])),
          ':navigationDescription' => empty ($data['navigationDescription_' . $lang]) ? NULL : Tools::stripTags (trim ($data['navigationDescription_' . $lang]), 'strict'),
          ':languageId' => $lang,
          ':pageId' => $pageId
        );
        $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
      }

      // Upload coverImage
      $coverImageData = Tools::uploadImages (
        array (
          'name' => 'coverImage',
          'maxCount' => 1,
          'types' => array (
            'coverImage' => array (
              'directory' => Config::read ('pageCoverImagePath'),
              'dimensions' => Config::read ('pageCoverImageDimensions')
            ),
            'largeThumbnail' => array (
              'directory' => Config::read ('pageCoverImageLargeThumbnailPath'),
              'dimensions' => Config::read ('pageCoverImageLargeThumbnailDimensions')
            ),
            'smallThumbnail' => array (
              'directory' => Config::read ('pageCoverImageSmallThumbnailPath'),
              'dimensions' => Config::read ('pageCoverImageSmallThumbnailDimensions')
            ),
          )
        )
      );
      $coverImageData = isset ($coverImageData[0]) ? $coverImageData[0] : NULL;

      if (!is_null ($coverImageData)) {
        $query = "
          INSERT INTO " . DBP . "pageCoverImage
          SET `pageId` = :pageId,
              `filename` = :filename,
              `width` = :width,
              `height` = :height,
              `created` = NOW()
        ";
        $queryParams = array (
          ':pageId' => array ($pageId, PDO::PARAM_INT),
          ':filename' => $coverImageData['filename'],
          ':width' => array ($coverImageData['width'], PDO::PARAM_INT),
          ':height' => array ($coverImageData['height'], PDO::PARAM_INT)
        );
        $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
      }

    }
    catch (Exception $e) {
      $this->rollback ();
      $message = 'An error occurred while adding page record';
      throw new Exception ($message . ': ' . $e->getMessage(), 4, $e);
    }

    $this->commit ();
    return $this->getPage (array ('pageId' => $pageId));
  }

  /**
   * Page edit.
   * @param <int> $pageId Page id
   * @return <bool> Success flag
   */
  public function editPage ($pageId, $data) {
    if (!$this->_validatePageData ($data, NULL, $pageId)) {
      return FALSE;
    }
    else {
      try {
      $this->startTransaction ();
      $page = $this->getPage (array ('id' => $pageId));

      // Upload coverImage
      $coverImageData = Tools::uploadImages (
        array (
          'name' => 'coverImage',
          'maxCount' => 1,
          'types' => array (
            'coverImage' => array (
              'directory' => Config::read ('pageCoverImagePath'),
              'dimensions' => Config::read ('pageCoverImageDimensions')
            ),
            'largeThumbnail' => array (
              'directory' => Config::read ('pageCoverImageLargeThumbnailPath'),
              'dimensions' => Config::read ('pageCoverImageLargeThumbnailDimensions')
            ),
            'smallThumbnail' => array (
              'directory' => Config::read ('pageCoverImageSmallThumbnailPath'),
              'dimensions' => Config::read ('pageCoverImageSmallThumbnailDimensions')
            ),
          )
        )
      );
      $coverImageData = isset ($coverImageData[0]) ? $coverImageData[0] : NULL;
      if (!empty ($coverImageData) || isset ($data['deleteCoverImage'])) {
        $this->_deleteCoverImage ($pageId);
        if (!empty ($coverImageData)) {
          $query = "
            INSERT INTO " . DBP . "pageCoverImage
            SET `pageId` = :pageId,
                `filename` = :filename,
                `width` = :width,
                `height` = :height,
                `created` = NOW()
          ";
          $queryParams = array (
            ':pageId' => array ($pageId, PDO::PARAM_INT),
            ':filename' => $coverImageData['filename'],
            ':width' => array ($coverImageData['width'], PDO::PARAM_INT),
            ':height' => array ($coverImageData['height'], PDO::PARAM_INT)
          );
          $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
        }
      }

      foreach (Config::read ('supportedLangs') as $lang) {

      $query = "
        UPDATE " . DBP . "page
        SET `isException` = " . (Config::read ('debug') ? ':isException' : '`isException`') . ",
            `isVisible` = " . (Config::read ('debug') ? ':isVisible' : '`isVisible`') . ",
            `isEditable` = " . (Config::read ('debug') ? ':isEditable' : '`isEditable`') . ",
            `isPublished` = " . (Config::read ('debug') ? ':isPublished' : '`isPublished`') . ",
            `canAddChildren` = " . (Config::read ('debug') ? ':canAddChildren' : '`canAddChildren`') . ",
            `canBeDeleted` = " . (Config::read ('debug') ? ':canBeDeleted' : '`canBeDeleted`') . ",
            `class` = " . (Config::read ('debug') ? ':class' : '`class`') . ",
            `modified` = NOW()
        WHERE `pageId` = :pageId
      ";
      $queryParams = array (

        ':canAddChildren' => Config::read ('debug') ? (isset ($data['canAddChildren']) ? '1' : '0') : '',
        ':canBeDeleted' => Config::read ('debug') ? (isset ($data['canBeDeleted']) ? '1' : '0') : '',
        ':class' => empty ($data['class']) ? NULL : Tools::stripTags ($data['class']),
        ':pageId' => array ($pageId, PDO::PARAM_INT)
      );
      if (Config::read ('debug')) {
        $queryParams = array_merge (
          $queryParams,
          array (    ':isException' => Config::read ('debug') ? (isset ($data['isException']) ? '1' : '0') : '',
        ':isVisible' => Config::read ('debug') ? (isset ($data['isVisible']) ? '1' : '0') : '',
        ':isEditable' => Config::read ('debug') ? (isset ($data['isEditable']) ? '1' : '0') : '',
        ':isPublished' => Config::read ('debug') ? (isset ($data['isPublished']) ? '1' : '0') : ''
          )
        );
      }

      $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);

      foreach (Config::read ('supportedLangs') as $lang) {
        $query = "
          INSERT INTO " . DBP . "pageI18n
          SET `title` = :title,
              `navigationName` = :navigationName,
              `slug` = :slug,
              `content` = :content,
              `lead` = :lead,
              `metaTitle` = :metaTitle,
              `metaDescription` = :metaDescription,
              `metaKeywords` = :metaKeywords,
              `navigationDescription` = :navigationDescription,
              `modified` = NOW(),
              `pageId` = :pageId,
              `languageId` = :languageId,
              `created` = NOW()
          ON DUPLICATE KEY UPDATE
              `title` = :title,
              `navigationName` = :navigationName,
              `slug` = :slug,
              `content` = :content,
              `lead` = :lead,
              `metaTitle` = :metaTitle,
              `metaDescription` = :metaDescription,
              `metaKeywords` = :metaKeywords,
              `navigationDescription` = :navigationDescription,
              `modified` = NOW()
        ";
        $queryParams = array (
          ':title' => Tools::stripTags (trim ($data['title_' . $lang]), 'strict'),
          ':navigationName' => Tools::stripTags (trim ($data['navigationName_' . $lang]), 'strict'),
          ':slug' => Tools::formatURI (Tools::stripTags (trim ($data['navigationName_' . $lang]))),
          ':content' => empty ($data['content_' . $lang]) ? NULL : Tools::stripTags (trim ($data['content_' . $lang]), 'loose'),
          ':lead' => empty ($data['lead_' . $lang]) ? NULL : Tools::stripTags (trim ($data['lead_' . $lang]), 'loose'),
          ':metaTitle' => empty ($data['metaTitle_' . $lang]) ? NULL : Tools::stripTags (trim ($data['metaTitle_' . $lang])),
          ':metaDescription' => empty ($data['metaDescription_' . $lang]) ? NULL : Tools::stripTags (trim ($data['metaDescription_' . $lang])),
          ':metaKeywords' => empty ($data['metaKeywords_' . $lang]) ? NULL : Tools::stripTags (trim ($data['metaKeywords_' . $lang])),
          ':navigationDescription' => empty ($data['navigationDescription_' . $lang]) ? NULL : Tools::stripTags (trim ($data['navigationDescription_' . $lang]), 'strict'),
          ':pageId' => array ($pageId, PDO::PARAM_INT),
          ':languageId' => $lang
        );
        $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
      }
      }
      $this->commit ();
      return TRUE;
      }
      catch (Exception $e) {
        $this->rollback ();
        $message = 'An error occurred while updating page record';
        throw new Exception ($message . ': ' . $e->getMessage(), 5, $e);
      }
    }
  }

  /**
   * Page delete.
   * @param <int> $pageId Page id
   * @return <bool> Success flag
   */
  public function deletePage ($pageId) {
    $page = $this->getPage (array ('pageId' => $pageId));
    if (!$page->CanBeDeleted || $page->IsException) {
      $_SESSION['message'] = 'Can\'t delete page!';
      return FALSE;
    }
    try {
      $this->startTransaction ();

      $this->_deleteCoverImage ();
      // Get 'lft', 'rgt' and width values from page that will be deleted
      $query = "
        SELECT lft, rgt, (rgt - lft + 1) AS width
        FROM " . DBP . "page
        WHERE pageId = :pageId
      ";
      $queryParams = array (
        ':pageId' => array ($pageId, PDO::PARAM_INT)
      );

      $result = $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
      if (!count ($result)) {
        throw new Exception ('An error occured while deleting page!');
      }
      $rgt = $result[0]['rgt'];
      $lft = $result[0]['lft'];
      $width = $result[0]['width'];

      $query = "
        DELETE FROM " . DBP . "page
        WHERE lft BETWEEN :lft AND :rgt
      ";
      $queryParams = array (
        ':lft' => array ($lft, PDO::PARAM_INT),
        ':rgt' => array ($rgt, PDO::PARAM_INT)
      );

      if (!$this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__)) {
        throw new Exception ('An error occured while deleting page!', 1);
      }
      // Update 'lft' and 'rgt' values of other pages
      $query = "
        UPDATE " . DBP . "page
        SET rgt = rgt - :width
        WHERE rgt > :rgt
      ";
      $queryParams = array (
        ':width' => array ($width, PDO::PARAM_INT),
        ':rgt' => array ($rgt, PDO::PARAM_INT)
      );
      if (!$this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__)) {
        $this->rollback ();
        throw new Exception ('An error occured while deleting page!', 2);
      }
      $query = "
        UPDATE " . DBP . "page
        SET lft = lft - :width
        WHERE lft > :rgt
      ";
      $queryParams = array (
        ':width' => array ($width, PDO::PARAM_INT),
        ':rgt' => array ($rgt, PDO::PARAM_INT)
      );
      if (!$this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__)) {
        $this->rollback ();
        throw new Exception ('An error occured while deleting page!', 3);
      }

      $this->commit ();
    }
    catch (Exception $e) {
      $_SESSION['message'] = $e->getMessage () . 'Error code: ' . $e->getCode ();
      return FALSE;
    }
    return TRUE;
  }

  /**
   * Moves page up or down under it's parent page.
   * @param <int> $pageId Page id
   * @param <string> $direction Direction in which the page will be moved ('up', 'down')
   * @return <bool> Success flag
   */
  public function movePage ($pageId, $direction) {
    try {
      $this->startTransaction ();
      // Get position
      $query = "
        SELECT lft, rgt, parentId
        FROM " . DBP . "page
        WHERE pageId = '" . $this->dbinput ($pageId) . "'
      ";
      $result = $this->query ($query, __FILE__, __LINE__);
      if (!$result) {
        throw new Exception ('An error occured while moving page!', 1);
      }
      $lft = $result[0]['lft'];
      $rgt = $result[0]['rgt'];
      $width = $rgt - $lft;
      $parentId = $result[0]['parentId'];
      // Get max 'lft' and 'rgt'
      $query = "
        SELECT MAX(lft) as max_lft, MAX(rgt) as max_rgt, MIN(lft) as min_lft, MIN(rgt) as min_rgt
        FROM " . DBP . "page
        WHERE parentId = :parentId
        GROUP BY parentId
      ";
      $queryParams = array (
        ':parentId' => array ($parentId, PDO::PARAM_INT)
      );

      $result = $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
      if (!$result) {
        throw new Exception ('An error occured while moving page!', 2);
      }
      $maxLft = $result[0]['max_lft'];
      $maxRgt = $result[0]['max_rgt'];
      $maxWidth = $maxRgt - $maxLft;
      $minLft = $result[0]['min_lft'];
      $minRgt = $result[0]['min_rgt'];
      $minWidth = $minRgt - $minLft;

      // Move page up or down
      switch ($direction) {
        case 'up':
          $newLft = 0;
          $newRgt = 0;
          if ($rgt == $minRgt) {
            // Current page is first, circulate
            /** @todo Cirkularni slučaj riješiti - fuj */
            return TRUE;
          }
          else {
            // Get second page info
            $query = "
              SELECT lft, rgt
              FROM " . DBP . "page
              WHERE parentId = :parentId
                AND rgt = :rgt
            ";
            $queryParams = array (
              ':parentId' => array ($parentId, PDO::PARAM_INT),
              ':rgt' => array ($lft - 1, PDO::PARAM_INT)
            );

            $result = $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
            if (!$result) {
              throw new Exception ('An error occured while moving page!', 2);
            }
            $newLft = $result[0]['lft'];
            $newRgt = $newLft + $width;
            $secondWidth = $result[0]['rgt'] - $result[0]['lft'];
          }
          // Get wanted page children ids
          $query = "
            SELECT pageId
            FROM " . DBP . "page
            WHERE lft >= :lft
              AND rgt <= :rgt
          ";
          $queryParams = array (
            ':lft' => array ($lft, PDO::PARAM_INT),
            ':rgt' => array ($rgt, PDO::PARAM_INT)
          );
          $result = $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
          if (!$result) {
            throw new Exception ('An error occured while moving page!', 2);
          }
          $childIds = array ();
          foreach ($result as $row) {
            $childIds[] = $row['pageId'];
          }
          $childIds = implode (',', $childIds);

          // Get second page children ids
          $query = "
            SELECT pageId
            FROM " . DBP . "page
            WHERE lft >= :lft
              AND rgt <= :rgt
          ";
          $queryParams = array (
            ':lft' => array ($newLft, PDO::PARAM_INT),
            ':rgt' => array ($newLft + $secondWidth, PDO::PARAM_INT)
          );
          $result = $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
          if (!$result) {
            throw new Exception ('An error occured while moving page!', 2);
          }
          $secondChildIds = array ();
          foreach ($result as $row) {
            $secondChildIds[] = $row['pageId'];
          }
          $secondChildIds = implode (',', $secondChildIds);

          // Update children
          $query = "
            UPDATE " . DBP . "page
            SET lft = lft - (:dif),
                rgt = rgt - (:dif)
            WHERE pageId IN (" . $childIds . ")
          ";
          $queryParams = array (
            ':dif' => array ($lft - $newLft, PDO::PARAM_INT)
          );
          if (!$this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__)) {
            throw new Exception ('An error occured while moving page!', 3);
          }

          $query = "
            UPDATE " . DBP . "page
            SET lft = lft + (:dif),
                rgt = rgt + (:dif)
            WHERE pageId IN (" . $secondChildIds . ")
          ";
          $queryParams = array (
            ':dif' => array ($width + 1, PDO::PARAM_INT)
          );
          if (!$this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__)) {
            throw new Exception ('An error occured while moving page!', 3);
          }
          break;

        case 'down':
          $newLft = 0;
          $newRgt = 0;
          if ($rgt == $maxRgt) {
            // Current page is last, circulate
            /** @todo Cirkularni slučaj riješiti */
            return TRUE;
          }
          else {
            // Get second page info
            $query = "
              SELECT lft, rgt
              FROM " . DBP . "page
              WHERE parentId = :parentId
                AND lft = :lft
            ";
            $queryParams = array (
              ':parentId' => array ($parentId, PDO::PARAM_INT),
              ':lft' => array ($rgt + 1, PDO::PARAM_INT)
            );
            $result = $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
            if (!$result) {
              throw new Exception ('An error occured while moving page!', 2);
            }
            $newRgt = $result[0]['rgt'];
            $newLft = $newRgt - $width;
            $secondLft = $result[0]['lft'];
            $secondWidth = $result[0]['rgt'] - $result[0]['lft'];
          }
          // Get wanted page children ids
          $query = "
            SELECT pageId
            FROM " . DBP . "page
            WHERE lft >= :lft
              AND rgt <= :rgt
          ";
          $queryParams = array (
            ':lft' => array ($lft, PDO::PARAM_INT),
            ':rgt' => array ($rgt, PDO::PARAM_INT)
          );
          $result = $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
          if (!$result) {
            throw new Exception ('An error occured while moving page!', 2);
          }
          $childIds = array ();
          foreach ($result as $row) {
            $childIds[] = $row['pageId'];
          }
          $childIds = implode (',', $childIds);

          // Get second page children ids
          $query = "
            SELECT pageId
            FROM " . DBP . "page
            WHERE lft >= :lft
              AND rgt <= :rgt
          ";
          $queryParams = array (
            ':lft' => array ($secondLft, PDO::PARAM_INT),
            ':rgt' => array ($secondLft + $secondWidth, PDO::PARAM_INT)
          );
          $result = $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
          if (!$result) {
            throw new Exception ('An error occured while moving page!', 2);
          }
          $secondChildIds = array ();
          foreach ($result as $row) {
            $secondChildIds[] = $row['pageId'];
          }
          $secondChildIds = implode (',', $secondChildIds);

          // Update children
          $query = "
            UPDATE " . DBP . "page
            SET lft = lft - (:dif),
                rgt = rgt - (:dif)
            WHERE pageId IN (" . $childIds . ")
          ";
          $queryParams = array (
            ':dif' => array ($rgt - $newRgt, PDO::PARAM_INT)
          );
          if (!$this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__)) {
            throw new Exception ('An error occured while moving page!', 3);
          }

          $query = "
            UPDATE " . DBP . "page
            SET lft = lft - (:dif),
                rgt = rgt - (:dif)
            WHERE pageId IN (" . $secondChildIds . ")
          ";
          $queryParams = array (
            ':dif' => array ($width + 1, PDO::PARAM_INT)
          );
          if (!$this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__)) {
            throw new Exception ('An error occured while moving page!', 3);
          }
          break;
      }
    }
    catch (Exception $e) {
      $this->rollback ();
      $_SESSION['message'] = $e->getMessage () . 'Error code: ' . $e->getCode ();
      return FALSE;
    }

    $this->commit ();
    return TRUE;
  }

  private function _validatePageData ($input) {
    if (!$this->checkSetData (
        $input,
        array (),
        array ('title', 'navigationName')
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
            'title' => 'Title cannot be empty.',
            'navigationName' => 'Navigation Name cannot be empty.'
          )
        )
      )
    );
  }

  private function _deleteCoverImage ($pageId) {
    // Delete image files on server
    $page = $this->getPage (array ('pageId' => $pageId));
    if (is_null ($page)) {
      throw new Exception ("Trying to delete coverImage for a non-existant page");
    }
    if ($page->getCoverImage ()) {
      $page->getCoverImage ()->deleteFiles ();

      // Delete coverImage from database
      $query = "
        DELETE FROM " . DBP . "pageCoverImage
        WHERE `pageId` = :pageId
      ";
      $queryParams = array (
        ':pageId' => array ($pageId, PDO::PARAM_INT)
      );
      $this->_preparedQuery ($query, $queryParams, __FILE__, __LINE__);
      }
  }

}
?>