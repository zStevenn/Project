<?php
// Assign users that are allowed to visit this page
$userrole = [1, 2, 3, 4];
include("./php-scripts/security.php");

// Includen van database connectie
include("./php-scripts/connectDB.php");

// Ophalen van alle user info
$msgid = $_GET["id"];
$sql = "SELECT * FROM `pro3_contactmsg` WHERE `contactid` = '$msgid'";
$result = mysqli_query($conn, $sql);
$message = mysqli_fetch_assoc($result);
?>

<!-- Display bericht -->
<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Icon -->
    <div class="fadeIn first">
      <i class="fas fa-envelope fa-5x"></i>
      <p>Bericht</p>
    </div>
    <!-- Het bericht -->
    <form class="vlr">
      <div>
        <p>Naam</p>
        <input type="text" class="fadeIn second" value="<?php echo $message["cname"] ?>" disabled>
      </div>
      <div>
        <p>Email</p>
        <input type="text" class="fadeIn second" value="<?php echo $message["cemail"] ?>" disabled>
      </div>
      <div>
        <p>Nummer</p>
        <input type="text" class="fadeIn second" value="<?php echo $message["cnumber"] ?>" disabled>
      </div>
      <div>
        <p>Vraag/opmerking:</p>
        <input type="text" class="fadeIn third" value="<?php echo $message["cmessage"] ?>" disabled>
      </div>
      <a class="btn btn-danger fadeIn fourth m-4" href="index.php?content=myaccount#berichten" role="button">Terug naar overzicht</a>
    </form>
  </div>
</div>