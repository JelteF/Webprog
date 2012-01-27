<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <title>UvAbook</title>
<?php require("templates/head.php") ?>
        <script type="text/javascript" src="js/submit.js"></script>
        <script type="text/javascript" src="js/changeform.js"></script>
        <script type="text/javascript" src="js/like.js"></script>
    </head>
    
    <body>
<?php require("templates/topbar.php") ?>
<?php
$con = mysql_connect("localhost","webdb1249","uvabookdb");
if (!$con)
  die('could not connect' . mysql.error());
  mysql_select_db("webdb1249", $con);

  $studie_id = $_GET["id"];

  $result = mysql_query("SELECT * FROM studies WHERE id='$studie_id'");
  $row = mysql_fetch_row($result);
  echo "<div id='studie_id' class=".$studie_id."></div>";
  ?>
        
        <!---container-->
        <div class="container">
            <div class="content">
                <!---Beschrijvingblok-->
                <div class="hero-unit">
                    <h1><?php echo $row[2]; ?></h1>
                    <p><br /><?php echo $row[4]; ?></p>
                    <script type='text/javascript'>
                    function showHide(){
                      if(document.getElementById('meer').style.display == 'block'){
                        document.getElementById('meer').style.display = 'none';
                        document.getElementById('minder').style.display = 'block';
                      }
                      else if(document.getElementById('meer').style.display == 'none'){
                        document.getElementById('meer').style.display = 'block';
                        document.getElementById('minder').style.display = 'none';
                      }
                    }
                    </script>
                    <div id="meer" style="display:block">
                        <input type="button" onclick="showHide()" value="Meer" />
                    </div>
                    <div id="minder" style="display:none;">
<?php
$paragraphs = explode("\n", $row[3]);
$isList = false;
foreach ($paragraphs as $paragraph) {
  if (empty($paragraph)) continue;
  //else if ($paragraph[0] == "*" || $paragraph[0] == "■" ) {
  else if (!preg_match("/^[a-z]$/i", $paragraph[0])) {
    if (!$isList) {
      echo "<ul>";
      $isList = true;
    }
    while (!preg_match("/^[a-z]$/i", $paragraph[0]))
      $paragraph = substr($paragraph, 1);
    echo "<li>" . $paragraph . "</li>";
  }
  else if ($isList) {
    $isList = false;
    echo "</ul>";
    echo "<p>" . $paragraph . "</p>";
  }
  else
    echo "<p>" . $paragraph . "</p>";
}
?>
                        <input type="button" onclick="showHide()" value="Minder" />
                    </div>
                </div>
                <!---Heleblok-->
                <div class="row">
                    <!---Linkerblok-->
                    <div class="span10">
                        <!---Sorteerblok-->
  <?php require("ajaxphp/changeorder.php") ?>
                        <!--Comments-->
  <?php require("ajaxphp/getposts.php") ?>
                        <!--Nieuw Commentblok-->
                        <div id="newcomment" >
                        </div>
                        <!--Commentblok-->
                        <!--Navblok-->
  <?php require("ajaxphp/changepage.php") ?>
                        <!---/Navblok-->
                        <!---Interactieblok-->
                        <div class="row">
                            <div class="span8 offset2">
                                <h3>Reageer op deze opleiding!</h3>
                                <div class="input">
                                    <form name="postForm"  action="ajaxphp/post.php" method="post" enctype="multipart/form-data" target="post_target" class="pull-left" onsubmit="startUpload();">
                                        <input name="naam" class="medium" type="text" placeholder="Naam" <?php if(!$validated) echo "disabled";?> />
                                        <p></p>
                                        Post:
                                        <input id="img" type="radio" value="img" name="post-type" checked <?php if(!$validated) echo "disabled";?> onclick="contentselect('img') ;"/>Image
                                        <input id="vid" type="radio" value="vid" name="post-type" <?php if(!$validated) echo "disabled";?> onclick="contentselect('vid');"/>Video
                                        <input id="pdf" type="radio" value="pdf" name="post-type" <?php if(!$validated) echo "disabled";?> onclick="contentselect('pdf');"/>PDF
                                        <input id="txt" type="radio" value="txt" name="post-type" <?php if(!$validated) echo "disabled";?> onclick="contentselect('txt');"/>Tekst
                                        <p></p>
                                        <textarea id="textarea" <?php if(!$validated) echo "disabled";?> name="beschrijving" class="span8" rows="4" placeholder="No need to register! Just log in with your UvAnetID" ></textarea>
                                        <div id="uploadcontent">
                                            <br />Upload een foto of link naar een foto:<br />
                                            Link   <input id="link" type="radio" value="link" <?php if(!$validated) echo "disabled";?> name="upload" checked onclick="uploadselect('link');" />
                                            Upload   <input id="upload" type="radio" <?php if(!$validated) echo "disabled";?> value="upload" name="upload" onclick="uploadselect('upload');" />
                                            <div id="uploadstyle">
                                                <br /><input name="content" <?php if(!$validated) echo "disabled";?> class="large" type="text" />
                                            </div>
                                        </div>
                                        <br />
                                        <button class="btn" type="submit" <?php if(!$validated) echo "disabled";?> name="submitBtn">Submit</button>
                                    </form>
                                    <div id="uploading"></div>
                                    <iframe id="post_target" name="post_target" src="" style="width:110;height:110;border:1px solid #fff;"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!---Rechterblok-->
                    <div class="span6">
                        <!---Informatieblok-->
                        <script type='text/javascript'>
                        function tab1() {
                          document.getElementById('tab1').setAttribute("class","active");
                          document.getElementById('tab2').setAttribute("class","");
                          document.getElementById('tab3').setAttribute("class","");
                          document.getElementById('info1').style.display = "";
                          document.getElementById('info2').style.display = "none";
                          document.getElementById('info3').style.display = "none";
                        }
                      function tab2() {
                        document.getElementById('tab1').setAttribute("class","");
                        document.getElementById('tab2').setAttribute("class","active");
                        document.getElementById('tab3').setAttribute("class","");
                        document.getElementById('info1').style.display = "none";
                        document.getElementById('info2').style.display = "";
                        document.getElementById('info3').style.display = "none";
                      }
                      function tab3() {
                        document.getElementById('tab1').setAttribute("class","");
                        document.getElementById('tab2').setAttribute("class","");
                        document.getElementById('tab3').setAttribute("class","active");
                        document.getElementById('info1').style.display = "none";
                        document.getElementById('info2').style.display = "none";
                        document.getElementById('info3').style.display = "";
                      }
                        </script>
                        <div class="infobox-tab">
                            <ul class="tabs">
                                <li id="tab1" class="active"><a onclick="tab1()">Info</a></li>
                                <li id="tab2"><a onclick="tab2()">Vakken</a></li>
                                <li id="tab3"><a onclick="tab3()">Vooropleiding</a></li>
                            </ul>
                        </div>
                        <div id="info1" class="infobox-study">
                            <p><b>Studielast: </b><?php echo $row[5]; echo " studiepunten"; ?></p>
                            <p><b>Taal: </b><?php echo $row[6]; ?></p>
                            <p><b>Studieduur: </b><?php echo $row[8]; echo " maanden"; ?></p>
                            <p><b>Studievorm: </b><?php echo $row[7]; ?></p>
                            <p><b>Titel: </b><?php echo $row[9]; ?></p>
                            <p><b>Faculteit: </b><?php echo $row[11]; ?></p>
                            <p><b>CROHO-code: </b><?php echo $row[10]; ?></p>
                        </div>
                        <div id="info2" style="display:none" class="infobox-study">
                            test test
                        </div>
                        <div id="info3" style="display:none" class="infobox-study">
                            test test test
                        </div>
                        <!---Vragenblok-->
                        <div class="shoutbox">
                            <h3>Want to leave a question?</h3>
                            <div class="input">
                                <input class="xlarge" id="xlInput" name="xlInput" size="30" type="text" />
                            </div>
                            <dl class="shoutbox">
                                <dt>Sat Jan 14 03:34</dt><dd>Voorbeeld van een berichtje</dd>
                                <dt>Sat Jan 14 03:34</dt><dd>Voorbeeld van een berichtje</dd>
                                <dt>Sat Jan 14 03:34</dt><dd>Voorbeeld van een berichtje</dd>
                                <dt>Sat Jan 14 03:34</dt><dd>Voorbeeld van een berichtje</dd>
                                <dt>Sat Jan 14 03:34</dt><dd>Voorbeeld van een berichtje</dd>
                                <dt>Sat Jan 14 03:34</dt><dd>Voorbeeld van een berichtje</dd>
                                <dt>Sat Jan 14 03:34</dt><dd>Voorbeeld van een berichtje</dd>
                                <dt>Sat Jan 14 03:34</dt><dd>Voorbeeld van een berichtje</dd>
                                <dt>Sat Jan 14 03:34</dt><dd>Voorbeeld van een berichtje</dd>
                            </dl>
                        </div>
                        
                    </div>
                    
                </div>
                
            </div>
        </div>
        
<?php require("templates/footer.php"); ?>
<?php mysql_close($con); ?>
    </body>
</html>
