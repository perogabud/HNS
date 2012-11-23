<?php

class CustomModuleTextController extends Controller {

  public function __construct () {
    $this->_repository = new CustomModuleTextRepository ();
  }

  public function getCustomModuleTextById ($customModuleTextId) {
    return $this->_repository->getCustomModuleText (array ('customModuleTextId' => $customModuleTextId));
  }

  public function getCustomModuleTexts (
    $orderBy = NULL,
    $orderDirection = NULL,
    $iteration = NULL,
    $limit = NULL,
    $filterParams = NULL
  ) {
    return $this->_repository->getCustomModuleTexts (
      array (
        'orderBy' => $orderBy,
        'orderDirection' => $orderDirection,
        'iteration' => $iteration,
        'limit' => $limit,
        'filterParams' => $filterParams
      )
    );
  }

  public function getCustomModuleTextsByParams (array $params = array ()) {
    return $this->_repository->getCustomModuleTexts ($params);
  }

  public function getCustomModuleTextCount ($filterParams = NULL) {
    return $this->_repository->getCustomModuleTextCount (
      array (
        'filterParams' => $filterParams
      )
    );
  }
}

?>