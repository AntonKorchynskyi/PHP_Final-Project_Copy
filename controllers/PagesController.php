<?php

    require_once("./models/ContactFormModel.php");
    

    function index () {
        render("pages/index", [
            "title" => "The Playlists Application"
        ]);
    }

    function aboutUs () {
        render("pages/about_us", [
            "title" => "About Us"
        ]);
    }

    function contactUs () {
        if (session_status() === PHP_SESSION_NONE) session_start();
        if (isset($_SESSION["user"])) {
            $name = $_SESSION["user"]["name"];
            $email = $_SESSION["user"]["email"];
        }
        render("pages/contact_us", [
            "title" => "Contact Us",
            "name" => $name ?? "User",
            "email" => $email ?? ""
        ]);
    }

    function processMessage () {

        if (session_status() === PHP_SESSION_NONE) session_start();

        if (empty($_POST["message"])) {
            redirect("pages/contact-us", ["errors" => "You must provide not an empty message"]);
        }

        ContactFormModel::create($_POST, $_SESSION["user"]);

        redirect("pages/contact-us", ["success" => "You have sent a message successfully"]);
    }

?>