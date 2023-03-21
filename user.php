<?php
class Users {
  // (A) CONSTRUCTOR - CONNECT TO DATABASE
  private $pdo = null;
  private $stmt = null;
  public $error = null;
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

  // (C) RUN SQL QUERY
  function query ($sql, $data=null) {
    $this->stmt = $this->pdo->prepare($sql);
    $this->stmt->execute($data);
  }

  // (D) GET USER
  function get ($username) {
    $this->query(sprintf("SELECT * FROM `users` WHERE `username`=.$username."));
    return $this->stmt->fetch();
  }

  // (E) VERIFY EMAIL PASSWORD - SESSION MUST BE STARTED!
  function login ($email, $password) {
    // (E1) ALREADY SIGNED IN
    if (isset($_SESSION["user"])) { return true; }

    // (E2) GET USER
    $user = $this->get($email);
    if (!is_array($user)) { return false; }
    $_SESSION["user"] = [];
    // (E3) VERIFY PASSWORD + REGISTER SESSION
    return false;
  }

  // (F) SAVE USER
  /*function save ($name, $email, $pass, $id=null) {
    // (F1) ADD/UPDATE SQL
    if ($id===null) {
      $sql = "INSERT INTO `users` (`user_name`, `user_email`, `user_password`) VALUES (?,?,?)";
      $data = [$name, $email, password_hash($pass, PASSWORD_DEFAULT)];
    } else {
      $sql = "UPDATE `users` SET `user_name`=?, `user_email`=?, `user_password`=? WHERE `user_id`=?";
      $data = [$name, $email, password_hash($pass, PASSWORD_DEFAULT), $id];
    }

    // (F2) PROCESS SAVE
    $this->query($sql, $data);
    return true;
  }*/
}

// (G) DATABASE SETTINGS - CHANGE TO YOUR OWN!
define("DB_HOST", "db4free.net");
define("DB_NAME", "dtb_student_cb");
define("DB_CHARSET", "utf8mb4");
define("DB_USER", "bornahorinaproje");
define("DB_PASSWORD", "ZaSIWPprojektni");

// (H) CREATE USER OBJECT
$USR = new Users();