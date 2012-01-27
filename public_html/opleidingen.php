<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <title>UvAbook</title>
<?php require("templates/head.php"); ?>
    <script type="text/javascript">
function result() {
  //    if(str=="") {
  //      document.getElementById("searchResult").innerHTML="";
  //      return;
  //    }
  for(taal = 0; taal < 3; taal++) {
      if (filterTaal.fTaal[taal].checked)
          break;
  }
  for(titel = 0; titel < 10; titel++) {
      if (filterTitel.fTitel[titel].checked)
          break;
  }
  for(studievorm = 0; studievorm < 4; studievorm++) {
      if (filterVorm.fVorm[studievorm].checked)
          break;
  }
  for(intr = 0; intr < 14; intr++) {
      if (filterInt.fInt[intr].checked)
          break;
  }
  for(fac = 0; fac < 8; fac++) {
      if (filterFac.fFac[fac].checked)
          break;
  }
  
  str = srch.srchblok.value;

  if(window.XMLHttpRequest) {
    xmlhttp = new XMLHttpRequest();
  }
  xmlhttp.onreadystatechange = function() {
    if(xmlhttp.readyState==4 && xmlhttp.status==200) {
      document.getElementById("searchResult").innerHTML=xmlhttp.responseText;
    }
  }
  xmlhttp.open("GET","ajaxphp/search.php?q="+str+"&tl="+taal+"&tt="+titel+"&sv="+studievorm+"&it="+intr+"&fc="+fac,true);
  xmlhttp.send();
}
    </script>
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
          <input type="radio" name="fTaal" checked="yes" onchange="result()" />Beide
          <input type="radio" name="fTaal" onchange="result()" />Nederlands
          <input type="radio" name="fTaal" onchange="result()" />Engels
        </form>
        <h5>Welke titel?</h5>
        <form name="filterTitel">
          <input type="radio" name="fTitel" checked="yes" onchange="result()" />Alles<br />
          <input type="radio" name="fTitel" onchange="result()" />BA<br />
          <input type="radio" name="fTitel" onchange="result()" />BSc<br />
          <input type="radio" name="fTitel" onchange="result()" />Certificaat<br />
          <input type="radio" name="fTitel" onchange="result()" />LLB<br />
          <input type="radio" name="fTitel" onchange="result()" />LLM<br />
          <input type="radio" name="fTitel" onchange="result()" />MA<br />
          <input type="radio" name="fTitel" onchange="result()" />MBA<br />
          <input type="radio" name="fTitel" onchange="result()" />MSc<br />
          <input type="radio" name="fTitel" onchange="result()" />PhD<br />
        </form>
        <h5>Welke studievorm?</h5>
        <form name="filterVorm">
          <input type="radio" name="fVorm" checked="yes" onchange="result()" />Alles<br />
          <input type="radio" name="fVorm" onchange="result()" />Voltijd<br />
          <input type="radio" name="fVorm" onchange="result()" />Deeltijd<br />
          <input type="radio" name="fVorm" onchange="result()" />Dual<br />
        </form>
        <h5>Welk interessegebied?</h5>
        <form name="filterInt">
          <input type="radio" name="fInt" checked="yes" onchange="result()" />Alles<br />
          <input type="radio" name="fInt" onchange="result()" />Aarde Natuur en Milieu<br />
          <input type="radio" name="fInt" onchange="result()" />Beta<br />
          <input type="radio" name="fInt" onchange="result()" />Communicatie Media en ICT<br />
          <input type="radio" name="fInt" onchange="result()" />Economie en Ondernemen<br />
          <input type="radio" name="fInt" onchange="result()" />Filosofie en Religie<br />
          <input type="radio" name="fInt" onchange="result()" />Geschiedenis en Politiek<br />
          <input type="radio" name="fInt" onchange="result()" />Gezondheid en Welzijn<br />
          <input type="radio" name="fInt" onchange="result()" />Kunst en Cultuur<br />
          <input type="radio" name="fInt" onchange="result()" />Maatschappij en Recht<br />
          <input type="radio" name="fInt" onchange="result()" />Mens en Gedrag<br />
          <input type="radio" name="fInt" onchange="result()" />Opvoeding en Onderwijs<br />
          <input type="radio" name="fInt" onchange="result()" />Talen en Culturen<br />
          <input type="radio" name="fInt" onchange="result()" />Techniek Ontwerp en Innovatie<br />
        <h5>Welke faculteit?</h5>
        <form name="filterFac">
          <input type="radio" name="fFac" checked="yes" onchange="result()" />Alles<br />
          <input type="radio" name="fFac" onchange="result()" />Economie en Bedrijfskunde<br />
          <input type="radio" name="fFac" onchange="result()" />Geesteswetenschappen<br />
          <input type="radio" name="fFac" onchange="result()" />Geneeskunde<br />
          <input type="radio" name="fFac" onchange="result()" />Maatschappij- en Gedragswetenschappen<br />
          <input type="radio" name="fFac" onchange="result()" />Natuurkunde, Wiskunde en Informatica<br />
          <input type="radio" name="fFac" onchange="result()" />Rechtsgeleerdheid<br />
          <input type="radio" name="fFac" onchange="result()" />Tandheelkunde<br />
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
