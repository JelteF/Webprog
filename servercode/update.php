<?php
$url = "http://www.hodexer.nl/hodex/uva/hodexDirectory.xml";
$xml = simplexml_load_file($url);

$i = 0;
$start = time();

foreach ($xml->children() as $child) {
  //first three fields are empty
  if ($i++ < 4) continue;

  update($child->hodexResourceURL);
}


$time = time() - $start;

echo $time . " seconds \n";

function update($url) {
  $xml = simplexml_load_file($url);
  $studienr = addslashes($xml->programClassification->programId);
  $lastEdited = addslashes($xml->lastEdited);

  $con = mysql_connect("localhost","webdb1249","uvabookdb") 
    or die("could not connect: " . mysql_error());

  mysql_select_db("webdb1249")
    or die("can not select: " . mysql_error());


  $result = mysql_query("SELECT * FROM studies where studienr='$studienr'")
    or die("can not query: " . mysql_error());

  $row = mysql_fetch_array($result);
  if ($row['last_edited'] != $lastEdited) {
    $naam = addslashes($xml->programDescriptions->programName);
    $studienr = addslashes($xml->programClassification->programId);
    $samenvatting = addslashes($xml->programDescriptions->programSummary);
    $beschrijving = addslashes($xml->programDescriptions->programDescription);
    $studielast = addslashes($xml->programClassification->programCredits);
    $cursustaal = addslashes($xml->programCurriculum->instructionLanguage->languageCode);
    $studievorm = addslashes($xml->programClassification->programForm);
    $studieduur = addslashes($xml->programClassification->programDuration);
    $titel = addslashes($xml->programClassification->degree);
    $croho = addslashes($xml->programClassification->crohoCode);
    $eisen = $xml->programClassification->admissableProgram;
    $emExtra = '';
    $cmExtra = '';
    $ngExtra = '';
    $ntExtra = '';

    $faculteit = addslashes($xml->programOrganization->faculty[1]);
    $lastEdited = addslashes($xml->lastEdited);

    $programcluster = $xml->programFree->studyClusterUvA;
    $searchword = $xml->programDescriptions->searchword;
    $vakken = $xml->programCurriculum->course;

    foreach ($eisen as $eis) {
      if ($eis->profile == "EM")
        foreach ($eis->additionalSubject as $subject)
          $emExtra .= $subject . ",";
      else if ($eis->profile == "CM") 
        foreach ($eis->additionalSubject as $subject)
          $cmExtra .= $subject . ",";
      else if ($eis->profile == "NG") 
        foreach ($eis->additionalSubject as $subject)
          $ngExtra .= $subject . ",";
      else if ($eis->profile == "NT") 
        foreach ($eis->additionalSubject as $subject)
          $ntExtra .= $subject . ",";
    }

    $swString = "";
    $swLength = count($searchword);
    for($j = 0; $j < $swLength; $j++) {
      $swString = $swString . $searchword[$j];
      if ($j < $swLength-1)
        $swString = $swString . ",";
    }
    $vkString = "";
    $vkLength = count($vakken);
    for($j = 0; $j < $vkLength; $j++) {
      $vkString = $vkString . $vakken[$j]->courseName;
      if ($j < $vkLength-1)
        $vkString = $vkString . ",";
    }

    $pcString = "";
    $pcLength = count($programcluster);
    for($j = 0; $j < $pcLength; $j++) {
      $pcString = $pcString . $programcluster[$j];
      if ($j < $pcLength-1)
        $pcString = $pcString . ",";
    }
    $swString = addslashes($swString);
    $vkString = addslashes($vkString);
    $pcString = addslashes($pcString);

    $fields = "id, studienr, naam, beschrijving, samenvatting, studielast, taal, vorm, duur, titel, croho, faculteit, cluster, zoekwoorden, timestamp, last_edited, vakken, eisen_CM, eisen_EM, eisen_NG, eisen_NT";
    $values = "NULL,'$studienr','$naam','$beschrijving','$samenvatting','$studielast','$cursustaal','$studievorm','$studieduur','$titel','$croho','$faculteit','$pcString','$swString',CURRENT_TIMESTAMP,'$lastEdited','$vkString','$cmExtra','$emExtra','$ngExtra','$ntExtra'";

    if ($row['last_edited']) {
      echo "\nUpdating " . $naam;
      mysql_query("DELETE FROM studies WHERE studienr = '$studienr'");
    }
    else
      echo "\nCreating " . $naam;

    mysql_query("INSERT INTO webdb1249.studies ($fields) VALUES ($values)");

    echo "\nsuccess" . $studienr . " " . $values . "\n";
  }
  else
    echo "- ";

  mysql_close();
}

?>
