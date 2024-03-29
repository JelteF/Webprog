<!DOCTYPE html>
<html>
  <head>
    <title>UvAbook</title>
    <?php
      if(file_exists("templates/head.php"))
        require("templates/head.php");
      else
        echo "head.php not found!";
    ?>
    <script type="text/javascript" src="js/indextab.js"></script>
    <script type="text/javascript" src="js/like.js"></script>
  </head>

  <body>
    <?php 
      if(file_exists("templates/topbar.php"))
        require("templates/topbar.php");
      else
        echo "topbar.php not found!";
    ?>
    <div class="container">
      <div class="content">
        <div class="hero-unit">
          <h1>Welkom!</h1>
          <p>UvAbook geeft de gelegenheid aan studenten en docenten, info te delen over studies door middel van foto's, video's, pdf en text bestanden. Op deze manier geven wij gebruikers een beeld van hoe het er op een bepaalde studie aan toe gaat. De beleving van opendagen en meeloopdagen komt bij jou thuis op je scherm!</p>
        </div> 
        <div class="row">
          <div class="span11">
			<div class="infobox-tab" style="color:white">
              <ul class="tabs">
                <li id="tab1" class="active"><a onclick="tab1()">Whats new</a></li>
                <li id="tab2"><a onclick="tab2()">Week top5</a></li>
              </ul>
            </div>
            <div id="info1" class="infobox-study">
            <!--
            Hieronder wordt de php file aangeroepen die de populairste, meest recente en best gewardeerde posts bevat.
            -->
             <?php
              if(file_exists("ajaxphp/homepage_posts.php")){
                include("ajaxphp/homepage_posts.php");
				print_query($result, $logged_in_user);
			 }
              else
                echo "homepage_posts.php not found!";
            ?>
            </div>
            <div id="info2" style="display:none" class="infobox-study">
              <?php
              if(file_exists("ajaxphp/homepage_posts.php")){
                include("ajaxphp/homepage_posts.php");
				print_query($result2, $logged_in_user);
			  }
              else
                echo "homepage_posts.php not found!";
            ?>
            </div>
          </div>
          <div class="span5">
            <div class="infobox-tab">
              <ul class="tabs">
                <li class="active"><a>Studies met de meeste Post</a></li>
              </ul>
            </div>
            <div class="infobox-study">
            <!--
            Hier worden de studies met de meeste posts uit de database gehaald en geprint. 
            -->
            	<?php
            	$mostpost = mysql_query("SELECT studie, naam, count(studie) From posts inner join studies ON posts.studie=studies.id GROUP BY studie ORDER BY COUNT(studie) DESC Limit 0,15");
                while($row = mysql_fetch_array($mostpost)) {
                  echo "<a style='color: white;' href='study.php?id=";
                  echo $row['studie'];
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
    <?php
      if(file_exists("templates/footer.php"))
        require("templates/footer.php");
      else
        echo "footer.php not found!";
    ?>
  </body>
</html>
