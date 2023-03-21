<?php
  require_once("config.php");

  function connect($host, $port, $dbname, $user, $password)
  {
  	$dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";
  
  	try {
  		$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
  		return new PDO($dsn, $user, $password, $options);
  	} catch (PDOException $e) {
  		die($e->getMessage());
  	}
  }
  
  return connect($host, $port, $dbname, $user, $password);
?>