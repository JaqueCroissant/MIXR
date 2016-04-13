<?php
switch (isset($_GET['do']) ? $_GET['do'] : null) {
    case 'logout':
        $loginHandler->log_out();
        header('Location: http://'. $_SERVER['HTTP_HOST'] .'/');
        die();
        break;

    default:
        if ($loginHandler->check_login()) {
            header('Location: http://'. $_SERVER['HTTP_HOST'] .'/');
            die();
        }
        if (isset($_POST['submit'])) {
            if ($loginHandler->check_login($_POST['username'], $_POST['password'], $_POST['token'])) {
                header('Location: http://'. $_SERVER['HTTP_HOST'] .'/');
                die();
            } else {
                ErrorHandler::DisplayError($loginHandler->_error->ErrorMessage, false);
            }
        }
        echo "
    <div id='login_container'>
	<form name='submit' method='post' action=''>
        <input type='hidden' name='token' value='" . $config->token . "'>
	<table valign='top' style='width:100%;'>
	<tbody>
        <tr>
            <td>
                <div class='label' style='font-weight:bold;'>Username:</div>
                <input type='text' name='username' value='' class='login_input form-control' size='25' placeholder='Enter username'>
            </td>
	</tr>
	<tr>
            <td>
                <div class='label' style='font-weight:bold;'>Password:</div>
                <input type='password' name='password' value='' class='login_input form-control' size='25' placeholder='Enter password'>
            </td>
	</tr>
	<tr>
            <td>
                <input type='submit' name='submit' value='Login' class='login_button btn btn-default' style='width:100%;margin-top:2px;height: 34px;font-size:14px !important;'>
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