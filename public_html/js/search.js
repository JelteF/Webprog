// Wordt gebruikt in opleidingen.php
/** 
 * Functie met AJAX code
 * De code bepaalt de positie van de radiobuttons
 * De positie van radiobuttons en waarde van "srchblok" wordt doorgegeven
 *   met AJAX aan search.php, die een query uitvoert
 * Krijgt lijst met zoekresultaten terug
 */
function result() {
  var str = document.getElementById("srchblok").value;
  var taal = 0;
  var titel = 0;
  var studievorm = 0;
  var intr = 0;
  var fac = 0;

  // Dit is nodig omdat anders een query wordt uitgevoerd met de placeholder
  if(str=="Zoek een opleiding")
    str="";

  for(taal = 0; taal < 3; taal++) {
      if (document.getElementById("taal"+taal).checked)
          break;
  }

  for(titel = 0; titel < 10; titel++) {
      if (document.getElementById("titel"+titel).checked)
          break;
  }

  for(studievorm = 0; studievorm < 4; studievorm++) {
      if (document.getElementById("studievorm"+studievorm).checked)
          break;
  }

  for(intr = 0; intr < 14; intr++) {
      if (document.getElementById("intr"+intr).checked)
          break;
  }

  for(fac = 0; fac < 8; fac++) {
      if (document.getElementById("fac"+fac).checked)
          break;
  }

  // AJAX code
  if(window.XMLHttpRequest) {
    xmlhttp = new XMLHttpRequest();
  } else {
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }

  xmlhttp.onreadystatechange = function() {
    if(xmlhttp.readyState==4 && xmlhttp.status==200) {
      document.getElementById("searchResult").innerHTML=xmlhttp.responseText;
    }
  }

  xmlhttp.open("GET","ajaxphp/search.php?q="+str+"&tl="+taal+"&tt="+titel+"&sv="+studievorm+"&it="+intr+"&fc="+fac,true);
  xmlhttp.send();
}

/**
 * Functie om de radiobuttons te resetten naar default waarde
 * Roept result() aan, omdat na het resetten van alle radiobuttons een query
 *   gedaan moet worden met de radiobuttons in default waarde
 */
function resetFilter() {
  document.getElementById("taal0").checked = true;
  document.getElementById("titel0").checked = true;
  document.getElementById("studievorm0").checked = true;
  document.getElementById("intr0").checked = true;
  document.getElementById("fac0").checked = true;
  result();
}

/**
 * Twee functies die "srchblok" op placeholder waarde zet of placeholder waarde verwijdert
 * Placeholder wordt op deze manier gedaan omdat Internet Explorer placeholder attribuut
 *   in tekstvakken niet ondersteunt
 */
function defaultTextValue() {
  if(document.getElementById("srchblok").value == "")
    document.getElementById("srchblok").value = "Zoek een opleiding"
}

function clearTextValue() {
  if(document.getElementById("srchblok").value == "Zoek een opleiding")
    document.getElementById("srchblok").value = ""
}
