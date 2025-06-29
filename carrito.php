<?php
session_start();
$page_title = "Carrito de Compras - LIVESCOMP";
$additional_css = ['css/estilo-carrito.css'];

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

$total = 0;
foreach ($_SESSION['carrito'] as $item) {
    $total += $item['precio'] * $item['cantidad'];
}

include 'includes/header.php';
?>

<main class="container mx-auto p-6 my-8 bg-white rounded-lg shadow-xl">
    <h1 class="text-4xl font-bold text-center mb-8 text-gray-800">Tu Carrito de Compras</h1>
    <hr class="border-t-2 border-blue-500 w-32 mx-auto mb-8">

    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-success mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
            <?php echo $_SESSION['message']; unset($_SESSION['message']); ?>
        </div>
    <?php endif; ?>

    <div id="productos-en-carrito-detalle" class="mb-8">
        <?php if (empty($_SESSION['carrito'])): ?>
            <p class="text-gray-500 text-center">Tu carrito está vacío. <a href="index.php" class="text-blue-600 hover:underline">Continúa comprando</a></p>
        <?php else: ?>
            <?php foreach ($_SESSION['carrito'] as $item): ?>
                <div class="producto-en-carrito-detalle bg-gray-50 p-4 rounded-lg mb-2">
                    <div class="flex justify-between items-center">
                        <div class="flex-grow">
                            <span class="font-semibold text-lg"><?php echo htmlspecialchars($item['nombre']); ?></span>
                            <div class="flex items-center mt-2">
                                <span class="text-gray-600 mr-4">Cantidad:</span>
                                <form method="POST" action="carrito_actions.php" class="inline-flex items-center">
                                    <input type="hidden" name="action" value="update">
                                    <input type="hidden" name="product_id" value="<?php echo $item['id']; ?>">
                                    <input type="number" name="quantity" value="<?php echo $item['cantidad']; ?>" min="0" max="99" class="w-16 px-2 py-1 border rounded">
                                    <button type="submit" class="ml-2 px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700">Actualizar</button>
                                </form>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="font-bold text-xl mr-4">$<?php echo number_format($item['precio'] * $item['cantidad'], 2); ?></span>
                            <form method="POST" action="carrito_actions.php" class="inline">
                                <input type="hidden" name="action" value="remove">
                                <input type="hidden" name="product_id" value="<?php echo $item['id']; ?>">
                                <button type="submit" class="btn-eliminar-producto" onclick="return confirm('¿Estás seguro de eliminar este producto?')">X</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <?php if (!empty($_SESSION['carrito'])): ?>
        <div class="flex justify-between items-center text-2xl font-semibold border-t pt-4">
            <span>Total:</span>
            <span>$<?php echo number_format($total, 2); ?></span>
        </div>

        <div class="text-center mt-8">
            <form method="POST" action="procesar_pago.php">
                <button type="submit" class="bg-green-600 text-white text-xl font-semibold px-10 py-4 rounded-full hover:bg-green-700 transition duration-300 shadow-lg">
                    Pagar con tarjeta
                </button>
            </form>
        </div>

        <div class="text-center mt-4">
            <form method="POST" action="carrito_actions.php" class="inline">
                <input type="hidden" name="action" value="clear">
                <button type="submit" class="bg-red-600 text-white text-lg font-semibold px-8 py-3 rounded-full hover:bg-red-700 transition duration-300 shadow-lg" onclick="return confirm('¿Estás seguro de vaciar el carrito?')">
                    Vaciar Carrito
                </button>
            </form>
        </div>
    <?php endif; ?>

    <div class="text-center mt-10">
        <a href="index.php" class="inline-block bg-blue-600 text-white text-lg font-semibold px-8 py-3 rounded-full hover:bg-blue-700 transition duration-300 shadow-lg">
            Continuar Comprando
        </a>
    </div>
</main>

<?php include 'includes/footer.php'; ?>
