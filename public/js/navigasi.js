var jumlike = new Array();
var jumkomen = new Array();

var like = document.getElementsByClassName("likebutton");
var dislike = document.getElementsByClassName("dislikebutton");
var latest = document.getElementById("latest");
var bleh = document.getElementById("superbaru");

function inisialisasi(){
	var p=0;
	while (p<like.length){
		like[p].num = p;
		like[p].clicked = 0;
		dislike[p].num = p;
		dislike[p].clicked = 0;
		p++;
	}
}

function voteplus(x){
	if (dislike[x].clicked==0 && like[x].clicked==0){
		jumlike[x]++;
		document.getElementsByClassName("jumlahlike")[x].innerHTML=jumlike[x];
		changeLikeImage(x);
		like[x].clicked=1;
	} else if (like[x].clicked==1){
		jumlike[x]--;
		document.getElementsByClassName("jumlahlike")[x].innerHTML=jumlike[x];
		changeLikeImage(x);
		like[x].clicked=0;
	} else {
	}
}

function votemin(x){
	if (dislike[x].clicked==0 && like[x].clicked==0){
		jumlike[x]--;
		document.getElementsByClassName("jumlahlike")[x].innerHTML=jumlike[x];
		changeDislikeImage(x);
		dislike[x].clicked=1;
	} else if (dislike[x].clicked==1){
		jumlike[x]++;
		document.getElementsByClassName("jumlahlike")[x].innerHTML=jumlike[x];
		changeDislikeImage(x);
		dislike[x].clicked=0;
	} else {
	}
}

function randomlike(){
	var i=0;
	while (i<like.length){
		jumlike[i]=Math.floor(Math.random()*100001)-50001;
		document.getElementsByClassName("jumlahlike")[i].innerHTML=jumlike[i];
		i++;
	}
}

function randomkomen(){
	var i=0;
	while (i<like.length){
		jumkomen[i]= Math.floor(Math.random()*8)+3;
		document.getElementsByClassName("jumlahkomen")[i].innerHTML=jumkomen[i];
		i++;
	}
}

function changeLikeImage(i){
    var imgPath = new String();
    imgPath = like[i].style.backgroundImage;
        
    if(like[i].clicked==0)
    {
        like[i].style.backgroundImage = "url(images/icon-like-click.png)";
    }
    else
    {
        like[i].style.backgroundImage = "url(images/icon-like.png)";
    }
}

function changeDislikeImage(i){
    var imgPath = new String();
    imgPath = dislike[i].style.backgroundImage;
	if(dislike[i].clicked==0)
    {
        dislike[i].style.backgroundImage = "url(images/icon-dislike-click.png)";
    }
    else
    {
		dislike[i].style.backgroundImage = "url(images/icon-dislike.png)";
    }
}

function comment(){
//    var date = new Date();
//    date.toLocaleFormat(formatString);

    var content = document.getElementById("ucomment");
    // latest.style.display = 'block';
    // document.getElementById("newcomment").innerHTML = "<br/><b> Special User </b><br/>" + content.value;
	var newdiv = document.createElement('div');
	newdiv.setAttribute("class","comment");
	newdiv.setAttribute("name","commentbaru");
	newdiv.innerHTML = '<div class="left avatar">' +
                                '<img style="margin: 2px;" src="images/avatar.png" alt="avatar" width="64" />' +
                            '</div>' +
                            '<div class="isikomen">' +
                                '<br/><div class="namecomment">Special User</div><div class="timecomment">' + new Date().toUTCString() +'</div>' +
								content.value +
                            '</div>';
	bleh.insertBefore(newdiv,document.getElementsByName("commentbaru")[0]);
	content.value = "";
}