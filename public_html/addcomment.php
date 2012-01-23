<?php
$con2 = mysql_connect("localhost","webdb1249","uvabookdb");
if (!$con2)
{
  die('Could not connect: ' . mysql_error());
}
$naam = mysql_real_escape_string($_POST['naam']);
$type = mysql_real_escape_string($_POST['post-type']);
$content = mysql_real_escape_string($_POST['content']);
$beschrijving = mysql_real_escape_string($_POST['beschrijving']);
$studie = mysql_real_escape_string($_POST['studie']);
$post_id = mysql_real_escape_string($_POST['post_id']);
$user_id = "10183159";
mysql_select_db("webdb1249", $con);
mysql_query("UPDATE posts SET studie='$studie' WHERE ID='$post_id'");

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
  <p><b><a href='#'>".$naam." (".$user_id.")</a></b></p>
  <p>".$beschrijving;
if($type=="txt")
  echo $content."</p>";
elseif ($type=="img")
  echo "</p><a href=".$content."><img align='right' width='460' src='".$content."' class='postimg' /></a>";
elseif ($type=="pdf")
  echo "</p><a href=".$content.">Download pdf</a>";
echo "<ul class='pills'>
  <li><a href='#'>Like</a></li>
  <li><a href='#'>Dislike</a></li>
  <li><a href='#'>Share</a></li>
  </ul>
  </div>
  </div>";
mysql_close($con2);

?>
