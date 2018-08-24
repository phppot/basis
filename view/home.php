<?php
use \PhpPot\Common\Config;
require_once './view/common/require.php';
?>
<!DOCTYPE html>
<html>
<head>
<?php require_once './view/common/html-head.php';?>
<link href="<?php $u->xecho(Config::WORK_ROOT);?>view/css/style.css"
    rel="stylesheet" type="text/css" />
<link href="<?php $u->xecho(Config::WORK_ROOT);?>view/css/home.css"
    rel="stylesheet" type="text/css" />    
<title>Home - <?php $u->xecho(Config::APP_NAME); ?></title>
</head>
<body>
<?php
require_once "./view/common/header.php";
?>
    <div class="content-foundation">
        <div class="welcome-panel full-width">
            <div class="layout-width">
                <h1 class="welcome-title">Welcome to <?php $u->xecho(Config::APP_NAME); ?>!</h1>
                <p class="welcome-desc">A PHP model application to learn
                    Model View Controller (MVC) architecture and its
                    implementation in PHP. This can also be used as a
                    template to start developing a web application
                    quickly.</p>
            </div>
        </div>
<?php
include "./view/common/footer.php";
?>
</div>
</body>
</html>