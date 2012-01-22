<?php

	$naam = $_POST['naam'];
	$type = $_POST['post-type'];
	$content = $_POST['content'];
	$beschrijving = $_POST['beschrijving']; 
	$con2 = mysql_connect("localhost","root","");
	if (!$con2)
	{
		die('Could not connect: ' . mysql_error());
	}
	
	mysql_select_db("webdb1249", $con2);
	mysql_query("INSERT INTO posts (content, type, beschrijving)
	VALUES ('test', 'tst', 'blablabla2222')");
	$query = "SELECT * FROM posts WHERE post = 'img'";
	echo"         <div class='row'>
                <div class='span2'>
                  <p><b>Gepost op:</b></p>
                  <div class='postdate'>
                    <p>17 januari 2012<br />14:59 GMT+1</p>
                  </div>
                  <p><b>Waardering:</b></p>
                  <div class=likes>
                    <p>1 points</p>
                  </div>
                </div>
                <div class='span8'>
                  <p><b><a href='#'>".$naam." (10183159)</a></b></p>
                  <p>type=".$type." content=".$content."</p>
                  <img align='right' width='460' src='images/computer-science-fry.png' class='postimg' />
                  <ul class='pills'>
                    <li><a href='#'>Like</a></li>
                    <li><a href='#'>Dislike</a></li>
                    <li><a href='#'>Share</a></li>
                  </ul>
                </div>
              </div>";
	// echo "bla";
	mysql_close($con2);
	
?>