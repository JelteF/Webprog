<?php
echo "<div class='pull-right'>";

$pageURL = 'http';
$pageURL .= "://";
if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
} else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
}

$con = mysql_connect("localhost","webdb1249","uvabookdb") or die(mysql_error());
mysql_select_db("webdb1249", $con) or die("Database not available");

$validated = false;
if(isset($_GET["ticket"])) {
  //user just logged in, validate and store
  $ticket= $_GET["ticket"];
  $file = file_get_contents("https://bt-lap.ic.uva.nl/cas/serviceValidate?ticket=$ticket&service=$pageURL");
  $_SESSION['ticket'] = $ticket;
  $validated = true;
  $startUser = stripos($file,"<cas:user>") + 10;
  $endUser = stripos($file,"</cas:user>");
  $length = $endUser - $startUser;
  $uvanetid = substr($file,$startUser,$length);

  $result = mysql_query("SELECT * FROM users WHERE UvAnetID = '$uvanetid'");
  if ($result) $rows = mysql_num_rows($result);

  if (!isset($rows) || $rows == 0)
    mysql_query("INSERT INTO users (UvAnetID, ticket) VALUES ('$uvanetid', '$ticket')");
  else
    mysql_query("UPDATE users SET ticket='$ticket' WHERE UvAnetID=$uvanetid");
}

if (isset($_SESSION['ticket']) || $validated) {
  //user is logged in
  $ticket = $_SESSION['ticket'];
  $result = mysql_query("SELECT * FROM users WHERE ticket='$ticket'");
  if ($result) $rows = mysql_num_rows($result);
  if (isset($rows) && $user1 != 0){
    $user1 = mysql_fetch_array($result);
    echo "<a class='brand' href='#'>".$user1['UvAnetID']."</a>";
    $validated = true;
  }
}
else {
  //user is not logged in
  echo "<a class='brand' href='https://bt-lap.ic.uva.nl/cas/login?service=$pageURL'>Log In</a>";
}

echo "</div>";
?>
