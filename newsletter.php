<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // In a real application, you would save this to a database
        // For now, we'll just show a success message
        $_SESSION['message'] = "¡Gracias por suscribirte! Recibirás nuestras mejores ofertas en tu correo.";
    } else {
        $_SESSION['error'] = "Por favor, ingresa un correo electrónico válido.";
    }
}

// Redirect back to the referring page
$redirect = $_SERVER['HTTP_REFERER'] ?? 'index.php';
header("Location: $redirect");
exit;
?>
