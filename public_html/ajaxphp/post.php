<?php

function file_extension($filename)
{
  return "." . end(explode(".", $filename));
}
function get_user_id(){

  return "10183159";
}
function upload_post($con){
  
    $type = mysql_real_escape_string(strip_tags($_POST['post-type']));
    $beschrijving = mysql_real_escape_string(strip_tags($_POST['beschrijving']));
    $studie = mysql_real_escape_string(strip_tags($_POST['studie']));
    $user_id = get_user_id();
    $naam = mysql_real_escape_string(strip_tags($_POST['naam']));
    mysql_select_db("webdb1249", $con);
    mysql_query("INSERT INTO posts (studie, type, beschrijving, score)
        VALUES ('$studie', '$type', '$beschrijving', '1')");
    return mysql_insert_id();
}
$type = $_POST['post-type'];
$content = "";
$post_id = "";
$con = mysql_connect("localhost","webdb1249","uvabookdb");
if (!$con)
{
  $result = "Could not connect to the database:<br />Please try again.";
}
else{
  mysql_select_db("webdb1249", $con);
  if($type == "pdf" || ($type == "img" && $_POST['upload']=="upload")){
    $destination_path = "/datastore/webdb1249/Webprog/public_html/";
    $result = "1";
    if ($type == "img"){
      if($_FILES["file"]["size"] == 0){
          $result = "Er werd geen bestand upgeload.";
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
        $extension = basename($_FILES['file']['name']);
        $extension = ".".file_extension($extension);
        $post_id=upload_post($con);
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
        $post_id=upload_post($con);
        $content="uploads/".$post_id.$extension;
        move_uploaded_file($_FILES['file']['tmp_name'], $destination_path.$content);
      }
    }
  }
  else{
    $content = $_POST['content'];
    if($type == "txt" && empty($content))
        $result = "Er is geen tekst ingevoerd.";
    elseif($type == "img" && empty($content))
        $result = "Er is geen link naar een foto ingevoerd.";
    elseif($type == empty($content))
        $result = "Er is geen youtube link ingevoerd.";
    else{
        $post_id=upload_post($con);
        $result= "1";
    }
  }
  if ($result == "1")
      mysql_query("UPDATE posts SET content='$content' WHERE ID='$post_id'");
}
?>

<script language="javascript" type="text/javascript">
var result = "<?php echo preg_replace("/\r?\n/", "\\n", addslashes($result)); ?>";
var content = "<?php echo preg_replace("/\r?\n/", "\\n", addslashes($content)); ?>";
var post_id= "<?php echo preg_replace("/\r?\n/", "\\n", addslashes($post_id)); ?>";
window.top.window.submit("postForm", result ,content, post_id);
</script>
