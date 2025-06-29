<?php
session_start();
$page_title = "Concepto - LIVESCOMP: Tecnología que Vive Contigo";
$additional_css = ['css/concepto.css'];

include 'includes/header.php';
?>

<main class="concepto container mx-auto p-6 md:p-12 bg-white rounded-lg shadow-xl my-8">
    <h1 class="text-4xl md:text-5xl font-bold text-center mb-8 text-gray-800 leading-tight">
        Nuestro Concepto: LIVESCOMP, la Tecnología que Vive Contigo
    </h1>
    <hr class="border-t-2 border-blue-500 w-24 mx-auto mb-8">

    <section class="mb-10 text-lg text-gray-700">
        <p class="mb-4">
            En LIVESCOMP, creemos firmemente que la tecnología no es solo una herramienta, sino una extensión de nuestras vidas. Es el pulso que nos conecta, la chispa que enciende la innovación y el motor que impulsa el progreso en nuestro día a día. Nuestro nombre mismo, LIVESCOMP, encapsula esta visión: la unión de "LIVES" (vidas) y "COMP" (componentes/completas), representando cómo cada producto que ofrecemos está diseñado para enriquecer y completar tu experiencia vital.
        </p>
        <p class="mb-4">
            Nuestra misión va más allá de simplemente vender productos electrónicos o electrodomésticos. Buscamos ser tu socio tecnológico, el puente que te conecta con soluciones inteligentes que simplifiquen tu rutina, potencien tu productividad y eleven tu entretenimiento. Desde el último gadget que revoluciona tu comunicación, hasta el electrodoméstico que transforma tu hogar en un espacio más eficiente y confortable.
        </p>
        <p class="mb-4">
            Nos basamos en tres pilares fundamentales:
        </p>
        <ul class="list-disc list-inside space-y-2 mb-6 ml-4">
            <li>
                Innovación Accesible: Creemos que la tecnología de vanguardia debe estar al alcance de todos. Por eso, seleccionamos cuidadosamente productos que combinan lo último en innovación con precios justos y competitivos.
            </li>
            <li>
                Calidad y Confianza: Tu tranquilidad es nuestra prioridad. Cada artículo en nuestro catálogo es rigurosamente evaluado para asegurar que cumple con los más altos estándares de calidad y durabilidad, respaldado por un servicio al cliente excepcional.
            </li>
            <li>
                Experiencia Integral: Desde la navegación en nuestra web hasta la entrega en tu puerta y el soporte post-venta, nos esforzamos por ofrecer una experiencia de compra fluida, intuitiva y satisfactoria en cada paso.
            </li>
        </ul>
        <p class="mb-4">
            LIVESCOMP es más que una tienda; es una comunidad donde la pasión por la tecnología se une con el deseo de vivir una vida más conectada, eficiente y plena. Únete a nosotros y descubre cómo la tecnología puede realmente vivir contigo.
        </p>
    </section>

    <div class="text-center mt-10">
        <a href="index.php" class="inline-block bg-blue-600 text-white text-lg font-semibold px-8 py-3 rounded-full hover:bg-blue-700 transition duration-300 shadow-lg">
            Volver a la Página Principal
        </a>
    </div>
</main>

<?php include 'includes/footer.php'; ?>
