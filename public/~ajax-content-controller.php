<?php
$newpage;

$method = $_GET["method"];
$page = $_GET["page"];
if ($method == 'next') {
    $page >= 2? $newpage = 2 : $newpage = ($page) + 1;
} else if ($method == 'prev') {
    $page <= 0? $newpage = 0 : $newpage = ($page) - 1;
} else if ($method == 'init') {
    $newpage = $page;
}

$cont[] = '<li>
            <div class="paketkonten linkpost">
                <div class="left iconcontent">
                    <div class="iconlink"></div>
                </div>
                <div class="headertext judul">
                    <div class="title"><a href="link.html">9GAG - Just For Fun</a></div>
                    <div class="uploader"><a href="user-profile_view.php">EdgarDrake</a></div>
                    <div class="uploaded">2 days ago</div>
                </div>
                <div class="content">
                    <a href="http://www.9gag.com"> www.9gag.com </a>
                    <p> deskripsinya link ini </p>
                </div>
                <div class="paketjempol">
                    <div class="likemini"></div>
                    <div class="jumlahlike"></div>
                    <div class="commentmini"></div>
                    <div class="jumlahkomen"></div>
                    <br/>
                    <div class="likebutton" onclick="voteplus(this.num)"><a></a></div>
                    <div class="dislikebutton" onclick="votemin(this.num)"><a></a></div>
                    <div class="tags">
                        Tags : <br/>
                        <ul class="tag">
                            <li>9gag</li>
                            <li>funny</li>
                            <li>rage comics</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div id="pagenum" class="hidden">'.$newpage.'</div>
        </li>';

$cont[] = '<li>
            <div class="paketkonten imagepost">
                <div class=" left iconcontent">
                    <div class="iconphoto"></div>
                </div>
                <div class="headertext judul">
                    <div class="title"><a href="link.html">Sunny Beach</a></div>
                    <div class="uploader"><a href="user-profile_view.php">EdgarDrake</a></div>
                    <div class="uploaded">3 days ago</div>
                </div>
                <div class="content">
                    <img src="img/pemandangan.jpg" width="320" alt="beach">
                </div>
                <div class="paketjempol">
                    <div class="likemini"></div>
                    <div class="jumlahlike"></div>
                    <div class="commentmini"></div>
                    <div class="jumlahkomen"></div>
                    <br/>
                    <div class="likebutton" onclick="voteplus(this.num)"><a></a></div>
                    <div class="dislikebutton" onclick="votemin(this.num)"><a></a></div>
                    <div class="tags">
                        Tags : <br/>
                        <ul class="tag">
                            <li>9gag</li>
                            <li>funny</li>
                            <li>rage comics</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div id="pagenum" class="hidden">'.$newpage.'</div>
        </li>';

$cont[] = '<li>
            <div class="paketkonten videopost">
                <div class=" left iconcontent">
                    <div class="iconvideo"></div>
                </div>
                <div class="headertext judul">
                    <div class="title"><a href="link.html">Video Clip</a></div>
                    <div class="uploader"><a href="user-profile_view.php">EdgarDrake</a></div>
                    <div class="uploaded">3 days ago</div>
                </div>
                <div class="content">
                    <iframe width="320" height="240" src="http://www.youtube.com/embed/MGtLGuSaVOI" frameborder="0" allowfullscreen></iframe>
                </div>
                <div class="paketjempol">
                    <div class="likemini"></div>
                    <div class="jumlahlike"></div>
                    <div class="commentmini"></div>
                    <div class="jumlahkomen"></div>
                    <br/>
                    <div class="likebutton" onclick="voteplus(this.num)"><a></a></div>
                    <div class="dislikebutton" onclick="votemin(this.num)"><a></a></div>
                    <div class="tags">
                        Tags : <br/>
                        <ul class="tag">
                            <li>9gag</li>
                            <li>funny</li>
                            <li>rage comics</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div id="pagenum" class="hidden">'.$newpage.'</div>
        </li>';

echo $cont[$newpage];