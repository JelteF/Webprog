<?php

        function file_extension($filename)
        {
            return end(explode(".", $filename));
        }
        function get_user_id(){
            
            return "10183159";
        }
        function upload_post($con){
            $type = mysql_real_escape_string($_POST['post-type']);
            $beschrijving = mysql_real_escape_string($_POST['beschrijving']);
            $studie = mysql_real_escape_string($_POST['studie']);
            $user_id = get_user_id();
            $naam = mysql_real_escape_string($_POST['naam']);
            mysql_select_db("webdb1249", $con);
            mysql_query("INSERT INTO posts (studie, type, beschrijving, score)
                VALUES ('$studie', '$type', '$beschrijving', '1')");
            return mysql_insert_id();
        }
        $type = $_POST['post-type'];
        $content = "";
        $con = mysql_connect("localhost","webdb1249","uvabookdb");
        if (!$con)
	{
            $result = "Could not connect to the database:<br />Please try again.";
	}
        else{
            mysql_select_db("webdb1249", $con);
            if($type == "pdf" || ($type="img" && $_POST['upload']=="upload")){
                $destination_path = "/datastore/webdb1249/Webprog/public_html/";
                $result = "1";
                if ($type == "img"){
                    if (($_FILES["file"]["type"] != "image/gif")
                        && ($_FILES["file"]["type"] != "image/jpeg")
                        && ($_FILES["file"]["type"] != "image/png")
                        && ($_FILES["file"]["type"] != "image/pjpeg")
                        && ($_FILES["file"]["type"] != "image/bmp")){
                        $result = "You did not upload an image.<br />".
                            "The file types gif, jpeg, png and bmp are supported.";
                    }
                    elseif(($_FILES["file"]["size"] > 2000000)){
                        $result= "Images can't be larger than 2MB";
                    }
                    elseif($_FILES["file"]["error"] > 0){
                        $result = "Return Code: " . $_FILES["file"]["error"];
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
                    if ($_FILES["file"]["type"] != "application/pdf"){
                        $result = "You did not upload a PDF.<br />";
                    }
                    elseif(($_FILES["file"]["size"] > 2000000)){
                        $result= "Files can't be larger than 2MB";
                    }
                    elseif($_FILES["file"]["error"] > 0){
                        $result = "Return Code: " . $_FILES["file"]["error"];
                    }
                    else{
                        $extension = basename($_FILES['file']['name']);
                        $extension = ".".file_extension($extension);
                        $post_id=upload_post($con);
                        $content="uploads/".$post_id.$extension;
                        move_uploaded_file($_FILES['file']['tmp_name'], $destination_path.$content);
                    }
                }
            }
            else{
                $post_id=upload_post($con);
                $content = $_POST['content'];
                $result= "1";
            }
            mysql_query("UPDATE posts SET content='$content' WHERE ID='$post_id'");
        }
?>

<script language="javascript" type="text/javascript">
    var result = "<?php echo preg_replace("/\r?\n/", "\\n", addslashes($result)); ?>";
    var content = "<?php echo preg_replace("/\r?\n/", "\\n", addslashes($content)); ?>";
    var post_id= "<?php echo preg_replace("/\r?\n/", "\\n", addslashes($post_id)); ?>";
    window.top.window.submit("postForm", result ,content, post_id);
</script>
