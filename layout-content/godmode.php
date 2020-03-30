<?php
// Assign users that are allowed to visit this page
$userrole = [4];
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

// Ophalen van userrole van de gebruiker
$sql = "SELECT r.userrole from `pro3_userrole` r
        LEFT JOIN `pro3_users` u on u.userroleid = r.userroleid
        WHERE u.userroleid = '$userrole'";
$result2 = mysqli_query($conn, $sql);
$userrole = mysqli_fetch_row($result2);

// Ophalen van highscores van de gebruiker
$sql = "SELECT * FROM `pro3_highscores` WHERE `userid` = '$id'";
$hsresult = mysqli_query($conn, $sql);

$highscores = "";

while ($highscore = mysqli_fetch_assoc($hsresult)) {
  $highscores .= "<tr>
                    <td>" . $highscore["score"] . "</td>
                    <td scope='row'>" . $highscore["naam"] . "</td>
                    <td><a href='index.php?content=godmode_delete&id=" . $highscore["highscoreid"] . "&type=highscore' ><i class='fas fa-trash-alt'></i></a></td>
                  </tr>";
};

// Ophalen van alle berichten verstuurd door deze gebruiker
$sql = "SELECT * FROM `pro3_contactmsg`";
$result3 = mysqli_query($conn, $sql);

$berichten = "";

while ($bericht = mysqli_fetch_assoc($result3)) {
  $berichten .= "<tr><td scope='row'><i class='fas fa-envelope'></i> Contactmail " . $bericht["cname"] . "</td>
                <td>" . $bericht["cdate"] . "</td>
                <td>" . $bericht["cname"] . "</td>
                <td>" . $bericht["cnumber"] . "</td>
                <td><span><a href='index.php?content=readmessage&id= " . $bericht["contactid"] . "'>Bekijk bericht</a></span></td>
                <td><a href='index.php?content=godmode_delete&id=" . $bericht["contactid"] . "&type=mail' ><i class='fas fa-trash-alt'></i></a></td>
                </tr>";
};
?>

<!-- Navbar op de myaccount pagina -->
<div class="container-fluid">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <nav class="nav nav-pills nav-fill">
          <a class="nav-item nav-link" href="#gegevens">Gegevens</a>
          <a class="nav-item nav-link" href="#highscores">Highscores</a>
          <a class="nav-item nav-link" href="#berichten">Berichten</a>
        </nav>
      </div>
    </div>
  </div>
</div>

<!-- Content van pagina -->
<div class="container-fluid">
  <div class="container">
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
      <div class="col-12">
        <table id="tableHighscores" class="table table-hover myacc-card tablelinks" width="100%">
          <thead>
            <tr>
              <th scope="col">Score</th>
              <th scope="col">Naam</th>
              <th scope="col">Wissen</th>
            </tr>
          </thead>
          <tbody>
            <?php echo $highscores ?>
          </tbody>
        </table>
      </div>
    </div>
    <!-- Berichten -->
    <div class="row">
      <div class="col-12">
        <h2 class="text-center" id="berichten">Berichten</h2>
        <hr>
      </div>
      <div class="col-12">
        <table id="tableMessages" class="table table-hover myacc-card tablelinks" width="100%">
          <thead>
            <tr>
              <th scope="col">Bericht</th>
              <th scope="col">Datum</th>
              <th scope="col">Naam</th>
              <th scope="col">Nummer</th>
              <th scope="col">Bekijk</th>
              <th scope="col">Wissen</th>
            </tr>
          </thead>
          <tbody>
            <?php echo $berichten ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>