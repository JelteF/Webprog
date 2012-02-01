<?php
  // Wordt gebruikt in topbar.js en topbar.php
  $con = mysql_connect("localhost","webdb1249","uvabookdb");
  if(!$con)
    die('could not connect' . mysql.error());

  /**
   * Controleert of waarde van q gedefineerd is
   * SQL injection is afgehandeld
   */
  if(isset($_GET["q"])) {
    $q = mysql_real_escape_string($_GET["q"]);
  } else {
    $q = "";
  }

  mysql_select_db("webdb1249", $con);

  /**
   * Query dat alleen zoekt op naam van opleiding, omdat de topbar zoekbalk daarvoor bedoelt is
   * Resultaten is gelimiteerd op 15, anders werd het kleine vakje waarin ze komen te lang
   * Als er geen resultaten is op naam van opleiding, dan kan er nog gezocht worden op keywords
   *   Er wordt naar de zoekpagina gelinkt met string die de gebruiker heeft ingevoerd
   * Omdat er maar 15 resulaten worden getoond, is er voor de duidelijkheid en andere resultaten ook 
   *   een link naar de zoekpagina gemaakt
   */
  $result = mysql_query("SELECT id,naam FROM studies WHERE naam LIKE '%$q%' ORDER BY naam ASC LIMIT 0,15");

  if(mysql_num_rows($result)==0) {
    echo "Geen resultaat<br />";
    echo "<p><b><a href='opleidingen.php?search=$q'>Naar zoekpagina</a></b></p>";
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
