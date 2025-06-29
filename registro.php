<?php
session_start();

// If user is already logged in, redirect to profile
if (isset($_SESSION['usuario_id'])) {
    header("Location: perfil.php");
    exit;
}

$page_title = "Crear Cuenta - LIVESCOMP";
$additional_css = ['css/MiCuenta.css', 'css/categorias.css'];

$error_message = '';
$success_message = '';

// Handle registration form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include_once 'config/database.php';
    include_once 'classes/User.php';
    
    $database = new Database();
    $db = $database->getConnection();
    $user = new User($db);
    
    // Get form data
    $user->nombre = $_POST['nombre'] ?? '';
    $user->apellido = $_POST['apellido'] ?? '';
    $user->fecha_nacimiento = $_POST['fecha_nacimiento'] ?? '';
    $user->tipo_documento = $_POST['tipo_documento'] ?? '';
    $user->numero_documento = $_POST['numero_documento'] ?? '';
    $user->celular = $_POST['celular'] ?? '';
    $user->email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $acepto_terminos = isset($_POST['acepto_terminos']);
    
    // Validation
    if (empty($user->nombre) || empty($user->apellido) || empty($user->email) || empty($password)) {
        $error_message = "Por favor, completa todos los campos obligatorios.";
    } elseif (!$acepto_terminos) {
        $error_message = "Debes aceptar los términos y condiciones.";
    } elseif (strlen($password) < 6) {
        $error_message = "La contraseña debe tener al menos 6 caracteres.";
    } else {
        // Check if email already exists
        if ($user->emailExists()) {
            $error_message = "Este correo electrónico ya está registrado.";
        } else {
            // Set password and create user
            $user->password_hash = $password;
            
            if ($user->create()) {
                $success_message = "¡Cuenta creada con éxito! Serás redirigido al inicio de sesión...";
                header("refresh:3;url=login.php");
            } else {
                $error_message = "Error al crear la cuenta. Por favor, inténtalo de nuevo.";
            }
        }
    }
}

include 'includes/header.php';
?>

<section>
    <div class="modal-content">
        <h2>¿Aún no tienes cuenta? Regístrate</h2>

        <?php if ($error_message): ?>
            <div class="alert alert-error mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>

        <?php if ($success_message): ?>
            <div class="alert alert-success mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                <?php echo $success_message; ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-section-title">Información Personal</div>

            <label for="nombre">Nombre *</label>
            <input type="text" id="nombre" name="nombre" required value="<?php echo htmlspecialchars($_POST['nombre'] ?? ''); ?>">

            <label for="apellido-paterno">Apellido paterno *</label>
            <input type="text" id="apellido-paterno" name="apellido" required value="<?php echo htmlspecialchars($_POST['apellido'] ?? ''); ?>">

            <label for="fecha-nacimiento">Fecha de nacimiento *</label>
            <input type="date" id="fecha-nacimiento" name="fecha_nacimiento" required value="<?php echo htmlspecialchars($_POST['fecha_nacimiento'] ?? ''); ?>">

            <div class="document-section">
                <div class="input-group">
                    <label for="tipo-documento">Tipo de documento *</label>
                    <div class="select-wrapper">
                        <select id="tipo-documento" name="tipo_documento" required>
                            <option value="">Selecciona</option>
                            <option value="dni" <?php echo ($_POST['tipo_documento'] ?? '') === 'dni' ? 'selected' : ''; ?>>DNI</option>
                            <option value="ce" <?php echo ($_POST['tipo_documento'] ?? '') === 'ce' ? 'selected' : ''; ?>>Carnet de Extranjería</option>
                            <option value="pasaporte" <?php echo ($_POST['tipo_documento'] ?? '') === 'pasaporte' ? 'selected' : ''; ?>>Pasaporte</option>
                        </select>
                        <i class="fas fa-caret-down select-arrow"></i>
                    </div>
                </div>

                <div class="input-group">
                    <label for="numero-documento">Número de documento *</label>
                    <input type="text" id="numero-documento" name="numero_documento" required value="<?php echo htmlspecialchars($_POST['numero_documento'] ?? ''); ?>">
                </div>
            </div>

            <p class="document-help-text">
                Verifica el correcto ingreso de tu documento de identidad, esto facilitará la entrega de tu pedido, cambios, devoluciones, uso de garantías y servicio técnico
            </p>

            <label for="celular">Celular *</label>
            <input type="tel" id="celular" name="celular" required value="<?php echo htmlspecialchars($_POST['celular'] ?? ''); ?>">
            <p class="help-text">
                Con tu número celular correcto podremos comunicarnos contigo para la entrega de tu pedido
            </p>

            <div class="form-section-title">Información de inicio de sesión</div>

            <label for="correo-electronico">Correo electrónico *</label>
            <input type="email" id="correo-electronico" name="email" required value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
            <p class="help-text">
                Tu correo electrónico será utilizado como tu usuario
            </p>

            <label for="contrasena">Contraseña *</label>
            <div class="password-input-container">
                <input type="password" id="contrasena" name="password" required>
                <span class="material-icons toggle-password" onclick="togglePasswordVisibility('contrasena')">visibility_off</span>
            </div>

            <div class="checkbox-group">
                <input type="checkbox" id="acepto-promociones" name="acepto_promociones" <?php echo isset($_POST['acepto_promociones']) ? 'checked' : ''; ?>>
                <label for="acepto-promociones">Acepto el uso de mi información para <a href="#">fines adicionales</a>, quiero recibir las mejores ofertas promocionales.</label>
            </div>

            <div class="checkbox-group">
                <input type="checkbox" id="acepto-terminos" name="acepto_terminos" required <?php echo isset($_POST['acepto_terminos']) ? 'checked' : ''; ?>>
                <label for="acepto-terminos">He leído y acepto los <a href="#">Términos y Condiciones</a>, <a href="#">Políticas de protección de datos personales</a> *</label>
            </div>

            <div class="form-actions">
                <a href="login.php" class="back-link"><i class="fas fa-arrow-left"></i> Ya tengo cuenta</a>
                <button type="submit" class="btn-create-account">Crear cuenta</button>
            </div>
        </form>
    </div>
</section>

<br><br>

<script>
function togglePasswordVisibility(inputId) {
    const input = document.getElementById(inputId);
    const icon = input.nextElementSibling;
    
    if (input.type === 'password') {
        input.type = 'text';
        icon.textContent = 'visibility';
    } else {
        input.type = 'password';
        icon.textContent = 'visibility_off';
    }
}
</script>

<?php include 'includes/footer.php'; ?>
