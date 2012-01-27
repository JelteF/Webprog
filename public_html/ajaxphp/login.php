<?php
echo "<div class='pull-right'>";

$url = "http://www.uvabook.nl/".$_SERVER['SCRIPT_NAME'];

$con = mysql_connect("localhost","webdb1249","uvabookdb") or die(mysql_error());
mysql_select_db("webdb1249", $con) or die("Database not available");

$validated = false;

if(isset($_GET["ticket"])) {
  //user just logged in, validate and store
  $ticket= $_GET["ticket"];
  $file = file_get_contents("https://secure.uva.nl/cas/serviceValidate?ticket=$ticket&service=$url");
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
  $row = mysql_fetch_array($result);
  echo "<a class='brand' href='#'>".$row['UvAnetID']."</a>";
}
else {
  //user is not logged in
  echo "<a class='brand' href='https://secure.uva.nl/cas/login?service=$url'>Log In</a>";
}

echo "</div>";
?>
