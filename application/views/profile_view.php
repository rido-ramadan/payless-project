        <!-- ::::::::::::::::::::: START OF BODY PART ::::::::::::::::::::: -->
        <div class="detbox">
            <div class="dettop"></div>
            <div class="detmain">
                <?php if(!empty($user)){?>
                <div class="userheader"><?php echo $user['USERNAME']?>'s Profile</div>
                <div class="useravatar">
                    <?php 
                        if(!empty($user['AVATAR'])) 
                            echo '
                                <img src="'.$user['AVATAR'].'" alt="EdgarDrake">
                                ';
                        else
                            echo '
                                <img src="'.BASE_URL.'img/avatar.jpg" alt="EdgarDrake">
                                ';
                    ?>
                </div>
                <div class="userdata">
                    <div class="subtitle left ">USER INFORMATION</div>
                    <div class="edituser left clearfix" onclick="editProfile()">EDIT</div>
                    <div class="lhs left">FULL NAME</div>
                    <div class="rhs left clearfix"><?php echo $user['NAMA']?></div>
                    <div class="lhs left">E-MAIL</div>
                    <div class="rhs left clearfix"><?php echo $user['EMAIL']?></div>
                    <div class="lhs left">GENDER</div>
                    <div class="rhs left clearfix"><?php echo $user['GENDER']?></div>
                    <div class="lhs left">STATUS</div>
                    <div class="rhs left clearfix"><?php echo $user['STATUS']?></div>
                    <div class="lhs left">BIRTHDATE</div>
                    <div class="rhs left clearfix"><?php echo $user['TGL_LAHIR']?></div>
                    <div class="lhs left">ABOUT ME</div>
                    <div class="rhs left clearfix">
                        <?php echo $user['ABOUT_ME']?>
                    </div>
                    <div class="lhs left"># COMMENTS</div>
                    <div class="rhs left clearfix"><?php echo $user['KOMENTAR']?></div>
                    <div class="lhs left"># UPLOADS</div>
                    <div class="rhs left clearfix"><?php echo $user['POST']?></div>
                    <div class="lhs left">POST LIST</div>
                    <div class="rhs left clearfix">
                        <?php if(!empty($user['KONTEN'])){
                                echo '<ul>';
                                for($i=0;$i<count($user['KONTEN']);$i++){
                                    echo '
                                    <li><a href="'.BASE_URL.'content_con/content/'.$user['KONTEN'][$i]['ID_KONTEN'].'">'.$user['KONTEN'][$i]['JUDUL'].'</a></li>
                                        ';
                                }
                                echo '</ul>';
                                
                            }
                            
                        ?>
                    </div>
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
                                            <div class="ach_logo"></div>
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
            <?php }?>
            </div>
            <div class="detbot"></div>
        </div>
        <div style="height: 10px;"></div>

        <!-- EDIT DIV POP OUT -->
        <div class="edituserdata" id="edituserdata">
            <div class="edittop"></div>
            <div class="editmain">
                <div class="subtitle" style="margin: 0 20px;">EDIT PROFILE DATA</div>
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
                <div class="txtfieldbox width90">
                    <div class="left txtboxlabel">GENDER</div>
                    <div class="right">
                        <select class="txtfield" name="gender" onchange="ProcessGender(this)" style="width: 215px"><option value="none">--Select--</option><option value="male">Male</option><option value="female">Female</option></select>
                    </div>
                    <div class="clear"></div>
                    <div class="error" id="genderError">You must select a gender.</div>
                </div>
                <div class="txtfieldbox width90">
                    <div class="left txtboxlabel">STATUS</div>
                    <div class="right">
                        <select class="txtfield" name="status" onchange="ProcessGender(this)" style="width: 215px"><option value="none">--Select--</option><option value="single">Forever Alone</option><option value="relation">In a Relationship</option></select>
                    </div>
                    <div class="clear"></div>
                    <div class="error" id="genderError">Please choose your status</div>
                </div>
                <div class="txtfieldbox width90">
                    <div class="left txtboxlabel">AVATAR UPLOAD</div>
                    <div class="right">
                        <input class="txtfield" type="file" name="avatar" onchange="ProcessAvatar(this)" accept="image/jpg, image/jpeg"/>
                    </div>
                    <div class="clear"></div>
                    <div class="error" id="avatarError">Please upload jpeg image.</div>
                </div>
                <div class="txtfieldbox width90">
                    <div class="left txtboxlabel">ABOUT ME</div>
                    <div class="right">
                        <textarea rows="5" cols="24" name="about"></textarea>
                    </div>
                    <div class="clear"></div>
                    <div class="error" id="avatarError">Please upload jpeg image.</div>
                </div>
                <div class="txtfieldbox width90">
                    <div class="right">
                        <input class="joinbutton" type="submit" name="edit" value="Edit my Account!" />
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="editbot"></div>
        </div>
        <!---------------------->

        <!-- ::::::::::::::::::::: END OF BODY PART ::::::::::::::::::::: -->