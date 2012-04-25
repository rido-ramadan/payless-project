<%-- 
    Document   : header
    Created on : 21 Apr 12, 17:50:06
    Author     : Edgar Drake
--%>

<%@page import="Model.User"%>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Payless Project &raquo; Homepage</title>
        <link sizes="16x16" type="image/png" href="img/favicon.png" rel="icon">
        <script type="text/javascript" src="js/style.js"></script>
        <script type="text/javascript" src="js/peel.js"></script>
        <link type="text/css" rel="stylesheet" href="css/header1.css" />
    </head>
    <body onload="randomlike(); randomkomen(); inisialisasi();loadContent('init')" onclick="hideHint()">
        <!-- ::::::::::::::::::::: START OF HEADER PART ::::::::::::::::::::: -->
        <div class="topbox">
            <div class="nav1">
                <div style="display:inline-block"><a id="logoButton" href="Home"><img src="img/logo.png" alt="logo" /></a></div>
                <div class="right">
                    <%
                        User user = ((User) session.getAttribute("user"));
                        if (user != null) {
                            out.println("<a class='topbutton myaccount' href='/ProfilePage?user=" + user.getID_User() + "' id='myacctButton' title='Sign Up'></a>");
                            out.println("<a class='topbutton signout' id='loginButton' alt='Log Out' href='/Logout'></a>");
                        } else {
                            out.println("<a class='topbutton login' id='loginButton' alt='Log In' onclick='showPopup();'></a>");
                            out.println("<a class='topbutton signup' href='/RegisterPage' id='myacctButton' title='Sign Up'></a>");
                        }
                    %>
                </div>
            </div>
            <script type="text/javascript">
                function message(msg){
                    alert(msg);
                }
                function sort_content(url){
                    var sort=document.getElementById("Sorting");
                    //document.location.href=url+'/'+term.value;
                    //alert(sort.value);
                    <?php if (!empty($gate)) { ?>
                        document.location.href='<?php echo BASE_URL . 'content_con/sort_content/' . $gate . '/' . $current_tag . '/' ?>'+sort.value;
                    <?php } ?>
                    }
            </script>

            <div class="nav2">
                It's a Project without a Payment!
                <%
                    if (user != null) {
                        out.println("<div class='right mini-avatar'><a href='/ProfilePage?user=" + user.getID_User() + "'><img src='avatar/" + user.getAvatar() + "' width='36'  alt='" + user.getAvatar() + "'></a></div>");
                    }
                %>
                <div class="right themes">
                    <%
                        if (user != null) {
                            out.println("Hello, <a href='/ProfilePage?user=" + user.getID_User() + "'>" + user.getName() + "</a>");
                        } 
                    %>
                    <!--<form action="<?php echo BASE_URL ?>content_con/submit_tag" method="post">
                            <select  name="Sorting">
                                <option value="-1">Newest</option>
                                <option <?php if (!empty($current_sort) && $current_sort == 1) echo 'selected="selected"' ?> value="1">Most Popular</option>
                                <option <?php if (!empty($current_sort) && $current_sort == 2) echo 'selected="selected"' ?> value="2">Most Commented</option>
                            </select>
                            <input type="text" name="input_tag" />
                            <input type="submit" value="submit"/>
                        </form>
                                        <?php
                                        if (!empty($list_tag)) {
                                            echo '
                                                    <select id="Tags" name="Tags" onChange="call(\'' . BASE_URL . 'content_con/list_content/\')">
                                                    <option value="-1">Select Tags</option>
                                                    ';
                                            for ($i = 0; $i < count($list_tag); $i++) {
                                                echo '
                                                                    <option ';
                                                if (!empty($current_tag) && $list_tag[$i]['ID_TAG'] == $current_tag)
                                                    echo 'selected="selected" ';
                                                echo 'value="' . ($list_tag[$i]['ID_TAG']) . '">' . $list_tag[$i]['NAMA_TAG'] . '</option>
                                                            ';
                                            }
                                            echo '
                                                    </select>
                                                    
                                            ';
                                        }
                                        ?>-->
                </div>
            </div>
            <div class="nav3">
                <div id="sort5" class="left"><a href="/Home">Home</a></div>
                <div class="left"><img src="img/divide.png" alt="" /></div>
                <div id="sort2" class="left nav3act"><a href="/ListContentPage">Contents</a></div>
                <div class="left"><img src="img/divide.png" alt="" /></div>
                <%
                    if (user != null) {
                        out.println("<div id='sort1' class='left'><a href='/UploadPage'>Upload Post</a></div>");
                    }
                %>
                <form action="/SearchPage" method="post" name="srch">
                    <div class="right searchbutton">
                        <input id="filtersearch" type="submit" name="search_button" onclick="input_search()" value="Search"/>
                    </div>
                    <div class="right">
                        <div id="applesearch">
                            <span class="sbox_l"></span>
                            <span class="sbox">
                                <input style="outline-width:0px;" type="text" name="search_input" id="srch_fld_input" hidden />
                                <input style="outline-width:0px;" type="text" name="search_data" id="srch_fld" placeholder="Search" results="5" onkeyup="showHint('index.jsp', this.value)" autocomplete="off"/>
                            </span>
                            <span class="sbox_r" id="srch_clear"></span>
                        </div>
                    </div>
                    <div class="right filter">
                        <select name="srch_op" id="filter-method" onchange="ChangeStyle(this.value)">
                            <option value="filter-none">No Filter</option>
                            <option value="filter-user">Username</option>
                            <option value="filter-cont">Content</option>
                        </select>
                    </div>
                </form>
            </div>
        </div>
        <div id="overlay" onclick="closeAll()"></div>
        <div id="popup" class="popup">
            <div class="loginpopout">
                <form action="/Login" method="post">
                    <!--<form action="<?php echo BASE_URL ?>user_con/validate_login" method="post">-->
                    <div class="topbutton">
                        <span class="lbox_l"></span>
                        <span class="lbox">
                            <input type="text" name="username" id="username" placeholder="Username" autosave="applestyle_srch" results="5" onkeyup="validateUsername('index.jsp',this.value)" />
                        </span>
                        <span class="lbox_r" id="srch_clear"></span>
                        <span id="status-username"></span>
                    </div>
                    <div style="font-size:9px;" id="notif_user"></div>
                    <div class="topbutton clear">
                        <span class="lbox_l"></span>
                        <span class="lbox">
                            <input type="password" name="password" id="passwd" placeholder="Password" autosave="applestyle_srch" results="5" onkeyup="applesearch.onChange('srch_fld','srch_clear')" />
                        </span>
                        <span class="lbox_r" id="srch_clear"></span>
                        <span id="status-password"></span>
                    </div>
                    <div style="font-size:9px;" id="notif_login"></div>
                    <div id="login-notification"></div>
                    <div class="clear">
                        <span><a class="closelogin" onclick="closePopUp()"></a></span>
                        <!--span><input type="button" class="loginbutton login" id="loginButton" onclick="validateLogin('index.jsp')" value="Log In" /></span-->
                        <span><input type="submit" class="loginbutton login" id="loginButton" value="Log In" /></span>
                    </div>
                </form>
            </div>
        </div>
        <!-- :::::::: POP-UP SEARCH BAR ::::::: -->
        <div class="search-pop-up">
            <ul id="suggestion">
                <li></li>
            </ul>
        </div>
        <!-- :::::::::::::::::::::::::::::::::: -->
        <div class="ach_popup" id="ach_popup">
            <div class="ach_congrats">Congratulations!</div>
            <div class="ach_text">You have been awarded this achievement</div>
            <div class="achievement"></div>
            <div class="ach_close">
                <button value="CLOSE" onclick="closeAchievement()">CLOSE</button>
            </div>
        </div>
        <!-- ::::::::::::::::::::: ACHIEVEMENT LIST :::::::::::::::::::: -->
        <% if (user != null) {%>
        <div class="ach_list">
            <div class="ach_box">
                <div class="ach_congrats"><% out.println(user.getName()); %>'s Achievements</div>
                <div class="ach_scroll">
                    <!--?php
                    if (!empty($list_achievement)) {
                        for ($i = 0; $i < count($list_achievement); $i++) {
                            echo '
                            <div class="achievement">
                                <div class="ach_logo"><img src="' . BASE_URL . 'img/achievements/' . $list_achievement[$i]['GAMBAR'] . '" alt="" width="50"></div>
                                <div class="ach_detail">
                                    <div class="ach_name">' . $list_achievement[$i]['NAMA'] . '</div>
                                    <div class="ach_how">' . $list_achievement[$i]['DESKRIPSI'] . '</div>
                                </div>
                            </div>
                            ';
                        }
                    }
                    ?-->
                </div>
                <div class="ach_close">
                    <button value="CLOSE" onclick="slideUp()">CLOSE</button>
                </div>
            </div>
            <div class="ach_notif-center" onclick="slideDown()">ACHIEVEMENTS</div>
        </div>
        <% }%>
        <!-- ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: -->
        <!-- :::::::::::::::::::::::::: INBOX :::::::::::::::::::::::::: -->
        <% if (user != null) {%>
        <div id="inbox">
            <div class="mail">
                <div class="mail-list">
                    <div class="headertext inbox-title">INBOX</div>
                    <!--div class="messages">
                        <?php
                        if (!empty($message_box)) {
                        for ($i = 0; $i < count($message_box); $i++) {
                        echo '
                        <div class="message" onclick="getContentMessage(\'' . BASE_URL . '\',' . $message_box[$i]['ID_MESSAGE'] . ')">
                            <div class="message-sender">' . $message_box[$i]['NAMA'] . '</div>
                            <div class="message-time">' . $message_box[$i]['WAKTU'] . '</div>
                        </div>
                        ';
                        }
                        }
                        ?>
                    </div-->
                </div>
                <div class="mail-body" id="mail-body">
                    <?php if (!empty($message_box)) echo $message_box[0]['ISI'] ?>
                </div>
            </div>
            <div class="slide-inbox" onclick="showInbox()"></div>
        </div>
        <% }%>
        <!-- ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: -->
        <!-- ::::::::::::::::::::: COMPOSE MESSAGE ::::::::::::::::::::: -->
        <!--?php if (!empty($user['ID_USER'])) { ?-->
        <div class="compose">
            <form name="create-message" action="message.jsp" method="post">
                <div class="compose-logo"></div>
                <div class="compose-title clearfix">Compose New Message</div>
                <div class="compose-message">
                    <textarea rows="11" cols="59" name="private-message" id="compose_input" placeholder="Write your message here"></textarea>
                </div>
                <div class="send">
                    <input type="submit" name="send" value="">
                </div>
            </form>
        </div>
        <!--?php } ?-->
        <!-- ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: -->
        <script type="text/javascript" src="js/divPop.js"></script>
        <script type="text/javascript" src="js/ajax.js"></script>
        <script type="text/javascript">
            setInterval('checkAchievement("index.jsp");', 2000);
        </script>
        <!--?php
            if (!empty($achievement))
            echo '
        --><!--script type="text/javascript">showAchievement("' . $achievement['NAMA'] . '", "' . $achievement['DESKRIPSI'] . '", "' . BASE_URL . 'img/achievements/' . $achievement['GAMBAR'] . '")</script>'
        ?-->
        <!-- ::::::::::::::::::::: END OF HEADER PART ::::::::::::::::::::: -->
