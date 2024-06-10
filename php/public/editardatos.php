<?php
include("../config/config.php");
include("../config/conexion.php");

// Recoge los datos del formulario
$id = $_POST['id'];
$titulo = $_POST['titulo'];
$descripcion = $_POST['descripcion'];
$fecha_creacion = $_POST['fecha_creacion'];
$fecha_vencimiento = $_POST['fecha_vencimiento'];
$estado_id = isset($_POST['estado_id']) ? $_POST['estado_id'] : null;
$fotocopiadora_id = $_POST['fotocopiadora_id'];
$tecnico_id = $_POST['tecnico_id'];

try {
    // Inicia una transacción
    $pdo->beginTransaction();

    // Consulta para actualizar los datos en la tabla Tareas
    $sql_update = "UPDATE Tareas SET 
                  titulo = :titulo, 
                  descripcion = :descripcion, 
                  fecha_creacion = :fecha_creacion, 
                  fecha_vencimiento = :fecha_vencimiento, 
                  estado_id = :estado_id, 
                  fotocopiadora_id = :fotocopiadora_id, 
                  tecnico_id = :tecnico_id 
                  WHERE id = :id";
    $stmt_update = $pdo->prepare($sql_update);
    $stmt_update->bindParam(':titulo', $titulo);
    $stmt_update->bindParam(':descripcion', $descripcion);
    $stmt_update->bindParam(':fecha_creacion', $fecha_creacion);
    $stmt_update->bindParam(':fecha_vencimiento', $fecha_vencimiento);
    $stmt_update->bindParam(':estado_id', $estado_id);
    $stmt_update->bindParam(':fotocopiadora_id', $fotocopiadora_id);
    $stmt_update->bindParam(':tecnico_id', $tecnico_id);
    $stmt_update->bindParam(':id', $id);
    $stmt_update->execute();

    // Si la consulta fue exitosa, confirma la transacción
    $pdo->commit();
    echo '<script>alert("Datos actualizados correctamente"); window.location.href="../index.php";</script>';
} catch (PDOException $e) {
    // Si hay algún error, realiza un rollback para deshacer los cambios
    $pdo->rollBack();
    echo '<script>alert("Error al actualizar datos: ' . $e->getMessage() . '"); window.location.href="../editar.php?id='.$id.'";</script>';
}

// Cierra la conexión
$pdo = null;
?>

