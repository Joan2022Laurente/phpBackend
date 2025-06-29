<?php
session_start();

// If user is already logged in, redirect to profile
if (isset($_SESSION['usuario_id'])) {
    header("Location: perfil.php");
    exit;
}

$page_title = "Iniciar Sesión - LIVESCOMP";
$additional_css = ['css/MiCuenta.css', 'css/categorias.css'];

$error_message = '';
$success_message = '';

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include_once 'config/database.php';
    include_once 'classes/User.php';
    
    $database = new Database();
    $db = $database->getConnection();
    $user = new User($db);
    
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if (empty($email) || empty($password)) {
        $error_message = "Por favor, completa todos los campos.";
    } else {
        if ($user->login($email, $password)) {
            $_SESSION['usuario_id'] = $user->id;
            $_SESSION['nombre'] = $user->nombre;
            $_SESSION['apellido'] = $user->apellido;
            $_SESSION['email'] = $user->email;
            
            $success_message = "¡Bienvenido, " . htmlspecialchars($user->nombre) . "! Redirigiendo...";
            header("refresh:2;url=index.php");
        } else {
            $error_message = "Correo o contraseña incorrectos.";
        }
    }
}

include 'includes/header.php';
?>

<section class="login-register-page-content">
    <div class="container">
        <div class="card registered-clients">
            <h2>Clientes registrados</h2>
            <p>Si tiene una cuenta, inicie sesión con su dirección de correo electrónico.</p>

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
                <label for="email-reg">Correo electrónico *</label>
                <input type="email" id="email-reg" name="email" placeholder="nombre@dominio.com" required value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">

                <label for="password-reg">Contraseña *</label>
                <div class="password-input-container">
                    <input type="password" id="password-reg" name="password" placeholder="Aa12345" required>
                    <span class="material-icons toggle-password" onclick="togglePasswordVisibility('password-reg')">visibility_off</span>
                </div>

                <a href="recuperar_password.php" class="forgot-password">¿Olvidaste tu contraseña?</a>
                <button type="submit" class="btn-ingresar">Iniciar sesión</button>
            </form>
        </div>

        <div class="card new-clients">
            <h2>Clientes nuevos</h2>
            <p>Regístrate en Livescomp.com.pe para:</p>
            <br>
            <ul>
                <li>Realizar compras de manera rápida y segura.</li>
                <li>Acceder a las mejores ofertas y promociones.</li>
                <li>Tener el mejor servicio al cliente y la garantía que nos caracteriza.</li>
            </ul>

            <a href="registro.php" class="btn-create-account">Crea tu cuenta</a>
        </div>
    </div>
</section>

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
