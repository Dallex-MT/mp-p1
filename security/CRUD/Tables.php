<?php
    include("C:/xampp/htdocs/MirandaProyecto/security/Connection.php");

    class Tables
    {
        public static function showUsers(){
            try {
                $Connection = Connection::getInstance()->getConnection();
                $consulta = "SELECT * FROM users";
                $resultado = $Connection->prepare($consulta);
                $resultado->execute();
                $dato = $resultado->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                return;
            }

            $acum = 1;
            $informacion = '';

            foreach ($dato as $respuesta) {
                $usuario = htmlspecialchars($respuesta['user'], ENT_QUOTES, 'UTF-8');
                $email = htmlspecialchars($respuesta['email'], ENT_QUOTES, 'UTF-8');
                $telefono = htmlspecialchars($respuesta['phone'], ENT_QUOTES, 'UTF-8');
                $rol = htmlspecialchars(($respuesta['role']=== 'admin') ? 'Admin' : 'Cliente', ENT_QUOTES, 'UTF-8');

                $informacion .= '
                        <tr class="table-dark">
                            <td class="align-middle mdl-data-table__cell--non-numeric">' . $usuario . '</td>
                            <td class="align-middle mdl-data-table__cell--non-numeric">' . htmlspecialchars($respuesta['password']) . '</td>
                            <td class="align-middle mdl-data-table__cell--non-numeric">' . $email . '</td>
                            <td class="align-middle mdl-data-table__cell--non-numeric">' . $telefono . '</td>
                            <td class="align-middle mdl-data-table__cell--non-numeric">' . $rol . '</td>
                            <td class="align-middle mdl-data-table__cell">
                                <center>
                                    <button class="align-middle mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button--colored-teal editar">
                                        <i class="fas fa-pen"></i>Editar</button>
                                    <button class="align-middle mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button--colored-red eliminar" >
                                        <i class="fas fa-trash-alt"></i>Borrar</button>
                                </center>
                            </td>
                        </tr>
                    ';
            }
            return $informacion;
        }

        public static function showSales(){
            try {
                $Connection = Connection::getInstance()->getConnection();
                $consulta = "SELECT u.user, GROUP_CONCAT(pr.name SEPARATOR ', ') as product_names, p.totalPrice, p.purchDate FROM purchasesdetail pd JOIN purchases p ON pd.purchaseID = p.purchaseID JOIN products pr ON pd.productID = pr.productID JOIN users u ON p.userPurch = u.user GROUP BY p.purchaseID;";
                $resultado = $Connection->prepare($consulta);
                $resultado->execute();
                $dato = $resultado->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                return;
            }

            $acum = 1;
            $informacion = '';

            foreach ($dato as $respuesta) {
                $user = htmlspecialchars($respuesta['user'], ENT_QUOTES, 'UTF-8');
                $products = htmlspecialchars($respuesta['product_names'], ENT_QUOTES, 'UTF-8');
                $price = htmlspecialchars($respuesta['totalPrice'], ENT_QUOTES, 'UTF-8');
                $date = htmlspecialchars($respuesta['purchDate'], ENT_QUOTES, 'UTF-8');
                $informacion .= '
                        <tr>
                            <td class="align-middle mdl-data-table__cell--non-numeric">' . $user . '</td>
                            <td class="align-middle mdl-data-table__cell--non-numeric">' . $products . '</td>
                            <td class="align-middle mdl-data-table__cell--non-numeric">' . $price . '</td>
                            <td class="align-middle mdl-data-table__cell--non-numeric">' . $date . '</td>
                            <td class="align-middle mdl-data-table__cell">
                                <center>
                                    <button class="align-middle mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button--colored-teal editar">
                                        <i class="fas fa-pen"></i>Editar</button>
                                    <button class="align-middle mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button--colored-red eliminar" >
                                        <i class="fas fa-trash-alt"></i>Borrar
                                    </button>
                                </center>
                            </td>
                        </tr>
                    ';
            }
            return $informacion;
        }

        public static function showActivities($admin){
            try {
                $Connection = Connection::getInstance()->getConnection();
                $consulta = "SELECT * FROM todo WHERE user=:admin ORDER BY id ASC"; // Corrige las comillas y agrega un marcador de posición
                $resultado = $Connection->prepare($consulta);
                $resultado->bindParam(':admin', $admin, PDO::PARAM_STR); // Asigna el valor de $admin al marcador de posición
                $resultado->execute();
                $dato = $resultado->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                return FALSE;
            }

            $acum = 1;
            $informacion = '';

            foreach ($dato as $respuesta) {
                $activity = htmlspecialchars($respuesta['description'], ENT_QUOTES, 'UTF-8');
                $progress = '';
                switch (htmlspecialchars($respuesta['progress'], ENT_QUOTES, 'UTF-8')) {
                    case 'toStart':
                        $progress='Por Empezar';
                        break;
                    case 'doing':
                        $progress='Haciendo';
                        break;
                    
                    default:
                        $progress='Finalizada';
                        break;
                }
                $status = htmlspecialchars($respuesta['status'], ENT_QUOTES, 'UTF-8');
                $id = htmlspecialchars($respuesta['id'], ENT_QUOTES, 'UTF-8');
                if ($status) continue;
                $informacion .= '
                        <tr>
                            <td class="align-middle mdl-data-table__cell--non-numeric">' . $id . '</td>
                            <td class="align-middle mdl-data-table__cell--non-numeric">' . $activity . '</td>
                            <td class="align-middle mdl-data-table__cell--non-numeric">' . $progress . '</td>
                            <td class="align-middle mdl-data-table__cell">
                                <center>
                                    <button class="align-middle mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button--colored-teal editar">
                                        <i class="fas fa-pen"></i>Editar</button>
                                    <button class="align-middle mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button--colored-red eliminar" >
                                        <i class="fas fa-trash-alt"></i>Borrar
                                    </button>
                                </center>
                            </td>
                        </tr>
                    ';
            }
            return $informacion;
        }

        public static function showProducts(){
            try {
                $Connection = Connection::getInstance()->getConnection();
                $consulta = "SELECT * FROM products ORDER BY productID ASC";
                $resultado = $Connection->prepare($consulta);
                $resultado->execute();
                $dato = $resultado->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                return;
            }

            $acum = 0;
            $informacion = '';

            foreach ($dato as $respuesta) {
                $informacion .= '
                        <tr>
                            <td class="align-middle mdl-data-table__cell--non-numeric">' . htmlspecialchars($respuesta['productID']) . '</td>
                            <td class="align-middle mdl-data-table__cell--non-numeric">' . htmlspecialchars($respuesta['brand']) . '</td>
                            <td class="align-middle mdl-data-table__cell--non-numeric">' . htmlspecialchars($respuesta['name']) . '</td>
                            <td class="align-middle mdl-data-table__cell--non-numeric">' . htmlspecialchars($respuesta['color']) . '</td>
                            <td class="align-middle mdl-data-table__cell--non-numeric">' . htmlspecialchars($respuesta['size']) . ' US(men)</td>
                            <td class="align-middle mdl-data-table__cell--non-numeric">$ ' . htmlspecialchars($respuesta['price']) . '</td>
                            <td class="align-middle mdl-data-table__cell--non-numeric"><img src="data:image/jpeg;base64,' . base64_encode($respuesta['picture']) . '" alt="Producto"></img></td>
                            <td class="align-middle mdl-data-table__cell">
                                <center>
                                    <button class="align-middle mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button--colored-teal editar">
                                        <i class="fas fa-pen"></i>Editar
                                    </button> 
                                    <button class="align-middle mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button--colored-red eliminar">
                                        <i class="fas fa-trash-alt"></i>Borrar
                                    </button>
                                </center>
                            </td>
                        </tr>
                    ';
            }
            return $informacion;
        }

        public static function InsertarCompra($cliente, $subtotal, $total, $producto)
        {
            $fecha = date('Y-m-d');
            $Connection = Connection::getInstance()->getConnection();
            $consulta = "INSERT INTO compras (Cli_Com, Pre_Sub_Com, Pre_Tot_Com, Pro_Com, Fec_Com) VALUES(?, ?, ?, ?, ?)";
            $resultado = $Connection->prepare($consulta);
            $resultado->execute([$cliente, $subtotal, $total, $producto, $fecha]);
            header("location:../Paginas/Compras.php");
        }

        public static function ActualizarCompra($usuario, $subtotal, $total, $producto, $codigo)
        {
            $Connection = Connection::getInstance()->getConnection();
            $consulta = "UPDATE compras SET Cli_Com=?, Pre_Sub_Com=?, Pre_Tot_Com=?, Pro_Com=? WHERE Cod_Com=?";
            $resultado = $Connection->prepare($consulta);
            $resultado->execute([$usuario, $subtotal, $total, $producto, $codigo]);
            header("location:../Paginas/Compras.php");
        }

        public static function BorrarCompra($codigo)
        {
            $Connection = Connection::getInstance()->getConnection();
            $consulta = "DELETE FROM compras WHERE Cod_Com=?";
            $resultado = $Connection->prepare($consulta);
            $resultado->execute([$codigo]);
            header("location:../Paginas/Compras.php");
        }

        public static function InsertarProductos($producto, $marca, $grado, $ibu, $ingrediente1, $ingrediente2, $ingrediente3, $amargo, $cuerpo, $precio, $descripcion, $imagen)
        { 
            $Connection = Connection::getInstance()->getConnection();
            $consulta = "INSERT INTO productos (Nom_Pro, Mar_Pro, Gra_Alc_Pro, IBU, Car_1_Pro, Car_2_Pro, Car_3_Pro, Ama_Pro, Cue_Pro, Pre_Pro, Des_Pro, Rut_Pro) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $resultado = $Connection->prepare($consulta);
            $resultado->execute([$producto, $marca, $grado, $ibu, $ingrediente1, $ingrediente2, $ingrediente3, $amargo, $cuerpo, $precio, $descripcion, $imagen]);
            header("location:../Paginas/Productos.php");
        }

        public static function ActualizarProductos($producto, $marca, $grado, $ibu, $ingrediente1, $ingrediente2, $ingrediente3, $amargo, $cuerpo, $precio, $descripcion, $imagen, $codigo)
        {
            $Connection = Connection::getInstance()->getConnection();
            $consulta = "UPDATE productos SET Nom_Pro=?, Mar_Pro=?, Gra_Alc_Pro=?, IBU=?, Car_1_Pro=?, Car_2_Pro=?, Car_3_Pro=?, Ama_Pro=?, Cue_Pro=?, Pre_Pro=?, Des_Pro=?, Rut_Pro=? WHERE Cod_Pro=?";
            $resultado = $Connection->prepare($consulta);
            $resultado->execute([$producto, $marca, $grado, $ibu, $ingrediente1, $ingrediente2, $ingrediente3, $amargo, $cuerpo, $precio, $descripcion, $imagen, $codigo]);
            header("location:../Paginas/Productos.php");
        }

        public static function BorrarProductos($codigo)
        {
            $Connection = Connection::getInstance()->getConnection();
            $consulta = "DELETE FROM productos WHERE Cod_Pro=?";
            $resultado = $Connection->prepare($consulta);
            $resultado->execute([$codigo]);
            header("location:../Paginas/Productos.php");
        }
    }
?>