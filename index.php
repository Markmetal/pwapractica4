<?php

include_once 'includes/db_conexion.php';

$email = $contrasena = "";
$error_msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $contrasena = trim($_POST["contrasena"]);

    if (empty($email) || empty($contrasena)) {
        $error_msg = "Por favor, ingrese email y contraseña.";
    } else {

        $sql = "SELECT id, nombre, email, rol, contrasena FROM usuarios WHERE email = ?";

        if ($stmt = $conexion->prepare($sql)) {
            $stmt->bind_param("s", $param_email);
            $param_email = $email;

            if ($stmt->execute()) {
                $stmt->store_result();

                if ($stmt->num_rows == 1) {
                    $stmt->bind_result($id, $nombre, $email_db, $rol, $contrasena_hashed);
                    if ($stmt->fetch()) {

                        if ($contrasena == $contrasena_hashed) {

                            session_start();
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["nombre"] = $nombre;
                            $_SESSION["rol"] = $rol;

                            if ($rol == 1) {
                                header("location: vistas/docente_dashboard.php");
                            } elseif ($rol == 2) {
                                header("location: vistas/estudiante_notas.php");
                            }
                        } else {
                            $error_msg = "La contraseña ingresada no es válida.";
                        }
                    }
                } else {
                    $error_msg = "No se encontró una cuenta con ese email.";
                }
            } else {
                echo "¡Ups! Algo salió mal. Por favor, inténtelo de nuevo más tarde.";
            }

            $stmt->close();
        }
    }
}
$conexion->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Acceso al Sistema de Calificaciones</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<script src="js/script.js"></script>
</body>
</html>
<body>
    <div class="login-container">
        <h2>Acceso al Sistema</h2>
        <p>Por favor, ingrese sus datos.</p>
        
        <?php if (!empty($error_msg)): ?>
            <div class="alert error"><?php echo $error_msg; ?></div>
        <?php endif; ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
            </div>
            <div class="form-group">
                <label>Contraseña:</label>
                <input type="password" name="contrasena" required>
            </div>
            <div class="form-group">
                <input type="submit" class="btn primary" value="Ingresar">
            </div>
        </form>
    </div>
</body>
</html>