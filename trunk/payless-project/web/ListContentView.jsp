
<%@page import="Model.User"%>
<%@page import="java.util.ArrayList"%>
<%@page import="Model.QueryResult"%>
<%@page import="Model.Content"%>
<jsp:useBean id="bean" class="Model.Model" scope="session"/>
<script type="text/javascript">
    <% if(bean.display.get("gate")!=null){ 
        String current_tag=(String) bean.display.get("current_tag"); 
        String current_sort=(String) bean.display.get("current_sort"); 
    %>
        setInterval('scroll("/",<% if(current_tag!=null) out.print(current_tag); else out.print("-1"); %>, <% if(current_sort!=null) out.print(current_sort); else out.print("-1"); %>);', 1000);
    <% }else{ 
        String input_tag_from_text=(String) bean.display.get("input_tag_from_text"); 
        %>
        setInterval('scroll_tag("/","<% if(input_tag_from_text!=null) out.print("input_tag_from_text"); %>");', 1000);    
    <% } %>
    </script>
    <div id='postedComment'>
                <center>
                </center>
            </div>
    <div class="pagebar">
       <div class="notification">
        Show contents by filter: <b id="filtermethod">
        <%
            String isi_input_tag="";
            if(bean.display.get("current_list_tag")==null)
                out.print("NO_FILTER");
           else{
                if(bean.display.get("current_list_tag")!=null){
                    String[] current_list_tag = (String[])bean.display.get("current_list_tag");
                    for(int j=0;j<current_list_tag.length;j++){
                        out.print(current_list_tag[j]);
                        isi_input_tag+=current_list_tag[j];
                        if((j+1)!=current_list_tag.length){
                            out.print(", ");
                            isi_input_tag+=", ";
                        }
                    }
                }
           }
        %>
        
        </b>| sorted by: <b id="sortingmethod">
            <%
            if(bean.display.get("current_sort")!=null){
                if(Integer.parseInt((String)bean.display.get("current_sort"))==-1){
                    out.println("Most Popular");
                }else{
                    out.print("Most Commented");
                }
            }
            %></b>
    </div>
</div>

        <div class="detbox">
            <div class="dettop"></div>
            <div class="detmain">
                <div class="contentlist" >
                    <%
                            //out.println("<ul class=\"listcontents\" id=\"contentDownList\">");
                            //out.println("</ul>");
                    %>
                    
                    <%
                    ArrayList<Content> konten = (ArrayList<Content>)bean.display.get("konten");
                        //echo count($konten).':'.$index;
                    for(int i=0;i<konten.size();i++){
                       if(i<konten.size()){
                            out.print("<li><div class=\"paketkonten ");
                                if(konten.get(i).getId_type().equals("1")) 
                                    out.print("link");
                               else if(konten.get(i).getId_type().equals("2")) 
                                    out.print("image");
                               else if(konten.get(i).getId_type().equals("3")) 
                                    out.print("video");

                                out.print("post\">"
                                        + "<div class=\"left iconcontent\"><div class=\"icon");
                                if(konten.get(i).getId_type().equals("1")) out.print("link");
                                else if(konten.get(i).getId_type().equals("2")) out.print("image");
                                else if(konten.get(i).getId_type().equals("3")) out.print("video");

                                out.print("\"></div></div><div class=\"headertext judul\">"
                                        + "<div class=\"title\"><a href=\"ContentPage?id="+konten.get(i).getId_konten()+"\">"+konten.get(i).getJudul() +"</a></div>"
                                        + "<div class=\"uploader\"><a href=\"ProfilePage?user="+konten.get(i).getId_user()+"\">"+konten.get(i).getNama()+"</a></div>"
                                        + "<div class=\"uploaded\" id=\"time"+konten.get(i).getId_konten()+"\"></div>"
                                        + ""
                                                + "</div>"
                                                + "<div class=\"content\">");
                                if(konten.get(i).getId_type().equals("1")) 
                                    out.print("<a href=\""+konten.get(i).getLink()+"\"> "+konten.get(i).getLink()+" </a><p> "+konten.get(i).getDeskripsi() +" </p>");
                                else if(konten.get(i).getId_type().equals("2")) out.print("<img src=\"/image/"+konten.get(i).getLink() +"\" width=\"320\" alt=\"beach\">"
                                        + "");
                                else if(konten.get(i).getId_type().equals("3")) out.print("<iframe width=\"320\" height=\"240\" src=\""+konten.get(i).getLink()+"\" frameborder=\"0\" "
                                        + "allowfullscreen></iframe>");


                                out.print("</div><div class=\"paketjempol\"><div class=\"views\"></div>"
                                        + "<div class=\"viewcount\" id=\"view'.$konten[$i]['ID_KONTEN'].'\"></div><br/>"
                                        + "<div class=\"likemini\"></div>"
                                        + "<div class=\"jumlahlike\" id=\"like'.$konten[$i]['ID_KONTEN'].'\"></div>"
                                        + "<div class=\"commentmini\"></div>"
                                        + "<div class=\"jumlahkomen\" id=\"comment'.$konten[$i]['ID_KONTEN'].'\"></div>"
                                        + "<br/>");
                                User user = (User)session.getAttribute("user");
                                   if(user!=null){
                                        if(konten.get(i).getStatus_user()!=null){
                                            out.print(konten.get(i).getStatus_user().equals("LIKE")?"<div class=\"likebutton_pressed\" id=\"likebutton'.$konten[$i]['ID_KONTEN'].'\">"
                                                    + "<a onclick=\"unlike(\''.BASE_URL.'\','.$konten[$i]['ID_KONTEN'].')\">"
                                                    + "</a></div><div class=\"dislikebutton\" id=\"dislikebutton'.$konten[$i]['ID_KONTEN'].'\"><a "
                                                    + "onclick=\"undislike(\''.BASE_URL.'\','.$konten[$i]['ID_KONTEN'].')\">"
                                                    + "</a></div>":"<div class=\"likebutton\" id=\"likebutton'.$konten[$i]['ID_KONTEN'].'\">"
                                                    + "<a onclick=\"like(\''.BASE_URL.'\','.$konten[$i]['ID_KONTEN'].')\">"
                                                    + "</a></div><div class=\"dislikebutton_pressed\" id=\"dislikebutton'.$konten[$i]['ID_KONTEN'].'\"><a onclick=\"undislike(\''.BASE_URL.'\','.$konten[$i]['ID_KONTEN'].')\">"
                                                    + "</a></div>");
                                        }else{
                                            out.print("<div class=\"likebutton\" id=\"likebutton'.$konten[$i]['ID_KONTEN'].'\"><a onclick=\"like(\''.BASE_URL.'\','.$konten[$i]['ID_KONTEN'].')\"></a></div>"
                                                    + "<div class=\"dislikebutton\" id=\"dislikebutton'.$konten[$i]['ID_KONTEN'].'\">"
                                                    + "<a onclick=\"dislike(\''.BASE_URL.'\','.$konten[$i]['ID_KONTEN'].')\"></a></div>");
                                        }
                                    }else{
                                        out.print("<div class=\"likebutton\" id=\"likebutton'.$konten[$i]['ID_KONTEN'].'\"><a href=\"#\"></a>"
                                                + "</div><div class=\"dislikebutton\" id=\"dislikebutton'.$konten[$i]['ID_KONTEN'].'\">"
                                                + "<a href=\"#\"></a></div>");
                                    }
                                    out.print("<div class=\"tags\">Tags : <br/><ul class=\"tag\">");
                                    for(int j=0;j<konten.get(i).getTag().length;j++){
                                        out.print("<li><a href=\"'.BASE_URL.'content_con/list_content/-1/'.$konten[$i]['TAG'][$j]['ID_TAG'].'\">"+konten.get(i).getTag()[j]+"</a></li>");
                                    }
                                        out.print("</ul></div></div></div></li>");



                        }

                    }
                    %>
                </div>
                <div class="filtermethod">
                    <div class="inputtag">
                        <div class="headertext" style="margin: 10px 0 0 15px;">Filter by Tags</div>
                        <form name="filtertag" action="/ListContentPage?submit_tag=0" method="post">
                            <div class="tagbar">
                                <span class="sbox_l"></span>
                                <span class="sbox">
                                    <input style="outline-width:0px;" type="text" name="input_tag" value="<% if(bean.display.get("isi_input_tag")!=null) out.print(bean.display.get("isi_input_tag")); %>" placeholder="input tags" >
                                </span>
                                <span class="sbox_r" id="srch_clear"></span>
                            </div>
                            <div class="tagsubmit">
                                <input type="submit"  value="Submit">
                            </div>
                            <div class="sorts">
                                Sort by:
                                <div class="sortingmethod">
                                    <select name="sortmethod" id="Sorting" onchange="sort_content('<% out.print("/ContentPage");%>')">
                                        <option value="-1">Newest</option>
                                        <option <% if(bean.display.get("current_sort")!=null && Integer.parseInt((String)bean.display.get("current_sort")) == 1) out.print("selected=\"selected\"");%> value="1">Most Popular</option>
                                        <option <% if(bean.display.get("current_sort")!=null && Integer.parseInt((String)bean.display.get("current_sort")) == 2) out.print("selected=\"selected\"");%> value="2">Most Commented</option>
                                        <option <% if(bean.display.get("current_sort")!=null && Integer.parseInt((String)bean.display.get("current_sort")) == 3) out.print("selected=\"selected\"");%> value="3">Most Viewed</option>
                                    </select>
                                </div>
                            </form>
                            </div>
                        <!--/div-->
                    </div>
                    <div class="tagclouds">
                        <div class="headertext" style="margin: 0 0 0 10px;">Choose a Tag</div>
                        <div class="tagcloudscontent">
                            <%
                            if(bean.display.get("list_tag")!=null){
                                QueryResult list_tag = (QueryResult) bean.display.get("list_tag");
                                   out.print("<a href=\"#\" onclick=\"tag_link(\'/ListContentPage?submit_tag=-1&id_tag=-1\');\">NO_FILTER</a> ");
                                    for(int i=0;i<list_tag.count();i++){
                                            out.print("<a href=\"#\" onclick=\"tag_link(\'/ListContentPage?submit_tag=-1&id_tag=" +list_tag.get(i, "ID_TAG")+"\')\">"+list_tag.get(i, "NAMA_TAG")+"</a>");
                                            if((i+1)!=list_tag.count()){
                                                out.print(" ");
                                            }
                                    }                                    
                                }
                            %>
                            <script type="text/javascript">
                            function tag_link(url){
                                var sort = document.getElementById('Sorting').value;
                                document.location.href=url+"&sort="+sort;
                            }                                
                            </script>
                        </div>
                    </div>

                    <div class="ads">
                        <div class="headertext" style="margin: 0 0 0 10px;">Advertisements</div>
                        <div class="advertises">
                            <img src="/img/teh_kotak_ads.jpg" alt="Teh Kotak Broo...">
                        </div>
                    </div>
                </div>
            </div>
            <div class="detbot"></div>
        </div>