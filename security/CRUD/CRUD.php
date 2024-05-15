<?php
    include_once("../../pages/loginError.php");
    class CRUD{
        public static function checkUser($user, $password){
            $error='El usuario no existe';
            try{
                $pdo=Connection::getInstance()->getConnection();
                $query = "SELECT users.*, cart.quantity, cart.cartID FROM users LEFT JOIN cart ON  cart.user = users.user WHERE BINARY users.user = ?";
                $statement = $pdo->prepare($query);
                $statement->execute([$user]);
                $data = $statement->fetch();
            } catch (PDOException $e) {
                loginError($error);
            }
            if ($data !== false) {
                if (password_verify($password, $data['password'])) {
                    $_SESSION['user'] = $data['user'];
                    $_SESSION['role'] = $data['role'];
                    $_SESSION['email'] = $data['email'];
                    $_SESSION['cart'] = $data['quantity'];
                    $_SESSION['cartID'] = $data['cartID'];
                    $_SESSION['picture'] = base64_encode($data['picture']);
                    header('location: ../../index.php');
                    exit();
                } else {
                    $error = 'La contraseña es incorrecta';
                }
            } else {
                $error = 'El usuario:'.$user.', no está registrado';
            }
            loginError($error);
        }

        public static function insertUser($user, $password, $email, $phone, $role){
            $error='';
            $pdo=Connection::getInstance()->getConnection();
            $query="SELECT * FROM users WHERE user=?;";
            $statement=$pdo->prepare($query);
            $statement->execute([$user]);
            $existingUser=$statement->fetch();
            $path='../../assets/img/others/default.png';
            if ($existingUser === false) {
                $pdo->beginTransaction();
                $query="INSERT INTO users SET user=?, email=?, password=?, phone=?, role=?, picture=?, isBlocked=?";
                $statement=$pdo->prepare($query);
                $password=password_hash($password, PASSWORD_DEFAULT);
                $statement->execute([$user, $email, $password, $phone, $role, file_get_contents($path),0]);
                $pdo->commit();
                $query="INSERT INTO cart SET quantity=?, totalPrice=?, user=?";
                $statement=$pdo->prepare($query);
                $statement->execute([0,0, $user]);
                header('location: ../../pages/users.php');
                exit();
            } else {
                if($existingUser['email']==$email){
                    $error='El correo electrónico '.$email.' ya existe';
                }else{
                    $error='El usuario '.$user.' ya existe';
                }
                loginError($error);
            }
        }

        public static function updatePicture($userID){
            if (isset($_FILES['imagen'])) {
                $imagen = $_FILES['imagen'];
            
                // Verificar si no hubo errores al subir la imagen
                if ($imagen['error'] == 0) {
                    $nombre_imagen = $imagen['name'];
                    $ruta_temporal = $imagen['tmp_name'];
                    $tipo_imagen = $imagen['type'];
            
                    // Insertar la imagen en la base de datos
                    $pdo=Connection::getInstance()->getConnection();
                    $query="UPDATE users SET picture=? WHERE user='$userID'";
                    $stmt=$pdo->prepare($query);
                    $stmt->bind_param("b", NULL);
                    $stmt->send_long_data(0, file_get_contents($ruta_temporal));
                    $stmt->execute();
                    $_SESSION['picture'] = base64_encode($imagen);
            
                    echo "Imagen subida correctamente";
                } else {
                    echo "Error al subir la imagen: " . $imagen['error'];
                }

                header('location: ../../pages/account.php');
            }
        }

        public static function updateUser($user, $role){
            $pdo=Connection::getInstance()->getConnection();
            $query="UPDATE users SET role=? WHERE user=?";
            $statement=$pdo->prepare($query);
            $statement->execute([$role,$user]);
        }

        public static function deleteUser($user){
            $pdo=Connection::getInstance()->getConnection();
            $query="DELETE FROM users WHERE user=?";
            $statement=$pdo->prepare($query);
            $statement->execute([$user]);
        }
    }
?>