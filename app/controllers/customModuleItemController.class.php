<?php

class CustomModuleItemController extends Controller {

  public function __construct () {
    $this->_repository = new CustomModuleItemRepository ();
  }

  public function getCustomModuleItemById ($customModuleItemId) {
    return $this->_repository->getCustomModuleItem (array ('customModuleItemId' => $customModuleItemId));
  }

  public function getCustomModuleItems (
    $orderBy = NULL,
    $orderDirection = NULL,
    $iteration = NULL,
    $limit = NULL,
    $filterParams = NULL
  ) {
    return $this->_repository->getCustomModuleItems (
      array (
        'orderBy' => $orderBy,
        'orderDirection' => $orderDirection,
        'iteration' => $iteration,
        'limit' => $limit,
        'filterParams' => $filterParams
      )
    );
  }

  public function getCustomModuleItemsByParams (array $params = array ()) {
    return $this->_repository->getCustomModuleItems ($params);
  }

  public function getCustomModuleItemCount ($filterParams = NULL) {
    return $this->_repository->getCustomModuleItemCount (
      array (
        'filterParams' => $filterParams
      )
    );
  }
}

?>