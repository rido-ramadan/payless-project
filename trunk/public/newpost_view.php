<!DOCTYPE html>
<html lang="en">
    <head>
		<meta charset="utf-8" />
        <title>Payless Project &raquo; Upload Post</title>
        <script type="text/javascript" src="js/style.js"></script>
        <link type="text/css" rel="stylesheet" href="css/header1.css" />
    </head>
    <body>
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
        
        <div class="detbox">
            <div class="dettop"></div>
            <div class="detmain">
                <div class="headertext">Create a New Post!</div>
                <form name="newpostform" method="POST" action="preview.php">
                    <div class="row">
                        <label class="key">TITLE</label>
                        <input class="input" name="title" type="text" />
                    </div>

                    <div class="row" style="border-bottom: 0; padding-bottom: 0">
                        <label class="key">TYPE</label>
                        <div class="input" style="vertical-align:middle; border:0px;">
                            <input name="type" type="radio" value="Link" checked="checked" id="link" onclick="ShowLink()"/><label for="link">Link</label>
                            <input name="type" type="radio" value="Image" id="image" onclick="ShowImageFile()"/><label for="image">Image</label>
                            <input name="type" type="radio" value="Video" id="video" onclick="ShowVideo()"/><label for="video">Video</label>
                        </div>
                    </div>
                    <div class="separator"></div>
                    <div class="row" id="imagelink" style="border-bottom: 0; padding-bottom: 0">
                        <label class="key">IMAGE</label>
                        <input class="input" name="img" type="file" accept="image/*"/>
                    </div>

                    <div class="row" id="textlink">
                        <label class="key">LINK</label>
                        <input class="input" name="hyperlink" type="text"/>
                    </div>

                    <div class="row" id="linkdesc" style="padding-bottom: 0">
                        <label class="key" style="vertical-align:top">DESCRIPTION</label>
                        <textarea class="input" name="description" cols="40" rows="5"></textarea>
                    </div>

                    <div class="row" id="tagspost" style="border-bottom: 0; padding-bottom: 0">
                        <label class="key" style="vertical-align:top">TAGS</label>
                        <input class="input" name="tags" type="text" >
                    </div>

                    <div class="space"></div>
                    <span><a class="previewbutton" onclick="previewPost()">Preview</a></span>
                    <span><input class="postbutton" type="submit" name="post" value="Post"></span>
                </form>
                <div class="space"></div>
            </div>
            <div class="detbot"></div>
        </div>

        <div class="preview" id="preview"></div>
        
        <!-- ::::::::::::::::::::: START OF FOOTER PART ::::::::::::::::::::: -->
        <div class="footer">
            &copy; Payless Project 2012. Created by: <a href="http://masphei.ungu.com">Masphei</a>, <a href="http://personanonymous.wordpress.com">Edgar Drake</a>, <a href="http://marchygabe.tumblr.com">Marchy Gabe</a>
        </div>
        <!-- ::::::::::::::::::::: END OF FOOTER PART ::::::::::::::::::::: -->
        <script type="text/javascript" src="js/newpost.js"></script>
        <script type="text/javascript" src="js/styleBox.js"></script>
        <!--************************************************************-->
    </body>
</html>