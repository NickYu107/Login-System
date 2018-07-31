<?php
  session_start();
  include_once 'dbh.php';
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Upload Example</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <?php
      $sql = "SELECT * FROM user";
      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result)>0) {
        while ($row = mysqli_fetch_assoc($result)) {
          $id = $row['id'];
          $sqlImg = "SELECT * FROM profileimg WHERE uid='$id'";
          $resultImg = mysqli_query($conn, $sqlImg);
          while ($rowImg = mysqli_fetch_assoc($resultImg)) {
              echo "<div class='user-container'>";
                if ($rowImg['status'] == 0) {
                  $filename = "uploads/profile".$id."*";
                  $fileinfo = glob($filename);
                  $fileext = explode(".",$fileinfo[0]);
                  $fileactualext = $fileext[1];
                  echo "<img src='uploads/profile".$id.".".$fileactualext."?".mt_rand()."'>";
                } else {
                  echo "<img src='uploads/default.jpg'>";
                }
                echo "<p>".$row['username']."</p>";
              echo "</div>";
          }
        }
      } else {
        echo "There are no user yet <br>";
      }

      if(isset($_SESSION['id'])) {
        if ($_SESSION['id'] == 1) {
          echo "You are logged in as user #1";
        }
        echo "<form action='upload.php' method='POST' enctype='multipart/form-data'>
                <input type='file' name='file'>
                <button type='submit' name='submit'>UPLOAD</button>
              </form>";
        echo "<form action='deleteprofile.php' method='POST'>
                <button type='submit' name='submit'>Delete profile image</button>
              </form>";
      } else {
        echo "You are not logged in";
        echo "<form action='signup.php' method='post'>
                <input type='text' name='first' placeholder='First name'>
                <input type='text' name='last' placeholder='Last name'>
                <input type='text' name='uid' placeholder='Username'>
                <input type='password' name='pwd' placeholder='Password'>
                <button type='submit' name='submitSignup'>Sign Up</button>
              </form>";
      }
    ?>

    <p>Login as user</p>
    <form action="login.php" method="post">
      <button type="submit" name="submitLogin">Login</button>
    </form>
    <p>Logout as user</p>
    <form action="logout.php" method="post">
      <button type="submit" name="submitLogout">Logout</button>
    </form>
  </body>
</html>
