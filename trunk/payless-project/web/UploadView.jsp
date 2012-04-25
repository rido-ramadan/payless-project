<jsp:useBean id="bean" class="Model.Model" scope="session"/>
<div class="detbox">
    <div class="dettop"></div>
    <div class="detmain">
        <div class="headertext">Create a New Post!</div>
        <form name="newpostform" method="POST" enctype="multipart/form-data" action="/UploadPage?uploading=true">
            <div class="row">
                <label class="key">TITLE</label>
                <input class="input" name="title" <% if(bean.display.get("empty")!=null && ((String)bean.display.get("empty")).equals("title")) out.print("style=\"background: orangered\""); %> <% if(bean.display.get("post_title")!=null) out.print(" value=\""+(String)bean.display.get("post_title")+"\""); %> type="text" />
            </div>

            <div class="row" style="border-bottom: 0; padding-bottom: 0">
                <label class="key">TYPE</label>

                <div class="input" style="vertical-align:middle; border:0px;">
                    <input name="type" type="radio" value="Link" <% if(bean.display.get("radio_click")!=null && ((String)bean.display.get("radio_click")).equals("Link")) out.print("checked=\"checked\""); else if(bean.display.get("radio_click")==null) out.print("checked=\"checked\"");%> id="link" onclick="ShowLink()"/><label for="link">Link</label>
                    <input name="type" type="radio" value="Image" <% if(bean.display.get("radio_click")!=null && ((String)bean.display.get("radio_click")).equals("Image")) out.print("checked=\"checked\"");%> id="image" onclick="ShowImageFile()"/><label for="image">Image</label>
                    <input name="type" type="radio" value="Video" <% if(bean.display.get("radio_click")!=null && ((String)bean.display.get("radio_click")).equals("Video")) out.print("checked=\"checked\"");%> id="video" onclick="ShowVideo()"/><label for="video">Video</label>
                </div>
            </div>
            <div class="separator"></div>
            <div class="row" id="imagelink" style="border-bottom: 0; padding-bottom: 0">
                <label class="key">IMAGE</label>
                <input name="picture" <% if(bean.display.get("empty")!=null && ((String)bean.display.get("empty")).equals("image")) out.print("style=\"background: orangered\""); %> type="file" />
                <!--<input class="input" name="img" type="file" accept="image/*"/>-->
            </div>

            <div class="row" id="textlink">
                <label class="key">LINK</label>
                <input class="input" name="link-input" <% if(bean.display.get("empty")!=null && (((String)bean.display.get("empty")).equals("link") || ((String)bean.display.get("empty")).equals("video"))) out.print("style=\"background: orangered\""); %> <% if(bean.display.get("post_video")!=null) out.print("value=\" "+bean.display.get("post_video")+"\""); %><% if(bean.display.get("post_link")!=null) out.print(" value=\""+bean.display.get("post_link")+"\""); %>  type="text"/>
            </div>

                    <div class="row" id="linkdesc" style="padding-bottom: 0">
                <label class="key" style="vertical-align:top">DESCRIPTION</label>
                <textarea class="input" name="description"  <% if(bean.display.get("empty")!=null && ((String)bean.display.get("empty")).equals("description")) out.print(" style=\"background: orangered\""); %> cols="40" rows="5"></textarea>
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
<script type="text/javascript" src="/js/newpost.js"></script>
<%
    String radio_click=(String) bean.display.get("radio_click");
    if(radio_click!=null){
        if(radio_click.equals("Link"))
            out.print("<script type=\"text/javascript\">ShowLink()</script>");
       else if(radio_click.equals("Image"))
           out.print("<script type=\"text/javascript\">ShowImageFile()</script>");
       else if(radio_click.equals("Video"))
           out.print("<script type=\"text/javascript\">ShowVideo()</script>");
    }
%>

