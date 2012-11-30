<?php

class UserManager {

  public static function registerUser ($data) {
    $userRepository = new UserRepository ();
    $user = $userRepository->addUser ($data);
    if ($user !== FALSE) {
      Mailer::sendActivationEmail ($user);
      return TRUE;
    }
    return FALSE;
  }

  public static function activateUser ($userId, $userPasswordHash) {
    $userRepository = new UserRepository ();
    $user = $userRepository->getUser (array ('userId' => $userId));
    if ($user && $user->getPassword () == $userPasswordHash && !$user->getIsActive) {
      return $userRepository->activateUser ($user->getId ());
    }
    return FALSE;
  }

  public static function logoutUser () {
    unset ($_SESSION['user']);
    return TRUE;
  }

  public static function loginUser ($username, $password) {
    $userRepository = new UserRepository ();
    if (empty ($username) || empty ($password)) {
      return FALSE;
    }
    $user = $userRepository->getUser (array ('username' => $username, 'password' => $password));
    if ($user) {
      $_SESSION['user'] = $user;
      return TRUE;
    }
    return FALSE;
  }

  /**
   * Get logged user
   * @param boolean $force If TRUE will force refresh for data tored in session
   * @return User Logged user
   */
  public static function getLoggedUser ($force = FALSE) {
    if (isset ($_SESSION['user'])) {
      if ($force) {
        $userRepository = new UserRepository ();
        return $userRepository->getUser (array ('userId' => $_SESSION['user']->getId ()));
      }
      return $_SESSION['user'];
    }
    return NULL;
  }

  /**
   * Function returns the current visitor
   *
   * Function check if a visitor exists and is known to the application by checking the cookies. If
   * there is no cookie, a new visitor is created if needed, the cookie stored and the new visitor returned.
   * Otherwise, the known visitor is returned.
   *
   * @param boolean $newVisitor If TRUE will create a new visitor
   * @return Visitor Current visitor, or a new one if there is no current visitor.
   */
  public static function getCurrentVisitor ($newVisitor = FALSE) {
    $userRepository = new UserRepository ();
    $encrypted = Tools::getCookie ('visitor');
    if ($encrypted) {
      $visitorId = Encryption::decrypt ($encrypted);
      return $userRepository->getVisitor (array ('visitorId' => $visitorId));
    }
    else {
      $visitor = NULL;
      if ($newVisitor) {
        $visitor = $userRepository->addVisitor ();
        Tools::setCookie ('visitor', Encryption::encrypt ($visitor->getId ()));
      }
      return $visitor;
    }
  }

}

?>
