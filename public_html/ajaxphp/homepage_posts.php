<?php
$logged_in_user = 0;
if (isset($_SESSION['ticket'])){
    $logged_in_user = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE ticket='".$_SESSION['ticket']."'"));
    $logged_in_user = $logged_in_user['id'];\
}

$result = mysql_query("SELECT * FROM posts WHERE type = 'img' OR type = 'vid' ORDER BY tijd DESC LIMIT 0, 3");

while($row = mysql_fetch_array($result)){
	$post_id = $row['ID'];
	$score = $row['score'];
	$beschrijving = nl2br($row['beschrijving']);
  	$content = nl2br($row['content']);
  	$type = $row['type'];
  	$date = date("d-m-Y",strtotime($row['tijd']));
  	$time = date("h:i:s",strtotime($row['tijd']));
  	$user = $row['auteur'];
	$study_id = $row['studie'];
	$study = mysql_fetch_array(mysql_query("SELECT * FROM studies WHERE id ='$study_id'"));
	$study_naam = $study['naam'];
  	$auteur = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE ID ='$user'"));
  	$user_id = $auteur['UvAnetID'];
  	$like = mysql_fetch_array(mysql_query("SELECT * FROM votes WHERE post ='$post_id' AND voter='$logged_in_user'"));
  	$like = $like['vote'];
  	if (!empty($auteur['naam'])){
    	$naam = $auteur['naam'];
  	}
  	else {
    	$naam = "Anoniem";
	}

echo "<div class ='commentblok'>
    <div class ='row'>
    <div class ='span2'>
    <p><b>Gepost op:</b></p>
    <div class ='postdate'>
    <p>".$date."<br />".$time."</p>
    </div>
    <p><b>Waardering:</b></p>
    <div id='likes_$post_id'>
    <p>".$score." points</p>
    </div>

    </div>
    <div class ='span8'>
    <div class ='studie'>
    <h4><b><a href ='study.php?id=$study_id'>".$study_naam."</a></b></h4>
    </div>
    <p><b><a href ='#'>".$naam." (".$user_id.")</a></b></p>
    <p>".$beschrijving;
  if ($type == "txt")
    echo $content."</p>";
  elseif ($type == "img")
    echo "</p><a href = ".$content."><img align ='right' width ='460' src ='".$content."' class ='postimg' /></a>";
  elseif ($type == "pdf")
    echo "</p><a href = ".$content.">Download pdf</a>";
  else
    echo "<iframe width ='460' height ='260' src ='http://www.youtube.com/embed/".$content."' allowfullscreen></iframe>";
  echo "<ul class ='pills'>
    <li><button name='like' onclick='like($post_id, true, $score)'>Like</button></li>
    <li><button name='like' onclick='like($post_id, false, $score)'>Dislike</button></li>
    <li><button name='like' type='submit'>Share</button></li>
    </ul>
    </div>
    </div>
    </div>";
}
?>


