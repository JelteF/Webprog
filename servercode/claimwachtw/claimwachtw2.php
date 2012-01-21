<?php print '<?xml version="1.0"?>'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<meta name="Author" content="Wolter Kaper" />
	<title>Claim je MySQL wachtwoord, resultaat</title>
	<style type="text/css">
		body { font-family: Arial; }
		h1 {font-size: 24; }
		span {color: Red; }
	</style>
</head>

<body>

<?php
$gevonden1=FALSE;
$gevonden2=FALSE;
$klopt=FALSE;
if ( !isset($_REQUEST['naam']) || !isset($_REQUEST['collegekrt']) )
	{print "Een parameter ontbreekt."; exit();}

//Verbinden met database
$mysqli = new mysqli("websec.science.uva.nl", "stdwebp39", "vipj_0uV", "stdwebp39");
if (mysqli_connect_errno()) {
	printf("Connect failed: %s\n", mysqli_connect_error()); 
	exit();
}

//Check of gebruiker tot deze cursus behoort
//We zijn niet wantrouwig: een collegekaartnummer dat voorkomt in onze tabel is goed genoeg

$stmt = $mysqli->prepare("SELECT collegekrt FROM claimwcollegekrt WHERE collegekrt=?");
$stmt->bind_param("s", $_REQUEST['collegekrt']);
if (! $stmt->execute()) {printf("MySQL foutbericht: %s\n", $stmt->error); exit();}
if (! $stmt->fetch() ) {
    ?>
    <h1>Fout</h1>
    <p>Sorry, wij kennen u niet. Probeer het nog eens, of roep de docent.</p>
    <?php
    exit();
}
$stmt->free_result();

//Check of collegekaart al geregistreerd is bij een database
$name = "";
$stmt = $mysqli->prepare("SELECT name FROM claimwachtw WHERE collegekrt=?");
$stmt->bind_param("s", $_REQUEST['collegekrt']);
$stmt->bind_result($name); 
if (! $stmt->execute()) {printf("MySQL foutbericht: %s\n", $stmt->error); exit();}
$gevonden1 = FALSE;
if ($stmt->fetch() ) {
	$gevonden1=TRUE;
	$klopt= ($_REQUEST['naam']==$name);
}
$stmt->free_result();

if (! $gevonden1) {
	//check of naam al bekend is
	$stmt = $mysqli->prepare("SELECT collegekrt FROM claimwachtw WHERE name=? LIMIT 1");
	$stmt->bind_param("s", $_REQUEST['naam']);
	if (! $stmt->execute()) {printf("MySQL foutbericht: %s\n", $stmt->error); exit();}
	$gevonden2 = FALSE;
    $stmt->store_result();  //resultaat buffering, nodig voor num_rows
	if ($stmt->num_rows!=0) { $gevonden2 = TRUE; }
	$stmt->free_result();
}

if (! $gevonden1) {
if (! $gevonden2) {
	// Als naam én collekaart beide onbekend: Nieuwe gebruiker
	// Zoek eerste vrije database
	$sql = "SELECT username, passw FROM claimwachtw 
	    WHERE name IS NULL AND collegekrt IS NULL LIMIT 1";
	$result3=$mysqli->query($sql);
	if (! $result3) {printf("MySQL foutbericht: %s\n", $mysqli->error); exit();}
	if ($result3->num_rows==0) { 
        print "Er zijn geen vrije databases meer. Vraag de docent om raad."; exit(); 
    }
	$row = $result3->fetch_assoc();
    $result3->free_result();
	$username=$row["username"]; 
	$passw=$row["passw"];

	// Koppel nieuwe gebruiker aan deze database
    $stmt = $mysqli->prepare("UPDATE claimwachtw SET name=?, collegekrt=? WHERE username=? LIMIT 1");
    $stmt->bind_param("sss", $_REQUEST['naam'], $_REQUEST['collegekrt'], $username);
	if (! $stmt->execute()) {printf("MySQL foutbericht: %s\n", $stmt->error); exit();}
    if (! $stmt->affected_rows==1) {print "Onverwachte fout: Niets gewijzigd."; exit();}
    $stmt->free_result(); 
	?>
	<h1>Resultaat: Nieuwe gebruiker geaccepteerd <span>testversie, resultaat telt niet</span></h1>
	<table>
	<tr><td>Achternaam:</td><td><?php print htmlspecialchars($_REQUEST['naam']); ?></td></tr>
	<tr><td>Collegekaart:</td><td><?php print htmlspecialchars($_REQUEST['collegekrt']); ?></td></tr>
	<tr><td>MySQL gebruikersnaam:</td><td><?php print htmlspecialchars($username); ?></td></tr>
	<tr><td>Wachtwoord:</td><td><?php print htmlspecialchars($passw); ?></td></tr>
	</table>
	<?php
} }
	
if ($gevonden1 && $klopt) {
	//Deze gebruiker heeft al een database: geef hem z'n naam en wachtwoord
    //Blijkbaar is hij die vergeten
    $username1 = "";
    $passw1 = "";
    $stmt = $mysqli->prepare("SELECT username, passw FROM claimwachtw WHERE name=? AND collegekrt=? LIMIT 1");
    $stmt->bind_param("ss", $_REQUEST['naam'], $_REQUEST['collegekrt']); 
    $stmt->bind_result($username1, $passw1);
	if (! $stmt->execute()) {printf("MySQL foutbericht: %s\n", $stmt->error); exit();}
	if (! $stmt->fetch()) {print "Onverwachte fout: Geen data."; exit(); } //er moet 1 rij zijn
    $stmt->free_result();
	?>
	<h1>Resultaat: bestaande gebruiker gevonden. <span>testversie, resultaat telt niet</span></h1>
	<p>U vindt hieronder uw gegevens.</p>
	<table>
	<tr><td>Achternaam:</td><td><?php print htmlspecialchars($_REQUEST['naam']); ?></td></tr>
	<tr><td>Collegekaart:</td><td><?php print htmlspecialchars($_REQUEST['collegekrt']); ?></td></tr>
	<tr><td>MySQL gebruikersnaam:</td><td><?php print htmlspecialchars($username1); ?></td></tr>
	<tr><td>Wachtwoord:</td><td><?php print htmlspecialchars($passw1); ?></td></tr>
	</table>

	<?php
}

if (($gevonden1 || $gevonden2) && ! $klopt) {
	?>
	<h1>Resultaat: fout. <span>testversie, resultaat telt niet</span></h1>
	<p>Collegekaart of achternaam conflicteren met eerder ingevoerde gegevens.</p>
	<p>Als het probleem blijft, neem dan contact op met de docent. 
		<a href="mailto:kaper@science.uva.nl">kaper@science.uva.nl</a></p>
	<?php
}
?>

<p><a href="claimform2.html">Terug</a></p>

</body>

</html>