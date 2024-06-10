<?php
include("../config/conexion.php");
include("../config/config.php");

$id = $_GET['id']; // Asegúrate de que estás recogiendo el parámetro correcto de la URL

try {
    // Inicia una transacción
    $pdo->beginTransaction();

    // Elimina los datos de la tabla Tareas
    $sql_tarea = "DELETE FROM Tareas WHERE id = :id";
    $stmt_tarea = $pdo->prepare($sql_tarea);
    $stmt_tarea->bindParam(':id', $id);
    $stmt_tarea->execute();

    // Confirma la transacción
    $pdo->commit();
    echo '<script>alert("Tarea eliminada correctamente"); window.location.href="../index.php";</script>';
} catch (PDOException $e) {
    // Si hay algún error, realiza un rollback para deshacer los cambios
    $pdo->rollBack();
    echo '<script>alert("Error al eliminar la tarea: ' . $e->getMessage() . '"); window.location.href="../index.php";</script>';
}

// Cierra la conexión
$pdo = null;
?>
