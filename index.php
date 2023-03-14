<?php
class Message {
  // (A) CONSTRUCTOR - CONNECT TO THE DATABASE
  private $pdo = null;
  private $stmt = null;
  public $error;
  function __construct () {
    $this->pdo = new PDO(
      "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHARSET,
      DB_USER, DB_PASSWORD, [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
  }
 
  // (B) DESTRUCTOR - CLOSE DATABASE CONNECTION
  function __destruct () {
    if ($this->stmt !== null) { $this->stmt = null; }
    if ($this->pdo !== null) { $this->pdo = null; }
  }
 
  // (C) EXECUTE SQL QUERY
  function query ($sql, $data=null) {
    $this->stmt = $this->pdo->prepare($sql);
    $this->stmt->execute($data);
  }
  // ...
}
 
// (G) DATABASE SETTINGS - CHANGE TO YOUR OWN!
define("DB_HOST", "localhost");
define("DB_NAME", "test");
define("DB_CHARSET", "utf8mb4");
define("DB_USER", "root");
define("DB_PASSWORD", "");
 
// (H) MESSAGE OBJECT
$_MSG = new Message();
 
// (I) ACT AS USER
session_start();
$_SESSION["user"] = ["id" => 1, "name" => "Joe Doe"];
// $_SESSION["user"] = ["id" => 2, "name" => "Jon Doe"];
// $_SESSION["user"] = ["id" => 3, "name" => "Joy Doe"];

// (D) GET ALL USERS & NUMBER OF UNREAD MESSAGES
function getUsers ($for) {
    // (D1) GET USERS
    $this->query("SELECT * FROM `users` WHERE `user_id`!=?", [$for]);
    $users = [];
    while ($r = $this->stmt->fetch()) { $users[$r["user_id"]] = $r; }
   
    // (D2) COUNT UNREAD MESSAGES
    $this->query(
      "SELECT `user_from`, COUNT(*) `ur`
        FROM `messages` WHERE `user_to`=? AND `date_read` IS NULL
        GROUP BY `user_from`", [$for]);
    while ($r = $this->stmt->fetch()) { $users[$r["user_from"]]["unread"] = $r["ur"]; }
  
    // (D3) RESULTS
    return $users;
  }
  
  // (E) GET MESSAGES
  function getMsg ($from, $to, $limit=30) {
    // (E1) MARK ALL AS "READ"
    $this->query(
      "UPDATE `messages` SET `date_read`=NOW()
        WHERE `user_from`=? AND `user_to`=? AND `date_read` IS NULL", [$from, $to]);
  
    // (E2) GET MESSAGES
    $this->query(
      "SELECT m.*, u.`user_name` FROM `messages` m
        JOIN `users` u ON (m.`user_from`=u.`user_id`)
        WHERE `user_from` IN (?,?) AND `user_to` IN (?,?)
        ORDER BY `date_send` DESC
        LIMIT 0, $limit", [$from, $to, $from, $to]);
    return $this->stmt->fetchAll();
  }
  
  // (F) SEND MESSAGE
  function send ($from, $to, $msg) {
    $this->query(
      "INSERT INTO `messages` (`user_from`, `user_to`, `message`) VALUES (?,?,?)",
      [$from, $to, strip_tags($msg)]
    );
    return true;
  }
  if (isset($_POST["req"])) {
    require "2-lib-msg.php";
    switch ($_POST["req"]) {
      // (A) SHOW MESSAGES
      case "show":
        $msg = $_MSG->getMsg($_POST["uid"], $_SESSION["user"]["id"]);
        if (count($msg)>0) { foreach ($msg as $m) {
          $out = $m["user_from"] == $_SESSION["user"]["id"]; ?>
          <div class="mRow <?=$out?"mOut":"mIn"?>">
            <div class="mDate"><?=$m["date_send"]?></div>
          </div>
          <div class="mRow <?=$out?"mOut":"mIn"?>"><div class="mRowMsg">
            <div class="mSender"><?=$m["user_name"]?></div>
            <div class="mTxt"><?=$m["message"]?></div>
          </div></div>
        <?php }}
        break;
   
      // (B) SEND MESSAGE
      case "send":
        echo $MSG->send($_SESSION["user"]["id"], $_POST["to"], $_POST["msg"])
          ? "OK" : $MSG->error ;
        break;
  }}
  
  // (A) GET USERS
require "2-lib-msg.php";
$users = $_ MSG->getUsers($_SESSION["user"]["id"]); ?>
 
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
    <div class="uName"><?=$u["user_name"]?></div>
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
?>