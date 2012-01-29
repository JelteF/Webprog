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
	<h1>what's new</h1>
	<?php require("ajaxphp/homepage_posts.php") ?>
        <div class="row">
          <div class="span16">
          </div>
        </div>
      </div>
    </div>

<?php require("templates/footer.php") ?>
  </body>
</html>
