<?php
require_once 'db_config.php';
$url = "http://www.hodexer.nl/hodex/uva/hodexDirectory.xml";
$xml = simplexml_load_file($url);
$i = 0;

foreach ($xml->children() as $child) {
  //first 9 fields are empty
  $i = $i + 1;
  if ($i < 9) continue;
  
  $url = $child->hodexResourceURL; 
  $xml = simplexml_load_file($url);

  $opleidingID = $xml->programClassification->programId;
  $naam = $xml->programDescriptions->programName;
  $beschrijving = $xml->programDescriptions->programDescription;
  $studielast = $xml->programClassification->programCredits;
  $cursustaal = $xml->programCurriculum->instructionLanguage->languageCode;
  $studievorm = $xml->programClassification->programForm;
  $studieduur = $xml->programClassification->programDuration;
  $numerusfixus = $xml->programClassification->numerusFixus["xsi:nil"];
  $titel = $xml->programClassification->degree;
  $croho = $xml->programClassification->crohoCode;

  $faculteit = $xml->programOrganization->faculty[1];
  $studiecluster = $xml->programFree->studyClusterUvA;
  $searchword = $xml->programDescriptions->searchword;
  $lastEdited = $xml->lastEdited;

  $vakken = $xml->programCurriculum->course[0]->courseName;

  $sql = "INSERT INTO `webdb1249`.`studies` (`naam`, `lastedit`) VALUES ($naam, CURRENT_TIMESTAMP)"

  if(!$res = mysql_query($sql))
  {
        trigger_error(mysql_error().'<br />In query: '.$sql);
  } 
  echo $opleidingID."<br/>";
  echo $naam."<br/>";
  echo $beschrijving."<br/>";
  echo "<br/>";
  echo $studielast."<br/>";
  echo $cursustaal."<br/>";
  echo $studievorm."<br/>";
  echo $studieduur."<br/>";
  echo $numerusfixus."<br/>";
  echo $titel."<br/>";
  echo $croho."<br/>";
  echo "<br/>";
  echo $faculteit."<br/>";
  echo $studiecluster[0]."<br/>";
  echo $studiecluster[1]."<br/>";
  echo $searchword."<br/>";
  echo $lastEdited."<br/>";
  echo $vakken."<br/>";
  break;
}


?>
