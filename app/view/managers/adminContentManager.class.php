<?php

class AdminContentManager extends ContentManager {

  public function route () {

    // Set common data
    $pageTitle = 'Admin';
    $this->_setData (array ('pageTitle' => $pageTitle));
    $this->_removeFirstParameter ();
    $this->_setData (array ('activeTab' => $this->params[0]));
    $this->_setTemplate ('admin');

    $userController = UserController::getInstance ();
    $loggedUser = $userController->getLoggedUser ();
    if (!$loggedUser && $this->params[0] != 'login') {
      Tools::redirect (Config::read ('siteUrlRoot') . 'admin/login');
    }

    // Parse params
    switch ($this->params[0]) {
      case '':
        Tools::redirect ('/admin/page');
        break;

      case 'login':
        $this->_setTemplate ('login');
        if ($this->_checkParams (1)) {
          if ($userController->login (_P::get('adminUsername'), _P::get('adminPassword'))) {
            Tools::redirect (Config::read ('siteUrlRoot') . 'admin');
          }
        }
        break;

      case 'logout':
        if ($this->_checkParams (1)) {
          $userController->logout ();
          Tools::redirect (Config::read ('siteUrlRoot') . 'admin/login');
        }
        break;

      /*
       * NewsItem.
       */
      case 'newsItem':
        if ($this->_checkParams (1, TRUE)) {
          $newsItemController = NewsItemController::getInstance ();
          $this->_setElements (
            array (
              'mainContent' => array (
                'filename' => 'admin/newsItemTable',
                'data' => array (
                  'newsItems' => $newsItemController->getNewsItems (
                    isset ($_GET['orderBy']) ? $_GET['orderBy'] : NULL,
                    isset ($_GET['orderDirection']) ? $_GET['orderDirection'] : NULL,
                    isset ($_GET['page']) ? $_GET['page'] : NULL,
                    Config::read ('iterationLimit'),
                    isset ($_GET['searchSubmit']) ? $_GET : NULL
                  ),
                  'newsItemCount' => $newsItemController->getNewsItemCount (isset ($_GET['searchSubmit']) ? $_GET : NULL),
                  'languages' => $newsItemController->getLanguages ()
                )
              )
            )
          );
          break;
        }
        elseif ($this->_checkParams (2, TRUE)) {
          switch ($this->params[1]) {
            /*
             * Add newsItem.
             * /newsItem/add/
             */
            case 'add':
              $newsItemController = NewsItemController::getInstance ();
              if (!empty ($_POST)) {
                try {
                  $newsItem = $newsItemController->addNewsItem ($_POST);
                }
                catch (Exception $e) {
                  FB::error ($e);
                  MessageManager::setGlobalMessage ($e->getMessage ());
                }
                if (isset ($newsItem)) {
                  MessageManager::setSuccessMessage ('News Item successfully added!');
                  Tools::redirect (Config::read ('siteUrlRoot') . 'admin/newsItem/view/' . $newsItem->getId ());
                }
              }
              $this->_setElements (
                array (
                  'mainContent' => array (
                    'filename' => 'admin/newsItemAddForm',
                    'data' => array (
                      'languages' => $newsItemController->getLanguages ()
                    )
                  )
                )
              );
              break;
          }
        }
        elseif ($this->_checkParams (3, TRUE)) {
          switch ($this->params[1]) {
            /*
             * View newsItem.
             * /newsItem/view/\{newsItemId\}
             */
            case 'view':
              $newsItemId = $this->params[2];
              $newsItemController = NewsItemController::getInstance ();
              $this->_setElements (
                array (
                  'mainContent' => array (
                    'filename' => 'admin/newsItemView',
                    'data' => array (
                      'newsItem' => $newsItemController->getNewsItemById ($newsItemId)
                    )
                  )
                )
              );
              break;

            /*
             * Edit newsItem.
             * /newsItem/edit/\{newsItemId\}
             */
            case 'edit':
              $newsItemId = $this->params[2];
              $newsItemController = NewsItemController::getInstance ();
              if (!empty ($_POST)) {
                try {
                  if ($newsItemController->editNewsItem ($newsItemId, $_POST)) {
                    MessageManager::setSuccessMessage ('News Item successfully edited!');
                    Tools::redirect (Config::read ('siteUrlRoot') . 'admin/newsItem/view/' . $newsItemId);
                  }
                }
                catch (Exception $e) {
                  FB::error ($e);
                  MessageManager::setGlobalMessage ($e->getMessage ());
                }
              }
              $this->_setElements (
                array (
                  'mainContent' => array (
                    'filename' => 'admin/newsItemEditForm',
                    'data' => array (
                      'newsItem' => $newsItemController->getNewsItemById ($newsItemId),
                      'languages' => $newsItemController->getLanguages ()
                    )
                  )
                )
              );
              break;

            /*
             * Delete newsItem.
             * /newsItem/delete/\{newsItemId\}
             */
            case 'delete':
              $newsItemId = $this->params[2];
              $newsItemController = NewsItemController::getInstance ();
              if (isset ($_POST['submitNo'])) {
                Tools::redirect (Config::read ('siteUrlRoot') . 'admin/newsItem/');
              }
              elseif (isset ($_POST['submitYes'])) {
                try {
                  if ($newsItemController->deleteNewsItem ($newsItemId)) {
                    MessageManager::setSuccessMessage ('News Item successfully deleted!');
                    Tools::redirect (Config::read ('siteUrlRoot') . 'admin/newsItem/');
                  }
                }
                catch (Exception $e) {
                  FB::error ($e);
                  MessageManager::setGlobalMessage ($e->getMessage ());
                }
              }
              else {
                $this->_setElements (
                  array (
                    'mainContent' => array (
                      'filename' => 'admin/newsItemDeleteForm',
                      'data' => array (
                        'newsItem' => $newsItemController->getNewsItemById ($newsItemId)
                      )
                    )
                  )
                );
              }
              break;
          }
        }
        break;

      /*
       * User.
       */
      case 'user':
        if ($this->_checkParams (1, TRUE)) {
          $userController = UserController::getInstance ();
          $this->_setElements (
            array (
              'mainContent' => array (
                'filename' => 'admin/userTable',
                'data' => array (
                  'users' => $userController->getUsers (
                    isset ($_GET['orderBy']) ? $_GET['orderBy'] : NULL,
                    isset ($_GET['orderDirection']) ? $_GET['orderDirection'] : NULL,
                    isset ($_GET['page']) ? $_GET['page'] : NULL,
                    Config::read ('iterationLimit'),
                    isset ($_GET['searchSubmit']) ? $_GET : NULL
                  ),
                  'userCount' => $userController->getUserCount (isset ($_GET['searchSubmit']) ? $_GET : NULL)
                )
              )
            )
          );
          break;
        }
        elseif ($this->_checkParams (2, TRUE)) {
          switch ($this->params[1]) {
            /*
             * Add user.
             * /user/add/
             */
            case 'add':
              if (!empty ($_POST)) {
                $userController = UserController::getInstance ();
                try {
                  $user = $userController->addUser ($_POST);
                }
                catch (Exception $e) {
                  FB::error ($e);
                  MessageManager::setGlobalMessage ($e->getMessage ());
                }
                if (isset ($user)) {
                  MessageManager::setSuccessMessage ('User successfully added!');
                  Tools::redirect (Config::read ('siteUrlRoot') . 'admin/user/view/' . $user->getId ());
                }
              }
              $userRoleController = new UserRoleController ();
              $this->_setElements (
                array (
                  'mainContent' => array (
                    'filename' => 'admin/userAddForm',
                    'data' => array (
                      'userRoles' => $userRoleController->getUserRoles (),
                    )
                  )
                )
              );
              break;
          }
        }
        elseif ($this->_checkParams (3, TRUE)) {
          switch ($this->params[1]) {
            /*
             * View user.
             * /user/view/\{userId\}
             */
            case 'view':
              $userId = $this->params[2];
              $userController = UserController::getInstance ();
              $this->_setElements (
                array (
                  'mainContent' => array (
                    'filename' => 'admin/userView',
                    'data' => array (
                      'user' => $userController->getUserById ($userId)
                    )
                  )
                )
              );
              break;

            /*
             * Edit user.
             * /user/edit/\{userId\}
             */
            case 'edit':
              $userId = $this->params[2];
              $userController = UserController::getInstance ();
              if (!empty ($_POST)) {
                try {
                  if ($userController->editUser ($userId, $_POST)) {
                    MessageManager::setSuccessMessage ('User successfully edited!');
                    Tools::redirect (Config::read ('siteUrlRoot') . 'admin/user/view/' . $userId);
                  }
                }
                catch (Exception $e) {
                  FB::error ($e);
                  MessageManager::setGlobalMessage ($e->getMessage ());
                }
              }
              $userRoleController = new UserRoleController ();
              $this->_setElements (
                array (
                  'mainContent' => array (
                    'filename' => 'admin/userEditForm',
                    'data' => array (
                      'user' => $userController->getUserById ($userId),
                      'userRoles' => $userRoleController->getUserRoles (),
                    )
                  )
                )
              );
              break;

            /*
             * Delete user.
             * /user/delete/\{userId\}
             */
            case 'delete':
              $userId = $this->params[2];
              $userController = UserController::getInstance ();
              if (isset ($_POST['submitNo'])) {
                Tools::redirect (Config::read ('siteUrlRoot') . 'admin/user/');
              }
              elseif (isset ($_POST['submitYes'])) {
                try {
                  if ($userController->deleteUser ($userId)) {
                    MessageManager::setSuccessMessage ('User successfully deleted!');
                    Tools::redirect (Config::read ('siteUrlRoot') . 'admin/user/');
                  }
                }
                catch (Exception $e) {
                  FB::error ($e);
                  MessageManager::setGlobalMessage ($e->getMessage ());
                }
              }
              else {
                $this->_setElements (
                  array (
                    'mainContent' => array (
                      'filename' => 'admin/userDeleteForm',
                      'data' => array (
                        'user' => $userController->getUserById ($userId)
                      )
                    )
                  )
                );
              }
              break;
          }
        }
        break;

      /*
       * UserRole.
       */
      case 'userRole':
        if ($this->_checkParams (1, TRUE)) {
          $userRoleController = UserRoleController::getInstance ();
          $this->_setElements (
            array (
              'mainContent' => array (
                'filename' => 'admin/userRoleTable',
                'data' => array (
                  'userRoles' => $userRoleController->getUserRoles (
                    isset ($_GET['orderBy']) ? $_GET['orderBy'] : NULL,
                    isset ($_GET['orderDirection']) ? $_GET['orderDirection'] : NULL,
                    isset ($_GET['page']) ? $_GET['page'] : NULL,
                    Config::read ('iterationLimit'),
                    isset ($_GET['searchSubmit']) ? $_GET : NULL
                  ),
                  'userRoleCount' => $userRoleController->getUserRoleCount (isset ($_GET['searchSubmit']) ? $_GET : NULL)
                )
              )
            )
          );
          break;
        }
        elseif ($this->_checkParams (2, TRUE)) {
          switch ($this->params[1]) {
            /*
             * Add userRole.
             * /userRole/add/
             */
            case 'add':
              if (!empty ($_POST)) {
                $userRoleController = UserRoleController::getInstance ();
                try {
                  $userRole = $userRoleController->addUserRole ($_POST);
                }
                catch (Exception $e) {
                  FB::error ($e);
                  MessageManager::setGlobalMessage ($e->getMessage ());
                }
                if (isset ($userRole)) {
                  MessageManager::setSuccessMessage ('User Role successfully added!');
                  Tools::redirect (Config::read ('siteUrlRoot') . 'admin/userRole/view/' . $userRole->getId ());
                }
              }
              $this->_setElements (
                array (
                  'mainContent' => array (
                    'filename' => 'admin/userRoleAddForm',
                    'data' => array (
                    )
                  )
                )
              );
              break;
          }
        }
        elseif ($this->_checkParams (3, TRUE)) {
          switch ($this->params[1]) {
            /*
             * View userRole.
             * /userRole/view/\{userRoleId\}
             */
            case 'view':
              $userRoleId = $this->params[2];
              $userRoleController = UserRoleController::getInstance ();
              $this->_setElements (
                array (
                  'mainContent' => array (
                    'filename' => 'admin/userRoleView',
                    'data' => array (
                      'userRole' => $userRoleController->getUserRoleById ($userRoleId)
                    )
                  )
                )
              );
              break;

            /*
             * Edit userRole.
             * /userRole/edit/\{userRoleId\}
             */
            case 'edit':
              $userRoleId = $this->params[2];
              $userRoleController = UserRoleController::getInstance ();
              if (!empty ($_POST)) {
                try {
                  if ($userRoleController->editUserRole ($userRoleId, $_POST)) {
                    MessageManager::setSuccessMessage ('User Role successfully edited!');
                    Tools::redirect (Config::read ('siteUrlRoot') . 'admin/userRole/view/' . $userRoleId);
                  }
                }
                catch (Exception $e) {
                  FB::error ($e);
                  MessageManager::setGlobalMessage ($e->getMessage ());
                }
              }
              $this->_setElements (
                array (
                  'mainContent' => array (
                    'filename' => 'admin/userRoleEditForm',
                    'data' => array (
                      'userRole' => $userRoleController->getUserRoleById ($userRoleId),
                    )
                  )
                )
              );
              break;

            /*
             * Delete userRole.
             * /userRole/delete/\{userRoleId\}
             */
            case 'delete':
              $userRoleId = $this->params[2];
              $userRoleController = UserRoleController::getInstance ();
              if (isset ($_POST['submitNo'])) {
                Tools::redirect (Config::read ('siteUrlRoot') . 'admin/userRole/');
              }
              elseif (isset ($_POST['submitYes'])) {
                try {
                  if ($userRoleController->deleteUserRole ($userRoleId)) {
                    MessageManager::setSuccessMessage ('User Role successfully deleted!');
                    Tools::redirect (Config::read ('siteUrlRoot') . 'admin/userRole/');
                  }
                }
                catch (Exception $e) {
                  FB::error ($e);
                  MessageManager::setGlobalMessage ($e->getMessage ());
                }
              }
              else {
                $this->_setElements (
                  array (
                    'mainContent' => array (
                      'filename' => 'admin/userRoleDeleteForm',
                      'data' => array (
                        'userRole' => $userRoleController->getUserRoleById ($userRoleId)
                      )
                    )
                  )
                );
              }
              break;
          }
        }
        break;

      /*
       * Page.
       */
      case 'page':
        if ($this->_checkParams (1, TRUE)) {
          $pageController = PageController::getInstance ();
            $this->_setElements (
            array (
              'mainContent' => array (
                'filename' => 'admin/pageTable',
                'data' => array (
                  'pageTree' => $pageController->getPageTree (),
                  'initialDepth' => 0
                )
              )
            )
          );

          break;
        }
        elseif ($this->_checkParams (3, TRUE)) {
          switch ($this->params[1]) {
            /*
             * Add page.
             * /page/add/{parentId}
             */
            case 'add':
              if (!empty ($_POST)) {
                $pageController = PageController::getInstance ();
                try {
                  $page = $pageController->addPage ($this->params[2], $_POST);
                }
                catch (Exception $e) {
                  FB::error ($e);
                  MessageManager::setGlobalMessage ($e->getMessage ());
                }
                if (isset ($page)) {
                  MessageManager::setSuccessMessage ('Page successfully added!');
                  Tools::redirect (Config::read ('siteUrlRoot') . 'admin/page/view/' . $page->getId ());
                }
              }
              $this->_setElements (
                array (
                  'mainContent' => array (
                    'filename' => 'admin/pageAddForm',
                    'data' => array (
                    )
                  )
                )
              );
              break;

            /*
             * View page.
             * /page/view/\{pageId\}
             */
            case 'view':
              $pageId = $this->params[2];
              $pageController = PageController::getInstance ();
              $this->_setElements (
                array (
                  'mainContent' => array (
                    'filename' => 'admin/pageView',
                    'data' => array (
                      'page' => $pageController->getPageById ($pageId)
                    )
                  )
                )
              );
              break;

            /*
             * Edit page.
             * /page/edit/\{pageId\}
             */
            case 'edit':
              $pageId = $this->params[2];
              $pageController = PageController::getInstance ();
              if (!empty ($_POST)) {
                try {
                  if ($pageController->editPage ($pageId, $_POST)) {
                    MessageManager::setSuccessMessage ('Page successfully edited!');
                    Tools::redirect (Config::read ('siteUrlRoot') . 'admin/page/view/' . $pageId);
                  }
                }
                catch (Exception $e) {
                  FB::error ($e);
                  MessageManager::setGlobalMessage ($e->getMessage ());
                }
              }
              $this->_setElements (
                array (
                  'mainContent' => array (
                    'filename' => 'admin/pageEditForm',
                    'data' => array (
                      'page' => $pageController->getPageById ($pageId),
                    )
                  )
                )
              );
              break;

            /*
             * Delete page.
             * /page/delete/\{pageId\}
             */
            case 'delete':
              $pageId = $this->params[2];
              $pageController = PageController::getInstance ();
              if (isset ($_POST['submitNo'])) {
                Tools::redirect (Config::read ('siteUrlRoot') . 'admin/page/');
              }
              elseif (isset ($_POST['submitYes'])) {
                try {
                  if ($pageController->deletePage ($pageId)) {
                    MessageManager::setSuccessMessage ('Page successfully deleted!');
                    Tools::redirect (Config::read ('siteUrlRoot') . 'admin/page/');
                  }
                }
                catch (Exception $e) {
                  FB::error ($e);
                  MessageManager::setGlobalMessage ($e->getMessage ());
                }
              }
              else {
                $this->_setElements (
                  array (
                    'mainContent' => array (
                      'filename' => 'admin/pageDeleteForm',
                      'data' => array (
                        'page' => $pageController->getPageById ($pageId)
                      )
                    )
                  )
                );
              }
              break;

            /*
             * Move page up.
             * /page/move-up/\{pageId\}
             */
            case 'move-up':
              $pageController = PageController::getInstance ();
              $pageController->movePage ($this->params[2], 'up');
              MessageManager::setSuccessMessage ('Page moved up!');
              Tools::redirect (Config::read ('siteUrlRoot') . 'admin/page');
              break;

            /*
             * Move page down.
             * /page/move-down/\{pageId\}
             */
            case 'move-up':
              $pageController = PageController::getInstance ();
              $pageController->movePage ($this->params[2], 'down');
              MessageManager::setSuccessMessage ('Page moved down!');
              Tools::redirect (Config::read ('siteUrlRoot') . 'admin/page');
              break;
          }
        }
        break;

      /*
       * Actuality.
       */
      case 'actuality':
        if ($this->_checkParams (1, TRUE)) {
          $actualityController = ActualityController::getInstance ();
          $this->_setElements (
            array (
              'mainContent' => array (
                'filename' => 'admin/actualityTable',
                'data' => array (
                  'actualitys' => $actualityController->getActualitys (
                    isset ($_GET['orderBy']) ? $_GET['orderBy'] : NULL,
                    isset ($_GET['orderDirection']) ? $_GET['orderDirection'] : NULL,
                    isset ($_GET['page']) ? $_GET['page'] : NULL,
                    Config::read ('iterationLimit'),
                    isset ($_GET['searchSubmit']) ? $_GET : NULL
                  ),
                  'actualityCount' => $actualityController->getActualityCount (isset ($_GET['searchSubmit']) ? $_GET : NULL),
                  'languages' => $actualityController->getLanguages ()
                )
              )
            )
          );
          break;
        }
        elseif ($this->_checkParams (2, TRUE)) {
          switch ($this->params[1]) {
            /*
             * Add actuality.
             * /actuality/add/
             */
            case 'add':
              $actualityController = ActualityController::getInstance ();
              if (!empty ($_POST)) {
                try {
                  $actuality = $actualityController->addActuality ($_POST);
                }
                catch (Exception $e) {
                  FB::error ($e);
                  MessageManager::setGlobalMessage ($e->getMessage ());
                }
                if (isset ($actuality)) {
                  MessageManager::setSuccessMessage ('Actuality successfully added!');
                  Tools::redirect (Config::read ('siteUrlRoot') . 'admin/actuality/view/' . $actuality->getId ());
                }
              }
              $this->_setElements (
                array (
                  'mainContent' => array (
                    'filename' => 'admin/actualityAddForm',
                    'data' => array (
                      'languages' => $actualityController->getLanguages ()
                    )
                  )
                )
              );
              break;
          }
        }
        elseif ($this->_checkParams (3, TRUE)) {
          switch ($this->params[1]) {
            /*
             * View actuality.
             * /actuality/view/\{actualityId\}
             */
            case 'view':
              $actualityId = $this->params[2];
              $actualityController = ActualityController::getInstance ();
              $this->_setElements (
                array (
                  'mainContent' => array (
                    'filename' => 'admin/actualityView',
                    'data' => array (
                      'actuality' => $actualityController->getActualityById ($actualityId)
                    )
                  )
                )
              );
              break;

            /*
             * Edit actuality.
             * /actuality/edit/\{actualityId\}
             */
            case 'edit':
              $actualityId = $this->params[2];
              $actualityController = ActualityController::getInstance ();
              if (!empty ($_POST)) {
                try {
                  if ($actualityController->editActuality ($actualityId, $_POST)) {
                    MessageManager::setSuccessMessage ('Actuality successfully edited!');
                    Tools::redirect (Config::read ('siteUrlRoot') . 'admin/actuality/view/' . $actualityId);
                  }
                }
                catch (Exception $e) {
                  FB::error ($e);
                  MessageManager::setGlobalMessage ($e->getMessage ());
                }
              }
              $this->_setElements (
                array (
                  'mainContent' => array (
                    'filename' => 'admin/actualityEditForm',
                    'data' => array (
                      'actuality' => $actualityController->getActualityById ($actualityId),
                      'languages' => $actualityController->getLanguages ()
                    )
                  )
                )
              );
              break;

            /*
             * Delete actuality.
             * /actuality/delete/\{actualityId\}
             */
            case 'delete':
              $actualityId = $this->params[2];
              $actualityController = ActualityController::getInstance ();
              if (isset ($_POST['submitNo'])) {
                Tools::redirect (Config::read ('siteUrlRoot') . 'admin/actuality/');
              }
              elseif (isset ($_POST['submitYes'])) {
                try {
                  if ($actualityController->deleteActuality ($actualityId)) {
                    MessageManager::setSuccessMessage ('Actuality successfully deleted!');
                    Tools::redirect (Config::read ('siteUrlRoot') . 'admin/actuality/');
                  }
                }
                catch (Exception $e) {
                  FB::error ($e);
                  MessageManager::setGlobalMessage ($e->getMessage ());
                }
              }
              else {
                $this->_setElements (
                  array (
                    'mainContent' => array (
                      'filename' => 'admin/actualityDeleteForm',
                      'data' => array (
                        'actuality' => $actualityController->getActualityById ($actualityId)
                      )
                    )
                  )
                );
              }
              break;
          }
        }
        break;

      /*
       * Video.
       */
      case 'video':
        if ($this->_checkParams (1, TRUE)) {
          $videoController = VideoController::getInstance ();
          $this->_setElements (
            array (
              'mainContent' => array (
                'filename' => 'admin/videoTable',
                'data' => array (
                  'videos' => $videoController->getVideos (
                    isset ($_GET['orderBy']) ? $_GET['orderBy'] : NULL,
                    isset ($_GET['orderDirection']) ? $_GET['orderDirection'] : NULL,
                    isset ($_GET['page']) ? $_GET['page'] : NULL,
                    Config::read ('iterationLimit'),
                    isset ($_GET['searchSubmit']) ? $_GET : NULL
                  ),
                  'videoCount' => $videoController->getVideoCount (isset ($_GET['searchSubmit']) ? $_GET : NULL)
                )
              )
            )
          );
          break;
        }
        elseif ($this->_checkParams (2, TRUE)) {
          switch ($this->params[1]) {
            /*
             * Add video.
             * /video/add/
             */
            case 'add':
              if (!empty ($_POST)) {
                $videoController = VideoController::getInstance ();
                try {
                  $video = $videoController->addVideo ($_POST);
                }
                catch (Exception $e) {
                  FB::error ($e);
                  MessageManager::setGlobalMessage ($e->getMessage ());
                }
                if (isset ($video)) {
                  MessageManager::setSuccessMessage ('Video successfully added!');
                  Tools::redirect (Config::read ('siteUrlRoot') . 'admin/video/view/' . $video->getId ());
                }
              }
              $this->_setElements (
                array (
                  'mainContent' => array (
                    'filename' => 'admin/videoAddForm',
                    'data' => array (
                    )
                  )
                )
              );
              break;
          }
        }
        elseif ($this->_checkParams (3, TRUE)) {
          switch ($this->params[1]) {
            /*
             * View video.
             * /video/view/\{videoId\}
             */
            case 'view':
              $videoId = $this->params[2];
              $videoController = VideoController::getInstance ();
              $this->_setElements (
                array (
                  'mainContent' => array (
                    'filename' => 'admin/videoView',
                    'data' => array (
                      'video' => $videoController->getVideoById ($videoId)
                    )
                  )
                )
              );
              break;

            /*
             * Edit video.
             * /video/edit/\{videoId\}
             */
            case 'edit':
              $videoId = $this->params[2];
              $videoController = VideoController::getInstance ();
              if (!empty ($_POST)) {
                try {
                  if ($videoController->editVideo ($videoId, $_POST)) {
                    MessageManager::setSuccessMessage ('Video successfully edited!');
                    Tools::redirect (Config::read ('siteUrlRoot') . 'admin/video/view/' . $videoId);
                  }
                }
                catch (Exception $e) {
                  FB::error ($e);
                  MessageManager::setGlobalMessage ($e->getMessage ());
                }
              }
              $this->_setElements (
                array (
                  'mainContent' => array (
                    'filename' => 'admin/videoEditForm',
                    'data' => array (
                      'video' => $videoController->getVideoById ($videoId),
                    )
                  )
                )
              );
              break;

            /*
             * Delete video.
             * /video/delete/\{videoId\}
             */
            case 'delete':
              $videoId = $this->params[2];
              $videoController = VideoController::getInstance ();
              if (isset ($_POST['submitNo'])) {
                Tools::redirect (Config::read ('siteUrlRoot') . 'admin/video/');
              }
              elseif (isset ($_POST['submitYes'])) {
                try {
                  if ($videoController->deleteVideo ($videoId)) {
                    MessageManager::setSuccessMessage ('Video successfully deleted!');
                    Tools::redirect (Config::read ('siteUrlRoot') . 'admin/video/');
                  }
                }
                catch (Exception $e) {
                  FB::error ($e);
                  MessageManager::setGlobalMessage ($e->getMessage ());
                }
              }
              else {
                $this->_setElements (
                  array (
                    'mainContent' => array (
                      'filename' => 'admin/videoDeleteForm',
                      'data' => array (
                        'video' => $videoController->getVideoById ($videoId)
                      )
                    )
                  )
                );
              }
              break;
          }
        }
        break;

      /*
       * Gallery.
       */
      case 'gallery':
        if ($this->_checkParams (1, TRUE)) {
          $galleryController = GalleryController::getInstance ();
          $this->_setElements (
            array (
              'mainContent' => array (
                'filename' => 'admin/galleryTable',
                'data' => array (
                  'gallerys' => $galleryController->getGallerys (
                    isset ($_GET['orderBy']) ? $_GET['orderBy'] : NULL,
                    isset ($_GET['orderDirection']) ? $_GET['orderDirection'] : NULL,
                    isset ($_GET['page']) ? $_GET['page'] : NULL,
                    Config::read ('iterationLimit'),
                    isset ($_GET['searchSubmit']) ? $_GET : NULL
                  ),
                  'galleryCount' => $galleryController->getGalleryCount (isset ($_GET['searchSubmit']) ? $_GET : NULL)
                )
              )
            )
          );
          break;
        }
        elseif ($this->_checkParams (2, TRUE)) {
          switch ($this->params[1]) {
            /*
             * Add gallery.
             * /gallery/add/
             */
            case 'add':
              if (!empty ($_POST)) {
                $galleryController = GalleryController::getInstance ();
                try {
                  $gallery = $galleryController->addGallery ($_POST);
                }
                catch (Exception $e) {
                  FB::error ($e);
                  MessageManager::setGlobalMessage ($e->getMessage ());
                }
                if (isset ($gallery)) {
                  MessageManager::setSuccessMessage ('Gallery successfully added!');
                  Tools::redirect (Config::read ('siteUrlRoot') . 'admin/gallery/view/' . $gallery->getId ());
                }
              }
              $this->_setElements (
                array (
                  'mainContent' => array (
                    'filename' => 'admin/galleryAddForm',
                    'data' => array (
                    )
                  )
                )
              );
              break;
          }
        }
        elseif ($this->_checkParams (3, TRUE)) {
          switch ($this->params[1]) {
            /*
             * View gallery.
             * /gallery/view/\{galleryId\}
             */
            case 'view':
              $galleryId = $this->params[2];
              $galleryController = GalleryController::getInstance ();
              $this->_setElements (
                array (
                  'mainContent' => array (
                    'filename' => 'admin/galleryView',
                    'data' => array (
                      'gallery' => $galleryController->getGalleryById ($galleryId)
                    )
                  )
                )
              );
              break;

            /*
             * Edit gallery.
             * /gallery/edit/\{galleryId\}
             */
            case 'edit':
              $galleryId = $this->params[2];
              $galleryController = GalleryController::getInstance ();
              if (!empty ($_POST)) {
                try {
                  if ($galleryController->editGallery ($galleryId, $_POST)) {
                    MessageManager::setSuccessMessage ('Gallery successfully edited!');
                    Tools::redirect (Config::read ('siteUrlRoot') . 'admin/gallery/view/' . $galleryId);
                  }
                }
                catch (Exception $e) {
                  FB::error ($e);
                  MessageManager::setGlobalMessage ($e->getMessage ());
                }
              }
              $this->_setElements (
                array (
                  'mainContent' => array (
                    'filename' => 'admin/galleryEditForm',
                    'data' => array (
                      'gallery' => $galleryController->getGalleryById ($galleryId),
                    )
                  )
                )
              );
              break;

            /*
             * Delete gallery.
             * /gallery/delete/\{galleryId\}
             */
            case 'delete':
              $galleryId = $this->params[2];
              $galleryController = GalleryController::getInstance ();
              if (isset ($_POST['submitNo'])) {
                Tools::redirect (Config::read ('siteUrlRoot') . 'admin/gallery/');
              }
              elseif (isset ($_POST['submitYes'])) {
                try {
                  if ($galleryController->deleteGallery ($galleryId)) {
                    MessageManager::setSuccessMessage ('Gallery successfully deleted!');
                    Tools::redirect (Config::read ('siteUrlRoot') . 'admin/gallery/');
                  }
                }
                catch (Exception $e) {
                  FB::error ($e);
                  MessageManager::setGlobalMessage ($e->getMessage ());
                }
              }
              else {
                $this->_setElements (
                  array (
                    'mainContent' => array (
                      'filename' => 'admin/galleryDeleteForm',
                      'data' => array (
                        'gallery' => $galleryController->getGalleryById ($galleryId)
                      )
                    )
                  )
                );
              }
              break;

            /*
             * Upload image.
             * /gallery/uploadImage/\{galleryId\}
             */
            case 'uploadImage':
              $this->_setTemplate ('ajax');
              $galleryId = isset ($_POST['galleryId']) ? $_POST['galleryId'] : NULL;
              if (is_null ($galleryId)) {
                $this->set404 ();
                break;
              }
              $galleryController = GalleryController::getInstance ();
              $result = $galleryController->addImage ($galleryId);
              if (!$result) {
                $result = array ('error' => 'An error occurred while uploading image.');
              }
              $this->_setElements (
                array (
                  'mainContent' => array (
                    'filename' => 'ajax/json',
                    'data' => array (
                      'ajaxData' => $result
                    )
                  )
                )
              );
              break;

              /*
              * Remove image.
              * /gallery/removeImage/\{galleryId\}
              */
              case 'removeImage':
              $this->_setTemplate ('ajax');
              $imageId = isset ($_POST['imageId']) ? $_POST['imageId'] : NULL;
              if (is_null ($imageId)) {
                $this->set404 ();
                break;
              }
              $galleryId = isset ($_POST['galleryId']) ? $_POST['galleryId'] : NULL;
              if (is_null ($galleryId)) {
                $this->set404 ();
                break;
              }
              $result = array ('success' => 0);
              if (!is_null ($imageId)) {
                $galleryController = GalleryController::getInstance ();
                if ($galleryController->deleteImage ($galleryId, $imageId)) {
                  $result = array ('success' => 1);
                }
              }
              $this->_setElements (
                array (
                  'mainContent' => array (
                    'filename' => 'ajax/json',
                    'data' => array (
                      'ajaxData' => $result
                    )
                  )
                )
              );
              break;

              /*
              * Move image.
              * /gallery/moveImage/\{galleryId\}
              */
              case 'moveImage':
              $this->_setTemplate ('ajax');
              $imageId = isset ($_POST['imageId']) ? $_POST['imageId'] : NULL;
              if (is_null ($imageId)) {
                $this->set404 ();
                break;
              }
              $galleryId = isset ($_POST['galleryId']) ? $_POST['galleryId'] : NULL;
              if (is_null ($galleryId)) {
                $this->set404 ();
                break;
              }
              $direction = isset ($_POST['direction']) ? $_POST['direction'] : NULL;
              if (is_null ($direction)) {
                $this->set404 ();
                break;
              }
              $result = array ('success' => 0);
              if (!is_null ($imageId)) {
                $galleryController = GalleryController::getInstance ();
                if ($galleryController->moveImage ($galleryId, $imageId, $direction)) {
                  $result = array ('success' => 1);
                }
              }
              $this->_setElements (
                array (
                  'mainContent' => array (
                    'filename' => 'ajax/json',
                    'data' => array (
                      'ajaxData' => $result
                    )
                  )
                )
              );
              break;
          }
        }
        break;

      /*
       * Banner.
       */
      case 'banner':
        if ($this->_checkParams (1, TRUE)) {
          $bannerController = BannerController::getInstance ();
          $this->_setElements (
            array (
              'mainContent' => array (
                'filename' => 'admin/bannerTable',
                'data' => array (
                  'banners' => $bannerController->getBanners (
                    isset ($_GET['orderBy']) ? $_GET['orderBy'] : NULL,
                    isset ($_GET['orderDirection']) ? $_GET['orderDirection'] : NULL,
                    isset ($_GET['page']) ? $_GET['page'] : NULL,
                    Config::read ('iterationLimit'),
                    isset ($_GET['searchSubmit']) ? $_GET : NULL
                  ),
                  'bannerCount' => $bannerController->getBannerCount (isset ($_GET['searchSubmit']) ? $_GET : NULL)
                )
              )
            )
          );
          break;
        }
        elseif ($this->_checkParams (2, TRUE)) {
          switch ($this->params[1]) {
            /*
             * Add banner.
             * /banner/add/
             */
            case 'add':
              if (!empty ($_POST)) {
                $bannerController = BannerController::getInstance ();
                try {
                  $banner = $bannerController->addBanner ($_POST);
                }
                catch (Exception $e) {
                  FB::error ($e);
                  MessageManager::setGlobalMessage ($e->getMessage ());
                }
                if (isset ($banner)) {
                  MessageManager::setSuccessMessage ('Banner successfully added!');
                  Tools::redirect (Config::read ('siteUrlRoot') . 'admin/banner/view/' . $banner->getId ());
                }
              }
              $this->_setElements (
                array (
                  'mainContent' => array (
                    'filename' => 'admin/bannerAddForm',
                    'data' => array (
                    )
                  )
                )
              );
              break;
          }
        }
        elseif ($this->_checkParams (3, TRUE)) {
          switch ($this->params[1]) {
            /*
             * View banner.
             * /banner/view/\{bannerId\}
             */
            case 'view':
              $bannerId = $this->params[2];
              $bannerController = BannerController::getInstance ();
              $this->_setElements (
                array (
                  'mainContent' => array (
                    'filename' => 'admin/bannerView',
                    'data' => array (
                      'banner' => $bannerController->getBannerById ($bannerId)
                    )
                  )
                )
              );
              break;

            /*
             * Edit banner.
             * /banner/edit/\{bannerId\}
             */
            case 'edit':
              $bannerId = $this->params[2];
              $bannerController = BannerController::getInstance ();
              if (!empty ($_POST)) {
                try {
                  if ($bannerController->editBanner ($bannerId, $_POST)) {
                    MessageManager::setSuccessMessage ('Banner successfully edited!');
                    Tools::redirect (Config::read ('siteUrlRoot') . 'admin/banner/view/' . $bannerId);
                  }
                }
                catch (Exception $e) {
                  FB::error ($e);
                  MessageManager::setGlobalMessage ($e->getMessage ());
                }
              }
              $this->_setElements (
                array (
                  'mainContent' => array (
                    'filename' => 'admin/bannerEditForm',
                    'data' => array (
                      'banner' => $bannerController->getBannerById ($bannerId),
                    )
                  )
                )
              );
              break;

            /*
             * Delete banner.
             * /banner/delete/\{bannerId\}
             */
            case 'delete':
              $bannerId = $this->params[2];
              $bannerController = BannerController::getInstance ();
              if (isset ($_POST['submitNo'])) {
                Tools::redirect (Config::read ('siteUrlRoot') . 'admin/banner/');
              }
              elseif (isset ($_POST['submitYes'])) {
                try {
                  if ($bannerController->deleteBanner ($bannerId)) {
                    MessageManager::setSuccessMessage ('Banner successfully deleted!');
                    Tools::redirect (Config::read ('siteUrlRoot') . 'admin/banner/');
                  }
                }
                catch (Exception $e) {
                  FB::error ($e);
                  MessageManager::setGlobalMessage ($e->getMessage ());
                }
              }
              else {
                $this->_setElements (
                  array (
                    'mainContent' => array (
                      'filename' => 'admin/bannerDeleteForm',
                      'data' => array (
                        'banner' => $bannerController->getBannerById ($bannerId)
                      )
                    )
                  )
                );
              }
              break;

            /*
             * Move banner up.
             * /banner/move-up/\{bannerId\}
             */
            case 'move-up':
              $bannerController = BannerController::getInstance ();
              $bannerController->moveBanner ($this->params[2], 'up');
              MessageManager::setSuccessMessage ('Banner moved up!');
              Tools::redirect (Config::read ('siteUrlRoot') . 'admin/banner');
              break;

            /*
             * Move banner down.
             * /banner/move-down/\{bannerId\}
             */
            case 'move-up':
              $bannerController = BannerController::getInstance ();
              $bannerController->moveBanner ($this->params[2], 'down');
              MessageManager::setSuccessMessage ('Banner moved down!');
              Tools::redirect (Config::read ('siteUrlRoot') . 'admin/banner');
              break;
          }
        }
        break;

      case 'ajax':
        $this->_setTemplate ('ajax');
        switch ($this->params[1]) {
          case 'editCustomModule':
            if ($this->_checkParams(3, TRUE)) {
              $customModuleController = CustomModuleController::getInstance ();
              $customModule = $customModuleController->getCustomModuleById ($this->params[2]);
              if ($customModule) {
                $this->_setElements (
                  array (
                    'mainContent' => array (
                      'filename' => 'admin/editCustomModule',
                      'data' => array (
                        'customModule' => $customModule
                      )
                    )
                  )
                );
              }
            }
            break;
            
          case 'customModuleItemDelete':
            $customModuleItemController = CustomModuleItemController::getInstance();
            $customModuleItemController->deleteCustomModuleItem($_GET['itemId']);
            break;
            
          case 'customModule':
            if ($this->_checkParams (3, TRUE)) {
              switch ($this->params[2]) {
                case 'add':
                  $customModuleController = CustomModuleController::getInstance ();
                  $customModule = $customModuleController->addCustomModule (array ());
                  if ($customModule) {
                    $this->_setElements (
                      array (
                        'mainContent' => array (
                          'filename' => 'ajax/json',
                          'data' => array (
                            'data' => array (
                              'moduleId' => $customModule->getId ()
                            )
                          )
                        )
                      )
                    );
                  }
                  return;

                default:
                  $customModuleController = CustomModuleController::getInstance ();
                  $customModule = $customModuleController->getCustomModuleById ($this->params[2]);
                  if ($customModule) {
                    $this->_setElements (
                      array (
                        'mainContent' => array (
                          'filename' => 'ajax/customModuleHtml',
                          'data' => array (
                            'customModule' => $customModule
                          )
                        )
                      )
                    );
                  }
                  return;
              }
            }
            elseif ($this->_checkParams (4)) {
              switch ($this->params[2]) {
                case 'delete':
                    $moduleId = $this->params[3];
                    $customModuleController = CustomModuleController::getInstance ();
                    $customModuleController->deleteCustomModule($moduleId);
                    
                    $this->_setElements (
                        array (
                          'mainContent' => array (
                            'filename' => 'ajax/json',
                            'dataType' => 'json',
                            'data' => array (
                              'data' => array (
                                'success' => TRUE
                              )
                            )
                          )
                        )
                      );
                  return;

                case 'uploadImage':
                  $customModuleItemController = CustomModuleItemController::getInstance ();
                  $customModuleItem = $customModuleItemController->addCustomModuleItem (
                    array (
                      'customModuleItemSizeId' => 1,
                      'customModuleId' => $this->params[3]
                    )
                  );
                  if ($customModuleItem) {
                    $customModuleImageController = CustomModuleImageController::getInstance ();
                    $customModuleImage = $customModuleImageController->addCustomModuleImage (
                      array (
                        'customModuleItemId' => $customModuleItem->getId ()
                      )
                    );
                    if ($customModuleImage) {
                      $this->_setElements (
                        array (
                          'mainContent' => array (
                            'filename' => 'ajax/json',
                            'data' => array (
                              'data' => array (
                                'itemId' => $customModuleItem->getId (),
                                'imageUrl' => array (
                                  'wide' => $customModuleImage->getImage ()->getUrl (),
                                  'small' => $customModuleImage->getImage ()->getSmallImageUrl ()
                                )
                              )
                            )
                          )
                        )
                      );
                    }
                  }
                  return;

                case 'updateImage':
                  $customModuleItemController = CustomModuleItemController::getInstance ();
                  $customModuleItem = $customModuleItemController->editCustomModuleItem (
                    $this->params[3],
                    array (
                      'customModuleItemSizeId' => $_POST['size'],
                      'position' => $_POST['position']
                    )
                  );
                  return;

                case 'uploadText':
                  
                  $customModuleItemController = CustomModuleItemController::getInstance ();
                  
                  $customModuleItem = NULL;
                  if ($_POST['itemId']) {
                    $customModuleItem = $customModuleItemController->getCustomModuleItemById($_POST['itemId']);
                  }
                  
                  if ($customModuleItem) {
                    $customModuleItemController->editCustomModuleItem (
                      (int)$_POST['itemId'],
                      array (
                        'customModuleItemSizeId' => $_POST['size'],
                        'position' => $_POST['position']
                      )
                    );
                  } else {
                    $customModuleItem = $customModuleItemController->addCustomModuleItem (
                      array (
                        'customModuleItemSizeId' => $_POST['size'],
                        'customModuleId' => $this->params[3],
                        'position' => $_POST['position']
                      )
                    );
                  }
                  
                  if ($customModuleItem) {
                    $customModuleTextController = CustomModuleTextController::getInstance ();
                    $customModuleText = $customModuleTextController->deleteCustomModuleTextByItem($customModuleItem->getId());

                    $customModuleText = $customModuleTextController->addCustomModuleText (
                      array (
                        'customModuleItemId' => $customModuleItem->getId (),
                        'content' => $_POST['content'],
                        'footnote' => $_POST['footnote']
                      )
                    );
                    
                    if ($customModuleText) {
                      $this->_setElements (
                        array (
                          'mainContent' => array (
                            'filename' => 'ajax/json',
                            'data' => array (
                              'data' => array (
                                'success' => TRUE
                              )
                            )
                          )
                        )
                      );
                    }
                  }
                  return;
              }
            }
            break;
        }
        break;

      /*
       * Team.
       */
      case 'team':
        if ($this->_checkParams (1, TRUE)) {
          $teamController = TeamController::getInstance ();
          $this->_setElements (
            array (
              'mainContent' => array (
                'filename' => 'admin/teamTable',
                'data' => array (
                  'teams' => $teamController->getTeams (
                    isset ($_GET['orderBy']) ? $_GET['orderBy'] : NULL,
                    isset ($_GET['orderDirection']) ? $_GET['orderDirection'] : NULL,
                    isset ($_GET['page']) ? $_GET['page'] : NULL,
                    Config::read ('iterationLimit'),
                    isset ($_GET['searchSubmit']) ? $_GET : NULL
                  ),
                  'teamCount' => $teamController->getTeamCount (isset ($_GET['searchSubmit']) ? $_GET : NULL)
                )
              )
            )
          );
          break;
        }
        elseif ($this->_checkParams (2, TRUE)) {
          switch ($this->params[1]) {
            /*
             * Add team.
             * /team/add/
             */
            case 'add':
              if (!empty ($_POST)) {
                $teamController = TeamController::getInstance ();
                try {
                  $team = $teamController->addTeam ($_POST);
                }
                catch (Exception $e) {
                  FB::error ($e);
                  MessageManager::setGlobalMessage ($e->getMessage ());
                }
                if (isset ($team)) {
                  MessageManager::setSuccessMessage ('Team successfully added!');
                  Tools::redirect (Config::read ('siteUrlRoot') . 'admin/team/view/' . $team->getId ());
                }
              }
              $this->_setElements (
                array (
                  'mainContent' => array (
                    'filename' => 'admin/teamAddForm',
                    'data' => array (
                    )
                  )
                )
              );
              break;
          }
        }
        elseif ($this->_checkParams (3, TRUE)) {
          switch ($this->params[1]) {
            /*
             * View team.
             * /team/view/\{teamId\}
             */
            case 'view':
              $teamId = $this->params[2];
              $teamController = TeamController::getInstance ();
              $this->_setElements (
                array (
                  'mainContent' => array (
                    'filename' => 'admin/teamView',
                    'data' => array (
                      'team' => $teamController->getTeamById ($teamId)
                    )
                  )
                )
              );
              break;

            /*
             * Edit team.
             * /team/edit/\{teamId\}
             */
            case 'edit':
              $teamId = $this->params[2];
              $teamController = TeamController::getInstance ();
              if (!empty ($_POST)) {
                try {
                  if ($teamController->editTeam ($teamId, $_POST)) {
                    MessageManager::setSuccessMessage ('Team successfully edited!');
                    Tools::redirect (Config::read ('siteUrlRoot') . 'admin/team/view/' . $teamId);
                  }
                }
                catch (Exception $e) {
                  FB::error ($e);
                  MessageManager::setGlobalMessage ($e->getMessage ());
                }
              }
              $this->_setElements (
                array (
                  'mainContent' => array (
                    'filename' => 'admin/teamEditForm',
                    'data' => array (
                      'team' => $teamController->getTeamById ($teamId),
                    )
                  )
                )
              );
              break;

            /*
             * Delete team.
             * /team/delete/\{teamId\}
             */
            case 'delete':
              $teamId = $this->params[2];
              $teamController = TeamController::getInstance ();
              if (isset ($_POST['submitNo'])) {
                Tools::redirect (Config::read ('siteUrlRoot') . 'admin/team/');
              }
              elseif (isset ($_POST['submitYes'])) {
                try {
                  if ($teamController->deleteTeam ($teamId)) {
                    MessageManager::setSuccessMessage ('Team successfully deleted!');
                    Tools::redirect (Config::read ('siteUrlRoot') . 'admin/team/');
                  }
                }
                catch (Exception $e) {
                  FB::error ($e);
                  MessageManager::setGlobalMessage ($e->getMessage ());
                }
              }
              else {
                $this->_setElements (
                  array (
                    'mainContent' => array (
                      'filename' => 'admin/teamDeleteForm',
                      'data' => array (
                        'team' => $teamController->getTeamById ($teamId)
                      )
                    )
                  )
                );
              }
              break;
          }
        }
        break;

      /*
       * Member.
       */
      case 'member':
        if ($this->_checkParams (1, TRUE)) {
          $memberController = MemberController::getInstance ();
          $this->_setElements (
            array (
              'mainContent' => array (
                'filename' => 'admin/memberTable',
                'data' => array (
                  'members' => $memberController->getMembers (
                    isset ($_GET['orderBy']) ? $_GET['orderBy'] : NULL,
                    isset ($_GET['orderDirection']) ? $_GET['orderDirection'] : NULL,
                    isset ($_GET['page']) ? $_GET['page'] : NULL,
                    Config::read ('iterationLimit'),
                    isset ($_GET['searchSubmit']) ? $_GET : NULL
                  ),
                  'memberCount' => $memberController->getMemberCount (isset ($_GET['searchSubmit']) ? $_GET : NULL)
                )
              )
            )
          );
          break;
        }
        elseif ($this->_checkParams (2, TRUE)) {
          switch ($this->params[1]) {
            /*
             * Add member.
             * /member/add/
             */
            case 'add':
              if (!empty ($_POST)) {
                $memberController = MemberController::getInstance ();
                try {
                  $member = $memberController->addMember ($_POST);
                }
                catch (Exception $e) {
                  FB::error ($e);
                  MessageManager::setGlobalMessage ($e->getMessage ());
                }
                if (isset ($member)) {
                  MessageManager::setSuccessMessage ('Member successfully added!');
                  if (isset ($_GET['teamId'])) {
                    Tools::redirect (Config::read ('siteUrlRoot') . 'admin/team/view/' . intval ($_GET['teamId']));
                  }
                  Tools::redirect (Config::read ('siteUrlRoot') . 'admin/member/view/' . $member->getId ());
                }
              }
              $memberCategoryController = new MemberCategoryController ();
              $teamController = new TeamController ();
              $this->_setElements (
                array (
                  'mainContent' => array (
                    'filename' => 'admin/memberAddForm',
                    'data' => array (
                      'memberCategorys' => $memberCategoryController->getMemberCategorys (),
                      'team' => isset ($_GET['teamId']) ? $teamController->getTeamById ($_GET['teamId']) : NULL,
                      'teams' => $teamController->getTeams (),
                    )
                  )
                )
              );
              break;
          }
        }
        elseif ($this->_checkParams (3, TRUE)) {
          switch ($this->params[1]) {
            /*
             * View member.
             * /member/view/\{memberId\}
             */
            case 'view':
              $memberId = $this->params[2];
              $memberController = MemberController::getInstance ();
              $this->_setElements (
                array (
                  'mainContent' => array (
                    'filename' => 'admin/memberView',
                    'data' => array (
                      'member' => $memberController->getMemberById ($memberId)
                    )
                  )
                )
              );
              break;

            /*
             * Edit member.
             * /member/edit/\{memberId\}
             */
            case 'edit':
              $memberId = $this->params[2];
              $memberController = MemberController::getInstance ();
              if (!empty ($_POST)) {
                try {
                  if ($memberController->editMember ($memberId, $_POST)) {
                    MessageManager::setSuccessMessage ('Member successfully edited!');
                    Tools::redirect (Config::read ('siteUrlRoot') . 'admin/member/view/' . $memberId);
                  }
                }
                catch (Exception $e) {
                  FB::error ($e);
                  MessageManager::setGlobalMessage ($e->getMessage ());
                }
              }
              $memberCategoryController = new MemberCategoryController ();
              $teamController = new TeamController ();
              $this->_setElements (
                array (
                  'mainContent' => array (
                    'filename' => 'admin/memberEditForm',
                    'data' => array (
                      'member' => $memberController->getMemberById ($memberId),
                      'memberCategorys' => $memberCategoryController->getMemberCategorys (),
                      'teams' => $teamController->getTeams (),
                    )
                  )
                )
              );
              break;

            /*
             * Delete member.
             * /member/delete/\{memberId\}
             */
            case 'delete':
              $memberId = $this->params[2];
              $memberController = MemberController::getInstance ();
              if (isset ($_POST['submitNo'])) {
                Tools::redirect (Config::read ('siteUrlRoot') . 'admin/member/');
              }
              elseif (isset ($_POST['submitYes'])) {
                try {
                  if ($memberController->deleteMember ($memberId)) {
                    MessageManager::setSuccessMessage ('Member successfully deleted!');
                    if (isset ($_GET['teamId'])) {
                      Tools::redirect (Config::read ('siteUrlRoot') . 'admin/team/view/' . intval ($_GET['teamId']));
                    }
                    Tools::redirect (Config::read ('siteUrlRoot') . 'admin/member/');
                  }
                }
                catch (Exception $e) {
                  FB::error ($e);
                  MessageManager::setGlobalMessage ($e->getMessage ());
                }
              }
              else {
                $this->_setElements (
                  array (
                    'mainContent' => array (
                      'filename' => 'admin/memberDeleteForm',
                      'data' => array (
                        'member' => $memberController->getMemberById ($memberId)
                      )
                    )
                  )
                );
              }
              break;
          }
        }
        break;

      /*
       * MemberCategory.
       */
      case 'memberCategory':
        if ($this->_checkParams (1, TRUE)) {
          $memberCategoryController = MemberCategoryController::getInstance ();
          $this->_setElements (
            array (
              'mainContent' => array (
                'filename' => 'admin/memberCategoryTable',
                'data' => array (
                  'memberCategorys' => $memberCategoryController->getMemberCategorys (
                    isset ($_GET['orderBy']) ? $_GET['orderBy'] : NULL,
                    isset ($_GET['orderDirection']) ? $_GET['orderDirection'] : NULL,
                    isset ($_GET['page']) ? $_GET['page'] : NULL,
                    Config::read ('iterationLimit'),
                    isset ($_GET['searchSubmit']) ? $_GET : NULL
                  ),
                  'memberCategoryCount' => $memberCategoryController->getMemberCategoryCount (isset ($_GET['searchSubmit']) ? $_GET : NULL)
                )
              )
            )
          );
          break;
        }
        elseif ($this->_checkParams (2, TRUE)) {
          switch ($this->params[1]) {
            /*
             * Add memberCategory.
             * /memberCategory/add/
             */
            case 'add':
              if (!empty ($_POST)) {
                $memberCategoryController = MemberCategoryController::getInstance ();
                try {
                  $memberCategory = $memberCategoryController->addMemberCategory ($_POST);
                }
                catch (Exception $e) {
                  FB::error ($e);
                  MessageManager::setGlobalMessage ($e->getMessage ());
                }
                if (isset ($memberCategory)) {
                  MessageManager::setSuccessMessage ('Member Category successfully added!');
                  Tools::redirect (Config::read ('siteUrlRoot') . 'admin/memberCategory/view/' . $memberCategory->getId ());
                }
              }
              $this->_setElements (
                array (
                  'mainContent' => array (
                    'filename' => 'admin/memberCategoryAddForm',
                    'data' => array (
                    )
                  )
                )
              );
              break;
          }
        }
        elseif ($this->_checkParams (3, TRUE)) {
          switch ($this->params[1]) {
            /*
             * View memberCategory.
             * /memberCategory/view/\{memberCategoryId\}
             */
            case 'view':
              $memberCategoryId = $this->params[2];
              $memberCategoryController = MemberCategoryController::getInstance ();
              $this->_setElements (
                array (
                  'mainContent' => array (
                    'filename' => 'admin/memberCategoryView',
                    'data' => array (
                      'memberCategory' => $memberCategoryController->getMemberCategoryById ($memberCategoryId)
                    )
                  )
                )
              );
              break;

            /*
             * Edit memberCategory.
             * /memberCategory/edit/\{memberCategoryId\}
             */
            case 'edit':
              $memberCategoryId = $this->params[2];
              $memberCategoryController = MemberCategoryController::getInstance ();
              if (!empty ($_POST)) {
                try {
                  if ($memberCategoryController->editMemberCategory ($memberCategoryId, $_POST)) {
                    MessageManager::setSuccessMessage ('Member Category successfully edited!');
                    Tools::redirect (Config::read ('siteUrlRoot') . 'admin/memberCategory/view/' . $memberCategoryId);
                  }
                }
                catch (Exception $e) {
                  FB::error ($e);
                  MessageManager::setGlobalMessage ($e->getMessage ());
                }
              }
              $this->_setElements (
                array (
                  'mainContent' => array (
                    'filename' => 'admin/memberCategoryEditForm',
                    'data' => array (
                      'memberCategory' => $memberCategoryController->getMemberCategoryById ($memberCategoryId),
                    )
                  )
                )
              );
              break;

            /*
             * Delete memberCategory.
             * /memberCategory/delete/\{memberCategoryId\}
             */
            case 'delete':
              $memberCategoryId = $this->params[2];
              $memberCategoryController = MemberCategoryController::getInstance ();
              if (isset ($_POST['submitNo'])) {
                Tools::redirect (Config::read ('siteUrlRoot') . 'admin/memberCategory/');
              }
              elseif (isset ($_POST['submitYes'])) {
                try {
                  if ($memberCategoryController->deleteMemberCategory ($memberCategoryId)) {
                    MessageManager::setSuccessMessage ('Member Category successfully deleted!');
                    Tools::redirect (Config::read ('siteUrlRoot') . 'admin/memberCategory/');
                  }
                }
                catch (Exception $e) {
                  FB::error ($e);
                  MessageManager::setGlobalMessage ($e->getMessage ());
                }
              }
              else {
                $this->_setElements (
                  array (
                    'mainContent' => array (
                      'filename' => 'admin/memberCategoryDeleteForm',
                      'data' => array (
                        'memberCategory' => $memberCategoryController->getMemberCategoryById ($memberCategoryId)
                      )
                    )
                  )
                );
              }
              break;
          }
        }
        break;

      default:
        $this->set404 ();
        break;
    }
  }

}

?>
