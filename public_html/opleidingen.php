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
          <input type="radio" name="fTaal" checked="yes" onchange="result(srch.srchblok.value)" />Beide
          <input type="radio" name="fTaal" onchange="result(srch.srchblok.value)" />Nederlands
          <input type="radio" name="fTaal" onchange="result(srch.srchblok.value)" />Engels
        </form>
        <h5>Welke titel?</h5>
        <form name="filterTitel">
          <input type="radio" name="fTitel" checked="yes" onchange="result(srch.srchblok.value)" />Alles<br />
          <input type="radio" name="fTitel" onchange="result(srch.srchblok.value)" />BA<br />
          <input type="radio" name="fTitel" onchange="result(srch.srchblok.value)" />BSc<br />
          <input type="radio" name="fTitel" onchange="result(srch.srchblok.value)" />Certificaat<br />
          <input type="radio" name="fTitel" onchange="result(srch.srchblok.value)" />LLB<br />
          <input type="radio" name="fTitel" onchange="result(srch.srchblok.value)" />LLM<br />
          <input type="radio" name="fTitel" onchange="result(srch.srchblok.value)" />MA<br />
          <input type="radio" name="fTitel" onchange="result(srch.srchblok.value)" />MBA<br />
          <input type="radio" name="fTitel" onchange="result(srch.srchblok.value)" />MSc<br />
          <input type="radio" name="fTitel" onchange="result(srch.srchblok.value)" />PhD<br />
        </form>
        <h5>Welke studievorm?</h5>
        <form name="filterVorm">
          <input type="radio" name="fVorm" checked="yes" onchange="result(srch.srchblok.value)" />Alles<br />
          <input type="radio" name="fVorm" onchange="result(srch.srchblok.value)" />Voltijd<br />
          <input type="radio" name="fVorm" onchange="result(srch.srchblok.value)" />Deeltijd<br />
          <input type="radio" name="fVorm" onchange="result(srch.srchblok.value)" />Dual<br />
        </form>
        <h5>Welk interessegebied?</h5>
        <form name="filterInt">
          <input type="radio" name="fInt" checked="yes" onchange="result(srch.srchblok.value)" />Alles<br />
          <input type="radio" name="fInt" onchange="result(srch.srchblok.value)" />Aarde Natuur en Milieu<br />
          <input type="radio" name="fInt" onchange="result(srch.srchblok.value)" />Beta<br />
          <input type="radio" name="fInt" onchange="result(srch.srchblok.value)" />Communicatie Media en ICT<br />
          <input type="radio" name="fInt" onchange="result(srch.srchblok.value)" />Economie en Ondernemen<br />
          <input type="radio" name="fInt" onchange="result(srch.srchblok.value)" />Filosofie en Religie<br />
          <input type="radio" name="fInt" onchange="result(srch.srchblok.value)" />Geschiedenis en Politiek<br />
          <input type="radio" name="fInt" onchange="result(srch.srchblok.value)" />Gezondheid en Welzijn<br />
          <input type="radio" name="fInt" onchange="result(srch.srchblok.value)" />Kunst en Cultuur<br />
          <input type="radio" name="fInt" onchange="result(srch.srchblok.value)" />Maatschappij en Recht<br />
          <input type="radio" name="fInt" onchange="result(srch.srchblok.value)" />Mens en Gedrag<br />
          <input type="radio" name="fInt" onchange="result(srch.srchblok.value)" />Opvoeding en Onderwijs<br />
          <input type="radio" name="fInt" onchange="result(srch.srchblok.value)" />Talen en Culturen<br />
          <input type="radio" name="fInt" onchange="result(srch.srchblok.value)" />Techniek Ontwerp en Innovatie<br />
        <h5>Welke faculteit?</h5>
        <form name="filterFac">
          <input type="radio" name="fFac" checked="yes" onchange="result(srch.srchblok.value)" />Alles<br />
          <input type="radio" name="fFac" onchange="result(srch.srchblok.value)" />Economie en Bedrijfskunde<br />
          <input type="radio" name="fFac" onchange="result(srch.srchblok.value)" />Geesteswetenschappen<br />
          <input type="radio" name="fFac" onchange="result(srch.srchblok.value)" />Geneeskunde<br />
          <input type="radio" name="fFac" onchange="result(srch.srchblok.value)" />Maatschappij- en Gedragswetenschappen<br />
          <input type="radio" name="fFac" onchange="result(srch.srchblok.value)" />Natuurkunde, Wiskunde en Informatica<br />
          <input type="radio" name="fFac" onchange="result(srch.srchblok.value)" />Rechtsgeleerdheid<br />
          <input type="radio" name="fFac" onchange="result(srch.srchblok.value)" />Tandheelkunde<br />
            </div>
          </div>
          <div class="span10">
            <div class="search">
              <form name="srch">
                <input class="input-xxlarge" name="srchblok" type="text" placeholder="Zoek een opleiding" onkeyup="result(this.value)" />
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
