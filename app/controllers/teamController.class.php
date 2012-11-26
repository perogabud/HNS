<?php

class TeamController extends Controller {

  public function __construct () {
    $this->_repository = new TeamRepository ();
  }

  public function getTeamById ($teamId) {
    return $this->_repository->getTeam (array ('teamId' => $teamId));
  }

  public function getTeams (
    $orderBy = NULL,
    $orderDirection = NULL,
    $iteration = NULL,
    $limit = NULL,
    $filterParams = NULL
  ) {
    return $this->_repository->getTeams (
      array (
        'orderBy' => $orderBy,
        'orderDirection' => $orderDirection,
        'iteration' => $iteration,
        'limit' => $limit,
        'filterParams' => $filterParams
      )
    );
  }

  public function getTeamsByParams (array $params = array ()) {
    return $this->_repository->getTeams ($params);
  }

  public function getTeamCount ($filterParams = NULL) {
    return $this->_repository->getTeamCount (
      array (
        'filterParams' => $filterParams
      )
    );
  }
  public function getTeamBySlug ($slug) {
    return $this->_repository->getTeam (array ('slug' => $slug));
  }
}

?>