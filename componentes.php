<?php
session_start();
$page_title = "Componentes y Accesorios - LIVESCOMP";
$additional_css = ['css/categorias.css'];

// Get category filter if provided
$categoria_filter = $_GET['cat'] ?? '';

include 'includes/header.php';
?>

<main class="componentes">
    <h1>Componentes y Accesorios</h1>
    
    <?php if ($categoria_filter): ?>
        <p class="text-center text-gray-600 mb-6">Mostrando productos de: <strong><?php echo htmlspecialchars($categoria_filter); ?></strong></p>
    <?php endif; ?>
    
    <div class="product-grid">
        <?php
        // Static products for demo
        $productos_componentes = [
            ['id' => 201, 'nombre' => 'Tarjeta gráfica RTX 3080', 'descripcion' => 'Potente tarjeta para gaming y edición con tecnología ray tracing.', 'precio' => 899, 'imagen' => 'https://promart.vteximg.com.br/arquivos/ids/6460495-1000-1000/image-0f4b996d68fb47c49c59f3d8eaa3b88c.jpg?v=637969760447770000', 'categoria' => 'tarjetas-graficas'],
            ['id' => 202, 'nombre' => 'Memoria RAM 16GB DDR4', 'descripcion' => 'Módulo de alta velocidad para mejorar el rendimiento del sistema.', 'precio' => 79, 'imagen' => 'https://promart.vteximg.com.br/arquivos/ids/7483483-1000-1000/image-d335c2102088466691a577fba06f7b2a.jpg?v=638307787212530000', 'categoria' => 'memoria'],
            ['id' => 203, 'nombre' => 'Hub USB 7 en 1', 'descripcion' => 'Expande tus puertos con múltiples conexiones USB y HDMI.', 'precio' => 45, 'imagen' => 'https://rimage.ripley.com.pe/home.ripley/Attachment/MKP/2239/PMP20000273298/full_image-1.jpeg', 'categoria' => 'accesorios']
        ];

        // Filter products if category is specified
        if ($categoria_filter) {
            $productos_componentes = array_filter($productos_componentes, function($producto) use ($categoria_filter) {
                return $producto['categoria'] === $categoria_filter;
            });
        }

        foreach ($productos_componentes as $producto):
        ?>
            <div class="product-card">
                <img src="<?php echo $producto['imagen']; ?>" alt="<?php echo htmlspecialchars($producto['nombre']); ?>">
                <h2><?php echo htmlspecialchars($producto['nombre']); ?></h2>
                <p><?php echo htmlspecialchars($producto['descripcion']); ?></p>
                <span>$<?php echo number_format($producto['precio']); ?></span>
                <form method="POST" action="carrito_actions.php">
                    <input type="hidden" name="action" value="add">
                    <input type="hidden" name="product_id" value="<?php echo $producto['id']; ?>">
                    <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($producto['nombre']); ?>">
                    <input type="hidden" name="product_price" value="<?php echo $producto['precio']; ?>">
                    <button type="submit" class="add-to-cart-btn">Agregar al carrito</button>
                </form>
            </div>
        <?php endforeach; ?>
        
        <?php if (empty($productos_componentes)): ?>
            <div class="col-span-full text-center py-8">
                <p class="text-gray-500 text-lg">No se encontraron productos en esta categoría.</p>
                <a href="componentes.php" class="text-blue-600 hover:underline">Ver todos los componentes</a>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php include 'includes/footer.php'; ?>
