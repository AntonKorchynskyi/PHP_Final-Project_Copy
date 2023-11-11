 <?php

    require_once("./models/PlaylistModel.php");

    function index () {
        if (!is_authorized()) return;
        $playlists = PlaylistModel::findAll($_SESSION["user"]);

        render("playlists/index", [
            "playlists" => $playlists,
            "title" => "Playlists"
        ]);
    }

    function _new () {
        if (!is_authorized()) return;
        render("playlists/new", [
            "title" => "New Playlist",
            "action" => "create"
        ]);
    }

    function edit ($request) {
        if (!is_authorized()) return;
        if (!isset($request["params"]["id"])) {
            return redirect("", ["errors" => "Missing required ID parameter"]);
        }

        $playlist = PlaylistModel::find($request["params"]["id"], $_SESSION["user"]);
        if (!$playlist) {
            return redirect("", ["errors" => "Playlist does not exist"]);
        }

        render("playlists/edit", [
            "title" => "Edit Playlist",
            "playlist" => $playlist,
            "edit_mode" => true,
            "action" => "update"
        ]);
    }

    function create () {
        if (!is_authorized()) return;
        // Validate field requirements
        validate($_POST, "playlists/new");
        
        // Write to database if good
        PlaylistModel::create($_POST, $_SESSION["user"]);

        redirect("playlists", ["success" => "Playlist was created successfully"]);
    }

    function update () {
        if (!is_authorized()) return;
        // Missing ID
        if (!isset($_POST['id'])) {
            return redirect("playlists", ["errors" => "Missing required ID parameter"]);
        }

        // Validate field requirements
        validate($_POST, "playlists/edit/{$_POST['id']}");

        // Write to database if good
        PlaylistModel::update($_POST, $_SESSION["user"]);
        redirect("playlists", ["success" => "Playlist was updated successfully"]);
    }

    function delete ($request) {
        if (!is_authorized()) return;
        // Missing ID
        if (!isset($request["params"]["id"])) {
            return redirect("playlists", ["errors" => "Missing required ID parameter"]);
        }

        PlaylistModel::delete($request["params"]["id"], $_SESSION["user"]);

        redirect("playlists", ["success" => "Playlist was deleted successfully"]);
    }

    function validate ($package, $error_redirect_path) {
        $fields = ["name"];
        $errors = [];

        // No empty fields
        foreach ($fields as $field) {
            if (empty($package[$field])) {
                $humanize = ucwords(str_replace("_", " ", $field));
                $errors[] = "{$humanize} cannot be empty";
            }
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