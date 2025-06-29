<?php
session_start();

// Check if cart is not empty
if (empty($_SESSION['carrito'])) {
    $_SESSION['error'] = "Tu carrito está vacío.";
    header("Location: carrito.php");
    exit;
}

// Calculate total
$total = 0;
foreach ($_SESSION['carrito'] as $item) {
    $total += $item['precio'] * $item['cantidad'];
}

// In a real application, you would process the payment here
// For demo purposes, we'll simulate a successful payment

// Clear the cart
$_SESSION['carrito'] = [];

// Set success message
$_SESSION['message'] = "¡Compra realizada con éxito! Gracias por tu compra. Total pagado: $" . number_format($total, 2);

// Redirect to success page or home
header("Location: index.php");
exit;
?>
