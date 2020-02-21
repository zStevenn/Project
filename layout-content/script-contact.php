<?php
// Include connection and functions
include("./php-scripts/connectDB.php");
include("./php-scripts/functions.php");

// Sanitize filled in form info
$contactname = sanitize($_POST["contactname"]);
$contactemail = sanitize($_POST["contactemail"]);
$contactnumber = (($_POST["contactnumber"]) ? sanitize($_POST["contactnumber"]) : "");
$contactmessage = sanitize($_POST["contactmessage"]);

// Query opstellen gebaseerd op of gebruiker is ingelogd of niet.
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
                    </style>
                    </head>
                    <body style='margin: 0; padding: 0;'> 
                    <table align='center' border='0' cellpadding='0' cellspacing='0' width='600'>
                      <tr>
                        <td bgcolor='#ffffff' style='padding: 10px 0 15px 0; font-family: Arial, sans-serif; font-size: 20px; line-height: 20px;'>
                          <b>Beste meneer/mevrouw,</b>
                        </td>
                      </tr>
                      <tr>
                        <td bgcolor='#ffffff' style='padding: 0 0 15px 0; font-family: Arial, sans-serif; font-size: 18px; line-height: 20px;'>
                          <b>Vraag of opmerking:</b>
                        </td>
                      </tr>
                      <tr>
                        <td style='color: #153643; padding: 0 0 15px 0; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;'>
                          <p>" . $contactmessage . "</p>
                        </td>
                      </tr>
                      <tr>
                        <td bgcolor='#ffffff' style='padding: 0 0 15px 0; font-family: Arial, sans-serif; font-size: 18px; line-height: 20px;'>
                          <b>Mijn contactgegevens:</b>
                        </td>
                      </tr>
                      <tr>
                        <td bgcolor='#ffffff' style='font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;'>
                          <p>" . $contactnumber . "</p>
                        </td>
                      </tr>
                      <tr>
                        <td bgcolor='#ffffff' style='font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;'>
                          <p>" . $contactemail . "</p>
                        </td>
                      </tr>
                      <tr>
                        <td style='color: #153643; padding: 20px 0 30px 0; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;'>
                          <p>Met vriendelijke groet,</p>
                          <p>" . $contactname . "</p>
                        </td>
                      </tr>
                    </table>                
                  </body>
                  </html>";

        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type: text/html;charset=UTF-8" . "\r\n";
        $headers .= "From: " . $contactemail . "\r\n";
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