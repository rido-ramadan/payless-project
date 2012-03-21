
        <div class="detbox">
            <div class="dettop"></div>
            <div class="detmain" style="text-align: center">
                <div class="headertext">Register in GetRid!</div>
                <span style="color: red; font-size: 1em;">

                </span>
                <form id="registerForm" method="POST" action="<?php echo BASE_URL?>user_con/validate_register">
                    <div class="left sidesbox">
                        <div class="txtfieldbox" style="border-top: 0; padding-top: 0">
                            <div class="left txtboxlabel">USERNAME</div>
                            <div class="right">
                                <input class="txtfield" type="text" size="30" name="username" value="" onkeydown="ProcessUsername(this)" onkeyup="ProcessUsername(this)" />
                            </div>
                            <div class="clear"></div>
                            <div class="error" id="usernameError">Username must be at least 5 character.</div>
                        </div>
                        <div class="txtfieldbox">
                            <div class="left txtboxlabel">FULL NAME</div>
                            <div class="right">
                                <input class="txtfield" type="text" size="30" name="name" onkeydown="ProcessName(this)" onkeyup="ProcessName(this)" />
                            </div>
                            <div class="clear"></div>
                            <div class="error" id="nameError">Please include your last name.</div>
                        </div>
                        <div class="txtfieldbox">
                            <div class="left txtboxlabel">PASSWORD</div>
                            <div class="right">
                                <input class="txtfield" type="password" size="30" name="password" onkeydown="ProcessPassword(this)" onkeyup="ProcessPassword(this)" />
                            </div>
                            <div class="clear"></div>
                            <div class="error" id="passwordError">Password must be at least 8 character.</div>
                        </div>
                        <div class="txtfieldbox">
                            <div class="left txtboxlabel">CONFIRM PASSWORD</div>
                            <div class="right">
                                <input class="txtfield" type="password" size="30" name="confirm" onkeydown="ProcessCPassword(this)" onkeyup="ProcessCPassword(this)" />
                            </div>
                            <div class="clear"></div>
                            <div class="error" id="cpasswordError">The password is not match.</div>
                        </div>
                    </div>

                    <div class="right sidesbox" style="text-align: left">
                        <div class="txtfieldbox" style="border-top: 0; padding-top: 0">
                            <div class="left txtboxlabel">EMAIL</div>
                            <div class="right">
                                <input class="txtfield" type="text" size="30" name="email" onkeydown="ProcessEmail(this)" onkeyup="ProcessEmail(this)" />
                            </div>
                            <div class="clear"></div>
                            <div class="error" id="emailError">Wrong email format.</div>
                        </div>
                        <div class="txtfieldbox">
                            <div class="left txtboxlabel">BIRTH DATE</div>
                            <div class="right">
                                <input class="txtfield" type="text" size="30" name="birthdate" onkeydown="ProcessBirthdate(this)" onkeyup="ProcessBirthdate(this)" />
                            </div>
                            <div class="clear"></div>
                            <div class="error" id="birthError">Birth date must be written in YYYY-MM-DD.</div>
                        </div>
                        <div class="txtfieldbox">
                            <div class="left txtboxlabel">GENDER</div>
                            <div class="right">
                                <select class="txtfield" name="gender" onchange="ProcessGender(this)" style="width: 215px"><option value="none">- -Select- -</option><option value="male">Male</option><option value="female">Female</option></select>
                            </div>
                            <div class="clear"></div>
                            <div class="error" id="genderError">You must select a gender.</div>
                        </div>
                        <div class="txtfieldbox">
                            <div class="left txtboxlabel">AVATAR UPLOAD</div>
                            <div class="right">
                                <input class="txtfield" type="file" name="avatar" onchange="ProcessAvatar(this)" accept="image/jpg, image/jpeg"/>
                            </div>
                            <div class="clear"></div>
                            <div class="error" id="avatarError">Please upload jpeg image.</div>
                        </div>
                    </div>

                    <div class="clear" style="overflow: auto; padding-top: 15px; text-align: center">
                        <div class="txtboxlabel" style="text-align: center;">ABOUT ME</div>
                        <div><textarea rows="5" cols="106" name="about"></textarea></div>
                        <div class="termsagreements">We Get Rid of the Terms and Agreements in GetRid!</div>
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