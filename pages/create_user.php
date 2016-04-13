<?php
if ($loginHandler->check_login()) {
    ErrorHandler::DisplayError(ErrorHandler::ReturnError("LOGIN_ALREADY_EXISTS")->ErrorMessage, false);
    die();
}

switch (isset($_GET['step']) ? $_GET['step'] : null) {
    case '2':
        if(!isset($_SESSION['user_create'])) {
            header('Location: http://'. $_SERVER['HTTP_HOST'] .'/?page=create_user');
            die();
        }
        if (isset($_POST['submit'])) {
            if ($userHandler->create_user((isset($_POST['agegroup']) ? $_POST['agegroup'] : null), isset($_POST['genres']) ? $_POST['genres'] : null)) {
                if($loginHandler->check_login($userHandler->get_prepare_session()->Username, $userHandler->get_prepare_session()->Password, $config->token)) {
                    $userHandler->unset_prepare_session();
                    header('Location: http://'. $_SERVER['HTTP_HOST'] .'/');
                    die();
                } else {
                    ErrorHandler::DisplayError($loginHandler->_error->ErrorMessage, false);
                }
            } else {
                ErrorHandler::DisplayError($userHandler->_error->ErrorMessage, false);
            }
        }
        $ageGroups = $service->GetAgeGroups(new GetAgeGroups())->GetAgeGroupsResult;
        $genres = $service->GetGenres(new GetGenres())->GetGenresResult;
        echo "
        <div id='preferenceContainer'>
            <form name='submit' method='post' action='?page=create_user&step=2'>
            <table valign='top' width='100%'>
            <tbody>
            <tr>
                <td>";
                echo "<div class='label' style='margin-bottom:3px;font-weight:bold;'>Select your agegroup:</div>";
                foreach(getObjectsFromList($ageGroups) as $value) {
                    echo "<input type='radio' name='agegroup' value='".$value->Id."'";
                    if((isset($userHandler->get_prepare_session()->AgeGroupId) && $userHandler->get_prepare_session()->AgeGroupId == $value->Id) || isset($_POST['agegroup']) && $_POST['agegroup'] == $value->Id) {
                        echo "checked";
                    }
                    echo "><label class='input_text'>" . $value->Name ."</label>";
                }
                echo "</td>
            </tr>
            <tr>
                <td>";
                echo "<div class='label' style='margin-top:10px;margin-bottom:3px;font-weight:bold;'>Select your favourite genres:</div><table><tr>";
                $count = 1;
                foreach(getObjectsFromList($genres) as $value) {
                    echo "<td><input type='checkbox' name='genres[]' value='".$value->Id."'";
                    if(isset($userHandler->get_prepare_session()->PreferedGenres)) {
                        foreach($userHandler->get_prepare_session()->PreferedGenres as $checked_value) {
                            if($checked_value->Id == $value->Id) {
                                echo "checked";
                            }
                        }
                    } else if (isset($_POST['genres'])) {
                        if($_POST['genres'] == $value->Id) {
                            echo "checked";
                        }
                    }
                    echo "><label class='input_text'>" . $value->Name."</label></td>";
                    if($count == 4) {
                        echo "</tr>";
                    }
                    $count++;
                }
                echo "</tr></table>
                    </td>
            </tr>
            </table>
            
            <div class='center_container'>
                    <input type='submit' name='submit' value='Create your account' class='login_button btn btn-default' style='margin-top:2px;height: 34px;font-size:14px !important;'>
            </div>
            </form>
        </div>
         ";
        break;

    default:
        if (isset($_POST['submit'])) {
            if ($userHandler->prepare_create_user($_POST['email'], $_POST['username'], $_POST['password1'], $_POST['password2'], $_POST['token'])) {
                header('Location: http://'. $_SERVER['HTTP_HOST'] .'/mixr/?page=create_user&step=2');
                die();
            } else {
                ErrorHandler::DisplayError($userHandler->_error->ErrorMessage, false);
            }
        }
        if(isset($_SERVER['HTTP_REFERER']) && !strpos($_SERVER['HTTP_REFERER'], '?page=create_user&step=2')) {
            $userHandler->unset_prepare_session();
        }
        $defaultValue["Username"] = (isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], '?page=create_user&step=2') && isset($_SESSION['user_create']) ? $_SESSION['user_create']->Username : (isset($_POST['submit']) ? $_POST['username'] : ""));
        $defaultValue["Email"] = (isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], '?page=create_user&step=2') && isset($_SESSION['user_create']) ? $_SESSION['user_create']->Email : (isset($_POST['submit']) ? $_POST['email'] : ""));
        echo "
    <div id='create_container'>
	<form name='submit' method='post' action=''>
        
        <input type='hidden' name='token' value='" . $config->token . "'>
	<table valign='top' style='width:100%;'>
	<tbody>
        <tr>
            <td>
                <div class='label' style='font-weight:bold;'>Email address:</div>
                <input type='text' name='email' value='".$defaultValue["Email"]."' placeholder='Enter email' class='login_input form-control' size='25'>
            </td>
	</tr>
	<tr>
            <td>
                <div class='label' style='font-weight:bold;'>Username:</div>
                <input type='text' name='username' value='".$defaultValue["Username"]."' placeholder='Enter username' class='login_input form-control' size='25'>
            </td>
	</tr>
        <tr>
            <td>
                <div class='label' style='font-weight:bold;'>Password:</div>
                <input type='password' name='password1' value='' class='login_input form-control' placeholder='Enter password' size='25'>
            </td>
	</tr>
        <tr>
            <td>
                <div class='label' style='font-weight:bold;'>Repeat password:</div>
                <input type='password' name='password2' value='' class='login_input form-control' placeholder='Repeat password' size='25'>
            </td>
	</tr>
	<tr>
            <td>
                <input type='submit' name='submit' value='Create' class='login_button btn btn-default' style='margin-top:2px;height: 34px;font-size:14px !important;float:left;width:48% !important;'><input type='reset' name='reset' value='Reset fields' class='login_button btn btn-default' style='margin-top:2px;height: 34px;font-size:14px !important;float:right;width:48% !important;'>
            </td>
	</tr>
	</tbody>
        </table>
	</form>
    </div>
     ";
        break;
}
?>