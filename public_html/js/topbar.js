// Wordt gebruikt in topbar.php
/** 
 * Functie met AJAX code
 * Geeft meegegeven string door aan topbarsearch.php
 * Krijgt lijst met zoekresultaten terug
 * De resultaten worden in een div geprint met een absolute positie
 *   ten opzichte van die div
 */
function topresult(str) {
  if(window.XMLHttpRequest) {
    xmlhttp = new XMLHttpRequest();
  }
  else {
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }

  xmlhttp.onreadystatechange = function() {
    if(xmlhttp.readyState==4 && xmlhttp.status==200) {
      document.getElementById("topbarsearch").innerHTML=xmlhttp.responseText;
      document.getElementById("topbarsearch").style.border="1px solid #A5ACB2";
      document.getElementById("topbarsearch").style.background="#000000";
      document.getElementById("topbarsearch").style.padding="5px";
      document.getElementById("topbarsearch").style.width="400px";
      document.getElementById("topbarsearch").style.position="absolute";
    }
  }

  xmlhttp.open("GET","ajaxphp/topbarsearch.php?q="+str,true);
  xmlhttp.send();
}

/** 
 * Twee functies die "topsearchinput" op placeholder waarde zet of placeholder waarde verwijdert
 * Placeholder wordt op deze manier gedaan omdat Internet Explorer placeholder attribuut
 *   in tekstvakken niet ondersteunt
 * Tweede functie zorgt er ook voor dat zoek resultaten verdwijnen wanneer er op iets anders dan het zoekbalk
 *   wordt geklikt. Omdat het meteen verdwijnt, is er een delay van 200 milliseconden toegevoegd. Dit zorgt
 *   ervoor dat er genoeg tijd is om op de links van de zoekresultaten geklikt kan worden
 */
function placeholderClear() {
  document.getElementById("topsearchinput").value="";
}

function placeholderDefault() {
  document.getElementById("topsearchinput").value="Zoek een opleiding";
  var x=setTimeout('document.getElementById("topbarsearch").innerHTML=""',200);
  var y=setTimeout('document.getElementById("topbarsearch").style.border="0px"',200);
  var z=setTimeout('document.getElementById("topbarsearch").style.background=""',200);
}
