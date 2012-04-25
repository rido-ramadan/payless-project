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
            QueryResult content = (QueryResult) bean.display.get("content");
            { //if (content != null) {
        %>
        <div class="contentlist">
            <div class="paketkonten linkpost">
                <div class="left iconcontent">
                    <%
                        if (Integer.parseInt(content.get(0, "ID_TYPE")) == 1) {
                            out.println("<div class='iconlink'></div>");
                        } else if (Integer.parseInt(content.get(0, "ID_TYPE")) == 2) {
                            out.println("<div class='iconphoto'></div>");
                        } else {
                            out.println("<div class='iconvideo'></div>");
                        }
                    %>
                </div>
                <div class="headertext judul">
                    <div class="title"><a href="#"><% out.println(content.get(0, "JUDUL")); %></a></div>
                    <div class="uploader"><a href="/ProfilePage?user=<% out.println(content.get(0, "ID_USER")); %>"><% out.println(content.get(0, "NAMA")); %></a></div>
                    <div class="uploaded" <% out.println("id='time" + content.get(0,"ID_KONTEN") + "'"); %>></div>
                    <div class="uploaded" ></div>
                    <%
                        out.println("<script type='text/javascript'>setInterval(");
                        out.println("'timerContent");
                        out.println("('/', 'time', " + content.get(0, "ID_KONTEN") + ", '" + content.get(0, "WAKTU") + "');");
                        out.println("'");
                        out.println(", 250</script>");
                    %>
                </div>
                <div class="content">
                    <%
                        if (Integer.parseInt(content.get(0, "ID_TYPE")) == 1) {
                            out.println("<a href='" + content.get(0, "LINK") + "'> " + content.get(0, "LINK") + "</a><p>" + content.get(0, "DESKRIPSI") + "</p>");
                        } else if (Integer.parseInt(content.get(0, "ID_TYPE")) == 2) {
                            out.println("<img src='image/" + content.get(0, "LINK") + "' width='320' alt='beach'>");
                        } else {
                            out.println("<iframe width='320' height='240' src='" + content.get(0, "LINK") + "' frameborder='0' allowfullscreen></iframe>");
                        }
                    %>
                </div>
                <div class="paketjempol">
                    <div class="views"></div>
                    <div class="viewcount" <% out.println("id='view" + content.get(0, "ID_KONTEN") + "'");%>></div><br/>
                    <div class="likemini"></div>
                    <div class="jumlahlike" <% out.println("id='like" + content.get(0, "ID_KONTEN") + "'");%>></div>
                    <div class="commentmini"></div>
                    <div class="jumlahkomen" <% out.println("id='comment" + content.get(0, "ID_KONTEN") + "'");%>></div>
                    <br/>
                    <%
                        if (session.getAttribute("user") != null) {
                            if (content.get(0, "STATUS_USER") != null) {
                                if (content.get(0, "STATUS_USER").compareTo("LIKE") == 0) {
                                    out.println("<div class='likebutton_pressed' id='likebutton" + content.get(0, "ID_KONTEN") + "'><a onclick='unlike(\'" + "/" + "\'," + content.get(0, "ID_KONTEN") + ")'></a></div>");
                                    out.println("<div class='dislikebutton' id='dislikebutton" + content.get(0, "ID_KONTEN") + "'><a onclick='undislike(\'" + "/" + "\'," + content.get(0, "ID_KONTEN") + ")'></a></div>");
                                } else {
                                    out.println("<div class='likebutton' id='likebutton" + content.get(0, "ID_KONTEN") + "'><a onclick='like(\'" + "/" + "\'," + content.get(0, "ID_KONTEN") + ")'></a></div>");
                                    out.println("<div class='dislikebutton_pressed' id='dislikebutton" + content.get(0, "ID_KONTEN") + "'><a onclick='undislike(\'" + "/" + "\'," + content.get(0, "ID_KONTEN") + ")'></a></div>");
                                }
                            } else {
                                out.println("<div class='likebutton' id='likebutton" + content.get(0, "ID_KONTEN") + "'><a onclick='like(\'" + "/" + "\'," + content.get(0, "ID_KONTEN") + ")'></a></div>");
                                out.println("<div class='dislikebutton' id='dislikebutton" + content.get(0, "ID_KONTEN") + "'><a onclick='dislike(\'" + "/" + "\'," + content.get(0, "ID_KONTEN") + ")'></a></div>");
                            }
                        }
                    %>
                    <div class="tags">
                        Tags : <br/>
                        <ul class="tag">
                            <?php
                            for ($j = 0; $j < count($content['TAG']); $j++) {
                            echo '<li>' . $content['TAG'][$j]['NAMA_TAG'] . '</li>';
                            }
                            ?>
                            <%
                                HashMap<String, Object> tag = ((HashMap<String, Object>)content.get(0, "TAG"));
                                for (int i = 0; i < content.count(); i++) {
                                    tag.
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
                                out.println("<form method='post' action='/ContentPage?id='" + content.get(0, "ID_KONTEN") + "'>");
                                out.println("<div class='submit-your-comment'><input type='button' onclick='submit_comment(\'" + "/" + "\', " + content.get(0, "ID_KONTEN") + ")' value='Comment' /></div>");
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