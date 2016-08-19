<?php
  require_once 'header.php';

  if (!$loggedin) die();

  if (isset($_GET['view'])) $view = sanitizeString($_GET['view']);
  else                      $view = $user;

  if ($view == $user)
  {
    $name1 = $name2 = "Your";
    $name3 =          "You are";
  }
  else
  {
    $name1 = "<a class='btn btn-info' href='members.php?view=$view'>$view</a>'s";
    $name2 = "$view's";
    $name3 = "$view is";
  }

  echo "<div class='container'><div class='row'><div class='col-md-12'>";

  $followers = array();
  $following = array();

  $result = queryMysql("SELECT * FROM friends WHERE user='$view'");
  $num    = $result->num_rows;

  for ($j = 0 ; $j < $num ; ++$j)
  {
    $row           = $result->fetch_array(MYSQLI_ASSOC);
    $followers[$j] = $row['friend'];
  }

  $result = queryMysql("SELECT * FROM friends WHERE friend='$view'");
  $num    = $result->num_rows;

  for ($j = 0 ; $j < $num ; ++$j)
  {
      $row           = $result->fetch_array(MYSQLI_ASSOC);
      $following[$j] = $row['user'];
  }

  $mutual    = array_intersect($followers, $following);
  $followers = array_diff($followers, $mutual);
  $following = array_diff($following, $mutual);
  $friends   = FALSE;

  if (sizeof($mutual))
  {
    echo "<h2 class='text-center'>$name2 mutual friends</h2><div class='row'>";
    foreach($mutual as $friend){
      if (file_exists("$friend.jpg"))
        echo "<div class='col-xs-6 col-md-3'>".
              "<a href='members.php?view=$friend' class='thumbnail'>".
              "<img src='$friend.jpg' alt='$friend'>".
              "</a>".
              "<div class='caption'>".
              "<a class='btn btn-info btn-block btn-lg' href='members.php?view=$friend'>$friend</a>".
              "</div>".
              "</div>";
      else
        echo "<div class='col-xs-6 col-md-3'><a class='btn btn-info btn-block btn-lg' href='members.php?view=$friend'>$friend</a></div>";
    }
    echo "</div><br>";
    $friends = TRUE;
  }

  if (sizeof($followers))
  {
    echo "<h2 class='text-center'>$name2 followers</h2><div class='row'>";
    foreach($followers as $friend){
      if (file_exists("$friend.jpg"))
        echo "<div class='col-xs-6 col-md-3'>".
              "<a href='members.php?view=$friend' class='thumbnail'>".
              "<img src='$friend.jpg' alt='$friend'>".
              "</a>".
              "<div class='caption'>".
              "<a class='btn btn-info btn-block btn-lg' href='members.php?view=$friend'>$friend</a>".
              "</div>".
              "</div>";
      else
        echo "<div class='col-xs-6 col-md-3'><a class='btn btn-info btn-block btn-lg' href='members.php?view=$friend'>$friend</a></div>";
    }
    echo "</div><br>";
    $friends = TRUE;
  }

  if (sizeof($following))
  {
    echo "<h2 class='text-center'>$name3 following</h2><div class='row'>";
    foreach($following as $friend){
      if (file_exists("$friend.jpg"))
        echo "<div class='col-xs-6 col-md-3'>".
              "<a href='members.php?view=$friend' class='thumbnail'>".
              "<img src='$friend.jpg' alt='$friend'>".
              "</a>".
              "<div class='caption'>".
              "<a class='btn btn-info btn-block btn-lg' href='members.php?view=$friend'>$friend</a>".
              "</div>".
              "</div>";
      else
        echo "<div class='col-xs-6 col-md-3'><a class='btn btn-info btn-block btn-lg' href='members.php?view=$friend'>$friend</a></div>";
    }
    echo "</div><br>";
    $friends = TRUE;
  }

  if (!$friends) echo "<div class='row'><div class='col-md-12'><h4 class='bg-warning'>You don't have any friends yet.<h4></div></div><br>";

  echo "<div class='row'><div class='col-md-12'><a class='btn btn-info' href='messages.php?view=$view'>" .
       "View $name2 messages</a></div></div>";
?>

    </div></div></div>
  </body>
</html>
