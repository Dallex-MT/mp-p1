<?php
    include_once("C:/xampp/htdocs/MirandaProyecto/security/Connection.php");
    include_once("C:/xampp/htdocs/MirandaProyecto/security/Session.php");
    include_once("C:/xampp/htdocs/MirandaProyecto/pages/loginError.php");
    class Products{
        public static function insertProduct($product, $color, $brand, $price, $size){
            $error='';
            $pdo=Connection::getInstance()->getConnection();
            $query="SELECT * FROM products WHERE name=?;";
            $statement=$pdo->prepare($query);
            $statement->execute([$product]);
            $existingProduct=$statement->fetch();
            $path='../../assets/img/others/default.png';
            if ($existingProduct === false) {
                $pdo->beginTransaction();
                $query="INSERT INTO products SET name=?, brand=?, color=?, price=?, size=?, picture=?";
                $statement=$pdo->prepare($query);
                $statement->execute([$product, $brand, $color, $price, $size, file_get_contents($path)]);
                $pdo->commit();
                header('location: ../../pages/products.php');
                exit();
            } else {
                loginError($error);
            }
        }

        public static function showProducts(){
            try {
                $Connection = Connection::getInstance()->getConnection();
                $consulta = "SELECT * FROM products";
                $resultado = $Connection->prepare($consulta);
                $resultado->execute();
                $dato = $resultado->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                return;
            }

            $acum = 1;
            $informacion = '';

            foreach ($dato as $respuesta) {
                $id = htmlspecialchars($respuesta['productID']);
                $brand = htmlspecialchars($respuesta['brand']);
                $name = htmlspecialchars($respuesta['name']);
                $color = htmlspecialchars($respuesta['color']);
                $size = htmlspecialchars($respuesta['size']) ;
                $price = htmlspecialchars($respuesta['price']);
                $likes = htmlspecialchars($respuesta['likes']);
                            

                $informacion .= '
                <li class="col-md-4 col-lg-3 mb-4 product">
                    <a href="./store.php?id='.$id.'">
                        <div class="img-wrapper">
                            <img src="data:image/jpeg;base64,' . base64_encode($respuesta['picture']) . '" alt="Producto"></img>
                            <div class="actions-wrapper">
                                <ul class="actions">
                                    <li>
                                        <a href="./store.php?opcion=21&id='.$id .'" class="py-2">
                                            <span class="icon-wrap">
                                                <i class="far fa-heart"></i>
                                                '.$likes .'
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="./store.php?id='.$id.'" class="py-2">
                                            <span class="icon-wrap">
                                                <i class="far fa-eye"></i>
                                                Ver
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="py-2" onclick="addToCart()">
                                            <input type="hidden" id="productAdd" name="productAdd" value="'.$id.'">
                                            <input type="hidden" id="price" name="price" value="'.$price.'">
                                            <span class="icon-wrap">
                                                <i class="fas fa-cart-plus"></i>
                                                Agregar
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <h3 class="text-white">'.$name.'</h3>
                        <span class="info">'.$brand.'<br>Color: '.$color.'<br>Talla: '.$size.' US(men)</span>
                        <div class="mt-auto">
                            <span class="info  text-end"><strong class="text-success"> $ '.number_format($price, 2).'</strong></span>
                        </div>
                    </a>
                </li>
                    ';
            }
            return $informacion;
        }

        public static function showProduct($id){
            try {
                $Connection = Connection::getInstance()->getConnection();
                $consulta = "SELECT * FROM products WHERE productID=".$id;
                $resultado = $Connection->prepare($consulta);
                $resultado->execute();
                $dato = $resultado->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                return;
            }
            $info="";
            foreach ($dato as $respuesta) {
                $brand = htmlspecialchars($respuesta['brand']);
                $name = htmlspecialchars($respuesta['name']);
                $color = htmlspecialchars($respuesta['color']);
                $size = htmlspecialchars($respuesta['size']) ;
                $price = htmlspecialchars($respuesta['price']);
                $likes = htmlspecialchars($respuesta['likes']);
                $info .= '
                <div class="container mx-auto">
                    <div class="box">
                        <div class="images align-items-center">
                            <img src="data:image/jpeg;base64,'.base64_encode($respuesta['picture']) .'" alt="Producto"></img>
                        </div>
                        <div class="basic-info">
                            <h1 class="text-white">'.$name.'</h1>
                            <div class="rate">
                            <i class="far fa-heart"></i> '.$likes.'
                            </div>
                            <span>$'.$price.'</span>
                            <div class="options">
                            <input type="hidden" id="productAdd" name="product" value="'.$id.'">
                            <button class="btn btn-primary font-weight-bold px-3" onclick="addToCart()"><i class="fas fa-shopping-cart"></i>  Agregar al Carrito</button>
                            </div>
                        </div>
                        <div class="description">
                            <p>'.$brand.'<br>Color: '.$color.'<br>Talla: '.$size.' US(men)</p>
                        </div>
                    </div>
                </div>
                ';
            }
            return $info;
        }

        public static function showComments($id){
            $info='
            <div class="comment-container theme--dark">
                <div class="cardComment v-card v-sheet theme--dark elevation-2">
                    <div class="writing">
                        <textarea id="message" class="textarea" autofocus spellcheck="false"></textarea>
                        <input type="hidden" id="product" name="product" value="'.$id.'">
                        <div class="footerComment">
                            <div class="group-button">
                                <button class="btn"><i class="ri-at-line"></i></button>
                                <button class="btn btn-primary font-weight-bold px-3" onclick="sendMessage()">Enviar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="cardComment v-card v-sheet theme--dark elevation-2">
                    <div class="sign-in-wrapper">
                        <h4 class="text-center text-white">No hay comentarios para este producto.</h4>
                    </div>
                </div>
            </div>
            ';
            try {
                $Connection = Connection::getInstance()->getConnection();
                $consulta = "SELECT comments.*, users.picture FROM comments INNER JOIN users ON users.user = comments.userComment WHERE comments.productComment = ? ORDER BY comments.commentID DESC";
                $resultado = $Connection->prepare($consulta);
                $resultado->execute([$id]);
                $dato = $resultado->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                return $info;
            }
            if (empty($dato)) {
                return $info;
            }
            $info='<div class="comment-container theme--dark">
                <div class="cardComment v-card v-sheet theme--dark elevation-2">
                    <div class="writing">
                        <textarea id="message" class="textarea" autofocus spellcheck="false"></textarea>
                        <input type="hidden" id="product" name="product" value="'.$id.'">
                        <div class="footerComment">
                            <div class="group-button">
                                <button class="btn"><i class="ri-at-line"></i></button>
                                <button class="btn btn-primary font-weight-bold px-3" onclick="sendMessage()">Enviar</button>
                            </div>
                        </div>
                    </div>
                </div>';
            foreach ($dato as $respuesta) {
                $user = htmlspecialchars($respuesta['userComment'], ENT_QUOTES, 'UTF-8');
                $message = htmlspecialchars($respuesta['message'], ENT_QUOTES, 'UTF-8');
                $info.='
                    <div>
                        <div class="cardComment v-card v-sheet theme--light elevation-2">
                            <div class="header">
                                <div class="v-avatar avatar"><img src="data:image/jpeg;base64,'.base64_encode($respuesta['picture']).'" alt="user">
                                </div>
                                <span class="displayName titleComment">'.$user.'</span>
                            </div>
                            <!---->
                            <div class="wrapperComment comment">
                                <p>'.$message.'</p>
                            </div>
                        </div>
                    </div>
                ';
            }
            return $info.='</div>';
        }

        public static function showCart($id){
            try {
                $Connection = Connection::getInstance()->getConnection();
                $consulta = "SELECT cartdetail.detailID, products.* FROM cartdetail INNER JOIN products ON cartdetail.productID = products.productID WHERE cartdetail.cartID =?";
                $resultados = $Connection->prepare($consulta);
                $resultados->execute([$id]);
                $dato = $resultados->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                return $e;
            }
            $filas = "";
            $total=0;
            
            foreach ($dato as $resultado) {
                $filas .= '
                    <tr>
                        <td><img src="data:image/jpeg;base64,' . base64_encode($resultado['picture']) . '" alt="Producto" width=150></img></td>
                        <td class="text-white">' . htmlspecialchars($resultado['name']) . '</td>
                        <td class="text-white">' . htmlspecialchars($resultado['size']) . ' US(Men)</td>
                        <td class="text-white">$ ' . htmlspecialchars($resultado['price']) . '</td>
                        <td>
                            <form action="../security/CRUD/Rest.php" method="POST">
                                <input type="hidden" name="id" value="'. htmlspecialchars($resultado['detailID']) .'">
                                <input type="hidden" name="opcion" value="20">
                                <button type="submit">
                                    <i class="fas fa-window-close"></i>
                                </button>
                            </form>
                        </td>
                    </tr>';
                $total += $resultado['price'];
            }
            $filas.='</tbody>
            </table>
            <div class="mt-5"><h3 class="text-white text-end">Precio total: $'.$total.'</h3><br>
                <button class="btn btn-primary" type="submit">
                    <i class="fas fa-money-check-alt"></i>
                    <h3 class="text-white">Comprar</h3>
                </button>
            </div>'
            ;
            return $filas;
        }

        public static function editProduct($id,$product, $color, $brand, $price, $size){
            $pdo=Connection::getInstance()->getConnection();
            $query="UPDATE products SET name=?, brand=?, color=?, price=?, size=?, picture=? WHERE productID=?";
            $statement=$pdo->prepare($query);
            $statement->execute([$product, $brand, $color, $price, $size,$id]);
        }
        
        public static function addLike($id){
            $pdo=Connection::getInstance()->getConnection();
            $query="UPDATE products SET likes = likes + 1 WHERE productID =".$id;
            $statement=$pdo->prepare($query);
            $statement->execute();
        }
        
        public static function addComment($product,$user,$message){
            $pdo=Connection::getInstance()->getConnection();
            $query="INSERT INTO comments SET message=?, userComment=?, productComment=?";
            $statement=$pdo->prepare($query);
            $statement->execute([$message,$user,$product]);
        }
        
        public static function addToCart($product,$user,$price,$id){
            $pdo=Connection::getInstance()->getConnection();
            $pdo->beginTransaction();
            $query="UPDATE cart SET quantity=quantity+1,totalPrice=totalPrice + ?, user=? WHERE cartID=?";
            $statement=$pdo->prepare($query);
            $statement->execute([$price, $user, $id]);
            $pdo->commit();
            $query="INSERT INTO cartdetail SET cartID=?, productID=?";
            $statement=$pdo->prepare($query);
            $statement->execute([$id, $product]);
            $_SESSION['cart']+=1;
        }

        public static function deleteProduct($id){
            $pdo=Connection::getInstance()->getConnection();
            $query="DELETE FROM products WHERE productID=?";
            $statement=$pdo->prepare($query);
            $statement->execute([$id]);
        }
        
        public static function deleteSale($id){
            $pdo=Connection::getInstance()->getConnection();
            $query="DELETE FROM purchases WHERE purchaseID=?";
            $statement=$pdo->prepare($query);
            $statement->execute([$id]);
        }
        
        public static function deleteCartProduct($id){
            $pdo=Connection::getInstance()->getConnection();
            $query="DELETE FROM cartdetail WHERE detailID=?";
            $statement=$pdo->prepare($query);
            $statement->execute([$id]);
            $_SESSION['cart']-=1;
            header('location: ../../pages/cart.php');
            exit();
        }
    }
?>