function startUpload(){
    document.getElementById('uploading').innerHTML="<p><br />Uploading...</p>";
    return true;
}

function submit(formname, result, content)
{
    if(result!="1"){
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
        document.getElementById("newcomment").innerHTML="blablabla";
        xmlhttp.open("POST", "../../servercode/addcomment.php", true);
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        var query="content="+escape(content)+getElementValue(formname);
        alert(query);
        document.getElementById("newcomment").innerHTML="bloebloebloe"
        xmlhttp.send(query);
    }
}

function getElementValue(formname){
var formArray = document.forms[formname].elements;
var query = "&studie="+document.getElementById('studie_id').className;
for (i=0; i<formArray.length; i++){
    var element = formArray[i];
    var elemType = element.type.toLowerCase();
    if(element.name!="content" && (elemType == "text" || elemType == "textarea"))
        query += "&" + element.name + "=" + escape(element.value);
    if(element.name == "post-type" && element.checked){
        if(element.value=="txt")
            query += "&post-type=txt&beschrijving=";
        else
            query += "&post-type="+element.value;
    }
}
return query;
}
