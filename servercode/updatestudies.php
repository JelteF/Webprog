<?php
//the xml at this location contains the urls for each study
//so for each url in this url we execute update($url)
$url = "http://www.hodexer.nl/hodex/uva/hodexDirectory.xml";
$xml = simplexml_load_file($url);
$i = 0;
$start = time();

foreach ($xml->children() as $child) {
  //first three fields are empty
  if ($i++ < 4) continue;
  update($child->hodexResourceURL);
}

echo "\nUpdate took " . (time() - $start) . " seconds to complete.\n";

function update($url) {
  //load in the url. Check to see if it's empty. This only happens if the university
  //is in the middle of updating the files and hasn't removed dead links yet.
  $xml  = simplexml_load_file($url);
  if (empty($xml)) {
    echo "dead url at: $url";
    return;
  }
  //connect to the db
  $con = mysql_connect("localhost","webdb1249","uvabookdb")
    or die("could not connect: " . mysql_error());
  //find the number of the studie which xml we're looking at
  $studienr = explode("_", mysql_real_escape_string($xml->programClassification->programId));
  $type = "";
  $studienr = $studienr[0];
  //look when the xml was last updated
  $lastEdited = mysql_real_escape_string($xml->lastEdited);
  mysql_select_db("webdb1249")
    or die("can not select: " . mysql_error());
  $result = mysql_query("SELECT * FROM studies where studienr='$studienr'")
    or die("can not query: " . mysql_error());
  $row = mysql_fetch_array($result);
  $id = $row['id'];
  $naam = mysql_real_escape_string($xml->programDescriptions->programName);

  //this get's executed if $row cannot be found, in which case this study is not yet in the db
  //or if the study in the db has an older timestamp than the xml
  if ($row['last_edited'] != $lastEdited) {
    $samenvatting = mysql_real_escape_string($xml->programDescriptions->programSummary);
    $beschrijving = mysql_real_escape_string($xml->programDescriptions->programDescription);
    $studielast = mysql_real_escape_string($xml->programClassification->programCredits);
    $cursustaal = mysql_real_escape_string($xml->programCurriculum->instructionLanguage->languageCode);
    $studievorm = mysql_real_escape_string($xml->programClassification->programForm);
    $studieduur = mysql_real_escape_string($xml->programClassification->programDuration);
    $titel = mysql_real_escape_string($xml->programClassification->degree);
    $croho = mysql_real_escape_string($xml->programClassification->crohoCode);
    $eisen = $xml->programClassification->admissableProgram;
    $emExtra = '';
    $cmExtra = '';
    $ngExtra = '';
    $ntExtra = '';
    $faculteit = mysql_real_escape_string($xml->programOrganization->faculty[1]);

    $programs = $xml->programFree->studyClusterUvA;
    $searchwords = $xml->programDescriptions->searchword;
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

    $swString = mysql_real_escape_string(array_to_string($searchwords, ", "));
    $pcString = mysql_real_escape_string(array_to_string($programs, ", "));
    $vkString = "";

    //if it's not found in the db yet, INSERT INTO
    if (empty($row["last_edited"])) {
      echo "entry didn't exist yet, creating " . $naam . "\n";
      $fields = "id, studienr, naam, beschrijving, samenvatting, studielast, taal, vorm, duur, titel, croho, faculteit, cluster, zoekwoorden, timestamp, last_edited, vakken, eisen_CM, eisen_EM, eisen_NG, eisen_NT";
      $values = "NULL,'$studienr','$naam','$beschrijving','$samenvatting','$studielast','$cursustaal','$studievorm','$studieduur','$titel','$croho','$faculteit','$pcString','$swString',CURRENT_TIMESTAMP,'$lastEdited','$vkString','$cmExtra','$emExtra','$ngExtra','$ntExtra'";
      mysql_query("INSERT INTO webdb1249.studies ($fields) VALUES ($values)");
    }
    //else it's already in there, and needs updating
    else {
      echo "found old entries for: " . $naam . ", updating fields\n";
      $values = "naam='$naam', beschrijving='$beschrijving', samenvatting='$samenvatting', studielast='$studielast', taal='$cursustaal', vorm='$studievorm', duur='$studieduur', titel='$titel', croho='$croho', faculteit='$faculteit', cluster='$pcString', zoekwoorden='$swString', last_edited='$lastEdited', vakken='$vkString', eisen_CM='$cmExtra', eisen_EM='$emExtra', eisen_NG='$ngExtra', eisen_NT='$ntExtra'";
      mysql_query("UPDATE studies SET $values WHERE id='$id'");
    }
    mysql_close($con);
  }
  else echo "Already up to date: " . $naam . "\n";
}

function array_to_string($array, $seperator) {
  $string = "";
  $length = count($array);
  for ($i = 0; $i < $length ; $i++) {
    if (!empty($array[$i])) {
      $string .= $array[$i];
      if ($i < $length - 1)
        $string .= $seperator;
    }
  }
  return $string;
}




?>
