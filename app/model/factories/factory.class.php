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

  public static function getNewsItem (&$data = array ()) {
    $config['rootUrl'] = Config::read ('siteUrlRoot');
    $config['uriSeparator'] = Config::read ('uriSeparator');
    $newsItem = new NewsItem ($data, $config);
    return $newsItem;
  }

  public static function getNewsItems (&$data = array ()) {
    $config['rootUrl'] = Config::read ('siteUrlRoot');
    $config['uriSeparator'] = Config::read ('uriSeparator');
    $newsItems = array ();
    foreach ($data as $row) {
      $newsItems[] = new NewsItem ($row, $config);
    }
    return $newsItems;
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

  public static function getActuality (&$data = array ()) {
    $config['rootUrl'] = Config::read ('siteUrlRoot');
    $config['uriSeparator'] = Config::read ('uriSeparator');
    $actuality = new Actuality ($data, $config);
    return $actuality;
  }

  public static function getActualitys (&$data = array ()) {
    $config['rootUrl'] = Config::read ('siteUrlRoot');
    $config['uriSeparator'] = Config::read ('uriSeparator');
    $actualitys = array ();
    foreach ($data as $row) {
      $actualitys[] = new Actuality ($row, $config);
    }
    return $actualitys;
  }

  public static function getVideo (&$dataArrays = array ()) {
    $config['rootUrl'] = Config::read ('siteUrlRoot');
    $config['uriSeparator'] = Config::read ('uriSeparator');
    $dataLang = array();
    $data = array();
    // Get non-language data
    foreach ($dataArrays[0] as $name => $value) {
      if (!in_array ($name, Video::getLanguageFields ())) {
        $data[$name] = $value;
      }
    }
    // Get language data
    foreach ($dataArrays as $array) {
      if (key_exists ('languageId', $array) && in_array ($array['languageId'], Config::read ('supportedLangs'))) {
        foreach ($array as $name => &$value) {
          if (in_array ($name, Video::getLanguageFields ())) {
            $dataLang[$array['languageId']][$name] = $value;
          }
        }
      }
    }
    $video = new Video ($data, $dataLang, $config);
    return $video;
  }

  public static function getVideos (&$results = array ()) {
    $videos = array ();
    if (!empty ($results)) {
      $videoId = NULL;
      $videoData = array ();
      foreach ($results as $result) {
        if ($result['videoId'] != $videoId) {
          if (!is_null ($videoId)) {
            $videos[] = self::getVideo ($videoData);
            $videoData = array ();
          }
        }
        $videoData[] = $result;
        $videoId = $result['videoId'];
      }
      $videos[] = self::getVideo ($videoData);
    }
    return $videos;
  }

  public static function getGallery (&$dataArrays = array ()) {
    $config['rootUrl'] = Config::read ('siteUrlRoot');
    $config['uriSeparator'] = Config::read ('uriSeparator');
    $dataLang = array();
    $data = array();
    // Get non-language data
    foreach ($dataArrays[0] as $name => $value) {
      if (!in_array ($name, Gallery::getLanguageFields ())) {
        $data[$name] = $value;
      }
    }
    // Get language data
    foreach ($dataArrays as $array) {
      if (key_exists ('languageId', $array) && in_array ($array['languageId'], Config::read ('supportedLangs'))) {
        foreach ($array as $name => &$value) {
          if (in_array ($name, Gallery::getLanguageFields ())) {
            $dataLang[$array['languageId']][$name] = $value;
          }
        }
      }
    }
    $gallery = new Gallery ($data, $dataLang, $config);
    return $gallery;
  }

  public static function getGallerys (&$results = array ()) {
    $gallerys = array ();
    if (!empty ($results)) {
      $galleryId = NULL;
      $galleryData = array ();
      foreach ($results as $result) {
        if ($result['galleryId'] != $galleryId) {
          if (!is_null ($galleryId)) {
            $gallerys[] = self::getGallery ($galleryData);
            $galleryData = array ();
          }
        }
        $galleryData[] = $result;
        $galleryId = $result['galleryId'];
      }
      $gallerys[] = self::getGallery ($galleryData);
    }
    return $gallerys;
  }

  public static function getGalleryImage (&$data = array ()) {
    $config['rootUrl'] = Config::read ('siteUrlRoot');
    $config['uriSeparator'] = Config::read ('uriSeparator');
    $galleryImage = new GalleryImage ($data, $config);
    return $galleryImage;
  }

  public static function getGalleryImages (&$data = array ()) {
    $config['rootUrl'] = Config::read ('siteUrlRoot');
    $config['uriSeparator'] = Config::read ('uriSeparator');
    $galleryImages = array ();
    foreach ($data as $row) {
      $galleryImages[] = new GalleryImage ($row, $config);
    }
    return $galleryImages;
  }

  public static function getBanner (&$data = array ()) {
    $config['rootUrl'] = Config::read ('siteUrlRoot');
    $config['uriSeparator'] = Config::read ('uriSeparator');
    $banner = new Banner ($data, $config);
    return $banner;
  }

  public static function getBanners (&$data = array ()) {
    $config['rootUrl'] = Config::read ('siteUrlRoot');
    $config['uriSeparator'] = Config::read ('uriSeparator');
    $banners = array ();
    foreach ($data as $row) {
      $banners[] = new Banner ($row, $config);
    }
    return $banners;
  }

  public static function getBannerImage (&$data = array ()) {
    $config['rootUrl'] = Config::read ('siteUrlRoot');
    $config['uriSeparator'] = Config::read ('uriSeparator');
    $bannerImage = new BannerImage ($data, $config);
    return $bannerImage;
  }

  public static function getBannerImages (&$data = array ()) {
    $config['rootUrl'] = Config::read ('siteUrlRoot');
    $config['uriSeparator'] = Config::read ('uriSeparator');
    $bannerImages = array ();
    foreach ($data as $row) {
      $bannerImages[] = new BannerImage ($row, $config);
    }
    return $bannerImages;
  }

}
?>