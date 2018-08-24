<?php
if (! empty($u->getSess("message"))) {
    ?>
<div
    class="display-message-foundation <?php
    if (! empty($u->getSess("message-type"))) {
        echo $u->getSess("message-type");
    } else {
        echo "display-success";
    }
    ?>">
    <span class="btn-message-close"
        onclick="this.parentElement.style.display='none';" title="Close">&times;</span>
    <span><?php $u->echoRSess("message"); ?></span>
</div>
<?php
}
?>