<?php
require 'config/config.php'; // Incluye el archivo de conexión a la base de datos
require 'config/conexion.php';

// Consulta SQL para obtener todas las tareas
$sql = "SELECT Tareas.*, Estados.nombre AS estado_nombre, Fotocopiadora.modelo AS fotocopiadora_modelo, Usuarios.nombre AS tecnico_nombre, Usuarios.apellido_1, Usuarios.apellido_2 
        FROM Tareas
        JOIN Estados ON Tareas.estado_id = Estados.id
        JOIN Fotocopiadora ON Tareas.fotocopiadora_id = Fotocopiadora.id
        JOIN Usuarios ON Tareas.tecnico_id = Usuarios.id";

// Ejecutar la consulta SQL
$stmt = $pdo->query($sql);

// Obtener todos los resultados de la consulta
$tareas = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--link de bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <title>CRUD PROYECTO</title>
</head>

<body>
    <br>
    <div class="container">
        <h1 class="text-center">GESTOR DE TAREAS</h1>
    </div>
    <br>
    <div class="container">
        <!-- Tabla bootstrap -->
        <table class="table table-striped">
            <thead>
                <tr>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Titulo</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Fecha de creación</th>
                    <th scope="col">Fecha de vencimiento</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Fotocopiadora</th>
                    <th scope="col">Técnico</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <!-- Abrimos el php -->
                <?php foreach ($tareas as $tarea): ?>
                <tr>
                    <td><?php echo htmlspecialchars($tarea['id']); ?></td>
                    <td><?php echo htmlspecialchars($tarea['titulo']); ?></td>
                    <td><?php echo htmlspecialchars($tarea['descripcion']); ?></td>
                    <td><?php echo htmlspecialchars(date('Y-m-d H:i:s', strtotime($tarea['fecha_creacion']))); ?></td>
                    <td><?php echo htmlspecialchars(date('Y-m-d H:i:s', strtotime($tarea['fecha_vencimiento']))); ?></td>
                    <td><?php echo htmlspecialchars($tarea['estado_nombre']); ?></td>
                    <td><?php echo htmlspecialchars($tarea['fotocopiadora_modelo']); ?></td>
                    <td><?php echo htmlspecialchars($tarea['tecnico_nombre'] . ' ' . $tarea['apellido_1'] . ' ' . $tarea['apellido_2']); ?></td>
                    <td>
                        <div class="d-flex flex-row">
                                <a href="" class="btn btn-warning custom-btn">Editar</a>
                                <a href="" class="btn btn-danger">Eliminar</a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
                
            </tbody>
        </table>
        <a href="" class="btn btn-success">Agregar Incidencia</a>
    </div>
    <!-- javascript bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
        crossorigin="anonymous"></script>
</body>

</html>

