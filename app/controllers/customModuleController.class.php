<?php

class CustomModuleController extends Controller {

  public function __construct () {
    $this->_repository = new CustomModuleRepository ();
  }

  public function getCustomModuleById ($customModuleId) {
    return $this->_repository->getCustomModule (array ('customModuleId' => $customModuleId));
  }

  public function getCustomModules (
    $orderBy = NULL,
    $orderDirection = NULL,
    $iteration = NULL,
    $limit = NULL,
    $filterParams = NULL
  ) {
    return $this->_repository->getCustomModules (
      array (
        'orderBy' => $orderBy,
        'orderDirection' => $orderDirection,
        'iteration' => $iteration,
        'limit' => $limit,
        'filterParams' => $filterParams
      )
    );
  }

  public function getCustomModulesByParams (array $params = array ()) {
    return $this->_repository->getCustomModules ($params);
  }

  public function getCustomModuleCount ($filterParams = NULL) {
    return $this->_repository->getCustomModuleCount (
      array (
        'filterParams' => $filterParams
      )
    );
  }
}

?>