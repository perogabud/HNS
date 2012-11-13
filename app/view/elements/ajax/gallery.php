<?php

$galleryData = array ();

$realGallery = array ();
foreach ($paintings as $painting) {
  $realGallery[] = array (
    'type' => 'image',
    'url' => $painting->ThumbnailUrl,
    'height' => Config::read ('paintingImageThumbnailDimensions', 'height'),
    'width' => $painting->ThumbnailWidth,
    'id' => $painting->Id,
    'title' => $painting->Title,
    'link' => $painting->Url,
    'year' => date ('Y', strtotime ($painting->CreationDate))
  );
}

switch ($galleryId) {
  case '5':
    $galleryData = $realGallery;
    break;
  default:
    die;
}

header('Content-type: application/json');
shuffle ($galleryData);
echo json_encode ($galleryData);

?>
