<?php
session_start();
$page_title = "Resultados de Búsqueda - LIVESCOMP";
$additional_css = ['css/categorias.css'];

$query = $_GET['q'] ?? '';
$results = [];

if (!empty($query)) {
    // In a real application, this would search the database
    // For demo purposes, we'll search through static product data
    $all_products = [
        ['id' => 101, 'nombre' => 'Smartwatch Lux', 'descripcion' => 'Reloj inteligente con acabado en acero y correa de piel.', 'precio' => 249, 'categoria' => 'tecnologia'],
        ['id' => 102, 'nombre' => 'Auriculares Pro', 'descripcion' => 'Sonido envolvente, cancelación de ruido activa.', 'precio' => 199, 'categoria' => 'tecnologia'],
        ['id' => 103, 'nombre' => 'Cámara 4K Elite', 'descripcion' => 'Grabación ultra alta definición con lente de precisión.', 'precio' => 799, 'categoria' => 'tecnologia'],
        ['id' => 201, 'nombre' => 'Tarjeta gráfica RTX 3080', 'descripcion' => 'Potente tarjeta para gaming y edición con tecnología ray tracing.', 'precio' => 899, 'categoria' => 'componentes'],
        ['id' => 202, 'nombre' => 'Memoria RAM 16GB DDR4', 'descripcion' => 'Módulo de alta velocidad para mejorar el rendimiento del sistema.', 'precio' => 79, 'categoria' => 'componentes'],
        ['id' => 301, 'nombre' => 'Lavadora Automática', 'descripcion' => 'Capacidad de 10kg, eficiente y silenciosa para tu hogar.', 'precio' => 549, 'categoria' => 'electrodomesticos'],
        ['id' => 302, 'nombre' => 'Robot Aspirador', 'descripcion' => 'Limpieza automática, control inteligente vía app móvil.', 'precio' => 399, 'categoria' => 'electrodomesticos']
    ];
    
    $query_lower = strtolower($query);
    $results = array_filter($all_products, function($product) use ($query_lower) {
        return strpos(strtolower($product['nombre']), $query_lower) !== false ||
               strpos(strtolower($product['descripcion']), $query_lower) !== false;
    });
}

include 'includes/header.php';
?>

<main class="container mx-auto p-6">
    <h1 class="text-4xl font-bold text-center mb-8 text-gray-800">Resultados de Búsqueda</h1>
    
    <?php if (!empty($query)): ?>
        <p class="text-center text-gray-600 mb-8">
            Mostrando resultados para: <strong>"<?php echo htmlspecialchars($query); ?>"</strong>
            (<?php echo count($results); ?> productos encontrados)
        </p>
    <?php endif; ?>

    <?php if (empty($query)): ?>
        <div class="text-center py-8">
            <p class="text-gray-500 text-lg">Por favor, ingresa un término de búsqueda.</p>
            <a href="index.php" class="text-blue-600 hover:underline">Volver al inicio</a>
        </div>
    <?php elseif (empty($results)): ?>
        <div class="text-center py-8">
            <p class="text-gray-500 text-lg">No se encontraron productos que coincidan con tu búsqueda.</p>
            <p class="text-gray-400 mt-2">Intenta con otros términos o navega por nuestras categorías.</p>
            <div class="mt-4">
                <a href="tecnologia.php" class="text-blue-600 hover:underline mr-4">Tecnología</a>
                <a href="componentes.php" class="text-blue-600 hover:underline mr-4">Componentes</a>
                <a href="electrodomesticos.php" class="text-blue-600 hover:underline">Electrodomésticos</a>
            </div>
        </div>
    <?php else: ?>
        <div class="product-grid grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            <?php foreach ($results as $producto): ?>
                <div class="product-card bg-white rounded-lg shadow-lg p-6 flex flex-col items-center text-center transition-transform transform hover:scale-105">
                    <div class="w-48 h-48 bg-gray-200 rounded-md mb-4 flex items-center justify-center">
                        <span class="text-gray-500">Imagen del producto</span>
                    </div>
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
        </div>
    <?php endif; ?>
</main>

<?php include 'includes/footer.php'; ?>
