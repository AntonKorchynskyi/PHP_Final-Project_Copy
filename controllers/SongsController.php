<?php

    require_once("./models/SongModel.php");
    require_once("./models/PlaylistModel.php");

    function index () {
        if (is_authorized()) {
            $songs = SongModel::findAll($_SESSION["user"]);

            render("songs/index", [
                "songs" => $songs,
                "title" => "Songs"
            ]);
        }
    }

    function _new () {
        if (is_authorized()) {
            $playlists = PlaylistModel::findAll($_SESSION["user"]);
    
            render("songs/new", [
                "title" => "New Song",
                "action" => "create",
                "playlists" => ($playlists ?? [])
            ]);
        }
    }

    function edit ($request) {
        if (is_authorized()) {
            if (!isset($request["params"]["id"])) {
                return redirect("", ["errors" => "Missing required ID parameter"]);
            }
    
            $song = SongModel::find($request["params"]["id"], $_SESSION["user"]);
            if (!$song) {
                return redirect("", ["errors" => "Song does not exist"]);
            }
    
            $playlists = PlaylistModel::findAll($_SESSION["user"]);
    
            render("songs/edit", [
                "title" => "Edit Song",
                "song" => $song,
                "edit_mode" => true,
                "action" => "update",
                "playlists" => ($playlists ?? [])
            ]);
        }
    }

    function create () {
        if (!is_authorized()) return;

        // Validate field requirements
        validate($_POST, "songs/new");
        
        // Write to database if good
        SongModel::create($_POST, $_SESSION["user"]);

        redirect("", ["success" => "Song was created successfully"]);
    }

    function update () {
        if (!is_authorized()) return;

        // Missing ID
        if (!isset($_POST['id'])) {
            return redirect("songs", ["errors" => "Missing required ID parameter"]);
        }

        // Validate field requirements
        validate($_POST, "songs/edit/{$_POST['id']}");

        // Write to database if good
        SongModel::update($_POST, $_SESSION["user"]);
        redirect("", ["success" => "Song was updated successfully"]);
    }

    function delete ($request) {
        if (!is_authorized()) return;

        // Missing ID
        if (!isset($request["params"]["id"])) {
            return redirect("songs", ["errors" => "Missing required ID parameter"]);
        }

        SongModel::delete($request["params"]["id"], $_SESSION["user"]);

        redirect("", ["success" => "Song was deleted successfully"]);
    }

    function validate ($package, $error_redirect_path) {
        $fields = ["name", "singer", "release_date", "genre", "playlist_id"];
        $errors = [];

        // No empty fields
        foreach ($fields as $field) {
            if (empty($package[$field])) {
                $humanize = ucwords(str_replace("_", " ", $field));
                $errors[] = "{$humanize} cannot be empty";
            }
        }

        // Release date must be in the past or today
        if (strtotime($package["release_date"]) > strtotime("now")) {
            $errors[]= "Release date must be in the past or today";
        }

        if (count($errors)) {
            return redirect($error_redirect_path, ["form_fields" => $package, "errors" => $errors]);
        }
    }

    function is_authorized () {
        if (session_status() === PHP_SESSION_NONE) session_start();

        if(!isset($_SESSION["user"])) {
            return redirect("login", ["errors" => "You must be logged in to access this"]);
        }

        return true;
    }

?>