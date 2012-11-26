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

  public static function getNewsItemCoverImage (&$data = array ()) {
    $config['rootUrl'] = Config::read ('siteUrlRoot');
    $config['uriSeparator'] = Config::read ('uriSeparator');
    $newsItemCoverImage = new NewsItemCoverImage ($data, $config);
    return $newsItemCoverImage;
  }

  public static function getNewsItemCoverImages (&$data = array ()) {
    $config['rootUrl'] = Config::read ('siteUrlRoot');
    $config['uriSeparator'] = Config::read ('uriSeparator');
    $newsItemCoverImages = array ();
    foreach ($data as $row) {
      $newsItemCoverImages[] = new NewsItemCoverImage ($row, $config);
    }
    return $newsItemCoverImages;
  }

  public static function getLanguage (&$data = array ()) {
    $language = new Language ($data);
    return $language;
  }

  public static function getLanguages (&$data = array ()) {
    $languages = array ();
    foreach ($data as $row) {
      $languages[] = new Language ($row);
    }
    return $languages;
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

  public static function getPageCoverImage (&$data = array ()) {
    $config['rootUrl'] = Config::read ('siteUrlRoot');
    $config['uriSeparator'] = Config::read ('uriSeparator');
    $pageCoverImage = new PageCoverImage ($data, $config);
    return $pageCoverImage;
  }

  public static function getPageCoverImages (&$data = array ()) {
    $config['rootUrl'] = Config::read ('siteUrlRoot');
    $config['uriSeparator'] = Config::read ('uriSeparator');
    $pageCoverImages = array ();
    foreach ($data as $row) {
      $pageCoverImages[] = new PageCoverImage ($row, $config);
    }
    return $pageCoverImages;
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

  public static function getActualityCoverImage (&$data = array ()) {
    $config['rootUrl'] = Config::read ('siteUrlRoot');
    $config['uriSeparator'] = Config::read ('uriSeparator');
    $actualityCoverImage = new ActualityCoverImage ($data, $config);
    return $actualityCoverImage;
  }

  public static function getActualityCoverImages (&$data = array ()) {
    $config['rootUrl'] = Config::read ('siteUrlRoot');
    $config['uriSeparator'] = Config::read ('uriSeparator');
    $actualityCoverImages = array ();
    foreach ($data as $row) {
      $actualityCoverImages[] = new ActualityCoverImage ($row, $config);
    }
    return $actualityCoverImages;
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

  public static function getCustomModule (&$data = array ()) {
    $config['rootUrl'] = Config::read ('siteUrlRoot');
    $config['uriSeparator'] = Config::read ('uriSeparator');
    $customModule = new CustomModule ($data, $config);
    return $customModule;
  }

  public static function getCustomModules (&$data = array ()) {
    $config['rootUrl'] = Config::read ('siteUrlRoot');
    $config['uriSeparator'] = Config::read ('uriSeparator');
    $customModules = array ();
    foreach ($data as $row) {
      $customModules[] = new CustomModule ($row, $config);
    }
    return $customModules;
  }

  public static function getCustomModuleItem (&$data = array ()) {
    $config['rootUrl'] = Config::read ('siteUrlRoot');
    $config['uriSeparator'] = Config::read ('uriSeparator');
    $customModuleItem = new CustomModuleItem ($data, $config);
    return $customModuleItem;
  }

  public static function getCustomModuleItems (&$data = array ()) {
    $config['rootUrl'] = Config::read ('siteUrlRoot');
    $config['uriSeparator'] = Config::read ('uriSeparator');
    $customModuleItems = array ();
    foreach ($data as $row) {
      $customModuleItems[] = new CustomModuleItem ($row, $config);
    }
    return $customModuleItems;
  }

  public static function getCustomModuleItemSize (&$data = array ()) {
    $config['rootUrl'] = Config::read ('siteUrlRoot');
    $config['uriSeparator'] = Config::read ('uriSeparator');
    $customModuleItemSize = new CustomModuleItemSize ($data, $config);
    return $customModuleItemSize;
  }

  public static function getCustomModuleItemSizes (&$data = array ()) {
    $config['rootUrl'] = Config::read ('siteUrlRoot');
    $config['uriSeparator'] = Config::read ('uriSeparator');
    $customModuleItemSizes = array ();
    foreach ($data as $row) {
      $customModuleItemSizes[] = new CustomModuleItemSize ($row, $config);
    }
    return $customModuleItemSizes;
  }

  public static function getCustomModuleImage (&$data = array ()) {
    $config['rootUrl'] = Config::read ('siteUrlRoot');
    $config['uriSeparator'] = Config::read ('uriSeparator');
    $customModuleImage = new CustomModuleImage ($data, $config);
    return $customModuleImage;
  }

  public static function getCustomModuleImages (&$data = array ()) {
    $config['rootUrl'] = Config::read ('siteUrlRoot');
    $config['uriSeparator'] = Config::read ('uriSeparator');
    $customModuleImages = array ();
    foreach ($data as $row) {
      $customModuleImages[] = new CustomModuleImage ($row, $config);
    }
    return $customModuleImages;
  }

  public static function getCustomModuleImageImage (&$data = array ()) {
    $config['rootUrl'] = Config::read ('siteUrlRoot');
    $config['uriSeparator'] = Config::read ('uriSeparator');
    $customModuleImageImage = new CustomModuleImageImage ($data, $config);
    return $customModuleImageImage;
  }

  public static function getCustomModuleImageImages (&$data = array ()) {
    $config['rootUrl'] = Config::read ('siteUrlRoot');
    $config['uriSeparator'] = Config::read ('uriSeparator');
    $customModuleImageImages = array ();
    foreach ($data as $row) {
      $customModuleImageImages[] = new CustomModuleImageImage ($row, $config);
    }
    return $customModuleImageImages;
  }

  public static function getCustomModuleText (&$data = array ()) {
    $config['rootUrl'] = Config::read ('siteUrlRoot');
    $config['uriSeparator'] = Config::read ('uriSeparator');
    $customModuleText = new CustomModuleText ($data, $config);
    return $customModuleText;
  }

  public static function getCustomModuleTexts (&$data = array ()) {
    $config['rootUrl'] = Config::read ('siteUrlRoot');
    $config['uriSeparator'] = Config::read ('uriSeparator');
    $customModuleTexts = array ();
    foreach ($data as $row) {
      $customModuleTexts[] = new CustomModuleText ($row, $config);
    }
    return $customModuleTexts;
  }

  public static function getTeam (&$dataArrays = array ()) {
    $config['rootUrl'] = Config::read ('siteUrlRoot');
    $config['uriSeparator'] = Config::read ('uriSeparator');
    $dataLang = array();
    $data = array();
    // Get non-language data
    foreach ($dataArrays[0] as $name => $value) {
      if (!in_array ($name, Team::getLanguageFields ())) {
        $data[$name] = $value;
      }
    }
    // Get language data
    foreach ($dataArrays as $array) {
      if (key_exists ('languageId', $array) && in_array ($array['languageId'], Config::read ('supportedLangs'))) {
        foreach ($array as $name => &$value) {
          if (in_array ($name, Team::getLanguageFields ())) {
            $dataLang[$array['languageId']][$name] = $value;
          }
        }
      }
    }
    $team = new Team ($data, $dataLang, $config);
    return $team;
  }

  public static function getTeams (&$results = array ()) {
    $teams = array ();
    if (!empty ($results)) {
      $teamId = NULL;
      $teamData = array ();
      foreach ($results as $result) {
        if ($result['teamId'] != $teamId) {
          if (!is_null ($teamId)) {
            $teams[] = self::getTeam ($teamData);
            $teamData = array ();
          }
        }
        $teamData[] = $result;
        $teamId = $result['teamId'];
      }
      $teams[] = self::getTeam ($teamData);
    }
    return $teams;
  }

  public static function getMember (&$dataArrays = array ()) {
    $config['rootUrl'] = Config::read ('siteUrlRoot');
    $config['uriSeparator'] = Config::read ('uriSeparator');
    $dataLang = array();
    $data = array();
    // Get non-language data
    foreach ($dataArrays[0] as $name => $value) {
      if (!in_array ($name, Member::getLanguageFields ())) {
        $data[$name] = $value;
      }
    }
    // Get language data
    foreach ($dataArrays as $array) {
      if (key_exists ('languageId', $array) && in_array ($array['languageId'], Config::read ('supportedLangs'))) {
        foreach ($array as $name => &$value) {
          if (in_array ($name, Member::getLanguageFields ())) {
            $dataLang[$array['languageId']][$name] = $value;
          }
        }
      }
    }
    $member = new Member ($data, $dataLang, $config);
    return $member;
  }

  public static function getMembers (&$results = array ()) {
    $members = array ();
    if (!empty ($results)) {
      $memberId = NULL;
      $memberData = array ();
      foreach ($results as $result) {
        if ($result['memberId'] != $memberId) {
          if (!is_null ($memberId)) {
            $members[] = self::getMember ($memberData);
            $memberData = array ();
          }
        }
        $memberData[] = $result;
        $memberId = $result['memberId'];
      }
      $members[] = self::getMember ($memberData);
    }
    return $members;
  }

  public static function getMemberImage (&$data = array ()) {
    $config['rootUrl'] = Config::read ('siteUrlRoot');
    $config['uriSeparator'] = Config::read ('uriSeparator');
    $memberImage = new MemberImage ($data, $config);
    return $memberImage;
  }

  public static function getMemberImages (&$data = array ()) {
    $config['rootUrl'] = Config::read ('siteUrlRoot');
    $config['uriSeparator'] = Config::read ('uriSeparator');
    $memberImages = array ();
    foreach ($data as $row) {
      $memberImages[] = new MemberImage ($row, $config);
    }
    return $memberImages;
  }

  public static function getMemberCategory (&$dataArrays = array ()) {
    $config['rootUrl'] = Config::read ('siteUrlRoot');
    $config['uriSeparator'] = Config::read ('uriSeparator');
    $dataLang = array();
    $data = array();
    // Get non-language data
    foreach ($dataArrays[0] as $name => $value) {
      if (!in_array ($name, MemberCategory::getLanguageFields ())) {
        $data[$name] = $value;
      }
    }
    // Get language data
    foreach ($dataArrays as $array) {
      if (key_exists ('languageId', $array) && in_array ($array['languageId'], Config::read ('supportedLangs'))) {
        foreach ($array as $name => &$value) {
          if (in_array ($name, MemberCategory::getLanguageFields ())) {
            $dataLang[$array['languageId']][$name] = $value;
          }
        }
      }
    }
    $memberCategory = new MemberCategory ($data, $dataLang, $config);
    return $memberCategory;
  }

  public static function getMemberCategorys (&$results = array ()) {
    $memberCategorys = array ();
    if (!empty ($results)) {
      $memberCategoryId = NULL;
      $memberCategoryData = array ();
      foreach ($results as $result) {
        if ($result['memberCategoryId'] != $memberCategoryId) {
          if (!is_null ($memberCategoryId)) {
            $memberCategorys[] = self::getMemberCategory ($memberCategoryData);
            $memberCategoryData = array ();
          }
        }
        $memberCategoryData[] = $result;
        $memberCategoryId = $result['memberCategoryId'];
      }
      $memberCategorys[] = self::getMemberCategory ($memberCategoryData);
    }
    return $memberCategorys;
  }

}
?>