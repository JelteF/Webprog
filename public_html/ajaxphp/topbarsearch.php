<?php
require("../servercode/connect.php");

if(isset($_GET["q"])) {
  $q = mysql_real_escape_string($_GET["q"]);
} else {
  $q = "";
}

$result = mysql_query("SELECT id,naam FROM studies WHERE naam LIKE '%$q%' ORDER BY naam ASC LIMIT 0,15");

if(mysql_num_rows($result)==0) {
  echo "Geen resultaat";
    echo "<b><a href='opleidingen.php?search=$q'>Naar zoekpagina</a></b>";
} else {
  while($row = mysql_fetch_array($result)) {
    echo "<a href='study.php?id=";
    echo $row['id'];
    echo "'>";
    echo $row['naam'];
    echo "</a>";
    echo "<br />";
  }
  echo "<p><b><a href='opleidingen.php?search=$q'>Meer...</a></b></p>";
}

mysql_close($con);
?>
