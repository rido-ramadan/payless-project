function timer(currTime)
{
    
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
    document.getElementById("time").innerHTML=strwaktu;
    
    var text="";
    if(tahun-ctahun>0) text+= tahun-ctahun+" years ago";
    else if(bulan-cbulan>0) text+= bulan-cbulan+" months ago";
    else if(hari-chari>0) text+= hari-chari+" days ago";
    else if(jam-cjam>0) text+= jam-cjam+" hours ago";
    else if(menit-cmenit>0) text+= menit-cmenit+" minutes ago";
    else if(detik-cdetik>0) text+= detik-cdetik+" seconds ago";
    document.getElementById("time").innerHTML+="<br>"+text;
    setTimeout("timer('"+currTime+"')",2);
}
