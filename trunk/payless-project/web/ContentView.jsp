<%@page import="Model.Content"%>
<%@page import="java.util.HashMap"%>
<%@page import="Model.User"%>
<%@page import="Model.QueryResult"%>
<jsp:useBean id="bean" class="Model.Model" scope="session"/>
<script type="text/javascript">
    //setInterval('checkNewContent()', 1000);
    //interval=setInterval('scrollComment("<?php echo BASE_URL ?>",<?php if (!empty($content)) echo $content['ID_KONTEN']; else echo '-1' ?>);', 1000);
</script>    
<div class="detbox">
    <div class="dettop"></div>
    <div class="detmain">
        <%
            User user = ((User) session.getAttribute("user"));
            Content content = (Content) bean.display.get("content");
            if (content != null) {
        %>
        <div class="contentlist">
            <div class="paketkonten linkpost">
                <div class="left iconcontent">
                    <%
                        if (Integer.parseInt(content.getId_type()) == 1) {
                            out.println("<div class='iconlink'></div>");
                        } else if (Integer.parseInt(content.getId_type()) == 2) {
                            out.println("<div class='iconphoto'></div>");
                        } else {
                            out.println("<div class='iconvideo'></div>");
                        }
                    %>
                </div>
                <div class="headertext judul">
                    <div class="title"><a href="#"><% out.println(content.getJudul()); %></a></div>
                    <div class="uploader"><a href="/ProfilePage?user=<% out.println(content.getId_user()); %>"><% out.println(content.getNama()); %></a></div>
                    <div class="uploaded" <% out.println("id='time" + content.getId_konten() + "'"); %>></div>
                    <div class="uploaded" ></div>
                    <%
                        out.println("<script type='text/javascript'>setInterval(");
                        out.println("'timerContent");
                        out.println("('/', 'time', " + content.getId_konten() + ", '" + content.getWaktu() + "');");
                        out.println("'");
                        out.println(", 250</script>");
                    %>
                </div>
                <div class="content">
                    <%
                        if (Integer.parseInt(content.getId_type()) == 1) {
                            out.println("<a href='" + content.getLink() + "'> " + content.getLink() + "</a><p>" + content.getDeskripsi() + "</p>");
                        } else if (Integer.parseInt(content.getId_type()) == 2) {
                            out.println("<img src='image/" + content.getLink() + "' width='320' alt='beach'>");
                        } else {
                            out.println("<iframe width='320' height='240' src='" + content.getLink() + "' frameborder='0' allowfullscreen></iframe>");
                        }
                    %>
                </div>
                <div class="paketjempol">
                    <div class="views"></div>
                    <div class="viewcount" <% out.println("id='view" + content.getId_konten() + "'");%>></div><br/>
                    <div class="likemini"></div>
                    <div class="jumlahlike" <% out.println("id='like" + content.getId_konten() + "'");%>></div>
                    <div class="commentmini"></div>
                    <div class="jumlahkomen" <% out.println("id='comment" + content.getId_konten() + "'");%>></div>
                    <br/>
                    <%
                        if (session.getAttribute("user") != null) {
                            if (content.getStatus_user() != null) {
                                if (content.getStatus_user().compareTo("LIKE") == 0) {
                                    out.println("<div class='likebutton_pressed' id='likebutton" + content.getId_konten() + "'><a onclick='unlike(\'" + "/" + "\'," + content.getId_konten() + ")'></a></div>");
                                    out.println("<div class='dislikebutton' id='dislikebutton" + content.getId_konten() + "'><a onclick='undislike(\'" + "/" + "\'," + content.getId_konten() + ")'></a></div>");
                                } else {
                                    out.println("<div class='likebutton' id='likebutton" + content.getId_konten() + "'><a onclick='like(\'" + "/" + "\'," + content.getId_konten() + ")'></a></div>");
                                    out.println("<div class='dislikebutton_pressed' id='dislikebutton" + content.getId_konten() + "'><a onclick='undislike(\'" + "/" + "\'," + content.getId_konten() + ")'></a></div>");
                                }
                            } else {
                                out.println("<div class='likebutton' id='likebutton" + content.getId_konten() + "'><a onclick='like(\'" + "/" + "\'," + content.getId_konten() + ")'></a></div>");
                                out.println("<div class='dislikebutton' id='dislikebutton" + content.getId_konten() + "'><a onclick='dislike(\'" + "/" + "\'," + content.getId_konten() + ")'></a></div>");
                            }
                        }
                    %>
                    <div class="tags">
                        Tags : <br/>
                        <ul class="tag">
                            <%
                            out.print(content.getTag().length);
                                for(int i=0;i<content.getTag().length;i++){
                                    out.print("<li>"+content.getTag()[i]+"</li>");
                                }
                            %>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="commentlist" id="commentlist">
                <div class="commenttop"></div>
                <div class="commentcontainer" >
                    <div id="commentDownList">
                        <%
                            out.println("</div>");
                            if (session.getAttribute("user") != null) {
                                out.println("<div class='comment' style='border-bottom:0px'>");
                                out.println("<div class='avatar'>");
                                out.println("<img src='avatar/" + user.getAvatar() + "' alt='" + user.getName() + "' width='64' />");
                                out.println("</div>");
                                out.println("<div class='isikomen'>");
                                out.println("<form method='post' action='/ContentPage?id='" + content.getId_konten() + "'>");
                                out.println("<div class='submit-your-comment'><input type='button' onclick='submit_comment(\'" + "/" + "\', " + content.getId_konten() + ")' value='Comment' /></div>");
                                out.println("</form>");
                                out.println("</div>");
                                out.println("</div>");
                            }
                        %>
                    </div><!--
                    <div class="paketgantihalaman">
                        <div class="buttonprevious" onclick="window.location.href='contents.html'">PREVIOUS</div>
                        <div class="buttonnext" onclick="window.location.href='contents.html'">NEXT</div>
                    </div>-->
                </div>
            </div>
            <div class="filtermethod">
                <div class="ads" style="margin-top: 40px">
                    <div class="headertext" style="margin: 0 0 0 10px;">Advertisements</div>
                    <div class="advertises">
                        <img src="img/teh_kotak_ads.jpg" alt="Teh Kotak Broo...">
                    </div>
                </div>
            </div>
            <% }%>
        </div>
        <div class="detbot"></div>
    </div>