<?php
// Stuurt gebruiker door naar hun eigen pagina als ze zijn ingelogd, zo niet worden ze doorgestuurd naar inlog pagina.
if (isset($_SESSION["userrole"]))
  switch ($_SESSION["userrole"]) {
    case "Subscriber":
      header("Location: index.php?content=myaccount");
      break;
    case "Administator":
      header("Location: index.php?content=adminpanel");
      break;
    case "Super Admin":
      header("Location: index.php?content=myaccount");
  } else {
  header("Location: index.php?content=inloggen");
}
?>