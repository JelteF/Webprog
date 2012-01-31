<?php $page_name = $_SERVER['PHP_SELF'];
require("../servercode/connect.php");
?>

    <div class="topbanner">
      <img src="images/logo.jpg" alt="Universiteit van Amsterdam" />
    </div>
    <div class="banner">
      <img src="images/banner.jpg" alt="UvAbook" />
    </div>
    <div class="topbar">
      <div class="fill">
        <div class="container">
          <a class="brand" href="http://www.uvabook.nl/">UvAbook</a>
          <ul class="nav">
            <li class="<?php if($page_name=="/index.php") echo "active"; ?>"><a href="index.php">Home</a></li>
            <li class="<?php if($page_name=="/opleidingen.php") echo "active"; ?>"><a href="opleidingen.php">Opleidingen</a></li>
            <li><a href='#contact'>Contact</a></li>
          </ul>
          <form class="pull-left" action="opleidingen.php" method="GET">
            <input class="input-large" type="text" id="forclearing" name="search" placeholder="Zoek een opleiding" onkeyup="topresult(this.value)" autocomplete="off" onblur="clearing()" />
            <div id="topbarsearch" style="z-index:10"></div>
          </form>
          <?php require("ajaxphp/login.php")?>
          </div>
        </div>
      </div>
