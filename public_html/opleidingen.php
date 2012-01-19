<!DOCTYPE html>
<html>
  <head>
    <title>UvAbook</title>
<?php require("templates/head.php") ?>
  </head>

  <body>
<?php require("templates/topbar.php") ?>

    <!---container-->
    <div class="container">
      <div class="content">
        <div class="row">
          <div class="span6">
            <div class="filter">
              <h3>Verfijn op</h3></b>
			  <h5>Welke soort opleiding?</h5>
			  <input type="radio" name="filterSoort" value="Alpha opleidingen" />Alpha
			  <input type="radio" name="filterSoort" value="Beta opleidingen" />Beta
			  <input type="radio" name="filterSoort" value="Beide opleidingen" />Beide
			  <h5>Welke voertaal?</h5>
			  <input type="radio" name="filterTaal" value="NL" />Nederlands
			  <input type="radio" name="filterTaal" value="EN" />Engels
			  <input type="radio" name="filterTaal" value="Beide" />Beide
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
              <form action="">
                <input class="input-xlarge" type="text" placeholder="Zoek een opleiding">
                <button class="btn" type="submit">Zoeken</button>
              </form>
            </div>
            <div class="result">
              <a class="resultlink" href="study.html">Informatica</a>
            </div>
          </div>
        </div>
      </div>
    </div>

<?php require("templates/footer.php") ?>
  </body>
</html>
