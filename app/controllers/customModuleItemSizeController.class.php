<?php

class CustomModuleItemSizeController extends Controller {

  public function __construct () {
    $this->_repository = new CustomModuleItemSizeRepository ();
  }

  public function getCustomModuleItemSizeById ($customModuleItemSizeId) {
    return $this->_repository->getCustomModuleItemSize (array ('customModuleItemSizeId' => $customModuleItemSizeId));
  }

  public function getCustomModuleItemSizes (
    $orderBy = NULL,
    $orderDirection = NULL,
    $iteration = NULL,
    $limit = NULL,
    $filterParams = NULL
  ) {
    return $this->_repository->getCustomModuleItemSizes (
      array (
        'orderBy' => $orderBy,
        'orderDirection' => $orderDirection,
        'iteration' => $iteration,
        'limit' => $limit,
        'filterParams' => $filterParams
      )
    );
  }

  public function getCustomModuleItemSizesByParams (array $params = array ()) {
    return $this->_repository->getCustomModuleItemSizes ($params);
  }

  public function getCustomModuleItemSizeCount ($filterParams = NULL) {
    return $this->_repository->getCustomModuleItemSizeCount (
      array (
        'filterParams' => $filterParams
      )
    );
  }
}

?>