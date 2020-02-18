<?php
// Check if session variable is set.
if (isset($_SESSION["contact"])) {
  switch ($_SESSION["contact"]) {
    case "success":
      $contactclass = "alert alert-success";
      $contactmsg = "Uw bericht is verstuurd. U zult binnen 48 uur een bericht van ons ontvangen.";
      unset($_SESSION["contact"]);
      break;
    case "name":
      $contactclass = "alert alert-danger";
      $contactmsg = "U heeft geen naam ingevuld.";
      unset($_SESSION["contact"]);
      break;
    case "email":
      $contactclass = "alert alert-danger";
      $contactmsg = "U heeft geen email ingevuld.";
      unset($_SESSION["contact"]);
      break;
    case "message":
      $contactclass = "alert alert-danger";
      $contactmsg = "U heeft geen bericht ingevuld.";
      unset($_SESSION["contact"]);
      break;
    default:
      header("Location: index.php?content=error404");
      unset($_SESSION["contact"]);
      break;
  }
}
?>

<div class="container-fluid bg-grey">
  <div class="container">
    <div class="row">
      <!-- Contact informatie -->
      <div class="col-12 col-md-6">
        <h2>Contact PVH</h2>
        <p>(W): Hersenletsel.nl <br>
          (A): Den Heuvel 62 <br>
          (P): 6881 VE Velp <br>
          (L): Netherlands <br>
          (T): Tel. (026) 3512512 <br>
          (E): info@hersenletsel.nl
        </p>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2456.6874411767253!2d5.972447515567574!3d51.99435028280329!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c7a3817d9a8e41%3A0x551c92c31657a5b6!2sDen%20Heuvel%2062%2C%206881%20VE%20Velp!5e0!3m2!1snl!2snl!4v1581944561578!5m2!1snl!2snl" width="90%" height="50%" frameborder="0" style="border:0;"></iframe>
      </div>

      <!-- Formulier -->
      <div class="col-12 col-md-6">
        <h2>Contact</h2>
        <div class="<?php if (isset($contactclass)) echo $contactclass; ?>" role="alert">
          <?php if (isset($contactmsg)) echo $contactmsg; ?>
        </div>
        <form action="index.php?content=script-contact" method="post">
          <div class="form-group">
            <label>Naam *</label>
            <input type="text" class="form-control" id="contactname" name="contactname" required>
          </div>
          <div class="form-group">
            <label>Email adres *</label>
            <input type="email" class="form-control" id="contactemail" name="contactemail" required>
          </div>
          <div class="form-group">
            <label>Telefoonnummer</label>
            <input type="tel" class="form-control" id="contactnumber" name="contactnumber">
          </div>
          <div class="form-group">
            <label>Vraag of opmerking</label>
            <textarea class="form-control" id="contactmessage" name="contactmessage" rows="5"></textarea>
          </div>
          <button type="submit" class="btn btn-primary mb-2">Verzenden</button>
        </form>
      </div>
    </div>
  </div>
</div>