<?php
/*
 * Deze file wordt aangeroepen om een post up te loaden.
 */

/*
 * Deze functie returnt de extensie van een bestandsnaam.
 */
function file_extension($filename)
{
  $filename = explode(".", $filename);
  return "." . end($filename);
}

/*
 * Deze functie uploadt de post.
 */
function upload_post($user){
    $type = mysql_real_escape_string(strip_tags($_POST['post-type']));
    if (isset($_POST['beschrijving']))
        $beschrijving = mysql_real_escape_string(strip_tags($_POST['beschrijving']));
    else
        $beschrijving = "";
    if (strlen($beschrijving) > 255)
      $post_id = "-1";
    else{
      $user_id = mysql_fetch_array($user);
      $user_id = $user_id['id'];
      $naam = mysql_real_escape_string(strip_tags($_POST['naam']));
      mysql_query("INSERT INTO posts (auteur, type, beschrijving, score, score_week)
          VALUES ('$user_id','$type', '$beschrijving', '1', '1')");
      $post_id=mysql_insert_id();
      mysql_query("UPDATE users SET naam='$naam' WHERE id='$user_id'");
      mysql_query("INSERT INTO votes (voter, post, vote) VALUES ('$user_id', '$post_id', '1')");
    }
    return $post_id;
}
set_include_path("/datastore/webdb1249/htdocs/Youtube");//Include de Youtube API
session_start();
$type = $_POST['post-type'];
$result = "1";
$content = "0";
$post_id = "0";

require("../../servercode/connect.php");//connect met de database

if (!isset($_SESSION['ticket'])){
   $result = "Je bent niet ingelogd. Het kan gewoon met je UvAnetID.";
}

if ($result == "1"){
  $user = "0";
  $ticket = $_SESSION['ticket'];
  $user = mysql_query("SELECT * FROM users WHERE ticket='$ticket'");

  if($type == "pdf" || ($type == "img" && $_POST['upload']=="upload")){
    /*
     * Er wordt een bestand geupload
     */
    $destination_path = "/datastore/webdb1249/Webprog/public_html/";
    if ($type == "img"){
      /*
       * Check of er iets mis is met het bestand, zo niet maak upload het
       * en maak de destination URL de content.
       */
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
        $post_id=upload_post($user);
        $content="uploads/".$post_id.$extension;
        move_uploaded_file($_FILES["file"]["tmp_name"], $destination_path.$content);
      }
    }
    else{
      /*
       * Hetzelfde maar dan voor pdf
       */
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
        $post_id=upload_post($user);
        $content="uploads/".$post_id.$extension;
        move_uploaded_file($_FILES['file']['tmp_name'], $destination_path.$content);
      }
    }
  }
  elseif($type == "vid"){
     $content = $_POST['content'];
     if(empty($content))
        $result = "Er is geen youtube link ingevoerd.";
     else{
         try{
            /*
             * Test of er een youtube url is ingevoerd. Zo ja, maak dan het ID
             * daarvan de content.
             */
            $flag = false;
            $pos1=strpos($content,"youtube.com/watch?");
            $pos2=strpos($content, "youtube.com/v/");
            $pos3=strpos($content, "youtu.be/");
            if($pos1 !== false){
                $pos4 = strpos($content, "v=");
                if($pos4 !== false){
                    $content=substr($content, $pos4+2, 11);
                    $flag = true;
                }
            }
            elseif($pos2 !== false){
                $content=substr($content, $pos2+14, 11);
                $flag = true;
            }
            elseif($pos3 !== false){
                $content=substr($content, $pos3+9, 11);
                $flag = true;
            }
            else{
                $result= "Dit is geen goede Youtube link.";
            }
            if($flag){
                /*
                 * Als er een goede Youtube link, proberen informatie op te
                 * halen om te kijken of de video ook echt bestaat.
                 * Als dat zo is dan uploaden.
                 */
                require_once 'Zend/Loader.php';
                Zend_Loader::loadClass('Zend_Gdata_YouTube');
                $yt = new Zend_Gdata_YouTube();
                $videoEntry = $yt->getVideoEntry($content);
                $post_id = upload_post($user);
                $result = "1";
            }
         }
         catch(Exception $e){
             $result= "De video bestaat niet of het is geen goede Youtube link.";
         }
     }
  }
  else{
    $content = strip_tags($_POST['content']);
    if($type == "txt" && empty($content))
        $result = "Er is geen tekst ingevoerd.";
    elseif(empty($content))
        $result = "Er is geen link naar een foto ingevoerd.";
    elseif($type == "img"){
        $ext = file_extension($content);
        if ($ext != ".gif" && $ext != ".jpg" && $ext != ".jpeg" && $ext != ".png"
                && $ext != ".bmp"){
            $result = "Er is geen link naar een foto ingevoerd.";
        }
    }
    if ($result == "1"){
        $post_id=upload_post($user);
    }
  }
  if($post_id == "-1")
      $result = "De beschrijving is te lang. Hij mag niet langer zijn dan 255 karakters.";
  if ($result == "1")
      mysql_query("UPDATE posts SET content='$content' WHERE ID='$post_id'");
  mysql_close($con);
}
?>
<script type="text/javascript">
var result = "<?php echo preg_replace("/\r?\n/", "\\n", addslashes($result)); ?>";
var content = "<?php echo preg_replace("/\r?\n/", "\\n", addslashes($content)); ?>";
var post_id= "<?php echo preg_replace("/\r?\n/", "\\n", addslashes($post_id)); ?>";
window.top.window.submit(result ,content, post_id);
</script>
