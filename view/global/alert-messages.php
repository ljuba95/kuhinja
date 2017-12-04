<?php
use common\lib\SessionHelper;

foreach (['success', 'info', 'warning', 'danger'] as $messageType) {
    if ($message = SessionHelper::getFlashMessage($messageType)) {
        ?>
        <p class="alert alert-<?= $messageType ?>"><?= $message ?> <a href="#" class="close" data-dismiss="alert"
                                                                      aria-label="close">&times;</a>
        </p>
    <?php }
} ?>
<br>
