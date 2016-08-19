<?php
  require_once 'header.php';
  echo "<div class='container'><div class='row'><div class='col-md-6 col-sm-12'><h3>Please enter your details to log in</h3>";
  $error = $user = $pass = "";

  if (isset($_POST['user']))
  {
    $user = sanitizeString($_POST['user']);
    $pass = sanitizeString($_POST['pass']);

    if ($user == "" || $pass == "")
        $error = "Not all fields were entered<br>";
    else
    {
      $result = queryMySQL("SELECT user,pass FROM members
        WHERE user='$user' AND pass='$pass'");

      if ($result->num_rows == 0)
      {
        $error = "<span class=bg-danger'>Username/Password
                  invalid</span>";
      }
      else
      {
        $_SESSION['user'] = $user;
        $_SESSION['pass'] = $pass;
        die("You are now logged in. Please <a href='members.php?view=$user'>" .
            "click here</a> to continue.");
      }
    }
  }

  echo <<<_END
    <form class='form' method='post' action='login.php'>$error
    <div class='form-group'>
      <label>Username</label>
      <input class='form-control' type='text' maxlength='16' name='user' value='$user'>
    </div>
    <div class='form-group'>
      <label>Password</label>
      <input class='form-control' type='password' maxlength='16' name='pass' value='$pass'>
    </div>
_END;
?>

    <div class='form-group'>
      <input class='form-control btn btn-success'type='submit' value='Login'>
    </div>
  </form></div></div></div>
  </body>
</html>
