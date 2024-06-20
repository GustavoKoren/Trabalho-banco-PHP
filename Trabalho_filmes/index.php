<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    
}

if ($_SESSION['tipo'] == 'adm') {
    header("Location: admin/filmes.php");
} else { 
    header("Location: filmes.php");
    
}
?>
