<?php
  session_start();

  echo "<!DOCTYPE html>\n<html><head>";

  require_once 'functions.php';

  $userstr = ' (Guest)';

  if (isset($_SESSION['user']))
  {
    $user     = $_SESSION['user'];
    $loggedin = TRUE;
    $userstr  = " ($user)";
  }
  else $loggedin = FALSE;

  echo "<title>$appname$userstr</title>"                     .
       "<link rel='stylesheet' type='text/css' href='/css/bootstrap.min.css'>".
       "<link rel='stylesheet' type='text/css' href='/css/bootstrap-theme.min.css'>".
       "<link rel='stylesheet' type='text/css' href='/css/style.css'>".
       "<script type='text/javascript' src='/js/jquery.min.js'></script>".
       "<script type='text/javascript' src='/js/bootstrap.min.js'></script>".
       "<script type='text/javascript' src='/js/script.js'></script>".
       "</head><body>"             .
       "<div class='page-header-container container-fluid'>".
          "<div class='page-header'>".
            "<h1 class='text-center'>$appname <small>$userstr</small></h1>".
          "</div>".
        "</div>"         .
       "<script src='javascript.js'></script>".
       "<div class='container'><div class='row'><div class='col-md-12'>".
       "<nav class='navbar navbar-default'>".
       "<ul class='nav navbar-nav'>";

  if ($loggedin)
  {
    echo "<li><a href='members.php?view=$user'>Home</a></li>" .
         "<li><a href='members.php'>Members</a></li>"         .
         "<li><a href='friends.php'>Friends</a></li>"         .
         "<li><a href='messages.php'>Messages</a></li>"       .
         "<li><a href='profile.php'>Edit Profile</a></li>"    .
         "<li><a href='logout.php'>Log out</a></li></ul></nav></div></div></div>";
  }
  else
  {
    echo  "<li><a href='index.php'>Home</a></li>"                .
          "<li><a href='signup.php'>Sign up</a></li>"            .
          "<li><a href='login.php'>Log in</a></li></ul></nav>"     .
          "<h3 class='text-center bg-danger'>&#8658; You must be logged in to " .
          "view this page.</h3></div></div></div>";
  }
?>
