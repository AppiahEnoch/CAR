<?php
// start session
session_start();

// check if index.php is opened
if(basename($_SERVER['PHP_SELF']) === 'index.php') {

  // unset all session variables
  $_SESSION = array();

  // destroy session
  session_destroy();

  // unset session cookie
  if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
  }
}


