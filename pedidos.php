<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

$page_title = "Mis Pedidos - LIVESCOMP";
$additional_css = ['css/estilos2.css'];

// Sample orders data - in real app, this would come from database
$pedidos = [
    [
        'fecha' => '2025-05-01',
        'nro_pedido' => '1001',
        'vencimiento' => '2025-05-05',
        'cliente' => $_SESSION['nombre'] . ' ' . $_SESSION['apellido'],
        'ejecutivo' => 'Carlos Ruiz',
        'total' => '$120.00',
        'aprobado' => 'Sí',
        'pagado' => 'Sí',
        'estatus' => 'Finalizado',
        'entrega' => 'Envío a provincia'
    ],
    [
        'fecha' => '2025-05-02',
        'nro_pedido' => '1002',
        'vencimiento' => '2025-05-06',
        'cliente' => $_SESSION['nombre'] . ' ' . $_SESSION['apellido'],
        'ejecutivo' => 'Laura Castro',
        'total' => '$200.00',
        'aprobado' => 'No',
        'pagado' => 'No',
        'estatus' => 'Pendiente',
        'entrega' => 'Recojo en agencia'
    ],
    [
        'fecha' => '2025-05-03',
        'nro_pedido' => '1003',
        'vencimiento' => '2025-05-07',
        'cliente' => $_SESSION['nombre'] . ' ' . $_SESSION['apellido'],
        'ejecutivo' => 'Carlos Ruiz',
        'total' => '$150.00',
        'aprobado' => 'Sí',
        'pagado' => 'No',
        'estatus' => 'Cancelado',
        'entrega' => 'Envío a domicilio'
    ]
];

// Filter orders based on search criteria
$filtered_pedidos = $pedidos;

if ($_SERVER['REQUEST_METHOD'] === 'GET' && !empty($_GET)) {
    $fecha_inicio = $_GET['fecha_inicio'] ?? '';
    $fecha_final = $_GET['fecha_final'] ?? '';
    $estatus = $_GET['estatus'] ?? 'Todos';
    $buscar_so = $_GET['buscar_so'] ?? '';
    
    $filtered_pedidos = array_filter($pedidos, function($pedido) use ($fecha_inicio, $fecha_final, $estatus, $buscar_so) {
        $cumple_fecha_inicio = empty($fecha_inicio) || $pedido['fecha'] >= $fecha_inicio;
        $cumple_fecha_final = empty($fecha_final) || $pedido['fecha'] <= $fecha_final;
        $cumple_estatus = $estatus === 'Todos' || $pedido['estatus'] === $estatus;
        $cumple_busqueda = empty($buscar_so) || strpos($pedido['nro_pedido'], $buscar_so) !== false;
        
        return $cumple_fecha_inicio && $cumple_fecha_final && $cumple_estatus && $cumple_busqueda;
    });
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <link rel="stylesheet" href="css/estilos2.css">
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <div class="sidebar">
        <a href="index.php">
            <span class="logo-text">LIVES<span>COMP</span></span>
        </a>
        <nav>
            <a href="index.php">Inicio</a>
            <a href="perfil.php">Mi perfil</a>
            <a href="pedidos.php" class="active">Mis pedidos</a>
            <a href="direcciones.php">Direcciones</a>
            <a href="logout.php">Cerrar sesión</a>
        </nav>
    </div>

    <div class="main-content">
        <header>
            <h1>Pedidos</h1>
        </header>

        <section class="filters">
            <form method="GET">
                <label>
                    Fecha inicio:
                    <input type="date" name="fecha_inicio" value="<?php echo $_GET['fecha_inicio'] ?? ''; ?>">
                </label>

                <label>
                    Fecha final:
                    <input type="date" name="fecha_final" value="<?php echo $_GET['fecha_final'] ?? ''; ?>">
                </label>

                <label>
                    Estatus:
                    <select name="estatus">
                        <option value="Todos" <?php echo ($_GET['estatus'] ?? 'Todos') === 'Todos' ? 'selected' : ''; ?>>Todos</option>
                        <option value="Finalizado" <?php echo ($_GET['estatus'] ?? '') === 'Finalizado' ? 'selected' : ''; ?>>Finalizado</option>
                        <option value="Cancelado" <?php echo ($_GET['estatus'] ?? '') === 'Cancelado' ? 'selected' : ''; ?>>Cancelado</option>
                        <option value="Pendiente" <?php echo ($_GET['estatus'] ?? '') === 'Pendiente' ? 'selected' : ''; ?>>Pendiente</option>
                    </select>
                </label>

                <label>
                    Buscar Nro de pedido:
                    <input type="text" name="buscar_so" placeholder="Ingrese número" value="<?php echo $_GET['buscar_so'] ?? ''; ?>">
                </label>

                <button type="submit">Buscar</button>
            </form>
        </section>

        <section class="tabla">
            <table>
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Nro de pedido</th>
                        <th>F. Vencimiento</th>
                        <th>Cliente</th>
                        <th>Ejecutivo</th>
                        <th>Total</th>
                        <th>Aprobado</th>
                        <th>Pagado</th>
                        <th>Estatus</th>
                        <th>Tipo de entrega</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($filtered_pedidos)): ?>
                        <tr>
                            <td colspan="10" style="text-align: center; padding: 20px;">No se encontraron pedidos con los criterios especificados.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($filtered_pedidos as $pedido): ?>
                            <tr>
                                <td><?php echo $pedido['fecha']; ?></td>
                                <td><?php echo $pedido['nro_pedido']; ?></td>
                                <td><?php echo $pedido['vencimiento']; ?></td>
                                <td><?php echo htmlspecialchars($pedido['cliente']); ?></td>
                                <td><?php echo $pedido['ejecutivo']; ?></td>
                                <td><?php echo $pedido['total']; ?></td>
                                <td><?php echo $pedido['aprobado']; ?></td>
                                <td><?php echo $pedido['pagado']; ?></td>
                                <td><?php echo $pedido['estatus']; ?></td>
                                <td><?php echo $pedido['entrega']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </section>

        <footer>
            <p>© 2025 Livescomp. Todos los derechos reservados.</p>
        </footer>
    </div>
</body>
</html>
