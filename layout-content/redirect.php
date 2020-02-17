<?php 
  // Unsetten van session variabelen als gebruiker succesvol heeft ingelogd/geregistreerd/wachtwoord kiezen
  unset($_SESSION["choosepw"]);
  unset($_SESSION["login"]);
  unset($_SESSION["register"]);

  // Stuurt gebruiker door naar hun eigen pagina als ze zijn ingelogd, zo niet worden ze doorgestuurd naar inlog pagina.
  if (isset($_SESSION["userrole"]))
  switch ($_SESSION["userrole"]){
    case "Subscriber":
      header("Location: index.php?content=myaccount");
    break;
    case "Administator":
      header("Location: index.php?content=myaccount");
    break;
    case "Super Admin":
      header("Location: index.php?content=myaccount");
  } else {
    header("Location: index.php?content=inloggen");
  }
?>