<?php
require('../../servercode/connect.php');//connect met de database
/*
 * Haal alle benodigde informatie uit de database en maak daar een post van die
 * onder de andere posts verschijnt.
 */
$post_id = mysql_real_escape_string(strip_tags($_POST['post_id']));
$row3 = mysql_fetch_array(mysql_query("SELECT * FROM posts WHERE ID=$post_id"));
$date = date("d-m-Y",strtotime($row3['tijd']));
$time = date("h:i:s",strtotime($row3['tijd']));
$score= $row3['score'];
$beschrijving = nl2br($row3['beschrijving']);
$content = nl2br($row3['content']);
$type = $row3['type'];
$date = date("d-m-Y",strtotime($row3['tijd']));
$time = date("h:i:s",strtotime($row3['tijd']));
$user = $row3['auteur'];
$auteur = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE ID='$user'"));
$user_id = $auteur['id'];
if(!empty($auteur['naam'])){
    $naam = $auteur['naam'];
}
else {
    $naam = "Anoniem";
}

echo" <div class='commentblok'>
    <div class='row'>
  <div class='span2'>
  <p><b>Gepost op:</b></p>
  <div class='postdate'>
  <p>".$date."<br />".$time."</p>
  </div>
  <p><b>Waardering:</b></p>
  <div id='likes_$post_id'>
  <p>".$score." points</p>
  </div>
  </div>
  <div class='span8'>
  <p><b><a href='#'>".$naam." (".$user_id.")</a></b></p>
  <div class='comment'>
  <p>".$beschrijving;
if($type=="txt")
    echo $content."</p>";
elseif ($type=="img")
    echo "</p><a href=".$content."><img align='right' width='460' src='".$content."' class='postimg' /></a>";
elseif ($type=="pdf")
    echo "</p><a href=".$content.">Download pdf</a>";
else
    echo "<iframe width='460' height='260' src='http://www.youtube.com/embed/".$content."' allowfullscreen></iframe>";
echo "</div><ul class='pills'>
  <li id='likebtn_$post_id' class='active'><button name='like' onclick='like($post_id, true)'>Like</button></li>
  <li id='dislikebtn_$post_id'><button name='like' onclick='like($post_id, false)'>Dislike</button></li>
  </ul>
  </div>
  </div>
  </div>";
mysql_close($con);

?>
