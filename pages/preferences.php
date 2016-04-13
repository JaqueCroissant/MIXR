<?php
if(isset($_POST['url']) && $_POST['url'] == true) {
    require "../include/ajax_includes.php";
    require "../include/ajax/header_includes.php";
}

if (!$loginHandler->check_login()) {
    ErrorHandler::DisplayError(ErrorHandler::ReturnError("USER_MUST_BE_LOGGED_IN")->ErrorMessage, false);
    die();
} else {
    ErrorHandler::DisplayError();
}
ErrorHandler::DisplaySuccess();

switch (isset($_REQUEST["step"]) ? $_REQUEST['step'] : null) {
    case 'password':
        echo "
                <form name='password' method='post' action=''>
                <div id='changePassword'>
                    <table valign='top' style='width:100%;'>
                        <tr>
                            <td>
                                <div class='label' style='font-weight:bold;'>Old Password:</div>
                                <input name='oldPassword' type='password' value='' class='form-control' placeholder='Enter old password'>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class='label' style='font-weight:bold;'>New Password:</div>
                                <input name='newPassword1' type='password' value='' class='form-control' placeholder='Enter new password'>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class='label' style='font-weight:bold;'>Repeat New Password:</div>
                                <input name='newPassword2' type='password' value='' class='form-control' placeholder='Repeat new password'>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type='button' class='change_password btn btn-default' name='submit' value='Change password' style='margin-top:2px;height: 34px;font-size:14px !important;'>
                    </table>
                </div>
            ";
        break;

    case 'preferences':
        echo "
                <div id='preferenceContainer'>
                    <form name='preferences' method='post' action''>
                    <table valign='top' width='100%'>
                    <tbody>
                    <tr>
                        <td>
                        <div class='label' style='margin-bottom:3px;font-weight:bold;'>Select your agegroup:</div>";
        $ageGroups = $service->GetAgeGroups(new GetAgeGroups())->GetAgeGroupsResult;
        foreach (getObjectsFromList($ageGroups) as $value) {
            echo "<input type='radio' name='agegroup' value='" . $value->Id . "'";
            if ($loginHandler->user_session()->AgeGroupId == $value->Id) {
                echo "checked";
            }
            echo "><label class='input_text'>" . $value->Name ."</label>";
        }

        echo " </td>
                </tr>
                <tr> 
                    <td>
                        <div class='label' style='margin-top:10px;margin-bottom:3px;font-weight:bold;'>Select your favourite genres:</div><table><tr>";
        $genres = $service->GetGenres(new GetGenres())->GetGenresResult;
        $count = 1;
        foreach (getObjectsFromList($genres) as $value) {
            echo "<td><input type='checkbox' name='genres[]' value='" . $value->Id . "'";
            if (isset($loginHandler->user_session()->PreferedGenres->Genre)) {
                foreach (is_array($loginHandler->user_session()->PreferedGenres->Genre) ? $loginHandler->user_session()->PreferedGenres->Genre : $loginHandler->user_session()->PreferedGenres  as $checked_value) {
                    if ($checked_value->Id == $value->Id) {
                        echo "checked";
                    }
                }
            }
            echo "><label class='input_text'>" . $value->Name."</label></td>";
            if($count == 4) {
                echo "</tr>";
            }
            $count++;
        }
        echo "</tr>
            </table>
            </td></tr>
            </table>
            
            <div class='center_container'>
            <input type='button' name='submit' value='Change preferences' class='change_preferences btn btn-default' style='margin-top:10px;height: 34px;font-size:14px !important;'>
            </div>
            </div>
            </form>";
        break;

    default:
        ErrorHandler::ErrorPage("PAGE_DOESNT_EXIST");
        break;
}

?>