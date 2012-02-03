<?php
session_start();
if($_SERVER["HTTPS"] != "on") {
  header("HTTP/1.1 301 Moved Permanently");
  header('Location: https://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']);
  exit();
}
?>
<link rel="icon" type="image/ico" href="images/favicon.ico" />
<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="css/layout.css" />
<script type="text/javascript" src="js/topbar.js"></script>
