function post(formname)
{
	alert("Je probeert dingen te submitten");
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
	    if (self.xmlHttpReq.readyState == 4) {
            updatepage(self.xmlHttpReq.responseText,responsediv);
        }
		else{
			updatepage(responsemsg,responsediv);

	}
	xmlhttp.open("GET","addcomment.php?"+getquerystring(formname),true);
	xmlhttp.send();
}


//##################################################################################
//## FORM SUBMIT WITH AJAX                                                        ##
//## @Author: Simone Rodriguez aka Pukos <http://www.SimoneRodriguez.com>         ##
//## @Version: 1.2                                                                ##
//## @Released: 28/08/2007                                                        ##
//## @License: GNU/GPL v. 2 <http://www.gnu.org/copyleft/gpl.html>                ##
//##################################################################################


function xmlhttpPost(strURL,formname,responsediv,responsemsg) {
    var xmlHttpReq = false;
    var self = this;

    if (window.XMLHttpRequest) {
        self.xmlHttpReq = new XMLHttpRequest();
    }

    else if (window.ActiveXObject) {
        self.xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");
    }
    self.xmlHttpReq.open('POST', strURL, true);
    self.xmlHttpReq.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    self.xmlHttpReq.onreadystatechange = function() {
        if (self.xmlHttpReq.readyState == 4) {
			// Quando pronta, visualizzo la risposta del form
            updatepage(self.xmlHttpReq.responseText,responsediv);
        }
		else{
			// In attesa della risposta del form visualizzo il msg di attesa
			updatepage(responsemsg,responsediv);

		}
    }
    self.xmlHttpReq.send(getquerystring(formname));
}

function getquerystring(formname) {
    var form = document.forms[formname];
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