<?php
//session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Plataforma de Filmes</title>
    <link rel="stylesheet" href="/Trabalho_filmes/css/style.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                
                <?php if (isset($_SESSION['tipo']) && $_SESSION['tipo'] == 'adm'): ?>
                    <li><a href="/Trabalho_filmes/admin/adicionar_filme.php">Adicionar Filme</a></li>
                <?php endif; ?>
                <li><a href="/Trabalho_filmes/filmes.php">Filmes</a></li>
                <?php if (isset($_SESSION['id'])): ?>
                    <li><a href="/Trabalho_filmes/login.php">Logout</a></li>
                <?php else: ?>
                    <li><a href="/Trabalho_filmes/login.php">Login</a></li>
                    <li><a href="/Trabalho_filmes/cadastro.php">Cadastro</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <main>
