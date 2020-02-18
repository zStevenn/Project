<?php
// Include connection and functions
include("./php-scripts/connectDB.php");
include("./php-scripts/functions.php");

// Sanitize filled in form info
$contactname = sanitize($_POST["contactname"]);
$contactemail = sanitize($_POST["contactemail"]);
$contactnumber = (($_POST["contactnumber"]) ? sanitize($_POST["contactnumber"]) : "");
$contactmessage = sanitize($_POST["contactmessage"]);

if (isset($_SESSION["id"])) {
  // Controleren of gebruiker is ingelogd of niet.
  // Hierop gebaseerd word er een query verstuurd naar de database.
  $id = $_SESSION["id"];

  $sql = "INSERT INTO `pro3_contactmsg` (`contactid`,
                                            `cname`, 
                                            `cemail`,
                                            `cnumber`,
                                            `cmessage`,
                                            `userid_FK`)
                                      VALUES (NULL,
                                            '$contactname',
                                            '$contactemail',
                                            '$contactnumber',
                                            '$contactmessage',
                                            '$id');";
} else {
  $sql = "INSERT INTO `pro3_contactmsg` (`contactid`,
                                            `cname`, 
                                            `cemail`,
                                            `cnumber`,
                                            `cmessage`,
                                            `userid_FK`)
                                      VALUES (NULL,
                                            '$contactname',
                                            '$contactemail',
                                            '$contactnumber',
                                            '$contactmessage',
                                            NULL);";
}

// Controleren op lege velden
if (!empty($contactname)) {
  if (!empty($contactemail)) {
    if (!empty($contactmessage)) {
      // Als alles is ingevuld, verstuur query naar DB
      $result = mysqli_query($conn, $sql);

      if ($result) {
        // Verstuur het
        $to = $email;
        $subject = "Contactmail " . $contactname;
        $message = "<!DOCTYPE html>
                  <html>
                    <head>
                    <title>Page Title</title>
                    <style>
                      h1 {
                        background-color: rgb(200, 120, 23);
                        padding: 1em;
                        width: 50%;
                      }
                    </style>
                    </head>
                  <body>                  
                    <h1>Beste gebruiker,</h1>
                    <p>" . $contactmessage . "</p>
                    <p>Met vriendelijke groet,</p>
                    <p></p>
                    <p>" . $contactname . "</p>                  
                  </body>
                  </html>";

        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type: text/html;charset=UTF-8" . "\r\n";
        $headers .= "From: " . $contactname . "@customer.nl" . "\r\n";
        $headers .= "Cc: 327068@student.mboutrecht.nl;" . "\r\n";
        $headers .= "Bcc: jemx@mboutrecht.nl";

        mail($to, $subject, $message, $headers);

        $_SESSION["contact"] = "success";
        header("Location: index.php?content=contact");
      }
    } else {
      // Geen bericht
      $_SESSION["contact"] = "message";
      header("Location: index.php?content=contact");
    }
  } else {
    // Geen email
    $_SESSION["contact"] = "email";
    header("Location: index.php?content=contact");
  }
} else {
  // Geen naam
  $_SESSION["contact"] = "name";
  header("Location: index.php?content=contact");
}
?>