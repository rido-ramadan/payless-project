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

function previewPost() {
    doPopUp();
    var title = document.forms["newpostform"]["title"].value;
    var links = document.forms["newpostform"]["hyperlink"].value;
    var desc = document.forms["newpostform"]["description"].value;
    var href = links;
    var http = /^http:\/\/+[A-Za-z0-9_.-]/;
    
    if (!http.test(links)) {
        href = "http://" + links;
    }

    var preview = document.getElementById('preview');
    preview.style.display = 'block';

    if(link.checked) {
        preview.innerHTML =
            '<div class="dettop"></div>' +
            '<div class="detmain">' +
                '<div class="left iconcontent"><img src="img/icon-link.png"></div>' +
                '<div class="headertext judul" id="linktitle">' +
                    '<a href="' + title + '.php' + '">' + title + '</a>' +
                '</div>' +
                '<div class="content" id="linkcontent">' +
                    '<a href="' + href + '">' + links + '</a>' +
                    '<p>' + desc + '</p>' +
                '</div>' +
            '</div>' +
            '<div class="detbot"></div>';
    } else if (video.checked) {
        var param = href.split("watch?v=");
        param[0] = param[0] + "embed/";
        var ID = param[1].split("&");
        preview.innerHTML =
            '<div class="dettop"></div>' +
            '<div class="detmain">' +
                '<div class="left iconcontent"><img src="img/icon-video.png"></div>' +
                '<div class="headertext judul">' +
                    '<a href="' + title + '.php' + '">' + title + '</a>' +
                '</div>' +
                '<div class="content">' +
                    '<iframe width="480" height="360" src="' + param[0] + ID[0] + '" frameborder="0" allowfullscreen></iframe>' +
                '</div>' +
            '</div>' +
            '<div class="detbot"></div>';
    }
}