<%@page import="Model.User"%>
<%@page import="Model.QueryResult"%>
<jsp:useBean id="bean" class="Model.Model" scope="session"/>
<!--script type="text/javascript">
    interval_user=setInterval('scrollProfileContent("<?php echo BASE_URL?>",<?php if(!empty($user)) echo $user['ID_USER']; else echo '-1'?>);', 1000);
</script>    
        <!-- ::::::::::::::::::::: START OF BODY PART ::::::::::::::::::::: -->
        <% 
            QueryResult user = (QueryResult)bean.display.get("user");
            QueryResult posts = (QueryResult)bean.display.get("posts");
            QueryResult comments = (QueryResult)bean.display.get("comments");
            QueryResult achievements = (QueryResult)bean.display.get("achievements");
            {
        %>
        <div class="detbox">
            <div class="dettop"></div>
            <div class="detmain">
                <div class="userheader">
                    <% out.println(user.get(0, "NAMA")); %>'s Profile
                    <%
                        User currentUser = ((User) session.getAttribute("user"));
                        if (currentUser != null) {
                            out.println("<div class='right' id='compose-new' onclick='compose()'></div>");
                        }
                    %>
                </div>
                <div class="useravatar">
                    <%
                        if (user.get(0, "AVATAR") != null) {
                            out.println("<img src='avatar/" + user.get(0, "AVATAR") + "' width='150' alt='" + user.get(0, "USERNAME") + "'>");
                        } else {
                            out.println("<img src='img/avatar.jpg' width='150' alt='" + user.get(0, "USERNAME") + "'>");
                        }
                    %>
                </div>
                <div class="userdata">
                    <div class="userdata-header">
                        <div class="subtitle left ">USER INFORMATION</div>
                        <%
                            if (currentUser != null && currentUser.getID_User() == Integer.parseInt(user.get(0, "ID_USER"))) {
                                out.println("<div class='edituser left clearfix' onclick='editProfile();checkEditProfile()'>EDIT</div>");
                            }
                        %>
                    </div>
                    <div class="user-attribute">
                        <div class="lhs left">FULL NAME</div>
                        <div class="rhs left clearfix"><% out.println(user.get(0, "NAMA")); %></div>
                        <div class="lhs left">E-MAIL</div>
                        <div class="rhs left clearfix"><% out.println(user.get(0, "EMAIL")); %></div>
                        <div class="lhs left">GENDER</div>
                        <div class="rhs left clearfix"><% out.println(user.get(0, "GENDER")); %></div>
                        <div class="lhs left">STATUS</div>
                        <div class="rhs left clearfix"><% out.println(user.get(0, "STATUS")); %></div>
                        <div class="lhs left">BIRTHDATE</div>
                        <div class="rhs left clearfix"><% out.println(user.get(0, "TGL_LAHIR")); %></div>
                        <div class="lhs left">ABOUT ME</div>
                        <div class="rhs left clearfix"><% out.println(user.get(0, "ABOUT_ME")); %></div>
                        <div class="lhs left"># COMMENTS</div>
                        <div class="rhs left clearfix"><% out.println(comments.count()); %></div>
                        <div class="lhs left"># UPLOADS</div>
                        <div class="rhs left clearfix"><% out.println(posts.count()); %></div>
                        <div class="lhs left">POST LIST</div>
                    </div>
                    <div class="clear">
                        <ul id="profileDownList"></ul>
                    </div>
                    <% if(posts != null) { %>
                    <div class="show-more-post">
                        <div class="buttonprevious" >PREVIOUS</div>
                        <div class="buttonnext" style="margin-left: 9px;">NEXT</div>
                    </div>
                    <% } %>
                </div>
                <div class="userachievement">
                    <div class="subtitle left ">ACHIEVEMENTS</div>
                    <div class="clearfix"></div>
                    <!-- ACHIEVEMENT LIST -->
                    <%
                        if (achievements != null) {
                            out.println("<ul>");
                            for (int i = 0; i < achievements.count(); i++) {
                    %>
                    <li>
                        <div class="achievement">
                            <div class="ach_logo"><img src="img/achievements/<% out.print(achievements.get(i, "GAMBAR")); %>" alt=""></div>
                            <div class="ach_detail">
                                <div class="ach_name"><% out.println(achievements.get(i, "NAMA")); %></div>
                                <div class="ach_how"><% out.println(achievements.get(i, "DESKRIPSI")); %></div>
                            </div>
                        </div>
                    </li>
                    <%
                            }
                            out.println("</ul>");
                        }
                    %>
                </div>
            </div>
            <div class="detbot"></div>
        </div>
        <div style="height: 10px;"></div>

        <!-- EDIT DIV POP OUT -->
        <form method="post" action="UpdateProfile" enctype="multipart/form-data">
        <div class="edituserdata" id="edituserdata">
            <div class="edittop"></div>
            <div class="editmain">
                <div class="subtitle" style="margin: 0 20px;">EDIT PROFILE DATA</div>
                <!--
                <div class="txtfieldbox width90" style="border-top: 0; padding-top: 10px;">
                    <div class="left txtboxlabel">OLD PASSWORD</div>
                    <div class="right">
                        <input class="txtfield" type="password" size="30" name="password" onkeydown="ProcessPassword(this)" onkeyup="ProcessPassword(this)" />
                    </div>
                    <div class="clear"></div>
                    <div class="error" id="passwordError">Password must be at least 8 character.</div>
                </div>
                <div class="txtfieldbox width90">
                    <div class="left txtboxlabel">NEW PASSWORD</div>
                    <div class="right">
                        <input class="txtfield" type="password" size="30" name="newpass" onkeydown="ProcessPassword(this)" onkeyup="ProcessPassword(this)" />
                    </div>
                    <div class="clear"></div>
                    <div class="error" id="passwordError">Password must be at least 8 character.</div>
                </div>
                <div class="txtfieldbox width90">
                    <div class="left txtboxlabel">CONFIRM PASSWORD</div>
                    <div class="right">
                        <input class="txtfield" type="password" size="30" name="confirm" onkeydown="ProcessCPassword(this)" onkeyup="ProcessCPassword(this)" />
                    </div>
                    <div class="clear"></div>
                    <div class="error" id="cpasswordError">The password is not match.</div>
                </div>
                      -->
                <div class="txtfieldbox width90">
                    <div class="left txtboxlabel">EMAIL</div>
                    <div class="right">
                        <input class="txtfield" id="email-input" type="text" value="<% out.println(user.get(0, "EMAIL")); %>" size="30" name="email" onkeyup="checkEditProfile('<?php echo BASE_URL?>')" />
                    </div>
                    <div class="clear"></div>
                    <div class="error" id="emailError"></div>
                </div>
                <div class="txtfieldbox width90">
                    <div class="left txtboxlabel">GENDER</div>
                    <div class="right">
                        <select class="txtfield" id="gender-input" name="gender" onchange="checkEditProfile('<?php echo BASE_URL?>')" style="width: 215px"><option <% if(user.get(0, "GENDER").equals("none")) out.println("selected='selected'"); %> value="none">--Select--</option><option value="male" <% if (user.get(0, "GENDER").equals("Male")) out.println("selected='selected'"); %>>Male</option><option <% if (user.get(0, "GENDER").equals("Female")) out.println("selected='selected'"); %>value="female">Female</option></select>
                    </div>
                    <div class="clear"></div>
                    <div class="error" id="genderError"></div>
                </div>
                <div class="txtfieldbox width90">
                    <div class="left txtboxlabel">STATUS</div>
                    <div class="right">
                        <select class="txtfield" id="status-input" name="status" onchange="checkEditProfile('<?php echo BASE_URL?>')" style="width: 215px"><option <% if(user.get(0, "STATUS") == "none") out.println("selected='selected'"); %> value="none">--Select--</option><option <% if(user.get(0, "STATUS") == "Single") out.println("selected='selected'"); %> value="SINGLE">Forever Alone</option><option <% if(user.get(0, "STATUS") == "In Relationship") out.println("selected='selected'"); %> value="IN RELATIONSHIP">In a Relationship</option><option <?php if($user['STATUS']=="Married") echo 'selected="selected"'?> value="MARRIED">Married</option></select>
                    </div>
                    <div class="clear"></div>
                    <div class="error" id="statusError"></div>
                </div>
                <div class="txtfieldbox width90">
                    <div class="left txtboxlabel">AVATAR UPLOAD</div>
                    <div class="right">
                        <input class="txtfield" id="avatar-input" type="file" name="avatar" onchange="checkEditProfile('<?php echo BASE_URL?>')" accept="image/jpg, image/jpeg"/>
                    </div>
                    <div class="clear"></div>
                    <div class="error" id="avatarError"></div>
                </div>
                <div class="txtfieldbox width90">
                    <div class="left txtboxlabel">ABOUT ME</div>
                    <div class="right">
                        <textarea rows="5" cols="24" name="about"><% out.println(user.get(0, "ABOUT_ME")); %></textarea>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="txtfieldbox width90">
                    <div class="right">
                        <input class="joinbutton" id="edit-submit" type="submit" name="edit" value="Edit my Account!" />
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="editbot"></div>
        </div>
        </form>
        <% } %>

        <!---------------------->

        <!-- ::::::::::::::::::::: END OF BODY PART ::::::::::::::::::::: -->