function tab1() {
  document.getElementById('tab1').setAttribute("class","active");
  document.getElementById('tab2').setAttribute("class","");
  document.getElementById('tab3').setAttribute("class","");
  document.getElementById('info1').style.display = "block";
  document.getElementById('info2').style.display = "none";
  document.getElementById('info3').style.display = "none";
}
function tab2() {
  document.getElementById('tab1').setAttribute("class","");
  document.getElementById('tab2').setAttribute("class","active");
  document.getElementById('tab3').setAttribute("class","");
  document.getElementById('info1').style.display = "none";
  document.getElementById('info2').style.display = "block";
  document.getElementById('info3').style.display = "none";
}
function tab3() {
  document.getElementById('tab1').setAttribute("class","");
  document.getElementById('tab2').setAttribute("class","");
  document.getElementById('tab3').setAttribute("class","active");
  document.getElementById('info1').style.display = "none";
  document.getElementById('info2').style.display = "none";
  document.getElementById('info3').style.display = "block";
}
