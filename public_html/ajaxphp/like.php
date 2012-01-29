<?php
session_start();

$ip = $_SERVER['REMOTE_ADDR'];
$post = $_GET['post_id'];
$up = $_GET['up'];

$con = mysql_connect("localhost","webdb1249","uvabookdb") or die();
mysql_select_db("webdb1249", $con);

$ticket = $_SESSION['ticket'];
$result = mysql_query("SELECT * FROM users WHERE ticket='$ticket'");
$array = mysql_fetch_array($result);
$user_id = $array['id'];

if ($up)
  $newvalue = 1;
else
  $newvalue = -1;

$result = mysql_query("SELECT * FROM votes WHERE voter='$user_id', post='$post'");
if ($array  = mysql_fetch_array($result)) {
  $value = $array['vote'];
  if ($value != 1 && $up)
    $newvalue = 1;
  elseif ($newvalue != -1 && !$up)
    $newvalue = -1;
  mysql_query("INSET INTO votes (voter, post, vote) VALUES ('$user_id', '$post', '$newvalue')");
}

if ($newvalue != 0)
  mysql_query("UPDATE posts SET score=score+$value, score_week=score_week+$value WHERE    id='$post'");


?>
