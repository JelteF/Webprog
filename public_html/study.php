<!DOCTYPE html>
<html>
    <head>
        <title>UvAbook</title>
<?php require("templates/head.php") ?>
        <script type="text/javascript" src="js/submit.js"></script>
        <script type="text/javascript" src="js/changeform.js"></script>
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
                    <p><?php echo $row[4]; ?></p>
					<form name="meer">
						<input type="button" value="Meer" />
					</form>
					<div style="display:none;">
						<p><?php echo $row['beschrijving']; ?></p>
					</div>
                </div>
                <!---Heleblok-->
                <div class="row">
                    <!---Linkerblok-->
                    <div class="span10">
                        <!---Sorteerblok-->
                        <div class="row">
                            <div class="span8 offset2">
                                <p class="pull-right">
                                    <b>Sorteer op:</b>
                                    <a class="active" href="#">Populair</a>
                                    ,
                                    <a href="#">Tijd</a>
                                    ,
                                    <a href="#">Waardering</a>
                                </p>
                            </div>
                        </div>
                        <!---Commentblok-->
                        <div class="commentblok">
                            <div class="row">
                                <div class="span2">
                                    <p><b>Gepost op:</b></p>
                                    <div class="postdate">
                                        <p>17 januari 2012<br />14:59 GMT+1</p>
                                    </div>
                                    <p><b>Waardering:</b></p>
                                    <div class=likes>
                                        <p>100 points</p>
                                    </div>
                                </div>
                                <div class="span8">
                                    <p><b><a href="#">Joshua Appelman (6529276)</a></b></p>
                                    <p>Aliquam erat volutpat. Sed cursus molestie mauris, ac interdum nibh rutrum vel. Quisque rhoncus viverra commodo. Vestibulum non tempor velit. Nunc hendrerit erat vitae risus facilisis congue. Sed ac massa libero, ut ultrices mauris.</p>
                                    <iframe width="460" height="260" src="http://www.youtube.com/embed/uSNS4bY6dqM?rel=0" frameborder="0" allowfullscreen></iframe>
                                    <ul class="pills">
                                        <li><a href="#">Like</a></li>
                                        <li><a href="#">Dislike</a></li>
                                        <li><a href="#">Share</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!---/Commentblok-->
                        <!---Commentblok-->
                        <div class="commentblok">
                            <div class="row">
                                <div class="span2">
                                    <p><b>Gepost op:</b></p>
                                    <div class="postdate">
                                        <p>17 januari 2012<br />14:59 GMT+1</p>
                                    </div>
                                    <p><b>Waardering:</b></p>
                                    <div class=likes>
                                        <p>100 points</p>
                                    </div>
                                </div>
                                <div class="span8">
                                    <p><b><a href="#">Joshua Appelman (6529276)</a></b></p>
                                    <p>Aliquam erat volutpat. Sed cursus molestie mauris, ac interdum nibh rutrum vel. Quisque rhoncus viverra commodo. Vestibulum non tempor velit. Nunc hendrerit erat vitae risus facilisis congue. Sed ac massa libero, ut ultrices mauris.</p>
                                    <img align="right" width="460" src="images/computer-science-fry.png" class="postimg" />
                                    <ul class="pills">
                                        <li><a href="#">Like</a></li>
                                        <li><a href="#">Dislike</a></li>
                                        <li><a href="#">Share</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--Nieuw Commentblok-->
                        <div id="newcomment" class="commentblok">
                        </div>
                        <!--Commentblok-->
                        <!--Navblok-->
                        <div class="row">
                            <div class="span8 offset2">
                                <div class="pagination">
                                    <ul>
                                        <li class="prev disabled"><a href="#">&larr; Previous</a></li>
                                        <li class="active"><a href="#">1</a></li>
                                        <li><a href="#">2</a><li>
                                        <li><a href="#">3</a><li>
                                        <li><a href="#">4</a><li>
                                        <li class="disabled"><a href="#">5</a><li>
                                        <li class="disabled"><a href="#">6</a><li>
                                        <li class="disabled"><a href="#">7</a><li>
                                        <li class="disabled"><a href="#">8</a><li>
                                        <li class="next"><a href="#">Next &rarr;</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!---/Navblok-->
                        <!---Interactieblok-->
                        <div class="row">
                            <div class="span8 offset2">
                                <h3>Reageer op deze opleiding!</h3>
                                <div class="input">
                                    <form name="postForm"  action="ajaxphp/post.php" method="post" enctype="multipart/form-data" target="post_target" class="pull-left" onsubmit="startUpload();">
                                        <input name="naam" class="medium" type="text" placeholder="Naam" />
                                        <p></p>
                                        Post: 
                                        <input id="img" type="radio" value="img" name="post-type" checked="true" onclick="contentselect('img');"/>Image
                                        <input id="vid" type="radio" value="vid" name="post-type" onclick="contentselect('vid');"/>Video
                                        <input id="pdf" type="radio" value="pdf" name="post-type" onclick="contentselect('pdf');"/>PDF
                                        <input id="txt" type="radio" value="txt" name="post-type" onclick="contentselect('txt');"/>Tekst
                                        <p></p>
                                        <div id="uploadcontent">
                                            <textarea name="beschrijving" class="span8" rows="4" type="text" placeholder="No need to register! Just log in with your UvAnetID" ></textarea>
                                            <br /><br />Upload een foto of link naar een foto:<br />
                                            Link   <input id="link" type="radio" value="link" name="upload" checked="true" onclick="uploadselect('link');" />
                                            Upload   <input id="upload" type="radio" value="upload" name="upload" onclick="uploadselect('upload');" />
                                            <div id="uploadstyle">
                                                <br /><input name="content" class="large" type="text" />
                                            </div>
                                        </div>
                                        <br />
                                        <button class="btn" type="submit" name="submitBtn">Submit</button>
                                    </form>
                                    <div id="uploading"></div>
                                    <iframe id="post_target" name="post_target" src="#" style="width:0;height:0;border:0px solid #fff;"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!---Rechterblok-->
                    <div class="span6">
                        <!---Informatieblok-->
                        <div class="infobox-tab">
                            <ul class="tabs">
                                <li class="active"><a href="#">Info</a></li>
                                <li><a href="#">Vakken</a></li>
                                <li><a href="#">Eisen</a></li>
                                <li><a href="#">Open Dagen</a></li>
                            </ul>
                        </div>
                        <div class="infobox-study">
                            <p><b>Studielast: </b><?php echo $row[5]; echo " studiepunten"; ?></p>
                            <p><b>Taal: </b><?php echo $row[6]; ?></p>
                            <p><b>Studieduur: </b><?php echo $row[8]; echo " maanden"; ?></p>
                            <p><b>Studievorm: </b><?php echo $row[7]; ?></p>
                            <p><b>Titel: </b><?php echo $row[9]; ?></p>
                            <p><b>Faculteit: </b><?php echo $row[11]; ?></p>
                            <p><b>CROHO-code: </b><?php echo $row[10]; ?></p>
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
        
<?php require("templates/footer.php") ?>
<?php mysql_close($con) ?>
    </body>
</html>
