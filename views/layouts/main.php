<?php
    if (session_status() === PHP_SESSION_NONE) session_start();
    $auth = isset($_SESSION["user"]);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous" defer></script>
    <link rel="stylesheet" href="<?= ROOT_PATH ?>/styles/style.css">
    <title><?= $title ?></title>
</head>

<body id="<?= $override_id ?? "main" ?>">
    <!-- Simple notification check for errors -->
    <?php if (isset($errors)): ?>
        <div class="alert alert-danger">
            <?php
                if (is_string($errors)) {
                    echo "<p>$errors</p>";
                } else {
                    foreach ($errors as $error) echo "<p>$error</p>";
                }
            ?>
        </div>
    <?php endif ?>

    <!-- Simple notification check for successes -->
    <?php if (isset($success)): ?>
        <div class="alert alert-success">
            <?php
                if (is_string($success)) {
                    echo "<p>$success</p>";
                } else {
                    foreach ($success as $s) echo "<p>$s</p>";
                }
            ?>
        </div>
    <?php endif ?>

    <!-- Global navigation -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= ROOT_PATH ?>">
                The Playlists Application
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <?php if ($auth): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Playlists
                            </a>

                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="<?= ROOT_PATH ?>/playlists/new">New</a></li>
                                <li><a class="dropdown-item" href="<?= ROOT_PATH ?>/playlists">List</a></li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Songs
                            </a>

                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="<?= ROOT_PATH ?>/songs/new">New</a></li>
                                <li><a class="dropdown-item" href="<?= ROOT_PATH ?>/songs">List</a></li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link" href="<?= ROOT_PATH ?>/pages/about-us" role="button">
                                About Us
                            </a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link" href="<?= ROOT_PATH ?>/pages/contact-us" role="button">
                                Contact Us
                            </a>
                        </li>

                        <li class="nav-item">
                            <a onclick="return confirm('Are you sure you are ready to log out?')" class="nav-link" href="<?= ROOT_PATH ?>/logout">Logout</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= ROOT_PATH ?>/register">Register</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="<?= ROOT_PATH ?>/login">Login</a>
                        </li>
                    <?php endif ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- View specific output -->
    <?= $yield ?? null ?>
</body>

</html>

<style>

body {
    background-image: linear-gradient(to right top, #bd07c7, #ff007d, #ff5c2b, #f6ae00, #a8eb12);
}

.container-md {
    width: 80%;
}

 p {
    font-size: 2rem;
}
</style>
