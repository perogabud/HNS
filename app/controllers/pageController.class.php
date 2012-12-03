<?php

class PageController extends Controller {

  public function __construct () {
    $this->_repository = new PageRepository ();
  }

  public function getPageById ($pageId) {
    return $this->_repository->getPage (array ('pageId' => $pageId));
  }

  public function getPages (
    $orderBy = NULL,
    $orderDirection = NULL,
    $iteration = NULL,
    $limit = NULL,
    $filterParams = NULL
  ) {
    return $this->_repository->getPages (
      array (
        'orderBy' => $orderBy,
        'orderDirection' => $orderDirection,
        'iteration' => $iteration,
        'limit' => $limit,
        'filterParams' => $filterParams
      )
    );
  }

  public function getPagesByParams (array $params = array ()) {
    return $this->_repository->getPages ($params);
  }

  public function getPageCount ($filterParams = NULL) {
    return $this->_repository->getPageCount (
      array (
        'filterParams' => $filterParams
      )
    );
  }
  public function getPageBySlug ($slug) {
    return $this->_repository->getPage (array ('slug' => $slug));
  }
}

?>