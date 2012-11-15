<?php

// App configuration

Config::write ('iterationLimit', 20);
Config::write ('iterationLimitSide', 10);

Config::write ('uriSeparator', ':');
Config::write ('galleryImagePath', Config::read ('sitePath') . 'img/gallery/image/');
Config::write ('galleryImageDimensions', array ('width' => 719, 'height' => 429));

Config::write ('galleryImageLargeThumbnailPath', Config::read ('sitePath') . 'img/gallery/image/largeThumbnail/');
Config::write ('galleryImageLargeThumbnailDimensions', array ('width' => 300, 'height' => 200));

Config::write ('galleryImageSmallThumbnailPath', Config::read ('sitePath') . 'img/gallery/image/smallThumbnail/');
Config::write ('galleryImageSmallThumbnailDimensions', array ('width' => 79, 'height' => 79));

Config::write ('bannerImagePath', Config::read ('sitePath') . 'img/banner/image/');
Config::write ('bannerImageDimensions', array ('width' => 119, 'height' => 119));

Config::write ('newsItemCoverImagePath', Config::read ('sitePath') . 'img/newsItem/coverImage/');
Config::write ('newsItemCoverImageDimensions', array ('width' => 729, 'height' => 429));

Config::write ('newsItemCoverImageLargeThumbnailPath', Config::read ('sitePath') . 'img/newsItem/coverImage/largeThumbnail/');
Config::write ('newsItemCoverImageLargeThumbnailDimensions', array ('width' => 300, 'height' => 200));

Config::write ('newsItemCoverImageSmallThumbnailPath', Config::read ('sitePath') . 'img/newsItem/coverImage/smallThumbnail/');
Config::write ('newsItemCoverImageSmallThumbnailDimensions', array ('width' => 79, 'height' => 79));

Config::write ('pageCoverImagePath', Config::read ('sitePath') . 'img/page/coverImage/');
Config::write ('pageCoverImageDimensions', array ('width' => 719, 'height' => 429));

Config::write ('pageCoverImageLargeThumbnailPath', Config::read ('sitePath') . 'img/page/coverImage/largeThumbnail/');
Config::write ('pageCoverImageLargeThumbnailDimensions', array ('width' => 300, 'height' => 200));

Config::write ('pageCoverImageSmallThumbnailPath', Config::read ('sitePath') . 'img/page/coverImage/smallThumbnail/');
Config::write ('pageCoverImageSmallThumbnailDimensions', array ('width' => 79, 'height' => 79));

Config::write ('actualityCoverImagePath', Config::read ('sitePath') . 'img/actuality/coverImage/');
Config::write ('actualityCoverImageDimensions', array ('width' => 719, 'height' => 429));

Config::write ('actualityCoverImageLargeThumbnailPath', Config::read ('sitePath') . 'img/actuality/coverImage/largeThumbnail/');
Config::write ('actualityCoverImageLargeThumbnailDimensions', array ('width' => 300, 'height' => 200));

Config::write ('actualityCoverImageSmallThumbnailPath', Config::read ('sitePath') . 'img/actuality/coverImage/smallThumbnail/');
Config::write ('actualityCoverImageSmallThumbnailDimensions', array ('width' => 79, 'height' => 79));

