<?php
$ip = $_SERVER['REMOTE_ADDR'];
$post = $_GET['post_id'];
$up = $_GET['up'];

$con = mysql_connect("localhost","webdb1249","uvabookdb") or die();
mysql_select_db("webdb1249", $con);

if ($up == 'true') {
  mysql_query("UPDATE posts SET score=score+1 WHERE id='$post'");
}
else {
  mysql_query("UPDATE posts SET score=score-1 WHERE id='$post'");
}

//echo $_GET['post_id'] . " " . $_SERVER['REMOTE_ADDR'];
?>
