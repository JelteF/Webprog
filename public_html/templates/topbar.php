<script type="text/javascript">
  function topresult(str) {
    if(str.length<=3) {
      document.getElementById("topbarsearch").innerHTML="";
      document.getElementById("topbarsearch").style.border="0px";
      document.getElementById("topbarsearch").style.background="";
      return;
    }
    if(window.XMLHttpRequest) {
      xmlhttp = new XMLHttpRequest();
    }
    xmlhttp.onreadystatechange = function() {
      if(xmlhttp.readyState==4 && xmlhttp.status==200) {
        document.getElementById("topbarsearch").innerHTML=xmlhttp.responseText;
        document.getElementById("topbarsearch").style.border="1px solid #A5ACB2";
	    document.getElementById("topbarsearch").style.background="#000000";
        document.getElementById("topbarsearch").style.padding="5px";
        document.getElementById("topbarsearch").style.width="400px";
        document.getElementById("topbarsearch").style.position="absolute";
      }
    }
    xmlhttp.open("GET","ajaxphp/topbarsearch.php?q="+str,true);
    xmlhttp.send();
  }
  function clearing() {
    document.getElementById("forclearing").value="";
    var x=setTimeout('document.getElementById("topbarsearch").innerHTML=""',10);
    var y=setTimeout('document.getElementById("topbarsearch").style.border="0px"',10);
    var z=setTimeout('document.getElementById("topbarsearch").style.background=""',10);
  }
</script>
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
