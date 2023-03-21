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

  // (D) GET ALL USERS & NUMBER OF UNREAD MESSAGES
  function getUsers ($for) {
    // (D1) GET USERS
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD:rad-s-bazom.php
    $this->query("SELECT * FROM `users` WHERE `id`!=?", [$for]);
=======
=======
>>>>>>> parent of 6a88ea1 (Promjenio imena da ima smisla)
=======
>>>>>>> parent of 6a88ea1 (Promjenio imena da ima smisla)
    $this->query("SELECT * FROM `users` WHERE `user_id`!=?", [$for]);
>>>>>>> parent of 6a88ea1 (Promjenio imena da ima smisla):2-lib-msg.php
    $users = [];
    while ($r = $this->stmt->fetch()) { $users[$r["id"]] = $r; }

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
      "SELECT m.*, u.`username` FROM `messages` m
       JOIN `users` u ON (m.`user_from`=u.`id`)
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
}

// (G) DATABASE SETTINGS - CHANGE TO YOUR OWN!
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD:rad-s-bazom.php
define("DB_HOST", "localhost");
define("DB_NAME", "dtb_student_chatbox");
=======
=======
>>>>>>> parent of 6a88ea1 (Promjenio imena da ima smisla)
=======
>>>>>>> parent of 6a88ea1 (Promjenio imena da ima smisla)
define("DB_HOST", "db4free.net");
define("DB_NAME", "dtb_student_cb");
>>>>>>> parent of 6a88ea1 (Promjenio imena da ima smisla):2-lib-msg.php
define("DB_CHARSET", "utf8mb4");
define("DB_USER", "root");
define("DB_PASSWORD", "");

// (H) MESSAGE OBJECT
$_MSG = new Message();

// (I) ACT AS USER
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD:rad-s-bazom.php
<<<<<<< HEAD:rad-s-bazom.php
//session_start();
//$_SESSION["user"] = ["id" => 1, "name" => "Joe Doe"];
// $_SESSION["user"] = ["id" => 2, "name" => "Jon Doe"];
=======
=======
>>>>>>> parent of 6a88ea1 (Promjenio imena da ima smisla):2-lib-msg.php
=======
>>>>>>> parent of 6a88ea1 (Promjenio imena da ima smisla)
=======
>>>>>>> parent of 6a88ea1 (Promjenio imena da ima smisla)
session_start();
$_SESSION["user"] = ["id" => 1, "name" => "Jon Doe"];
// $_SESSION["user"] = ["id" => 2, "name" => "Jonhy Doe"];
<<<<<<< HEAD:rad-s-bazom.php
>>>>>>> parent of 21d56e7 (Stavljeno na online db):2-lib-msg.php
=======
>>>>>>> parent of 21d56e7 (Stavljeno na online db):2-lib-msg.php
// $_SESSION["user"] = ["id" => 3, "name" => "Joy Doe"];