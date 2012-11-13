<?php

class AjaxContentManager extends ContentManager {

  public function route () {

    $this->_setTemplate ('ajax');

    // Parse parameters
    switch ($this->params[0]) {

      /*
       * AJAX
       */
      case 'ajax':
        if ($this->_checkParams (3)) {
          switch ($this->params[1]) {
            /*
             * TEMP
             * Initial Gallery
             */
            case 'gallery':
              $paintingController = PaintingController::getInstance ();
              $paintings = $paintingController->getPaintingsByParams ();
              $this->_setData (array ('paintings' => $paintings));
              $this->_setElements (
                array (
                  'mainContent' => array (
                    'filename' => 'ajax/gallery',
                    'data' => array (
                      'galleryId' => $this->params[2],
                      'paintings' => $paintings
                    )
                  )
                )
              );
              break;
            /*
             * Set Gallery.
             */
            case 'set':
              $setController = SetController::getInstance ();
              $set = $setController->getSetById ($this->params[2]);
              if ($set) {
                $paintings = $set->getPaintings ();
                $this->_setElements (
                  array (
                    'mainContent' => array (
                      'filename' => 'ajax/paintings',
                      'data' => array (
                        'paintings' => $paintings,
                        'set' => $set
                      )
                    )
                  )
                );
              }
              break;

            /*
             * Tag Gallery.
             */
            case 'tag':
              $tagController = TagController::getInstance ();
              $tag = $tagController->getTagById ($this->params[2]);
              if ($tag) {
                $paintings = $tag->getPaintings ();
                $this->_setElements (
                  array (
                    'mainContent' => array (
                      'filename' => 'ajax/paintings',
                      'data' => array (
                        'paintings' => $paintings,
                        'tag' => $tag
                      )
                    )
                  )
                );
              }
              break;

            /*
             * Year Gallery.
             */
            case 'year':
              $paintingController = PaintingController::getInstance ();
              $paintings = $paintingController->getPaintingsByParams (array ('year' => $this->params[2]));
              if ($paintings) {
                $this->_setElements (
                  array (
                    'mainContent' => array (
                      'filename' => 'ajax/paintings',
                      'data' => array (
                        'paintings' => $paintings,
                        'year' => $this->params[2]
                      )
                    )
                  )
                );
              }
              break;

            case 'events':
              if (TRUE) {
                $this->_setElements (
                  array (
                    'mainContent' => array (
                      'filename' => 'ajax/events',
                      'data' => array (
                        /*'paintings' => $paintings,*/
                      )
                    )
                  )
                );
              }
              break;

          }
        }
        break;
    }
  }

}

?>
