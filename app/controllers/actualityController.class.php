<?php

class ActualityController extends Controller {

  public function __construct () {
    $this->_repository = new ActualityRepository ();
  }

  public function getActualityById ($actualityId) {
    return $this->_repository->getActuality (array ('actualityId' => $actualityId));
  }

  public function getActualityBySlug ($slug) {
    return $this->_repository->getActuality (array ('slug' => $slug));
  }

  public function getActualitys (
    $orderBy = NULL,
    $orderDirection = NULL,
    $iteration = NULL,
    $limit = NULL,
    $filterParams = NULL
  ) {
    return $this->_repository->getActualitys (
      array (
        'orderBy' => $orderBy,
        'orderDirection' => $orderDirection,
        'iteration' => $iteration,
        'limit' => $limit,
        'filterParams' => $filterParams
      )
    );
  }

  public function getActualitysByParams (array $params = array ()) {
    return $this->_repository->getActualitys ($params);
  }

  public function getActualityCount ($filterParams = NULL) {
    return $this->_repository->getActualityCount (
      array (
        'filterParams' => $filterParams
      )
    );
  }
}

?>