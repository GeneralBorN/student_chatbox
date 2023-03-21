<?php
// (A) PROCESS LOGIN ON SUBMIT
session_start();
require "user.php";

// (B) REDIRECT USER IF SIGNED IN
if (isset($_SESSION["user"])) {
	header("Location: index.php");
	exit();
}

// (C) LOGIN FORM ?>
<!DOCTYPE html>
<html>
  <head>
    <title>Login Page</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <!-- (C1) ERROR MESSAGES (IF ANY) -->
    <?php
    if (isset($_POST["email"])) { echo "<div id='notify'>Invalid user</div>"; }
    ?>

    <!-- (C2) LOGIN FORM -->
    <form id="login" method="post">
      <h2>MEMBER LOGIN</h2>
      <input type="text" name="username" placeholder="Username" required>
      <input type="submit" value="Log In">
    </form>
  </body>
</html>