<?php
// Check if session variable is set.
if (isset($_SESSION["login"]))
  switch ($_SESSION["login"]) {
    case "success":
      $pwclasses = "register-succ";
      $choosepwmsg = "Uw wachtwoord is ingesteld. U wordt doorgestuurd naar de inlog pagina.";
      header("Refresh: 4; url=./index.php?content=redirect");
      break;
    case "error1":
      $pwclasses = "register-msg";
      $choosepwmsg = "Één of meerdere vereiste gegevens zijn niet ingevuld.";
      break;
    case "error2":
      $pwclasses = "register-msg";
      $choosepwmsg = "Uw opgegeven email of wachtwoord is onjuist.";
      break;
    case "error3":
      $pwclasses = "register-msg";
      $choosepwmsg = "Uw opgegevens email of wachtwoord is onjuist.";
      break;
  }
?>

<!-- Inloggen -->
<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Icon -->
    <div class="fadeIn first">
      <i class="fa fa-lock fa-5x"></i>
      <p>Inloggen</p>
    </div>
    <!-- Login formulier -->
    <form action="index.php?content=script-inloggen" method="post">
      <input type="text" id="login" class="fadeIn second" name="email" placeholder="E-mail of username">
      <input type="password" id="password" class="fadeIn third" name="password" placeholder="Password">
      <div class="fadeIn third <?php if (isset($_SESSION["login"])) echo $pwclasses; ?>"><?php if (isset($_SESSION["login"])) echo $choosepwmsg; ?></div>
      <input type="submit" class="fadeIn fourth" value="Log In">
    </form>
    <!-- Link naar aanmeld pagina -->
    <div id="formFooter">
      <a class="underlineHover" href="index.php?content=aanmelden">Nog geen account? Meld je aan.</a>
    </div>
  </div>
</div>