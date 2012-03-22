<head>
    <meta charset="utf-8" />
    <title>Payless Project &raquo; My Profile</title>
    <script type="text/javascript" src="js/style.js"></script>
    <link rel="stylesheet" type="text/css" href="css/header1.css" id="header">
</head>
<!-- ::::::::::::::::::::: START OF HEADER PART ::::::::::::::::::::: -->
<div class="topbox">
    <div class="nav1">
        <div style="display:inline-block"><a id="logoButton" href="index.php"><img src="img/logo.png" alt="logo" /></a></div>
        <div class="right">
            <a class="topbutton login" id="loginButton" alt="Log In" onclick="showPopup();"></a>
            <a class="topbutton signup" href="register_view.php" id="myacctButton" title="Sign Up"></a>
        </div>
    </div>
    <div class="nav2">
        It's a Project without a Payment!
        <div class="right themes">
            <select name="Tags" onchange="ChangeStyle(this.value)">
                <option value="1">Select Tags</option>
                <option value="2">Funny</option>
                <option value="3">Cool</option>
                <option value="4">Disgusting</option>
            </select>
        </div>
    </div>
    <div class="nav3">
        <div id="sort5" class="left"><a href="index.php">Home</a></div>
        <div class="left"><img src="img/divide.png" alt="" /></div>
        <div id="sort2" class="left nav3act"><a href="contents_view.php">Contents</a></div>
        <div class="left"><img src="img/divide.png" alt="" /></div>
        <div id="sort1" class="left"><a href="newpost_view.php">Upload Post</a></div>
        <div class="right">
            <div id="applesearch">
                <span class="sbox_l"></span>
                <span class="sbox">
                    <input style="outline-width:0px;" type="text" id="srch_fld" placeholder="Search" autosave="applestyle_srch" results="5" onkeyup="applesearch.onChange('srch_fld','srch_clear')" />
                </span>
                <span class="sbox_r" id="srch_clear"></span>
            </div>
        </div>
        <div class="right filter">
            <select name="srch_op" onchange="ChangeStyle(this.value)">
                <option value="filter-none">No Filter</option>
                <option value="filter-user">Username</option>
                <option value="filter-cont">Content</option>
            </select>
        </div>
    </div>
</div>
<div id="overlay" onclick="closeAll()"></div>
<div id="popup" class="popup">
    <div class="loginpopout">
        <div class="topbutton">
            <span class="lbox_l"></span>
            <span class="lbox">
                <input type="text" id="username" placeholder="Username" autosave="applestyle_srch" results="5" onkeyup="applesearch.onChange('srch_fld','srch_clear')" />
            </span>
            <span class="lbox_r" id="srch_clear"></span>
        </div>
        <div class="topbutton clear">
            <span class="lbox_l"></span>
            <span class="lbox">
                <input type="password" id="passwd" placeholder="Password" autosave="applestyle_srch" results="5" onkeyup="applesearch.onChange('srch_fld','srch_clear')" />
            </span>
            <span class="lbox_r" id="srch_clear"></span>
        </div>
        <span><a class="closelogin" onclick="closePopUp()"></a></span>
        <span><input type="submit" class="loginbutton login" id="loginButton" alt="Log In" value="Log In"></span>
        <!--span><a class="loginbutton login" id="loginButton" alt="Log In"></a></span-->
    </div>
</div>
<script type="text/javascript" src="js/divPop.js"></script>
<!-- ::::::::::::::::::::: END OF HEADER PART ::::::::::::::::::::: -->