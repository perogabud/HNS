<?php

class Factory {

  /*public static function getPage (&$dataArrays = array ()) {
    $config['rootUrl'] = Config::read ('siteUrlRoot');
    $config['uriSeparator'] = Config::read ('uriSeparator');
    $dataLang = array();
    $data = array();
    // Get non-language data
    foreach ($dataArrays[0] as $name => $value) {
      if (!in_array ($name, Page::getLanguageFields ())) {
        $data[$name] = $value;
      }
    }
    // Get language data
    foreach ($dataArrays as $array) {
      if (key_exists ('languageId', $array) && in_array ($array['languageId'], Config::read ('supportedLangs'))) {
        foreach ($array as $name => &$value) {
          if (in_array ($name, Page::getLanguageFields ())) {
            $dataLang[$array['languageId']][$name] = $value;
          }
        }
      }
    }
    $page = new Page ($data, $dataLang, $config);
    return $page;
  }

  public static function getPages (&$results = array ()) {
    $pages = array ();
    if (!empty ($results)) {
      $pageId = NULL;
      $pageData = array ();
      foreach ($results as $result) {
        if ($result['pageId'] != $pageId) {
          if (!is_null ($pageId)) {
            $pages[] = self::getPage ($pageData);
            $pageData = array ();
          }
        }
        $pageData[] = $result;
        $pageId = $result['pageId'];
      }
      $pages[] = self::getPage ($pageData);
    }
    return $pages;
  }*/

  public static function getAddress (&$data = array ()) {
    $config['rootUrl'] = Config::read ('siteUrlRoot');
    $config['uriSeparator'] = Config::read ('uriSeparator');
    $address = new Address ($data, $config);
    return $address;
  }

  public static function getAddresss (&$data = array ()) {
    $config['rootUrl'] = Config::read ('siteUrlRoot');
    $config['uriSeparator'] = Config::read ('uriSeparator');
    $addresss = array ();
    foreach ($data as $row) {
      $addresss[] = new Address ($row, $config);
    }
    return $addresss;
  }

  public static function getPainting (&$data = array ()) {
    $config['rootUrl'] = Config::read ('siteUrlRoot');
    $config['uriSeparator'] = Config::read ('uriSeparator');
    $painting = new Painting ($data, $config);
    return $painting;
  }

  public static function getPaintings (&$data = array ()) {
    $config['rootUrl'] = Config::read ('siteUrlRoot');
    $config['uriSeparator'] = Config::read ('uriSeparator');
    $paintings = array ();
    foreach ($data as $row) {
      $paintings[] = new Painting ($row, $config);
    }
    return $paintings;
  }

  public static function getPaintingImage (&$data = array ()) {
    $config['rootUrl'] = Config::read ('siteUrlRoot');
    $config['uriSeparator'] = Config::read ('uriSeparator');
    $paintingImage = new PaintingImage ($data, $config);
    return $paintingImage;
  }

  public static function getPaintingImages (&$data = array ()) {
    $config['rootUrl'] = Config::read ('siteUrlRoot');
    $config['uriSeparator'] = Config::read ('uriSeparator');
    $paintingImages = array ();
    foreach ($data as $row) {
      $paintingImages[] = new PaintingImage ($row, $config);
    }
    return $paintingImages;
  }

  public static function getCommentary (&$data = array ()) {
    $config['rootUrl'] = Config::read ('siteUrlRoot');
    $config['uriSeparator'] = Config::read ('uriSeparator');
    $commentary = new Commentary ($data, $config);
    return $commentary;
  }

  public static function getCommentarys (&$data = array ()) {
    $config['rootUrl'] = Config::read ('siteUrlRoot');
    $config['uriSeparator'] = Config::read ('uriSeparator');
    $commentarys = array ();
    foreach ($data as $row) {
      $commentarys[] = new Commentary ($row, $config);
    }
    return $commentarys;
  }

  public static function getCommentaryThumbnail (&$data = array ()) {
    $config['rootUrl'] = Config::read ('siteUrlRoot');
    $config['uriSeparator'] = Config::read ('uriSeparator');
    $commentaryThumbnail = new CommentaryThumbnail ($data, $config);
    return $commentaryThumbnail;
  }

  public static function getCommentaryThumbnails (&$data = array ()) {
    $config['rootUrl'] = Config::read ('siteUrlRoot');
    $config['uriSeparator'] = Config::read ('uriSeparator');
    $commentaryThumbnails = array ();
    foreach ($data as $row) {
      $commentaryThumbnails[] = new CommentaryThumbnail ($row, $config);
    }
    return $commentaryThumbnails;
  }

  public static function getCommentaryAudioFile (&$data = array ()) {
    $config['rootUrl'] = Config::read ('siteUrlRoot');
    $config['uriSeparator'] = Config::read ('uriSeparator');
    $commentaryAudioFile = new CommentaryAudioFile ($data, $config);
    return $commentaryAudioFile;
  }

  public static function getCommentaryAudioFiles (&$data = array ()) {
    $config['rootUrl'] = Config::read ('siteUrlRoot');
    $config['uriSeparator'] = Config::read ('uriSeparator');
    $commentaryAudioFiles = array ();
    foreach ($data as $row) {
      $commentaryAudioFiles[] = new CommentaryAudioFile ($row, $config);
    }
    return $commentaryAudioFiles;
  }

  public static function getCommentaryVideoFileMp4 (&$data = array ()) {
    $config['rootUrl'] = Config::read ('siteUrlRoot');
    $config['uriSeparator'] = Config::read ('uriSeparator');
    $commentaryVideoFileMp4 = new CommentaryVideoFileMp4 ($data, $config);
    return $commentaryVideoFileMp4;
  }

  public static function getCommentaryVideoFileMp4s (&$data = array ()) {
    $config['rootUrl'] = Config::read ('siteUrlRoot');
    $config['uriSeparator'] = Config::read ('uriSeparator');
    $commentaryVideoFileMp4s = array ();
    foreach ($data as $row) {
      $commentaryVideoFileMp4s[] = new CommentaryVideoFileMp4 ($row, $config);
    }
    return $commentaryVideoFileMp4s;
  }

  public static function getSet (&$data = array ()) {
    $config['rootUrl'] = Config::read ('siteUrlRoot');
    $config['uriSeparator'] = Config::read ('uriSeparator');
    $set = new Set ($data, $config);
    return $set;
  }

  public static function getSets (&$data = array ()) {
    $config['rootUrl'] = Config::read ('siteUrlRoot');
    $config['uriSeparator'] = Config::read ('uriSeparator');
    $sets = array ();
    foreach ($data as $row) {
      $sets[] = new Set ($row, $config);
    }
    return $sets;
  }

  public static function getTag (&$data = array ()) {
    $config['rootUrl'] = Config::read ('siteUrlRoot');
    $config['uriSeparator'] = Config::read ('uriSeparator');
    $tag = new Tag ($data, $config);
    return $tag;
  }

  public static function getTags (&$data = array ()) {
    $config['rootUrl'] = Config::read ('siteUrlRoot');
    $config['uriSeparator'] = Config::read ('uriSeparator');
    $tags = array ();
    foreach ($data as $row) {
      $tags[] = new Tag ($row, $config);
    }
    return $tags;
  }

  public static function getEvent (&$data = array ()) {
    $config['rootUrl'] = Config::read ('siteUrlRoot');
    $config['uriSeparator'] = Config::read ('uriSeparator');
    $event = new Event ($data, $config);
    return $event;
  }

  public static function getEvents (&$data = array ()) {
    $config['rootUrl'] = Config::read ('siteUrlRoot');
    $config['uriSeparator'] = Config::read ('uriSeparator');
    $events = array ();
    foreach ($data as $row) {
      $events[] = new Event ($row, $config);
    }
    return $events;
  }

  public static function getEventImage (&$data = array ()) {
    $config['rootUrl'] = Config::read ('siteUrlRoot');
    $config['uriSeparator'] = Config::read ('uriSeparator');
    $eventImage = new EventImage ($data, $config);
    return $eventImage;
  }

  public static function getEventImages (&$data = array ()) {
    $config['rootUrl'] = Config::read ('siteUrlRoot');
    $config['uriSeparator'] = Config::read ('uriSeparator');
    $eventImages = array ();
    foreach ($data as $row) {
      $eventImages[] = new EventImage ($row, $config);
    }
    return $eventImages;
  }

  public static function getPressRelease (&$data = array ()) {
    $config['rootUrl'] = Config::read ('siteUrlRoot');
    $config['uriSeparator'] = Config::read ('uriSeparator');
    $pressRelease = new PressRelease ($data, $config);
    return $pressRelease;
  }

  public static function getPressReleases (&$data = array ()) {
    $config['rootUrl'] = Config::read ('siteUrlRoot');
    $config['uriSeparator'] = Config::read ('uriSeparator');
    $pressReleases = array ();
    foreach ($data as $row) {
      $pressReleases[] = new PressRelease ($row, $config);
    }
    return $pressReleases;
  }

  public static function getPressReleaseImage (&$data = array ()) {
    $config['rootUrl'] = Config::read ('siteUrlRoot');
    $config['uriSeparator'] = Config::read ('uriSeparator');
    $pressReleaseImage = new PressReleaseImage ($data, $config);
    return $pressReleaseImage;
  }

  public static function getPressReleaseImages (&$data = array ()) {
    $config['rootUrl'] = Config::read ('siteUrlRoot');
    $config['uriSeparator'] = Config::read ('uriSeparator');
    $pressReleaseImages = array ();
    foreach ($data as $row) {
      $pressReleaseImages[] = new PressReleaseImage ($row, $config);
    }
    return $pressReleaseImages;
  }

  public static function getPressReleaseFile (&$data = array ()) {
    $config['rootUrl'] = Config::read ('siteUrlRoot');
    $config['uriSeparator'] = Config::read ('uriSeparator');
    $pressReleaseFile = new PressReleaseFile ($data, $config);
    return $pressReleaseFile;
  }

  public static function getPressReleaseFiles (&$data = array ()) {
    $config['rootUrl'] = Config::read ('siteUrlRoot');
    $config['uriSeparator'] = Config::read ('uriSeparator');
    $pressReleaseFiles = array ();
    foreach ($data as $row) {
      $pressReleaseFiles[] = new PressReleaseFile ($row, $config);
    }
    return $pressReleaseFiles;
  }

  public static function getUser (&$data = array ()) {
    $config['rootUrl'] = Config::read ('siteUrlRoot');
    $config['uriSeparator'] = Config::read ('uriSeparator');
    $user = new User ($data, $config);
    return $user;
  }

  public static function getUsers (&$data = array ()) {
    $config['rootUrl'] = Config::read ('siteUrlRoot');
    $config['uriSeparator'] = Config::read ('uriSeparator');
    $users = array ();
    foreach ($data as $row) {
      $users[] = new User ($row, $config);
    }
    return $users;
  }

  public static function getUserRole (&$data = array ()) {
    $config['rootUrl'] = Config::read ('siteUrlRoot');
    $config['uriSeparator'] = Config::read ('uriSeparator');
    $userRole = new UserRole ($data, $config);
    return $userRole;
  }

  public static function getUserRoles (&$data = array ()) {
    $config['rootUrl'] = Config::read ('siteUrlRoot');
    $config['uriSeparator'] = Config::read ('uriSeparator');
    $userRoles = array ();
    foreach ($data as $row) {
      $userRoles[] = new UserRole ($row, $config);
    }
    return $userRoles;
  }

  public static function getPage (&$dataArrays = array ()) {
    $config['rootUrl'] = Config::read ('siteUrlRoot');
    $config['uriSeparator'] = Config::read ('uriSeparator');
    $dataLang = array();
    $data = array();
    // Get non-language data
    foreach ($dataArrays[0] as $name => $value) {
      if (!in_array ($name, Page::getLanguageFields ())) {
        $data[$name] = $value;
      }
    }
    // Get language data
    foreach ($dataArrays as $array) {
      if (key_exists ('languageId', $array) && in_array ($array['languageId'], Config::read ('supportedLangs'))) {
        foreach ($array as $name => &$value) {
          if (in_array ($name, Page::getLanguageFields ())) {
            $dataLang[$array['languageId']][$name] = $value;
          }
        }
      }
    }
    $page = new Page ($data, $dataLang, $config);
    return $page;
  }

  public static function getPages (&$results = array ()) {
    $pages = array ();
    if (!empty ($results)) {
      $pageId = NULL;
      $pageData = array ();
      foreach ($results as $result) {
        if ($result['pageId'] != $pageId) {
          if (!is_null ($pageId)) {
            $pages[] = self::getPage ($pageData);
            $pageData = array ();
          }
        }
        $pageData[] = $result;
        $pageId = $result['pageId'];
      }
      $pages[] = self::getPage ($pageData);
    }
    return $pages;
  }

  public static function getTimeline (&$data = array ()) {
    $config['rootUrl'] = Config::read ('siteUrlRoot');
    $config['uriSeparator'] = Config::read ('uriSeparator');
    $timeline = new Timeline ($data, $config);
    return $timeline;
  }

  public static function getTimelines (&$data = array ()) {
    $config['rootUrl'] = Config::read ('siteUrlRoot');
    $config['uriSeparator'] = Config::read ('uriSeparator');
    $timelines = array ();
    foreach ($data as $row) {
      $timelines[] = new Timeline ($row, $config);
    }
    return $timelines;
  }

  public static function getTimelineImages (&$data = array ()) {
    $config['rootUrl'] = Config::read ('siteUrlRoot');
    $config['uriSeparator'] = Config::read ('uriSeparator');
    $timelineImages = new TimelineImages ($data, $config);
    return $timelineImages;
  }

  public static function getTimelineImagess (&$data = array ()) {
    $config['rootUrl'] = Config::read ('siteUrlRoot');
    $config['uriSeparator'] = Config::read ('uriSeparator');
    $timelineImagess = array ();
    foreach ($data as $row) {
      $timelineImagess[] = new TimelineImages ($row, $config);
    }
    return $timelineImagess;
  }

  public static function getSize (&$data = array ()) {
    $config['rootUrl'] = Config::read ('siteUrlRoot');
    $config['uriSeparator'] = Config::read ('uriSeparator');
    $size = new Size ($data, $config);
    return $size;
  }

  public static function getSizes (&$data = array ()) {
    $config['rootUrl'] = Config::read ('siteUrlRoot');
    $config['uriSeparator'] = Config::read ('uriSeparator');
    $sizes = array ();
    foreach ($data as $row) {
      $sizes[] = new Size ($row, $config);
    }
    return $sizes;
  }

  public static function getFrame (&$data = array ()) {
    $config['rootUrl'] = Config::read ('siteUrlRoot');
    $config['uriSeparator'] = Config::read ('uriSeparator');
    $frame = new Frame ($data, $config);
    return $frame;
  }

  public static function getFrames (&$data = array ()) {
    $config['rootUrl'] = Config::read ('siteUrlRoot');
    $config['uriSeparator'] = Config::read ('uriSeparator');
    $frames = array ();
    foreach ($data as $row) {
      $frames[] = new Frame ($row, $config);
    }
    return $frames;
  }

  public static function getCoupon (&$data = array ()) {
    $config['rootUrl'] = Config::read ('siteUrlRoot');
    $config['uriSeparator'] = Config::read ('uriSeparator');
    $coupon = new Coupon ($data, $config);
    return $coupon;
  }

  public static function getCoupons (&$data = array ()) {
    $config['rootUrl'] = Config::read ('siteUrlRoot');
    $config['uriSeparator'] = Config::read ('uriSeparator');
    $coupons = array ();
    foreach ($data as $row) {
      $coupons[] = new Coupon ($row, $config);
    }
    return $coupons;
  }

  public static function getMusic (&$data = array ()) {
    $config['rootUrl'] = Config::read ('siteUrlRoot');
    $config['uriSeparator'] = Config::read ('uriSeparator');
    $music = new Music ($data, $config);
    return $music;
  }

  public static function getMusics (&$data = array ()) {
    $config['rootUrl'] = Config::read ('siteUrlRoot');
    $config['uriSeparator'] = Config::read ('uriSeparator');
    $musics = array ();
    foreach ($data as $row) {
      $musics[] = new Music ($row, $config);
    }
    return $musics;
  }

  public static function getMusicFile (&$data = array ()) {
    $config['rootUrl'] = Config::read ('siteUrlRoot');
    $config['uriSeparator'] = Config::read ('uriSeparator');
    $musicFile = new MusicFile ($data, $config);
    return $musicFile;
  }

  public static function getMusicFiles (&$data = array ()) {
    $config['rootUrl'] = Config::read ('siteUrlRoot');
    $config['uriSeparator'] = Config::read ('uriSeparator');
    $musicFiles = array ();
    foreach ($data as $row) {
      $musicFiles[] = new MusicFile ($row, $config);
    }
    return $musicFiles;
  }

  public static function getOrder (&$data = array ()) {
    $config['rootUrl'] = Config::read ('siteUrlRoot');
    $config['uriSeparator'] = Config::read ('uriSeparator');
    $order = new Order ($data, $config);
    return $order;
  }

  public static function getOrders (&$data = array ()) {
    $config['rootUrl'] = Config::read ('siteUrlRoot');
    $config['uriSeparator'] = Config::read ('uriSeparator');
    $orders = array ();
    foreach ($data as $row) {
      $orders[] = new Order ($row, $config);
    }
    return $orders;
  }

  public static function getCountry (&$data = array ()) {
    $config['rootUrl'] = Config::read ('siteUrlRoot');
    $config['uriSeparator'] = Config::read ('uriSeparator');
    $country = new Country ($data, $config);
    return $country;
  }

  public static function getCountrys (&$data = array ()) {
    $config['rootUrl'] = Config::read ('siteUrlRoot');
    $config['uriSeparator'] = Config::read ('uriSeparator');
    $countrys = array ();
    foreach ($data as $row) {
      $countrys[] = new Country ($row, $config);
    }
    return $countrys;
  }

}
?>