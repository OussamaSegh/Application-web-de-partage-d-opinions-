<?php


/*
-- Author : SEGHAIER Oussama 
*/


/*
Use this class to get the PDO object and close it.

Typical use :
$pdo = DBConfig::openConnection();
...... 
...... 
...... 
DBConfig::closeConnection($pdo);
*/

// TODO : add the table names as static var
class DBConfig
{
        private static $server = "localhost";
        private static $admin = "root";
        private static $admin_password = "";
        private static $bd = "LAMP_DB";

        // Open connection
        public static function openConnection()
        {
                try {
                        $pdo = new PDO(
                                "mysql:host=" . self::$server . ";dbname=" . self::$bd,
                                self::$admin,
                                self::$admin_password,
                                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
                        );
                } catch (PDOException $e) {
                        die("Error handled : " . $e->getMessage());
                }
                return $pdo;
        }

        // Close connection
        public static function closeConnection($pdo)
        {
                if ($pdo) {
                        $pdo = NULL;
                }
        }
}
?>