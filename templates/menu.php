<?php
    echo "<div id='menu_bar'>";
    if($loginHandler->check_login()) {
        echo "<a class='change_page' page='front' href='#'><button type='button' class='btn btn-primary'><img class='button_icon' src='images/icons/home_color.png' /> Home</button></a>
            <a class='change_page' page='player' href='#'><button type='button' class='btn btn-primary'><img class='button_icon' src='images/icons/player_color.png' /> Music player</button></a>
            <a class='change_page' page='playlist' href='#'><button type='button' class='btn btn-primary'><img class='button_icon' src='images/icons/playlist_color.png' /> Playlist</button></a>
            <a class='change_page' page='howto' href='#'><button type='button' class='btn btn-primary'><img class='button_icon' src='images/icons/howto_color.png' /> How to</button></a>
            <a href='?page=login&do=logout'><button type='button' class='btn btn-primary' style='float:right;margin-right:0px;'><img class='button_icon' src='images/icons/logout_color.png' /> Log out</button></a>
            <div class='dropdown' style='float:right'>
                <button type='button' class='btn btn-primary dropdown-toggle' style='float:right' id='settingsDropDown' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true'><img class='button_icon' src='images/icons/settings_color.png' /> Settings <span class='caret'></span></button>
                <ul class='dropdown-menu' aria-labelledby='settingsDropDown'>
                    <li><a class='change_page' page='preferences' subpage='preferences' href='#'><img class='button_icon' src='images/icons/user_color.png' /> Preferences</a></li>
                    <li role='separator' class='divider'></li>
                    <li><a class='change_page' page='preferences' subpage='password' href='#'><img class='button_icon' src='images/icons/password_color.png' /> Change password</a></li>
                </ul>
            </div>";
    } else {
        echo "<a href='?page=front'><button type='button' class='btn btn-primary' style='float:left;'><img class='button_icon' src='images/icons/home_color.png' /> Home</button></a>"
            . "<a href='?page=howto'><button type='button' class='btn btn-primary' style='float:left;'><img class='button_icon' src='images/icons/howto_color.png' /> How to</button></a>"
            . "<a href='?page=login'><button type='button' class='btn btn-primary' style='float:right;margin-right:0px;'><img class='button_icon' src='images/icons/login_color.png' /> Login</button></a>"
            . "<a href='?page=create_user'><button type='button' class='btn btn-primary' style='float:right;'><img class='button_icon' src='images/icons/user_color.png' /> Create user</button></a>";
    }
            
    echo "</div>";
?>
