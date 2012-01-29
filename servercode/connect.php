<?php
$con = mysql_connect("localhost","webdb1249","uvabookdb");
if (!$con)
{
  die('Could not connect: ' . mysql_error());
}
mysql_select_db("webdb1249", $con);
?>