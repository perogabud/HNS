<?php

class CustomModuleImageController extends Controller {

  public function __construct () {
    $this->_repository = new CustomModuleImageRepository ();
  }

  public function getCustomModuleImageById ($customModuleImageId) {
    return $this->_repository->getCustomModuleImage (array ('customModuleImageId' => $customModuleImageId));
  }

  public function getCustomModuleImages (
    $orderBy = NULL,
    $orderDirection = NULL,
    $iteration = NULL,
    $limit = NULL,
    $filterParams = NULL
  ) {
    return $this->_repository->getCustomModuleImages (
      array (
        'orderBy' => $orderBy,
        'orderDirection' => $orderDirection,
        'iteration' => $iteration,
        'limit' => $limit,
        'filterParams' => $filterParams
      )
    );
  }

  public function getCustomModuleImagesByParams (array $params = array ()) {
    return $this->_repository->getCustomModuleImages ($params);
  }

  public function getCustomModuleImageCount ($filterParams = NULL) {
    return $this->_repository->getCustomModuleImageCount (
      array (
        'filterParams' => $filterParams
      )
    );
  }
}

?>