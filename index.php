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
    //  GET USERS
    require "rad-s-bazom.php";
    $users = $_MSG->getUsers($_SESSION["user"]["id"]); ?>

    <!-- LEFT : USER LIST -->
    <div id="uLeft">
      <!-- CURRENT USER -->
      <div id="uNow">
        <img src="slike/x-potato.png">
        <?php
          $_SESSION["user"]["name"];
          print_r($_SESSION["user"]["name"]);
        ?>
      </div>

      <!-- USER LIST -->
      <?php foreach ($users as $uid=>$u) { ?>
      <div class="uRow" id="usr<?=$uid?>" onclick="msg.show(<?=$uid?>)">
        <div class="uName"><?=$u["username"]?></div>
        <div class="uUnread"><?=isset($u["unread"])?$u["unread"]:0?></div>
      </div>
      <?php } ?>
      <form method="POST">
          <input type="submit" name="gara" value="Gara">
          <input type="submit" name="horina" value="Horina">
          <input type="submit" name="gulis" value="Gulis">
        </form>
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


