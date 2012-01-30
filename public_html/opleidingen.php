<!DOCTYPE html>
<html>
  <head>
    <title>UvAbook</title>
<?php require("templates/head.php"); ?>
    <script type="text/javascript" src="js/search.js"></script>
  </head>

  <body>
<?php require("templates/topbar.php"); ?>
<?php
if(isset($_GET["search"])) {
  $srchquery = mysql_real_escape_string($_GET["search"]);
  $result = mysql_query("SELECT id,naam FROM studies WHERE naam LIKE '%$srchquery%' OR cluster LIKE '%$srchquery%' OR zoekwoorden LIKE '%$srchquery%' ORDER BY naam ASC");
} else {
  $srchquery = "";
  $result = mysql_query("SELECT id,naam FROM studies ORDER BY naam ASC");
}
?>

    <!---container-->
    <div class="container">
      <div class="content">
        <div class="row">
          <div class="span6">
            <div class="filter">
        <h3>Verfijn op</h3></b>
        <h5>Welke voertaal?</h5>
        <form>
          <input type="radio" name="fTaal" checked="yes" onclick="result()" />Beide
          <input type="radio" name="fTaal" onclick="result()" />Nederlands
          <input type="radio" name="fTaal" onclick="result()" />Engels
        </form>
        <h5>Welke titel?</h5>
        <form>
          <input type="radio" name="fTitel" checked="yes" onclick="result()" />Alles<br />
          <input type="radio" name="fTitel" onclick="result()" />Bachelor of Arts (BA)<br />
          <input type="radio" name="fTitel" onclick="result()" />Bachelor of Science (BSc)<br />
          <input type="radio" name="fTitel" onclick="result()" />Certificaat<br />
          <input type="radio" name="fTitel" onclick="result()" />Bachelor of Laws (LLB)<br />
          <input type="radio" name="fTitel" onclick="result()" />Master of Laws (LLM)<br />
          <input type="radio" name="fTitel" onclick="result()" />Master of Arts (MA)<br />
          <input type="radio" name="fTitel" onclick="result()" />MBA<br />
          <input type="radio" name="fTitel" onclick="result()" />Master of Science (MSc)<br />
          <input type="radio" name="fTitel" onclick="result()" />PhD<br />
        </form>
        <h5>Welke studievorm?</h5>
        <form>
          <input type="radio" name="fVorm" checked="yes" onclick="result()" />Alles
          <input type="radio" name="fVorm" onclick="result()" />Voltijd
          <input type="radio" name="fVorm" onclick="result()" />Deeltijd
          <input type="radio" name="fVorm" onclick="result()" />Duaal
        </form>
        <h5>Welk interessegebied?</h5>
        <form>
          <input type="radio" name="fInt" checked="yes" onclick="result()" />Alles<br />
          <input type="radio" name="fInt" onclick="result()" />Aarde Natuur en Milieu<br />
          <input type="radio" name="fInt" onclick="result()" />Beta<br />
          <input type="radio" name="fInt" onclick="result()" />Communicatie Media en ICT<br />
          <input type="radio" name="fInt" onclick="result()" />Economie en Ondernemen<br />
          <input type="radio" name="fInt" onclick="result()" />Filosofie en Religie<br />
          <input type="radio" name="fInt" onclick="result()" />Geschiedenis en Politiek<br />
          <input type="radio" name="fInt" onclick="result()" />Gezondheid en Welzijn<br />
          <input type="radio" name="fInt" onclick="result()" />Kunst en Cultuur<br />
          <input type="radio" name="fInt" onclick="result()" />Maatschappij en Recht<br />
          <input type="radio" name="fInt" onclick="result()" />Mens en Gedrag<br />
          <input type="radio" name="fInt" onclick="result()" />Opvoeding en Onderwijs<br />
          <input type="radio" name="fInt" onclick="result()" />Talen en Culturen<br />
          <input type="radio" name="fInt" onclick="result()" />Techniek Ontwerp en Innovatie<br />
        </form>
        <h5>Welke faculteit?</h5>
        <form>
          <input type="radio" name="fFac" checked="yes" onclick="result()" />Alles<br />
          <input type="radio" name="fFac" onclick="result()" />Economie en Bedrijfskunde<br />
          <input type="radio" name="fFac" onclick="result()" />Geesteswetenschappen<br />
          <input type="radio" name="fFac" onclick="result()" />Geneeskunde<br />
          <input type="radio" name="fFac" onclick="result()" />Maatschappij- en Gedragswetenschappen<br />
          <input type="radio" name="fFac" onclick="result()" />Natuurkunde, Wiskunde en Informatica<br />
          <input type="radio" name="fFac" onclick="result()" />Rechtsgeleerdheid<br />
          <input type="radio" name="fFac" onclick="result()" />Tandheelkunde<br />
        </form>
            </div>
          </div>
          <div class="span10">
            <div class="search">
              <input class="input-xxlarge" name="srchblok" type="text" placeholder="Zoek een opleiding" onkeyup="result()" value="<?php echo $srchquery; ?>" />
            </div>
            <div id="searchResult" class="result">
<?php
if(mysql_num_rows($result)==0) {
  echo "Geen resultaat";
} else {
  while($row = mysql_fetch_array($result)) {
    echo "<a href='study.php?id=";
    echo $row['id'];
    echo "'>";
    echo $row['naam'];
    echo "</a>";
    echo "<br />";
  }
}
?>
            </div>
          </div>
        </div>
      </div>
    </div>

<?php require("templates/footer.php"); ?>
<?php mysql_close($con); ?>
  </body>
</html>
