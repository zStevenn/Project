<?php
  $userrole = [1,2,3];
  include("./php-scripts/security.php");

  session_unset();
  session_destroy();
  echo '<div class="alert alert-success" role="alert">U bent succesvol uitgelogd. U zult nu worden doorverwezen.</div>';
  header("Refresh: 5; url=./index.php?content=home");
?>