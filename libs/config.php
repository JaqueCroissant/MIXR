<?php
class config {
    public $token;
    
    public function __construct() {
	$this->token = (isset($_SESSION['token']) ? $_SESSION['token'] : $_SESSION['token'] = md5(uniqid(mt_rand(), true)));
    }
}
?>