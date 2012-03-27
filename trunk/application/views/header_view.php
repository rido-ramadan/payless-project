<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Payless Project &raquo; Homepage</title>
        <script type="text/javascript" src="<?php echo BASE_URL?>js/style.js"></script>
        <!--<script type="text/javascript" src="<?php echo BASE_URL?>js/navigasi.js"></script>-->
        <link type="text/css" rel="stylesheet" href="<?php echo BASE_URL?>css/header1.css" />
    </head>
    <body onload="randomlike(); randomkomen(); inisialisasi()">
        <!-- ::::::::::::::::::::: START OF HEADER PART ::::::::::::::::::::: -->
        
        <!-- ::::::::::::::::::::: START OF HEADER PART ::::::::::::::::::::: -->
<div class="topbox">
    <div class="nav1">
        <div style="display:inline-block"><a id="logoButton" href="index.php"><img src="<?php echo BASE_URL?>img/logo.png" alt="logo" /></a></div>
        <div class="right">
            <?php 
                if(isset($_SESSION['login'])){
                    echo '
                    <a class="topbutton myaccount" href="'.BASE_URL.'user_con/profile/'.($_SESSION['id']).'" id="myacctButton" title="Sign Up"></a>
                    <a class="topbutton signout" id="loginButton" alt="Log In" href="'.BASE_URL.'user_con/logout"></a>
                        ';
                }
                else{
                    echo '
                    <a class="topbutton login" id="loginButton" alt="Log In" onclick="showPopup();"></a>
                    <a class="topbutton signup" href="'.BASE_URL.'user_con/register" id="myacctButton" title="Sign Up"></a>
                        ';
                }
            ?>
        </div>
    </div>
    <script type="text/javascript">
    function call(url){
        var tag=document.getElementById("Tags");
        var sort=document.getElementById("Sorting");
        //document.location.href=url+'/'+term.value;
        document.location.href=url+tag.value+"/"+sort;
    }
    </script>

    <div class="nav2">
        It's a Project without a Payment!
        <div class="right themes"><?php if(!empty($_SESSION['nama'])) echo 'Hello, <a href="'.BASE_URL.'user_con/profile/'.$_SESSION['id'].'">'.$_SESSION['nama'].'</a>';?>
                <form action="<?php echo BASE_URL?>content_con/submit_tag" method="post">
                    <select id="Sorting" name="Sorting">
                        <option value="-1">Newest</option>
                        <option <?php if(!empty($current_sort) && $current_sort==1) echo 'selected="selected"'?> value="1">Most Popular</option>
                        <option <?php if(!empty($current_sort) && $current_sort==2) echo 'selected="selected"'?> value="2">Most Commented</option>
                    </select>
                    <input type="text" name="input_tag" />
                    <input type="submit" value="submit"/>
                </form>
			<?php 
			
			if(!empty($list_tag)) {
				echo '
				<select id="Tags" name="Tags" onChange="call(\''.BASE_URL.'content_con/list_content/\')">
				<option value="-1">Select Tags</option>
				';
				for($i=0;$i<count($list_tag);$i++){
					echo '
						<option ';
                                        if(!empty($current_tag) && $list_tag[$i]['ID_TAG']==$current_tag) echo 'selected="selected" ';
                                        echo 'value="'.($list_tag[$i]['ID_TAG']).'">'.$list_tag[$i]['NAMA_TAG'].'</option>
					';
				}
				echo '
				</select>
				
			';
			}
			?>
        </div>
    </div>
    <div class="nav3">
        <div id="sort5" class="left"><a href="<?php echo BASE_URL?>">Home</a></div>
        <div class="left"><img src="<?php echo BASE_URL?>img/divide.png" alt="" /></div>
        <div id="sort2" class="left nav3act"><a href="<?php echo BASE_URL?>content_con/list_content">Contents</a></div>
        <div class="left"><img src="<?php echo BASE_URL?>img//divide.png" alt="" /></div>
        <div id="sort1" class="left"><a href="<?php echo BASE_URL?>content_con/post">Upload Post</a></div>
        <form action="<?php echo BASE_URL.'home_con/submit_search'?>" method="post" name="srch">
            <div class="right searchbutton">
                <input id="filtersearch" type="submit" name="search" value="Search"/>
            </div>
            <div class="right">
                <div id="applesearch">
                    <span class="sbox_l"></span>
                    <span class="sbox">
                        <input name="search" style="outline-width:0px;" type="text" id="srch_fld" placeholder="Search" autosave="applestyle_srch" results="5" onkeyup="applesearch.onChange('srch_fld','srch_clear')" />
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
        </form>
    </div>
</div>
<div id="overlay" onclick="closeAll()"></div>
<div id="popup" class="popup">
    <div class="loginpopout">
        <form action="<?php echo BASE_URL ?>user_con/validate_login" method="post">
        <div class="topbutton">
            <span class="lbox_l"></span>
            <span class="lbox">
                <input type="text" name="username" id="username" placeholder="Username" autosave="applestyle_srch" results="5" onkeyup="applesearch.onChange('srch_fld','srch_clear')" />
            </span>
            <span class="lbox_r" id="srch_clear"></span>
        </div>
        <div class="topbutton clear">
            <span class="lbox_l"></span>
            <span class="lbox">
                <input type="password" name="password" id="passwd" placeholder="Password" autosave="applestyle_srch" results="5" onkeyup="applesearch.onChange('srch_fld','srch_clear')" />
            </span>
            <span class="lbox_r" id="srch_clear"></span>
        </div>
        <span><a class="closelogin" onclick="closePopUp()"></a></span>
        <span><input type="submit" class="loginbutton login" id="loginButton" value="Log In" /></span>
        </form>
    </div>
</div>
<script type="text/javascript" src="<?php echo BASE_URL?>js/divPop.js"></script>
<!-- ::::::::::::::::::::: END OF HEADER PART ::::::::::::::::::::: -->