//the js code that submits what page you're on
function startUpload(){
    document.getElementById('uploading').innerHTML="<p><br />Uploading...</p>";
    return true;
}

function submit(result, post_id)
{
    if(result!="1"){
        //als er een error message is laat die dan zien.
        document.getElementById('uploading').innerHTML="<p><br />"+result+"</p>";
    }
    else{
        document.getElementById('uploading').innerHTML="";
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
                document.getElementById("newcomment").innerHTML+=xmlhttp.responseText;
            }
        }
        xmlhttp.open("POST", "ajaxphp/addcomment.php", true);
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        var query ="&post_id="+escape(post_id);
        xmlhttp.send(query);
    }
}
