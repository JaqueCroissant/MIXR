<?php
require "../ajax_includes.php";

switch(isset($_GET['do']) ? $_GET['do'] : null) {
    case 'discover':
        if($musicHandler->discover($loginHandler->user_session(), isset($_POST['mood']) ? $_POST['mood'] : null, isset($_POST['genres']) ? $_POST['genres'] : null)) {
            $_SESSION['current_song'] = $musicHandler->song;
            $jsonArray = $musicHandler->convert_song_to_array($musicHandler->song);
            $jsonArray['status'] = true;
        } else {
            $jsonArray['status'] = false;
            $jsonArray['error'] = $musicHandler->_error->ErrorMessage;
        }
        break;
    
    case 'discover_by_artist':
        if($musicHandler->discover_by_artist($loginHandler->user_session(), isset($_POST['artist_id']) ? $_POST['artist_id'] : null)) {
            $_SESSION['current_song'] = $musicHandler->song;
            $jsonArray = $musicHandler->convert_song_to_array($musicHandler->song);
            $jsonArray['status'] = true;
        } else {
            $jsonArray['status'] = false;
            $jsonArray['error'] = $musicHandler->_error->ErrorMessage;
        }
        break;
        
    case 'play_by_id':
        if($musicHandler->play_by_id(isset($_POST['song_id']) ? $_POST['song_id'] : null)) {
            $_SESSION['current_song'] = $musicHandler->song;
            $jsonArray = $musicHandler->convert_song_to_array($musicHandler->song);
            $jsonArray['status'] = true;
        } else {
            $jsonArray['status'] = false;
            $jsonArray['error'] = $musicHandler->_error->ErrorMessage;
        }
        break;
        
    case 'add':
        if($musicHandler->add_to_list($loginHandler->user_session(), isset($_POST['song_id']) ? $_POST['song_id'] : null)) {
            $jsonArray['status'] = true;
        } else {
            $jsonArray['status'] = false;
            $jsonArray['error'] = $musicHandler->_error->ErrorMessage;
        }
        break;
        
    case 'remove':
        if($musicHandler->remove_from_list($loginHandler->user_session(), isset($_POST['song_id']) ? $_POST['song_id'] : null)) {
            $jsonArray['status'] = true;
        } else {
            $jsonArray['status'] = false;
            $jsonArray['error'] = $musicHandler->_error->ErrorMessage;
        }
        break;
    
    default:
        if($musicHandler->play_from_list($loginHandler->user_session(), isset($_POST['mood']) ? $_POST['mood'] : null, isset($_POST['genres']) ? $_POST['genres'] : null)) {
            $_SESSION['current_song'] = $musicHandler->song;
            $jsonArray = $musicHandler->convert_song_to_array($musicHandler->song);
            $jsonArray['status'] = true;
        } else {
            $jsonArray['status'] = false;
            $jsonArray['error'] = $musicHandler->_error->ErrorMessage;
        }
        break;
}
echo json_encode($jsonArray);
?>
