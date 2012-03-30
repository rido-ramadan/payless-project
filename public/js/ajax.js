//var page = 0;
var contentHeight = 800;
var pageHeight = document.documentElement.clientHeight;
var scrollPosition;
var n = 0;


function parseScript(_source) {
    var source = _source;
    var scripts = new Array();
    // Strip out tags
    while(source.indexOf("<script") > -1 || source.indexOf("</script") > -1) {
            var s = source.indexOf("<script");
            var s_e = source.indexOf(">", s);
            var e = source.indexOf("</script", s);
            var e_e = source.indexOf(">", e);

            // Add to scripts array
            scripts.push(source.substring(s_e+1, e));
            // Strip from source
            source = source.substring(0, s) + source.substring(e_e+1);
    }
    // Loop through every script collected and eval it
    for(var i=0; i<scripts.length; i++) {
            try {
                    eval(scripts[i]);
            }
            catch(ex) {
                    // do what you want here when a script fails
            }
    }

    // Return the cleaned source
    return source;
}

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
function checkEditProfile(base_url){
    var xmlhttp;
    email = document.getElementById("email-input").value;
    gender = document.getElementById("gender-input").value;
    status = document.getElementById("status-input").value;
    avatar = document.getElementById("avatar-input").value;
    //
    //
    //
    //.
    var pattern = /^[A-Za-z0-9_.-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/;
    var valid = true;
    if(!pattern.test(email)){
        document.getElementById("emailError").innerHTML = "Email is invalid.";
        valid = false;
    }
    if(gender=="none"){
        document.getElementById("genderError").innerHTML = "You must select a gender.";
        valid = false;
    }else{
        document.getElementById("genderError").innerHTML = "<font color='green'>Gender valid</font>";        
    }
    if(status=="none"){
        document.getElementById("statusError").innerHTML = "Please choose your status";
        valid = false;
    }else{
        document.getElementById("statusError").innerHTML = "<font color='green'>Status valid</font>";        
    }
    var pattern = /^.+\.((jpg)|(jpeg))$/;
    if (avatar!="" && !pattern.test(avatar)){
        document.getElementById("avatarError").innerHTML = "Please upload jpeg image";        
        valid = false;
    }
    if(avatar==""){
        document.getElementById("avatarError").innerHTML = "<font color='green'>Avatar tidak diubah</font>";                
    }
    if(avatar!="" && pattern.test(avatar)){
        document.getElementById("avatarError").innerHTML = "<font color='green'>Image valid</font>";        
    }
    if(!valid) document.getElementById("edit-submit").style.display = "none";
    else document.getElementById("edit-submit").style.display = "block";
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

function scroll(base_url, tag, sort){
    var xmlhttp;
    if(navigator.appName == "Microsoft Internet Explorer")
        scrollPosition = document.documentElement.scrollTop;
    else 
        scrollPosition = window.pageYOffset;		

   //if((contentHeight - pageHeight - scrollPosition) < 1){
   if((contentHeight - pageHeight - scrollPosition) < 1800){
        //alert('asd');

        if(window.XMLHttpRequest)
            xmlhttp = new XMLHttpRequest();
        else
            if(window.ActiveXObject)
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        else
            alert ("Bummer! Your browser does not support XMLHTTP!");		  

        var url=base_url+"content_con/ajax_scrolling_content/"+n+"/"+tag+"/"+sort;
        
        xmlhttp.open("GET",url,true);
        xmlhttp.send();

        n += 3;
        xmlhttp.onreadystatechange=function(){
            if (xmlhttp.readyState==4) 
            {
                var files=xmlhttp.responseText;
                document.getElementById("contentDownList").innerHTML += files;
                parseScript(files);
            }
        }		
        contentHeight += 800;		
    }
}

function scroll_tag(base_url, tag){
    var xmlhttp;
    if(navigator.appName == "Microsoft Internet Explorer")
        scrollPosition = document.documentElement.scrollTop;
    else 
        scrollPosition = window.pageYOffset;		
    
   //if((contentHeight - pageHeight - scrollPosition) < 1){
   if((contentHeight - pageHeight - scrollPosition) < 1800){
        //alert('asd');

        if(window.XMLHttpRequest)
            xmlhttp = new XMLHttpRequest();
        else
            if(window.ActiveXObject)
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        else
            alert ("Bummer! Your browser does not support XMLHTTP!");		  
        var sort = document.getElementById('Sorting').value;
        var url=base_url+"content_con/ajax_scrolling_tag/"+n+"/"+tag+"/"+sort;
        
        xmlhttp.open("GET",url,true);
        xmlhttp.send();

        n += 3;
        xmlhttp.onreadystatechange=function(){
            if (xmlhttp.readyState==4) 
            {
                var files=xmlhttp.responseText;
                    document.getElementById("contentDownList").innerHTML += files;
            }
        }		
        contentHeight += 800;		
    }
}

function submit_comment(base_url, id_content){
    var xmlhttp;
    var comment = document.getElementById("ucomment").value;
    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
            document.getElementById("commentDownList").innerHTML = xmlhttp.responseText+document.getElementById("commentDownList").innerHTML;
        }
    }
    // Get query from search bar
    xmlhttp.open("GET",base_url+"content_con/ajax_submit_comment/" + id_content+"/"+comment,true);
    xmlhttp.send();    
}

function updateLike(base_url, id_content){
    var xmlhttp;
    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
            document.getElementById("like"+id_content).innerHTML = xmlhttp.responseText;
        }
    }
    // Get query from search bar
    xmlhttp.open("GET",base_url+"content_con/update_like/" + id_content,true);
    xmlhttp.send();        
}
function unlike(base_url, id_content){
    var xmlhttp;
    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
            document.getElementById("likebutton"+id_content).setAttribute("style","background-image: -o-linear-gradient(center top , #dddddd, #999999);background-image: -moz-linear-gradient(center top , #dddddd, #999999);background-image: -webkit-gradient(linear, left top, left bottom, from(#dddddd), to(#999999));");
            //document.getElementById("likebutton"+id_content).style.background-image = "likebutton";            
        }
    }
    // Get query from search bar
    xmlhttp.open("GET",base_url+"content_con/ajax_unlike/" + id_content,true);
    xmlhttp.send();            
}
function undislike(){
    
}
function timerContent(base_url, div, id_content, currTime){
    var t=currTime.split(/[- :]/);
    var curr=new Date(t[0],t[1],t[2],t[3],t[4],t[5] || 0);
    var d = new Date();
    var jam = d.getHours();
    var menit = d.getMinutes();
    var detik = d.getSeconds();
    var hari =d.getDate();
    var bulan=d.getMonth()+1;
    var tahun=d.getFullYear();
    var cjam = curr.getHours();
    var cmenit = curr.getMinutes();
    var cdetik = curr.getSeconds();
    var chari =curr.getDate();
    var cbulan=curr.getMonth();
    var ctahun=curr.getFullYear();
    var strwaktu= hari+" "+bulan+" "+tahun+", ";
    strwaktu += (jam<10)?"0"+jam:+jam;
    strwaktu +=(menit<10)?" : 0"+menit:" : "+menit;
    strwaktu +=(detik<10)?" : 0"+detik:" : "+detik;
    //document.getElementById("time").innerHTML=strwaktu;
    strwaktu+= "<br>"+chari+" "+cbulan+" "+ctahun+", ";
    strwaktu += (cjam<10)?"0"+cjam:+cjam;
    strwaktu +=(cmenit<10)?" : 0"+cmenit:" : "+cmenit;
    strwaktu +=(cdetik<10)?" : 0"+cdetik:" : "+cdetik;
    
    var text="";
    if(curr<d) text+='kurang'; 
    
    if(tahun-ctahun>0) text+= (tahun-ctahun)+" years ago";
    else if(tahun-ctahun<0) (ctahun-tahun)+" years later";
    else if(bulan-cbulan>0) text+= (bulan-cbulan)+" months ago";
    else if(cbulan-bulan>0) text+= (cbulan-bulan)+" months later";
    else if(hari-chari>0) text+= (hari-chari)+" days ago";
    else if(chari-hari>0) text+= (chari-hari)+" days later";
    else if(jam-cjam>0) text+= (jam-cjam)+" hours ago";
    else if(cjam-jam>0) text+= (cjam-jam)+" hours later";
    else if(menit-cmenit>0) text+= (menit-cmenit)+" minutes ago";
    else if(cmenit-menit>0) text+= (cmenit-menit)+" minutes later";
    else if(detik-cdetik>0) text+= (detik-cdetik)+" seconds ago";
    else if(cdetik-detik>0) text+= (cdetik-detik)+" seconds later";
    document.getElementById(div+id_content).innerHTML=text;
    //setTimeout("timer('"+currTime+"')",2);
    updateLike(base_url, id_content);
}