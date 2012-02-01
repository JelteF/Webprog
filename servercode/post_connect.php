<?php
$con = mysql_connect("localhost","webdb1249","uvabookdb");
if (!$con)
{
  $result = "Could not connect to the database:<br />Please try again.";
}
else
  mysql_select_db("webdb1249", $con);
?>