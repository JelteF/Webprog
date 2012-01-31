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
		<div class="hero-unit">
          <h1>Welkom!</h1>
          <p>UvAbook geeft de gelegenheid aan studenten en docenten, info te delen over studies door middel van foto's, video's, pdf en text bestanden. Op deze manier geven wij gebruikers een beeld van hoe het er op een bepaalde studie aan toe gaat. De beleving van opendagen en meeloopdagen komt bij jou thuis op je scherm!</p>
		</div> 
		<div class="row">
		  <div class="span10">
		    <div class="whatsnew">
			  <h1>What's new</h1>
			  <?php require("ajaxphp/homepage_posts.php") ?>
		    </div>
            </div>
          <div class="span6">
            <script type='text/javascript'>
            function tab1() {
              document.getElementById('tab1').setAttribute("class","active");
              document.getElementById('tab2').setAttribute("class","");
              document.getElementById('info1').style.display = "block";
              document.getElementById('info2').style.display = "none";
            }
            function tab2() {
              document.getElementById('tab1').setAttribute("class","");
              document.getElementById('tab2').setAttribute("class","active");
              document.getElementById('info1').style.display = "none";
              document.getElementById('info2').style.display = "block";
            }
            </script>
            <div class="infobox-tab">
              <ul class="tabs">
                <li id="tab1" class="active"><a onclick="tab1()">Top 20</a></li>
                <li id="tab2"><a onclick="tab2()">Statestieken</a></li>
              </ul>
            </div>
            <div id="info1" class="infobox-study">
              inhoud
            </div>
            <div id="info2" style="display:none" class="infobox-study">
              inhoud2
            </div>
          </div>
        </div>
      </div>
    </div>

<?php require("templates/footer.php") ?>
  </body>
</html>
