<?php
    // Convert playlist object into form_fields associative array ONLY if form_fields are not set
    $form_fields = $form_fields ?? [];
    if (count($form_fields) === 0 && isset($song)) $form_fields = (array) $song;
?>

<?php if ($playlists && count($playlists) > 0): ?>
<form action="<?= ROOT_PATH ?>/songs/<?= $action ?>" method="post">
    <?php if ($action === "update"): ?>
        <input type="hidden" name="id" value="<?= $form_fields["id"] ?>">
    <?php endif ?>

    <div class="form-group my-3">
        <label for="name">Name</label>
        <input class="form-control" type="text" name="name" value="<?= $form_fields["name"] ?? "" ?>">
    </div>

    <div class="form-group my-3">
        <label for="singer">Singer</label>
        <input class="form-control" type="text" name="singer" value="<?= $form_fields["singer"] ?? "" ?>">
    </div>

    <div class="form-group my-3">
        <label for="release_date">Release Date</label>
        <input class="form-control" type="datetime-local" name="release_date" value="<?= $form_fields["release_date"] ?? "" ?>">
    </div>

    <div class="form-group my-3">
        <label for="genre">Genre</label>
        <input class="form-control" type="text" name="genre" value="<?= $form_fields["genre"] ?? "" ?>">
    </div>

    <div class="form-group my-3">
        <label for="playlist_id">Playlist</label>
        <select class="form-select" name="playlist_id">
            <option value="" selected>Choose a playlist...</option>
            <?php foreach ($playlists as $playlist): ?>
                <?php
                    $selected = (isset($form_fields["playlist_id"]) && $form_fields["playlist_id"] == $playlist->id) ? "selected" : "";
                ?>

                <option value="<?= $playlist->id ?>" <?= $selected ?>>
                    <?= $playlist->name ?>
                </option>
            <?php endforeach ?>
        </select>
    </div>

    <div>
        <button class="btn btn-primary">Submit</button>
    </div>
</form>
<?php else: ?>
    <p class="alert alert-warning">
        You need to add a playlist first.<br>
        <a href="<?= ROOT_PATH ?>/playlists/new">New Playlist</a>
    </p>
<?php endif ?>