<div class="container">
    <h1><?= $title ?></h1>
    <?php if (isset($playlists) && count($playlists) > 0): ?>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($playlists as $playlist): ?>
                <tr>
                    <td><?= $playlist->name ?></td>
                    <td>
                        <a class="btn btn-warning" href="<?= ROOT_PATH ?>/playlists/edit/<?= $playlist->id ?>">edit</a>
                        <a class="btn btn-danger" href="<?= ROOT_PATH ?>/playlists/delete/<?= $playlist->id ?>" onclick="return confirm('Are you sure you want to delete this playlist?')">delete</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    <?php endif ?>
</div>