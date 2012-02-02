<?php
//reset the weekly score, so every week it starts from zero again
require("connect.php");
mysql_query("UPDATE studies SET score_weekly='0'");
?>
