<?php

class BannerController extends Controller {

  public function __construct () {
    $this->_repository = new BannerRepository ();
  }

  public function getBannerById ($bannerId) {
    return $this->_repository->getBanner (array ('bannerId' => $bannerId));
  }

  public function getBanners (
    $orderBy = NULL,
    $orderDirection = NULL,
    $iteration = NULL,
    $limit = NULL,
    $filterParams = NULL
  ) {
    return $this->_repository->getBanners (
      array (
        'orderBy' => $orderBy,
        'orderDirection' => $orderDirection,
        'iteration' => $iteration,
        'limit' => $limit,
        'filterParams' => $filterParams
      )
    );
  }

  public function getBannersByParams (array $params = array ()) {
    return $this->_repository->getBanners ($params);
  }

  public function getBannerCount ($filterParams = NULL) {
    return $this->_repository->getBannerCount (
      array (
        'filterParams' => $filterParams
      )
    );
  }
}

?>