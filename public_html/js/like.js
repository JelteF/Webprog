function like(post_id, up) {
  if(document.getElementById("likebtn_"+post_id).getAttribute("class")=="active" && up){
      document.getElementById("likebtn_"+post_id).setAttribute("class", "i");
  }
  else if(up){
      document.getElementById("likebtn_"+post_id).setAttribute("class", "active");
      document.getElementById("dislikebtn_"+post_id).setAttribute("class", "i");
  }
  else if(document.getElementById("dislikebtn_"+post_id).getAttribute("class")=="active")
      document.getElementById("dislikebtn_"+post_id).setAttribute("class", "i");
  else{
      document.getElementById("dislikebtn_"+post_id).setAttribute("class", "active");
      document.getElementById("likebtn_"+post_id).setAttribute("class", "");
  }

  if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  }
  else
  {// code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function()
  {
    if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
      document.getElementById("likes_"+post_id).innerHTML=xmlhttp.responseText;
    }
  }
  xmlhttp.open("GET", "ajaxphp/like.php?post_id="+post_id+"&up="+up, true);
  xmlhttp.send();
}
