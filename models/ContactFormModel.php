<?php
    class ContactFormModel {
        
        private static $_table = "contact_form";

        public static function create ($package, $user) {
            $table = self::$_table;
            $conn = get_connection();
            $sql = "INSERT INTO {$table} (
                message,
                user_id
            ) VALUES (
                :message,
                :user_id
            )";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":message", $package["message"], PDO::PARAM_STR);
            $stmt->bindParam(":user_id", $user["id"], PDO::PARAM_INT);

            $stmt->execute();
            $conn = null;
        }
    } 