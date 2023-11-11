<?php

    /**
     * Routes are responsible for matching a requested path
     * with a controller and an action. The controller represents
     * a collection of functions you want associated, usually, with
     * a resource. The action is the specific function you want to call.
     */

    $routes = [
        "get" => [
            [
                "pattern" => "/",
                "controller" => "PagesController",
                "action" => "index"
            ],
            [
                "pattern" => "/pages/about-us",
                "controller" => "PagesController",
                "action" => "aboutUs"
            ],
            [
                "pattern" => "/pages/contact-us",
                "controller" => "PagesController",
                "action" => "contactUs"
            ],
            [
                "pattern" => "/songs",
                "controller" => "SongsController",
                "action" => "index"
            ],
            [
                "pattern" => "/songs/new",
                "controller" => "SongsController",
                "action" => "_new"
            ],
            [
                "pattern" => "/songs/:id",
                "controller" => "SongsController",
                "action" => "show"
            ],
            [
                "pattern" => "/songs/edit/:id",
                "controller" => "SongsController",
                "action" => "edit"
            ],
            [
                "pattern" => "/songs/delete/:id",
                "controller" => "SongsController",
                "action" => "delete"
            ],
            [
                "pattern" => "/playlists",
                "controller" => "PlaylistsController",
                "action" => "index"
            ],
            [
                "pattern" => "/playlists/new",
                "controller" => "PlaylistsController",
                "action" => "_new"
            ],
            [
                "pattern" => "/playlists/:id",
                "controller" => "PlaylistsController",
                "action" => "show"
            ],
            [
                "pattern" => "/playlists/edit/:id",
                "controller" => "PlaylistsController",
                "action" => "edit"
            ],
            [
                "pattern" => "/playlists/delete/:id",
                "controller" => "PlaylistsController",
                "action" => "delete"
            ],
            [
                "pattern" => "/register",
                "controller" => "UsersController",
                "action" => "register"
            ],
            [
                "pattern" => "/login",
                "controller" => "UsersController",
                "action" => "login"
            ],
            [
                "pattern" => "/logout",
                "controller" => "UsersController",
                "action" => "logout"
            ],
        ],
        "post" => [
            [
                "pattern" => "/songs/create",
                "controller" => "SongsController",
                "action" => "create"
            ],
            [
                "pattern" => "/songs/update",
                "controller" => "SongsController",
                "action" => "update"
            ],
            [
                "pattern" => "/playlists/create",
                "controller" => "PlaylistsController",
                "action" => "create"
            ],
            [
                "pattern" => "/playlists/update",
                "controller" => "PlaylistsController",
                "action" => "update"
            ],
            [
                "pattern" => "/users/create",
                "controller" => "UsersController",
                "action" => "create"
            ],
            [
                "pattern" => "/authenticate",
                "controller" => "UsersController",
                "action" => "authenticate"
            ],
            [
                "pattern" => "/pages/contact-us",
                "controller" => "PagesController",
                "action" => "processMessage"
            ]
        ]
    ];

?>