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
        'navigation' => array (
          'data' => array (
            'navPages' => $pageController->getNavigation ()
          )
        )
      )
    );

    $this->_setData (array ('activePage' => $pageController->getPage (array ('uri' => array ($this->params[0])))));

    $userController = UserController::getInstance ();
    $loggedUser = $userController->getLoggedUser ();
    /*if (!$loggedUser && !in_array ($this->params[0], array ('login', ''))) {
      Tools::redirect (Config::read ('siteUrlRoot') . 'admin/login');
    }*/

    // Parse parameters
    switch ($this->params[0]) {
      /*
       * Home page.
       */
      case '':
        Tools::redirect ('/index.html');
        break;

      case 'magazine':
          $this->_setElements (
            array (
              'mainContent' => array (
                'filename' => 'mag',
                'data' => array (
                )
              )
            )
          );
          $this->_setHtmlHead (
            array (
              'pageTitle' => 'HNS Časopis'
            )
          );
        break;

      case 'home':
        if ($this->_checkParams (1)) {
          $this->_setTemplate ('home');
			    $this->_setElements (
			      array (
			        'scripts' => array (
			          'filename' => 'homeScripts'
			        )
			      )
			    );
          $newsItemController = NewsItemController::getInstance ();
          $actualityController = ActualityController::getInstance ();
          $memberController = MemberController::getInstance ();
          $galleryController = GalleryController::getInstance ();
          $videoController = VideoController::getInstance();

          $this->_setData (
            array (
              'newsItems' => $newsItemController->getNewsItemsByParams (
                array (
                  'orderBy' => 'publishDate',
                  'orderDirection' => 'DESC',
                  'limit' => 10,
                  'languageId' => Config::read ('lang'),
                  'isFeatured' => 1
                )
              ),
              'actualitys' => $actualityController->getActualitysByParams (
                array (
                  'orderBy' => 'publishDate',
                  'orderDirection' => 'DESC',
                  'limit' => 3,
                  'languageId' => Config::read ('lang')
                )
              ),
              'members' => $memberController->getMembersByParams (
                array (
                  'orderBy' => 'lastName',
                  'orderDirection' => 'ASC',
                  'limit' => 20,
                  'team' => TRUE
                )
              ),
              'galleries' => $galleryController->getGallerysByParams (
                array (
                  'orderBy' => 'created',
                  'orderDirection' => 'DESC',
                  'limit' => 3
                )
              ),
              'featuredVideo' => $videoController->getLastVideo()
            )
          );
          $this->_setHtmlHead (array ('pageTitle' => 'Naslovnica'));
          break;
        }

      /*
       * Selections.
       */
      case Dict::read ('slug_selections'):
        if (count ($this->params) > 1) {
          switch ($this->params[1]) {
            /*
            * Representation / Team.
            */
            case Dict::read ('slug_ARepresentation'):
              if ($this->_checkParams (2, TRUE)) {
                $teamController = TeamController::getInstance ();
                $team = $teamController->getTeamBySlug ($this->params[1]);
                if ($team) {
                  $this->_setElements (
                    array (
                      'mainContent' => array (
                        'filename' => 'team',
                        'data' => array (
                          'team' => $team
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
                else {
                  $this->set404 ();
                }
                return;
              }
              /*
               * Team Member.
               */
              elseif ($this->_checkParams (3, TRUE)) {
                $memberController = MemberController::getInstance ();
                $member = $memberController->getMemberBySlug ($this->params[2]);
                FB::warn ('here');
                if ($member) {
                  $this->_setElements (
                    array (
                      'mainContent' => array (
                        'filename' => 'member',
                        'data' => array (
                          'member' => $member
                        )
                      )
                    )
                  );
                  $this->_setHtmlHead (
                    array (
                      'pageTitle' => $member->getName ()
                    )
                  );
                  return;
                }
                else {
                  $this->set404 ();
                }
              }

          }
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
                $newsItems = $newsItemController->getNewsItemsByParams (
                  array (
                    'orderBy' => 'publishDate',
                    'orderDirection' => 'DESC',
                    'limit' => 10,
                    'languageId' => Config::read ('lang')
                  )
                );
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

            /*
             * Actualities.
             */
            case Dict::read ('slug_actualities'):
              /*
               * Actualities Listing.
               */
              if ($this->_checkParams (2, TRUE)) {
                $actualityController = ActualityController::getInstance ();
                $actualitys = $actualityController->getActualitysByParams (
                  array (
                    'orderBy' => 'publishDate',
                    'orderDirection' => 'DESC',
                    'limit' => 10,
                    'languageId' => Config::read ('lang')
                  )
                );
                if ($actualitys) {
                  $this->_setElements (
                    array (
                      'mainContent' => array (
                        'filename' => 'actualities',
                        'data' => array (
                          'actualitys' => $actualitys
                        )
                      )
                    )
                  );
                  $this->_setHtmlHead (
                    array (
                      'pageTitle' => Dict::read ('title_actualities')
                    )
                  );
                }
                return;
              }
              elseif ($this->_checkParams (3, TRUE)) {
                $actualityController = ActualityController::getInstance ();
                $actuality = $actualityController->getActualityBySlug ($this->params[2]);
                FB::warn ('here');
                if ($actuality) {
                  $this->_setElements (
                    array (
                      'mainContent' => array (
                        'filename' => 'actuality',
                        'data' => array (
                          'actuality' => $actuality
                        )
                      )
                    )
                  );
                  $this->_setHtmlHead (
                    array (
                      'pageTitle' => Dict::read ('title_news') . ' :: ' . $actuality->getTitle ()
                    )
                  );
                  return;
                }
              }

            /*
             * Galleries.
             */
            case Dict::read ('slug_galleries'):
              /*
               * Galleries Listing.
               */
              if ($this->_checkParams (2, TRUE)) {
                $galleryController = GalleryController::getInstance ();
                $gallerys = $galleryController->getGallerysByParams (
                  array (
                    'orderBy' => 'created',
                    'orderDirection' => 'DESC',
                    'limit' => 10
                  )
                );
                if ($gallerys) {
                  $this->_setElements (
                    array (
                      'mainContent' => array (
                        'filename' => 'galleries',
                        'data' => array (
                          'gallerys' => $gallerys
                        )
                      )
                    )
                  );
                  $this->_setHtmlHead (
                    array (
                      'pageTitle' => Dict::read ('title_galleries')
                    )
                  );
                }
                return;
              }
              elseif ($this->_checkParams (3, TRUE)) {
                $galleryController = GalleryController::getInstance ();
                $gallery = $galleryController->getGalleryBySlug ($this->params[2]);
                $gallerys = $galleryController->getGallerysByParams (
                  array (
                    'orderBy' => 'created',
                    'orderDirection' => 'DESC',
                    'limit' => 10
                  )
                );
                FB::warn ('here');
                if ($gallery) {
                  $this->_setElements (
                    array (
                      'mainContent' => array (
                        'filename' => 'galleries',
                        'data' => array (
                          'gallery' => $gallery,
                          'gallerys' => $gallerys,
                        )
                      )
                    )
                  );
                  $this->_setHtmlHead (
                    array (
                      'pageTitle' => Dict::read ('title_news') . ' :: ' . $gallery->getTitle ()
                    )
                  );
                  return;
                }
              }

              /*
             * Videos.
             */
            case Dict::read ('slug_videos'):
              /*
               * Video Listing.
               */
              if ($this->_checkParams (2, TRUE)) {
                $videoController = VideoController::getInstance ();
                $videos = $videoController->getVideosByParams (
                  array (
                    'orderBy' => 'publishDate',
                    'orderDirection' => 'DESC',
                    'limit' => 10,
                    'isPublished' => TRUE
                  )
                );
                if ($videos) {
                  $this->_setElements (
                    array (
                      'mainContent' => array (
                        'filename' => 'videoGalleries',
                        'data' => array (
                          'videos' => $videos
                        )
                      )
                    )
                  );
                  $this->_setHtmlHead (
                    array (
                      'pageTitle' => Dict::read ('title_videoGalleries')
                    )
                  );
                }
                return;
              }
              elseif ($this->_checkParams (3, TRUE)) {
                $videoController = VideoController::getInstance ();
                $video = $videoController->getVideoBySlug ($this->params[2]);
                $videos = $videoController->getVideosByParams (
                  array (
                    'orderBy' => 'publishDate',
                    'orderDirection' => 'DESC',
                    'limit' => 10,
                    'isPublished' => TRUE
                  )
                );

                if ($video) {
                  $this->_setElements (
                    array (
                      'mainContent' => array (
                        'filename' => 'videoGalleries',
                        'data' => array (
                          'video' => $video,
                          'videos' => $videos,
                        )
                      )
                    )
                  );
                  $this->_setHtmlHead (
                    array (
                      'pageTitle' => Dict::read ('title_news') . ' :: ' . $video->getTitle ()
                    )
                  );
                  return;
                }
              } /* --- */
          }
        }

      default:
        $pageController = PageController::getInstance ();
        $page = $pageController->getPage (array ('uri' => $this->params));
        if ($page) {
        	$this->_setData(
						array('sideNavPages' => $pageController->getSubpages (array ($this->params[0]), 3))
        	);
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
