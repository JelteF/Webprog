function submit(formname)
{
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
            document.getElementById("newcomment").innerHTML=xmlhttp.responseText;
        }
    };
    xmlhttp.open("POST", "../servercode/addcomment.php", true);
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    var query=getElementValue(formname);
    alert(query);
    xmlhttp.send(query);
    
}

function getElementValue(formname){
var formArray = document.forms[formname].elements;
var query = "";
for (i=0; i<formArray.length; i++){
    var element = formArray[i];
    var elemType = element.type.toLowerCase();
    alert(elemType);
    if(elemType == "text" || elemType == "textarea" 
        || elemType == "file"){
        if (query.length > 0)
            query += "&";
        query += element.name + "=" + element.value;
        alert("query= " + query);
    }
    if(elemType == "radio" && element.checked){
        if(query.length > 0)
            query += "&";
        if(element.value=="txt")
            query += "post-type=txt&beschrijving=";
        else
            query += "type="+element.value;
        alert("query= " + query);
    }
}
return query;

}
