<?php
  require_once 'header.php';

  if (!$loggedin) die();

  echo "<div class='container'><div class='row'><div class='col-md-12'>";

  if (isset($_GET['view']))
  {
    $view = sanitizeString($_GET['view']);

    if ($view == $user) $name = "Your";
    else                $name = "$view's";

    echo "<h3>$name Profile</h3>";
    showProfile($view);
    echo "<a class='button' href='messages.php?view=$view'>" .
         "View $name messages</a><br><br>";
    die("</div></body></html>");
  }

  if (isset($_GET['add']))
  {
    $add = sanitizeString($_GET['add']);

    $result = queryMysql("SELECT * FROM friends WHERE user='$add' AND friend='$user'");
    if (!$result->num_rows)
      queryMysql("INSERT INTO friends VALUES ('$add', '$user')");
  }
  elseif (isset($_GET['remove']))
  {
    $remove = sanitizeString($_GET['remove']);
    queryMysql("DELETE FROM friends WHERE user='$remove' AND friend='$user'");
  }

  $result = queryMysql("SELECT user FROM members ORDER BY user");
  $num    = $result->num_rows;

  echo "<h3>Other Members</h3><table class='table'><thead><tr><th>User</th><th>Action</th></tr></thead><tbody>";

  for ($j = 0 ; $j < $num ; ++$j)
  {
    $row = $result->fetch_array(MYSQLI_ASSOC);
    if ($row['user'] == $user) continue;

    echo "<tr><td><a class='btn btn-info' href='members.php?view=" .
      $row['user'] . "'>" . $row['user'] . "</a></td><td>";
    $follow = "follow</td></tr>";

    $result1 = queryMysql("SELECT * FROM friends WHERE
      user='" . $row['user'] . "' AND friend='$user'");
    $t1      = $result1->num_rows;
    $result1 = queryMysql("SELECT * FROM friends WHERE
      user='$user' AND friend='" . $row['user'] . "'");
    $t2      = $result1->num_rows;

    if (($t1 + $t2) > 1) echo " &harr; is a mutual friend";
    elseif ($t1)         echo " &larr; you are following";
    elseif ($t2)       { echo " &rarr; is following you";
      $follow = "recip"; }

    if (!$t1) echo " <a class='btn btn-success' href='members.php?add="   .$row['user'] . "'>$follow</a>";
    else      echo " <a class='btn btn-danger' href='members.php?remove=".$row['user'] . "'>drop</a>";
  }
?>

    </tbody></table></ul></div></div></div>
  </body>
</html>
