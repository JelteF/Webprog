<?php
echo "<div class='pull-right'>";
/*
 * verkrijg de url om terug gestuurd te kunnen worden door CAS
 */
$pageURL = 'http://';
if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
} else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
}
$pageURL = explode("?ticket", $pageURL);
$pageURL = $pageURL[0];

require("../../servercode/connect.php");

$validated = false;
if(isset($_GET["ticket"])) {
  /*
   * Er staat een ticket in de URL, die moet worden gevalideerd
   */
  $ticket= $_GET["ticket"];
  $file = file_get_contents("https://bt-lap.ic.uva.nl/cas/serviceValidate?ticket=$ticket&service=$pageURL");
  if(stripos($file, "<cas:authenticationFailure") === false){
      /*
       * Het is een geldig ticket dus de user moet een session krijgen.
       * Als hij nog niet eerder heeft ingelogd moet de user een nieuw account
       * krijgen, zo niet moet het ticket bij het oude account geupdate worden.
       */
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
  /*
   * Er is een session gestart, dus de user bestaat en hij wil niet uitloggen.
   */
  $ticket = $_SESSION['ticket'];
  $result = mysql_query("SELECT * FROM users WHERE ticket='$ticket'");
  if ($result) $rows = mysql_num_rows($result);
  if (isset($rows) && $rows != 0){
    $user1 = mysql_fetch_array($result);
    //de inlog knop moet veranderd worden in een log uit knop.
    if(strpos($pageURL, "?") !== false)
        echo "<a class='brand' href='".$pageURL."&do=logoff'>Log uit (".$user1['UvAnetID'].")</a>";
    else
        echo "<a class='brand' href='".$pageURL."?do=logoff'>Log uit (".$user1['UvAnetID'].")</a>";
    $validated = true;
  }
}
else {
  //de user is niet ingelogd dus moet hij naar cas gestuurd worden om in te loggen
  echo "<a class='brand' href='https://bt-lap.ic.uva.nl/cas/login?service=$pageURL'>Log In</a>";
}

if(isset($_GET["do"]) && $_GET["do"]=="logoff"){
    //de user wil uitloggen dus moet de session verwijderd worden.
    unset($_SESSION["ticket"]);
    $_GET['do'] = '';
    unset($_GET['do']);
    session_unset();
    session_destroy();
}
echo "</div>";
?>
