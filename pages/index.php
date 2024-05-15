<?php
    include_once("../security/Security.php");
    Security::verifySession('');
    if(isset($_SESSION['role'])) Security::verifyUserType('index','');
?>