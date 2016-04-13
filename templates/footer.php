<?php
echo "<div id='bottom_container'>
        <a href='#'>Home</a>
        <a href='#'>Music player</a>
        <a href='#'>Playlist</a>
    </div>";

if ($loginHandler->check_login()) {
    echo "<div id='cloud_player'>
            <div id='player'> 

                <audio id='audio' src=''></audio>  
                <div id='progressbar'></div>
                <div id='player_bottom'>
                    <div id='stop_button'></div>
                    <div id='playpause_button'></div>
                    <div id='player_time'>00:00</div>
                    <div id='volume'></div>
                    <div id='volume_button'></div>
                    <div style='clear: both;'></div>
                </div>


            </div>
        </div>";
}
?>