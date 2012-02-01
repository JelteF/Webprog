<!DOCTYPE html>
<html>
  <head>
    <title>UvAbook: Opleidingen</title>
    <?php
      if(file_exists("templates/head.php"))
        require("templates/head.php");
      else
        echo "head.php not found!";
    ?>
    <script type="text/javascript" src="js/search.js"></script>
  </head>

  <body>
    <?php
      if(file_exists("templates/topbar.php"))
        require("templates/topbar.php");
      else
        echo "topbar.php not found!";

      /**
       * PHP code voor het controleren het waarde van "search" moet gebruiken
       * "search" wordt gestuurd door de zoekbalk in de navigatiebalk. Deze zit in
       *   topbar.php
       * Wanneer het gebruikt wordt, dan wordt er een query gedaan met die waarde
       * Anders wordt de waarde "Zoek een opleiding" als placeholder en wordt er 
       *   een default query gedaan.
       */
      if(isset($_GET["search"])) {
        $srchquery = mysql_real_escape_string($_GET["search"]);
        $result = mysql_query("SELECT id,naam FROM studies WHERE naam LIKE '%$srchquery%' OR cluster LIKE '%$srchquery%' OR zoekwoorden LIKE '%$srchquery%' ORDER BY naam ASC");
      } else {
        $srchquery = "Zoek een opleiding";
        $result = mysql_query("SELECT id,naam FROM studies ORDER BY naam ASC");
      }
    ?>
    <div class="container">
      <div class="content">
        <div class="row">
          <div class="span6">
            <!--
              De lijst met alle opties voor het filteren van zoekresultaten
              Elke optie is een radiobutton. Wanneer er op geklikt wordt, 
              een javascript result() aanroept (een AJAX script)
              ID van de radiobuttons wordt gebruikt door result()
              Er is ook een button die javascript resetFilter() aanroept
              Voor details over de javascript functies, zie search.js
            -->
            <div class="filter">
              <h3>Verfijn op</h3>
              <input class="pull-right" type="button" onclick="resetFilter()" value="Reset filter" />
              <h5>Welke voertaal?</h5>
              <form>
                <input id="taal0" type="radio" name="fTaal" onclick="result()" checked />Beide
                <input id="taal1" type="radio" name="fTaal" onclick="result()" />Nederlands
                <input id="taal2" type="radio" name="fTaal" onclick="result()" />Engels
              </form>
              <h5>Welke titel?</h5>
              <form>
                <input id="titel0" type="radio" name="fTitel" onclick="result()" checked />Alles<br />
                <input id="titel1" type="radio" name="fTitel" onclick="result()" />Bachelor of Arts (BA)<br />
                <input id="titel2" type="radio" name="fTitel" onclick="result()" />Bachelor of Science (BSc)<br />
                <input id="titel3" type="radio" name="fTitel" onclick="result()" />Certificaat<br />
                <input id="titel4" type="radio" name="fTitel" onclick="result()" />Bachelor of Laws (LLB)<br />
                <input id="titel5" type="radio" name="fTitel" onclick="result()" />Master of Laws (LLM)<br />
                <input id="titel6" type="radio" name="fTitel" onclick="result()" />Master of Arts (MA)<br />
                <input id="titel7" type="radio" name="fTitel" onclick="result()" />MBA<br />
                <input id="titel8" type="radio" name="fTitel" onclick="result()" />Master of Science (MSc)<br />
                <input id="titel9" type="radio" name="fTitel" onclick="result()" />PhD<br />
              </form>
              <h5>Welke studievorm?</h5>
              <form>
                <input id="studievorm0" type="radio" name="fVorm" onclick="result()" checked />Alles
                <input id="studievorm1" type="radio" name="fVorm" onclick="result()" />Voltijd
                <input id="studievorm2" type="radio" name="fVorm" onclick="result()" />Deeltijd
                <input id="studievorm3" type="radio" name="fVorm" onclick="result()" />Duaal
              </form>
              <h5>Welk interessegebied?</h5>
              <form>
                <input id="intr0" type="radio" name="fInt" onclick="result()" checked />Alles<br />
                <input id="intr1" type="radio" name="fInt" onclick="result()" />Aarde Natuur en Milieu<br />
                <input id="intr2" type="radio" name="fInt" onclick="result()" />Beta<br />
                <input id="intr3" type="radio" name="fInt" onclick="result()" />Communicatie Media en ICT<br />
                <input id="intr4" type="radio" name="fInt" onclick="result()" />Economie en Ondernemen<br />
                <input id="intr5" type="radio" name="fInt" onclick="result()" />Filosofie en Religie<br />
                <input id="intr6" type="radio" name="fInt" onclick="result()" />Geschiedenis en Politiek<br />
                <input id="intr7" type="radio" name="fInt" onclick="result()" />Gezondheid en Welzijn<br />
                <input id="intr8" type="radio" name="fInt" onclick="result()" />Kunst en Cultuur<br />
                <input id="intr9" type="radio" name="fInt" onclick="result()" />Maatschappij en Recht<br />
                <input id="intr10" type="radio" name="fInt" onclick="result()" />Mens en Gedrag<br />
                <input id="intr11" type="radio" name="fInt" onclick="result()" />Opvoeding en Onderwijs<br />
                <input id="intr12" type="radio" name="fInt" onclick="result()" />Talen en Culturen<br />
                 <input id="intr13" type="radio" name="fInt" onclick="result()" />Techniek Ontwerp en Innovatie<br />
              </form>
              <h5>Welke faculteit?</h5>
              <form>
                <input id="fac0" type="radio" name="fFac" onclick="result()" checked />Alles<br />
                <input id="fac1" type="radio" name="fFac" onclick="result()" />Economie en Bedrijfskunde<br />
                <input id="fac2" type="radio" name="fFac" onclick="result()" />Geesteswetenschappen<br />
                <input id="fac3" type="radio" name="fFac" onclick="result()" />Geneeskunde<br />
                <input id="fac4" type="radio" name="fFac" onclick="result()" />Maatschappij- en Gedragswetenschappen<br />
                <input id="fac5" type="radio" name="fFac" onclick="result()" />Natuurkunde, Wiskunde en Informatica<br />
                <input id="fac6" type="radio" name="fFac" onclick="result()" />Rechtsgeleerdheid<br />
                <input id="fac7" type="radio" name="fFac" onclick="result()" />Tandheelkunde<br />
              </form>
            </div>
          </div>
          <div class="span10">
            <!--
              Tekstvak voor het invullen van een zoekwoord
              Elke input roept javascript result() aan (een AJAX script)
              ID van het tekstvak wordt gebruikt door result()
              Als er op het tekstvak wordt geklikt roept het javascript clearTextValue() aan
              Andersom roept het javascript defaultTextValue() aan
              Voor details over de javascript functies, zie search.js
            -->
            <div class="search">
              <input class="input-xxlarge" id="srchblok" type="text" onkeyup="result()" onfocus="clearTextValue()" onblur="defaultTextValue()" value="<?php echo $srchquery; ?>" />
            </div>
            <!--De div dat wordt gebruikt door het result() script-->
            <div class="result" id="searchResult">
            <?php
              /**
               * PHP code voor het printen van de query
               * Als er niets wordt gevonden, wordt het aangegeven
               * De geprinte query wordt vervangen door AJAX als er gezocht wordt doormiddel van de tekstvak
               */
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
    <?php
      if(file_exists("templates/footer.php"))
        require("templates/footer.php");
      else
        echo "footer.php not found!";
    ?>
  </body>
</html>
