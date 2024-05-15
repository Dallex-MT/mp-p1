<?php
    class Connection{

        private static $instance;
        private $conn;

        private function __construct(){
            $host = "localhost";
            $user = "root";
            $password = "";
            $database = "mirandaproyecto";

            try {
                $dsn = "mysql:host=$host; dbname=$database;charset=utf8mb4"; // Añadir codificación
                $this->conn = new PDO($dsn, $user, $password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                // En producción, considera registrar este error en lugar de mostrarlo
                die("Error al conectar a la base de datos: " . $e->getMessage());
            }
        }

        public static function getInstance(){
            if(!self::$instance){
                self::$instance = new Connection();
            }
            return self::$instance;
        }

        public function getConnection(){
            return $this -> conn;
        }
    }
?>