<%@page import="Model.QueryResult"%>
<jsp:useBean id="bean" class="Model.Model" scope="session"/>
<div class="pagebar">
    <div class="notification">
        MOST POPULAR CONTENTS
    </div>
</div>
<!-- ::::::::::::::::::::: START OF BODY PART ::::::::::::::::::::: -->
<% 
    if(bean.display.get("content_most_like")!=null){
        QueryResult content_most_like= (QueryResult)bean.display.get("content_most_like");
        
        out.println("<div class=\"detbox\" style=\"padding-left:51px;\">"); 
        for(int i=0;i<3;i++){
            if(!content_most_like.isEmpty(i)){
                out.println("<div class=\"top-post\" id=\"commented-"+(i+1)+"\">");
                if(content_most_like.get(i, "ID_TYPE").equals("1")) 
                    out.println("<div class=\"top-link\">");
                else if(content_most_like.get(i, "ID_TYPE").equals("2")) 
                    out.println("<div class=\"top-image\">");
                else if(content_most_like.get(i, "ID_TYPE").equals("3")) 
                    out.println("<div class=\"top-video\">");

                out.println("<div class=\"contenttitle\"><a href=\"'.BASE_URL.'content_con/content/'.$content_most_like[$i]['ID_KONTEN'].'\">"+content_most_like.get(i, "JUDUL")+"</a></div>"
                        + "<div style=\"font: 11px/13px arial;font-weight:bold;margin-left:30px;margin-top:4px;\" "
                        + "class=\"uploaded\" id=\"timea"+content_most_like.get(i,"ID_KONTEN")+"\"></div>"
                        + "<script type=\"text/javascript\">setInterval(\"timerContent(\'"+
                        "BASE_URL\',\'timea\',\'"+content_most_like.get(i,"ID_KONTEN")+",\'"+content_most_like.get(i,"WAKTU")+"\'\")"+"250)</script>");
                out.println("<div class=\"view\">");
                if(content_most_like.get(i,"ID_TYPE").equals("1")){
                    out.println("<div class=\"view-link-url\"><a href=\" " + content_most_like.get(i,"LINK") + " \"> "
                    + content_most_like.get(i,"LINK")+"</a></div><div class=\"view-link-desc\">"+content_most_like.get(i,"DESKRIPSI")+"</div>");
                }else if(content_most_like.get(i,"ID_TYPE").equals("2")){
                    out.println("<div class=\"view-image\"><img "
                            + "src=\"'.BASE_URL.'image/'.$content_most_like[$i]['LINK'].'\" "
                            + "width=\"260\" alt=\"'.$content_most_like[$i]['JUDUL'].'\"></div>");
                }else if(content_most_like.get(i,"ID_TYPE").equals("3")){
                    out.println("<div class=\"view-video\"><div class=\"view\">"
                            + "<iframe width=\"240\" height=\"180\" src=\"'.$content_most_like[$i]['LINK'].'\" "
                            + "></iframe></div></div>");
                }
                out.println("</div> <div class=\"basic-features\"><div class=\"paketjempol\">"
                        + "<div class=\"likemini\"></div><div class=\"jumlahlike\" "
                        + "id=\"like'.$content_most_like[$i]['ID_KONTEN'].'\"></div>"
                        + "<div class=\"commentmini\"></div><div class=\"jumlahkomen\" "
                        + "id=\"comment'.$content_most_like[$i]['ID_KONTEN'].'\"></div>"
                        + "<br/>");
                if(false){//if(!empty($_SESSION['login'])){
                    if(content_most_like.get(i,"STATUS_USER")!=""){
                        out.println(content_most_like.get(i,"STATUS_USER").equals("LIKE")?
                            "<div class=\"likebutton_pressed\" id=\"likebutton'.$content_most_like[$i]['ID_KONTEN'].'\""
                            + "><a onclick=\"unlike(\''.BASE_URL.'\','.$content_most_like[$i]['ID_KONTEN'].')\">"
                            + "</a></div>"
                            + "<div class=\"dislikebutton\" id=\"dislikebutton'.$content_most_like[$i]['ID_KONTEN'].'\""
                            + "><a onclick=\"undislike(\''.BASE_URL.'\','.$content_most_like[$i]['ID_KONTEN'].')\">"
                            + "</a></div>" :
                            "<div class=\"likebutton\" id=\"likebutton'.$content_most_like[$i]['ID_KONTEN'].'\">"
                            + "<a onclick=\"like(\''.BASE_URL.'\','.$content_most_like[$i]['ID_KONTEN'].')\"></a>"
                            + "</div>"
                            + "<div class=\"dislikebutton_pressed\" id=\"dislikebutton'.$content_most_like[$i]['ID_KONTEN'].'\">"
                            + "<a onclick=\"undislike(\''.BASE_URL.'\','.$content_most_like[$i]['ID_KONTEN'].')\">"
                            + "</a></div>");
                    }else{
                        out.println("<div class=\"likebutton\" id=\"likebutton'.$content_most_like[$i]['ID_KONTEN'].'\">"
                                + "<a onclick=\"like(\''.BASE_URL.'\','.$content_most_like[$i]['ID_KONTEN'].')\"></a>"
                                + "</div>"
                                + "<div class=\"dislikebutton\" id=\"dislikebutton'.$content_most_like[$i]['ID_KONTEN'].'\">"
                                + "<a onclick=\"dislike(\''.BASE_URL.'\','.$content_most_like[$i]['ID_KONTEN'].')\"></a>"
                                + "</div>");
                    }
                }else{
                    out.println("<div class=\"likebutton\" id=\"likebutton'.$content_most_like[$i]['ID_KONTEN'].'\">"
                            + "<a href=\"#\"></a></div>"
                            + "<div class=\"dislikebutton\" id=\"dislikebutton'.$content_most_like[$i]['ID_KONTEN'].'\">"
                            + "<a href=\"#\"></a></div>");
                }
                out.println("</div></div></div></div>");
            }
        }
        out.println("</div>");
    }
    out.println("<div class=\"pagebar\" style=\"margin-top: 20px;\"><div class=\"notification\">"
            + "MOST COMMENTED CONTENTS</div></div>");
    
    
%>
