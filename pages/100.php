<?php
  session_start();
  
  // Unset all of the session variables.
  $_SESSION = array();
  
  // If it's desired to kill the session, also delete the session cookie.
  // Note: This will destroy the session, and not just the session data!
  if (isset($_COOKIE[session_name()])) {
      setcookie(session_name(), '', time() - 42000, '/');
  }
  
  // Finally, destroy the session.
  session_destroy();
  
  // phew!  
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
  <meta http-equiv="content-type" content="text/html; charset=windows-1250">
  <link type="text/css" href="../style.css" rel="stylesheet"/>
  </head>
  <body  class="body">
      <br/>
      <br/>
      <center>
      You are now logged out!
      </center>
  </body>
</html>
