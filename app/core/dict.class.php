<?php

class Dict {

  static $strings = array (
    // Content translations
    'title_infoCenter' => array (
      'deu' => '',
      'eng' => 'Info Center',
      'hrv' => 'Info centar'
    ),
    'title_news' => array (
      'deu' => '',
      'eng' => 'News',
      'hrv' => 'Novosti'
    ),
    'title_actualities' => array (
      'deu' => '',
      'eng' => 'Actualities',
      'hrv' => 'Aktualnosti'
    ),
    'title_galleries' => array (
      'deu' => '',
      'eng' => 'Gallery',
      'hrv' => 'Galerija'
    ),
    'title_videos' => array (
      'deu' => '',
      'eng' => 'HSN TV',
      'hrv' => 'HNS TV'
    ),

    'text_youCanAlsoTry' => array (
      'deu' => 'Probieren Sie auch dies...',
      'eng' => 'You can also try...',
      'hrv' => 'Možete probati...'
    ),

    // Framework exceptions translations
    'slug_infoCenter' => array (
      'deu' => '',
      'eng' => 'info-center',
      'hrv' => 'info-centar'
    ),
    'slug_news' => array (
      'deu' => '',
      'eng' => 'news',
      'hrv' => 'novosti'
    ),
    'slug_actualities' => array (
      'deu' => '',
      'eng' => 'actualities',
      'hrv' => 'aktualnosti'
    ),
    'slug_galleries' => array (
      'deu' => '',
      'eng' => 'gallery',
      'hrv' => 'galerija'
    ),
    'slug_videos' => array (
      'deu' => '',
      'eng' => 'hns-tv',
      'hrv' => 'hns-tv'
    ),
    'slug_selections' => array (
      'deu' => '',
      'eng' => '',
      'hrv' => 'selekcije'
    ),
    'slug_ARepresentation' => array (
      'deu' => '',
      'eng' => '',
      'hrv' => 'a-reprezentacija'
    )

  );

  static public function read ($key, $lang = NULL) {
    if (is_null ($lang)) {
      $lang = Config::read ('lang');
    }
    if (isset (self::$strings[$key][$lang])) {
      return self::$strings[$key][$lang];
    }
    else {
      return $key;
    }
  }

}
?>