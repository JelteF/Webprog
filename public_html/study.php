<!DOCTYPE html>
<html>
  <head>
    <title>UvAbook</title>
    <?php require("templates/head.php") ?>
    <script type="text/javascript" src="js/submit.js"></script>
    <script type="text/javascript" src="js/changeform.js"></script>
    <script type="text/javascript" src="js/like.js"></script>
    <script type="text/javascript" src="js/showhide.js"></script>
    <script type="text/javascript" src="js/studytab.js"></script>
  </head>

  <body>
    <?php require("templates/topbar.php") ?>
    <?php
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
            <div class="newcomment" id="newcomment" >
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
                    <input name="naam" class="medium" type="text" placeholder="Naam" <?php if(!$validated) echo "disabled"; else echo "value='".$user1['naam']."'";?> />
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
            <div class="infobox-tab">
              <ul class="tabs">
                <li id="tab1" class="active"><a onclick="tab1()">Info</a></li>
                <li id="tab2"><a onclick="tab2()">Vakken</a></li>
                <?php
                  if($row[9]=="BA"||($row[9]=="BSc")||($row[9]=="LLB")) {
                    echo "<li id='tab3'><a onclick='tab3()'>Vooropleiding</a></li>";
                  } else {
                    echo "<li id='tab3' style='display:none'><a>Vooropleiding</a></li>";
                  }
                ?>
              </ul>
            </div>
            <div id="info1" class="infobox-study">
              <p><b>Studielast: </b><?php echo $row[5]; echo " studiepunten"; ?></p>
              <p><b>Taal: </b><?php if($row[6]=="en") echo "Engels"; elseif($row[6]=="nl") echo "Nederlands"; else echo "Onbekend"; ?></p>
              <p><b>Studieduur: </b><?php if(($row[8]%12) == 0) { echo $row[8]/12; echo " jaar";} else { echo $row[8]; echo " maanden";} ?></p>
              <p><b>Studievorm: </b><?php if($row[7]=="full-time") echo "Voltijd"; elseif($row[7]=="part-time") echo "Deeltijd"; elseif($row[7]=="dual") echo "Duaal"; else echo "Onbekend" ?></p>
              <p><b>Titel: </b><?php if($row[9]=="BA") echo "Bachelor of Arts (BA)"; elseif($row[9]=="BSc") echo "Bachelor of Science (BSc)"; elseif($row[9]=="certificate") echo "Certificaat"; elseif($row[9]=="LLB") echo "Bachelor of Laws (LLB)"; elseif($row[9]=="LLM") echo "Master of Laws (LLM)"; elseif($row[9]=="MA") echo "Master of Arts (MA)"; elseif($row[9]=="MBA") echo "MBA"; elseif($row[9]=="MSc") echo "Master of Science (MSc)"; elseif($row[9]=="PhD") echo "PhD"; else echo "Onbekend"; ?></p>
              <p><b>Faculteit: </b><?php echo $row[11]; ?></p>
              <p><b>CROHO-code: </b><?php echo $row[10]; ?></p>
            </div>
            <div id="info2" style="display:none" class="infobox-study">
              <p><b>Vakken eerste jaar: </b></p>
              <?php
                $vkarray = explode(",",$row[16]);
                for($j=0; $j<count($vkarray)-1;$j++)
                  echo "<p>$vkarray[$j]</p>";
              ?>
            </div>
            <div id="info3" style="display:none" class="infobox-study">
              <p><b>Cultuur & Maatschappij: </b><br /><?php if($row[17]!="") { $cmarray = explode(",",$row[17]); for($j=0; $j<count($cmarray)-1;$j++) echo "$cmarray[$j]<br />"; } else { echo "Geen extra vakken nodig of Profiel niet toegelaten";} ?></p>
              <p><b>Economie & Maatschappij: </b><br /><?php if($row[18]!="") { $emarray = explode(",",$row[18]); for($j=0; $j<count($emarray)-1;$j++) echo "$emarray[$j]<br />"; } else { echo "Geen extra vakken nodig of Profiel niet toegelaten";} ?></p>
              <p><b>Natuur & Gezondheid: </b><br /><?php if($row[19]!="") { $ngarray = explode(",",$row[19]); for($j=0; $j<count($ngarray)-1;$j++) echo "$ngarray[$j]<br />"; } else { echo "Geen extra vakken nodig of Profiel niet toegelaten";} ?></p>
              <p><b>Natuur & Techniek: </b><br /><?php if($row[20]!="") { $ntarray = explode(",",$row[20]); for($j=0; $j<count($ntarray)-1;$j++) echo "$ntarray[$j]<br />"; } else { echo "Geen extra vakken nodig of Profiel niet toegelaten";} ?></p>
            </div>

          </div>

        </div>

      </div>
    </div>

    <?php require("templates/footer.php"); ?>
  </body>
</html>
