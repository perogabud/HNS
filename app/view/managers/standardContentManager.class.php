<?php

class StandardContentManager extends ContentManager {

  public function route () {

    $this->_setTemplate ('default');

    // Varijabla $mightyVar je dostupna u svim templateima i elementima
    $this->_setData (array ('mightyVar' => 'test'));

    // Parse parameters
    switch ($this->params[0]) {
      /*
       * Home page.
       */
      case '':
        if ($this->_checkParams (1)) {
          $this->_setElements (
            array (
              'mainContent' => array (
                'filename' => 'page',
                'data' => array (
                  'varName' => array (1, 2, 3) // U elementu pristupaš ovome kao $varName.
                )
              )
            )
          );
          $this->_setHtmlHead (array ('pageTitle' => 'Naslovnica'));
          break;
        }

      /*
       * Some page.
       */
      case 'some-page':
        if ($this->_checkParams (1)) {
          $this->_setElements (
            array (
              'mainContent' => array (
                'filename' => 'page',
                'data' => array (
                  'varName' => array (1, 2, 3) // U elementu pristupaš ovome kao $varName.
                )
              )
            )
          );
          $this->_setHtmlHead (array ('pageTitle' => 'Stranica'));
          break;
        }

      default:
        // TEMP
        $this->set404 ();
    }
  }

  private function _setHtmlHead (array $params = array ()) {
    if (empty ($params) || isset ($params['page'])) {
      $page = NULL;
      if (!isset ($params['page'])) {
        $pageController = PageController::getInstance ();
        $page = $pageController->getPage (array ('uri' => $this->params));
      }
      else {
        $page = $params['page'];
      }
      if ($page) {
        $params = array (
          'pageTitle' => $page->MetaTitle ? $page->MetaTitle : $page->NavigationName,
          'metaDescription' => $page->MetaDescription ? $page->MetaDescription : Tools::stripTags (Tools::cutContent ($page->Content, 500))
        );
      }
    }
    $this->_setData (
      array (
        'pageTitle' => 'HNS ' . (isset ($params['pageTitle']) && $params['pageTitle'] ? ' :: ' . $params['pageTitle'] . '' : ''),
        'metaDescription' => isset ($params['metaDescription']) ? $params['metaDescription'] : '',
        'metaKeywords' => isset ($params['metaKeywords']) ? $params['metaKeywords'] : ''
      )
    );
  }

  protected function set404 () {
    $this->_setHtmlHead (
      array (
        'pageTitle' => '404',
        'metaDescription' => 'Stranica nije pronađena'
      )
    );
    parent::set404 ();
  }

}

?>
