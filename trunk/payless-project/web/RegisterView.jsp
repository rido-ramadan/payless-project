<%-- 
    Document   : register
    Created on : Apr 18, 2012, 12:30:56 PM
    Author     : Marchy Panggabean
--%>
<jsp:useBean id="bean" class="Model.Model" scope="session"/>
<%@page contentType="text/html" pageEncoding="UTF-8" %>
<%@page import="java.util.*"%>
<%@page import = "Model.userData"%>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Registration</title>
    </head>
    <body>
        <%
            String username = (String)bean.display.get("username")==null?"":(String)bean.display.get("username");
            String name = (String)bean.display.get("name")==null?"":(String)bean.display.get("name");
            String password = (String)bean.display.get("password")==null?"":(String)bean.display.get("password");
            String confirm = (String)bean.display.get("confirm")==null?"":(String)bean.display.get("confirm");
            String birthdate = (String)bean.display.get("birthdate")==null?"":(String)bean.display.get("birthdate");
            String email = (String)bean.display.get("email")==null?"":(String)bean.display.get("email");
            String gender = (String)bean.display.get("gender")==null?"":(String)bean.display.get("gender");
            String status = (String)bean.display.get("status")==null?"":(String)bean.display.get("status");
            String about = (String)bean.display.get("about")==null?"":(String)bean.display.get("about");
            String error_username = (String)bean.display.get("error_username")==null?"":(String)bean.display.get("error_username");
            String error_nama = (String)bean.display.get("error_nama")==null?"":(String)bean.display.get("error_nama");
            String error_password = (String)bean.display.get("error_password")==null?"":(String)bean.display.get("error_password");
            String error_confirm = (String)bean.display.get("error_confirm")==null?"":(String)bean.display.get("error_confirm");
            String error_email = (String)bean.display.get("error_email")==null?"":(String)bean.display.get("error_email");
            String error_tanggal = (String)bean.display.get("error_tanggal")==null?"":(String)bean.display.get("error_tanggal");
            String error_gender = (String)bean.display.get("error_gender")==null?"":(String)bean.display.get("error_gender");
            String error_status = (String)bean.display.get("error_status")==null?"":(String)bean.display.get("error_status");
            String error_avatar = (String)bean.display.get("error_avatar")==null?"":(String)bean.display.get("error_avatar");
        %>
           <div class="detbox">
            <div class="dettop"></div>
            <div class="detmain" style="text-align: center">
                <div class="headertext">Register in GetRid!</div>
                <span style="color: red; font-size: 1em;">

                </span>
                <form id="registerForm" method="POST" enctype="multipart/form-data" action="/RegisterProcess?isregister">
                    <div class="left sidesbox">
                        <div class="txtfieldbox" style="border-top: 0; padding-top: 0">
                            <div class="left txtboxlabel">USERNAME</div>
                            <div class="right">
                                <input class="txtfield" id="username-input" type="text" size="30" name="username" value="<% out.print(username); %>" onkeyup="checkAvailabilityUsername('<?php echo BASE_URL?>')" />
                            </div>
                            <div class="clear"></div>
                            <div class="error" id="usernameError"><% if(!(error_username.isEmpty())) out.println(error_username);%></div>
                        </div>
                        <div class="txtfieldbox">
                            <div class="left txtboxlabel">FULL NAME</div>
                            <div class="right">
                                <input class="txtfield" type="text" size="30" name="name" onkeydown="ProcessName(this)" value="<%out.print(name);%>" onkeyup="ProcessName(this)" />
                            </div>
                            <div class="clear"></div>
                            <div class="error" id="nameError"><% if(!(error_nama.isEmpty())) out.println(error_nama);%></div>
                        </div>
                        <div class="txtfieldbox">
                            <div class="left txtboxlabel">PASSWORD</div>
                            <div class="right">
                                <input class="txtfield" type="password" size="30" name="password" onkeydown="ProcessPassword(this)" value="<%out.print(password);%>" onkeyup="ProcessPassword(this)" />
                            </div>
                            <div class="clear"></div>
                            <div class="error" id="passwordError"><% if(!(error_password.isEmpty())) out.println(error_password);%></div>
                        </div>
                        <div class="txtfieldbox">
                            <div class="left txtboxlabel">CONFIRM PASSWORD</div>
                            <div class="right">
                                <input class="txtfield" type="password" size="30" name="confirm" onkeydown="ProcessCPassword(this)" value="<%out.print(confirm);%>" onkeyup="ProcessCPassword(this)" />
                            </div>
                            <div class="clear"></div>
                            <div class="error" id="cpasswordError"><% if(!(error_confirm.isEmpty())) out.println (error_confirm);%></div>
                        </div>
                    </div>

                    <div class="right sidesbox" style="text-align: left">
                        <div class="txtfieldbox" style="border-top: 0; padding-top: 0">
                            <div class="left txtboxlabel">EMAIL</div>
                            <div class="right">
                                <input class="txtfield" id="email-input" type="text" size="30" name="email" value="<%out.print(email);%>" onkeyup="checkAvailabilityEmail('<?php echo BASE_URL?>')" />
                            </div>
                            <div class="clear"></div>
                            <div class="error" id="emailError"><% if(!(error_email.isEmpty())) out.println(error_email);%></div>
                        </div>
                        <div class="txtfieldbox">
                            <div class="left txtboxlabel">BIRTH DATE (YYYY-MM-DD)</div>
                            <div class="right">
                                <input class="txtfield" type="text" size="30" name="birthdate" onkeydown="ProcessBirthdate(this)" value="<%out.print(birthdate);%>" onkeyup="ProcessBirthdate(this)" />
                            </div>
                            <div class="clear"></div>
                            <div class="error" id="birthError"><% if(!(error_tanggal.isEmpty())) out.println(error_tanggal);%></div>
                        </div>
                        <div class="txtfieldbox">
                            <div class="left txtboxlabel">GENDER</div>
                            <div class="right">
                                <select class="txtfield" name="gender" onchange="ProcessGender(this)" style="width: 215px">
                                    <option <% if(!(error_gender.isEmpty())) out.println("selected=\"selected\"");%> value="none">- -Select- -</option>
                                    <option <% if(gender.equals("male")) out.println("selected=\"selected\"");%> value="male">Male</option>
                                    <option <% if(gender.equals("female")) out.println("selected=\"selected\"");%> value="female">Female</option></select>
                            </div>
                            <div class="clear"></div>
                            <div class="error" id="genderError"><% if(!(error_gender.isEmpty())) out.println(error_gender);%></div>
                        </div>
                        <div class="txtfieldbox">
                            <div class="left txtboxlabel">STATUS</div>
                            <div class="right">
                                <select class="txtfield" name="status" onchange="ProcessGender(this)" style="width: 215px">
                                    <option <% if(!(error_status.isEmpty())) out.println("selected=\"selected\"");%> value="none">--Select--</option >
                                    <option <% if(status.equals("single")) out.println("selected=\"selected\"");%> value="single">Forever Alone</option>
                                    <option <% if(status.equals("relation")) out.println("selected=\"selected\"");%> value="relation">In a Relationship</option>
                                    <option <% if(status.equals("married")) out.println("selected=\"selected\"");%> value="married">Married</option></select>
                            </div>
                            <div class="clear"></div>
                            <div class="error" id="genderError"><% if(!(error_status.isEmpty())) out.println(error_status);%></div>
                        </div>
                        <div class="txtfieldbox">
                            <div class="left txtboxlabel">AVATAR UPLOAD</div>
                            <div class="right">
                                <input class="txtfield" type="file" name="avatar" onchange="ProcessAvatar(this)" accept="image/jpg, image/jpeg"/>
                                <!--<input class="txtfield" value="1" type="file" name="isregister" style="display: none"/>-->
                            </div>
                            <div class="clear"></div>
                            <div class="error" id="avatarError"><% if(!(error_avatar.isEmpty())) out.println(error_avatar);%></div>
                        </div>
                    </div>

                    <div class="clear" style="overflow: auto; padding-top: 15px; text-align: center">
                        <div class="txtboxlabel" style="text-align: center;">ABOUT ME</div>
                        <div><textarea rows="5" cols="106" name="about"><% if(!(about.isEmpty())) out.println(about);%></textarea></div>
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
        <script type="text/javascript" src="js/styleBox.js"></script>
    </body>
</html>
