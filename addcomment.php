<?php

	$naam = $_GET['naam'];
	$type = $_GET['post-type'];
	$content = $_GET['content'];
	$beschrijving = $_GET['beschrijving']; 
	$con = mysql_connect("localhost","root","");
	if (!$con)
	{
		die('Could not connect: ' . mysql_error());
	}
	
	mysql_select_db("webdb1249", $con);
	mysql_query("INSERT INTO posts (content, type, beschrijving)
		VALUES ('Peter', '1', 'bla')");
	mysql_close($con);
?>