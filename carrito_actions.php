<?php
session_start();

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    
    switch ($action) {
        case 'add':
            $product_id = (int)$_POST['product_id'];
            $product_name = $_POST['product_name'];
            $product_price = (float)$_POST['product_price'];
            
            // Check if product already exists in cart
            $found = false;
            foreach ($_SESSION['carrito'] as &$item) {
                if ($item['id'] == $product_id) {
                    $item['cantidad']++;
                    $found = true;
                    break;
                }
            }
            
            // If not found, add new item
            if (!$found) {
                $_SESSION['carrito'][] = [
                    'id' => $product_id,
                    'nombre' => $product_name,
                    'precio' => $product_price,
                    'cantidad' => 1
                ];
            }
            
            $_SESSION['message'] = "Producto agregado al carrito";
            break;
            
        case 'remove':
            $product_id = (int)$_POST['product_id'];
            $_SESSION['carrito'] = array_filter($_SESSION['carrito'], function($item) use ($product_id) {
                return $item['id'] != $product_id;
            });
            $_SESSION['carrito'] = array_values($_SESSION['carrito']); // Reindex array
            $_SESSION['message'] = "Producto eliminado del carrito";
            break;
            
        case 'update':
            $product_id = (int)$_POST['product_id'];
            $quantity = (int)$_POST['quantity'];
            
            if ($quantity <= 0) {
                $_SESSION['carrito'] = array_filter($_SESSION['carrito'], function($item) use ($product_id) {
                    return $item['id'] != $product_id;
                });
                $_SESSION['carrito'] = array_values($_SESSION['carrito']);
            } else {
                foreach ($_SESSION['carrito'] as &$item) {
                    if ($item['id'] == $product_id) {
                        $item['cantidad'] = $quantity;
                        break;
                    }
                }
            }
            $_SESSION['message'] = "Carrito actualizado";
            break;
            
        case 'clear':
            $_SESSION['carrito'] = [];
            $_SESSION['message'] = "Carrito vaciado";
            break;
    }
}

// Redirect back to referring page or cart
$redirect = $_SERVER['HTTP_REFERER'] ?? 'carrito.php';
header("Location: $redirect");
exit;
?>
