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

function showHint(base_url, str) {
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
    xmlhttp.open("GET",base_url+"home_con/ajax_search/" + str + "/" + method,true);
    xmlhttp.send();
}

function hideHint() {
    document.getElementById("suggestion").innerHTML = '';
    document.getElementById("srch_fld").value = '';
}
function input_search(){
    document.getElementById("srch_fld_input").value = document.getElementById("srch_fld").value;
    
}

function validateLogin(base_url) {
    var xmlhttp;
    usr = document.getElementById("username").value;
    passwd = document.getElementById("passwd").value;
    if (usr.length==0) {
        return;
    }
    xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
            if(xmlhttp.responseText!="-1"){
                document.getElementById("status-password").innerHTML = "<span class='username-ok'></span>";
                window.location=base_url+"user_con/validate_login/"+usr+"/"+passwd;
            }
            else 
                document.getElementById("status-password").innerHTML = "<span class='username-error'></span>";
        }
    }
    // Get query from search bar
    xmlhttp.open("GET",base_url+"user_con/ajax_validate_login/" + usr + "/" + passwd,true);
    xmlhttp.send();
}

function validateUsername(base_url, user) {
    var xmlhttp;
    if (user.length==0) {
        //document.getElementById("status-username").innerHTML = "";
        return;
    }
    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
            if(xmlhttp.responseText=="1"){
                document.getElementById("status-username").innerHTML = "<span class='username-ok'></span>";            
            }else{
                document.getElementById("status-username").innerHTML = "<span class='username-error'></span>";            
                
            }
        }
    }
    // Get query from search bar
    xmlhttp.open("GET",base_url+"user_con/ajax_check_username/" + user,true);
    xmlhttp.send();
}

function checkAvailabilityUsername(base_url){
    var xmlhttp;
    usr = document.getElementById("username-input").value;
    if (usr.length<5) {
        document.getElementById("usernameError").innerHTML = "Username must be at least 5 character.";
        return;
    }
    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
            if(xmlhttp.responseText=="0"){
                document.getElementById("usernameError").innerHTML = "<font color='green'>Username available</font>";
            }else{
                document.getElementById("usernameError").innerHTML = "Username already exist";            

            }
        }
    }
    // Get query from search bar
    xmlhttp.open("GET",base_url+"user_con/ajax_check_availability_username/" + usr,true);
    xmlhttp.send();

    
}

function checkAvailabilityEmail(base_url){
    var xmlhttp;
    email = document.getElementById("email-input").value;
    var pattern = /^[A-Za-z0-9_.-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/;
    if(!pattern.test(email)){
        document.getElementById("emailError").innerHTML = "Email is invalid.";
        return;
    }
    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
            if(xmlhttp.responseText=="0"){
                document.getElementById("emailError").innerHTML = "<font color='green'>Email available</font>";
            }else{
                document.getElementById("emailError").innerHTML = "Email already exist";            

            }
        }
    }
    // Get query from search bar
    xmlhttp.open("GET",base_url+"user_con/ajax_check_availability_email/" + email,true);
    xmlhttp.send();

    
}