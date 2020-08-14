<?php
session_start();
if (isset($_SESSION['id_usuario'])) {
    header('location: admin/login');
}else{
    header('location: login');
}
