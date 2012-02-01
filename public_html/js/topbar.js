function topresult(str) {
  if(str.length<=3) {
    document.getElementById("topbarsearch").innerHTML="";
    document.getElementById("topbarsearch").style.border="0px";
    document.getElementById("topbarsearch").style.background="";
    return;
  }
  if(window.XMLHttpRequest) {
    xmlhttp = new XMLHttpRequest();
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
function Afocus() {

document.getElementById("forclearing").value=" ";
}
function clearing() {
  document.getElementById("forclearing").value="Zoek een opleiding";
  var x=setTimeout('document.getElementById("topbarsearch").innerHTML=""',200);
  var y=setTimeout('document.getElementById("topbarsearch").style.border="0px"',200);
  var z=setTimeout('document.getElementById("topbarsearch").style.background=""',200);
}
