<?php
session_start();
$page_title = "Quiénes Somos - LIVESCOMP: Tu Aliado Tecnológico";
$additional_css = ['css/quienes-somos.css'];

include 'includes/header.php';
?>

<main class="quienes-somos container mx-auto p-0 my-8 relative overflow-hidden rounded-lg shadow-xl">
    <section class="relative w-full h-[500px] md:h-[600px] lg:h-[700px] flex items-center justify-center text-white">
        <div class="video-background-container absolute inset-0 w-full h-full">
            <video autoplay loop muted playsinline class="w-full h-full object-cover">
                <source src="video/videotecnologia.mp4" type="video/mp4">
                Tu navegador no soporta la etiqueta de video.
            </video>
        </div>

        <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col items-center justify-center p-6 text-center z-10 rounded-lg">
            <h1 class="text-4xl md:text-6xl font-bold mb-4 leading-tight">
                Tu negocio puede ser <br> el creador
            </h1>
            <p class="text-lg md:text-xl max-w-2xl">
                Sueña en grande, construye rápido y llega lejos con LIVESCOMP.
            </p>
            <a href="index.php" class="mt-8 inline-block bg-blue-600 text-white text-lg font-semibold px-8 py-3 rounded-full hover:bg-blue-700 transition duration-300 shadow-lg">
                Comienza gratis
            </a>
            <p class="mt-4 text-sm md:text-base">
                <a href="#why-livescomp" class="text-white hover:underline">▸ Por qué creamos LIVESCOMP</a>
            </p>
        </div>
    </section>

    <section id="why-livescomp" class="p-6 md:p-12 bg-white rounded-b-lg">
        <h2 class="text-3xl md:text-4xl font-bold text-center mb-8 text-gray-800">
            Nuestra Historia y Compromiso
        </h2>
        <hr class="border-t-2 border-blue-500 w-24 mx-auto mb-8">
        <p class="mb-6 text-lg text-gray-700">
            En LIVESCOMP, somos un equipo apasionado por la tecnología y comprometido con acercar las mejores innovaciones a tu vida. Creemos en el poder de la tecnología para transformar, conectar y mejorar cada aspecto de tu día a día. Desde nuestra fundación, nos hemos dedicado a construir una plataforma donde la calidad, la accesibilidad y la confianza son los pilares de todo lo que hacemos.
        </p>
        <p class="mb-6 text-lg text-gray-700">
            Nuestra historia es la de la búsqueda constante de la excelencia, seleccionando productos que no solo cumplen con tus expectativas, sino que las superan. Nos enorgullece ser un puente entre la innovación global y tu hogar, garantizando que cada compra sea una inversión en tu bienestar y comodidad.
        </p>
        <p class="mb-8 text-lg text-gray-700">
            Nos impulsa la creencia de que cada gadget, cada electrodoméstico, tiene el potencial de simplificar, enriquecer y hacer más feliz tu vida. Por eso, en LIVESCOMP, no solo vendemos productos; construimos relaciones y te acompañamos en tu viaje tecnológico.
        </p>
        <p class="text-lg text-gray-700">
            ¡Gracias por ser parte de la familia LIVESCOMP!
        </p>
    </section>

    <div class="text-center mt-10 p-6">
        <a href="index.php" class="inline-block bg-blue-600 text-white text-lg font-semibold px-8 py-3 rounded-full hover:bg-blue-700 transition duration-300 shadow-lg">
            Volver a la Página Principal
        </a>
    </div>
</main>

<?php include 'includes/footer.php'; ?>
