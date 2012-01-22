<?php
  $q = $_GET["q"];

  $con = mysql_connect("localhost","webdb1249","uvabookdb");
  if (!$con)
    die('could not connect' . mysql.error());
  mysql_select_db("webdb1249", $con);
  
  if($q=="")
    $result = mysql_query("SELECT id,naam FROM studies ORDER BY naam");
  else
    $result = mysql_query("SELECT id,naam FROM studies WHERE naam LIKE '%$q%' OR cluster LIKE '%$q%' OR zoekwoorden LIKE '%$q%' ORDER BY naam ASC");

  while($row = mysql_fetch_array($result)) {
    echo "<a href='study.php?id=";
    echo $row['id'];
    echo "'>";
    echo $row['naam'];
    echo "</a>";
    echo "<br />";
  }

  mysql_close($con);
?>
