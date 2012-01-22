<?php

	$naam = $_POST['naam'];
	$type = $_POST['post-type'];
	$content = $_POST['content'];
	$beschrijving = $_POST['beschrijving']; 
        $studie = $_POST['studie'];
	$con2 = mysql_connect("localhost","root","");
	if (!$con2)
	{
		die('Could not connect: ' . mysql_error());
	}
	
	mysql_select_db("webdb1249", $con2);
	mysql_query("INSERT INTO posts (studie, content, type, beschrijving)
	VALUES ('$studie', '$content', '$type', '$beschrijving')");
        $post_id = mysql_insert_id();
	echo" <div class='row'>
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
                  <p>".$beschrijving;
        if($type=="txt")
            echo $content."</p>";
        elseif ($type=="img")              
            echo "<img align='right' width='460' src='".$content."' class='postimg' />";
        elseif ($type=="pdf")
            echo "<a href=".$content.">Download pdf</a>";
        echo "<ul class='pills'>
                    <li><a href='#'>Like</a></li>
                    <li><a href='#'>Dislike</a></li>
                    <li><a href='#'>Share</a></li>
                  </ul>
                </div>
              </div>";
	mysql_close($con2);
	
        ?>