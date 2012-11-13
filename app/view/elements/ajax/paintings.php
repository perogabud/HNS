<?php

$galleryData = array ();
$urlAdjust = NULL;
if (isset ($set)) {
  $urlAdjust = $set;
}
else if (isset ($tag)) {
  $urlAdjust = $tag;
}
else if (isset ($year)) {
  $urlAdjust = $year;
}

foreach ($paintings as $painting) {
$galleryData[] = array (
    'type' => 'image',
    'url' => $painting->ThumbnailUrl,
    'height' => Config::read ('paintingImageThumbnailDimensions', 'height'),
    'width' => $painting->ThumbnailWidth,
    'id' => $painting->Id,
    'link' => $painting->getUrl ($urlAdjust),
    'title' => $painting->Title,
    'year' => date ('Y', strtotime ($painting->CreationDate))
  );
}

header('Content-type: application/json');
echo json_encode ($galleryData);

?>
