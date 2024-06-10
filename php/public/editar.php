<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Fotocopiadora</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin>
    <link rel="stylesheet" href="../estilos/insertar.css">
</head>
<body>
    <h1 class="text-center">Editar Fotocopiadora</h1>
    <br>

    <form class="contenedor" action="../crud/ediciondatos.php" method="post">
        <?php
            require("./config/config.php");
            require("./config/conexion.php");
            try {
                // Prepara la consulta SQL para obtener los datos de la fotocopiadora
                $sql = "SELECT * FROM Fotocopiadora WHERE id = :id";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':id', $_REQUEST['id']);
                $stmt->execute();

                $row = $stmt->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        ?>

        <!--Para recoger el id-->
        <input type="hidden" class="form-control" name="id" value="<?php echo htmlspecialchars($row['id']);?>">

        <div class="mb-3">
            <label class="form-label">Modelo</label>
            <input type="text" class="form-control" name="modelo" value="<?php echo htmlspecialchars($row['modelo']);?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Número de serie</label>
            <input type="text" class="form-control" name="numero_serie" value="<?php echo htmlspecialchars($row['numero_serie']);?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Técnico</label>
            <select class="form-select" name="tecnico_id">
                <?php
                    try {
                        // Prepara la consulta SQL para obtener la lista de técnicos
                        $sql_tecnicos = "SELECT id, nombre FROM Tecnico";
                        $stmt_tecnicos = $pdo->query($sql_tecnicos);
                        while ($tecnico = $stmt_tecnicos->fetch(PDO::FETCH_ASSOC)) {
                            echo '<option value="' . htmlspecialchars($tecnico['id']) . '"';
                            if ($tecnico['id'] == $row['tecnico_id']) {
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
            <input type="date" class="form-control" name="fecha" value="<?php echo htmlspecialchars($row['fecha']);?>">
        </div>

        <div class="container">
            <button type="submit" class="btn btn-danger">Actualizar</button>
            <a href="../index.php" class="btn btn-dark">Regresar</a>
        </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <br>
    <footer class="footer">
    <div class="text-center">
        <p>&copy; 2023 José Ramón Peris. Todos los derechos reservados.</p>
    </div>
    </footer>
</body>
</html>
