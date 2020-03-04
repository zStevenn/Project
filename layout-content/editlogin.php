<?php
// Assign users that are allowed to visit this page
$userrole = [1,2,3,4];
include("./php-scripts/security.php");

// Opvragen van gegevens van de huidige inlogger
include("./php-scripts/connectDB.php");
$id = $_SESSION["id"];

// Ophalen van alle user info
$sql = "SELECT * FROM `pro3_users` WHERE `userid` = '$id'";
$result = mysqli_query($conn, $sql);
$userinfo = mysqli_fetch_assoc($result);

// Ophalen van alle persoonlijke info
$sql = "SELECT p.* from `pro3_personalinfo` p
        left join `pro3_users` u on u.userid = p.userid
        where u.userid = '$id'";
$result1 = mysqli_query($conn, $sql);
$pinfo = mysqli_fetch_assoc($result1);
$fullname = $pinfo["name"] . ' ' . $pinfo["infix"] . ' ' . $pinfo["lastname"];
?>

<!-- Wijzigen -->
<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Icon -->
    <div class="fadeIn first">
      <i class="fa fa-lock fa-5x"></i>
      <p>Inlog gegevens wijzigen</p>
    </div>

    <!-- Wijzigingsformulier -->
    <form action="index.php?content=" method="post" class="vlr">
      <input class="fadeIn second" type="email" name="email" placeholder="Nieuwe e-mail">
      <input class="fadeIn second" type="email" name="email" placeholder="Herhaal nieuwe e-mail">
      <input class="fadeIn second" type="password" name="password" placeholder="Nieuwe wachtwoord">
      <input class="fadeIn second" type="password" name="password" placeholder="Herhaal nieuwe wachtwoord">
      <input class="mt-4 " type="email" name="email" placeholder="Huidig e-mail">
      <input class="fadeIn second" type="password" name="vpassword" placeholder="Huidig wachtwoord">
      <input class="fadeIn second" type="password" name="vpasswordc" placeholder="Herhaal huidig wachtwoord">
      <input type="submit" class="fadeIn third" value="Aanpassen">

    </form>
  </div>
</div>