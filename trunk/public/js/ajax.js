

function loadData () {
    var xmlHTTP = new XMLHttpRequest();

    // if something happens, do this
    xmlHTTP.onreadystatechange=function() {
        if (xmlHTTP.readyState==4 && xmlHTTP.status==200) {
            document.getElementById("message").innerHTML = xmlHTTP.responseText;
        }
    }

    // define this variables should do what?
    xmlHTTP.open("GET", "~ajax-controller.php?", true);
    xmlHTTP.send();
}

function showHint(str) {
    var xmlhttp;
    if (str.length==0) {
        document.getElementById("txtHint").innerHTML="";
        return;
    }
    xmlhttp=new XMLHttpRequest();

    xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
            document.getElementById("suggestion").innerHTML = xmlhttp.responseText;
        }
    }
    // Get query from search bar
    xmlhttp.open("GET","~ajax-controller.php?q="+str,true);
    xmlhttp.send();
}

function hideHint() {
    document.getElementById("suggestion").innerHTML = '';
}