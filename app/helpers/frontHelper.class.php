<?php

class FrontHelper {

  public static function printNavigation ($pages, $params) {
    echo '<ul class="mainNav">';
    $activePage = NULL;
    if ($pages) foreach ($pages as $page) {
      if ($page->getSlug () === $params[0]) {
        $activePage = $page;
        echo '<li class="active">';
        if (count ($params) > 1) {
          echo '<a href="'. $page->getUrl () .'">'. $page->getNavigationName () .'</a>';
        }
        else {
          echo '<span>'. $page->getNavigationName () .'</span>';
        }
        echo '</li>';
      }
      else {
        echo '<li><a href="'. $page->getUrl () .'">'. $page->getNavigationName () .'</a></li>';
      }
    }
    echo '</ul>';
    if ($activePage) {
      echo '<ul class="subNav">';
      if ($activePage->getSubpages ()) foreach ($activePage->getSubpages () as $page) {
        if (count($params) > 1 && $page->getSlug () === $params[1]) {
          echo '<li class="active">';
          echo '<span>'. $page->getNavigationName () .'</span>';
          echo '</li>';
        }
        else {
          echo '<li><a href="'. $page->getUrl () .'">'. $page->getNavigationName () .'</a></li>';
        }
      }
      echo '</ul>';
    }
  }

  public static function printSets (array $sets) {
    $_sets = array ();
    foreach ($sets as $set) {
      $_sets[] = '<a href="/gallery#set:' . $set->getId () . ':' . $set->getSlug () . '">'.$set->getName ().'</a>';
    }
    echo implode (', ', $_sets);
  }

  public static function printTags (array $tags) {
    $_tags = array ();
    foreach ($tags as $tag) {
      $_tags[] = '<a href="/gallery#tag:' . $tag->getId () . ':' . $tag->getSlug () . '">'.$tag->getName ().'</a>';
    }
    echo implode (', ', $_tags);
  }

}

?>