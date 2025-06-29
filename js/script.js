document.getElementById("hamburger").addEventListener("click", function () {
      document.getElementById("nav-menu-mobile").classList.toggle("show");
    });
document.querySelector('.newsletter-form').addEventListener('submit', function(e) {
  const emailInput = this.querySelector('input[type="email"]');
  if (!emailInput.value) {
    e.preventDefault();
    alert('Por favor, ingresa un correo electrónico válido.');
  }
});


document.addEventListener('DOMContentLoaded', () => {
    const contadorCarrito = document.getElementById('contador-carrito');
    const iconoCarrito = document.getElementById('icono-carrito');
    const productosCarritoDiv = document.getElementById('productos-carrito');
    const listaProductosCarrito = document.getElementById('lista-productos-carrito');
    const totalCarritoSpan = document.getElementById('total-carrito');
    const btnIrPagar = document.getElementById('btn-ir-pagar');

    // Array para almacenar los productos en el carrito
    let carrito = JSON.parse(localStorage.getItem('carrito')) || [];

    // Función para actualizar el carrito (contador, lista, total)
    function actualizarCarritoUI() {
        // Actualizar contador
        const totalProductos = carrito.reduce((sum, item) => sum + item.cantidad, 0);
        contadorCarrito.textContent = totalProductos;
        if (totalProductos > 0) {
            contadorCarrito.style.display = 'block';
        } else {
            contadorCarrito.style.display = 'none';
        }

        // Actualizar lista de productos
        listaProductosCarrito.innerHTML = ''; // Limpiar la lista actual
        if (carrito.length === 0) {
            listaProductosCarrito.innerHTML = '<p>El carrito está vacío.</p>';
        } else {
            carrito.forEach(producto => {
                const productoDiv = document.createElement('div');
                productoDiv.innerHTML = `
                    <span>${producto.nombre} (x${producto.cantidad})</span>
                    <span>$${(producto.precio * producto.cantidad).toFixed(2)}</span>
                    <button data-id="${producto.id}">Quitar</button>
                `;
                listaProductosCarrito.appendChild(productoDiv);
            });
        }

        // Actualizar total
        const total = carrito.reduce((sum, item) => sum + (item.precio * item.cantidad), 0);
        totalCarritoSpan.textContent = total.toFixed(2);

        // Guardar el carrito en localStorage
        localStorage.setItem('carrito', JSON.stringify(carrito));
    }

    // Función para añadir productos al carrito
    // Debes llamar a esta función cuando un usuario haga clic en "Añadir al carrito"
    function añadirProducto(producto) {
        const productoExistente = carrito.find(item => item.id === producto.id);

        if (productoExistente) {
            productoExistente.cantidad++;
        } else {
            carrito.push({ ...producto, cantidad: 1 });
        }
        actualizarCarritoUI();
    }

   

    // Ocultar el carrito si se hace clic fuera de él
    document.addEventListener('click', (e) => {
        if (!productosCarritoDiv.contains(e.target) && !iconoCarrito.contains(e.target)) {
            productosCarritoDiv.classList.remove('visible');
        }
    });

    // Evento para quitar productos del carrito
    listaProductosCarrito.addEventListener('click', (e) => {
        if (e.target.tagName === 'BUTTON') {
            const productId = parseInt(e.target.dataset.id);
            carrito = carrito.filter(item => item.id !== productId);
            actualizarCarritoUI();
        }
    });

    // Evento para el botón "Ir a Pagar"
    btnIrPagar.addEventListener('click', () => {
        if (carrito.length > 0) {
            window.location.href = 'pagar.html'; // Redirige a la página de pago
        } else {
            alert('Tu carrito está vacío. ¡Añade algunos productos antes de pagar!');
        }
    });

    // Inicializar el carrito al cargar la página
    actualizarCarritoUI();

    // --- EJEMPLO: Cómo añadir productos (lo integrarías con tus botones de producto) ---
    // Simula algunos productos disponibles
 const productosDisponibles = [
  { id: 1, nombre: 'Tarjeta gráfica RTX 3080', precio: 899 },
  { id: 2, nombre: 'Memoria RAM 16GB DDR4', precio: 79 },
  { id: 3, nombre: 'Hub USB 7 en 1', precio: 45 },
  { id: 101, nombre: 'Smartwatch Lux', precio: 249 },
  { id: 102, nombre: 'Auriculares Pro', precio: 199 },
  { id: 103, nombre: 'Cámara 4K Elite', precio: 799 },
  { id: 201, nombre: 'Lavadora Automática', precio: 549 },
  { id: 202, nombre: 'Robot Aspirador', precio: 399 },
  { id: 203, nombre: 'Microondas Digital', precio: 179 },
  { id: 301, nombre: 'GoPro Hero 12MP 4K', precio: 499 },
  { id: 302, nombre: 'Audífonos Deportivos', precio: 55 },
  { id: 303, nombre: 'Xiaomi Redmi A5', precio: 389 },
  { id: 304, nombre: 'Lavadora Ecobubble Samsung', precio: 1299 },
  { id: 305, nombre: 'Tablet Lenovo Idea Tab Pro', precio: 1799 },
  { id: 306, nombre: 'Audífonos JBL In Ear', precio: 29 },
  { id: 307, nombre: 'Termotanque Sole', precio: 0 }, // Precio no especificado, puedes ajustarlo
  { id: 308, nombre: 'Refrigeradora Coldex NF Negra', precio: 1549 },
  { id: 309, nombre: 'JBL Parlante Inalámbrico', precio: 1899 },
  { id: 310, nombre: 'LG Torre de Sonido Karaoke', precio: 849 },
  { id: 311, nombre: 'Sony Parlante Bluetooth', precio: 1299 },
  { id: 312, nombre: 'Amazon Echo Dot 4ta Gen', precio: 189 },
  { id: 313, nombre: 'Lenovo Laptop Gamer 15.6”', precio: 3099 },
  { id: 314, nombre: 'HP Laptop Gamer Victus', precio: 3389 },
  { id: 315, nombre: 'Asus Vivobook 15.6”', precio: 1949 },
  { id: 316, nombre: 'Epson Impresora Multifuncional', precio: 999 },
  { id: 317, nombre: 'Oster Licuadora 700W', precio: 199 },
  { id: 318, nombre: 'LG Microondas 23L', precio: 349 },
  { id: 319, nombre: 'Electrolux Plancha a vapor', precio: 89 },
  { id: 320, nombre: 'Philips Freidora sin aceite', precio: 499 },
  { id: 321, nombre: 'Samsung A34 128GB 5G', precio: 1199 },
  { id: 322, nombre: 'Apple iPhone 13 128GB', precio: 3399 },
  { id: 323, nombre: 'Motorola G73 5G 256GB', precio: 899 },
  { id: 324, nombre: 'Xiaomi Redmi Note 13 256GB', precio: 1099 },
  { id: 325, nombre: 'PlayStation 5 Estándar', precio: 2699 },
  { id: 326, nombre: 'Xbox Series S 512GB', precio: 1299 },
  { id: 327, nombre: 'Nintendo Switch Neon 32GB', precio: 1399 },
  { id: 328, nombre: 'Steam Deck 512GB OLED', precio: 2299 }
];
    document.querySelectorAll('.add-to-cart-btn').forEach(button => {
        button.addEventListener('click', (e) => {
            const productId = parseInt(e.target.dataset.productId);
            const productoAAgregar = productosDisponibles.find(p => p.id === productId);
            if (productoAAgregar) {
                añadirProducto(productoAAgregar);
            }
        });
    });

});
