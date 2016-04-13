<script type='text/javascript'>
    $(function () {
        $("#playlisttable").tablesorter({sortList: [[0, 0], [0, 0], [0, 0]]});
    });
</script>
<?php
require "../../include/ajax_includes.php";
require "../../include/ajax/header_includes.php";

if (!$loginHandler->check_login()) {
    ErrorHandler::DisplayError(ErrorHandler::ReturnError("USER_MUST_BE_LOGGED_IN")->ErrorMessage, false);
    die();
} else {
    ErrorHandler::DisplayError();
}
ErrorHandler::DisplaySuccess();

if(isset($_REQUEST['artist_id']) && $_REQUEST['artist_id'] > 0) {
    if (!$musicHandler->get_artist_songs($_REQUEST['artist_id'])) {
        echo $musicHandler->_error->ErrorMessage;
    } else {
        $result = $musicHandler->artist_songs;
   
        echo "<form name='playlistform' action='' method='post'>"
                . "<button type='button' class='btn btn-default back_to_user_playlist' style='margin-bottom:10px;'><img class='button_small_icon' src='images/icons/back_color.png' />Back to your playlist</button>"
                . "<table id='playlisttable' class='tablesorter'>
                    <thead><tr>
                    <th >Song:</th>
                    <th class='header'>Artist:</th>
                    <th class='header'>Album</th>
                    </tr></thead>
                    <tbody>";
            if(isset($result->Song) && is_array($result->Song)) {
                foreach(getObjectsFromList($result) as $value) {
                    echo "<tr songid='".$value->Id."'>";
                    echo "<td>".$value->Name."</td>"
                        . "<td>".$value->Artist->Name."</td>"
                        . "<td>".$value->Album->Name."</td>"
                        . "<td class='custom_padding_right'><button type='button' class='btn btn-default play_by_id' name='play_by_id' songid='".$value->Id."'><img class='button_small_icon' src='images/icons/play_color.png' />Play</button></td>"
                            . "<td class='custom_padding_right'><button type='button' class='btn btn-default addtolist' name='addtolist' songid='".$value->Id."'><img class='button_small_icon' src='images/icons/add_color.png' />Add to playlist</button></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr songid='".$result->Song->Id."'>";
                    echo "<td>".$result->Song->Name."</td>"
                        . "<td>".$result->Song->Artist->Name."</td>"
                        . "<td>".$result->Song->Album->Name."</td>"
                        . "<td class='custom_padding_right'><button type='button' class='btn btn-default play_by_id' name='play_by_id' songid='".$result->Song->Id."'><img class='button_small_icon' src='images/icons/play_color.png' />Play</button></td>"
                            . "<td class='custom_padding_right'><button type='button' class='btn btn-default addtolist' name='addtolist' songid='".$result->Song->Id."' ><img class='button_small_icon' src='images/icons/add_color.png' />Add to playlist</button></td>";
                    echo "</tr>";
            }
            echo "</tbody></table></form>";
    }
} else {
    if (!$musicHandler->get_playlist($loginHandler->user_session())) {
        ErrorHandler::DisplayWarning($musicHandler->_error->ErrorMessage, false);
    } else {
        ErrorHandler::DisplayWarning();
        $result = $musicHandler->playlist;

        echo "<form name='playlistform' action='' method='post'>"
                . "<table id='playlisttable' class='tablesorter'>
                    <thead><tr>
                    <th >Song:</th>
                    <th class='header'>Artist:</th>
                    <th class='header'>Album</th>
                    </tr></thead>
                    <tbody>";
            if(isset($result->Song) && is_array($result->Song)) {
                foreach(getObjectsFromList($result) as $value) {
                    echo "<tr songid='".$value->Id."'>";
                    echo "<td>".$value->Name."</td>"
                        . "<td>".$value->Artist->Name."</td>"
                        . "<td>".$value->Album->Name."</td>"
                        . "<td class='custom_padding_right'><button type='button' class='btn btn-default play_by_id' name='play_by_id' songid='".$value->Id."'><img class='button_small_icon' src='images/icons/play_color.png' />Play</button></td>"
                        . "<td class='custom_padding_right'><button type='button' class='btn btn-default get_artist_songs' name='get_artist_songs' songid='".$value->Id."' artistid='".$value->ArtistId."'><img class='button_small_icon' src='images/icons/discover_color.png' />Discover artist</button></td>"
                            . "<td class='custom_padding_right'><button type='button' class='btn btn-default removefromlist' name='removefromlist' songid='".$value->Id."'><img class='button_small_icon' src='images/icons/remove_color.png' />Remove from playlist</button></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr songid='".$result->Song->Id."'>";
                    echo "<td>".$result->Song->Name."</td>"
                        . "<td>".$result->Song->Artist->Name."</td>"
                        . "<td>".$result->Song->Album->Name."</td>"
                        . "<td class='custom_padding_right'><button type='button' class='btn btn-default play_by_id' name='play_by_id' songid='".$result->Song->Id."'><img class='button_small_icon' src='images/icons/play_color.png' />Play</button></td>"
                        . "<td class='custom_padding_right'><button type='button' class='btn btn-default get_artist_songs' name='get_artist_songs' songid='".$result->Song->Id."' artistid='".$result->Song->ArtistId."'><img class='button_small_icon' src='images/icons/discover_color.png' />Discover artist</td>"
                            . "<td class='custom_padding_right'><button type='button' class='btn btn-default removefromlist' name='removefromlist' songid='".$result->Song->Id."'><img class='button_small_icon' src='images/icons/remove_color.png' />Remove from playlist</button></td>";
                    echo "</tr>";
            }
            echo "</tbody></table></form>";
    }
}
?>