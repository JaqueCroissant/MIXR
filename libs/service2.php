<?php
class User {
  public $AgeGroupId; // int
  public $Email; // string
  public $Id; // int
  public $Password; // string
  public $PreferedGenres; // ArrayOfGenre
  public $Username; // string
}

class Genre {
  public $Id; // int
  public $Name; // string
}

class AgeGroup {
  public $Id; // int
  public $Name; // string
}

class Mood {
  public $Id; // int
  public $Image; // string
  public $Name; // string
}

class Error {
  public $ErrorCode; // string
  public $ErrorMessage; // string
}

class Song {
  public $Album; // Album
  public $AlbumId; // int
  public $Artist; // Artist
  public $ArtistId; // int
  public $Filename; // string
  public $Genres; // ArrayOfGenre
  public $Id; // int
  public $Name; // string
}

class Album {
  public $ArtistId; // int
  public $Id; // int
  public $Name; // string
  public $Year; // string
}

class Artist {
  public $Id; // int
  public $ImageUrl; // string
  public $Name; // string
}

class InsertContainer {
  public $AgeGroupIds; // ArrayOfint
  public $AlbumTitle; // string
  public $AlbumYear; // string
  public $Artist; // string
  public $Filename; // string
  public $GenreIds; // ArrayOfint
  public $MoodIds; // ArrayOfint
  public $SongTitle; // string
}

class SearchType {
}

class CreateUser {
  public $user; // User
}

class CreateUserResponse {
  public $CreateUserResult; // boolean
}

class Login {
  public $username; // string
  public $password; // string
}

class LoginResponse {
  public $LoginResult; // boolean
}

class RetrievePassword {
  public $emailOrUsername; // string
}

class RetrievePasswordResponse {
  public $RetrievePasswordResult; // boolean
}

class ChangePassword {
  public $user; // User
  public $oldPassword; // string
  public $newPassword; // string
}

class ChangePasswordResponse {
  public $ChangePasswordResult; // boolean
}

class ChangePreferences {
  public $user; // User
}

class ChangePreferencesResponse {
  public $ChangePreferencesResult; // boolean
}

class GetUser {
}

class GetUserResponse {
  public $GetUserResult; // User
}

class GetAgeGroups {
}

class GetAgeGroupsResponse {
  public $GetAgeGroupsResult; // ArrayOfAgeGroup
}

class GetGenres {
}

class GetGenresResponse {
  public $GetGenresResult; // ArrayOfGenre
}

class GetMoods {
}

class GetMoodsResponse {
  public $GetMoodsResult; // ArrayOfMood
}

class GetPlaylistSongs {
  public $user; // User
}

class GetPlaylistSongsResponse {
  public $GetPlaylistSongsResult; // ArrayOfSong
}

class GetArtistSongs {
  public $artistId; // int
}

class GetArtistSongsResponse {
  public $GetArtistSongsResult; // ArrayOfSong
}

class GetSongById {
  public $id; // int
}

class GetSongByIdResponse {
  public $GetSongByIdResult; // Song
}

class GetAlbumById {
  public $id; // int
}

class GetAlbumByIdResponse {
  public $GetAlbumByIdResult; // Album
}

class GetArtistById {
  public $id; // int
}

class GetArtistByIdResponse {
  public $GetArtistByIdResult; // Artist
}

class SearchSongs {
  public $searchType; // SearchType
  public $param; // string
  public $user; // User
}

class SearchSongsResponse {
  public $SearchSongsResult; // ArrayOfSong
}

class Discover {
  public $user; // User
  public $moodId; // int
  public $genres; // ArrayOfGenre
  public $lastPlayedId; // int
}

class DiscoverResponse {
  public $DiscoverResult; // Song
}

class DiscoverByArtist {
  public $user; // User
  public $artistId; // int
  public $lastPlayedId; // int
}

class DiscoverByArtistResponse {
  public $DiscoverByArtistResult; // Song
}

class PlayFromList {
  public $user; // User
  public $moodId; // int
  public $genres; // ArrayOfGenre
  public $lastPlayedId; // int
}

class PlayFromListResponse {
  public $PlayFromListResult; // Song
}

class AddtoPlaylist {
  public $user; // User
  public $songId; // int
}

class AddtoPlaylistResponse {
  public $AddtoPlaylistResult; // boolean
}

class RemovefromPlaylist {
  public $user; // User
  public $songId; // int
}

class RemovefromPlaylistResponse {
  public $RemovefromPlaylistResult; // boolean
}

class AddSongToDatabase {
  public $container; // InsertContainer
}

class AddSongToDatabaseResponse {
  public $AddSongToDatabaseResult; // boolean
}

class CheckUsernameEmailExists {
  public $user; // string
}

class CheckUsernameEmailExistsResponse {
  public $CheckUsernameEmailExistsResult; // boolean
}

class IsDaytime {
}

class IsDaytimeResponse {
  public $IsDaytimeResult; // boolean
}

class ReturnError {
}

class ReturnErrorResponse {
  public $ReturnErrorResult; // Error
}

class char {
}

class duration {
}

class guid {
}


/**
 * Service class
 * 
 *  
 * 
 * @author    {author}
 * @copyright {copyright}
 * @package   {package}
 */
class Service extends SoapClient {

  private static $classmap = array(
                                    'User' => 'User',
                                    'Genre' => 'Genre',
                                    'AgeGroup' => 'AgeGroup',
                                    'Mood' => 'Mood',
                                    'Error' => 'Error',
                                    'Song' => 'Song',
                                    'Album' => 'Album',
                                    'Artist' => 'Artist',
                                    'InsertContainer' => 'InsertContainer',
                                    'SearchType' => 'SearchType',
                                    'CreateUser' => 'CreateUser',
                                    'CreateUserResponse' => 'CreateUserResponse',
                                    'Login' => 'Login',
                                    'LoginResponse' => 'LoginResponse',
                                    'RetrievePassword' => 'RetrievePassword',
                                    'RetrievePasswordResponse' => 'RetrievePasswordResponse',
                                    'ChangePassword' => 'ChangePassword',
                                    'ChangePasswordResponse' => 'ChangePasswordResponse',
                                    'ChangePreferences' => 'ChangePreferences',
                                    'ChangePreferencesResponse' => 'ChangePreferencesResponse',
                                    'GetUser' => 'GetUser',
                                    'GetUserResponse' => 'GetUserResponse',
                                    'GetAgeGroups' => 'GetAgeGroups',
                                    'GetAgeGroupsResponse' => 'GetAgeGroupsResponse',
                                    'GetGenres' => 'GetGenres',
                                    'GetGenresResponse' => 'GetGenresResponse',
                                    'GetMoods' => 'GetMoods',
                                    'GetMoodsResponse' => 'GetMoodsResponse',
                                    'GetPlaylistSongs' => 'GetPlaylistSongs',
                                    'GetPlaylistSongsResponse' => 'GetPlaylistSongsResponse',
                                    'GetArtistSongs' => 'GetArtistSongs',
                                    'GetArtistSongsResponse' => 'GetArtistSongsResponse',
                                    'GetSongById' => 'GetSongById',
                                    'GetSongByIdResponse' => 'GetSongByIdResponse',
                                    'GetAlbumById' => 'GetAlbumById',
                                    'GetAlbumByIdResponse' => 'GetAlbumByIdResponse',
                                    'GetArtistById' => 'GetArtistById',
                                    'GetArtistByIdResponse' => 'GetArtistByIdResponse',
                                    'SearchSongs' => 'SearchSongs',
                                    'SearchSongsResponse' => 'SearchSongsResponse',
                                    'Discover' => 'Discover',
                                    'DiscoverResponse' => 'DiscoverResponse',
                                    'DiscoverByArtist' => 'DiscoverByArtist',
                                    'DiscoverByArtistResponse' => 'DiscoverByArtistResponse',
                                    'PlayFromList' => 'PlayFromList',
                                    'PlayFromListResponse' => 'PlayFromListResponse',
                                    'AddtoPlaylist' => 'AddtoPlaylist',
                                    'AddtoPlaylistResponse' => 'AddtoPlaylistResponse',
                                    'RemovefromPlaylist' => 'RemovefromPlaylist',
                                    'RemovefromPlaylistResponse' => 'RemovefromPlaylistResponse',
                                    'AddSongToDatabase' => 'AddSongToDatabase',
                                    'AddSongToDatabaseResponse' => 'AddSongToDatabaseResponse',
                                    'CheckUsernameEmailExists' => 'CheckUsernameEmailExists',
                                    'CheckUsernameEmailExistsResponse' => 'CheckUsernameEmailExistsResponse',
                                    'IsDaytime' => 'IsDaytime',
                                    'IsDaytimeResponse' => 'IsDaytimeResponse',
                                    'ReturnError' => 'ReturnError',
                                    'ReturnErrorResponse' => 'ReturnErrorResponse',
                                    'char' => 'char',
                                    'duration' => 'duration',
                                    'guid' => 'guid',
                                   );

  public function Service($wsdl = "http://localhost:4832/Services/Service.svc?wsdl", $options = array()) {
    foreach(self::$classmap as $key => $value) {
      if(!isset($options['classmap'][$key])) {
        $options['classmap'][$key] = $value;
      }
    }
    parent::__construct($wsdl, $options);
  }

  /**
   *  
   *
   * @param CreateUser $parameters
   * @return CreateUserResponse
   */
  public function CreateUser(CreateUser $parameters) {
    return $this->__soapCall('CreateUser', array($parameters),       array(
            'uri' => 'http://tempuri.org/',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param Login $parameters
   * @return LoginResponse
   */
  public function Login(Login $parameters) {
    return $this->__soapCall('Login', array($parameters),       array(
            'uri' => 'http://tempuri.org/',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param RetrievePassword $parameters
   * @return RetrievePasswordResponse
   */
  public function RetrievePassword(RetrievePassword $parameters) {
    return $this->__soapCall('RetrievePassword', array($parameters),       array(
            'uri' => 'http://tempuri.org/',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param ChangePassword $parameters
   * @return ChangePasswordResponse
   */
  public function ChangePassword(ChangePassword $parameters) {
    return $this->__soapCall('ChangePassword', array($parameters),       array(
            'uri' => 'http://tempuri.org/',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param ChangePreferences $parameters
   * @return ChangePreferencesResponse
   */
  public function ChangePreferences(ChangePreferences $parameters) {
    return $this->__soapCall('ChangePreferences', array($parameters),       array(
            'uri' => 'http://tempuri.org/',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param GetUser $parameters
   * @return GetUserResponse
   */
  public function GetUser(GetUser $parameters) {
    return $this->__soapCall('GetUser', array($parameters),       array(
            'uri' => 'http://tempuri.org/',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param GetAgeGroups $parameters
   * @return GetAgeGroupsResponse
   */
  public function GetAgeGroups(GetAgeGroups $parameters) {
    return $this->__soapCall('GetAgeGroups', array($parameters),       array(
            'uri' => 'http://tempuri.org/',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param GetGenres $parameters
   * @return GetGenresResponse
   */
  public function GetGenres(GetGenres $parameters) {
    return $this->__soapCall('GetGenres', array($parameters),       array(
            'uri' => 'http://tempuri.org/',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param GetMoods $parameters
   * @return GetMoodsResponse
   */
  public function GetMoods(GetMoods $parameters) {
    return $this->__soapCall('GetMoods', array($parameters),       array(
            'uri' => 'http://tempuri.org/',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param GetPlaylistSongs $parameters
   * @return GetPlaylistSongsResponse
   */
  public function GetPlaylistSongs(GetPlaylistSongs $parameters) {
    return $this->__soapCall('GetPlaylistSongs', array($parameters),       array(
            'uri' => 'http://tempuri.org/',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param GetArtistSongs $parameters
   * @return GetArtistSongsResponse
   */
  public function GetArtistSongs(GetArtistSongs $parameters) {
    return $this->__soapCall('GetArtistSongs', array($parameters),       array(
            'uri' => 'http://tempuri.org/',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param GetSongById $parameters
   * @return GetSongByIdResponse
   */
  public function GetSongById(GetSongById $parameters) {
    return $this->__soapCall('GetSongById', array($parameters),       array(
            'uri' => 'http://tempuri.org/',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param GetAlbumById $parameters
   * @return GetAlbumByIdResponse
   */
  public function GetAlbumById(GetAlbumById $parameters) {
    return $this->__soapCall('GetAlbumById', array($parameters),       array(
            'uri' => 'http://tempuri.org/',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param GetArtistById $parameters
   * @return GetArtistByIdResponse
   */
  public function GetArtistById(GetArtistById $parameters) {
    return $this->__soapCall('GetArtistById', array($parameters),       array(
            'uri' => 'http://tempuri.org/',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param SearchSongs $parameters
   * @return SearchSongsResponse
   */
  public function SearchSongs(SearchSongs $parameters) {
    return $this->__soapCall('SearchSongs', array($parameters),       array(
            'uri' => 'http://tempuri.org/',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param Discover $parameters
   * @return DiscoverResponse
   */
  public function Discover(Discover $parameters) {
    return $this->__soapCall('Discover', array($parameters),       array(
            'uri' => 'http://tempuri.org/',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param DiscoverByArtist $parameters
   * @return DiscoverByArtistResponse
   */
  public function DiscoverByArtist(DiscoverByArtist $parameters) {
    return $this->__soapCall('DiscoverByArtist', array($parameters),       array(
            'uri' => 'http://tempuri.org/',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param PlayFromList $parameters
   * @return PlayFromListResponse
   */
  public function PlayFromList(PlayFromList $parameters) {
    return $this->__soapCall('PlayFromList', array($parameters),       array(
            'uri' => 'http://tempuri.org/',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param AddtoPlaylist $parameters
   * @return AddtoPlaylistResponse
   */
  public function AddtoPlaylist(AddtoPlaylist $parameters) {
    return $this->__soapCall('AddtoPlaylist', array($parameters),       array(
            'uri' => 'http://tempuri.org/',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param RemovefromPlaylist $parameters
   * @return RemovefromPlaylistResponse
   */
  public function RemovefromPlaylist(RemovefromPlaylist $parameters) {
    return $this->__soapCall('RemovefromPlaylist', array($parameters),       array(
            'uri' => 'http://tempuri.org/',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param AddSongToDatabase $parameters
   * @return AddSongToDatabaseResponse
   */
  public function AddSongToDatabase(AddSongToDatabase $parameters) {
    return $this->__soapCall('AddSongToDatabase', array($parameters),       array(
            'uri' => 'http://tempuri.org/',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param CheckUsernameEmailExists $parameters
   * @return CheckUsernameEmailExistsResponse
   */
  public function CheckUsernameEmailExists(CheckUsernameEmailExists $parameters) {
    return $this->__soapCall('CheckUsernameEmailExists', array($parameters),       array(
            'uri' => 'http://tempuri.org/',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param IsDaytime $parameters
   * @return IsDaytimeResponse
   */
  public function IsDaytime(IsDaytime $parameters) {
    return $this->__soapCall('IsDaytime', array($parameters),       array(
            'uri' => 'http://tempuri.org/',
            'soapaction' => ''
           )
      );
  }

  /**
   *  
   *
   * @param ReturnError $parameters
   * @return ReturnErrorResponse
   */
  public function ReturnError(ReturnError $parameters) {
    return $this->__soapCall('ReturnError', array($parameters),       array(
            'uri' => 'http://tempuri.org/',
            'soapaction' => ''
           )
      );
  }

}

?>
