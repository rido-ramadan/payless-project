<%@page import="Model.User"%>
<%@page import="Model.User"%>
<%@page import="Model.Content"%>
<%@page import="java.util.ArrayList"%>
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
        ArrayList<Content> content_most_like= (ArrayList<Content>)bean.display.get("content_most_like");
        User user = (User)session.getAttribute("user");
        out.println("<div class=\"detbox\" style=\"padding-left:51px;\">"); 
        for(int i=0;i<3;i++){
            if(content_most_like.size()>i){
                out.println("<div class=\"top-post\" id=\"commented-"+(i+1)+"\">");
                if(content_most_like.get(i).getId_type().equals("1")) 
                    out.println("<div class=\"top-link\">");
               else if(content_most_like.get(i).getId_type().equals("2")) 
                    out.println("<div class=\"top-image\">");
                               else if(content_most_like.get(i).getId_type().equals("3")) 
                    out.println("<div class=\"top-video\">");

                out.println("<div class=\"contenttitle\"><a href=\"/ContentPage?id="+content_most_like.get(i).getId_konten() +"\">"+content_most_like.get(i).getJudul()+"</a></div>"
                        + "<div style=\"font: 11px/13px arial;font-weight:bold;margin-left:30px;margin-top:4px;\" "
                        + "class=\"uploaded\" id=\"timea"+content_most_like.get(i).getId_konten()+"\"></div>"
                        + "");
                out.println("<div class=\"view\">");
                if(content_most_like.get(i).getId_type().equals("1")){
                    out.println("<div class=\"view-link-url\"><a href=\" " + content_most_like.get(i).getLink() + " \"> "
                    + content_most_like.get(i).getLink()+"</a></div><div class=\"view-link-desc\">"+content_most_like.get(i).getDeskripsi()+"</div>");
                }else if(content_most_like.get(i).getId_type().equals("2")){
                    out.println("<div class=\"view-image\"><img "
                            + "src=\"/image/"+content_most_like.get(i).getLink() +"\" "
                            + "width=\"260\" alt=\""+content_most_like.get(i).getJudul() +"\"></div>");
                }else if(content_most_like.get(i).getId_type().equals("3")){
                    out.println("<div class=\"view-video\"><div class=\"view\">"
                            + "<iframe width=\"240\" height=\"180\" src=\""+content_most_like.get(i).getLink() +"\" "
                            + "></iframe></div></div>");
                }
                out.println("</div> <div class=\"basic-features\"><div class=\"paketjempol\">"
                        + "<div class=\"likemini\"></div><div class=\"jumlahlike\" "
                        + "id=\"like"+content_most_like.get(i).getId_konten() +"\">"+content_most_like.get(i).getLike() +"</div>"
                        + "<div class=\"commentmini\"></div><div class=\"jumlahkomen\" "
                        + "id=\"comment"+content_most_like.get(i).getId_konten() +"\">"+content_most_like.get(i).getKomentar().length +"</div>"
                        + "<br/>");
                if(user!=null){//if(!empty($_SESSION['login'])){
                    if(content_most_like.get(i).getStatus_user()!=null){
                        out.println(content_most_like.get(i).getStatus_user().equals("LIKE")?
                            "<div class=\"likebutton_pressed\" id=\"likebutton"+content_most_like.get(i).getId_konten() +"\""
                            + "><a onclick=\"unlike(\'/\',"+content_most_like.get(i).getId_konten() +")\">"
                            + "</a></div>"
                            + "<div class=\"dislikebutton\" id=\"dislikebutton"+content_most_like.get(i).getId_konten() +"\""
                            + "><a onclick=\"dislike(\'/\',"+content_most_like.get(i).getId_konten() +")\">"
                            + "</a></div>" :
                            "<div class=\"likebutton\" id=\"likebutton'.$content_most_like[$i]['ID_KONTEN'].'\">"
                            + "<a onclick=\"like(\'/\',"+content_most_like.get(i).getId_konten() +")\"></a>"
                            + "</div>"
                            + "<div class=\"dislikebutton_pressed\" id=\"dislikebutton"+content_most_like.get(i).getId_konten() +"\">"
                            + "<a onclick=\"undislike(\'/\',"+content_most_like.get(i).getId_konten() +")\">"
                            + "</a></div>");
                    }else{
                        out.println("<div class=\"likebutton\" id=\"likebutton"+content_most_like.get(i).getId_konten() +"\">"
                                + "<a onclick=\"like(\'/\',"+content_most_like.get(i).getId_konten() +")\"></a>"
                                + "</div>"
                                + "<div class=\"dislikebutton\" id=\"dislikebutton"+content_most_like.get(i).getId_konten() +"\">"
                                + "<a onclick=\"dislike(\'/\',"+content_most_like.get(i).getId_konten() +")\"></a>"
                                + "</div>");
                    }
                }else{
                    out.println("<div class=\"likebutton\" id=\"likebutton"+content_most_like.get(i).getId_konten() +"\">"
                            + "<a href=\"#\"></a></div>"
                            + "<div class=\"dislikebutton\" id=\"dislikebutton"+content_most_like.get(i).getId_konten() +"\">"
                            + "<a href=\"#\"></a></div>");
                }
                out.println("</div></div></div></div>");
            }
        }
        out.println("</div>");
    }
    out.println("<div class=\"pagebar\" style=\"margin-top: 20px;\"><div class=\"notification\">"
            + "MOST COMMENTED CONTENTS</div></div>");
    if(bean.display.get("content_most_comment")!=null){
        ArrayList<Content> content_most_comment= (ArrayList<Content>)bean.display.get("content_most_comment");
        User user = (User)session.getAttribute("user");
        out.println("<div class=\"detbox\" style=\"padding-left:51px;\">"); 
        for(int i=0;i<3;i++){
            if(content_most_comment.size()>i){
                out.println("<div class=\"top-post\" id=\"commented-"+(i+1)+"\">");
                if(content_most_comment.get(i).getId_type().equals("1")) 
                    out.println("<div class=\"top-link\">");
               else if(content_most_comment.get(i).getId_type().equals("2")) 
                    out.println("<div class=\"top-image\">");
                               else if(content_most_comment.get(i).getId_type().equals("3")) 
                    out.println("<div class=\"top-video\">");

                out.println("<div class=\"contenttitle\"><a href=\"/ContentPage?id="+content_most_comment.get(i).getId_konten() +"\">"+content_most_comment.get(i).getJudul()+"</a></div>"
                        + "<div style=\"font: 11px/13px arial;font-weight:bold;margin-left:30px;margin-top:4px;\" "
                        + "class=\"uploaded\" id=\"timea"+content_most_comment.get(i).getId_konten()+"\"></div>"
                        + "");
                out.println("<div class=\"view\">");
                if(content_most_comment.get(i).getId_type().equals("1")){
                    out.println("<div class=\"view-link-url\"><a href=\" " + content_most_comment.get(i).getLink() + " \"> "
                    + content_most_comment.get(i).getLink()+"</a></div><div class=\"view-link-desc\">"+content_most_comment.get(i).getDeskripsi()+"</div>");
                }else if(content_most_comment.get(i).getId_type().equals("2")){
                    out.println("<div class=\"view-image\"><img "
                            + "src=\"/image/"+content_most_comment.get(i).getLink() +"\" "
                            + "width=\"260\" alt=\""+content_most_comment.get(i).getJudul() +"\"></div>");
                }else if(content_most_comment.get(i).getId_type().equals("3")){
                    out.println("<div class=\"view-video\"><div class=\"view\">"
                            + "<iframe width=\"240\" height=\"180\" src=\""+content_most_comment.get(i).getLink() +"\" "
                            + "></iframe></div></div>");
                }
                out.println("</div> <div class=\"basic-features\"><div class=\"paketjempol\">"
                        + "<div class=\"likemini\"></div><div class=\"jumlahlike\" "
                        + "id=\"like"+content_most_comment.get(i).getId_konten() +"\">"+content_most_comment.get(i).getLike() +"</div>"
                        + "<div class=\"commentmini\"></div><div class=\"jumlahkomen\" "
                        + "id=\"comment"+content_most_comment.get(i).getId_konten() +"\">"+content_most_comment.get(i).getKomentar().length +"</div>"
                        + "<br/>");
                if(user!=null){//if(!empty($_SESSION['login'])){
                    if(content_most_comment.get(i).getStatus_user()!=null){
                        out.println(content_most_comment.get(i).getStatus_user().equals("LIKE")?
                            "<div class=\"likebutton_pressed\" id=\"likebutton"+content_most_comment.get(i).getId_konten() +"\""
                            + "><a onclick=\"unlike(\'/\',"+content_most_comment.get(i).getId_konten() +")\">"
                            + "</a></div>"
                            + "<div class=\"dislikebutton\" id=\"dislikebutton"+content_most_comment.get(i).getId_konten() +"\""
                            + "><a onclick=\"dislike(\'/\',"+content_most_comment.get(i).getId_konten() +")\">"
                            + "</a></div>" :
                            "<div class=\"likebutton\" id=\"likebutton'.$content_most_comment[$i]['ID_KONTEN'].'\">"
                            + "<a onclick=\"like(\'/\',"+content_most_comment.get(i).getId_konten() +")\"></a>"
                            + "</div>"
                            + "<div class=\"dislikebutton_pressed\" id=\"dislikebutton"+content_most_comment.get(i).getId_konten() +"\">"
                            + "<a onclick=\"undislike(\'/\',"+content_most_comment.get(i).getId_konten() +")\">"
                            + "</a></div>");
                    }else{
                        out.println("<div class=\"likebutton\" id=\"likebutton"+content_most_comment.get(i).getId_konten() +"\">"
                                + "<a onclick=\"like(\'/\',"+content_most_comment.get(i).getId_konten() +")\"></a>"
                                + "</div>"
                                + "<div class=\"dislikebutton\" id=\"dislikebutton"+content_most_comment.get(i).getId_konten() +"\">"
                                + "<a onclick=\"dislike(\'/\',"+content_most_comment.get(i).getId_konten() +")\"></a>"
                                + "</div>");
                    }
                }else{
                    out.println("<div class=\"likebutton\" id=\"likebutton"+content_most_comment.get(i).getId_konten() +"\">"
                            + "<a href=\"#\"></a></div>"
                            + "<div class=\"dislikebutton\" id=\"dislikebutton"+content_most_comment.get(i).getId_konten() +"\">"
                            + "<a href=\"#\"></a></div>");
                }
                out.println("</div></div></div></div>");
            }
        }
        out.println("</div>");
    }    
    
%>
