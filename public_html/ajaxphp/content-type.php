<?php
if($_GET['checked']=="pdf"){
  echo "<textarea name='beschrijving' class='span8' rows='4' type='text'
    placeholder='No need to register! Just log in with your UvAnetID' ></textarea>
    <br /> <br />Upload pdf <input name='file' type='file' />";
}
elseif($_GET['checked']=="vid")
echo"<textarea name='beschrijving' class='span8' rows='4' type='text'
placeholder='No need to register! Just log in with your UvAnetID' ></textarea>
<br /> <br />Youtube link: <input name='content' class='large' type='text' />";
elseif($_GET['checked']=="txt"){
  echo "<textarea name='content' class='span8' rows='4' type='text'
    placeholder='No need to register! Just log in with your UvAnetID' ></textarea>";
}
else {
  echo "<textarea name='beschrijving' class='span8' rows='4' type='text'
    placeholder='No need to register! Just log in with your UvAnetID' ></textarea>
    <br /> <br />Upload een foto of link naar een foto:<br />
    Link   <input id='link' type='radio' value='link' name='upload' checked='true' onclick=\"uploadselect('link');\" />
    Upload   <input id='upload' type='radio' value='upload' name='upload' onclick=\"uploadselect('upload');\" /> <br />
    <div id='uploadstyle'>
    <br /><input name='content' class='large' type='text' />
    </div>";
}

?>
