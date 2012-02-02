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
                <li id="tab1" class="active"><a onclick="tab3()">Statistieken</a></li>
                <li id="tab2"><a onclick="ta42()">Statestieken</a></li>
              </ul>
            </div>
            <div id="info1" class="infobox-study">
            	<?php
					echo "mysql_fetch_array(mysql_query('SELECT studie count(studie) from posts GROUP BY studie ORDER BY COUNT(studie) DESC')";
				?>
            </div>
            <div id="info2" style="display:none" class="infobox-study">
              inhoud2
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
