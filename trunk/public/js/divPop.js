var elem = (document.compatMode === "CSS1Compat") ?
document.documentElement :
document.body;

var height = elem.clientHeight;
var width = elem.clientWidth;

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
    popup.style.display = 'block';
}

function closePopUp() {
    var overlay = document.getElementById('overlay');
    var popup = document.getElementById('popup');
    overlay.style.display = 'none';
    popup.style.display = 'none';
}

function editProfile() {
    var overlay = document.getElementById('overlay');
    var edit = document.getElementById('edituserdata');
    overlay.style.height = getHeight()  + 'px';
    overlay.style.display = 'block';
    edit.style.display = 'block';
}

function closeAll() {
    var overlay = document.getElementById('overlay');
    var edit = document.getElementById('edituserdata');
    var popup = document.getElementById('popup');
    var preview = document.getElementById('preview');
    overlay.style.display = 'none';
    popup.style.display = 'none';
    if (edit !== null) edit.style.display = 'none';
    if (preview !== null) preview.style.display = 'none';
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