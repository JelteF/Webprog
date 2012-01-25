<!DOCTYPE html>
<html>
  <head>
    <title>UvAbook</title>
<?php require("templates/head.php") ?>
<script type="text/javascript">
function result(str) {
  //    if(str=="") {
  //      document.getElementById("searchResult").innerHTML="";
  //      return;
  //    }
  if(window.XMLHttpRequest) {
    xmlhttp = new XMLHttpRequest();
  }
  xmlhttp.onreadystatechange = function() {
    if(xmlhttp.readyState==4 && xmlhttp.status==200) {
      document.getElementById("searchResult").innerHTML=xmlhttp.responseText;
    }
  }
  xmlhttp.open("GET","search.php?q="+str,true);
  xmlhttp.send();
}
</script>
  </head>

  <body>
<?php require("templates/topbar.php") ?>
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
        <h5>Welke titel?</h5>
        <input type="radio" name="titel" />BSc
        <input type="radio" name="titel" />MSc
        <input type="radio" name="titel" />Beide
        <h5>Welke voertaal?</h5>
        <input type="radio" name="filterTaal" value="default" />Beide
        <input type="radio" name="filterTaal" value="nl" />Nederlands
        <input type="radio" name="filterTaal" value="en" />Engels
        <h5>Welk interessegebied?</h5>
        (meerdere antwoorden zijn mogelijk)<br />
        <input type="checkbox" name="filterIntresse" value="Aarde Natuur en Milieu" />Aarde Natuur en Milieu<br />
        <input type="checkbox" name="filterIntresse" value="Beta" />Beta<br />
        <input type="checkbox" name="filterIntresse" value="Communicatie Media en ICT" />Communicatie Media en ICT<br />
        <input type="checkbox" name="filterIntresse" value="Economie en Ondernemen" />Economie en Ondernemen<br />
        <input type="checkbox" name="filterIntresse" value="Filosofie en Religie" />Filosofie en Religie<br />
        <input type="checkbox" name="filterIntresse" value="Geschiedenis en Politiek" />Geschiedenis en Politiek<br />
        <input type="checkbox" name="filterIntresse" value="Gezondheid en Welzijn" />Gezondheid en Welzijn<br />
        <input type="checkbox" name="filterIntresse" value="Kunst en Cultuur" />Kunst en Cultuur<br />
        <input type="checkbox" name="filterIntresse" value="Maatschappij en Recht" />Maatschappij en Recht<br />
        <input type="checkbox" name="filterIntresse" value="Mens en Gedrag" />Mens en Gedrag<br />
        <input type="checkbox" name="filterIntresse" value="Opvoeding en Onderwijs" />Opvoeding en Onderwijs<br />
        <input type="checkbox" name="filterIntresse" value="Talen en Culturen" />Talen en Culturen<br />
        <input type="checkbox" name="filterIntresse" value="Techniek Ontwerp en Innovatie" />Techniek Ontwerp en Innovatie<br />
        <h5>Welke faculteit?</h5>
        <input type="checkbox" name="filterFac" value="Economie en Bedrijfskunde" />Economie en Bedrijfskunde<br />
        <input type="checkbox" name="filterFac" value="Geesteswetenschappen" />Geesteswetenschappen<br />
        <input type="checkbox" name="filterFac" value="Geneeskunde" />Geneeskunde<br />
        <input type="checkbox" name="filterFac" value="Maatschappij- en Gedragswetenschappen" />Maatschappij- en Gedragswetenschappen<br />
        <input type="checkbox" name="filterFac" value="Natuurkunde, Wiskunde en Informatica" />Natuurkunde, Wiskunde en Informatica<br />
        <input type="checkbox" name="filterFac" value="Rechtsgeleerdheid" />Rechtsgeleerdheid<br />
        <input type="checkbox" name="filterFac" value="Tandheelkunde" />Tandheelkunde<br />
            </div>
          </div>
          <div class="span10">
            <div class="search">
              <form>
                <input class="input-xxlarge" type="text" placeholder="Zoek een opleiding" onkeyup="result(this.value)" />
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

<?php require("templates/footer.php") ?>
<?php mysql_close($con) ?>
  </body>
</html>
