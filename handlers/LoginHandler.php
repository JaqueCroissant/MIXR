<?php
class LoginHandler 
{
    private $_service;
    private $_user;
    private $_login;
    
    private $_access;
    private $_token;
    private $_ws_error;
    public $_error;
    
    public function __construct($service) 
    {
        $this->_service = $service;
	$this->_errors	= array();
	$this->_access	= false;
        
        $this->_user = new User();
    }
    
    public function check_login($username = null, $password = null, $token = null) 
    {
        if(isset($username) && isset($password) && isset($token)) {
            $this->set_values($username, $password, $token);
            $this->verify_post();       
        } else {
            $this->verify_session();
        }
	return $this->_access;
    }
    
    private function set_values($username, $password, $token) {
        $this->_user = new User();
        $this->_token	= isset($token) ? $token : "";
        $this->_login = new Login();
        $this->_login->username = $username;
        $this->_login->password = $password;
    }
    
    private function verify_post()
    {
	try 
	{
	    if(!$this->token_valid()) {
		throw new Exception ("INVALID_FORM");
	    }
	    
	    if(empty($this->_login->username) || empty($this->_login->password)) {
		throw new Exception ("EMPTY_FORM");
	    }
	    
	    if($this->session_exist()) {
		throw new Exception ("LOGIN_ALREADY_EXISTS");
	    }
	    
	    if(!$this->verify_login()) {
		throw new Exception ("WS_ERROR");
	    }
	    
	    $this->_access = true;
	    $this->register_session();
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
    
    private function verify_session()
    {
	if($this->session_exist()){
	    $this->_access = true;
	}
    }
    
    private function verify_login()
    {
        $executeLogin = $this->_service->Login($this->_login);
        if($executeLogin->LoginResult) {
            return true;
        } else {
            $this->_ws_error = $this->_service->ReturnError(new ReturnError())->ReturnErrorResult;
            return false;
        }
    }
    
    private function token_valid()
    {
	return (!isset($_SESSION['token']) || $_SESSION['token'] != $this->_token) ? false : true;
    }
    
    private function register_session()
    {
        $this->_user = $this->_service->GetUser(new GetUser())->GetUserResult;
        $_SESSION['user'] = $this->_user;
    }
    
    public function user_session() 
    {
	if($this->session_exist()) {
            return $_SESSION['user'];
        }
    }
    
    private function session_exist() 
    {
	return (isset($_SESSION['user'])) ? true : false;
    }
    
    public function log_out()
    {
	if($this->session_exist()) 
	{
	    unset($_SESSION['user']);
	    return true;
	}
	else 
	{
	    return false;
	}
    }
}

?>
