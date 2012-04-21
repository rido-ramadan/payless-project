var webheader;
var savedStyle = GetCookie('style');
var sPath = window.location.pathname;
var pageName = sPath.substring(sPath.lastIndexOf('/') + 1, sPath.lastIndexOf('.'));

if(savedStyle) {
    document.write('<link rel="stylesheet" type="text/css" href="css/header'+savedStyle+'.css" id="header"/>');
} else {
    document.write('<link rel="stylesheet" type="text/css" href="css/header1.css" id="header"/>');
}

webheader = document.getElementById("header");

function ChangeStyle(style) {
    webheader.href = 'css/header'+style+'.css';
    SetCookie('style',style,30);
}

function GetCookie(key) {
    var result = document.cookie.match('(^|;) ?'+key+'=([^;]*)(;|$)');
    return result ? result[2] : null;
}

function SetCookie(key,value,time) {
    var date = new Date();
    date.setDate(date.getDate() + time);
    document.cookie = key + '=' + value + '; ' + 'expires=' + date.toUTCString() + ';';
}