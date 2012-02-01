<!--
  Deze pagina wordt required in index.php,opleidingen.php en study.php
  Inhoud van deze pagina is banner, navigatie, zoekbar, login
  In navigatie bar is er php code die checked of de link class active moet zijn
    Er is ook een link naar een anchor dat in de footer.php staat
  Informatie over login.php in login.php
-->
<?php 
  $page_name = $_SERVER['PHP_SELF'];
  /**
   * Universeel connect code, close connection staat in footer.php en session start in head.php
   */
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
      <!--
        Zoekbalk, roept na elke input topresult(this.value) AJAX javascript op
        Form geeft "search" waarde door aan opleidingen.php als er op Enter wordt gedrukt
        Placeholder werkt niet in Internet Explorer, in plaats van placeholder wordt javascript
          op events onblur en onfocus gebruikt. 
        Meer informatie over de scripts in topbar.js en topbarsearch.php
        In div met id topbarsearch komt het resultaat van topresult(this.value)
      -->
      <form class="pull-left" action="opleidingen.php" method="GET">
        <input class="input-large" id="topsearchinput" type="text" name="search" onkeyup="topresult(this.value)" onblur="placeholderDefault()" onfocus="placeholderClear()" value="Zoek een opleiding" autocomplete="off" />
      <div id="topbarsearch" style="z-index:10"></div>
      </form>
      <?php require("ajaxphp/login.php"); ?>
    </div>
  </div>
</div>
