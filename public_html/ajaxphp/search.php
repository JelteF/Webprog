<?php
$con = mysql_connect("localhost","webdb1249","uvabookdb");
if(!$con)
  die('could not connect' . mysql.error());

if(isset($_GET["q"])&&isset($_GET["tl"])&&isset($_GET["tt"])&&isset($_GET["sv"])&&isset($_GET["it"])&&isset($_GET["fc"])) {
  $q = mysql_real_escape_string($_GET["q"]);
  $tl = mysql_real_escape_string($_GET["tl"]);
  $tt = mysql_real_escape_string($_GET["tt"]);
  $sv = mysql_real_escape_string($_GET["sv"]);
  $it = mysql_real_escape_string($_GET["it"]);
  $fc = mysql_real_escape_string($_GET["fc"]);
} else {
  $q = "";
  $tl = "";
  $tt = "";
  $sv = "";
  $it = "";
  $fc = "";
}

$qr = "";
$woord1 = "";
$woord2 = "";
$woord3 = "";

if(strpos($q," ") == 0) {
  $qr = $q;
  $woord1 = "AND naam LIKE '%$qr%' OR zoekwoorden LIKE '%$qr%'";
} elseif(strpos($q," ") == 1) {
  $qr = explode(" ", $q);
  $woord1 = "AND naam LIKE '%$qr[0]%' OR zoekwoorden LIKE '%$qr[0]%'";
  $woord2 = "AND naam LIKE '%$qr[1]%' OR zoekwoorden LIKE '%$qr[1]%'";
} elseif(strpos($q," ") == 2) {
  $qr = explode(" ", $q);
  $woord1 = "AND naam LIKE '%$qr[0]%' OR zoekwoorden LIKE '%$qr[0]%'";
  $woord2 = "AND naam LIKE '%$qr[1]%' OR zoekwoorden LIKE '%$qr[1]%'";
  $woord3 = "AND naam LIKE '%$qr[2]%' OR zoekwoorden LIKE '%$qr[2]%'";
} elseif(strpos($q," ") > 2) {
  $qr = explode(" ", $q);
  $woord1 = "AND naam LIKE '%$qr[0]%' OR zoekwoorden LIKE '%$qr[0]%'";
  $woord2 = "AND naam LIKE '%$qr[1]%' OR zoekwoorden LIKE '%$qr[1]%'";
  $woord3 = "AND naam LIKE '%$qr[2]%' OR zoekwoorden LIKE '%$qr[2]%'";
}

if($tl=="1")
  $taal="AND taal='nl'";
elseif($tl=="2")
  $taal="AND taal='en'";
else
  $taal="";

if($tt=="1")
  $titel="AND titel='BA'";
elseif($tt=="2")
  $titel="AND titel='BSc'";
elseif($tt=="3")
  $titel="AND titel='certificate'";
elseif($tt=="4")
  $titel="AND titel='LLB'";
elseif($tt=="5")
  $titel="AND titel='LLM'";
elseif($tt=="6")
  $titel="AND titel='MA'";
elseif($tt=="7")
  $titel="AND titel='MBA'";
elseif($tt=="8")
  $titel="AND titel='MSc'";
elseif($tt=="9")
  $titel="AND titel='PhD'";
else
  $titel="";
  
if($sv=="1")
  $studievorm="AND vorm='full-time'";
elseif($sv=="2")
  $studievorm="AND vorm='part-time'";
elseif($sv=="3")
  $studievorm="AND vorm='dual'";
else
  $studievorm="";

if($it=="1")
  $cluster="AND cluster LIKE '%aarde%'";
elseif($it=="2")
  $cluster="AND cluster LIKE '%beta%'";
elseif($it=="3")
  $cluster="AND cluster LIKE '%media%'";
elseif($it=="4")
  $cluster="AND cluster LIKE '%economie%'";
elseif($it=="5")
  $cluster="AND cluster LIKE '%filosofie%'";
elseif($it=="6")
  $cluster="AND cluster LIKE '%geschiedenis%'";
elseif($it=="7")
  $cluster="AND cluster LIKE '%gezondheid%'";
elseif($it=="8")
  $cluster="AND cluster LIKE '%kunst%'";
elseif($it=="9")
  $cluster="AND cluster LIKE '%recht%'";
elseif($it=="10")
  $cluster="AND cluster LIKE '%mens%'";
elseif($it=="11")
  $cluster="AND cluster LIKE '%onderwijs%'";
elseif($it=="12")
  $cluster="AND cluster LIKE '%talen%'";
elseif($it=="13")
  $cluster="AND cluster LIKE '%techniek%'";
else
  $cluster="";

if($fc=="1")
  $faculteit="AND faculteit LIKE '%economie%'";
elseif($fc=="2")
  $faculteit="AND faculteit LIKE '%geesteswetenschappen%'";
elseif($fc=="3")
  $faculteit="AND faculteit LIKE '%geneeskunde%'";
elseif($fc=="4")
  $faculteit="AND faculteit LIKE '%maatschappij%'";
elseif($fc=="5")
  $faculteit="AND faculteit LIKE '%natuur%'";
elseif($fc=="6")
  $faculteit="AND faculteit LIKE '%rechtsgeleerdheid%'";
elseif($fc=="7")
  $faculteit="AND faculteit LIKE '%tandheelkunde%'";
else
  $faculteit="";

mysql_select_db("webdb1249", $con);

if($q=="")
  $result = mysql_query("SELECT id,naam FROM studies WHERE 1 $taal $titel $studievorm $cluster $faculteit ORDER BY naam ASC");
else
  $result = mysql_query("SELECT id,naam FROM studies WHERE (1 $woord1 $woord2 $woord3) $taal $titel $studievorm $cluster $faculteit ORDER BY naam ASC");

if(mysql_num_rows($result)==0) {
  echo "Geen resultaat";
} else {
  while($row = mysql_fetch_array($result)) {
    echo "<a href='study.php?id=";
    echo $row['id'];
    echo "'>";
    echo $row['naam'];
    echo "</a>";
    echo "<br />";
  }
}

mysql_close($con);
?>
