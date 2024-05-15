<?php
    include_once("security/Security.php");
    Security::verifySession('pages/');
    if(isset($_SESSION['role'])) Security::verifyUserType('index','pages/');
?>