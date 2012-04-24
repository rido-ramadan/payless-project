<%@page import="Model.User"%>
<%@page import="Model.QueryResult"%>
<jsp:useBean id="bean" class="Model.Model" scope="session"/>
<!--script type="text/javascript">
    interval_user=setInterval('scrollProfileContent("<?php echo BASE_URL?>",<?php if(!empty($user)) echo $user['ID_USER']; else echo '-1'?>);', 1000);
</script>    
        <!-- ::::::::::::::::::::: START OF BODY PART ::::::::::::::::::::: -->
        <% 
            QueryResult user = (QueryResult)bean.display.get("user");
            if(user != null) { 
                
                out.println(user.get(0, "NAMA"));
                out.println(user.get(0, "TGL_LAHIR"));
            }
        %>
        <% { %>
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
                        <div class="rhs left clearfix"><% user.get(0, "NAMA"); %></div>
                        <div class="lhs left">E-MAIL</div>
                        <div class="rhs left clearfix"><% user.get(0, "EMAIL"); %></div>
                        <div class="lhs left">GENDER</div>
                        <div class="rhs left clearfix"><% user.get(0, "GENDER"); %></div>
                        <div class="lhs left">STATUS</div>
                        <div class="rhs left clearfix"><% user.get(0, "STATUS"); %></div>
                        <div class="lhs left">BIRTHDATE</div>
                        <div class="rhs left clearfix"><% user.get(0, "TGL_LAHIR"); %></div>
                        <div class="lhs left">ABOUT ME</div>
                        <div class="rhs left clearfix"><% user.get(0, "ABOUT_ME"); %></div>
                        <div class="lhs left"># COMMENTS</div>
                        <div class="rhs left clearfix"><?php echo $user['KOMENTAR']?></div>
                        <div class="lhs left"># UPLOADS</div>
                        <div class="rhs left clearfix"><?php echo $user['POST']?></div>
                        <div class="lhs left">POST LIST</div>
                    </div>
                    <div class="clear">
                        <ul id="profileDownList">
                        <?php 
//                        if(!empty($user['KONTEN'])){
//                                echo '<ul>';
//                                for($i=0;$i<count($user['KONTEN']);$i++){
//                                    echo '
//                                <li><div class="top-post"">
//                                     <div class="top-';
//                                    if($user['KONTEN'][$i]['ID_TYPE']==1) echo 'link';
//                                        else if($user['KONTEN'][$i]['ID_TYPE']==2) echo 'image';
//                                        else if($user['KONTEN'][$i]['ID_TYPE']==3) echo 'video';
//                                    echo '">
//                                        <div class="contenttitle"><a href="'.BASE_URL.'content_con/content/'.$user['KONTEN'][$i]['ID_KONTEN'].'">'.$user['KONTEN'][$i]['JUDUL'].'</a></div>
//                                        <div class="view">';
//                                    
//                                    if($user['KONTEN'][$i]['ID_TYPE']==1) echo '
//                                        <div class="view-link-url"><a href="'.$user['KONTEN'][$i]['LINK'].'">'.$user['KONTEN'][$i]['LINK'].'</a></div>
//                                        <div class="view-link-desc">'.$user['KONTEN'][$i]['DESKRIPSI'].'</div>
//                                        ';
//                                        else if($user['KONTEN'][$i]['ID_TYPE']==2) echo '
//                                            <div class="view-image">
//                                                <img src="'.BASE_URL.'image/'.$user['KONTEN'][$i]['LINK'].'" width="260" alt="'.$user['KONTEN'][$i]['JUDUL'].'">
//                                            </div>
//                                            ';
//                                        else if($user['KONTEN'][$i]['ID_TYPE']==3) echo '
//                                            <div class="view-video">
//                                                <div class="view"><iframe width="240" height="180" src="'.$user['KONTEN'][$i]['LINK'].'" ></iframe></div>
//                                            </div>
//                                            ';
//                                    
//                                    
//                                        echo '</div>
//                                        <div class="basic-features">
//                                            <div class="paketjempol">
//                                                <div class="likemini"></div>
//                                                <div class="jumlahlike">'.$user['KONTEN'][$i]['LIKE'].'</div>
//                                                <div class="commentmini"></div>
//                                                <div class="jumlahkomen">'.count($user['KONTEN'][$i]['KOMENTAR']).'</div>
//                                                <br/>';
//                                        if(!empty($_SESSION['login'])){
//                                        echo '
//                                            <div class="likebutton"><a href="'.BASE_URL.'content_con/like/'.$user['KONTEN'][$i]['ID_KONTEN'].'"></a></div>
//                                            <div class="dislikebutton" "><a href="'.BASE_URL.'content_con/dislike/'.$user['KONTEN'][$i]['ID_KONTEN'].'"></a></div>';
//                                        }        
//                                            echo '</div>
//                                        </div>
//                                    </div>
//                                </div>
//                            </li>                                        
//                                        ';
//                                }
//                                echo '</ul>';
//                            }
                        ?>
                    </ul>
                    </div>
                    <?php if(!empty($user['KONTEN'])){
                        echo '
                    <div class="show-more-post">
                        <div class="buttonprevious" >PREVIOUS</div>
                        <div class="buttonnext" style="margin-left: 9px;">NEXT</div>
                    </div>';
                    }?>
                </div>
                <div class="userachievement">
                    <div class="subtitle left ">ACHIEVEMENTS</div>
                    <div class="clearfix"></div>
                    <!-- ACHIEVEMENT LIST -->
                    <?php 
                        if(!empty($user['ACHIEVEMENT'])){
                                echo '<ul>';
                                for($i=0;$i<count($user['ACHIEVEMENT']);$i++){
                                    echo '
                                    <li>
                                        <div class="achievement">
                                            <div class="ach_logo"><img src="'.BASE_URL.'img/achievements/'.$user['ACHIEVEMENT'][$i]['GAMBAR'].'" alt=""></div>
                                            <div class="ach_detail">
                                                <div class="ach_name">'.$user['ACHIEVEMENT'][$i]['NAMA'].'</div>
                                                <div class="ach_how">'.$user['ACHIEVEMENT'][$i]['DESKRIPSI'].'</div>
                                            </div>
                                        </div>
                                    </li>
                                        ';
                                }
                                echo '</ul>';
                        }
                    ?>
                </div>
            </div>
            <div class="detbot"></div>
        </div>
        <div style="height: 10px;"></div>

        <!-- EDIT DIV POP OUT -->
        <form method="post" action="<?php echo BASE_URL?>user_con/edit_user" enctype="multipart/form-data">
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
                        <input class="txtfield" id="email-input" type="text" value="<?php echo $user['EMAIL']?>" size="30" name="email" onkeyup="checkEditProfile('<?php echo BASE_URL?>')" />
                    </div>
                    <div class="clear"></div>
                    <div class="error" id="emailError"></div>
                </div>
                <div class="txtfieldbox width90">
                    <div class="left txtboxlabel">GENDER</div>
                    <div class="right">
                        <select class="txtfield" id="gender-input" name="gender" onchange="checkEditProfile('<?php echo BASE_URL?>')" style="width: 215px"><option <?php if($user['GENDER']=="none") echo 'selected="selected"'?> value="none">--Select--</option><option value="male" <?php if($user['GENDER']=="Male") echo 'selected="selected"'?>>Male</option><option <?php if($user['GENDER']=="Female") echo 'selected="selected"'?>value="female">Female</option></select>
                    </div>
                    <div class="clear"></div>
                    <div class="error" id="genderError"></div>
                </div>
                <div class="txtfieldbox width90">
                    <div class="left txtboxlabel">STATUS</div>
                    <div class="right">
                        <select class="txtfield" id="status-input" name="status" onchange="checkEditProfile('<?php echo BASE_URL?>')" style="width: 215px"><option <?php if($user['STATUS']=="none") echo 'selected="selected"'?> value="none">--Select--</option><option <?php if($user['STATUS']=="Single") echo 'selected="selected"'?> value="SINGLE">Forever Alone</option><option <?php if($user['STATUS']=="In Relationship") echo 'selected="selected"'?> value="IN RELATIONSHIP">In a Relationship</option><option <?php if($user['STATUS']=="Married") echo 'selected="selected"'?> value="MARRIED">Married</option></select>
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
                        <textarea rows="5" cols="24"  name="about"><?php echo $user['ABOUT_ME']?></textarea>
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