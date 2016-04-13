<?php
require "../ajax_includes.php";

switch(isset($_GET['do']) ? $_GET['do'] : null) {
    case 'change_preferences':
        if ($userHandler->change_preferences($loginHandler->user_session(), isset($_POST["agegroup"]) ? $_POST["agegroup"] : null, (isset($_POST["genres"]) ? $_POST["genres"] : null))) {
            $loginHandler->user_session()->AgeGroupId = $_POST["agegroup"];
            $loginHandler->user_session()->PreferedGenres = $userHandler->get_updated_genres(isset($_POST["genres"]) ? $_POST["genres"] : null);
            $jsonArray['status'] = true;
        } else {
            $jsonArray['status'] = false;
            $jsonArray['error'] = $userHandler->_error->ErrorMessage;
        }
        break;
    
    default:
        if ($userHandler->change_password($loginHandler->user_session(), isset($_POST['oldPassword']) ? $_POST['oldPassword'] : null, isset($_POST['newPassword1']) ? $_POST['newPassword1'] : null, isset($_POST['newPassword2']) ? $_POST['newPassword2'] : null)) {
            $loginHandler->user_session()->Password = $_POST["newPassword1"];
            $jsonArray['status'] = true;
        } else {
            $jsonArray['status'] = false;
            $jsonArray['error'] = $userHandler->_error->ErrorMessage;
        }
        break;
}
echo json_encode($jsonArray);
?>