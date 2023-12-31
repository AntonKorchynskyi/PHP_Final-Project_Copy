<?php
    // Convert playlist object into form_fields associative array ONLY if form_fields are not set
    $form_fields = $form_fields ?? [];
    if (count($form_fields) === 0 && isset($playlist)) $form_fields = (array) $playlist;
?>

<form action="<?= ROOT_PATH ?>/playlists/<?= $action ?>" method="post">
    <?php if ($action === "update"): ?>
        <input type="hidden" name="id" value="<?= $form_fields["id"] ?>">
    <?php endif ?>

    <div class="form-group my-3">
        <label for="name">Name</label>
        <input class="form-control" type="text" name="name" value="<?= $form_fields["name"] ?? "" ?>">
    </div>

    <div>
        <button class="btn btn-primary">Submit</button>
    </div>
</form>