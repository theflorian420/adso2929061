<?php
include '../config/app.php';
include '../config/database.php';
include '../config/security.php';

if ($_GET) {
    $id = $_GET['id'];
    if(deletePet($_GET['id'], $conx)) {
        $_SESSION['message'] = "Mascota eliminada exitosamente";
        echo "<script> window.location.replace('dashboard.php') </script>";
    }
}
?>