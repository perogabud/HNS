<?php

$galleryData = array ();


$galleryData[] = array (
  'type' => 'event',
  'id' => 1,
  'image' => array (
    'url' => '/img/painting/image/thumbnail/tv7elq3f7twl8szcpx7nbwu15ztcpuf6.jpg',
    'width' => 131,
    'height' => 164
  ),
  'event' => array (
    'url' => 'test',
    'height' => Config::read ('paintingImageThumbnailDimensions', 'height'),

    'link' => 'test',
    'type' => 'Exibition',
    'title' => 'La colombiana con Abanico',
    'date' => 'November 14, 2012 / 20:00 h',
    'location' => 'Clarendon Fine Art, London'
  ),
);
$galleryData[] = array (
  'type' => 'event',
  'id' => 2,
  'event' => array (
    'url' => 'test',
    'height' => Config::read ('paintingImageThumbnailDimensions', 'height'),

    'link' => 'test',
    'type' => 'Exibition',
    'title' => 'La colombiana con Abanico',
    'date' => 'November 14, 2012 / 20:00 h',
    'location' => 'Clarendon Fine Art, London'
  ),
);
$galleryData[] = array (
  'type' => 'event',
  'id' => 3,
  'image' => array (
    'url' => '/img/painting/image/thumbnail/tv7elq3f7twl8szcpx7nbwu15ztcpuf6.jpg',
    'width' => 131,
    'height' => 164
  ),
  'event' => array (
    'url' => 'test',
    'height' => Config::read ('paintingImageThumbnailDimensions', 'height'),

    'link' => 'test',
    'type' => 'Exibition',
    'title' => 'La colombiana con Abanico',
    'date' => 'November 14, 2012 / 20:00 h',
    'location' => 'Clarendon Fine Art, London'
  ),
);
$galleryData[] = array (
  'type' => 'event',
  'id' => 4,
  'image' => array (
    'url' => '/img/painting/image/thumbnail/tv7elq3f7twl8szcpx7nbwu15ztcpuf6.jpg',
    'width' => 131,
    'height' => 164
  ),
  'event' => array (
    'url' => 'test',
    'height' => Config::read ('paintingImageThumbnailDimensions', 'height'),

    'link' => 'test',
    'type' => 'Exibition',
    'title' => 'La colombiana con Abanico',
    'date' => 'November 14, 2012 / 20:00 h',
    'location' => 'Clarendon Fine Art, London'
  ),
);
$galleryData[] = array (
  'type' => 'event',
  'id' => 5,
  'event' => array (
    'url' => 'test',
    'height' => Config::read ('paintingImageThumbnailDimensions', 'height'),

    'link' => 'test',
    'type' => 'Exibition',
    'title' => 'La colombiana con Abanico',
    'date' => 'November 14, 2012 / 20:00 h',
    'location' => 'Clarendon Fine Art, London'
  ),
);

header('Content-type: application/json');
echo json_encode ($galleryData);

?>
