<?php

session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["rol"] != 1) {
    header("location: ../index.php");
    exit;
}

include_once '../includes/db_conexion.php';


$nombre_docente = $_SESSION["nombre"];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Docente | Gestión de Calificaciones</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .dashboard-container { max-width: 900px; }

    </style>
</head>
<body>
    <div class="dashboard-container">
        
        <h2>Bienvenido <?php echo htmlspecialchars($nombre_docente); ?></h2>
        <p>Gestiona las asignaturas y las calificaciones de los estudiantes de la UBE.</p>

        <h3>Gestión de Notas de los estudiantes</h3>
        
        <table border="1" width="100%">
            <thead>
                <tr>
                    <th>Estudiante</th>
                    <th>Asignatura</th>
                    <th>Teoría</th>
                    <th>Práctica</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Sylvia pillajo</td>
                    <td>Programación Web Avanzada</td>
                    <td><input type="number" min="0" max="10" step="0.01" value="8.5"></td>
                    <td><input type="number" min="0" max="10" step="0.01" value="9.0"></td>
                    <td><button class="btn primary">Guardar</button></td>
                </tr>  </thead>
            <tbody>
                <tr>
                    <td>Anahi Palomo</td>
                    <td>Diseño en 3D</td>
                    <td><input type="number" min="0" max="10" step="0.01" value="8.5"></td>
                    <td><input type="number" min="0" max="10" step="0.01" value="9.0"></td>
                    <td><button class="btn primary">Guardar</button></td>
                </tr>
            </tbody>
                <tr>
                    <td>Juan bustamante</td>
                    <td>Base de Datos</td>
                    <td><input type="number" min="0" max="10" step="0.01" value="7.0"></td>
                    <td><input type="number" min="0" max="10" step="0.01" value="8.0"></td>
                    <td><button class="btn primary">Guardar</button></td>
                </tr>
                  </thead>
            <tbody>
                <tr>
                    <td>Jhon lenon</td>
                    <td>Matematica aplicada</td>
                    <td><input type="number" min="0" max="10" step="0.01" value="8.5"></td>
                    <td><input type="number" min="0" max="10" step="0.01" value="9.0"></td>
                    <td><button class="btn primary">Guardar</button></td>
                </tr>
            </tbody>
                <tr>
                    <td>Julia Tapia</td>
                    <td>Fisica</td>
                    <td><input type="number" min="0" max="10" step="0.01" value="7.0"></td>
                    <td><input type="number" min="0" max="10" step="0.01" value="8.0"></td>
                    <td><button class="btn primary">Guardar</button></td>
                </tr>
            </tbody>
        </table>

        <p style="margin-top: 20px;">
            <a href="logout.php" class="btn primary" style="max-width: 150px; margin-left: auto;">Cerrar Sesión</a>
        </p>
    </div>
</body>
</html>
<?php $conexion->close(); 
?>