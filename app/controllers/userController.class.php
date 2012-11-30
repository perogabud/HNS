<?php

class UserController extends Controller {

  public function __construct () {
    $this->_repository = new UserRepository ();
  }

  public function getUserById ($userId) {
    return $this->_repository->getUser (array ('userId' => $userId));
  }

  public function getUsers (
    $orderBy = NULL,
    $orderDirection = NULL,
    $iteration = NULL,
    $limit = NULL,
    $filterParams = NULL
  ) {
    return $this->_repository->getUsers (
      array (
        'orderBy' => $orderBy,
        'orderDirection' => $orderDirection,
        'iteration' => $iteration,
        'limit' => $limit,
        'filterParams' => $filterParams
      )
    );
  }

  public function getUsersByParams (array $params = array ()) {
    return $this->_repository->getUsers ($params);
  }

  public function getUserCount ($filterParams = NULL) {
    return $this->_repository->getUserCount (
      array (
        'filterParams' => $filterParams
      )
    );
  }
  public function login ($username, $password) {
    return UserManager::loginUser ($username, $password);
  }

  public function logout () {
    return UserManager::logoutUser ();
  }

  public function getLoggedUser () {
    return UserManager::getLoggedUser ();
  }
}

?>