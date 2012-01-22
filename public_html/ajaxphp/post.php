<?php

        function file_extension($filename)
        {
            return end(explode(".", $filename));
        }
        $type = $_POST['post-type'];
        $content = "";
        $con = mysql_connect("websec.science.uva.nl","webdb1249","uvabookdb");
        if (!$con)
	{
            $result = "Could not connect to the database:<br />Please try again.";
	}
        else{
            if($type == "pdf" || ($type="img" && $_POST['upload']=="upload")){
                $destination_path = "uvabook.nl/";
                $result = "1";
                $extension = ".".file_extension(basename($_FILES['file']['name']));
                mysql_select_db("webdb1249", $con);
                mysql_query("INSERT INTO uploads (file) VALUES ('')");
                $filename = mysql_insert_id().$extension;
                $content = "uploads/" . $filename;
                echo $_FILES["file"]["type"];
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
                        move_uploaded_file($_FILES['file']['tmp_name'], $destination_path.$content);
                        $content="uploads/". basename($_FILES['file']['name']);
                    }
                }
            }
            else{
                $content = $_POST['content'];
                $result= "1";
                echo $result;
            }
        }
?>

<script language="javascript" type="text/javascript">
    alert("bla");
    var result = "<?php echo preg_replace("/\r?\n/", "\\n", addslashes($result)); ?>";
    var content = "<?php echo preg_replace("/\r?\n/", "\\n", addslashes($content)); ?>";
    window.top.window.submit("postForm", result, content);
</script>   