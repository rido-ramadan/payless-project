//var page = 0;

function loadContent (page) {
    var xmlHTTP = new XMLHttpRequest();

    xmlHTTP.onreadystatechange=function() {
        if (xmlHTTP.readyState==4 && xmlHTTP.status==200) {
            document.getElementById("content-page").innerHTML = xmlHTTP.responseText;
//            page = document.getElementById("pagenum").innerHTML;
//            page = parseInt(page, 10);
        }
    }

    xmlHTTP.open("GET", "~ajax-content-controller.php?page=" + page, true);
    xmlHTTP.send();
}

function showHint(str) {
    var method = document.getElementById('filter-method').value;
    var xmlhttp;
    if (str.length==0) {
        document.getElementById("suggestion").innerHTML="";
        return;
    }
    xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
            document.getElementById("suggestion").innerHTML = xmlhttp.responseText;
        }
    }
    // Get query from search bar
    xmlhttp.open("GET","~ajax-search-controller.php?q=" + str + "&f=" + method,true);
    xmlhttp.send();
}

function hideHint() {
    document.getElementById("suggestion").innerHTML = '';
}