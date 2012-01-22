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
	xmlhttp.open("POST", "addcomment.php", true);
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
//##################################################################################
//## FORM SUBMIT WITH AJAX                                                        ##
//## @Author: Simone Rodriguez aka Pukos <http://www.SimoneRodriguez.com>         ##
//## @Version: 1.2                                                                ##
//## @Released: 28/08/2007                                                        ##
//## @License: GNU/GPL v. 2 <http://www.gnu.org/copyleft/gpl.html>                ##
//##################################################################################



function getquerystring(formname) {
    var form = document.forms[formname].elements;
	var qstr = "";


    function GetElemValue(name, value) {
        qstr += (qstr.length > 0 ? "&" : "")
            + escape(name).replace(/\+/g, "%2B") + "="
            + escape(value ? value : "").replace(/\+/g, "%2B");
			//+ escape(value ? value : "").replace(/\n/g, "%0D");
    }
	
	var elemArray = form.elements;
    for (var i = 0; i < elemArray.length; i++) {
        var element = elemArray[i];
        var elemType = element.type.toUpperCase();
        var elemName = element.name;
        if (elemName) {
            if (elemType == "TEXT"
                    || elemType == "TEXTAREA"
                    || elemType == "PASSWORD"
					|| elemType == "BUTTON"
					|| elemType == "RESET"
					|| elemType == "SUBMIT"
					|| elemType == "FILE"
					|| elemType == "IMAGE"
                    || elemType == "HIDDEN")
                GetElemValue(elemName, element.value);
            else if (elemType == "CHECKBOX" && element.checked)
                GetElemValue(elemName, 
                    element.value ? element.value : "On");
            else if (elemType == "RADIO" && element.checked)
                GetElemValue(elemName, element.value);
            else if (elemType.indexOf("SELECT") != -1)
                for (var j = 0; j < element.options.length; j++) {
                    var option = element.options[j];
                    if (option.selected)
                        GetElemValue(elemName,
                            option.value ? option.value : option.text);
                }
        }
    }
    return qstr;
}
function updatepage(str,responsediv){
    document.getElementById(responsediv).innerHTML = str;
}