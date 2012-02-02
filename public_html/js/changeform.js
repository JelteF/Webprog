/*
 * Deze functie verandert het formulier elke keer dat er op een radio button
 * geklikt wordt voor de content.
 */

function contentselect(button){
    
    if(button=="pdf"){
        document.getElementById("textarea").name = "beschrijving";
        document.getElementById("uploadcontent").innerHTML=
            "<br />Upload pdf <input name='file' type='file' />";
    }
    else if(button=="vid"){
        document.getElementById("textarea").name = "beschrijving";
        document.getElementById("uploadcontent").innerHTML=
            "<br />Youtube link: <input name='content' class='large' type='text' />";
    }
    else if(button=="txt"){
        document.getElementById("textarea").name = "content";
        document.getElementById("uploadcontent").innerHTML="";
    }
    else {
        document.getElementById("textarea").name = "beschrijving";
        document.getElementById("uploadcontent").innerHTML=
            "<br />Upload een foto of link naar een foto:<br />"+
            "Link   <input id='link' type='radio' value='link' name='upload' checked='true' onclick=\"uploadselect('link');\" />"+
            "Upload   <input id='upload' type='radio' value='upload' name='upload' onclick=\"uploadselect('upload');\" /> <br />"+
            "<div id='uploadstyle'>"+
            "<br /><input name='content' class='large' type='text' />"+
            "</div>";
    }
}

/*
 * Deze functie verandert de upload vorm bij plaatjes.
 */
function uploadselect(button){
    if(button=="upload"){
        document.getElementById("uploadstyle").innerHTML=
            "<br /><input name='file' type='file' />";
    }
    else
        document.getElementById("uploadstyle").innerHTML=
            "<br /><input name='content' class='large' type='text' />";
}