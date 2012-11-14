<?php

// Core configuration

Config::write ('options', TRUE);
Config::write ('debug', 2);
Config::write ('cache', TRUE);

error_reporting (Config::read ('debug') ? -1 : 0);
ini_set ('display_errors', Config::read ('debug') ? 1 : 0);
ini_set ('log_errors', 1);
ini_set ('error_log', Config::read ('sitepath') . 'error_log.txt');

Config::write ('optionsDelimiter', '!');

Config::write ('siteDomain', 'hns.local');
Config::write ('siteUrl', 'http://' . Config::read ('siteDomain'));
Config::write ('siteUrlRoot', Config::read ('siteUrl') . '/');
Config::write ('siteUrlRootNoLang', Config::read ('siteUrlRoot'));

Config::write ('helpersPath', Config::read ('sitePath') . 'app/helpers/');
Config::write ('managersPath', Config::read ('sitePath') . 'app/view/managers/');
Config::write ('controllersPath', Config::read ('sitePath') . 'app/controllers/');
Config::write ('repositoriesPath', Config::read ('sitePath') . 'app/model/repositories/');
Config::write ('factoriesPath', Config::read ('sitePath') . 'app/model/factories/');
Config::write ('modelsPath', Config::read ('sitePath') . 'app/model/factories/');
Config::write ('templatesPath', Config::read ('sitePath') . 'app/view/templates/');
Config::write ('vendorsPath', Config::read ('sitePath') . 'app/vendors/');
Config::write ('localesPath', Config::read ('sitePath') . 'app/locales/');
Config::write ('elementsPath', Config::read ('sitePath') . 'app/view/elements/');
Config::write ('elementsCachePath', Config::read ('sitePath') . 'app/view/elements/cache/');

// I18N & language configuration
Config::write ('supportedLangs', array ('hrv', 'eng'));
Config::write ('defaultLang', 'hrv');
Config::write ('lang', Config::read ('defaultLang'));
Config::write ('langNames', array (
    'eng' => 'English',
    'hrv' => 'Hrvatski',
    'deu' => 'Deutsch'
    )
);
Config::write ('langNamesEnglish', array (
    'eng' => 'English',
    'hrv' => 'Croatian',
    'deu' => 'German'
    )
);
Config::write ('langMeta', array (
    'eng' => 'en',
    'hrv' => 'hr',
    'deu' => 'de'
    )
);

// Default database configuration
Config::write ('dbprefix', 'hns_');
Config::write ('dbhost', 'localhost');
Config::write ('dbname', 'hns');
Config::write ('dbuser', 'root');
Config::write ('dbpass', '');
