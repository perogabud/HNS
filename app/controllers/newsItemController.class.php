<?php

class NewsItemController extends Controller {

  public function __construct () {
    $this->_repository = new NewsItemRepository ();
  }

  public function getNewsItemById ($newsItemId) {
    return $this->_repository->getNewsItem (array ('newsItemId' => $newsItemId));
  }

  public function getNewsItemBySlug ($slug) {
    return $this->_repository->getNewsItem (array ('slug' => $slug));
  }

  public function getNewsItems (
    $orderBy = NULL,
    $orderDirection = NULL,
    $iteration = NULL,
    $limit = NULL,
    $filterParams = NULL
  ) {
    return $this->_repository->getNewsItems (
      array (
        'orderBy' => $orderBy,
        'orderDirection' => $orderDirection,
        'iteration' => $iteration,
        'limit' => $limit,
        'filterParams' => $filterParams
      )
    );
  }

  public function getNewsItemsByParams (array $params = array ()) {
    return $this->_repository->getNewsItems ($params);
  }

  public function getNewsItemCount ($filterParams = NULL) {
    return $this->_repository->getNewsItemCount (
      array (
        'filterParams' => $filterParams
      )
    );
  }
}

?>