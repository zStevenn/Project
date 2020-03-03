<?php
// Assign users that are allowed to visit this page
$userrole = [1,2,3];
include("./php-scripts/security.php");

// Include connectDB and set variables
include("./php-scripts/connectDB.php");
include("./php-scripts/functions.php");
$id = $_SESSION["id"];

// Put all sanitized user inputs in variables
$firstname = sanitize($_POST["name"]);
$infix = sanitize($_POST["infix"]);
$lastname = sanitize($_POST["lastname"]);
$birthday = sanitize($_POST["birthday"]);
$password = sanitize($_POST["vpassword"]);
$passwordc = sanitize($_POST["vpasswordc"]);

if (!empty($password) && !empty($passwordc)) {
  if (!strcmp($password, $passwordc)) {
    $sql = "SELECT * FROM `pro3_users` WHERE `userid` = $id;";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
      $record = mysqli_fetch_assoc($result);
      $salt = $record["salt"];
      $hash =  $record["password"];

      if (password_verify($password.$salt, $hash)) {
        $sql = "UPDATE `pro3_personalinfo` 
                SET `name` = '$firstname',
                    `infix` = '$infix',
                    `lastname` = '$lastname',
                    `birthday` = '$birthday'
                WHERE `userid` = '$id'";

        $result = mysqli_query($conn, $sql);

        if ($result) {
          // User personal info was succesfully edited
          header("Location: index.php?content=myaccount#gegevens");
        } else {
          // Query was not send to database
          header("Location: index.php?content=myaccount#gegevens");
        }
      } else {
        // Password and database password do not match
        header("Location: index.php?content=myaccount#gegevens");
      }
    } else {
      // User does not exist in database
      header("Location: index.php?content=myaccount#gegevens");
    }
  } else {
    // If passwords do not match
    header("Location: index.php?content=myaccount#gegevens");
  }
} else {
  // If passwords or password is/are not entered
  header("Location: index.php?content=myaccount#gegevens");
}

?>