var elem = (document.compatMode === "CSS1Compat") ?
document.documentElement :
document.body;

var height = elem.clientHeight;
var width = elem.clientWidth;
var filterSearch = false;
var inbox = false;

function getHeight(){
    var htmlheight = document.body.parentNode.scrollHeight;
    var windowheight = window.innerHeight;
    if ( htmlheight < windowheight ) {
        return windowheight;
    } else {
        return htmlheight;
    }
}

function doPopUp() {
    var overlay = document.getElementById('overlay');
    overlay.style.height = getHeight() + 'px';
    overlay.style.display = 'block';
}

function showPopup() {
    var overlay = document.getElementById('overlay');
    var popup = document.getElementById('popup');
    overlay.style.height = getHeight() + 'px';
    overlay.style.display = 'block';
//    popup.style.display = 'block';
    popup.style.marginTop = '45px';
}

function closePopUp() {
    var overlay = document.getElementById('overlay');
    var popup = document.getElementById('popup');
    overlay.style.display = 'none';
    popup.style.marginTop = '-160px';
}

function editProfile() {
    var overlay = document.getElementById('overlay');
    var edit = document.getElementById('edituserdata');
    overlay.style.height = getHeight()  + 'px';
    overlay.style.display = 'block';
    edit.style.marginTop = '80px';
    document.getElementById('edit-submit').style.display="none";
}

function closeAll() {
    var overlay = document.getElementById('overlay');
    var edit = document.getElementById('edituserdata');
    var popup = document.getElementById('popup');
    var preview = document.getElementById('preview');
    var slide = document.getElementsByClassName('ach_list')[0];
    var box = document.getElementsByClassName('compose')[0];
    overlay.style.display = 'none';
    popup.style.marginTop = '-160px';
    if (edit !== null) edit.style.marginTop = '-560px';
    if (preview !== null) preview.style.display = 'none';
    if (slide !== null) slide.style.marginTop = '-312px';
    if (box !== null) box.style.MozTransform = 'scale(0)';
    if (box !== null) box.style.WebkitTransform = 'scale(0)';
}

function showAchievement(ach_name, ach_desc, ach_logo) {
    var popup = document.getElementById('ach_popup');
    var ach = document.getElementsByClassName('achievement');
    doPopUp();
    popup.style.display = 'block';
    ach[0].innerHTML =
        '<div class="ach_logo"><img src="' + ach_logo +'" alt="" width="50">' + '</div>' +
        '<div class="ach_detail">' +
            '<div class="ach_name">' + ach_name + '</div>' +
            '<div class="ach_how">' + ach_desc + '</div>' +
        '</div>';
}

function closeAchievement() {
    var popup = document.getElementById('ach_popup');
    closeAll();
    popup.style.display = 'none';
}

function slideDown() {
    var slide = document.getElementsByClassName('ach_list')[0];
    slide.style.marginTop = '180px';
}

function slideUp() {
    var slide = document.getElementsByClassName('ach_list')[0];
    slide.style.marginTop = '-312px';
}

function toggleFilterSearch() {
    var x = document.getElementById('togglefilter');
    if (!filterSearch) {
        x.style.height = '0';
        x.style.MozTransform = 'scale(0)';
        filterSearch = true;
    } else {
        x.style.height = 'auto';
        x.style.MozTransform = 'scale(1)';
        filterSearch = false;
    }
}

function showInbox() {
    var box = document.getElementById("inbox");
    if (!inbox) {
        box.style.left = '50%';
        box.style.marginLeft = '-310px';
        inbox = true;
    } else {
        box.style.left = '0%';
        box.style.marginLeft = '-630px';
        inbox = false;
    }
}

function compose() {
    var box = document.getElementsByClassName('compose')[0];
    doPopUp();
    box.style.MozTransform = 'scale(1)';
    box.style.WebkitTransform = 'scale(1)';
}