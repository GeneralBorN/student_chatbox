<!DOCTYPE html>
<html>
  <head>
    <title>Users List</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
  </head>
  <body>
    <?php
    // (A) GET USERS
    require "rad-s-bazom.php";
    $users = $_MSG->getUsers($_SESSION["user"]["id"]); ?>

    <!-- LEFT : USER LIST -->
    <div id="uLeft">
      <!-- CURRENT USER -->
      <div id="uNow">
        <img src="slike/x-potato.png">
        <?=$_SESSION["user"]["name"]?>
      </div>

      <!-- USER LIST -->
      <?php foreach ($users as $uid=>$u) { ?>
      <div class="uRow" id="usr<?=$uid?>" onclick="msg.show(<?=$uid?>)">
        <div class="uName"><?=$u["user_name"]?></div>
        <div class="uUnread"><?=isset($u["unread"])?$u["unread"]:0?></div>
      </div>
      <?php } ?>
    </div>

    <!-- RIGHT : MESSAGES LIST -->
    <div id="uRight">
      <!-- SEND MESSAGE -->
      <form id="uSend" onsubmit="return msg.send()">
        <input type="text" id="mTxt" required>
        <input type="submit" value="Send">
      </form>

       <!-- MESSAGES -->
       <div id="uMsg"></div>
    </div>
  </body>
</html>