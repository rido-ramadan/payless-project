
        <div class="detbox">
            <div class="dettop"></div>
            <div class="detmain" style="text-align: center">
                <div class="headertext">Register in GetRid!</div>
                <span style="color: red; font-size: 1em;">

                </span>
                <form id="registerForm" method="POST" enctype="multipart/form-data" action="<?php echo BASE_URL?>user_con/validate_register">
                    <div class="left sidesbox">
                        <div class="txtfieldbox" style="border-top: 0; padding-top: 0">
                            <div class="left txtboxlabel">USERNAME</div>
                            <div class="right">
                                <input class="txtfield" id="username-input" type="text" size="30" name="username" value="<?php if(!empty($username)) echo $username?>" onkeyup="checkAvailabilityUsername('<?php echo BASE_URL?>')" />
                            </div>
                            <div class="clear"></div>
                            <div class="error" id="usernameError"><?php if(!empty($error_username)) echo $error_username?></div>
                        </div>
                        <div class="txtfieldbox">
                            <div class="left txtboxlabel">FULL NAME</div>
                            <div class="right">
                                <input class="txtfield" type="text" size="30" name="name" onkeydown="ProcessName(this)" value="<?php if(!empty($nama)) echo $nama?>" onkeyup="ProcessName(this)" />
                            </div>
                            <div class="clear"></div>
                            <div class="error" id="nameError"><?php if(!empty($error_nama)) echo $error_nama?></div>
                        </div>
                        <div class="txtfieldbox">
                            <div class="left txtboxlabel">PASSWORD</div>
                            <div class="right">
                                <input class="txtfield" type="password" size="30" name="password" onkeydown="ProcessPassword(this)" value="<?php if(!empty($password)) echo $password?>" onkeyup="ProcessPassword(this)" />
                            </div>
                            <div class="clear"></div>
                            <div class="error" id="passwordError"><?php if(!empty($error_password)) echo $error_password?></div>
                        </div>
                        <div class="txtfieldbox">
                            <div class="left txtboxlabel">CONFIRM PASSWORD</div>
                            <div class="right">
                                <input class="txtfield" type="password" size="30" name="confirm" onkeydown="ProcessCPassword(this)" value="<?php if(!empty($confirm)) echo $confirm?>" onkeyup="ProcessCPassword(this)" />
                            </div>
                            <div class="clear"></div>
                            <div class="error" id="cpasswordError"><?php if(!empty($error_confirm)) echo $error_confirm?></div>
                        </div>
                    </div>

                    <div class="right sidesbox" style="text-align: left">
                        <div class="txtfieldbox" style="border-top: 0; padding-top: 0">
                            <div class="left txtboxlabel">EMAIL</div>
                            <div class="right">
                                <input class="txtfield" id="email-input" type="text" size="30" name="email" value="<?php if(!empty($email)) echo $email?>" onkeyup="checkAvailabilityEmail('<?php echo BASE_URL?>')" />
                            </div>
                            <div class="clear"></div>
                            <div class="error" id="emailError"><?php if(!empty($error_email)) echo $error_email?></div>
                        </div>
                        <div class="txtfieldbox">
                            <div class="left txtboxlabel">BIRTH DATE</div>
                            <div class="right">
                                <input class="txtfield" type="text" size="30" name="birthdate" onkeydown="ProcessBirthdate(this)" value="<?php if(!empty($birthdate)) echo $birthdate?>" onkeyup="ProcessBirthdate(this)" />
                            </div>
                            <div class="clear"></div>
                            <div class="error" id="birthError"><?php if(!empty($error_tanggal)) echo $error_tanggal?></div>
                        </div>
                        <div class="txtfieldbox">
                            <div class="left txtboxlabel">GENDER</div>
                            <div class="right">
                                <select class="txtfield" name="gender" onchange="ProcessGender(this)" style="width: 215px">
                                    <option <?php if(!empty($error_gender)) echo 'selected="selected"'?> value="none">- -Select- -</option>
                                    <option <?php if(isset($male)) echo 'selected="selected"'?> value="male">Male</option>
                                    <option <?php if(isset($female)) echo 'selected="selected"'?> value="female">Female</option></select>
                            </div>
                            <div class="clear"></div>
                            <div class="error" id="genderError"><?php if(!empty($error_gender)) echo $error_gender?></div>
                        </div>
                        <div class="txtfieldbox">
                            <div class="left txtboxlabel">STATUS</div>
                            <div class="right">
                                <select class="txtfield" name="status" onchange="ProcessGender(this)" style="width: 215px">
                                    <option <?php if(!empty($error_status)) echo 'selected="selected"'?> value="none">--Select--</option >
                                    <option <?php if(isset($single)) echo 'selected="selected"'?> value="single">Forever Alone</option>
                                    <option <?php if(isset($relation)) echo 'selected="selected"'?> value="relation">In a Relationship</option>
                                    <option <?php if(isset($married)) echo 'selected="selected"'?> value="married">Married</option></select>
                            </div>
                            <div class="clear"></div>
                            <div class="error" id="genderError"><?php if(!empty($error_status)) echo $error_status?></div>
                        </div>
                        <div class="txtfieldbox">
                            <div class="left txtboxlabel">AVATAR UPLOAD</div>
                            <div class="right">
                                <input class="txtfield" type="file" name="avatar" onchange="ProcessAvatar(this)" accept="image/jpg, image/jpeg"/>
                            </div>
                            <div class="clear"></div>
                            <div class="error" id="avatarError"><?php if(!empty($error_avatar)) echo $error_avatar?></div>
                        </div>
                    </div>

                    <div class="clear" style="overflow: auto; padding-top: 15px; text-align: center">
                        <div class="txtboxlabel" style="text-align: center;">ABOUT ME</div>
                        <div><textarea rows="5" cols="106" name="about"><?php if(!empty($about)) echo $about?></textarea></div>
                        <div class="termsagreements">Why would you agree to the terms and agreements while we got no payment?</div>
                        <input class="joinbutton" type="submit" name="signup" value="Create my Account!" />
                        <!--<ul class="reasonlist">
                            <li>As a registered user, you can upload your own posts!</li>
                        </ul>-->
                    </div>
                </form>
            </div>
            <div class="detbot"></div>
        </div>
        <div style="height: 10px;"></div>
        <script type="text/javascript" src="<?php echo BASE_URL?>js/styleBox.js"></script>