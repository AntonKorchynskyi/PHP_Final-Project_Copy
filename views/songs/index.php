<div class="container">
    <h1><?= $title ?></h1>

    <?php if (isset($songs) && count($songs) > 0): ?>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Singer</th>
                <th>Release Year</th>
                <th>Genre</th>
                <th>Playlist</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($songs as $song): ?>
                <tr>
                    <td><?= $song->name ?></td>
                    <td><?= $song->singer ?></td>
                    <td><?= $song->release_date ?></td>
                    <td><?= $song->genre ?></td>
                    <td><?= $song->playlist ?></td>
                    <td>
                        <a class="btn btn-warning" href="<?= ROOT_PATH ?>/songs/edit/<?= $song->id ?>">edit</a>
                        <a class="btn btn-danger" href="<?= ROOT_PATH ?>/songs/delete/<?= $song->id ?>" onclick="return confirm('Are you sure you want to delete this song?')">delete</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    <?php endif ?>
</div>