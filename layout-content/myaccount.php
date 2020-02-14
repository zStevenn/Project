<?php
$userrole = ['Subscriber', 'Administrator', 'Super Admin'];
include("./php-scripts/security.php");

// Opvragen van gegevens van de huidige inlogger
include("./php-scripts/connectDB.php");
$id = $_SESSION["id"];

// Ophalen van alle user info
$sql = "SELECT * FROM `pro3_users` WHERE `userid` = '$id'";
$result = mysqli_query($conn, $sql);
$userinfo = mysqli_fetch_assoc($result);

// Ophalen van alle persoonlijke info
$sql = "SELECT p.* from `pro3_personalinfo` p
        left join `pro3_users` u on u.userid = p.userid
        where u.userid = '$id'";
$result1 = mysqli_query($conn, $sql);
$pinfo = mysqli_fetch_assoc($result1);
?>

<!-- Content -->
<div class="container-fluid mt-4 mh-fs">
  <div class="container">
    <div class="row mb-4">
      <!-- Navigatie op my account pagina -->
      <div class="col-12 col-lg-2">
        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
          <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Home</a>
          <a class="nav-link" id="v-pills-gegevens-tab" data-toggle="pill" href="#v-pills-gegevens" role="tab" aria-controls="v-pills-gegevens" aria-selected="false">Gegevens</a>
          <a class="nav-link" id="v-pills-highscores-tab" data-toggle="pill" href="#v-pills-highscores" role="tab" aria-controls="v-pills-highscores" aria-selected="false">Highscores</a>
          <a class="nav-link" id="v-pills-berichten-tab" data-toggle="pill" href="#v-pills-berichten" role="tab" aria-controls="v-pills-berichten" aria-selected="false">Berichten</a>
          <a class="nav-link" id="v-pills-instellingen-tab" data-toggle="pill" href="#v-pills-instellingen" role="tab" aria-controls="v-pills-instellingen" aria-selected="false">Instellingen</a>
        </div>
      </div>

      <!-- Content van navigaties -->
      <div class="col-10">
        <div class="tab-content" id="v-pills-tabContent">
          <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
            <h2><?php echo 'Welkom ' . ($pinfo["userid"] ? $pinfo["name"] : 'Gebruiker') . '!'  ?></h2>
            <hr>
            <!-- Card Links -->
            <div class="container">
              <div class="row">
                <div class="col-12 col-md-6 col-lg-4">
                  <div class="card myacc-home-card mt-2 mb-2">
                    <div class="card-body">
                      <h5 class="card-title">Gegevens wijzigen</h5>
                      <p class="card-text">
                        Personaliseer je eigen pagina, en voeg je gegevens toe!
                        We gebruiken uw informatie om uw ervaring op onze website te verbeteren.
                      </p>
                      <a class="card-link" id="v-pills-gegevens-tab" data-toggle="pill" href="#v-pills-gegevens" role="tab" aria-controls="v-pills-gegevens" aria-selected="false">>> Gegevens aanpassen</a>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                  <div class="card myacc-home-card mt-2 mb-2">
                    <div class="card-body">
                      <h5 class="card-title">Afasie Experience!</h5>
                      <p class="card-text"><img class="responsive-img" src="./img/game.png" alt="game.png"></p>
                      <a href="index.php?content=spel" class="card-link">>> Speel nu!</a>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                  <div class="card myacc-home-card mt-2 mb-2">
                    <div class="card-body">
                      <h5 class="card-title">Highscores</h5>
                      <p class="card-text">Bekijk nu je persoonlijke highscores!</p>
                      <a class="card-link" id="v-pills-highscores-tab" data-toggle="pill" href="#v-pills-highscores" role="tab" aria-controls="v-pills-highscores" aria-selected="false">>> Bekijk highscores</a>
                    </div>
                  </div>
                </div>

                <div class="col-12 col-md-6 col-lg-4">
                  <div class="card myacc-home-card mt-2 mb-2">
                    <div class="card-body">
                      <h5 class="card-title">Empty</h5>
                      <p class="card-text">Ppp</p>
                      <a href="#" class="card-link">>> Neem contact op</a>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                  <div class="card myacc-home-card mt-2 mb-2">
                    <div class="card-body">
                      <h5 class="card-title">Empty</h5>
                      <p class="card-text">Ppp</p>
                      <a href="#" class="card-link">>> Neem contact op</a>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                  <div class="card myacc-home-card mt-2 mb-2">
                    <div class="card-body">
                      <h5 class="card-title">Empty</h5>
                      <p class="card-text">Ppp</p>
                      <a href="#" class="card-link">>> Neem contact op</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="tab-pane fade" id="v-pills-gegevens" role="tabpanel" aria-labelledby="v-pills-gegevens-tab">
            <h2>Mijn persoonlijke gegevens</h2>
            <hr>
            <div class="card col-8 myacc-card">
              <div class="card-header">
                Mijn gegevens:
              </div>
              <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong class="col-6">Naam:</strong><span><?php echo $pinfo["name"] . ' ' . $pinfo["infix"] . ' ' . $pinfo["lastname"]; ?></span></li>
                <li class="list-group-item"><strong>Geboortedatum:</strong><span><?php echo $pinfo["birthday"]; ?></span></li>
                <li class="list-group-item"><strong>E-mail:</strong><span><?php echo $userinfo["email"] ?></span></li>
                <li class="list-group-item"><strong>Gebruikersrechten:</strong><span><?php echo $userinfo["userrole"] ?></span></li>
              </ul>
            </div>
            <div class="card col-8 myacc-card">
              <div class="card-header">
                Mijn adres:
              </div>
              <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>Straatnaam:</strong><span><?php echo $pinfo["streetname"] ?></span></li>
                <li class="list-group-item"><strong>Postcode:</strong><span><?php echo $pinfo["postalcode"] ?></span></li>
                <li class="list-group-item"><strong>Stad:</strong><span><?php echo $pinfo["city"] ?></span></li>
              </ul>
            </div>
            <div class="card col-8 myacc-card">
              <div class="card-header">
                Wijzigen:
              </div>
              <ul class="list-group list-group-flush">
                <button type="button" class="list-group-item list-group-item-action" data-toggle="modal" data-target="#editpersonalinfo"><span>Mijn gegevens wijzigen</span></button>
                <button type="button" class="list-group-item list-group-item-action" data-toggle="modal" data-target="#editaddress"><span>Mijn adres wijzigen</span></button>
                <button type="button" class="list-group-item list-group-item-action" data-toggle="modal" data-target="#editlogin"><span>Mijn e-mail / wachtwoord wijzigen</span></button>
              </ul>
            </div>
          </div>

          <div class="tab-pane fade" id="v-pills-highscores" role="tabpanel" aria-labelledby="v-pills-highscores-tab">
            <h2>Mijn highscores</h2>
            <hr>
            <!-- Tabel met highscores -->
          </div>

          <div class="tab-pane fade" id="v-pills-berichten" role="tabpanel" aria-labelledby="v-pills-berichten-tab">
            <h2>Mijn berichten</h2>
            <hr>
            <!-- Accordions met berichten -->
          </div>

          <div class="tab-pane fade" id="v-pills-instellingen" role="tabpanel" aria-labelledby="v-pills-instellingen-tab">
            <h2>Mijn instellingen</h2>
            <hr>
            <!-- Forms met instellingen -->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal gegevens wijzigen -->
<div class="modal fade" id="editpersonalinfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Mijn gegevens wijzigen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="#" method="post">
          <input type="text" name="name" placeholder="Voornaam">
          <input type="text" name="infix" placeholder="Tussenvoegsel">
          <input type="text" name="lastname" placeholder="Achternaam">
          <input type="text" name="birthday" placeholder="Geboortedatum">
          <input class="mt-4" type="password" name="vpassword" placeholder="Huidig wachtwoord">
          <input type="password" name="vpasswordc" placeholder="Herhaal huidig wachtwoord">
          <div class="<?php if (isset($_SESSION["login"])) echo $pwclasses; ?>"><?php if (isset($_SESSION["login"])) echo $editerror; ?></div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Aanpassen</button>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>

<!-- Modal adres wijzigen -->
<div class="modal fade" id="editaddress" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Mijn adres wijzigen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="#" method="post">
          <input type="text" name="streetname" placeholder="Straatnaam">
          <input type="text" name="postalcode" placeholder="Postcode">
          <input type="text" name="city" placeholder="Stad">
          <input class="mt-4" type="password" name="vpassword" placeholder="Huidig wachtwoord">
          <input type="password" name="vpasswordc" placeholder="Herhaal huidig wachtwoord">
          <div class="<?php if (isset($_SESSION["login"])) echo $pwclasses; ?>"><?php if (isset($_SESSION["login"])) echo $editerror; ?></div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Aanpassen</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal adres wijzigen -->
<div class="modal fade" id="editlogin" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Mijn login gegevens wijzigen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="#" method="post">
          <input type="email" name="email" placeholder="Nieuwe e-mail">
          <input type="email" name="email" placeholder="Herhaal nieuwe e-mail">
          <input type="password" name="password" placeholder="Nieuwe wachtwoord">
          <input type="password" name="password" placeholder="Herhaal nieuwe wachtwoord">
          <input class="mt-4" type="email" name="email" placeholder="Huidig e-mail">
          <input type="password" name="vpassword" placeholder="Huidig wachtwoord">
          <input type="password" name="vpasswordc" placeholder="Herhaal huidig wachtwoord">
          <div class="<?php if (isset($_SESSION["login"])) echo $pwclasses; ?>"><?php if (isset($_SESSION["login"])) echo $editerror; ?></div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Aanpassen</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>