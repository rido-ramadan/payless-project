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

function showAchievement() {
    var popup = document.getElementById('ach_popup');
    doPopUp();
    popup.style.display = 'block';
}

function closeAchievement() {
    var popup = document.getElementById('ach_popup');
    closeAll();
    popup.style.display = 'none';
}