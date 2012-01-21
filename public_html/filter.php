<?php
  $taal = $_GET["taal"];

  $con = mysql_connect("localhost","webdb1249","uvabookdb");
  if (!$con)
    die('could not connect' . mysql.error());
  mysql_select_db("webdb1249", $con);
  
  $result = mysql_query("SELECT id,naam FROM studies WHERE taal='$taal'");
  
  while($row = mysql_fetch_array($result)) {
    echo "<a href='study.php?id=";
    echo $row['id'];
    echo "'>";
    echo $row['naam'];
    echo "</a>";
    echo "<br />";
  }
?>
