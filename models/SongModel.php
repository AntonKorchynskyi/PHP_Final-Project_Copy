<?php

    class SongModel {

        private static $_table = "songs";

        public static function findAll ($user) {
            $table = self::$_table;
            $conn = get_connection();
            $sql = "SELECT
                    songs.id, songs.name, songs.singer, songs.release_date, songs.genre, playlists.name as playlist
                FROM {$table}
                JOIN playlists ON songs.playlist_id = playlists.id
                WHERE songs.user_id = {$user['id']} AND playlists.user_id = {$user['id']}";

            $songs = $conn->query($sql)->fetchAll(PDO::FETCH_OBJ);
            $conn = null;
            return $songs;
        }

        public static function find ($id, $user) {
            $table = self::$_table;
            $conn = get_connection();
            $sql = "SELECT
                songs.id, songs.name, songs.singer, songs.release_date, songs.genre, songs.playlist_id, playlists.name as playlist 
            FROM {$table}
            JOIN playlists ON songs.playlist_id = playlists.id
            WHERE songs.id = :id AND songs.user_id = {$user['id']} AND playlists.user_id = {$user['id']}";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();

            $song = $stmt->fetch(PDO::FETCH_OBJ);
            $conn = null;
            return $song;
        }

        public static function create ($package, $user) {
            $table = self::$_table;
            $conn = get_connection();
            $sql = "INSERT INTO {$table} (
                name,
                singer,
                release_date,
                genre, 
                playlist_id,
                user_id
            ) VALUES (
                :name,
                :singer,
                :release_date,
                :genre,
                :playlist_id,
                :user_id
            )";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":name", $package["name"], PDO::PARAM_STR);
            $stmt->bindParam(":singer", $package["singer"], PDO::PARAM_STR);
            $stmt->bindParam(":release_date", $package["release_date"], PDO::PARAM_STR);
            $stmt->bindParam(":genre", $package["genre"], PDO::PARAM_STR);
            $stmt->bindParam(":playlist_id", $package["playlist_id"], PDO::PARAM_INT);
            $stmt->bindParam(":user_id", $user["id"], PDO::PARAM_INT);

            $stmt->execute();
            $conn = null;
        }

        public static function update ($package, $user) {
            $table = self::$_table;
            $conn = get_connection();
            $sql = "UPDATE {$table} SET
                name = :name,
                singer = :singer,
                release_date = :release_date,
                genre = :genre,
                playlist_id = :playlist_id
            WHERE id = :id AND user_id = {$user['id']}";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":name", $package['name'], PDO::PARAM_STR);
            $stmt->bindParam(":singer", $package['singer'], PDO::PARAM_STR);
            $stmt->bindParam(":release_date", $package['release_date'], PDO::PARAM_STR);
            $stmt->bindParam(":genre", $package['genre'], PDO::PARAM_STR);
            $stmt->bindParam(":playlist_id", $package['playlist_id'], PDO::PARAM_INT);
            $stmt->bindParam(":id", $package['id'], PDO::PARAM_INT);
            
            $stmt->execute();
            $conn = null;
        }

        public static function delete ($id, $user) {
            $table = self::$_table;
            $conn = get_connection();
            $sql = "DELETE FROM {$table} WHERE id = :id AND user_id = {$user['id']}";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);

            $stmt->execute();
            $conn = null;
        }

    }

?>