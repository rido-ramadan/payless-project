        <!-- ::::::::::::::::::::: START OF BODY PART ::::::::::::::::::::: -->
        <div class="detbox">
            <div class="dettop"></div>
            <div class="detmain" style="text-align: center">
                <div class="headertext" style="text-align: center;">Error!</div>
                <div class="error404">
                <?php
                    if(!empty($error_message)){
                        echo $error_message;
                    }
                ?>
                </div>
            </div>
            <div class="detbot"></div>
        </div>
        <!-- ::::::::::::::::::::: END OF BODY PART ::::::::::::::::::::: -->