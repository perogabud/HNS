<?php

class VideoController extends Controller {

  public function __construct () {
    $this->_repository = new VideoRepository ();
  }

  public function getVideoById ($videoId) {
    return $this->_repository->getVideo (array ('videoId' => $videoId));
  }

  public function getVideos (
    $orderBy = NULL,
    $orderDirection = NULL,
    $iteration = NULL,
    $limit = NULL,
    $filterParams = NULL
  ) {
    return $this->_repository->getVideos (
      array (
        'orderBy' => $orderBy,
        'orderDirection' => $orderDirection,
        'iteration' => $iteration,
        'limit' => $limit,
        'filterParams' => $filterParams
      )
    );
  }

  public function getVideosByParams (array $params = array ()) {
    return $this->_repository->getVideos ($params);
  }

  public function getVideoCount ($filterParams = NULL) {
    return $this->_repository->getVideoCount (
      array (
        'filterParams' => $filterParams
      )
    );
  }
  public function getVideoBySlug ($slug) {
    return $this->_repository->getVideo (array ('slug' => $slug));
  }
}

?>