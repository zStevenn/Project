<?php 
  unset($_SESSION["choosepw"]);
  unset($_SESSION["login"]);
  unset($_SESSION["register"]);

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