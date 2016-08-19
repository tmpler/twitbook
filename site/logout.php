<?php // Example 26-12: logout.php
  require_once 'header.php';

  if (isset($_SESSION['user']))
  {
    destroySession();
    echo "<div class='container'><div class='row'><div class='col-md-12'><p class='text-center'>You have been logged out. Please " .
         "<a href='index.php'>click here</a> to refresh the screen.</p>";
  }
  else echo "<div class='container'><div class='row'><div class='col-md-12'>" .
            "<p class='text-center'>You cannot log out because you are not logged in";
?>

    </div></div></div>
  </body>
</html>
