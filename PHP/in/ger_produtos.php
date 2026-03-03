<?php
require_once('../config/common.php');

if (!eh_administrador()) {
    header('Location: sist_login.php');
    exit();
}

?>