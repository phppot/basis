<?php
use \PhpPot\Common\Config;
?>
<div class="header-foundation full-width">
    <div id="header" class="full-width">
        <div class="content-margin">
            <a href='<?php $u->xecho(Config::WORK_ROOT); ?>'
                class="txtlogo"> <img
                src="<?php $u->xecho(Config::WORK_ROOT); ?>view/img/logo.png">
            </a>
            <div class="float-right">
                <ul class="main-menu" id="main-menu">
<?php
$sessMemberId = $this->u->getSess("member_id");
if (! isset($sessMemberId)) {
    // this if condition is for not loggedin user.
    ?>
            <li class="main-menu-item"><a
                        href='<?php $u->xecho(Config::WORK_ROOT); ?>login/'><div
                                class="highlight login header-font">Log
                                in</div></a></li>
                             <?php
    if (! empty($appProperty) && $appProperty[0]["disable_signup"] != "1") {
        ?>
                    <li class="main-menu-item"><a
                        href='<?php $u->xecho(Config::WORK_ROOT); ?>signup/'>
                            <div class="highlight signup header-font">Sign
                                Up</div>
                    </a></li>
                          <?php }?>
<?php } ?>
                </ul>
            </div>
            <!--  header-right-menu  ends -->
        </div>
    </div>
    <!-- header-div ends -->
    <div class="sub-header">
        <div class="margin-zero-auto">
            <div class="page-heading"><?php
            if (! empty($page_heading)) {
                $u->xecho($page_heading);
            }
            ?>
            </div>
        </div>
    </div>
    <!-- sub-header-div ends -->
</div>
<!-- header-foundation-div ends -->