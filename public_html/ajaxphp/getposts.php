<?php
$studie_id = $_GET['id'];

$nrOfPosts = 3;
$page = 1;
if (isset($_GET['page'])) $page = $_GET['page'];
$order = 'populair';
if (isset($_GET['order']))
$order = $_GET['order'];
$offset = ($page-1) * $nrOfPosts;

if ($order == 'populair')
  $result = mysql_query("SELECT * FROM posts WHERE studie = '$studie_id' ORDER BY (score/(TIMESTAMPDIFF(MINUTE,TIMESTAMP(tijd),TIMESTAMP(NOW())
  ))) DESC LIMIT $offset, $nrOfPosts");
elseif ($order == 'waardering')
  $result = mysql_query("SELECT * FROM posts WHERE studie = '$studie_id' ORDER BY score DESC, tijd DESC LIMIT $offset, $nrOfPosts");
else
  $result = mysql_query("SELECT * FROM posts WHERE studie = '$studie_id' ORDER BY tijd DESC LIMIT $offset, $nrOfPosts");

while($row2 = mysql_fetch_array($result)){
  $score = $row2['score'];
  $beschrijving = nl2br($row2['beschrijving']);
  $content = nl2br($row2['content']);
  $type = $row2['type'];
  $date = date("d-m-Y",strtotime($row2['tijd']));
  $time = date("h:i:s",strtotime($row2['tijd']));
  $user = $row2['auteur'];
  $auteur = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE ID ='$user'"));
  $user_id = $auteur['UvAnetID'];
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
    <div class = likes>
    <p>".$score." points</p>
    </div>
    </div>
    <div class ='span8'>
    <p><b><a href ='#'>".$naam." (".$user_id.")</a></b></p>
    <p>".$beschrijving;
  if ($type == "txt")
    echo $content."</p>";
  elseif ($type == "img")
    echo "</p><a href = ".$content."><img align ='right' width ='460' src ='".$content."' class ='postimg' /></a>";
  elseif ($type == "pdf")
    echo "</p><a href = ".$content.">Download pdf</a>";
  else
    echo "<iframe width ='460' height ='260' src ='".$content."' frameborder ='0' allowfullscreen></iframe>";
  echo "<ul class ='pills'>
    <li><a href ='#'>Like</a></li>
    <li><a href ='#'>Dislike</a></li>
    <li><a href ='#'>Share</a></li>
    </ul>
    </div>
    </div>
    </div>";
}
?>