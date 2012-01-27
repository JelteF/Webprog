function result() {
fTaal = document.getElementsByName("fTaal");
fTitel = document.getElementsByName("fTitel");
fVorm = document.getElementsByName("fVorm");
fInt = document.getElementsByName("fInt");
fFac = document.getElementsByName("fFac");
srchblok = document.getElementsByName("srchblok");

  for(taal = 0; taal < 3; taal++) {
      if (fTaal[taal].checked)
          break;
  }
  for(titel = 0; titel < 10; titel++) {
      if (fTitel[titel].checked)
          break;
  }
  for(studievorm = 0; studievorm < 4; studievorm++) {
      if (fVorm[studievorm].checked)
          break;
  }
  for(intr = 0; intr < 14; intr++) {
      if (fInt[intr].checked)
          break;
  }
  for(fac = 0; fac < 8; fac++) {
      if (fFac[fac].checked)
          break;
  }
  
  str = srchblok.value;

  if(window.XMLHttpRequest) {
    xmlhttp = new XMLHttpRequest();
  }
  xmlhttp.onreadystatechange = function() {
    if(xmlhttp.readyState==4 && xmlhttp.status==200) {
      document.getElementById("searchResult").innerHTML=xmlhttp.responseText;
    }
  }
  xmlhttp.open("GET","ajaxphp/search.php?q="+str+"&tl="+taal+"&tt="+titel+"&sv="+studievorm+"&it="+intr+"&fc="+fac,true);
  xmlhttp.send();
}
