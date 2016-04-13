<?php
class ErrorHandler
{
    public static $Error;

    public static function ReturnError($errorCode = null)
    {
        ErrorHandler::$Error = ErrorHandler::SetErrorMessage($errorCode);
        return ErrorHandler::$Error;
    }

    private static function SetErrorMessage($errorCode = null)
    {
        $errorMessage;
        switch ($errorCode)
        {
            case "INVALID_FORM":
                $errorMessage = "You must use our webform.";
                break;
            
            case "EMPTY_FORM":
                $errorMessage = "You must fill out all fields";
                break;
            
            case "LOGIN_INVALID_DATA":
                $errorMessage = "You must enter correct data.";
                break;
            
            case "LOGIN_ALREADY_EXISTS":
                $errorMessage = "You are already logged in.";
                break;
            
            case "LOGIN_INVALID_INFO":
                $errorMessage = "Your email/username and password is not correct.";
                break;
            
            case "CREATE_USER_MISMATCH_PASSWORD":
                $errorMessage = "The passwords you entered does not match.";
                break;
            
            case "CREATE_INVALID_USERNAME":
                $errorMessage = "The username may only contain letters and numbers";
                break;
            
            case "CREATE_INVALID_EMAIL":
                $errorMessage = "The entered email is invalid.";
                break;
            
            case "CREATE_ENTER_STEP_ONE":
                $errorMessage = "You must fill out the fields from step one.";
                break;
            
            case "CREATE_USERNAME_TAKEN":
                $errorMessage = "Username already exists.";
                break;
            
            case "CREATE_EMAIL_TAKEN":
                $errorMessage = "This email is connected to another user.";
                break;
            
            case "USER_MUST_BE_LOGGED_IN":
                $errorMessage = "You must be logged in to use this feature.";
                break;
            
            case "PAGE_DOESNT_EXIST":
                $errorMessage = "This page doesn't exist.";
                break;

            default:
                $errorCode = "UNKOWN_ERROR";
                $errorMessage =  "Unknown error.";
                break;
        }
        return ErrorHAndler::CreateError($errorCode, $errorMessage);
    }

    public static function CreateError($errorCode, $errorMessage)
    {
        $error = new Error();
        $error->ErrorCode = $errorCode;
        $error->ErrorMessage = $errorMessage;
        return $error;
    }
    
    public static function ErrorPage($errorCode = null) {
        $errorMessage = ErrorHandler::ReturnError($errorCode);
        $root = $_SERVER['DOCUMENT_ROOT']."/MIXR/";
        require $root."include/error.php";
    }
    
    public static function DisplayError($errorMessage = null, $isHidden = true) {
        echo "<div id='alert_container' class='alert alert-danger alert-dismissible "; 
        if($isHidden == true) {
            echo "hidden";
        }
        echo "' role='alert'>
             <a href='#' class='close alert_close' aria-label='close' title='close'>&times;</a>
             <div class='alert_message'>". $errorMessage ."</div>
             </div>";
    }
    
    public static function DisplaySuccess($message = null, $isHidden = true) {
        echo "<div id='success_container' class='alert alert-success alert-dismissible "; 
        if($isHidden == true) {
            echo "hidden";
        }
        echo "' role='alert'>
             <a href='#' class='close alert_close' aria-label='close' title='close'>&times;</a>
             <div class='alert_message'>". $message ."</div>
             </div>";
    }
    
    public static function DisplayWarning($message = null, $isHidden = true) {
        echo "<div id='warning_container' class='alert alert-warning alert-dismissible "; 
        if($isHidden == true) {
            echo "hidden";
        }
        echo "' role='alert'>
             <div class='warning_message'>". $message ."</div>
             </div>";
    }
}
