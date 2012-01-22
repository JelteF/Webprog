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
    alert("bla")
    var query=getElementValue(formname);
    alert(query);
    xmlhttp.send(query);
    
}

function getElementValue(formname){
    var formArray = document.forms[formname].elements;
    var query = "studie="+document.getElementById('studie_id').className;
    for (i=0; i<formArray.length; i++){
        var element = formArray[i];
        var elemType = element.type.toLowerCase();
        if(elemType == "text" || elemType == "textarea")
            query += "&" + element.name + "=" + element.value;
    }
    if(element.name == "post-type" && element.checked){
        if(element.value=="txt")
            query += "&post-type=txt&beschrijving=";
        else
            query += "&post-type="+element.value;
    }
    if (elemType == "file"){
        //upload file & add "&content=".link to the query
    }
    return query;
    
}
