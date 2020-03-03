<?php
include("./php-scripts/connectDB.php");
include("./php-scripts/functions.php");

$email = sanitize($_POST["email"]);
$user = strstr($email, '@', true);

if (!empty($email)) {

  // Maak een select-query om te controleren of het e-mailadres al bestaat.
  $sql = "SELECT * FROM `pro3_users` WHERE `email` = '$email'";

  // Stuur de query af op de database
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result)) {
    // Email is al in gebruik
    // echo '<div class="alert alert-info" role="alert">Het door u ingevoerde e-mailadres is al in gebruik, kies een ander e-mailadres</div>';
    $_SESSION["register"] = "error";
    $_SESSION["email"] = $email;
    //header("Location: index.php?content=aanmelden");
  } else {
    $password = RandomString();
    $password_hash = password_hash($password, PASSWORD_BCRYPT);

    $sql = "INSERT INTO `pro3_users` (`userid`,
                                  `email`, 
                                  `password`,
                                  `username`,
                                  `userroleid`,
                                  `salt`)
                          VALUES (NULL,
                                  '$email',
                                  '$password',
                                  NULL,
                                  1,
                                  NULL)";

    $result = mysqli_query($conn, $sql);

    // Hiermee vraag je de door autonummering gemaakt id op
    $id = mysqli_insert_id($conn);

    if ($id) {
      $sql = "INSERT INTO `pro3_personalinfo` (`infoid`, 
                                              `name`, 
                                              `infix`, 
                                              `lastname`, 
                                              `birthday`, 
                                              `streetname`, 
                                              `postalcode`, 
                                              `city`, 
                                              `userid`) 
                                              VALUES (NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$id');";
    }

    $createpinfo = mysqli_query($conn, $sql);

    if ($createpinfo) {
      // Verstuur de email met activatielink naar de persoon die zich registreert.
      $to = $email;
      $subject = "Activatielink Afasie.org";
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
            <td align='center' style='padding: 40px 0 0 0;'>
              <img src='https://be.cleanlease.com/sites/default/files/banner-zorg.jpg' alt='Afasie Banner' width='100%' height='30%' style='display: block;' />
            </td>
          </tr>
          <tr>
            <td bgcolor='#ffffff' style='padding: 10px 0 15px 0; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;'>
              <b>Beste " . $user . ",</b>
            </td>
          </tr>
          <tr>
            <td bgcolor='#ffffff' style='padding: 0 0 15px 0; font-family: Arial, sans-serif; font-size: 14px; line-height: 20px;'>
            <p>U heeft zich onlangs geregistreerd voor de site www.afasie.org. Om het activatieproces te voltooien moet u op de onderstaande activatielink klikken.</p>
            </td>
          </tr>
          <tr>
            <td style='border-radius: 2px;' bgcolor='#0089c1'>
              <a href='http://www.afasie.org/index.php?content=script-kiespw&id=" . $id . "&pw=" . $password_hash . "'
                style='padding: 8px 12px; border: 1px solid #0089c1;border-radius: 2px;font-family: Helvetica, Arial, sans-serif;font-size: 18px; color: #ffffff;text-decoration: none;font-weight:bold;display: inline-block;'>
                Activeer mijn account!
              </a>
            </td>
          </tr>
          <tr>
            <td bgcolor='#ffffff' style='padding: 0 0 15px 0; font-family: Arial, sans-serif; font-size: 10px; line-height: 20px;'>
              <p>Heeft u niet om een activatie mail gevraagd? Dan kunt u deze mail negeren.</p>
            </td>
          </tr>
          <tr>
            <td style='color: #153643; padding: 20px 0 30px 0; font-family: Arial, sans-serif; font-size: 14px; line-height: 20px;'>
              <p>Met vriendelijke groet,<br>
              Patient Vereniging Hersenletsel
              </p>
            </td>
          </tr>
          <tr>
          <td bgcolor='#e6e6e6' style='padding: 30px 30px 30px 30px;'>
            <table border='0' cellpadding='0' cellspacing='0' width='100%'>
              <tr>
                <td style='color:#000; font-family: Arial, sans-serif; font-size: 14px;'>
                  &copy; 2020 Patienten Vereniging Hersenletsel
                </td>
                <td>
                <td>
                  <table border='0' cellpadding='0' cellspacing='0'>
                    <tr>
                      <td style='padding: 0 10px 0 0'>
                        <a href='https://twitter.com/afasienl'>
                          <img src='https://www.iconsdb.com/icons/preview/caribbean-blue/twitter-xxl.png' alt='Twitter'
                            width='38' height='38' style='display: block;' border='0' />
                        </a>
                      </td>
                      <td>
                        <a href='https://www.facebook.com/AfasieVerenigingNederland'>
                          <img src='https://www.iconsdb.com/icons/preview/caribbean-blue/facebook-xxl.png' alt='Facebook'
                            width='38' height='38' style='display: block;' border='0' />
                        </a>
                      </td>
                    </tr>
                  </table>
                </td>
          </td>
        </tr>
        </table>                
      </body>
      </html>";

      $headers = "MIME-Version: 1.0" . "\r\n";
      $headers .= "Content-type: text/html;charset=UTF-8" . "\r\n";
      $headers .= "From: register@afasie.nl" . "\r\n";
      $headers .= "Cc: 327068@student.mboutrecht.nl;" . "\r\n";
      $headers .= "Bcc: jesse@mboutrecht.nl";

      mail($to, $subject, $message, $headers);

      $_SESSION["register"] = "success";
      $_SESSION["email"] = $email;
      header("Location: index.php?content=aanmelden");
    } else {
      $_SESSION["register"] = "error";
      $_SESSION["email"] = $email;
      header("Location: index.php?content=aanmelden");
    }
  }
} else {
  $_SESSION["register"] = "error";
  $_SESSION["email"] = $email;
  header("Location: index.php?content=aanmelden");
}
