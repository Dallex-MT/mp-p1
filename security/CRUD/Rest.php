<?php
    include_once $_SERVER['DOCUMENT_ROOT'] . '/MirandaProyecto/security/Connection.php';
    include_once("../Session.php");
    include_once("CRUD.php");
    include_once("Products.php");
    session_start();

    $accion = $_SERVER['REQUEST_METHOD'];
    switch ($accion) {
        case 'POST':
            $opcion = $_POST['opcion'];

            switch ($opcion) {
                case 1:
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['CSRF'], $_POST['csrf_token'])) {
                            die("Operación no permitida");
                        }else{
                            $user = filter_input(INPUT_POST, 'user', FILTER_SANITIZE_STRING);
                            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
                            $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
                            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);;
                            CRUD::insertUser($user, $password, $email, $phone, 'client');
                        }
                    }
                    break;
                case 2:
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['CSRF'], $_POST['csrf_token'])) {
                            die("Operación no permitida");
                        }else{
                            $user = filter_input(INPUT_POST, 'user', FILTER_SANITIZE_STRING);
                            $password = $_POST['password'];
                            CRUD::checkUser($user, $password);
                        }
                    }
                    break;
                case 3:
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['CSRF'], $_POST['csrf_token'])) {
                            die("Operación no permitida");
                        }else{
                            $user = filter_input(INPUT_POST, 'user', FILTER_SANITIZE_STRING);
                            $role = filter_input(INPUT_POST, 'role', FILTER_SANITIZE_STRING);
                            CRUD::updateUser($user, $role);
                        }
                    }
                    break;
                case 4:
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['CSRF'], $_POST['csrf_token'])) {
                            die("Operación no permitida");
                        }else{
                            $user = filter_input(INPUT_POST, 'user', FILTER_SANITIZE_STRING);
                            CRUD::deleteUser($user);
                        }
                    }
                    break;
                case 5:
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['CSRF'], $_POST['csrf_token'])) {
                            die("Operación no permitida");
                        }else{
                            $user = filter_input(INPUT_POST, 'user', FILTER_SANITIZE_STRING);
                            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
                            $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
                            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);;
                            CRUD::insertUser($user, $password, $email, $phone, 'admin');
                        }
                    }
                    break;
                case 6:
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['CSRF'], $_POST['csrf_token'])) {
                            die("Operación no permitida");
                        }else{
                            $user = filter_input(INPUT_POST, 'user', FILTER_SANITIZE_STRING);
                            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
                            $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
                            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);;
                            CRUD::insertUser($user, $password, $email, $phone, 'client');
                        }
                    }
                    break;
                case 7:
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['CSRF'], $_POST['csrf_token'])) {
                            die("Operación no permitida");
                        }else{
                            $user = filter_input(INPUT_POST, 'userID', FILTER_SANITIZE_STRING);
                            CRUD::updatePicture($user);
                        }
                    }
                    break;
                case 8:
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['CSRF'], $_POST['csrf_token'])) {
                            die("Operación no permitida");
                        }else{
                            $user = filter_input(INPUT_POST, 'user', FILTER_SANITIZE_STRING);
                            $role = filter_input(INPUT_POST, 'role', FILTER_SANITIZE_STRING);
                            CRUD::updateUser($user, $role);
                        }
                    }
                    break;
                case 9:
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['CSRF'], $_POST['csrf_token'])) {
                            die("Operación no permitida");
                        }else{
                            $user = filter_input(INPUT_POST, 'user', FILTER_SANITIZE_STRING);
                            CRUD::deleteUser($user);
                        }
                    }
                    break;
                case 10:
                    Products::insertProduct($_POST['model'], $_POST['color'], $_POST['brand'], $_POST['price'], $_POST['size']);
                    break;
                case 11:
                    Products::editProduct($_POST['id'],$_POST['name'], $_POST['color'], $_POST['brand'], $_POST['price'], $_POST['size']);
                    break;
                case 12:
                    Products::deleteProduct($_POST['id']);
                    break;
                case 13:
                    Products::deleteSale($_POST['id']);
                    break;
                case 20:
                    Products::deleteCartProduct($_POST['id']);
                    break;
                case 21:
                    Products::addLike($_POST['id']);
                    break;
                case 22:
                    Products::addToCart($_POST['product'],$_POST['user'],$_POST['price'],$_POST['cart']);
                    break;
                case 23:
                    Products::addComment($_POST['product'],$_POST['user'],$_POST['message']);
                    break;
                default:
                    header("location:../../index.php");
                    break;
            }
        break;
    }
?>