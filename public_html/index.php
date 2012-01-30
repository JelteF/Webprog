<?php session_start(); ?>
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
		<div class="welkom">
			<h1>Welkom!</h1>
			<p>UvAbook geeft de gelegenheid aan studenten en docenten, info te delen over studies door middel van foto's, video's, pdf en text bestanden. Op deze manier geven wij gebruikers een beeld van hoe het er op een bepaalde studie aan toe gaat. De beleving van opendagen en meeloopdagen komt bij jou thuis op je scherm!</p>
		</div> 
		<div class="whatsnew">
			<h1>What's new</h1>
			<?php require("ajaxphp/homepage_posts.php") ?>
		</div>
        <div class="row">
          <div class="span16">
          </div>
        </div>
      </div>
    </div>

<?php require("templates/footer.php") ?>
  </body>
</html>
