<?php if ($messages) { ?>
<div class="container">
    <div class="row">
        <?php
            foreach ($messages as $info) { ?>
        <div class="alert alert-<?= $info['type'] ?>" role="alert">
            <?= $info['info'] ?>
        </div>
        <?php } ?>
    </div>
</div>
<?php } ?>