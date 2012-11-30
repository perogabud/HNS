<?php

class UserRoleController extends Controller {

  public function __construct () {
    $this->_repository = new UserRoleRepository ();
  }

  public function getUserRoleById ($userRoleId) {
    return $this->_repository->getUserRole (array ('userRoleId' => $userRoleId));
  }

  public function getUserRoles (
    $orderBy = NULL,
    $orderDirection = NULL,
    $iteration = NULL,
    $limit = NULL,
    $filterParams = NULL
  ) {
    return $this->_repository->getUserRoles (
      array (
        'orderBy' => $orderBy,
        'orderDirection' => $orderDirection,
        'iteration' => $iteration,
        'limit' => $limit,
        'filterParams' => $filterParams
      )
    );
  }

  public function getUserRolesByParams (array $params = array ()) {
    return $this->_repository->getUserRoles ($params);
  }

  public function getUserRoleCount ($filterParams = NULL) {
    return $this->_repository->getUserRoleCount (
      array (
        'filterParams' => $filterParams
      )
    );
  }
}

?>