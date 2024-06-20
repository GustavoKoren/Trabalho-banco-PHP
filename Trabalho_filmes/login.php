<?php
include('conexao.php');
session_start();

$senhalogin = false;
$emaillogin = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT id, nome, senha, tipo FROM usuarios WHERE email='$email'";
    $result = $conn->query($sql);

    

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        if (password_verify($senha, $row['senha'])) {
            $_SESSION['id'] = $row['id'];
            $_SESSION['nome'] = $row['nome'];
            $_SESSION['tipo'] = $row['tipo'];
            header("Location: index.php");
            
            
        } else {
            
            $senhalogin = true;
            
        }
        
    } else {
        
        $emaillogin = true;
    }
}
?>
<!-- TODAS AS SENHAS DE USUARIOS SALVAS SAO "123" -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">

    <style>

    svg{
        position: absolute;
        top: 20%;
        margin-top: 12px;
        left: 50%;
        margin-left: -225px;
    }

    .form_login{
        top: 40%;
        margin-top: 20%;
    }
  

    </style>
</head>
<body style="background-image: url(imagens/background3.jpg);">

    <link href='https://fonts.googleapis.com/css?family=Cabin+Condensed:700' rel='stylesheet' type='text/css'>

    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
        width="450px" height="240px" xml:space="preserve">
        <defs>
        <pattern id="water" width=".25" height="1.1" patternContentUnits="objectBoundingBox">
        <path fill="#000" d="M0.25,1H0c0,0,0-0.659,0-0.916c0.083-0.303,0.158,0.334,0.25,0C0.25,0.327,0.25,1,0.25,1z"/>
        </pattern>
        
        <text id="text" transform="translate(2,116)" font-family="'Cabin Condensed'" font-size="161.047">TeleFlix</text>
        
        <mask id="text-mask">
        <use x="0" y="0" xlink:href="#text" opacity="1" fill="#ffffff"/>
        </mask>
        
        <g id="eff">
        <use x="0" y="0" xlink:href="#text" fill="#a2a3a5"/>
    
            <rect class="water-fill" mask="url(#text-mask)" fill="url(#water)" x="-300" y="50" width="1200" height="120" opacity="0.3">
                <animate attributeType="xml" attributeName="x" from="-300" to="0" repeatCount="indefinite" dur="2s"/>
            </rect>
            <rect class="water-fill" mask="url(#text-mask)" fill="url(#water)" y="45" width="1600" height="120" opacity="0.3">
                <animate attributeType="xml" attributeName="x" from="-400" to="0" repeatCount="indefinite" dur="3s"/>
            </rect>
                
            <rect class="water-fill" mask="url(#text-mask)" fill="url(#water)" y="55" width="800" height="120" opacity="0.3">
                <animate attributeType="xml" attributeName="x" from="-200" to="0" repeatCount="indefinite" dur="1.4s"/>
            </rect>
                <rect class="water-fill" mask="url(#text-mask)" fill="url(#water)" y="55" width="2000" height="120" opacity="0.3">
                <animate attributeType="xml" attributeName="x" from="-500" to="0" repeatCount="indefinite" dur="2.8s"/>
            </rect>
                </g>
            </defs>
    
        <use xlink:href="#eff" opacity="0.9" style="mix-blend-mode:color-burn"/>

    </svg>
    
    
    <form class="form_login" method="post" action="login.php">
        <label>Email:</label>
        <input type="email" name="email" required><br>
        <label>Senha:</label>
        <input type="password" name="senha" required><br>
        <button type="submit">Login</button>

        <?php 
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if ($emaillogin) {
                echo "<br>Nenhum usuário encontrado com este email!";
            } elseif ($senhalogin) {
                echo "<br>Senha inválida!";
            }
        }
        ?>
    </form>

    

    
</body>
</html>
