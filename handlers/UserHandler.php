<?php
class UserHandler 
{
    private $_service;
    private $_user;
    
    private $_token;
    private $_access;
    private $_ws_error;
    public $_error;
    
    
    public function __construct($service) 
    {
        $this->_service = $service;
	$this->_errors	= array();
        $this->_user = new User();
    }
    
    public function prepare_create_user($email, $username, $password1, $password2, $token) 
    {
        $this->_access = false;
        $this->_token	= isset($token) ? $token : "";
        $this->prepare_create($email, $username, $password1, $password2);
        return $this->_access;
    }
    
    public function create_user($ageGroup, $genres) 
    {
        $this->_access = false;
        $this->create($ageGroup, $genres);
        return $this->_access;
    }
    
    public function change_password($user, $oldPassword, $newPassword1, $newPassword2) {
        $this->_access = false;
        $this->_user = $user;
        $this->prepare_password_change($oldPassword, $newPassword1, $newPassword2);
        return $this->_access;
    }
    
    public function change_preferences($user, $ageGroupId, $genres) {
        $this->_access = false;
        $this->_user = $user;
        $this->prepare_change_preferences($ageGroupId, $genres);
        return $this->_access;
    }
    
    private function prepare_change_preferences($ageGroupId, $genres) {
        try 
	{
            if(!isset($this->_user->Id)) {
                throw new Exception ("USER_MUST_BE_LOGGED_IN");
            }
                
            if(empty($ageGroupId) || !is_numeric($ageGroupId)) {
		throw new Exception ("EMPTY_FORM");
	    }
            
            if(is_array($genres)) {
                $preferedGenres = array();
                foreach($genres as $value) {
                    $genre = new Genre();
                    $genre->Id = $value;
                    array_push($preferedGenres, $genre);
                }
                $this->_user->PreferedGenres = $preferedGenres;
            } else {
                $this->_user->PreferedGenres = null;
            }
            $this->_user->AgeGroupId = $ageGroupId;
	    
	    $ChangePreferences = new ChangePreferences();
            $ChangePreferences->user = $this->_user;
            
            if(!$this->_service->ChangePreferences($ChangePreferences)->ChangePreferencesResult) {
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
    
    private function prepare_password_change($oldPassword, $newPassword1, $newPassword2) {
        try 
	{
	    if(empty($oldPassword) || empty($newPassword1) || empty($newPassword2) || strlen(trim($oldPassword)) == 0 || strlen(trim($newPassword1)) == 0 || strlen(trim($newPassword2)) == 0) {
		throw new Exception ("EMPTY_FORM");
	    }
            
            if($newPassword1 != $newPassword2) {
                throw new Exception ("CREATE_USER_MISMATCH_PASSWORD");
            }
            
            if(!isset($this->_user->Id)) {
                throw new Exception ("USER_MUST_BE_LOGGED_IN");
            }
            
            $ChangePassword = new ChangePassword();
            $ChangePassword->user = $this->_user;
            $ChangePassword->oldPassword = $oldPassword;
            $ChangePassword->newPassword = $newPassword1;
            
            if(!$this->_service->ChangePassword($ChangePassword)->ChangePasswordResult) {
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
    
    private function prepare_create($email, $username, $password1, $password2)
    {
	try 
	{
	    if(!$this->token_valid()) {
		throw new Exception ("INVALID_FORM");
	    }
	    
	    if(empty($email) || empty($username) || empty($password1) || empty($password2) || strlen(trim($email)) == 0 || strlen(trim($username)) == 0 || strlen(trim($password1)) == 0 || strlen(trim($password2)) == 0) {
		throw new Exception ("EMPTY_FORM");
	    }
            
            $this->_user->Email = $email;
            $this->_user->Username = $username;
            $this->_user->Password = $password1;
            
            if($password1 != $password2) {
                throw new Exception ("CREATE_USER_MISMATCH_PASSWORD");
            }
            
            if(!$this->username_valid()) {
		throw new Exception ("CREATE_INVALID_USERNAME");
	    }
            
            if(!$this->email_valid()) {
		throw new Exception ("CREATE_INVALID_EMAIL");
	    }
            
            $checkUsernameEmail = new CheckUsernameEmailExists();
            $checkUsernameEmail->user = $this->_user->Username;
            
            if($this->_service->CheckUsernameEmailExists($checkUsernameEmail)->CheckUsernameEmailExistsResult) {
		throw new Exception ("CREATE_USERNAME_TAKEN");
	    }
            
            $checkUsernameEmail->user = $this->_user->Email;
            
            if($this->_service->CheckUsernameEmailExists($checkUsernameEmail)->CheckUsernameEmailExistsResult) {
		throw new Exception ("CREATE_EMAIL_TAKEN");
	    }
            
	    $this->register_prepare_session();
            $this->_access = true;
	}
	catch (Exception $ex) 
	{
            $this->_error = ErrorHandler::ReturnError($ex->getMessage());
	}
    }

    private function create($ageGroup, $genres)
    {
	try 
	{
	    if(!$this->prepare_session_exist()) {
		throw new Exception ("CREATE_ENTER_STEP_ONE");
	    }
            $this->_user = $_SESSION['user_create'];
	    
	    if(empty($this->_user->Email) || empty($this->_user->Username) || empty($this->_user->Password)) {
		throw new Exception ("CREATE_ENTER_STEP_ONE");
	    }
            
            if(is_array($genres)) {
                $preferedGenres = array();
                foreach($genres as $value) {
                    $genre = new Genre();
                    $genre->Id = $value;
                    array_push($preferedGenres, $genre);
                }
                $this->_user->PreferedGenres = $preferedGenres;
            }
            $this->_user->AgeGroupId = $ageGroup;
            
            if(empty($ageGroup) || !is_numeric($ageGroup)) {
		throw new Exception ("EMPTY_FORM");
	    }
	    
	    if(!$this->verify_create()) {
		throw new Exception ("WS_ERROR");
	    }
	    
	    $this->_access = true;
	}
	catch (Exception $ex) 
	{
            $this->register_prepare_session();
            if($ex->getMessage() == "WS_ERROR") {
                $this->_error = $this->_ws_error;
            } else {
                $this->_error = ErrorHandler::ReturnError($ex->getMessage());
            }
            
	}
    }
    
    public function get_updated_genres($genres) {
        $genreObjects = new stdClass();
        $genreArray = array();
        if(!empty($genres)) {
            foreach ($genres as $value) {
                $genre = new Genre;
                $genre->Id = $value;
                $genreArray[] = $genre;
            }
        }
        $genreObjects->Genre = $genreArray;
        return $genreObjects;
    }
    
    private function verify_create()
    {
        $createUser = new CreateUser();
        $createUser->user = $this->_user;
        $executeCreate = $this->_service->CreateUser($createUser);
        if($executeCreate->CreateUserResult) {
            return true;
        } else {
            $this->_ws_error = $this->_service->ReturnError(new ReturnError())->ReturnErrorResult;
            return false;
        }
    }
    
    public function unset_prepare_session() {
        if($this->prepare_session_exist()) {
            unset($_SESSION['user_create']);
        }
    }
    
    public function get_prepare_session() {
        if($this->prepare_session_exist()) {
            return $_SESSION['user_create'];
        }
    }
    
    private function register_prepare_session() {
        $_SESSION['user_create'] = $this->_user;
    }
    
    private function prepare_session_exist() 
    {
	return (isset($_SESSION['user_create'])) ? true : false;
    }
    
    private function token_valid()
    {
	return (!isset($_SESSION['token']) || $_SESSION['token'] != $this->_token) ? false : true;
    }
    
    private function username_valid()
    {
	return (preg_match('/[^a-zA-Z0-9]/', $this->_user->Username)) ? false : true;
    }
    
    private function email_valid()
    {
        return filter_var($this->_user->Email, FILTER_VALIDATE_EMAIL);
    }
}

?>
