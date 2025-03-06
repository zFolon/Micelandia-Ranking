<?php
// Arquivo de configuração de banco de dados
$servername = "localhost";
$username = "root"; // Alterar conforme necessário
$password = ""; // Alterar conforme necessário
$dbname = "xxx"; // Substitua "xxx" pelo nome do seu banco de dados

// Conexão ao banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se houve erro na conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>
