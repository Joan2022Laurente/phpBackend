<?php
session_start();
$page_title = "Tecnología - LIVESCOMP";
$additional_css = ['css/categorias.css'];

// Get category filter if provided
$categoria_filter = $_GET['cat'] ?? '';

include 'includes/header.php';
?>

<main class="tecnologia container mx-auto p-6">
    <h1 class="text-4xl font-bold text-center mb-10 text-gray-800">Tecnología</h1>
    
    <?php if ($categoria_filter): ?>
        <p class="text-center text-gray-600 mb-6">Mostrando productos de: <strong><?php echo htmlspecialchars($categoria_filter); ?></strong></p>
    <?php endif; ?>
    
    <div class="product-grid grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php
        // Static products for demo - in real app, these would come from database
        $productos_tecnologia = [
            ['id' => 101, 'nombre' => 'Smartwatch Lux', 'descripcion' => 'Reloj inteligente con acabado en acero y correa de piel.', 'precio' => 249, 'imagen' => 'https://www.lacuracao.pe/media/catalog/product/t/e/tech100128_1.jpg?quality=80&bg-color=255,255,255&fit=bounds&height=700&width=700&canvas=700:700', 'categoria' => 'smartwatch'],
            ['id' => 102, 'nombre' => 'Auriculares Pro', 'descripcion' => 'Sonido envolvente, cancelación de ruido activa.', 'precio' => 199, 'imagen' => 'https://pe.tiendasishop.com/cdn/shop/files/mqtt3be_a_1.webp?v=1726582177', 'categoria' => 'audifonos'],
            ['id' => 103, 'nombre' => 'Cámara 4K Elite', 'descripcion' => 'Grabación ultra alta definición con lente de precisión.', 'precio' => 799, 'imagen' => 'https://retu.lv/cdn/shop/files/jh4xwcki_full.png?v=1711933600&width=1445', 'categoria' => 'camaras']
        ];

        // Filter products if category is specified
        if ($categoria_filter) {
            $productos_tecnologia = array_filter($productos_tecnologia, function($producto) use ($categoria_filter) {
                return $producto['categoria'] === $categoria_filter;
            });
        }

        foreach ($productos_tecnologia as $producto):
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
        
        <?php if (empty($productos_tecnologia)): ?>
            <div class="col-span-full text-center py-8">
                <p class="text-gray-500 text-lg">No se encontraron productos en esta categoría.</p>
                <a href="tecnologia.php" class="text-blue-600 hover:underline">Ver todos los productos de tecnología</a>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php include 'includes/footer.php'; ?>
