<?php

    require_once("./models/UserModel.php");

    function register () {
        render("users/register", ["title" => "Register"]);
    }

    function login () {
        render("users/login", ["title" => "Login"]);
    }

    function create () {
        validate($_POST, "register");

        $_POST = sanitize($_POST);

        UserModel::create($_POST);

        redirect("login", ["success" => "You have registered successfully"]);
    }

    function authenticate () {
        if (empty($_POST["email"]) || empty($_POST["password"])) {
            redirect("login", ["errors" => "You must provide an email and password"]);
        }

        $user = UserModel::find($_POST["email"]);

        if (!$user) {
            redirect("login", ["errors" => "You must provide a right email and password"]);
        }

        if (password_verify($_POST["password"], $user->password)) {
            if (session_status() === PHP_SESSION_NONE) session_start();

            unset($user->password);
            $_SESSION["user"] = (array)$user;

            return redirect("", ["success" => "You have logged in successfully"]);
        }

        redirect("login", ["errors" => "You must provide an email and password. Something went wrong"]);
    }

    function logout () {
        if (session_status() === PHP_SESSION_NONE) session_start();

        unset($_SESSION["user"]);
        redirect("", ["success" => "You have been logged out"]);
    }

    function validate ($package, $error_redirect_path) {
        $fields = ["name", "email", "email_confirmation", "password", "password_confirmation"];
        $errors = [];

        // No empty fields
        foreach ($fields as $field) {
            if (empty($package[$field])) {
                $humanize = ucwords(str_replace("_", " ", $field));
                $errors[] = "{$humanize} cannot be empty";
            }
        }

        // New user error checks
        if ($package["email"] !== $package["email_confirmation"]) {
            $errors[]= "Your email must match the email confirmation";
        }

        if ($package["password"] !== $package["password_confirmation"]) {
            $errors[]= "Your password must match the password confirmation";
        }

        if (count($errors)) {
            unset($package["password"]);
            unset($package["password_confirmation"]);

            return redirect($error_redirect_path, ["form_fields" => $package, "errors" => $errors]);
        }
    }

    function sanitize ($package) {
        $package["email"] = filter_var($package["email"], FILTER_SANITIZE_EMAIL);

        $package["name"] = htmlspecialchars($package["name"]);

        $package["password"] = password_hash($package["password"], PASSWORD_DEFAULT);

        return $package;
    }

?>