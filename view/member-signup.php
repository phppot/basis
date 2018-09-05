<?php
use \PhpPot\Common\Config;
require_once './view/common/require.php';
?>
<html>
<head>
<?php require_once './view/common/html-head.php';?>
<title>Signup - <?php $u->xecho(Config::APP_NAME); ?></title>
<link href="<?php $u->xecho(Config::WORK_ROOT); ?>view/css/style.css"
    rel="stylesheet" type="text/css" />
<link href="<?php $u->xecho(Config::WORK_ROOT);?>view/css/register.css"
    rel="stylesheet" type="text/css" />
</head>
<body>
<?php require_once "common/header.php"; ?>
        <div class="content login-register-container">
        <div class="login-box">
            <form name="frmRegister" class="form-login" action=""
                method="POST" onsubmit="return validation();">
                <h1 class="text-center clear-float">Member Sign Up</h1>
                <div id="error_info"
                    <?php
                    if (isset($success)) {
                        ?>
                    class="success text-center"
                    <?php
                    }
                    ?>
                    class="error text-center">&nbsp;<?php
                    if (isset($message)) {
                        $u->xecho($message);
                    } elseif (isset($emailstatus)) {
                        $u->xecho($emailstatus);
                    } elseif (isset($success)) {
                        $u->xecho($success);
                    }
                    ?></div>
                <div class="form-row">
                    <div class="form-label">Name</div>
                    <div class="form-element">
                        <input type="text" name="signup-name"
                            id="signup-username">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-label">Email</div>
                    <div class="form-element">
                        <input type="text" name="signup-email"
                            id="signup-email">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-label">Password</div>
                    <div class="form-element">
                        <input type="password" name="signup-password"
                            id="signup-password">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-label">Confirm Password</div>
                    <div class="form-element">
                        <input type="password" name="confirm-password"
                            id="confirm-password">
                    </div>
                </div>
                <div class="form-row float-clear">
                    <div class="form-element text-center">
                        <input type="submit" name="register"
                            value="Sign up" class="btn theme-color">
                    </div>
                </div>
                <div class="text-center">
                    <div class="signup-agree">
                        By Sign up, you agree to our <a href="">Terms</a>
                        and <a href="">Privacy Policy</a>.
                    </div>
                    <div class="already">
                        Already have an account? <a href="">Log in</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- container ends -->
<?php require_once "common/footer.php"; ?>
</body>
<script
    src="<?php $u->xecho(Config::WORK_ROOT); ?>vendor/components/jquery/jquery.min.js"></script>
<script>
function validation() {
    var valid=true;
    var Email = $('#signup-email').val();
    var Password = $('#signup-password').val();
    var ConfirmPassword = $('#confirm-password').val();
    $("#error_info").html("");
    var emailRegex = /^[a-zA-Z0-9.!#$%&*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;
    var passwordregex = /^(?=.*[0-9]+.*)[A-Za-z\d$@$!%*#?&]{8,}$/;
    if(!emailRegex.test(Email)) {
        $("#error_info").html("Invalid email address.").show();
        valid=false;
    }
    if(Password != ConfirmPassword){
        $("#error_info").html("Both password must be same.").show();
        valid=false;
    }
    if(!passwordregex.test(Password)){
        $("#error_info").html("Password must contain ateast 1 number and length atleast 8 .").show();
        valid=false;
    }
    if(Email=="" || Password=="" || ConfirmPassword==""){
        $("#error_info").html("All fields are Required.").show();
        valid=false;
        }
    return valid;
    }
</script>
</html>