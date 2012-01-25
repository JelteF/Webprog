<?php
$con = mysql_connect("localhost","webdb1249","uvabookdb");
if (!$con)
{
  die('Could not connect: ' . mysql_error());
}
mysql_select_db("webdb1249", $con);
$studie_id=$_GET['id'];
$result = mysql_query("SELECT * FROM posts WHERE studie='$studie_id'");
while($row=mysql_fetch_array($result)){
    
    echo" <div class='commentblok'>
        <div class='row'>
    <div class='span2'>
    <p><b>Gepost op:</b></p>
    <div class='postdate'>
    <p>".$date."<br />".$time."</p>
    </div>
    <p><b>Waardering:</b></p>
    <div class=likes>
    <p>".$score." points</p>
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
    </div>
    </div>";
}
mysql_close($con);
?>