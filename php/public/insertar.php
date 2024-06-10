
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Agregar Tarea</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../estilos/insertar.css">
</head>
<body>
    <div class="container">
        <h1 class="text-center mt-5 mb-4">Agregar Tarea</h1>
        <form action="../crud/insertardatos.php" method="POST"> 
            <div class="mb-3">
                <label class="form-label">Título</label>
                <input type="text" class="form-control" name="titulo">
            </div>
            <div class="mb-3">
                <label class="form-label">Descripción</label>
                <textarea class="form-control" name="descripcion" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Fecha de creación</label>
                <input type="date" class="form-control" name="fecha_creacion" value="<?php echo date('Y-m-d'); ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Fecha de vencimiento</label>
                <input type="date" class="form-control" name="fecha_vencimiento">
            </div>
            <div class="mb-3">
                <label class="form-label">Estado</label>
                <select class="form-select" name="estado">
                    <option selected>Seleccionar estado</option>
                    <?php
                        // Conexión a la base de datos
                        require_once("./config/config.php");

                        try {
                            
                            // Consulta para obtener los estados de la base de datos
                            $sql = "SELECT * FROM Estados";
                            $stmt = $pdo->query($sql);
                            
                            // Mostrar los resultados como opciones en el menú desplegable
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo "<option value='".$row['id']."'>".$row['nombre']."</option>";
                            }
                        } catch (PDOException $e) {
                            echo "Error: " . $e->getMessage();
                        }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">ID de la fotocopiadora</label>
                <input type="number" class="form-control" name="fotocopiadora_id">
            </div>
            <div class="mb-3">
                <label class="form-label">Técnico asignado</label>
                <select class="form-select" name="tecnico_id">
                <?php
                    try {
                        // Prepara la consulta SQL para obtener la lista de técnicos
                        $sql_tecnicos = "SELECT id, nombre FROM Tecnico";
                        $stmt_tecnicos = $pdo->query($sql_tecnicos);
                        while ($tecnico = $stmt_tecnicos->fetch(PDO::FETCH_ASSOC)) {
                            echo '<option value="' . htmlspecialchars($tecnico['id']) . '"';
                            if (isset($row['tecnico_id']) && $tecnico['id'] == $row['tecnico_id']) {
                                echo ' selected';
                            }
                            echo '>' . htmlspecialchars($tecnico['nombre']) . '</option>';
                        }
                    } catch (PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }
                ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Fecha</label>
            <input type="date" class="form-control" name="fecha" value="<?php echo isset($row['fecha']) ? htmlspecialchars($row['fecha']) : ''; ?>">
        </div>

        <div class="container">
            <button type="submit" class="btn btn-danger">Actualizar</button>
            <a href="../index.php" class="btn btn-dark">Regresar</a>
        </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous>
    <br>
    <footer class="footer">
    <div class="text-center">
        <p>&copy; 2023 José Ramón Peris. Todos los derechos reservados.</p>
    </div>
    </footer>
</body>
</html>

