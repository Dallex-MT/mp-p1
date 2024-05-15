<?php
    include 'Session.php';
    class Security{
        public static function verifySession($route){
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            if (!isset($_SESSION['user'])) {
                header('Location: '.$route.'Login.php');
                exit();
            }
        }

        static function verifyUserType($requiredRole, $route) {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            if ($_SESSION['role'] != $requiredRole) {
                if ($requiredRole == 'admin') {
                    header("Location: ".$route."Client.php");
                } else {
                    header("Location: ".$route."Admin.php");
                }
                exit;
            }
        }

        static function closeSession() {
            session_regenerate_id(); // Prevenir secuestro de sesión
            Sesion::getInstance()->destroySession();
            header('Location:Login.php');
            exit();
        }
    }
?>
