<?php
include("./php-scripts/connectDB.php");
include("./php-scripts/functions.php");

$email = sanitize($_POST["email"]);
$password = sanitize($_POST["password"]);

if (!empty($email) && !empty($password)) {

  $sql = "SELECT * FROM `pro3_users` WHERE `email` = '$email'";

  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) ==  1) {
    // Email bestaat
    $record = mysqli_fetch_assoc($result);
    $salt = $record["salt"];
    $hash =  $record["password"];

    if (password_verify($password.$salt, $hash)) {
      // Variabelen zetten als wachtwoorden overeenkomen (inloggen)
      $_SESSION["id"] = $record["userid"];
      $_SESSION["userrole"] = $record["userrole"];
      $_SESSION["email"] = $record["email"];
      header("Location: index.php?content=redirect");
    } else {
      // Password bestaat niet
      $_SESSION["login"] = "error3";
      header("Location: index.php?content=inloggen");
    }
  } else {
    // Email bestaat niet
    $_SESSION["login"] = "error2";
    header("Location: index.php?content=inloggen");
  }
} else {
  // Gegevens niet ingevuld
  $_SESSION["login"] = "error1";
  header("Location: index.php?content=inloggen");
}
?>