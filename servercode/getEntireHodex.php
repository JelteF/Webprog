<?php
$url = "http://www.hodexer.nl/hodex/uva/hodexDirectory.xml";
$xml = simplexml_load_file($url);

$i = 0;
$start = time();

foreach ($xml->children() as $child) {
  //first three fields are empty
  if ($i++ < 4) continue;

  putInDB($child->hodexResourceURL);
}

$time = time() - $start;

echo $time . " seconds";

function putInDB($url) {
  $xml = simplexml_load_file($url);

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
  $cmExtra = addslashes($xml->programClassification->admissableProgram[0]->additionalSubject[0]);
  $emExtra = addslashes($xml->programClassification->admissableProgram[1]->additionalSubject[0]);
  $ngExtra = addslashes($xml->programClassification->admissableProgram[2]->additionalSubject[0]);
  $ntExtra = addslashes($xml->programClassification->admissableProgram[3]->additionalSubject[0]);

  $faculteit = addslashes($xml->programOrganization->faculty[1]);
  $lastEdited = addslashes($xml->lastEdited);

  $programcluster = $xml->programFree->studyClusterUvA;
  $searchword = $xml->programDescriptions->searchword;
  $vakken = $xml->programCurriculum->course;

  $swString = "";
  $swLength = count($searchword);
  for($j = 0; $j < $swLength; $j++) {
    $swString = $swString . $searchword[$j];
    if ($j < $swLength-1)
      $swString = $swString . ",";
  }

  $vkString = "";
  $vklength = count($vakken);
  for($j = 0; $j < $vklength; $j++) {
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
  
  echo $studienr;

  $con = mysql_connect("localhost","webdb1249","uvabookdb");
  if (!$con)
    die('could not connect' . mysql.error());

  if (mysql_query("INSERT INTO webdb1249.studies (id, studienr, naam, beschrijving, samenvatting, studielast, taal, vorm, duur, titel, croho, faculteit, cluster, zoekwoorden, timestamp, last_edited, vakken, eisen_CM, eisen_EM, eisen_NG, eisen_NT) VALUES (NULL,'$studienr','$naam','$beschrijving','$samenvatting','$studielast','$cursustaal','$studievorm','$studieduur','$titel','$croho','$faculteit','$pcString','$swString',CURRENT_TIMESTAMP,'$lastEdited','$vkString','$cmExtra','$emExtra','$ngExtra','$ntExtra')",$con))
    echo "success";
  else
    echo $naam . "failed" . mysql_error();
  echo "<br/>";


  mysql_close($con);
}
?>
