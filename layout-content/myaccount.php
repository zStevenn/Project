<?php
// Assign users that are allowed to visit this page
$userrole = [1,2,3,4];
include("./php-scripts/security.php");

// Opvragen van gegevens van de huidige inlogger
include("./php-scripts/connectDB.php");
$id = $_SESSION["id"];
$userrole = $_SESSION["userrole"];

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
$fullname = $pinfo["name"] . ' ' . $pinfo["infix"] . ' ' . $pinfo["lastname"];

$sql = "SELECT r.userrole from `pro3_userrole` r
        LEFT JOIN `pro3_users` u on u.userroleid = r.userroleid
        WHERE u.userroleid = '$userrole'";
$result2 = mysqli_query($conn, $sql);
$userrole = mysqli_fetch_row($result2);

?>


<!-- Navbar op de myaccount pagina -->
<div class="container-fluid">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <nav class="nav nav-pills nav-fill">
          <a class="nav-item nav-link" href="#home">Home</a>
          <a class="nav-item nav-link" href="#gegevens">Gegevens</a>
          <a class="nav-item nav-link" href="#highscores">Highscores</a>
          <a class="nav-item nav-link" href="#berichten">Berichten</a>
          <a class="nav-item nav-link" href="#aanpassen">Aanpassen/wijzigen</a>
        </nav>
      </div>
    </div>
  </div>
</div>

<!-- Content van pagina -->
<div class="container-fluid">
  <div class="container">
    <!-- Cards en intro text -->
    <div class="row">
      <div class="col-12">
        <h2 id="home" class="text-center mt-2"><?php echo 'Welkom ' . (!empty($pinfo["name"]) ? $pinfo["name"] : $userinfo["username"]) . '!'  ?></h2>
        <h5 class="text-center">Op deze pagina kun je je gegevens bekijken.</h5>
        <hr>
        <!-- Container met cards -->
        <div class="container">
          <div class="row">
            <!-- Gegevens wijzigen -->
            <div class="col-12 col-md-6 col-lg-4">
              <div class="card myacc-home-card mt-2 mb-2">
                <div class="card-body">
                  <h5 class="card-title">Gegevens wijzigen</h5>
                  <p class="card-text">
                    Personaliseer je eigen pagina, en voeg je gegevens toe!
                    We gebruiken uw informatie om uw ervaring op onze website te verbeteren.
                  </p>
                  <a class="card-link" href="#aanpassen">>> Gegevens aanpassen</a>
                </div>
              </div>
            </div>
            <!-- Game spelen -->
            <div class="col-12 col-md-6 col-lg-4">
              <div class="card myacc-home-card mt-2 mb-2">
                <div class="card-body">
                  <h5 class="card-title">Afasie Experience!</h5>
                  <p class="card-text"><a href="index.php?content=spel"><img class="img-fluid" src="./img/game.png" alt="game.png"></a></p>
                  <a href="index.php?content=spel" class="card-link">>> Speel nu!</a>
                </div>
              </div>
            </div>
            <!-- Highscores bekijken -->
            <div class="col-12 col-md-6 col-lg-4">
              <div class="card myacc-home-card mt-2 mb-2">
                <div class="card-body">
                  <h5 class="card-title">Highscores</h5>
                  <p class="card-text">Bekijk nu je persoonlijke highscores!</p>
                  <a class="card-link" href="#highscores">>> Bekijk highscores</a>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
    <!-- Persoonlijke gegevens -->
    <div class="row">
      <div class="col-12">
        <h2 class="text-center" id="gegevens">Mijn persoonlijke gegevens</h2>
        <hr>
      </div>
      <!-- Persoonlijke info -->
      <table class="table table-hover col-12 col-md-5 myacc-card">
        <thead>
          <tr>
            <th scope="col">Mijn gegevens</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Gebruikersnaam</td>
            <td><?php echo $userinfo["username"]; ?></td>
          </tr>
          <tr>
            <td>Naam</td>
            <td><?php echo $fullname; ?></td>
          </tr>
          <tr>
            <td>Geboortedatum</td>
            <td><?php echo $pinfo["birthday"]; ?></td>
          </tr>
          <tr>
            <td>Email</td>
            <td><?php echo $userinfo["email"]; ?></td>
          </tr>
          <tr>
            <td>Gebruikersrechten</td>
            <td><?php echo $userrole[0]; ?></td>
          </tr>
        </tbody>
      </table>
      <!-- Mijn adres gegevens -->
      <table class="table table-hover col-12 offset-0 col-md-5 offset-md-2 myacc-card">
        <thead>
          <tr>
            <th scope="col">Mijn adres</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Straatnaam</td>
            <td><?php echo $pinfo["streetname"]; ?></td>
          </tr>
          <tr>
            <td>Postcode</td>
            <td><?php echo $pinfo["postalcode"]; ?></td>
          </tr>
          <tr>
            <td>Stad</td>
            <td><?php echo $pinfo["city"]; ?></td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- Highscores -->
    <div class="row">
      <div class="col-12">
        <h2 class="text-center" id="highscores">Highscores</h2>
        <hr>
      </div>
      <table class="table table-hover col-12 col-md-6 myacc-card tablelinks">
        <thead>
          <tr>
            <th scope="col">Highscores</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>echo highscores</td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- Berichten -->
    <div class="row">
      <div class="col-12">
        <h2 class="text-center" id="berichten">Mijn berichten</h2>
        <hr>
      </div>
      <div class="col-6" id="accordion">
        <div class="card">
          <div class="card-header" id="headingOne">
            <h5 class="mb-0">
              <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                Collapsible Group Item #1
              </button>
            </h5>
          </div>
          <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body">
              Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
            </div>
          </div>

        </div>
      </div>

    </div>

    <!-- Aanpassen/wijzigen -->
    <div class="row">
      <div class="col-12">
        <h2 class="text-center" id="aanpassen">Aanpassen/wijzigen</h2>
        <hr>
      </div>
      <table class="table table-hover col-12 col-md-6 myacc-card tablelinks">
        <thead>
          <tr>
            <th scope="col">Aanpassen/wijzigen</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><a href="index.php?content=editpersonalinfo">Mijn gegevens wijzigen</a></td>
          </tr>
          <tr>
            <td><a href="index.php?content=editaddress">Mijn adres wijzigen</a></td>
          </tr>
          <tr>
            <td><a href="index.php?content=editlogin">Mijn e-mail / wachtwoord wijzigen</a></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>