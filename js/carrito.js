// Script para el menú móvil (se mantiene para la navegación general)
document.addEventListener('DOMContentLoaded', () => {
    const hamburger = document.getElementById('hamburger');
    const navMenuMobile = document.getElementById('nav-menu-mobile');

    if (hamburger && navMenuMobile) {
        hamburger.addEventListener('click', () => {
            navMenuMobile.classList.toggle('active');
        });
    }

    loadCart(); // Cargar y mostrar el carrito al cargar la página

    const btnPagarTarjeta = document.getElementById('btn-pagar-tarjeta');
    if (btnPagarTarjeta) {
        btnPagarTarjeta.addEventListener('click', () => {
            if (cart.length > 0) {
                alert('¡Compra realizada con éxito! Gracias por tu compra.');
                clearCart(); // Vaciar el carrito después de la compra
                window.location.href = 'main.html'; // Redirige a la página principal
            } else {
                alert('Tu carrito está vacío. Agrega productos antes de pagar.');
            }
        });
    }
});

// --- Lógica del Carrito ---
let cart = []; // Array para almacenar los productos del carrito

function loadCart() {
    const storedCart = localStorage.getItem('carrito');
    if (storedCart) {
        cart = JSON.parse(storedCart);
    }
    displayDetailedCart();
    updateHeaderCartCounter();
}

function saveCart() {
    localStorage.setItem('carrito', JSON.stringify(cart));
}

function removeItemFromCart(itemName) {
    cart = cart.filter(item => item.nombre !== itemName); // Usa `nombre`
    saveCart();
    displayDetailedCart();
    updateHeaderCartCounter();
}

function clearCart() {
    cart = [];
    saveCart();
    displayDetailedCart();
    updateHeaderCartCounter();
}

function updateHeaderCartCounter() {
    const contadorElement = document.getElementById('contador-carrito');
    if (contadorElement) {
        const itemCount = cart.reduce((sum, item) => sum + item.cantidad, 0); // Usa `cantidad`
        contadorElement.textContent = itemCount;
    }
}

function displayDetailedCart() {
    const productosEnCarritoDetalle = document.getElementById('productos-en-carrito-detalle');
    const totalCarritoDetalle = document.getElementById('total-carrito-detalle');

    if (!productosEnCarritoDetalle || !totalCarritoDetalle) return;

    productosEnCarritoDetalle.innerHTML = '';
    let total = 0;

    const btnPagar = document.getElementById('btn-pagar-tarjeta');

    if (cart.length === 0) {
        productosEnCarritoDetalle.innerHTML = '<p class="text-gray-500 text-center">El carrito está vacío. Agrega productos para verlos aquí.</p>';
        if (btnPagar) {
            btnPagar.disabled = true;
            btnPagar.classList.add('opacity-50', 'cursor-not-allowed');
        }
    } else {
        if (btnPagar) {
            btnPagar.disabled = false;
            btnPagar.classList.remove('opacity-50', 'cursor-not-allowed');
        }

        cart.forEach(item => {
            const productDiv = document.createElement('div');
            productDiv.classList.add('producto-en-carrito-detalle', 'bg-gray-50', 'p-4', 'rounded-lg', 'mb-2');
            const itemTotal = item.precio * item.cantidad;
            total += itemTotal;
            productDiv.innerHTML = `
                <div class="flex-grow">
                    <span class="font-semibold text-lg">${item.nombre}</span>
                    <span class="text-gray-600"> (Cantidad: ${item.cantidad})</span>
                </div>
                <span class="font-bold text-xl mr-4">$${itemTotal.toFixed(2)}</span>
                <button class="btn-eliminar-producto" data-name="${item.nombre}">X</button>
            `;
            productosEnCarritoDetalle.appendChild(productDiv);
        });

        document.querySelectorAll('.btn-eliminar-producto').forEach(button => {
            button.addEventListener('click', (e) => {
                const itemName = e.target.dataset.name;
                removeItemFromCart(itemName);
            });
        });
    }

    totalCarritoDetalle.textContent = total.toFixed(2);
}
