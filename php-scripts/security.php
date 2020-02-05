<?php
  if ( !isset($_SESSION["id"])) {
    echo '<div class="alert alert-danger" role="alert">U bent niet ingelogd, U wordt doorgestuurd naar de standaard homepage.</div>';
    header("Refresh: 4; url=./index.php?content=home");
    exit();
  } else if ( !in_array($_SESSION["userrole"], $userrole )) {
    echo '<div class="alert alert-danger" role="alert">U heeft niet de juiste gebruikerrol voor deze pagina. U wordt uitgelogd en doorgestuurd naar de standaard homepagina.</div>';
    header("Refresh: 4; url=./index.php?content=logout");
    exit();
  }
?>