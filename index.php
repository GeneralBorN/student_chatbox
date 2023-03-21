<?php
$pdo = require_once("connect.php");
?>
<html>
  <head>
    <title>Prijava</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <header></header>
    <main>
      <?php
        $page= $_GET['page'];
        if($page==""){
          require_once("glavna.php");
        }
        else if($page=="prijava"){
          require_once("prijava.php");
        }
        else if($page=="glavna"){
          require_once("glavna.php");
        }
      ?>
    </main>
    <footer></footer>
  </body>
  <script src="script.js"></script>
</html>