<!DOCTYPE html>
<html>
  <head>
<<<<<<< HEAD
    <title>Student ChatBox</title>
=======
    <title>Users List</title>
>>>>>>> parent of 6a88ea1 (Promjenio imena da ima smisla)
    <meta charset="utf-8">
    <link rel="stylesheet" href="x-demo-msg.css">
    <script src="5-demo-msg.js"></script>
  </head>
  <body>
    <?php
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD:index.php
    // GET USERS
    if (!isset($_SESSION["user"])) {
      header("Location: login.php");
      exit();
    }
    require "rad-s-bazom.php";
=======
    // (A) GET USERS
    require "2-lib-msg.php";
>>>>>>> parent of 6a88ea1 (Promjenio imena da ima smisla):4-demo-msg.php
=======
    // (A) GET USERS
    require "2-lib-msg.php";
>>>>>>> parent of 6a88ea1 (Promjenio imena da ima smisla)
=======
    // (A) GET USERS
    require "2-lib-msg.php";
>>>>>>> parent of 6a88ea1 (Promjenio imena da ima smisla)
    $users = $_MSG->getUsers($_SESSION["user"]["id"]); ?>

    <!-- (B) LEFT : USER LIST -->
    <div id="uLeft">
      <!-- (B1) CURRENT USER -->
      <div id="uNow">
        <img src="x-potato.png">
        <?=$_SESSION["user"]["name"]?>
      </div>

      <!-- (B2) USER LIST -->
      <?php foreach ($users as $uid=>$u) { ?>
      <div class="uRow" id="usr<?=$uid?>" onclick="msg.show(<?=$uid?>)">
<<<<<<< HEAD
        <div class="uName"><?=$u["username"]?></div>
=======
        <div class="uName"><?=$u["user_name"]?></div>
>>>>>>> parent of 6a88ea1 (Promjenio imena da ima smisla)
        <div class="uUnread"><?=isset($u["unread"])?$u["unread"]:0?></div>
      </div>
      <?php } ?>
    </div>

    <!-- (C) RIGHT : MESSAGES LIST -->
    <div id="uRight">
      <!-- (C1) SEND MESSAGE -->
      <form id="uSend" onsubmit="return msg.send()">
        <input type="text" id="mTxt" required>
        <input type="submit" value="Send">
      </form>

       <!-- (C2) MESSAGES -->
       <div id="uMsg"></div>
    </div>
  </body>
</html>