<?php 
    if($_GET['checked']=="upload"){
        echo "<br /><input name='file' type='file' />";
    }
    else
        echo"<br /><input name='content' class='large' type='text' />"
?>