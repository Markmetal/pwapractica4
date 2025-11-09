<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["rol"] != 2) {
    header("location: ../index.php");
    exit;
}

include_once '../includes/db_conexion.php';

$id_estudiante = $_SESSION["id"];
$nombre_estudiante = $_SESSION["nombre"];

$sql_notas = "
    SELECT 
        a.nombre AS asignatura, 
        n.parcial, 
        n.teoria, 
        n.practica
    FROM 
        notas n
    JOIN 
        asignaturas a ON n.asignatura_id = a.id
    WHERE 
        n.usuario_id = ?
    ORDER BY 
        a.nombre, n.parcial
";

$stmt_notas = $conexion->prepare($sql_notas);
$stmt_notas->bind_param("i", $id_estudiante);
$stmt_notas->execute();
$resultado_notas = $stmt_notas->get_result();

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Estudiante | Mis Calificaciones</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .dashboard-container { max-width: 800px; }
        .table-notas th { background-color: #007bff; color: white; }
        .table-notas td, .table-notas th { padding: 10px; text-align: left; border-bottom: 1px solid #ddd; }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <h2>Bienvenido alumno<?php echo htmlspecialchars($nombre_estudiante); ?></h2>
        <h3>Mis Calificaciones</h3>

        <?php if ($resultado_notas->num_rows > 0): ?>
        <table class="table-notas" width="100%">
            <thead>
                <tr>
                    <th>Asignatura</th>
                    <th>Parcial</th>
                    <th>Nota Teórica</th>
                    <th>Nota Práctica</th>
                    <th>Promedio Parcial</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $resultado_notas->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['asignatura']); ?></td>
                    <td><?php echo $row['parcial'] == 1 ? 'Primer Parcial' : ($row['parcial'] == 2 ? 'Segundo Parcial' : 'Mejoramiento'); ?></td>
                    <td><?php echo number_format($row['teoria'], 2); ?></td>
                    <td><?php echo number_format($row['practica'], 2); ?></td>
                    <td>
                        <?php 
                            $promedio = ($row['teoria'] + $row['practica']) / 2;
                            echo number_format($promedio, 2); 
                        ?>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <?php else: ?>
            <p>Aún no tiene calificaciones registradas.</p>
        <?php endif; ?>

        <p style="margin-top: 20px;">
            <a href="logout.php" class="btn primary" style="max-width: 150px; margin-left: auto;">Cerrar Sesión</a>
        </p>
    </div>
</body>
</html>
<?php
$stmt_notas->close();
$conexion->close();
?>