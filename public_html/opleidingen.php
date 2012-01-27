<?php session_start(); ?>
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
$con = mysql_connect("localhost","webdb1249","uvabookdb");
if (!$con)
  die('could not connect' . mysql.error());

mysql_select_db("webdb1249", $con);

$result = mysql_query("SELECT id,naam FROM studies ORDER BY naam ASC");
?>

    <!---container-->
    <div class="container">
      <div class="content">
        <div class="row">
          <div class="span6">
            <div class="filter">
        <h3>Verfijn op</h3></b>
        <h5>Welke voertaal?</h5>
        <form name="filterTaal">
          <input type="radio" name="fTaal" checked="yes" element.onchange="result()" />Beide
          <input type="radio" name="fTaal" element.onchange="result()" />Nederlands
          <input type="radio" name="fTaal" element.onchange="result()" />Engels
        </form>
        <h5>Welke titel?</h5>
        <form name="filterTitel">
          <input type="radio" name="fTitel" checked="yes" element.onchange="result()" />Alles<br />
          <input type="radio" name="fTitel" element.onchange="result()" />Bachelor of Arts (BA)<br />
          <input type="radio" name="fTitel" element.onchange="result()" />Bachelor of Science (BSc)<br />
          <input type="radio" name="fTitel" element.onchange="result()" />Certificaat<br />
          <input type="radio" name="fTitel" element.onchange="result()" />Bachelor of Laws (LLB)<br />
          <input type="radio" name="fTitel" element.onchange="result()" />Master of Laws (LLM)<br />
          <input type="radio" name="fTitel" element.onchange="result()" />Master of Arts (MA)<br />
          <input type="radio" name="fTitel" element.onchange="result()" />MBA<br />
          <input type="radio" name="fTitel" element.onchange="result()" />Master of Science (MSc)<br />
          <input type="radio" name="fTitel" element.onchange="result()" />PhD<br />
        </form>
        <h5>Welke studievorm?</h5>
        <form name="filterVorm">
          <input type="radio" name="fVorm" checked="yes" element.onchange="result()" />Alles
          <input type="radio" name="fVorm" element.onchange="result()" />Voltijd
          <input type="radio" name="fVorm" element.onchange="result()" />Deeltijd
          <input type="radio" name="fVorm" element.onchange="result()" />Duaal
        </form>
        <h5>Welk interessegebied?</h5>
        <form name="filterInt">
          <input type="radio" name="fInt" checked="yes" element.onchange="result()" />Alles<br />
          <input type="radio" name="fInt" element.onchange="result()" />Aarde Natuur en Milieu<br />
          <input type="radio" name="fInt" element.onchange="result()" />Beta<br />
          <input type="radio" name="fInt" element.onchange="result()" />Communicatie Media en ICT<br />
          <input type="radio" name="fInt" element.onchange="result()" />Economie en Ondernemen<br />
          <input type="radio" name="fInt" element.onchange="result()" />Filosofie en Religie<br />
          <input type="radio" name="fInt" element.onchange="result()" />Geschiedenis en Politiek<br />
          <input type="radio" name="fInt" element.onchange="result()" />Gezondheid en Welzijn<br />
          <input type="radio" name="fInt" element.onchange="result()" />Kunst en Cultuur<br />
          <input type="radio" name="fInt" element.onchange="result()" />Maatschappij en Recht<br />
          <input type="radio" name="fInt" element.onchange="result()" />Mens en Gedrag<br />
          <input type="radio" name="fInt" element.onchange="result()" />Opvoeding en Onderwijs<br />
          <input type="radio" name="fInt" element.onchange="result()" />Talen en Culturen<br />
          <input type="radio" name="fInt" element.onchange="result()" />Techniek Ontwerp en Innovatie<br />
        </form>
        <h5>Welke faculteit?</h5>
        <form name="filterFac">
          <input type="radio" name="fFac" checked="yes" element.onchange="result()" />Alles<br />
          <input type="radio" name="fFac" element.onchange="result()" />Economie en Bedrijfskunde<br />
          <input type="radio" name="fFac" element.onchange="result()" />Geesteswetenschappen<br />
          <input type="radio" name="fFac" element.onchange="result()" />Geneeskunde<br />
          <input type="radio" name="fFac" element.onchange="result()" />Maatschappij- en Gedragswetenschappen<br />
          <input type="radio" name="fFac" element.onchange="result()" />Natuurkunde, Wiskunde en Informatica<br />
          <input type="radio" name="fFac" element.onchange="result()" />Rechtsgeleerdheid<br />
          <input type="radio" name="fFac" element.onchange="result()" />Tandheelkunde<br />
        </form>
            </div>
          </div>
          <div class="span10">
            <div class="search">
              <form name="srch">
                <input class="input-xxlarge" name="srchblok" type="text" placeholder="Zoek een opleiding" onkeyup="result()" />
              </form>
            </div>
            <div id="searchResult" class="result">
<?php
while($row = mysql_fetch_array($result)) {
  echo "<a href='study.php?id=";
  echo $row['id'];
  echo "'>";
  echo $row['naam'];
  echo "</a>";
  echo "<br />";
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
