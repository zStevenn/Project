<?php
// Assign users that are allowed to visit this page
$userrole = [4];
include("./php-scripts/security.php");
include("./php-scripts/connectDB.php");

$type = $_GET["type"];
$id = $_GET["id"];

switch ($type) {
  case "mail":
    $tablename = "pro3_contactmsg";
    $databaseid = "contactid";
  break;
  case "highscore":
    $tablename = "pro3_highscores";
    $databaseid = "highscoreid";
  break;
  default:
  header("Location: index.php?content=error404");
}

$sql = "DELETE FROM `$tablename` 
        where `$databaseid` = '$id'";

$query = mysqli_query($conn, $sql);

if ($query) {
  $_SESSION["delete"] = "Record has been deleted successfully";
  header("Location: index.php?content=godmode");
}
?>