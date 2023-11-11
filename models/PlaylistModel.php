<?php

    class PlaylistModel {

        private static $_table = "playlists";

        public static function findAll ($user) {
            $table = self::$_table;
            $conn = get_connection();
            $sql = "SELECT * FROM {$table} WHERE user_id = {$user['id']}";

            $playlists = $conn->query($sql)->fetchAll(PDO::FETCH_OBJ);
            $conn = null;
            return $playlists;
        }

        public static function find ($id, $user) {
            $table = self::$_table;
            $conn = get_connection();
            $sql = "SELECT * FROM {$table} WHERE id = :id AND user_id = {$user['id']}";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();

            $playlist = $stmt->fetch(PDO::FETCH_OBJ);
            $conn = null;
            return $playlist;
        }

        public static function create ($package, $user) {
            $table = self::$_table;
            $conn = get_connection();
            $sql = "INSERT INTO {$table} (
                name,
                user_id
            ) VALUES (
                :name,
                :user_id
            )";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":name", $package["name"], PDO::PARAM_STR);
            $stmt->bindParam(":user_id", $user["id"], PDO::PARAM_INT);

            $stmt->execute();
            $conn = null;
        }

        public static function update ($package, $user) {
            $table = self::$_table;
            $conn = get_connection();
            $sql = "UPDATE {$table} SET
                name = :name
            WHERE id = :id AND user_id = {$user['id']}";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":name", $package['name'], PDO::PARAM_STR);
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