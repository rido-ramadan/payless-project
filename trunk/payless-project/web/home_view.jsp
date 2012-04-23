<!-- ::::::::::::::::::::: START OF BODY PART ::::::::::::::::::::: -->
<div class="pagebar">
    <div class="notification">
        MOST POPULAR CONTENTS
    </div>
</div>


<%
if (!empty($content_most_like)) {
    out.println('<div class="detbox" style="padding-left:51px;">');
    for (int i = 0; i < 3; i++) {
        if (!empty($content_most_like[i])) {
            out.println('<div class="top-post" id="commented-' + (i + 1) + '">');
            if ($content_most_like[$i]['ID_TYPE'] == 1)
                out.println('<div class="top-link">');
            else if ($content_most_like[$i]['ID_TYPE'] == 2)
                out.println('<div class="top-image">');
            else if ($content_most_like[$i]['ID_TYPE'] == 3)
                out.println('<div class="top-video">');

            out.println('<div class="contenttitle"><a href="' + BASE_URL + 'content_con/content/' + $content_most_like[$i]['ID_KONTEN'] . '">' . $content_most_like[$i]['JUDUL'] . '</a></div>
                  <div style="font: 11px/13px arial;font-weight:bold;margin-left:30px;margin-top:4px;" class="uploaded" id="timea' . $content_most_like[$i]['ID_KONTEN'] . '"></div>
                  <script type="text/javascript">setInterval(');
            out.println("'timerContent");
            echo '("' . BASE_URL . '","timea",' . $content_most_like[$i]['ID_KONTEN'] . ',"' . $content_most_like[$i]['WAKTU'] . '");';
            echo "'";
            echo ',250)</script><div class="view">';
            if ($content_most_like[$i]['ID_TYPE'] == 1) {
                echo '<div class="view-link-url"><a href="' . $content_most_like[$i]['LINK'] . '">' . $content_most_like[$i]['LINK'] . '</a></div>
                      <div class="view-link-desc">' . $content_most_like[$i]['DESKRIPSI'] . '</div>
                                                        ';
            } else if ($content_most_like[$i]['ID_TYPE'] == 2) {
                echo '<div class="view-image">
                      <img src="' . BASE_URL . 'image/' . $content_most_like[$i]['LINK'] . '" width="260" alt="' . $content_most_like[$i]['JUDUL'] . '">
                      </div>';
            } else if ($content_most_like[$i]['ID_TYPE'] == 3) {
                echo '<div class="view-video">
                      <div class="view"><iframe width="240" height="180" src="' . $content_most_like[$i]['LINK'] . '" ></iframe></div>
                      </div>';
            }

            echo '</div>
                  <div class="basic-features">
                      <div class="paketjempol">
                           <div class="likemini"></div>
                           <div class="jumlahlike" id="like' . $content_most_like[$i]['ID_KONTEN'] . '"></div>
                           <div class="commentmini"></div>
                           <div class="jumlahkomen" id="comment' . $content_most_like[$i]['ID_KONTEN'] . '"></div>
                           <br/>';
            if (!empty($_SESSION['login'])) {
                if (!empty($content_most_like[$i]['STATUS_USER'])) {
                    echo $content_most_like[$i]['STATUS_USER'] == "LIKE" ?
                            '<div class="likebutton_pressed" id="likebutton' . $content_most_like[$i]['ID_KONTEN'] . '"><a onclick="unlike(\'' . BASE_URL . '\',' . $content_most_like[$i]['ID_KONTEN'] . ')"></a></div>
                             <div class="dislikebutton" id="dislikebutton' . $content_most_like[$i]['ID_KONTEN'] . '"><a onclick="undislike(\'' . BASE_URL . '\',' . $content_most_like[$i]['ID_KONTEN'] . ')"></a></div>' :
                            '<div class="likebutton" id="likebutton' . $content_most_like[$i]['ID_KONTEN'] . '"><a onclick="like(\'' . BASE_URL . '\',' . $content_most_like[$i]['ID_KONTEN'] . ')"></a></div>
                             <div class="dislikebutton_pressed" id="dislikebutton' . $content_most_like[$i]['ID_KONTEN'] . '"><a onclick="undislike(\'' . BASE_URL . '\',' . $content_most_like[$i]['ID_KONTEN'] . ')"></a></div>';
                } else {
                    echo
                    '<div class="likebutton" id="likebutton' . $content_most_like[$i]['ID_KONTEN'] . '"><a onclick="like(\'' . BASE_URL . '\',' . $content_most_like[$i]['ID_KONTEN'] . ')"></a></div>
                     <div class="dislikebutton" id="dislikebutton' . $content_most_like[$i]['ID_KONTEN'] . '"><a onclick="dislike(\'' . BASE_URL . '\',' . $content_most_like[$i]['ID_KONTEN'] . ')"></a></div>';
                }
            } else {
                echo '<div class="likebutton" id="likebutton' . $content_most_like[$i]['ID_KONTEN'] . '"><a href="#"></a></div>
                      <div class="dislikebutton" id="dislikebutton' . $content_most_like[$i]['ID_KONTEN'] . '"><a href="#"></a></div>';
            }
            echo '</div></div></div></div>';
        }
    }
    echo '</div>';
}
%>
<div class="pagebar" style="margin-top: 20px;">
    <div class="notification">
        MOST COMMENTED CONTENTS
    </div>
</div>


<?php
if (!empty($content_most_comment)) {
    echo '<div class="detbox" style="padding-left:51px;">';
    for ($i = 0; $i < 3; $i++) {
        if (!empty($content_most_comment[$i])) {
            echo '<div class="top-post" id="popular-' . ($i + 1) . '">';
            if ($content_most_comment[$i]['ID_TYPE'] == 1)
                echo '<div class="top-link">';
            else if ($content_most_comment[$i]['ID_TYPE'] == 2)
                echo '<div class="top-image">';
            else if ($content_most_comment[$i]['ID_TYPE'] == 3)
                echo '<div class="top-video">';

            echo
            '<div class="contenttitle"><a href="' . BASE_URL . 'content_con/content/' . $content_most_comment[$i]['ID_KONTEN'] . '">' . $content_most_comment[$i]['JUDUL'] . '</a></div>
             <div style="font: 11px/13px arial;font-weight:bold;margin-left:30px;margin-top:4px;" class="uploaded" id="time' . $content_most_comment[$i]['ID_KONTEN'] . '"></div>
             <script type="text/javascript">setInterval(';
            echo "'timerContent";
            echo '("' . BASE_URL . '","time",' . $content_most_comment[$i]['ID_KONTEN'] . ',"' . $content_most_comment[$i]['WAKTU'] . '");';
            echo "'";
            echo ',250)</script><div class="view">';

            if ($content_most_comment[$i]['ID_TYPE'] == 1) {
                echo '<div class="view-link-url"><a href="' . $content_most_comment[$i]['LINK'] . '">' . $content_most_comment[$i]['LINK'] . '</a></div>
                      <div class="view-link-desc">' . $content_most_comment[$i]['DESKRIPSI'] . '</div>
                                                            ';
            } else if ($content_most_comment[$i]['ID_TYPE'] == 2) {
                echo '<div class="view-image">
                      <img src="' . BASE_URL . 'image/' . $content_most_comment[$i]['LINK'] . '" width="260" alt="' . $content_most_comment[$i]['JUDUL'] . '">
                      </div>';
            } else if ($content_most_comment[$i]['ID_TYPE'] == 3) {
                echo '<div class="view-video">
                      <div class="view"><iframe width="240" height="180" src="' . $content_most_comment[$i]['LINK'] . '" ></iframe></div>
                      </div>';
            }
            echo '</div>
                    <div class="basic-features">
                        <div class="paketjempol">
                            <div class="likemini"></div>
                            <div class="jumlahlike" id="like' . $content_most_comment[$i]['ID_KONTEN'] . '"></div>
                            <div class="commentmini"></div>
                            <div class="jumlahkomen" id="comment' . $content_most_comment[$i]['ID_KONTEN'] . '"></div>
                            <br/>';

            if (!empty($_SESSION['login'])) {
                if (!empty($content_most_comment[$i]['STATUS_USER'])) {
                    echo $content_most_comment[$i]['STATUS_USER'] == "LIKE" ?
                            '<div class="likebutton_pressed" id="likebutton' . $content_most_comment[$i]['ID_KONTEN'] . '"><a onclick="unlike(\'' . BASE_URL . '\',' . $content_most_comment[$i]['ID_KONTEN'] . ')"></a></div>
                             <div class="dislikebutton" id="dislikebutton' . $content_most_comment[$i]['ID_KONTEN'] . '"><a onclick="undislike(\'' . BASE_URL . '\',' . $content_most_comment[$i]['ID_KONTEN'] . ')"></a></div>' :
                            '<div class="likebutton" id="likebutton' . $content_most_comment[$i]['ID_KONTEN'] . '"><a onclick="like(\'' . BASE_URL . '\',' . $content_most_comment[$i]['ID_KONTEN'] . ')"></a></div><div class="dislikebutton_pressed" id="dislikebutton' . $content_most_comment[$i]['ID_KONTEN'] . '"><a onclick="undislike(\'' . BASE_URL . '\',' . $content_most_comment[$i]['ID_KONTEN'] . ')"></a></div>';
                } else {
                    echo
                    '<div class="likebutton" id="likebutton' . $content_most_comment[$i]['ID_KONTEN'] . '"><a onclick="like(\'' . BASE_URL . '\',' . $content_most_comment[$i]['ID_KONTEN'] . ')"></a></div>
                     <div class="dislikebutton" id="dislikebutton' . $content_most_comment[$i]['ID_KONTEN'] . '"><a onclick="dislike(\'' . BASE_URL . '\',' . $content_most_comment[$i]['ID_KONTEN'] . ')"></a></div>';
                }
            } else {
                echo '<div class="likebutton" id="likebutton' . $content_most_comment[$i]['ID_KONTEN'] . '"><a href="#"></a></div>
                      <div class="dislikebutton" id="dislikebutton' . $content_most_comment[$i]['ID_KONTEN'] . '"><a href="#"></a></div>';
            }
            echo '</div></div></div></div>';
        }
    }
    echo '</div>';
}
?>