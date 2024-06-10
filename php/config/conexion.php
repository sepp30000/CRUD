<?php
require 'config.php';
# creación de la conexión pdo
try {
    $pdo = new PDO($dsn, $user, $pass, $options);
#    echo "Conexión exitosa a la base de datos";
} catch (PDOException $e) {
    echo 'Error de conexión: ' . $e->getMessage();
    die();
}
?>
