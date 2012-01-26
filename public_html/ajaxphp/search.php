<?php
$q = $_GET["q"];
$q = $_GET["tl"];
$q = $_GET["tt"];
$q = $_GET["sv"];
$q = $_GET["it"];
$q = $_GET["fc"];

if($tl==1)
  $taal="AND taal='nl'";
else if($tl==2)
  $taal="AND taal='en'";
else
  $taal="";

if($tt==1)
  $titel="AND titel='BA'";
else if($tt==2)
  $titel="AND titel='BSc'";
else if($tt==3)
  $titel="AND titel='Certificaat'";
else if($tt==4)
  $titel="AND titel='LLB'";
else if($tt==5)
  $titel="AND titel='LLM'";
else if($tt==6)
  $titel="AND titel='MA'";
else if($tt==7)
  $titel="AND titel='MBA'";
else if($tt==8)
  $titel="AND titel='MSc'";
else if($tt==9)
  $titel="AND titel='PhD'";
else
  $titel="";
  
if($sv==1)
  $studievorm="AND vorm='full-time'";
else if($sv==2)
  $studievorm="AND vorm='part-time'";
else if($sv==3)
  $studievorm="AND vorm='dual'";
else
  $studievorm="";

if($it==1)
  $cluster="AND cluster LIKE '%aarde%'";
else if($it==2)
  $cluster="AND cluster LIKE '%beta%'";
else if($it==3)
  $cluster="AND cluster LIKE '%media%'";
else if($it==4)
  $cluster="AND cluster LIKE '%economie%'";
else if($it==5)
  $cluster="AND cluster LIKE '%filosofie%'";
else if($it==6)
  $cluster="AND cluster LIKE '%geschiedenis%'";
else if($it==7)
  $cluster="AND cluster LIKE '%gezondheid%'";
else if($it==8)
  $cluster="AND cluster LIKE '%kunst%'";
else if($it==9)
  $cluster="AND cluster LIKE '%recht%'";
else if($it==10)
  $cluster="AND cluster LIKE '%mens%'";
else if($it==11)
  $cluster="AND cluster LIKE '%onderwijs%'";
else if($it==12)
  $cluster="AND cluster LIKE '%talen%'";
else if($it==13)
  $cluster="AND cluster LIKE '%techniek%'";
else
  $cluster="";

if($fc==1)
  $faculteit="AND faculteit LIKE '%economie%'";
else if($fc==2)
  $faculteit="AND faculteit LIKE '%geesteswetenschappen%'";
else if($fc==3)
  $faculteit="AND faculteit LIKE '%geneeskunde%'";
else if($fc==4)
  $faculteit="AND faculteit LIKE '%maatschappij%'";
else if($fc==5)
  $faculteit="AND faculteit LIKE '%natuurkunde%'";
else if($fc==6)
  $faculteit="AND faculteit LIKE '%rechtsgeleerdheid%'";
else if($fc==7)
  $faculteit="AND faculteit LIKE '%tandheelkunde%'";
else
  $faculteit="";

$con = mysql_connect("localhost","webdb1249","uvabookdb");
if(!$con)
  die('could not connect' . mysql.error());
  mysql_select_db("webdb1249", $con);

  if($q=="")
    $result = mysql_query("SELECT id,naam FROM studies $taal $titel $studievorm $cluster $faculteit ORDER BY naam");
  else
    $result = mysql_query("SELECT id,naam FROM studies WHERE naam LIKE '%$q%' OR cluster LIKE '%$q%' OR zoekwoorden LIKE '%$q%' $taal $titel $studievorm $cluster $faculteit ORDER BY naam ASC");

  while($row = mysql_fetch_array($result)) {
    echo "<a href='study.php?id=";
    echo $row['id'];
    echo "'>";
    echo $row['naam'];
    echo "</a>";
    echo "<br />";
  }

mysql_close($con);
?>
