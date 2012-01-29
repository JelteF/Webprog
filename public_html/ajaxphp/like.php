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

if ($up == 'true')
  $newvalue = 1;
else
  $newvalue = -1;

$result = mysql_query("SELECT * FROM votes WHERE voter='$user_id' and  post='$post'");
if ($array  = mysql_fetch_array($result)) {
  $value = $array['vote'];

  if ($value == $newvalue)
    $newvalue *= -1;

  echo $value;
  echo $newvalue;

  mysql_query("UPDATE votes SET vote=vote+'$newvalue' WHERE voter='$user_id' and post='$post'");
  mysql_query("UPDATE posts SET score=score+$newvalue, score_week=score_week+$newvalue WHERE id='$post'");
}
else
  mysql_query("INSERT INTO votes (voter, post, vote) VALUES ('$user_id', '$post', '$newvalue')");



?>
