function contentselect(button){
    xmlhttp = genXmlHttp();
    xmlhttp.onreadystatechange=function()
    {
        onreadystate("uploadcontent");
    }
    xmlhttp.open("GET", "ajaxphp/content-type.php?checked="+button, true);
    xmlhttp.send(null);
}

function uploadselect(button){
    xmlhttp = genXmlHttp();
    xmlhttp.onreadystatechange=function()
    {
        onreadystate("uploadstyle");
    }
    xmlhttp.open("GET", "ajaxphp/upload.php?checked="+button, true);
    xmlhttp.send(null);
    
}

function genXmlHttp(){
    if (window.XMLHttpRequest)
    {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    }
    else
    {// code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    return xmlhttp;
}

function onreadystate(id){
    if (xmlhttp.readyState==4 && xmlhttp.status==200)
            document.getElementById(id).innerHTML=xmlhttp.responseText;
}