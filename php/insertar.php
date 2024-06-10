<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Agregar Tarea</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
                            $pdo = new PDO($dsn, $user, $pass, $options);
                            
                            // Select estados
                            $sql = "SELECT * FROM Estados";
                            $stmt = $pdo->query($sql);
                            
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
                <label class="form-label">Técnico asignado</label>
                <select class="form-select" name="tecnico_id">
                    <option selected>Seleccionar técnico</option>
                    <?php
                        // Conexión a la bbdd
                        require_once("./config/config.php");

                        try {
                            $pdo = new PDO($dsn, $user, $pass, $options);
                            
                            // Consulta para obtener los técnicos de la base de datos
                            $sql = "SELECT * FROM Usuarios";
                            $stmt = $pdo->query($sql);
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo "<option value='".$row['id']."'>".$row['nombre']." ".$row['apellido_1']." ".$row['apellido_2']."</option>";
                            }
                        } catch (PDOException $e) {
                            echo "Error: " . $e->getMessage();
                        }
                    ?>
                </select>
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-danger">Agregar</button>
                <a href="../index.php" class="btn btn-dark">Regresar</a>
            </div>
        </form>
    </div>
    <footer class="footer mt-5">
        <div class="text-center">
            <p>&copy; 2023 José Ramón Peris. Todos los derechos reservados.</p>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

