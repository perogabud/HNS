<?php

class StandardContentManager extends ContentManager {

  public function route () {

    $this->_setTemplate ('default');

    // Varijabla $mightyVar je dostupna u svim templateima i elementima
    $this->_setData (array ('mightyVar' => 'test'));

    $this->_setElements (
      array (
        'scripts' => array (
          'filename' => 'defaultScripts'
        )
      )
    );

    $pageController = PageController::getInstance ();
    $this->_setElements (
      array (
        'header' => array (
          'data' => array (
            'navPages' => $pageController->getNavigation ()
          )
        )
      )
    );

    // Parse parameters
    switch ($this->params[0]) {
      /*
       * Home page.
       */
      case '':
        if ($this->_checkParams (1)) {
          $this->_setTemplate ('home');
          $newsItemController = NewsItemController::getInstance ();
          $this->_setData (
            array (
              'newsItems' => $newsItemController->getNewsItems ('publishDate', 'DESC', 1, 10)
            )
          );
          $this->_setHtmlHead (array ('pageTitle' => 'Naslovnica'));
          break;
        }

      /*
       * Info Center.
       */
      case Dict::read ('slug_infoCenter'):
        if (count ($this->params) > 1) {
          switch ($this->params[1]) {
            /*
             * News.
             */
            case Dict::read ('slug_news'):
              /*
               * News Listing.
               */
              if ($this->_checkParams (2, TRUE)) {
                $newsItemController = NewsItemController::getInstance ();
                $newsItems = $newsItemController->getNewsItems ('publishDate', 'DESC', 1, 10);
                if ($newsItems) {
                  $this->_setElements (
                    array (
                      'mainContent' => array (
                        'filename' => 'newsItems',
                        'data' => array (
                          'newsItems' => $newsItems
                        )
                      )
                    )
                  );
                  $this->_setHtmlHead (
                    array (
                      'pageTitle' => Dict::read ('title_news')
                    )
                  );
                }
                return;
              }
              elseif ($this->_checkParams (3, TRUE)) {
                switch ($this->params[1]) {
                  /*
                   * Single News Item.
                   */
                  case Dict::read ('slug_news'):
                    $newsItemController = NewsItemController::getInstance ();
                    $newsItem = $newsItemController->getNewsItemBySlug ($this->params[2]);
                    FB::warn ('here');
                    if ($newsItem) {
                      $this->_setElements (
                        array (
                          'mainContent' => array (
                            'filename' => 'newsItem',
                            'data' => array (
                              'newsItem' => $newsItem
                            )
                          )
                        )
                      );
                      $this->_setHtmlHead (
                        array (
                          'pageTitle' => Dict::read ('title_news') . ' :: ' . $newsItem->getTitle ()
                        )
                      );
                      return;
                    }
                }
              }
          }
        }

      default:
        $pageController = PageController::getInstance ();
        $page = $pageController->getPage (array ('uri' => $this->params));
        if ($page) {
          $this->_setElements (
            array (
              'mainContent' => array (
                'filename' => 'page',
                'data' => array (
                  'page' => $page
                )
              )
            )
          );
          $this->_setHtmlHead (
            array (
              'page' => $page
            )
          );
        }
        else {
          $this->set404 ();
        }
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
