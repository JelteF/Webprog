function result() {
  var str = document.getElementById("srchblok").value;
  if(str=="Zoek een opleiding")
    str="";

  var taal = 0;
  for(taal = 0; taal < 3; taal++) {
      if (document.getElementById("taal"+taal).checked)
          break;
  }
  var titel = 0;
  for(titel = 0; titel < 10; titel++) {
      if (document.getElementById("titel"+titel).checked)
          break;
  }
  var studievorm = 0;
  for(studievorm = 0; studievorm < 4; studievorm++) {
      if (document.getElementById("studievorm"+studievorm).checked)
          break;
  }
  var intr = 0;
  for(intr = 0; intr < 14; intr++) {
      if (document.getElementById("intr"+intr).checked)
          break;
  }
  var fac = 0;
  for(fac = 0; fac < 8; fac++) {
      if (document.getElementById("fac"+fac).checked)
          break;
  }

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
function resetFilter() {
  document.getElementById("taal0").checked = true;
  document.getElementById("titel0").checked = true;
  document.getElementById("studievorm0").checked = true;
  document.getElementById("intr0").checked = true;
  document.getElementById("fac0").checked = true;
  result();
}
function clearTextValue() {
  if(document.getElementById("srchblok").value == "Zoek een opleiding")
    document.getElementById("srchblok").value = ""
}
function defaultTextValue() {
  if(document.getElementById("srchblok").value == "")
    document.getElementById("srchblok").value = "Zoek een opleiding"
}
