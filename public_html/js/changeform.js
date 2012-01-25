function contentselect(button){
    
    if(button=="pdf"){
        document.getElementById("textarea").name = "beschrijving";
        document.getElementById("uploadcontent").innerHTML=
            "<br /> <br />Upload pdf <input name='file' type='file' />";
    }
    else if(button=="vid"){
        document.getElementById("textarea").name = "beschrijving";
        document.getElementById("uploadcontent").innerHTML=
            "<br /> <br />Youtube link: <input name='content' class='large' type='text' />";
    }
    else if(button=="txt"){
        document.getElementById("textarea").name = "content";
    }
    else {
        document.getElementById("textarea").name = "beschrijving";
        document.getElementById("uploadcontent").innerHTML=
            "<br /> <br />Upload een foto of link naar een foto:<br />"+
            "Link   <input id='link' type='radio' value='link' name='upload' checked='true' onclick=\"uploadselect('link');\" />"+
            "Upload   <input id='upload' type='radio' value='upload' name='upload' onclick=\"uploadselect('upload');\" /> <br />"+
            "<div id='uploadstyle'>"+
            "<br /><input name='content' class='large' type='text' />"+
            "</div>";
    }
}

function uploadselect(button){
    if(button=="upload"){
        document.getElementById("uploadstyle").innerHTML=
            "<br /><input name='file' type='file' />";
    }
    else
        document.getElementById("uploadstyle").innerHTML=
            "<br /><input name='content' class='large' type='text' />";
}