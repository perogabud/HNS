<?php

class GalleryController extends Controller {

  public function __construct () {
    $this->_repository = new GalleryRepository ();
  }

  public function getGalleryById ($galleryId) {
    return $this->_repository->getGallery (array ('galleryId' => $galleryId));
  }

  public function getGallerys (
    $orderBy = NULL,
    $orderDirection = NULL,
    $iteration = NULL,
    $limit = NULL,
    $filterParams = NULL
  ) {
    return $this->_repository->getGallerys (
      array (
        'orderBy' => $orderBy,
        'orderDirection' => $orderDirection,
        'iteration' => $iteration,
        'limit' => $limit,
        'filterParams' => $filterParams
      )
    );
  }

  public function getGallerysByParams (array $params = array ()) {
    return $this->_repository->getGallerys ($params);
  }

  public function getGalleryCount ($filterParams = NULL) {
    return $this->_repository->getGalleryCount (
      array (
        'filterParams' => $filterParams
      )
    );
  }
  public function getGalleryBySlug ($slug) {
    return $this->_repository->getGallery (array ('slug' => $slug));
  }
}

?>