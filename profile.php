<?php

session_start();

if (!isset($_SESSION['uid'])) {
  throw new Exception("Vous devez vous connecter pour accéder à cette page");
}

echo"Bonjour " .$_SESSION['name'];
?>
