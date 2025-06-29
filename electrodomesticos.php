<?php
session_start();
$page_title = "Electrodomésticos - LIVESCOMP";
$additional_css = ['css/categorias.css'];

// Get category filter if provided
$categoria_filter = $_GET['cat'] ?? '';

include 'includes/header.php';
?>

<main class="electrodomesticos container mx-auto p-6">
    <h1 class="text-4xl font-bold text-center mb-10 text-gray-800">Electrodomésticos</h1>
    
    <?php if ($categoria_filter): ?>
        <p class="text-center text-gray-600 mb-6">Mostrando productos de: <strong><?php echo htmlspecialchars($categoria_filter); ?></strong></p>
    <?php endif; ?>
    
    <div class="product-grid grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php
        // Static products for demo
        $productos_electrodomesticos = [
            ['id' => 301, 'nombre' => 'Lavadora Automática', 'descripcion' => 'Capacidad de 10kg, eficiente y silenciosa para tu hogar.', 'precio' => 549, 'imagen' => 'https://www.efe.com.pe/media/catalog/product/l/m/lma6120wdgbb0_1.jpg?quality=80&bg-color=255,255,255&fit=bounds&height=700&width=700&canvas=700:700', 'categoria' => 'lavadoras'],
            ['id' => 302, 'nombre' => 'Robot Aspirador', 'descripcion' => 'Limpieza automática, control inteligente vía app móvil.', 'precio' => 399, 'imagen' => 'https://electroluxpe.vtexassets.com/arquivos/ids/159941/Robot_Vacuum_ERB40_Perspective_Electrolux_1000x1000.jpg?v=638131254693100000', 'categoria' => 'aspiradoras'],
            ['id' => 303, 'nombre' => 'Microondas Digital', 'descripcion' => 'Potencia de 1000W con varias funciones preestablecidas.', 'precio' => 179, 'imagen' => 'https://www.inche.com.pe/wp-content/uploads/2023/05/MWI-32TNEP-2.jpg', 'categoria' => 'microondas']
        ];

        // Filter products if category is specified
        if ($categoria_filter) {
            $productos_electrodomesticos = array_filter($productos_electrodomesticos, function($producto) use ($categoria_filter) {
                return $producto['categoria'] === $categoria_filter;
            });
        }

        foreach ($productos_electrodomesticos as $producto):
        ?>
            <div class="product-card bg-white rounded-lg shadow-lg p-6 flex flex-col items-center text-center transition-transform transform hover:scale-105">
                <img src="<?php echo $producto['imagen']; ?>" alt="<?php echo htmlspecialchars($producto['nombre']); ?>" class="w-48 h-48 object-contain mb-4 rounded-md">
                <h2 class="text-xl font-semibold mb-2 text-gray-800"><?php echo htmlspecialchars($producto['nombre']); ?></h2>
                <p class="text-gray-600 mb-4 flex-grow"><?php echo htmlspecialchars($producto['descripcion']); ?></p>
                <span class="price text-2xl font-bold text-blue-600 mb-4">$<?php echo number_format($producto['precio'], 2); ?></span>
                <form method="POST" action="carrito_actions.php">
                    <input type="hidden" name="action" value="add">
                    <input type="hidden" name="product_id" value="<?php echo $producto['id']; ?>">
                    <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($producto['nombre']); ?>">
                    <input type="hidden" name="product_price" value="<?php echo $producto['precio']; ?>">
                    <button type="submit" class="add-to-cart-btn bg-blue-600 text-white px-6 py-3 rounded-full hover:bg-blue-700 transition duration-300">Agregar al carrito</button>
                </form>
            </div>
        <?php endforeach; ?>
        
        <?php if (empty($productos_electrodomesticos)): ?>
            <div class="col-span-full text-center py-8">
                <p class="text-gray-500 text-lg">No se encontraron productos en esta categoría.</p>
                <a href="electrodomesticos.php" class="text-blue-600 hover:underline">Ver todos los electrodomésticos</a>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php include 'includes/footer.php'; ?>
