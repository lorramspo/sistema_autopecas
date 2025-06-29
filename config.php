<?php
$servidor = "localhost";
$usuario = "root";
$senha = "root";
$dbname = "autopecas";

try {
    $conn = new PDO("mysql:host=$servidor;dbname=$dbname;charset=utf8", $usuario, $senha);

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    die("Falha na conexão: " . $e->getMessage());
}
?>

