<div class="detbox">
    <div class="dettop"></div>
    <div class="detmain">
        <div class="headertext">Create a New Post!</div>
        <form name="newpostform" method="POST" enctype="multipart/form-data" action="<?php echo BASE_URL.'content_con/submit_post'?>">
            <div class="row">
                <label class="key">TITLE</label>
                <input class="input" name="title" <?php if(!empty($empty) && $empty=="title") echo 'style="background: orangered"' ?> <?php if(!empty($post_title)) echo ' value='.$post_title ?> type="text" />
            </div>

            <div class="row" style="border-bottom: 0; padding-bottom: 0">
                <label class="key">TYPE</label>

                <div class="input" style="vertical-align:middle; border:0px;">
                    <input name="type" type="radio" value="Link" <?php if(!empty($radio_click) && $radio_click=='Link') echo 'checked="checked"'; else if(empty($radio_click)) echo 'checked="checked"';?> id="link" onclick="ShowLink()"/><label for="link">Link</label>
                    <input name="type" type="radio" value="Image" <?php if(!empty($radio_click) && $radio_click=='Image') echo 'checked="checked"'?> id="image" onclick="ShowImageFile()"/><label for="image">Image</label>
                    <input name="type" type="radio" value="Video" <?php if(!empty($radio_click) && $radio_click=='Video') echo 'checked="checked"'?> id="video" onclick="ShowVideo()"/><label for="video">Video</label>
                </div>
            </div>
            <div class="separator"></div>
            <div class="row" id="imagelink" style="border-bottom: 0; padding-bottom: 0">
                <label class="key">IMAGE</label>
				Image : <input name="picture" <?php if(!empty($empty) && $empty=="image") echo 'style="background: orangered"' ?> type="file" />
                <!--<input class="input" name="img" type="file" accept="image/*"/>-->
            </div>

            <div class="row" id="textlink">
                <label class="key">LINK</label>
                <input class="input" name="link" <?php if(!empty($empty) && ($empty=="link" || $empty=='video')) echo 'style="background: orangered"' ?> <?php if(!empty($post_video)) echo ' value='.$post_video ?><?php if(!empty($post_link)) echo ' value='.$post_link ?>  type="text"/>
            </div>

                    <div class="row" id="linkdesc" style="padding-bottom: 0">
                <label class="key" style="vertical-align:top">DESCRIPTION</label>
                <textarea class="input" name="description"  <?php if(!empty($empty) && $empty=="description") echo 'style="background: orangered"' ?> cols="40" rows="5"></textarea>
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
<script type="text/javascript" src="<?php echo BASE_URL?>js/newpost.js"></script>
<?php
if(!empty($radio_click)){
    if($radio_click=="Link") echo '<script type="text/javascript">ShowLink()</script>';
    else if($radio_click=="Image") echo '<script type="text/javascript">ShowImageFile()</script>';
    else if($radio_click=="Video") echo '<script type="text/javascript">ShowVideo()</script>';
}
?>

