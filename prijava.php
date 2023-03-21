<?php
  if($_GET["page"] == "prijava" && $_GET["signin"]==true){
        $username = $_POST["username"];
        $sql = "SELECT id FROM users WHERE username='$username'";
        $statement = $pdo->query($sql);
        $result = $statement->fetchAll();
        if($result)
        {
            if($result>0)
            {
                $_SESSION["username"]=$result[0]['username'];
                require_once("glavna.php");
            }
            else{
                echo "prijava neuspiješna";
            }
        }
        unset($_GET["signin"]);
      }
?>



<div class="log-in">
  <h1>Prijava vašeg računa!</h1>
  <form action="index.php?page=prijava&signin=true" method="post">
    <h3>Username:</h3><br>
    <input type="text" class="username" placeholder="username" name="username"><br>
    <input type="submit">
  </form>
</div>

