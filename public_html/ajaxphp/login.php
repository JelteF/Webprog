<?php
echo "<div class='pull-right'>";
echo $_GET['ticket'];
echo $_GET["ticket"];
echo isset($_GET['ticket']);
$pageURL = 'http://';
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
  if(stripos($file, "<cas:authenticationFailure") === false){
      $_SESSION['ticket'] = $ticket;
      $startUser = stripos($file,"<cas:user>") + 10;
      $endUser = stripos($file,"</cas:user>");
      $length = $endUser - $startUser;
      $uvanetid = substr($file,$startUser,$length);
      $result = mysql_query("SELECT * FROM users WHERE UvAnetID = '$uvanetid'");
      $validated = true;
      if ($result) $rows = mysql_num_rows($result);

      if (!isset($rows) || $rows == 0)
        mysql_query("INSERT INTO users (UvAnetID, ticket) VALUES ('$uvanetid', '$ticket')");
      else
        mysql_query("UPDATE users SET ticket='$ticket' WHERE UvAnetID=$uvanetid");
  }
}
if ((isset($_SESSION['ticket']) || $validated)&& (!isset($_GET["do"]) || !$_GET["do"]=="logoff")) {
  //user is logged in
  $ticket = $_SESSION['ticket'];
  $result = mysql_query("SELECT * FROM users WHERE ticket='$ticket'");
  if ($result) $rows = mysql_num_rows($result);
  if (isset($rows) && $rows != 0){
    $user1 = mysql_fetch_array($result);
    if(strpos($pageURL, "?") !== false)
        echo "<a class='brand' href='".$pageURL."&do=logoff'>Log uit (".$user1['UvAnetID'].")</a>";
    else
        echo "<a class='brand' href='".$pageURL."?do=logoff'>Log uit (".$user1['UvAnetID'].")</a>";
    $validated = true;
  }
}
else {
  //user is not logged in
  echo "<a class='brand' href='https://bt-lap.ic.uva.nl/cas/login?service=$pageURL'>Log In</a>";
}

if(isset($_GET["do"]) && $_GET["do"]=="logoff"){
    unset($_SESSION["ticket"]);
    session_unset();
    session_destroy();
}
echo "</div>";
?>
