<?php
class MusicHandler 
{
    private $_service;
    private $_user;
    private $_overwritten_genres;
    public $song;
    public $playlist;
    public $artist_songs;
    
    private $_access;
    private $_ws_error;
    public $_error;
    
    
    public function __construct($service) 
    {
        $this->_service = $service;
	$this->_errors	= array();
    }
    
    public function get_playlist($user) {
        $this->_access = false;
        $this->_user = $user;
        $this->prepare_get_playlist();
        return $this->_access;
    }
    
    public function get_artist_songs($artistId) {
        $this->_access = false;
        $this->prepare_get_artist_songs($artistId);
        return $this->_access;
    }
    
    public function remove_from_list($user, $songId) {
        $this->_access = false;
        $this->_user = $user;
        $this->prepare_remove_from_list($user, $songId);
        return $this->_access;
    }
    
    public function add_to_list($user, $songId) {
        $this->_access = false;
        $this->_user = $user;
        $this->prepare_add_to_list($user, $songId);
        return $this->_access;
    }
    
    public function play_by_id($songId) {
        $this->_access = false;
        $this->prepare_play_by_id($songId);
        return $this->_access;
    }
    
    public function play_from_list($user, $mood, $genres = null) {
        $this->_access = false;
        $this->_user = $user;
        $this->prepare_play_from_list($user, $mood, $genres);
        return $this->_access;
    }
    
    public function discover($user, $mood, $genres = null) {
        $this->_access = false;
        $this->_user = $user;
        $this->prepare_discover($user, $mood, $genres);
        return $this->_access;
    }
    
    public function discover_by_artist($user, $artistId) {
        $this->_access = false;
        $this->_user = $user;
        $this->prepare_discover_by_artist($user, $artistId);
        return $this->_access;
    }
    
    private function prepare_get_playlist() {
        try 
	{
            if(!isset($this->_user->Id)) {
                throw new Exception ("USER_MUST_BE_LOGGED_IN");
            }
            
            $getPlayList = new GetPlaylistSongs();
            $getPlayList->user = $this->_user;
            $playlistResult = $this->_service->GetPlaylistSongs($getPlayList)->GetPlaylistSongsResult;
            
            if(empty($playlistResult) || $playlistResult == null) {
                $this->_ws_error = $this->_service->ReturnError(new ReturnError())->ReturnErrorResult;
		throw new Exception ("WS_ERROR");
	    }
            
            $this->set_playlist($playlistResult);
            $this->_access = true;
	}
	catch (Exception $ex) 
	{
            if($ex->getMessage() == "WS_ERROR") {
                $this->_error = $this->_ws_error;
            } else {
                $this->_error = ErrorHandler::ReturnError($ex->getMessage());
            }
	}
    }
    
    private function prepare_get_artist_songs($artistId) {
        try 
	{
            if(empty($artistId)) {
		throw new Exception ("EMPTY_FORM");
	    }
            
            $getArtistSongs = new GetArtistSongs();
            $getArtistSongs->artistId = $artistId;
            $artistResult = $this->_service->GetArtistSongs($getArtistSongs)->GetArtistSongsResult;
            
            if(empty($artistResult) || $artistResult == null) {
                $this->_ws_error = $this->_service->ReturnError(new ReturnError())->ReturnErrorResult;
		throw new Exception ("WS_ERROR");
	    }
            
            $this->set_artist_songs($artistResult);
            $this->_access = true;
	}
	catch (Exception $ex) 
	{
            if($ex->getMessage() == "WS_ERROR") {
                $this->_error = $this->_ws_error;
            } else {
                $this->_error = ErrorHandler::ReturnError($ex->getMessage());
            }
	}
    }
    
    private function prepare_remove_from_list($user, $songId) {
        try 
	{
	    if(empty($songId)) {
		throw new Exception ("EMPTY_FORM");
	    }
            
            if(!isset($this->_user->Id)) {
                throw new Exception ("USER_MUST_BE_LOGGED_IN");
            }
            
            $removeFromPlaylist = new RemovefromPlaylist();
            $removeFromPlaylist->user = $this->_user;
            $removeFromPlaylist->songId = $songId;
            
            if(!$this->_service->RemovefromPlaylist($removeFromPlaylist)->RemovefromPlaylistResult) {
                $this->_ws_error = $this->_service->ReturnError(new ReturnError())->ReturnErrorResult;
		throw new Exception ("WS_ERROR");
	    }
            
            $this->_access = true;
	}
	catch (Exception $ex) 
	{
            if($ex->getMessage() == "WS_ERROR") {
                $this->_error = $this->_ws_error;
            } else {
                $this->_error = ErrorHandler::ReturnError($ex->getMessage());
            }
	}
    }
    
    private function prepare_add_to_list($user, $songId) {
        try 
	{
	    if(empty($songId)) {
		throw new Exception ("EMPTY_FORM");
	    }
            
            if(!isset($this->_user->Id)) {
                throw new Exception ("USER_MUST_BE_LOGGED_IN");
            }
            
            $addToPlayList = new AddtoPlaylist();
            $addToPlayList->user = $this->_user;
            $addToPlayList->songId = $songId;
            
            if(!$this->_service->AddtoPlaylist($addToPlayList)->AddtoPlaylistResult) {
                $this->_ws_error = $this->_service->ReturnError(new ReturnError())->ReturnErrorResult;
		throw new Exception ("WS_ERROR");
	    }
            
            $this->_access = true;
	}
	catch (Exception $ex) 
	{
            if($ex->getMessage() == "WS_ERROR") {
                $this->_error = $this->_ws_error;
            } else {
                $this->_error = ErrorHandler::ReturnError($ex->getMessage());
            }
	}
    }

    private function prepare_play_by_id($songId) {
        try 
	{
	    if(empty($songId)) {
		throw new Exception ("EMPTY_FORM");
	    }
            
            $getById = new GetSongById();
            $getById->id = $songId;
            
            $songResult = $this->_service->GetSongById($getById)->GetSongByIdResult;

            
            if(empty($songResult) || $songResult == null) {
                $this->_ws_error = $this->_service->ReturnError(new ReturnError())->ReturnErrorResult;
		throw new Exception ("WS_ERROR");
	    }
            
            $this->set_song($songResult);
            $this->_access = true;
	}
	catch (Exception $ex) 
	{
            if($ex->getMessage() == "WS_ERROR") {
                $this->_error = $this->_ws_error;
            } else {
                $this->_error = ErrorHandler::ReturnError($ex->getMessage());
            }
	}
    }
    
    private function prepare_play_from_list($user, $mood, $genres = null) {
        try 
	{
	    if(empty($mood)) {
		throw new Exception ("EMPTY_FORM");
	    }
            
            if(!isset($this->_user->Id)) {
                throw new Exception ("USER_MUST_BE_LOGGED_IN");
            }
            
            $playFromList = new PlayFromList();
            $playFromList->user = $this->_user;
            $playFromList->moodId = $mood;
            if($genres != null) {
                $genreArray = array();
                foreach($genres as $value) {
                    $newgenre = new Genre();
                    $newgenre->Id = $value;
                    array_push($genreArray, $newgenre);
                }
                $playFromList->genres = $genreArray;
            }
            $playFromList->lastPlayedId = $this->get_last_played();
            $playResult = $this->_service->PlayFromList($playFromList)->PlayFromListResult;
            
            if(empty($playResult) || $playResult == null) {
                $this->_ws_error = $this->_service->ReturnError(new ReturnError())->ReturnErrorResult;
		throw new Exception ("WS_ERROR");
	    }
            
            $this->set_song($playResult);
            $this->set_last_played($this->song->Id);
            $this->_access = true;
	}
	catch (Exception $ex) 
	{
            if($ex->getMessage() == "WS_ERROR") {
                $this->_error = $this->_ws_error;
            } else {
                $this->_error = ErrorHandler::ReturnError($ex->getMessage());
            }
	}
    }
    
    private function prepare_discover($user, $mood, $genres = null) {
        try 
	{
	    if(empty($mood)) {
		throw new Exception ("EMPTY_FORM");
	    }
            
            if(!isset($this->_user->Id)) {
                throw new Exception ("USER_MUST_BE_LOGGED_IN");
            }
            
            $discover = new Discover();
            $discover->user = $this->_user;
            $discover->moodId = $mood;
            if($genres != null) {
                $genreArray = array();
                foreach($genres as $value) {
                    $newgenre = new Genre();
                    $newgenre->Id = $value;
                    array_push($genreArray, $newgenre);
                }
                $discover->genres = $genreArray;
            }
            $discover->lastPlayedId = $this->get_last_played();
            $discoverResult = $this->_service->Discover($discover)->DiscoverResult;
            
            if(empty($discoverResult) || $discoverResult == null) {
                $this->_ws_error = $this->_service->ReturnError(new ReturnError())->ReturnErrorResult;
		throw new Exception ("WS_ERROR");
	    }
            
            $this->set_song($discoverResult);
            $this->set_last_played($this->song->Id);
            $this->_access = true;
	}
	catch (Exception $ex) 
	{
            if($ex->getMessage() == "WS_ERROR") {
                $this->_error = $this->_ws_error;
            } else {
                $this->_error = ErrorHandler::ReturnError($ex->getMessage());
            }
	}
    }
    
    private function prepare_discover_by_artist($user, $artistId) {
        try {
            if (!isset($this->_user->Id)) {
                throw new Exception("USER_MUST_BE_LOGGED_IN");
            }
            
            $discover_by_artist = new DiscoverByArtist();
            $discover_by_artist->artistId = $artistId;
            $discover_by_artist->user = $this->_user;
            $discover_by_artist->lastPlayedId = $this->get_last_played();
            $discover_by_artist_result = $this->_service->DiscoverByArtist($discover_by_artist)->DiscoverByArtistResult;
            
            if(empty($discover_by_artist_result) || $discover_by_artist_result == null) {
                $this->_ws_error = $this->_service->ReturnError(new ReturnError())->ReturnErrorResult;
                throw new Exception ("WS_ERROR");
            }
            
            $this->set_song($discover_by_artist_result);
            $this->set_last_played($this->song->Id);
            $this->_access = true;
        } 
        catch (Exception $ex) 
        {
            if($ex->getMessage() == "WS_ERROR") {
                $this->_error = $this->_ws_error;
            } else {
                $this->_error = ErrorHandler::ReturnError($ex->getMessage());
            }
        }
    }
    
    private function set_last_played($value) {
        $_SESSION['last_played_id'] = $value;
    }
    
    public function get_last_played() 
    {
	if($this->last_played_exist()) {
            return $_SESSION['last_played_id'];
        } else {
            return 0;
        }
    }
    
    private function last_played_exist() 
    {
	return (isset($_SESSION['last_played_id'])) ? true : false;
    }
    
    public function convert_song_to_array($song) {
        $array['id'] = $song->Id;
        $array['songname'] = $song->Name;
        $array['filepath'] = $song->Filename;
        $array['artist'] = $song->Artist->Name;
        $array['artist_image'] = $song->Artist->ImageUrl;
        $array['album'] = $song->Album->Name;
        $array['artist_id'] = $song->Artist->Id;
        $array['album_id'] = $song->Album->Id;
        return $array;
    }
    
    private function set_song($song) {
        $this->song = $song;
    }
    
    private function set_playlist($playlist) {
        $this->playlist = $playlist;
    }
    
    private function set_artist_songs($playlist) {
        $this->artist_songs = $playlist;
    }
    
    private function check_genres($genres = null) {
        if(!empty($genres)) {
            if(is_array($genres)) {
                $overwritten_genres = array();
                foreach($genres as $value) {
                    $genre = new Genre();
                    $genre->Id = $value;
                    array_push($overwritten_genres, $genre);
                }
                $this->_overwritten_genres = $overwritten_genres;
                return true;
            }
        }
        return false;
    }
}

?>
