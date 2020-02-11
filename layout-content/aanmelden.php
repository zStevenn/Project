<?php
if (isset($_SESSION["error"])) {
  if ($_SESSION["error"] == true) {
    $error = "Het ingevoerde e-mail adres is al in gebruik. Probeer een andere e-mail.";
    $show_modal = true;
   
  }
} else {
  $show_modal = false;
}
var_dump($_SESSION["error"]);
var_dump($error);

// exit();
// unset($_SESSION["error"]);
?>

<!-- Aanmelden -->
<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Icon -->
    <div class="fadeIn first">
      <i class="fa fa-lock fa-5x"></i>
      <p>Aanmelden</p>
    </div>

    <!-- Aanmeldformulier -->
    <form action="./index.php?content=script-aanmelden" method="post">
      <input type="email" id="login" class="fadeIn second" name="email" placeholder="Email" value="<?php if (isset($_SESSION["email"])) echo $_SESSION["email"] ?>">
      <input type="submit" class="fadeIn third" value="Registeren">
    </form>

    <!-- Link naar inlog pagina -->
    <div id="formFooter">
      <a class="underlineHover" href="./index.php?content=inloggen">Al een account? Log in!</a>
    </div>

  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="loginmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Foutmelding</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php if (isset($_SESSION["error"])) echo $error; ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Sluit</button>
      </div>
    </div>
  </div>
</div>