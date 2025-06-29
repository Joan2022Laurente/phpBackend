<?php
session_start();
$page_title = "LIVESCOMP - Tecnología que Vive Contigo";

// Include database and product class
include_once 'config/database.php';
include_once 'classes/Product.php';

// Get database connection
$database = new Database();
$db = $database->getConnection();

// Initialize product object
$product = new Product($db);

// Get featured products
$featured_products = $product->getAll();

include 'includes/header.php';
?>

<section class="hero-carousel-css">
    <div class="slide-track">
        <div class="slide"><img src="img/portadaa.jpg" alt="Portada 1" /></div>
        <div class="slide"><img src="img/portada2.webp" alt="Portada 2" /></div>
        <div class="slide"><img src="img/portada3.webp" alt="Portada 3" /></div>
        <div class="slide"><img src="img/portada4.webp" alt="Portada 4" /></div>
    </div>
    <div class="hero-button">
        <a href="#ofertas" class="cta-btn">EMPIEZA YAo ➜</a>
    </div>
</section>

<div class="banner">
    <span>Compra en Cuotas <strong>sin tarjeta</strong></span>
    <span class="efectiva">Efectiva Tu financiera</span>
    <a href="#">Ver Ofertas</a>
    <a href="#">Ver legales</a>
</div>

<div class="tarjetas">
    <div class="card">
        <div class="img-container">
            <img src="img/beneficio1.webp" alt="Beneficio 1" />
        </div>
    </div>
    <div class="card">
        <div class="img-container">
            <img src="img/beneficio2.webp" alt="Beneficio 2" />
        </div>
    </div>
    <div class="card">
        <div class="img-container">
            <img src="img/beneficio3.webp" alt="Beneficio 3" />
        </div>
    </div>
</div>

<br><br><hr><br>

<div class="contenedor" id="ofertas">
    <h1>Las mejores ofertas</h1>
    <br><br><br>
    <div class="grid">
        <?php
        // Static products for demo - in real app, these would come from database
        $ofertas = [
            ['id' => 301, 'nombre' => 'GOPRO Cámara Hero 12MP 4K', 'precio' => 499, 'precio_anterior' => 529, 'imagen' => 'img/gopro.jpg'],
            ['id' => 302, 'nombre' => 'AUDÍFONOS Deportivos', 'precio' => 55, 'precio_anterior' => 109, 'imagen' => 'img/audifonos.jpg'],
            ['id' => 303, 'nombre' => 'XIAOMI Redmi A5', 'precio' => 389, 'precio_anterior' => 459, 'imagen' => 'img/xiaomi.jpg'],
            ['id' => 304, 'nombre' => 'SAMSUNG Lavadora Ecobubble', 'precio' => 1299, 'precio_anterior' => 1479, 'imagen' => 'img/samsung.jpg'],
            ['id' => 305, 'nombre' => 'LENOVO Idea Tab Pro', 'precio' => 1799, 'precio_anterior' => 2099, 'imagen' => 'img/lenovo.jpg'],
            ['id' => 306, 'nombre' => 'JBL Audífonos In Ear', 'precio' => 29, 'precio_anterior' => 79, 'imagen' => 'img/jbl.jpg'],
            ['id' => 307, 'nombre' => 'SOLE Termas', 'precio' => 0, 'precio_anterior' => 0, 'imagen' => 'img/sole.jpg'],
            ['id' => 308, 'nombre' => 'COLDEX Refrigeradora NF', 'precio' => 1549, 'precio_anterior' => 1799, 'imagen' => 'img/refrigerador.jpg']
        ];

        foreach ($ofertas as $producto):
        ?>
            <div class="card">
                <img src="<?php echo $producto['imagen']; ?>" alt="<?php echo htmlspecialchars($producto['nombre']); ?>" />
                <h3><?php echo htmlspecialchars($producto['nombre']); ?></h3>
                <p class="precio">
                    s/ <?php echo number_format($producto['precio']); ?>
                    <?php if ($producto['precio_anterior'] > 0): ?>
                        <span class="precio-anterior">Antes: s/<?php echo number_format($producto['precio_anterior']); ?></span>
                    <?php endif; ?>
                </p>
                <form method="POST" action="carrito_actions.php">
                    <input type="hidden" name="action" value="add">
                    <input type="hidden" name="product_id" value="<?php echo $producto['id']; ?>">
                    <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($producto['nombre']); ?>">
                    <input type="hidden" name="product_price" value="<?php echo $producto['precio']; ?>">
                    <button type="submit" class="add-to-cart-btn">Agregar al carrito</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<div class="carrusel-marcas">
    <div class="carrusel-track">
        <img src="img/audio.jpeg" alt="Audio" />
        <img src="img/computacion.png" alt="Computación" />
        <img src="img/electrohogar.png" alt="Electrohogar" />
        <img src="img/fono.jpeg" alt="Teléfonos" />
        <img src="img/videoyjuego.png" alt="Videojuegos" />
        <!-- Duplicate for seamless scroll -->
        <img src="img/audio.jpeg" alt="Audio" />
        <img src="img/computacion.png" alt="Computación" />
        <img src="img/electrohogar.png" alt="Electrohogar" />
        <img src="img/fono.jpeg" alt="Teléfonos" />
        <img src="img/videoyjuego.png" alt="Videojuegos" />
    </div>
</div>

<?php
// Include category sections (Audio, Computación, etc.)
include 'includes/category_sections.php';
?>

<section class="contenedor categoria">
    <h2>Encuentra lo que necesitas</h2>
    <div class="productos-grid">
        <a href="tecnologia.php?cat=consolas" class="card-category">
            <div class="img-container-category">
                <img src="img/consola.jpg" alt="Consolas" />
            </div>
            <div class="info-category">
                <span class="sub-category">Gamer</span>
                <h3>Consolas</h3>
            </div>
        </a>

        <a href="tecnologia.php?cat=audifonos" class="card-category">
            <div class="img-container-category">
                <img src="img/audis.jpg" alt="Audífonos" />
            </div>
            <div class="info-category">
                <span class="sub-category">Audio</span>
                <h3>Audífonos</h3>
            </div>
        </a>

        <a href="electrodomesticos.php?cat=televisores" class="card-category">
            <div class="img-container-category">
                <img src="img/teles.jpg" alt="Televisores" />
            </div>
            <div class="info-category">
                <span class="sub-category">TV</span>
                <h3>Televisores</h3>
            </div>
        </a>

        <a href="tecnologia.php?cat=camaras" class="card-category">
            <div class="img-container-category">
                <img src="img/camaras.jpg" alt="Cámaras" />
            </div>
            <div class="info-category">
                <span class="sub-category">Fotografía</span>
                <h3>Cámaras</h3>
            </div>
        </a>

        <a href="componentes.php?cat=monitores" class="card-category">
            <div class="img-container-category">
                <img src="img/monitores.jpg" alt="Monitores" />
            </div>
            <div class="info-category">
                <span class="sub-category">Cómputo</span>
                <h3>Monitores</h3>
            </div>
        </a>

        <a href="componentes.php?cat=impresoras" class="card-category">
            <div class="img-container-category">
                <img src="img/impresorass.jpg" alt="Impresoras" />
            </div>
            <div class="info-category">
                <span class="sub-category">Cómputo</span>
                <h3>Impresoras</h3>
            </div>
        </a>

        <a href="componentes.php?cat=perifericos" class="card-category">
            <div class="img-container-category">
                <img src="img/mouse.jpg" alt="Periféricos" />
            </div>
            <div class="info-category">
                <span class="sub-category">Gamer</span>
                <h3>Periféricos</h3>
            </div>
        </a>

        <a href="componentes.php?cat=sillas" class="card-category">
            <div class="img-container-category">
                <img src="img/sillagamer.jpg" alt="Sillas" />
            </div>
            <div class="info-category">
                <span class="sub-category">Gamer</span>
                <h3>Sillas</h3>
            </div>
        </a>
    </div>
</section>

<section class="contenedor popular-searches">
    <h2>Búsquedas populares</h2>
    <div class="search-tags-grid">
        <?php
        $popular_searches = [
            "Audífonos Inalámbricos", "Parlantes Portatil", "Teclado", "Relojes Smart Watch",
            "Cargador", "Audífonos Inalambricos Bluetooth", "Tp-Link Deco E4 Wi-Fi Mesh",
            "Camaras Seguridad", "Audífonos Jbl", "Charge 6", "Smartwach", "Camara",
            "Ps5", "Disco Duro", "Macbook", "Computadora", "Teclado Inalambrico",
            "Trípode", "Iphone 13", "Cargador Portátil Batería", "Adaptador", "Mando",
            "Reloj", "Go Pro", "Aire Acondicionado", "Electrodomésticos", "Terma",
            "Ventilador", "Televisor", "Impresora", "Monitor"
        ];

        foreach ($popular_searches as $search):
        ?>
            <a href="buscar.php?q=<?php echo urlencode($search); ?>" class="search-tag"><?php echo htmlspecialchars($search); ?></a>
        <?php endforeach; ?>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
