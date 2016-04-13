<?php
if(isset($_POST['url']) && $_POST['url'] == true) {
    require "../include/ajax_includes.php";
    require "../include/ajax/header_includes.php";
}
?>
<script type='text/javascript'>
    $('.addremove_playlist_button').popover();
</script>
<?php


if (!$loginHandler->check_login()) {
    ErrorHandler::DisplayError(ErrorHandler::ReturnError("USER_MUST_BE_LOGGED_IN")->ErrorMessage, false);
    die();
} else {
    ErrorHandler::DisplayError();
}
ErrorHandler::DisplaySuccess();

$moods = $service->GetMoods(new GetMoods())->GetMoodsResult;
$genres = $service->GetGenres(new GetGenres())->GetGenresResult;

echo "
    <div id='player_container'>
        <div id='player_left_bar'>
            &nbsp;
            <form name='addremoveform' action='' method='post'>
                <input type='hidden' class='song_id' name='song_id' value='"; if(isset($_SESSION['current_song'])) { echo $_SESSION['current_song']->Id; } else { echo ""; } echo "'>
                <div class='addremove_playlist_button' style='margin-top:50px;' data-content='Add to playlist' rel='popover' data-placement='top' data-trigger='hover'>
                    <input type='button' id='add_playlist_image' class='addtolist' name='addtolist'>
                </div>
                <div class='addremove_playlist_button' style='margin-top:100px;' data-content='Remove from playlist' rel='popover' data-placement='top' data-trigger='hover'>
                    <input type='button' id='remove_playlist_image' class='removefromlist' name='removefromlist'>
                </div>
            </form>
            <div id='player_image'>
                <div id='player_image_box'>
                    <img id='artist_image' class='img-rounded' style='z-index:5;position:relative;top: 50%;transform: translateY(-50%);max-width:100%; max-height: 100%;' src='"; if(isset($_SESSION['current_song']) && $_SESSION['current_song']->Artist->ImageUrl != null && $_SESSION['current_song']->Artist->ImageUrl != "") { echo $_SESSION['current_song']->Artist->ImageUrl; } else { echo "images/no_artist_image.png"; } echo "'>
                </div>
            </div>
            
            <div id='player_description'>
                <table style='width:100%;margin-top:10px;'>
                <tr>
                    <td style='width:50%;vertical-align:top'><b>Song title:</b>
                        <div id='songname'>"; if(isset($_SESSION['current_song'])) { echo $_SESSION['current_song']->Name; } else { echo "No song to display"; } echo "</div>
                    </td>
                    <td style='width:50%;vertical-align:top;'><b>Artist:</b>
                        <div id='artist'>"; if(isset($_SESSION['current_song'])) { echo $_SESSION['current_song']->Artist->Name; } else { echo "No artist to display"; } echo "</div>
                    </td>
                </tr>
                <tr>
                    <td style='width:50%;vertical-align:top;padding-top:10px;'><b>Album:</b>
                        <div id='album'>"; if(isset($_SESSION['current_song'])) { echo $_SESSION['current_song']->Album->Name; } else { echo "No album to display"; } echo "</div>
                    </td>
                    <td></td>
                </tr>
                </table>
            </div>
        </div>
        
        <div id='player_right_bar'>
            <form name='discoverform' action='' method='post'>
            <div style='float:left;'>
                <div style='margin-left:3px;'>Mood:</div>
                <div class='btn-group-vertical' data-toggle='buttons'>";
                    foreach(getObjectsFromList($moods) as $value) {
                        echo "<label class='btn btn-info' style='width:100% !important;text-align:left !important;'>
                                <input type='radio' name='mood' value='".$value->Id."'";
                        if(isset($_POST['mood']) && $_POST['mood'] == $value->Id) {
                            echo "checked";
                        }
                        echo ">". $value->Name . "</label>";
                    }
                    echo "
                </div>
            </div>
            <div style='float:right;'>
                <div style='margin-left:3px;'>Genres:</div>
                <div class='btn-group-vertical' data-toggle='buttons'>";
                    foreach(getObjectsFromList($genres) as $value) {
                        echo "<label class='btn btn-info' style='width:100% !important;padding: 6px 11px !important;font-size:12px !important;text-align:left !important'>
                                <input type='checkbox' name='genres[]' value='".$value->Id."'";
                        if (isset($_POST['genres'])) {
                            if($_POST['genres'] == $value->Id) {
                                echo "checked";
                            }
                        }
                        echo ">". $value->Name . "</label>";
                    }
                    echo "
                </div>
            </div>
            <div style='clear:both;'></div>
            <div style='margin-top:70px;'>
                <input type='hidden' class='artist_id' name='artist_id' value='"; if(isset($_SESSION['current_song'])) { echo $_SESSION['current_song']->Artist->Id; } else { echo ""; } echo "'>
                <button type='button' class='playfromlist btn btn-primary' style='width:100% !important;text-align:left !important'><img class='button_icon' src='images/icons/playlist_color.png' /> Play from playlist</button>
                <button type='button' class='discover btn btn-primary' style='width:100% !important; margin-top:9px;text-align:left !important'><img class='button_icon' src='images/icons/discover_big_color.png' /> Discover song</button>
                <button type='button' class='discover_by_artist btn btn-primary' style='width:100% !important; margin-top:9px;text-align:left !important'><img class='button_icon' src='images/icons/discover_artist_color.png' /> Discover from artist</button>
            </div>
            </div>
            </form>
        </div>
        <div style='clear:both;'></div>
    </div>
    </form>";
    
?>