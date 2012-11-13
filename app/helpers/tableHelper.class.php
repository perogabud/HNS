<?php

class TableHelper {

  public static function globalMessages () {
    if (MessageManager::globalMessageIsSet ()) {
      echo '<p class="error">'. MessageManager::getGlobalMessage () .'</p>';
    }
    if (MessageManager::successMessageIsSet ()) {
      echo '<p class="success">'. MessageManager::getSuccessMessage () .'</p>';
    }
  }

  public static function orderLinks ($href, $field) {
    echo '<div class="orderLinks">';
    $order = '?';
    foreach ($_GET as $name => $value) {
      if (in_array ($name, array ('object', 'page'))) continue;
      if (is_array ($value)) {
        $name .= '[]';
        foreach ($value as $val) {
          $order .= $name . '=' . $val . '&';
        }
      }
      else {
        $order .= $name . '=' . $value . '&';
      }
    }
    $order .= 'page=1';
    if (isset ($_GET['orderBy']) && $_GET['orderBy'] == $field && isset ($_GET['orderDirection']) && $_GET['orderDirection'] == 'asc') {
      echo '<img src="' . Config::read ('siteUrlRoot') . '/img/admin/arrowUpGray.png" alt="asc"/>';
    }
    else {
      echo '<a href="' . Config::read ('siteUrlRoot') . $href . $order .'&orderBy='. $field .'&orderDirection=asc"><img src="' . Config::read ('siteUrlRoot') . '/img/admin/arrowUp.png" alt="asc"/></a>';
    }

    if (isset ($_GET['orderBy']) && $_GET['orderBy'] == $field && isset ($_GET['orderDirection']) && $_GET['orderDirection'] == 'desc') {
      echo '<img src="' . Config::read ('siteUrlRoot') . '/img/admin/arrowDownGray.png" alt="desc"/>';
    }
    else {
      echo '<a href="' . Config::read ('siteUrlRoot') . $href . $order .'&orderBy='. $field .'&orderDirection=desc"><img src="' . Config::read ('siteUrlRoot') . '/img/admin/arrowDown.png" alt="desc"/></a>';
    }
    echo '</div>';
  }

  public static function pagination ($uri, $count, $itemsPerPage = NULL) {
    $page = 1;
    if (isset ($_GET['page'])) {
      $page = $_GET['page'];
    }

    if (!$itemsPerPage) {
      $itemsPerPage = Config::read ('iterationLimit');
    }
    echo '<div class="pagination"><span class="pagination">Page: </span><ul class="pagination">';

    FB::log ($count);
    for ($i = 1; $i <= ceil ($count / $itemsPerPage); $i++) {
      if ($i == $page) {
        echo '<li><span>' . $i . '</span></li>';
      }
      else {
        $order = '?';
        foreach ($_GET as $name => $value) {
          if (in_array ($name, array ('object', 'page'))) continue;
          if (is_array ($value)) {
            $name .= '[]';
            foreach ($value as $val) {
              $order .= $name . '=' . $val . '&';
            }
          }
          else {
            $order .= $name . '=' . $value . '&';
          }
        }
        $order .= 'page=' . $i;

        echo '<li><a href="' . Config::read ('siteUrlRoot') . $uri . $order . '">' . $i . '</a></li>';
      }
    }
    echo '</ul></div>';
  }

  public static function showingRecord ($currentCount, $totalCount) {
    $page = 1;
    if (isset ($_GET['page'])) {
      $page = $_GET['page'];
    }
    $itemsPerPage = Config::read ('iterationLimit');
    $num1 = ($page - 1) * $itemsPerPage + 1;
    $num2 = $num1 + $currentCount - 1;
    echo "$num1. - $num2. of $totalCount total.";
  }

  public static function iconYesNo ($value) {
    if (is_null ($value)) {
      echo '<img src="' . Config::read ('siteUrlRoot') . '/img/admin/new.png" width="16" height="16" alt="new"/>';
    }
    elseif ($value == '0') {
      echo '<img src="' . Config::read ('siteUrlRoot') . '/img/admin/cross.png" width="16" height="16" alt="xmark"/>';
    }
    elseif ($value == '1') {
      echo '<img src="' . Config::read ('siteUrlRoot') . '/img/admin/check.png" width="16" height="16" alt="check"/>';
    }
  }

  public static function icon ($type, $return = FALSE) {
    $img = $type;
    switch ($type) {
      case 'add':
        $img = '<img border="0" alt="add" src="' . Config::read ('siteUrlRoot') . '/img/admin/add.png" />';
        break;
      case 'delete':
        $img = '<img border="0" alt="delete" src="' . Config::read ('siteUrlRoot') . '/img/admin/binClosed.png" />';
        break;
      case 'duplicate':
        $img = '<img border="0" alt="duplicate" src="' . Config::read ('siteUrlRoot') . '/img/admin/duplicate.png" />';
        break;
      case 'block':
        $img = '<img border="0" alt="block" src="' . Config::read ('siteUrlRoot') . '/img/admin/block.png" />';
        break;
      case 'unblock':
        $img = '<img border="0" alt="unblock" src="' . Config::read ('siteUrlRoot') . '/img/admin/refresh.png" />';
        break;
      case 'refresh':
        $img = '<img border="0" alt="refresh" src="' . Config::read ('siteUrlRoot') . '/img/admin/refresh.png" />';
        break;
      case 'edit':
        $img = '<img border="0" alt="edit" src="' . Config::read ('siteUrlRoot') . '/img/admin/edit.png" />';
        break;
      case 'view':
        $img = '<img border="0" alt="view" src="' . Config::read ('siteUrlRoot') . '/img/admin/view.png" />';
        break;
      case 'moveUp':
        $img = '<img border="0" alt="move up" src="' . Config::read ('siteUrlRoot') . '/img/admin/arrowUp.png" />';
        break;
      case 'moveDown':
        $img = '<img border="0" alt="move down" src="' . Config::read ('siteUrlRoot') . '/img/admin/arrowDown.png" />';
        break;
      case 'moveUpDisabled':
        $img = '<img border="0" alt="arrow up" src="' . Config::read ('siteUrlRoot') . '/img/admin/arrowUpGray.png" />';
        break;
      case 'moveDownDisabled':
        $img = '<img border="0" alt="arrow down" src="' . Config::read ('siteUrlRoot') . '/img/admin/arrowDownGray.png" />';
        break;
      case 'extern':
        $img = '<img border="0" alt="arrow down" src="' . Config::read ('siteUrlRoot') . '/img/admin/out.png" />';
        break;
      default:
        $img = '<img border="0" alt="'. $type .'" src="' . Config::read ('siteUrlRoot') . '/img/admin/'. $type .'.png" />';
    }
    if (!$return) {
      echo $img;
    }
    else {
      return $img;
    }
  }

  public static function drawPageTreeTable ($pageTree, $depth = 0) {
    if ($depth == 0) {
      echo '<table>';
      echo '<thead><tr><th>Page</th><th>Controls</th></tr></thead>';
      echo '<tbody>';
    }
    foreach ($pageTree as $page) {
      // Page table row
      echo '<tr class="pageDepth' . $depth . '" title="'. $page->Title .'">';
      echo '<td class="title" style="width: 80%;"><span class="dbg"> ' . $page->Lft . ' </span>' . $page->NavigationName . '<span class="dbg"> ' . $page->Rgt . ' </span></td>';

      // Controls
      echo '<td class="controls">';
      if ($depth >= 0) {
        // Position
        if ($depth > 1) {
          if ($page != $pageTree[0]) {
            echo '<a href="' . Config::read ('siteUrlRoot') . 'admin/page/move-up/' . $page->Id . '" title="Move up">' . self::icon ('moveUp', TRUE) . '</a>';
          }
          else {
            echo '<a title="Move up">' . self::icon ('moveUpDisabled', TRUE) . '</a>';
          }
          if ($page != $pageTree[count ($pageTree) - 1]) {
            echo '<a href="' . Config::read ('siteUrlRoot') . 'admin/page/move-down/' . $page->Id . '" title="Move down">' . self::icon ('moveDown', TRUE) . '</a>';
          }
          else {
            echo '<a title="Move down">' . self::icon ('moveDownDisabled', TRUE) . '</a>';
          }
        }
        // Add/Edit/Delete
        if ($page->CanAddChildren) {
          echo '<a href="' . Config::read ('siteUrlRoot') . 'admin/page/add/' . $page->Id . '" title="Add subpage">' . self::icon ('add', TRUE) . '</a>';
        }
        // Handle exceptions
        switch ($page->Slug) {
          case 'o-nama':
            echo '<a href="' . Config::read ('siteUrlRoot') . 'admin/customContent" title="Go to About us">' . self::icon ('extern', TRUE) . '</a>';
            break;
          case 'crm':
            echo '<a href="' . Config::read ('siteUrlRoot') . 'admin/product/view/1" title="Go to CRM">' . self::icon ('extern', TRUE) . '</a>';
            break;
          case 'infrastruktura':
            echo '<a href="' . Config::read ('siteUrlRoot') . 'admin/product/view/3" title="Go to Infrastruktura">' . self::icon ('extern', TRUE) . '</a>';
            break;
          case 'cloud':
            echo '<a href="' . Config::read ('siteUrlRoot') . 'admin/product/view/4" title="Go to Cloud">' . self::icon ('extern', TRUE) . '</a>';
            break;
          case 'info-centar':
            echo '<a href="' . Config::read ('siteUrlRoot') . 'admin/infoItem" title="Go to Info Centar">' . self::icon ('extern', TRUE) . '</a>';
            break;
          default:
            // blank
        }
        echo '<a href="' . Config::read ('siteUrlRoot') . 'admin/page/edit/' . $page->Id . '" title="Edit">' . self::icon ('edit', TRUE) . '</a>';
        if ($page->IsEditable) {
            if (!$page->IsException) {
              echo '<a href="' . Config::read ('siteUrlRoot') . 'admin/page/delete/' . $page->Id . '" title="Delete">' . self::icon ('delete', TRUE) . '</a>';
            }
          }
        echo '<a class="newWindow" href="' . $page->Url . '" title="View">' . self::icon ('view', TRUE) . '</a>';
      }
      else {
        echo '<a href="' . Config::read ('siteUrlRoot') . 'admin/page/edit/' . $page->Id . '" title="Edit">' . self::icon ('edit', TRUE) . '</a>';
      }
      echo '</td>';

      // End row and check for subpages
      echo '</tr>';
      if (!empty ($page->Subpages)) {
        self::drawPageTreeTable ($page->Subpages, $depth + 1);
      }
    }
    if ($depth == 0) {
      echo '</tbody>';
      echo '</table>';
    }
  }

  public static function drawPieceTable ($pieces, $userUri = '') {
    if (empty ($pieces)) {
      echo '<p>No pieces.</p>';
    }
    else {
      echo '<table>';
      echo '<tbody>';
      echo '<tr><th>Image</th><th>Title</th><th>Controls</th></tr>';
      foreach ($pieces as $piece) {
        // Page table row
        echo '<tr class="' . Tools::toggleClass () . '">';
        echo '<td>';
        FrontHelper::generatePieceImage ($piece->Filename, 'small', 'adminPiece');
        echo '</td>';
        echo '<td class="title">' . $piece->Title . '</td>';
        // Controls
        echo '<td class="controls3">';
        echo '<a href="' . Config::read ('siteUrlRoot') . 'admin/' . $userUri . 'piece/view/' . $piece->Id . '" title="View">' . self::icon ('view', TRUE) . '</a>';
        echo '<a href="' . Config::read ('siteUrlRoot') . 'admin/' . $userUri . 'piece/edit/' . $piece->Id . '" title="Edit">' . self::icon ('edit', TRUE) . '</a>';
        echo '<a href="' . Config::read ('siteUrlRoot') . 'admin/' . $userUri . 'piece/delete/' . $piece->Id . '" title="Delete">' . self::icon ('delete', TRUE) . '</a>';
        echo '</td>';
        // End row and check for subpages
        echo '</tr>';
      }
      echo '</tbody>';
      echo '</table>';
    }
  }

  public static function drawUserTable ($users) {
    if (empty ($users)) {
      echo '<p>No users</p>';
    }
    else {
      echo '<table>';
      echo '<tbody>';
      echo '<tr><th>Avatar</th><th>Username</th><th>Controls</th></tr>';
      foreach ($users as $user) {
        // Page table row
        echo '<tr class="' . Tools::toggleClass () . '">';
        echo '<td>';
        FrontHelper::getUserAvatar ($user->Filename);
        echo '</td>';
        echo '<td class="title">' . $user->Username . '</td>';
        // Controls
        echo '<td class="controls2">';
        echo '<a href="' . Config::read ('siteUrlRoot') . 'admin/user/view/' . $user->Id . '" title="View">' . self::icon ('view', TRUE) . '</a>';
        echo '<a href="' . Config::read ('siteUrlRoot') . 'admin/user/edit/' . $user->Id . '" title="Edit">' . self::icon ('edit', TRUE) . '</a>';
        echo '</td>';
        // End row and check for subpages
        echo '</tr>';
      }
      echo '</tbody>';
      echo '</table>';
    }
  }

  public static function drawCommentTable ($piece, $comments) {
    if (empty ($comments)) {
      echo '<p>No comments.</p>';
    }
    else {
      echo '<table>';
      echo '<tbody>';
      echo '<tr><th>User</th><th>Comment</th><th>Date</th><th>Controls</th></tr>';
      foreach ($comments as $comment) {
        // Page table row
        echo '<tr class="' . Tools::toggleClass () . '">';
        echo '<td class="title"><a href="/admin/user/view/' . $comment->User->Id . '">' . $comment->User->Username . '</a></td>';
        echo '<td>' . $comment->Content . '</td>';
        echo '<td>' . $comment->Created . '</td>';
        // Controls
        echo '<td class="controls2">';
        echo '<a href="' . Config::read ('siteUrlRoot') . 'admin/piece/' . $piece->Id . '/comment/edit/' . $comment->Id . '" title="Edit">' . self::icon ('edit', TRUE) . '</a>';
        echo '<a href="' . Config::read ('siteUrlRoot') . 'admin/piece/' . $piece->Id . '/comment/delete/' . $comment->Id . '" title="Delete">' . self::icon ('delete', TRUE) . '</a>';
        echo '</td>';
        // End row and check for subpages
        echo '</tr>';
      }
      echo '</tbody>';
      echo '</table>';
    }
  }

  public static function drawPostTable ($project, $posts) {
    if (empty ($posts)) {
      echo '<p>No posts.</p>';
    }
    else {
      echo '<table>';
      echo '<tbody>';
      echo '<tr><th>Title</th><th>Published</th><th>Publish date</th><th>Created</th><th>Controls</th></tr>';
      foreach ($posts as $post) {
        // Page table row
        echo '<tr class="' . Tools::toggleClass () . '">';
        echo '<td class="title">' . $post->Title . '</td>';
        echo '<td>' . ($post->IsPublished ? '<strong style="color:darkGreen;">Published' : '<strong>Not published') . '</strong></td>';
        echo '<td>' . $post->PublishDate . '</td>';
        echo '<td>' . $post->Created . '</td>';
        // Controls
        echo '<td class="controls2">';
        echo '<a href="' . Config::read ('siteUrlRoot') . 'admin/project/' . $project->Id . '/post/edit/' . $post->Id . '" title="Edit">' . self::icon ('edit', TRUE) . '</a>';
        echo '<a href="' . Config::read ('siteUrlRoot') . 'admin/project/' . $project->Id . '/post/delete/' . $post->Id . '" title="Delete">' . self::icon ('delete', TRUE) . '</a>';
        echo '</td>';
        // End row and check for subpages
        echo '</tr>';
      }
      echo '</tbody>';
      echo '</table>';
    }
  }

  public static function drawSponsorTable ($project, $sponsors) {
    if (empty ($sponsors)) {
      echo '<p>Project sponsors</p>';
    }
    else {
      echo '<table>';
      echo '<tbody>';
      echo '<tr><th>Name</th><th>Type</th><th>Controls</th></tr>';
      foreach ($sponsors as $sponsors) {
        // Page table row
        echo '<tr class="' . Tools::toggleClass () . '">';
        echo '<td class="title">' . $sponsors->Title . '</td>';
        echo '<td>' . $sponsors->Type->Name . '</td>';
        // Controls
        echo '<td class="controls2">';
        echo '<a href="' . Config::read ('siteUrlRoot') . 'admin/project/' . $project->Id . '/sponsor/edit/' . $sponsors->Id . '" title="Edit">' . self::icon ('edit', TRUE) . '</a>';
        echo '<a href="' . Config::read ('siteUrlRoot') . 'admin/project/' . $project->Id . '/sponsor/delete/' . $sponsors->Id . '" title="Delete">' . self::icon ('delete', TRUE) . '</a>';
        echo '</td>';
        // End row and check for subpages
        echo '</tr>';
      }
      echo '</tbody>';
      echo '</table>';
    }
  }

}

?>