<?php

class MemberCategoryController extends Controller {

  public function __construct () {
    $this->_repository = new MemberCategoryRepository ();
  }

  public function getMemberCategoryById ($memberCategoryId) {
    return $this->_repository->getMemberCategory (array ('memberCategoryId' => $memberCategoryId));
  }

  public function getMemberCategorys (
    $orderBy = NULL,
    $orderDirection = NULL,
    $iteration = NULL,
    $limit = NULL,
    $filterParams = NULL
  ) {
    return $this->_repository->getMemberCategorys (
      array (
        'orderBy' => $orderBy,
        'orderDirection' => $orderDirection,
        'iteration' => $iteration,
        'limit' => $limit,
        'filterParams' => $filterParams
      )
    );
  }

  public function getMemberCategorysByParams (array $params = array ()) {
    return $this->_repository->getMemberCategorys ($params);
  }

  public function getMemberCategoryCount ($filterParams = NULL) {
    return $this->_repository->getMemberCategoryCount (
      array (
        'filterParams' => $filterParams
      )
    );
  }
  public function getMemberCategoryBySlug ($slug) {
    return $this->_repository->getMemberCategory (array ('slug' => $slug));
  }
}

?>