<?php
set_include_path("../Zend");
function file_extension($filename)
{
  return "." . end(explode(".", $filename));
}
function check_vid_validity(){

}
function upload_post($con, $user){
    mysql_select_db("webdb1249", $con);  
    $type = mysql_real_escape_string(strip_tags($_POST['post-type']));
    if (isset($_POST['beschrijving']))
        $beschrijving = mysql_real_escape_string(strip_tags($_POST['beschrijving']));
    else
        $beschrijving = "";
    $user_id = mysql_fetch_array($user);
    $user_id = $user_id['id'];
    $naam = mysql_real_escape_string(strip_tags($_POST['naam']));
    mysql_query("INSERT INTO posts (auteur, type, beschrijving, score)
        VALUES ('$user_id','$type', '$beschrijving', '1')");
    mysql_query("UPDATE users SET naam='$naam' WHERE id='$user_id'");
    return mysql_insert_id();
}
session_start();
$type = $_POST['post-type'];
$result = "1";
$content = "0";
$post_id = "0";
$con = mysql_connect("localhost","webdb1249","uvabookdb");
if (!isset($_SESSION['ticket'])){
   $result = "Je bent niet ingelogd. Het kan gewoon met je UvAnetID.";
}
elseif (!$con)
{
  $result = "Could not connect to the database:<br />Please try again.";
}
else{
  mysql_select_db("webdb1249", $con);
  echo 'a';
  $user = "0";
  $ticket = $_SESSION['ticket'];
  echo $ticket;
  $user = mysql_query("SELECT * FROM users WHERE ticket='$ticket'");
  
  if($type == "pdf" || ($type == "img" && $_POST['upload']=="upload")){
    $destination_path = "/datastore/webdb1249/Webprog/public_html/";
    $result = "1";
    if ($type == "img"){
      if($_FILES["file"]["size"] == 0){
          $result = "Er is geen bestand aangegeven.";
      }
      elseif (($_FILES["file"]["type"] != "image/gif")
          && ($_FILES["file"]["type"] != "image/jpeg")
          && ($_FILES["file"]["type"] != "image/png")
          && ($_FILES["file"]["type"] != "image/pjpeg")
          && ($_FILES["file"]["type"] != "image/bmp")){
        $result = "Het bestand is geen plaatje.<br />".
          "De formaten gif, jpeg, png en bmp worden gesupport.";
      }
      elseif($_FILES["file"]["size"] > 2000000){
        $result= "Bestanden mogen niet groter zijn dan 2MB.";
      }
      elseif($_FILES["file"]["error"] > 0){
        $result = "Error bij het uploaden: " . $_FILES["file"]["error"];
      }
      else{
        $extension = file_extension($_FILES['file']['name']);
        $post_id=upload_post($con, $user);
        $content="uploads/".$post_id.$extension;
        move_uploaded_file($_FILES["file"]["tmp_name"], $destination_path.$content);
      }
    }
    else{
      if($_FILES["file"]["size"] == 0){
          $result = "Er werd geen bestand upgeload.";
      }
      elseif ($_FILES["file"]["type"] != "application/pdf"){
        $result = "Er werd geen PDF upgeload.";
      }
      elseif(($_FILES["file"]["size"] > 2000000)){
        $result= "Bestanden mogen niet groter zijn dan 2MB.";
      }
      elseif($_FILES["file"]["size"] == 0){
          $result = "Er werd geen bestand upgeload.";
      }
      elseif(empty($_POST['beschrijving'])){
          $result = "De beschrijving was leeg.";
      }
      elseif($_FILES["file"]["error"] > 0){
        $result = "Error bij het uploaden: " . $_FILES["file"]["error"];
      }
      else{
        $extension = file_extension($_FILES['file']['name']);
        $post_id=upload_post($con, $user);
        $content="uploads/".$post_id.$extension;
        move_uploaded_file($_FILES['file']['tmp_name'], $destination_path.$content);
      }
    }
  }
  elseif($type == "vid"){
     $content = $_POST['content'];
     echo $content."<br />";
     if(empty($content))
        $result = "Er is geen youtube link ingevoerd.";
     else{
         try{

            $flag = false;
            $pos1=strpos($content,"youtube.com/watch?v=");
            $pos2=strpos($content, "youtube.com/v/");
            $pos3=strpos($content, "youtu.be/");
            //echo $pos1." ".$pos." ".$pos3."<br />";
            if($pos1 !== false){
                $content=substr($content, $pos1+20, 11);
                $flag = true;
            }
            elseif($pos2 !== false){
                $content=substr($content, $pos2+14, 11);
                $flag = true;
            }
            elseif($pos3 !== false){
                $content=substr($content, $pos3+9, 11);
                $flag = true;
            }
            echo $flag;
            echo $content."<br />";
            if($flag){
                $post_id = upload_post($con, $user);
                $result = "1";
            }
         }
         catch(Exception $e){
             $result= "De video bestaat niet of het is geen goede youtube link.";
         }
     }
  }
  else{
    $content = $_POST['content'];
    if($type == "txt" && empty($content))
        $result = "Er is geen tekst ingevoerd.";
    elseif(empty($content))
        $result = "Er is geen link naar een foto ingevoerd.";
    else{
        $post_id=upload_post($con, $user);
        $result= "1";
    }
  }
  if ($result == "1")
      mysql_query("UPDATE posts SET content='$content' WHERE ID='$post_id'");
}
?>
<script type="text/javascript">
var result = "<?php echo preg_replace("/\r?\n/", "\\n", addslashes($result)); ?>";
var content = "<?php echo preg_replace("/\r?\n/", "\\n", addslashes($content)); ?>";
var post_id= "<?php echo preg_replace("/\r?\n/", "\\n", addslashes($post_id)); ?>";
window.top.window.submit("postForm", result ,content, post_id);
</script>