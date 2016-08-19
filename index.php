<?php 
  require_once 'header.php';

  echo "<div class='container'><div class='row'><div class='col-md-12'><h1 class='text-center'>Welcome to $appname</h1>";

  if ($loggedin) echo "<p class='text-center'>$user, you are logged in.</p>";
  else           echo "<p class='text-center'>please <a href='signup.php'>sign up</a> and/or <a href='login.php'>log in</a> to join in.</p>";
?>
        </div>
      </div>
    </div>
  </body>
</html>
