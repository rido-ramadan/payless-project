var imagelink = document.getElementById("imagelink");
var textlink = document.getElementById("textlink");
var linkdesc = document.getElementById("linkdesc");
var link = document.getElementById("link");
var image = document.getElementById("image");
var video = document.getElementById("video");

textlink.style.display = 'block';
linkdesc.style.display = 'block';
imagelink.style.display = 'none';

function ShowLink() {
    textlink.style.display = 'block';
    linkdesc.style.display = 'block';
    imagelink.style.display = 'none';
}

function ShowImageFile() {
    textlink.style.display = 'none';
    linkdesc.style.display = 'none';
    imagelink.style.display = 'block';
}

function ShowVideo() {
    textlink.style.display = 'block';
    linkdesc.style.display = 'none';
    imagelink.style.display = 'none';
}

function GoToPage() {
    if(link.checked) window.location = 'link.html';
    else if(image.checked) window.location = 'image.html';
    else if (video.checked) window.location = 'video.html';
}