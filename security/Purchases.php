<?php
    include_once("Connection.php");
    class CarritoCommand{
        private $product;
        private $price;
        private $picture;
        private $user;

        public function __construct($product, $price, $picture, $user)
        {
            $this->product = $product;
            $this->price = $price;
            $this->picture = $picture;
            $this->user = $user;
        }

        public function execute() {
            try {
                // Intenta ejecutar la operación de base de datos
                $conexion = Conexion::getInstance()->getConexion();
                $consulta = "INSERT INTO carrito (Usu_Car, Pro_Car, Pre_Car, Ima_Car) VALUES (?, ?, ?, ?)";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute([$this->user, $this->product, $this->price, $this->picture]);
            } catch (PDOException $e) {
                // Maneja la excepción específica de la base de datos
                error_log("Error en la base de datos: " . $e->getMessage());
                
                throw new Exception("Error al procesar la solicitud en la base de datos.");
        
            }
        }
    }
?>