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
    var links = document.forms["newpostform"]["link-input"].value;
    var desc = document.forms["newpostform"]["description"].value;
    var href = links;
    var http = /^http:\/\/+[A-Za-z0-9_.-]/;
    var tags = document.forms["newpostform"]["tags"].value.split(",");
    var tag = "";
    
    if (!http.test(links)) {
        href = "http://" + links;
    }

    var preview = document.getElementById('preview');
    preview.style.display = 'block';

    for (i = 0; i < tags.length; i++) {
        tag += "<li>" + tags[i] + "</li>";
    }
    if(link.checked) {
        preview.innerHTML =
            '<div class="previewtop"></div>' +
            '<div class="previewmain">' +
                '<div class="left iconcontent"><div class="iconlink"></div></div>' +
                '<div class="headertext judul" id="linktitle">' +
                    '<div class="title"><a href="' + title +'.php">' + title + '</a></div>' +
                '</div>' +
                '<div class="content" id="linkcontent">' +
                    '<a href="' + href + '">' + links + '</a>' +
                    '<p>' + desc + '</p>' +
                '</div>' +
                '<div class="paketjempol">' +
                    '<div class="likemini"></div><div class="jumlahlike"></div><div class="commentmini"></div><div class="jumlahkomen"></div><br/>' +
                    '<div class="likebutton" onclick="voteplus(this.num)"><a></a></div><div class="dislikebutton" onclick="votemin(this.num)"><a></a></div>' +
                    '<div class="tags">' +
                        'Tags : <br/>' +
                        '<ul class="tag">' + tag + '</ul>' +
                    '</div>' +
                '</div>' +
            '</div>' +
            '<div class="previewbot"></div>';
    } else if (video.checked) {
        var param = href.split("watch?v=");
        param[0] = param[0] + "embed/";
        var ID = param[1].split("&");
        preview.innerHTML =
            '<div class="previewtop"></div>' +
            '<div class="previewmain">' +
                '<div class="left iconcontent"><div class="iconvideo"></div></div>' +
                '<div class="headertext judul">' +
                    '<a href="' + title + '.php' + '">' + title + '</a>' +
                '</div>' +
                '<div class="content">' +
                    '<iframe width="320" height="240" src="' + param[0] + ID[0] + '" frameborder="0" allowfullscreen></iframe>' +
                '</div>' +
                '<div class="paketjempol">' +
                    '<div class="likemini"></div><div class="jumlahlike"></div><div class="commentmini"></div><div class="jumlahkomen"></div><br/>' +
                    '<div class="likebutton" onclick="voteplus(this.num)"><a></a></div><div class="dislikebutton" onclick="votemin(this.num)"><a></a></div>' +
                    '<div class="tags">' +
                        'Tags : <br/>' +
                        '<ul class="tag">' + tag + '</ul>' +
                    '</div>' +
                '</div>' +                
            '</div>' +
            '<div class="previewbot"></div>';
    }
}