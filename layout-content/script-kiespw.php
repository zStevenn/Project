<?php
if (isset($_SESSION["choosepw"]))
  switch ($_SESSION["choosepw"]) {
    case "success":
      $pwclasses = "register-succ";
      $choosepwmsg = "Uw wachtwoord is ingesteld. U wordt doorgestuurd naar de inlog pagina.";
      header("Refresh: 4; url=./index.php?content=redirect");
      break;
    case "error1":
      $pwclasses = "register-msg";
      $choosepwmsg = "U heeft één of beide wachtwoorden niet ingevuld.";
      break;
    case "error2":
      $pwclasses = "register-msg";
      $choosepwmsg = "Uw opgegeven wachtwoorden komen niet overeen.";
      break;
    case "error3":
      $pwclasses = "register-msg";
      $choosepwmsg = "Oeps, er is iets mis gegaan! Probeert u opnieuw. Error3";
      break;
    case "error4":
      $pwclasses = "register-msg";
      $choosepwmsg = "Oeps, er is iets mis gegaan! Probeert u opnieuw. Error4";
      break;
    case "error5":
      $pwclasses = "register-msg";
      $choosepwmsg = "Oeps, er is iets mis gegaan! Probeert u opnieuw. Error5";
      break;
  }
?>
<!-- Wachtwoord kiezen -->
<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Icon -->
    <div class="fadeIn first">
      <i class="fa fa-lock fa-5x"></i>
      <p>Wachtwoord kiezen</p>
    </div>

    <!-- Wachtwoordformulier -->
    <form action="./index.php?content=script-kiespwverify" method="post">
      <input type="password" id="password" class="fadeIn second " name="password" placeholder="Wachtwoord">
      <input type="password" id="checkpassword" class="fadeIn third " name="checkpassword" placeholder="Herhaal wachtwoord">
      <div class="<?php if (isset($_SESSION["choosepw"])) echo $pwclasses; ?>"><?php if (isset($_SESSION["choosepw"])) echo $choosepwmsg; ?></div>
      <input type="submit" class="fadeIn fourth" value="Wachtwoord bevestigen">
      <input type="hidden" value="<?php if (isset($_GET["id"])) echo $_GET["id"]; ?>" name="id">
      <input type="hidden" value="<?php if (isset($_GET["id"])) echo $_GET["pw"]; ?>" name="pw">
    </form>

  </div>
</div>