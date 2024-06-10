<?php
include("../config/config.php");
include("../config/conexion.php");
try {
    $pdo->beginTransaction();

    $sql_tareas = "INSERT INTO Tareas (titulo, descripcion, fecha_creacion, fecha_vencimiento, estado_id, fotocopiadora_id, tecnico_id) VALUES (:titulo, :descripcion, :fecha_creacion, :fecha_vencimient>
    $stmt_tareas = $pdo->prepare($sql_tareas);
    $stmt_tareas->bindParam(':titulo', $_POST['titulo']);
    $stmt_tareas->bindParam(':descripcion', $_POST['descripcion']);
    $stmt_tareas->bindParam(':fecha_creacion', $_POST['fecha_creacion']);
    $stmt_tareas->bindParam(':fecha_vencimiento', $_POST['fecha_vencimiento']);
    $stmt_tareas->bindParam(':estado_id', $_POST['estado_id']);
    $stmt_tareas->bindParam(':fotocopiadora_id', $_POST['fotocopiadora_id']);
    $stmt_tareas->bindParam(':tecnico_id', $_POST['tecnico_id']);
    $stmt_tareas->execute();

    // Mantiene la transacción
    $pdo->commit();
    echo '<script>alert("Datos insertados correctamente"); window.location.href="../index.php";</script>';
} catch (PDOException $e) {
    // Si falla hace rollback
    $pdo->rollBack();
    echo '<script>alert("Error al insertar datos: ' . $e->getMessage() . '"); window.location.href="../formularios/insertar_tarea.php";</script>';
}

// Cierra la conexión
$pdo = null;
?>
