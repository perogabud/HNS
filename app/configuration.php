<?php

// App configuration

Config::write ('iterationLimit', 10);
Config::write ('iterationLimitSide', 10);

Config::write ('uriSeparator', ':');
Config::write ('galleryImagePath', Config::read ('sitePath') . 'img/gallery/image/');
Config::write ('galleryImageDimensions', array ('width' => 720, 'height' => 430));

Config::write ('galleryImageLargeThumbnailPath', Config::read ('sitePath') . 'img/gallery/image/largeThumbnail/');
Config::write ('galleryImageLargeThumbnailDimensions', array ('width' => 300, 'height' => 200));

Config::write ('galleryImageSmallThumbnailPath', Config::read ('sitePath') . 'img/gallery/image/smallThumbnail/');
Config::write ('galleryImageSmallThumbnailDimensions', array ('width' => 80, 'height' => 80));

Config::write ('bannerImagePath', Config::read ('sitePath') . 'img/banner/image/');
Config::write ('bannerImageDimensions', array ('width' => 120, 'height' => 120));

