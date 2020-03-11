<?php
if (isset($_SESSION["choosepw"]))
  switch ($_SESSION["choosepw"]) {
    case "success":
      $pwclasses = "register-succ";
      $choosepwmsg = "Uw wachtwoord is ingesteld. U wordt doorgestuurd naar de inlog pagina.";
      unset($_SESSION["choosepw"]);
      header("Refresh: 4; url=./index.php?content=redirect");
      break;
    case "error1":
      $pwclasses = "register-msg";
      $choosepwmsg = "U heeft één of beide wachtwoorden niet ingevuld.";
      unset($_SESSION["choosepw"]);
      break;
    case "error2":
      $pwclasses = "register-msg";
      $choosepwmsg = "Uw opgegeven wachtwoorden komen niet overeen.";
      unset($_SESSION["choosepw"]);
      break;
    case "error3":
      $pwclasses = "register-msg";
      $choosepwmsg = "Oeps, er is iets mis gegaan! Probeert u opnieuw. Error3";
      unset($_SESSION["choosepw"]);
      break;
    case "error4":
      $pwclasses = "register-msg";
      $choosepwmsg = "Oeps, er is iets mis gegaan! Probeert u opnieuw. Error4";
      unset($_SESSION["choosepw"]);
      break;
    case "error5":
      $pwclasses = "register-msg";
      $choosepwmsg = "Oeps, er is iets mis gegaan! Probeert u opnieuw. Error5";
      unset($_SESSION["choosepw"]);
      break;
  }
?>
<!-- Wachtwoord kiezen -->
<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Icon -->
    <div class="fadeIn first">
      <i class="fas fa-lock fa-5x"></i>
      <p>Registratie afronden</p>
    </div>

    <!-- Wachtwoordformulier -->
    <form action="./index.php?content=script-kiespwverify" method="post" class="vlr">
      <input type="text" id="username" class="fadeIn first " name="username" placeholder="Gebruikersnaam">
      <input type="password" id="password" class="fadeIn second " name="password" placeholder="Wachtwoord*" required>
      <input type="password" id="checkpassword" class="fadeIn third " name="checkpassword" placeholder="Herhaal wachtwoord*" required>
      <div class="<?php if (isset($pwclasses)) echo $pwclasses; ?>"><?php if (isset($choosepwmsg)) echo $choosepwmsg; ?></div>
      <input type="submit" class="fadeIn fourth" value="Wachtwoord bevestigen">
      <input type="hidden" value="<?php if (isset($_GET["id"])) echo $_GET["id"]; ?>" name="id">
      <input type="hidden" value="<?php if (isset($_GET["id"])) echo $_GET["pw"]; ?>" name="pw">
    </form>

  </div>
</div>