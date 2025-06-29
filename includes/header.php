<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Initialize cart if not exists
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

// Calculate cart count
$cart_count = 0;
foreach ($_SESSION['carrito'] as $item) {
    $cart_count += $item['cantidad'];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title : 'LIVESCOMP'; ?></title>
    <link rel="stylesheet" href="css/main.css">
    <?php if (isset($additional_css)): ?>
        <?php foreach ($additional_css as $css): ?>
            <link rel="stylesheet" href="<?php echo $css; ?>">
        <?php endforeach; ?>
    <?php endif; ?>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    <header class="header">
        <div class="top-bar">
            <div class="logo">
                <a href="index.php">
                    <span class="logo-text">LIVES<span>COMP</span></span>
                </a>
            </div>
            <form method="GET" action="buscar.php" style="display: flex; flex-grow: 1; max-width: 600px; margin: 0 16px;">
                <input type="text" name="q" class="search-box" placeholder="Buscar..." value="<?php echo isset($_GET['q']) ? htmlspecialchars($_GET['q']) : ''; ?>" />
            </form>
            
            <div id="hamburger" onclick="toggleMobileMenu()">☰</div>
            
            <nav id="nav-menu" class="menu">
                <ul class="menu-horizontal">
                    <li>
                        <a href="#">Categorías▾</a>
                        <ul class="menu-vertical">
                            <li><a href="tecnologia.php">Tecnología</a></li>
                            <li><a href="componentes.php">Componentes y <br>Accesorios</a></li>
                            <li><a href="electrodomesticos.php">Electrodomésticos</a></li>
                        </ul>
                    </li>
                    <li><a href="pedidos.php">📦 Mis pedidos</a></li>
                    <li>
                        <a href="#"><span class="material-icons">account_circle</span> Mi cuenta</a>
                        <ul class="menu-vertical">
                            <?php if (isset($_SESSION['usuario_id'])): ?>
                                <li><a href="perfil.php">Mi Perfil</a></li>
                                <li><a href="logout.php">Cerrar Sesión</a></li>
                            <?php else: ?>
                                <li><a href="login.php">Iniciar sesión</a></li>
                                <li><a href="registro.php">Crear cuenta</a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                    <li class="carrito-contenedor">
                        <a href="carrito.php" id="icono-carrito">
                            <span class="carrito-emoji">🛒</span>
                            <span id="contador-carrito" class="contador-carrito"><?php echo $cart_count; ?></span>
                        </a>
                        <div id="productos-carrito" class="productos-carrito">
                            <h2>Tu Carrito</h2>
                            <div id="lista-productos-carrito" class="lista-productos-carrito">
                                <?php if (empty($_SESSION['carrito'])): ?>
                                    <p>El carrito está vacío.</p>
                                <?php else: ?>
                                    <?php 
                                    $total = 0;
                                    foreach ($_SESSION['carrito'] as $item): 
                                        $subtotal = $item['precio'] * $item['cantidad'];
                                        $total += $subtotal;
                                    ?>
                                        <div class="producto-en-carrito">
                                            <span><?php echo htmlspecialchars($item['nombre']); ?> (x<?php echo $item['cantidad']; ?>)</span>
                                            <span>$<?php echo number_format($subtotal, 2); ?></span>
                                            <form method="POST" action="carrito_actions.php" style="display: inline;">
                                                <input type="hidden" name="action" value="remove">
                                                <input type="hidden" name="product_id" value="<?php echo $item['id']; ?>">
                                                <button type="submit" class="btn-eliminar-producto">X</button>
                                            </form>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                            <div class="resumen-carrito">
                                <p>Total: $<span id="total-carrito"><?php echo number_format($total ?? 0, 2); ?></span></p>
                                <a href="carrito.php" id="btn-ir-pagar" class="btn-ir-pagar">Ir a Pagar</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </nav>
        </div>

        <nav id="nav-menu-mobile" class="menu-vertical-mobile" style="display: none;">
            <ul>
                <li><a href="tecnologia.php">Tecnología</a></li>
                <li><a href="componentes.php">Componentes y Accesorios</a></li>
                <li><a href="electrodomesticos.php">Electrodomésticos</a></li>
                <li><a href="pedidos.php">📦 Mis pedidos</a></li>
                <?php if (isset($_SESSION['usuario_id'])): ?>
                    <li><a href="perfil.php"><span class="material-icons">account_circle</span> Mi Perfil</a></li>
                    <li><a href="logout.php">Cerrar Sesión</a></li>
                <?php else: ?>
                    <li><a href="login.php"><span class="material-icons">account_circle</span> Iniciar sesión</a></li>
                    <li><a href="registro.php">Crear cuenta</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <script>
        function toggleMobileMenu() {
            const menu = document.getElementById('nav-menu-mobile');
            menu.style.display = menu.style.display === 'none' ? 'flex' : 'none';
        }
    </script>
