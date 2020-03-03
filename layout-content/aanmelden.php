<?php
// Check if session variable is set.
if (isset($_SESSION["register"])) {
  switch ($_SESSION["register"]) {
    case "error":
      $registermsg = "Het ingevoerde e-mail adres is al in gebruik.";
      $classes = "register-err register-msg";
      $email = $_SESSION["email"];
      unset($_SESSION["register"]);
      break;
    case "success":
      $registermsg = "Er is een verificatiemail naar uw e-mail adres gestuurd.";
      $classes = "register-succ";
      $email = $_SESSION["email"];
      unset($_SESSION["register"]);
      unset($_SESSION["email"]);
      break;
    default:
      header("Location: index.php?content=error404");
      break;
  }
}
?>

<!-- Aanmelden -->
<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Icon -->
    <div class="fadeIn first">
      <i class="fas fa-lock fa-5x"></i>
      <p>Aanmelden</p>
    </div>

    <!-- Aanmeldformulier -->
    <form action="./index.php?content=script-aanmelden" method="post" class="vlr">
      <input type="email" id="register" class="fadeIn second <?php if (isset($classes)) echo $classes; ?>" name="email" placeholder="Email" value="<?php if (isset($mail)) echo $mail ?>">
      <div class="fadeIn second <?php if (isset($classes)) echo $classes; ?>"><?php if (isset($registermsg)) echo $registermsg; ?></div>
      <input type="submit" class="fadeIn third" value="Registeren">
    </form>

    <!-- Link naar inlog pagina -->
    <div id="formFooter">
      <a class="underlineHover" href="./index.php?content=inloggen">Al een account? Log in!</a>
    </div>

  </div>
</div>