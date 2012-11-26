<?php

class MemberController extends Controller {

  public function __construct () {
    $this->_repository = new MemberRepository ();
  }

  public function getMemberById ($memberId) {
    return $this->_repository->getMember (array ('memberId' => $memberId));
  }

  public function getMembers (
    $orderBy = NULL,
    $orderDirection = NULL,
    $iteration = NULL,
    $limit = NULL,
    $filterParams = NULL
  ) {
    return $this->_repository->getMembers (
      array (
        'orderBy' => $orderBy,
        'orderDirection' => $orderDirection,
        'iteration' => $iteration,
        'limit' => $limit,
        'filterParams' => $filterParams
      )
    );
  }

  public function getMembersByParams (array $params = array ()) {
    return $this->_repository->getMembers ($params);
  }

  public function getMemberCount ($filterParams = NULL) {
    return $this->_repository->getMemberCount (
      array (
        'filterParams' => $filterParams
      )
    );
  }
  public function getMemberBySlug ($slug) {
    return $this->_repository->getMember (array ('slug' => $slug));
  }
}

?>