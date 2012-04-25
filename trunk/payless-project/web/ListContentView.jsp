<%@page import="Model.QueryResult"%>
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

                            out.println("<ul class=\"listcontents\" id=\"contentDownList\">");
                            out.println("</ul>");
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
                                   out.print("<a href=\"#\" onclick=\"tag_link(\'/ListContentPage?submit_tag=-1&id_tag=-1\')\">NO_FILTER</a> ");
                                    for(int i=0;i<list_tag.count();i++){
                                            out.print("<a href=\"#\" onclick=\"tag_link(\'/ListContentPage?submit_tag=-1&" +list_tag.get(i, "ID_TAG")+" \')\">"+list_tag.get(i, "NAMA_TAG")+"</a>");
                                            if((i+1)!=list_tag.count()){
                                                out.print(" ");
                                            }
                                    }                                    
                                }
                            %>
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