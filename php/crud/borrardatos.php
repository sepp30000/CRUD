<?php
include("../config/conexion.php");
include("../config/config.php");

$id = $_GET['id'];

try {
    $pdo->beginTransaction();

    // Inicia el borrado
    $sql_tarea = "DELETE FROM Tareas WHERE id = :id";
    $stmt_tarea = $pdo->prepare($sql_tarea);
    $stmt_tarea->bindParam(':id', $id);
    $stmt_tarea->execute();

    // Confirma la acción
    $pdo->commit();
    echo '<script>alert("Tarea eliminada correctamente"); window.location.href="../index.php";</script>';
} catch (PDOException $e) {
    // Realiza un rollback para deshacer los cambios, en caso de fallo
    $pdo->rollBack();
    echo '<script>alert("Error al eliminar la tarea: ' . $e->getMessage() . '"); window.location.href="../index.php";</script>';
}

// Cierra la conexión
$pdo = null;
?>

