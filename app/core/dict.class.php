<?php

class Dict {

  static $strings = array (
    // Content translations
    'title_infoCenter' => array (
      'deu' => '',
      'eng' => 'Info Center',
      'hrv' => 'Info centar'
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