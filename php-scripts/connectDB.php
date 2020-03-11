<?php
// Inloggen op database en database selecteren
define("SERVERNAME", "localhost");
define("USERNAME", "pro3_superadmin");
define("PASSWORD", "g2WFXQrHGwWP8exF");
define("DATABASENAME", "pro3");

// Contact maken met MySQL-Server
$conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASENAME);
?>