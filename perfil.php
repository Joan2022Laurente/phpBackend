<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

$page_title = "Mi Perfil - LIVESCOMP";

include 'includes/header.php';
?>

<main class="container mx-auto p-6 my-8">
    <div class="bg-white rounded-lg shadow-xl p-8">
        <h1 class="text-4xl font-bold text-center mb-8 text-gray-800">Mi Perfil</h1>
        <hr class="border-t-2 border-blue-500 w-24 mx-auto mb-8">
        
        <div class="max-w-2xl mx-auto">
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                <h2 class="text-2xl font-semibold mb-2">¡Bienvenido, <?php echo htmlspecialchars($_SESSION['nombre']); ?>! 👋</h2>
                <p>Has iniciado sesión correctamente en tu cuenta de LIVESCOMP.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-gray-50 p-6 rounded-lg">
                    <h3 class="text-xl font-semibold mb-4 text-gray-800">Información Personal</h3>
                    <p><strong>Nombre:</strong> <?php echo htmlspecialchars($_SESSION['nombre']); ?></p>
                    <p><strong>Apellido:</strong> <?php echo htmlspecialchars($_SESSION['apellido'] ?? 'No especificado'); ?></p>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($_SESSION['email']); ?></p>
                </div>
                
                <div class="bg-gray-50 p-6 rounded-lg">
                    <h3 class="text-xl font-semibold mb-4 text-gray-800">Acciones Rápidas</h3>
                    <div class="space-y-3">
                        <a href="pedidos.php" class="block bg-blue-600 text-white text-center py-2 px-4 rounded hover:bg-blue-700 transition duration-300">
                            Ver Mis Pedidos
                        </a>
                        <a href="carrito.php" class="block bg-green-600 text-white text-center py-2 px-4 rounded hover:bg-green-700 transition duration-300">
                            Ver Carrito
                        </a>
                        <a href="index.php" class="block bg-gray-600 text-white text-center py-2 px-4 rounded hover:bg-gray-700 transition duration-300">
                            Continuar Comprando
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-8">
                <a href="logout.php" class="inline-block bg-red-600 text-white text-lg font-semibold px-8 py-3 rounded-full hover:bg-red-700 transition duration-300 shadow-lg">
                    Cerrar Sesión
                </a>
            </div>
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>
