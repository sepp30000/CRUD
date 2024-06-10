<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Tarea</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../estilos/insertar.css">
</head>
<body>
    <div class="container">
        <h1 class="text-center mt-5 mb-4">Editar Tarea</h1>
        <form action="./crud/editardatos.php" method="POST"> 
            <?php
            // Archivos de conexión
            include("./config/config.php");
            include("./config/conexion.php");

            $id = $_GET['id'];

            try {
                // Consultar la base de datos de la bbddd
                $sql = "SELECT * FROM Tareas WHERE id = :id";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($row) {
            ?>
            <div class="mb-3">
                <label class="form-label">Título</label>
                <input type="text" class="form-control" name="titulo" value="<?php echo htmlspecialchars($row['titulo']); ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Descripción</label>
                <textarea class="form-control" name="descripcion" rows="3"><?php echo htmlspecialchars($row['descripcion']); ?></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Fecha de creación</label>
                <input type="date" class="form-control" name="fecha_creacion" value="<?php echo htmlspecialchars($row['fecha_creacion']); ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Fecha de vencimiento</label>
                <input type="date" class="form-control" name="fecha_vencimiento" value="<?php echo htmlspecialchars($row['fecha_vencimiento']); ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Estado</label>
                <select class="form-select" name="estado">
                    <?php
                        // Consultar la base de datos para obtener los estados
                        $sql_estados = "SELECT * FROM Estados";
                        $stmt_estados = $pdo->query($sql_estados);
                        while ($estado = $stmt_estados->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value='".$estado['id']."'";
                            if ($estado['id'] == $row['estado_id']) {
                                echo " selected";
                            }
                            echo ">".$estado['nombre']."</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Fotocopiadora</label>
                <select class="form-select" name="fotocopiadora_id">
                    <?php
                        // Consultar la base de datos para obtener los modelos de fotocopiadoras
                        $sql_fotocopiadoras = "SELECT id, modelo FROM Fotocopiadora";
                        $stmt_fotocopiadoras = $pdo->query($sql_fotocopiadoras);
                        while ($fotocopiadora = $stmt_fotocopiadoras->fetch(PDO::FETCH_ASSOC)) {
                            echo '<option value="' . htmlspecialchars($fotocopiadora['id']) . '"';
                            if ($fotocopiadora['id'] == $row['fotocopiadora_id']) {
                                echo ' selected';
                            }
                            echo '>' . htmlspecialchars($fotocopiadora['modelo']) . '</option>';
                        }
                    ?>
                </select>
</div>
            <div class="mb-3">
                <label class="form-label">Técnico asignado</label>
                <select class="form-select" name="tecnico_id">
                    <?php
                        // Consultar la base de datos para obtener los técnicos
                        $sql_tecnicos = "SELECT * FROM usuarios";
                        $stmt_tecnicos = $pdo->query($sql_tecnicos);
                        while ($tecnico = $stmt_tecnicos->fetch(PDO::FETCH_ASSOC)) {
                            echo '<option value="' . htmlspecialchars($tecnico['id']) . '"';
                            if ($tecnico['id'] == $row['tecnico_id']) {
                                echo ' selected';
                            }
                            echo ">" . htmlspecialchars($tecnico['nombre'] . " " . $tecnico['apellido_1']) . "</option>";
                    }
                        ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Fecha</label>
                <input type="date" class="form-control" name="fecha" value="<?php echo isset($row['fecha']) ? htmlspecialchars($row['fecha']) : ''; ?>">
            </div>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="container">
                <button type="submit" class="btn btn-danger">Actualizar</button>
                <a href="../index.php" class="btn btn-dark">Regresar</a>
            </div>
            <?php
                } else {
                    // Si no se encontraron datos, mostrar un mensaje de error
                    echo "No se encontraron datos de la tarea para editar.";
                }
            } catch (PDOException $e) {
                // Si hay un error en la consulta, mostrar el mensaje de error
                echo "Error: " . $e->getMessage();
            }
            ?>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous>
    <br>
    <footer class="footer">
        <div class="text-center">
            <p>&copy; 2023 José Ramón Peris. Todos los derechos reservados.</p>
        </div>
    </footer>
</body>
</html>