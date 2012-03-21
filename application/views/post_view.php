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
                <input class="input" name="link" type="text"/>
            </div>

            <div class="row" id="linkdesc" style="border-bottom: 0; padding-bottom: 0">
                <label class="key" style="vertical-align:top">DESCRIPTION</label>
                <textarea class="input" name="description" cols="40" rows="5"></textarea>
            </div>

            <div class="space"></div>
            <!--
            <input class="postbutton" type="submit" name="post" value="Post"/>-->
        </form>
            <button class="postbutton" onclick="GoToPage()" value="Post">Post</button>
            <div class="space"></div>
    </div>
    <div class="detbot"></div>
</div>