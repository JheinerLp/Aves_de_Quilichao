<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="default-src 'self' 'unsafe-inline' 'unsafe-eval' data: blob: https:; script-src 'self' 'unsafe-inline' 'unsafe-eval' https://cdn.tailwindcss.com https://unpkg.com; style-src 'self' 'unsafe-inline' https://unpkg.com https://fonts.googleapis.com; img-src 'self' data: blob: https: http:; media-src 'self' data: blob: http: https:; connect-src 'self' https: http:; font-src 'self' data: https:;">
    <meta name="description" content="Guía Ambiental de BioAves Quilichao: educación ambiental, causas del impacto y medidas para la conservación de la avifauna en Santander de Quilichao, Cauca.">
    <title>Guía Ambiental | BioAves Quilichao</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f8f3;
        }

        .hero {
            background: linear-gradient(
                rgba(10, 45, 32, 0.78),
                rgba(10, 45, 32, 0.78)
            ), url('https://images.unsplash.com/photo-1448375240586-882707db888b?w=1600');
            background-size: cover;
            background-position: center;
        }

        .environment-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .environment-card:hover {
            transform: translateY(-7px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.12);
        }
    </style>
</head>

<body class="bv-inner bg-[#f4f8f3] text-[#333333] font-sans antialiased min-h-screen flex flex-col justify-between selection:bg-green-100 selection:text-green-900">

    @include('partials.header')

    <main class="flex-1 w-full">
        <!-- PORTADA -->
        <section class="hero text-white pt-36 pb-28 px-6 text-center">
            <div class="max-w-4xl mx-auto">
                <span class="uppercase tracking-widest text-green-300 font-bold text-sm">
                    Educación y conservación ambiental
                </span>

                <h1 class="text-4xl md:text-6xl font-bold mt-5 mb-6">
                    Guía Ambiental
                </h1>

                <p class="text-lg md:text-xl text-gray-200 leading-relaxed">
                    Conocer los impactos ambientales es el primer paso
                    para proteger nuestros ecosistemas y conservar la
                    diversidad de aves de Santander de Quilichao.
                </p>

                <div class="flex flex-wrap justify-center gap-4 mt-8">
                    <a href="#impactos"
                       class="inline-block bg-green-600 hover:bg-green-700
                              text-white px-8 py-3 rounded-full font-semibold shadow-md transition">
                        Explorar impactos
                    </a>
                    <a href="{{ route('home') }}#reportar-avistamiento"
                       class="inline-block bg-white/20 hover:bg-white/30 backdrop-blur-sm
                              text-white border border-white/40 px-8 py-3 rounded-full font-semibold transition">
                        Reportar avistamiento
                    </a>
                </div>
            </div>
        </section>

        <!-- INTRODUCCIÓN -->
        <section class="max-w-6xl mx-auto px-6 py-16 text-center">
            <h2 class="text-3xl font-bold text-green-900 mb-5">
                ¿Qué está afectando a nuestras aves?
            </h2>

            <p class="text-gray-600 text-lg max-w-3xl mx-auto leading-relaxed">
                Las actividades humanas pueden transformar los hábitats
                naturales, disminuir los recursos disponibles y afectar
                el equilibrio de los ecosistemas. Identificar estas
                amenazas permite promover acciones de conservación en nuestro territorio.
            </p>
        </section>

        <!-- TARJETAS DE IMPACTOS -->
        <section id="impactos" class="max-w-7xl mx-auto px-6 pb-20">

            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-green-900">
                    Principales impactos ambientales
                </h2>

                <p class="text-gray-500 mt-3">
                    Conoce las amenazas y sus consecuencias para la avifauna.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-7">

                <!-- DEFORESTACIÓN -->
                <article class="environment-card bg-white rounded-2xl overflow-hidden shadow">
                    <img
                        src="https://images.unsplash.com/photo-1448375240586-882707db888b?w=700"
                        alt="Bosque natural"
                        class="w-full h-48 object-cover">

                    <div class="p-6">
                        <span class="text-green-700 font-bold text-sm">
                            IMPACTO 01
                        </span>

                        <h3 class="text-xl font-bold text-gray-800 mt-2">
                            Deforestación
                        </h3>

                        <p class="text-gray-600 mt-3 text-sm leading-relaxed">
                            La eliminación de árboles reduce los espacios
                            donde las aves encuentran alimento, refugio
                            y lugares para construir sus nidos.
                        </p>
                    </div>
                </article>

                <!-- CONTAMINACIÓN -->
                <article class="environment-card bg-white rounded-2xl overflow-hidden shadow">
                    <img
                        src="https://images.unsplash.com/photo-1437482078695-73f5ca6c96e2?w=700"
                        alt="Agua y ecosistema natural"
                        class="w-full h-48 object-cover">

                    <div class="p-6">
                        <span class="text-green-700 font-bold text-sm">
                            IMPACTO 02
                        </span>

                        <h3 class="text-xl font-bold text-gray-800 mt-2">
                            Contaminación hídrica
                        </h3>

                        <p class="text-gray-600 mt-3 text-sm leading-relaxed">
                            Los residuos y sustancias contaminantes
                            deterioran los cuerpos de agua y afectan
                            los ecosistemas donde habitan las aves.
                        </p>
                    </div>
                </article>

                <!-- AGROQUÍMICOS -->
                <article class="environment-card bg-white rounded-2xl overflow-hidden shadow">
                    <img
                        src="https://images.unsplash.com/photo-1500382017468-9049fed747ef?w=700"
                        alt="Paisaje agrícola"
                        class="w-full h-48 object-cover">

                    <div class="p-6">
                        <span class="text-green-700 font-bold text-sm">
                            IMPACTO 03
                        </span>

                        <h3 class="text-xl font-bold text-gray-800 mt-2">
                            Agroquímicos
                        </h3>

                        <p class="text-gray-600 mt-3 text-sm leading-relaxed">
                            El uso inadecuado de productos químicos
                            agrícolas puede afectar a las aves y
                            reducir la disponibilidad de alimento.
                        </p>
                    </div>
                </article>

                <!-- EXPANSIÓN URBANA -->
                <article class="environment-card bg-white rounded-2xl overflow-hidden shadow">
                    <img
                        src="https://images.unsplash.com/photo-1449824913935-59a10b8d2000?w=700"
                        alt="Expansión urbana"
                        class="w-full h-48 object-cover">

                    <div class="p-6">
                        <span class="text-green-700 font-bold text-sm">
                            IMPACTO 04
                        </span>

                        <h3 class="text-xl font-bold text-gray-800 mt-2">
                            Expansión urbana
                        </h3>

                        <p class="text-gray-600 mt-3 text-sm leading-relaxed">
                            El crecimiento de las ciudades puede
                            fragmentar los hábitats y reducir
                            las zonas naturales disponibles.
                        </p>
                    </div>
                </article>

            </div>
        </section>

        <!-- SOLUCIONES -->
        <section class="bg-green-900 text-white py-20 px-6">
            <div class="max-w-6xl mx-auto">

                <div class="text-center mb-12">
                    <span class="text-green-300 font-bold uppercase tracking-widest text-sm">
                        Compromiso ambiental
                    </span>

                    <h2 class="text-3xl md:text-4xl font-bold mt-4">
                        ¿Cómo podemos ayudar?
                    </h2>

                    <p class="text-green-100 mt-4 max-w-2xl mx-auto">
                        Pequeñas acciones pueden contribuir a la
                        protección de los ecosistemas y la biodiversidad.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                    <div class="bg-white/10 rounded-xl p-6">
                        <h3 class="text-xl font-bold mb-3">
                            🌳 Proteger los bosques
                        </h3>
                        <p class="text-green-100">
                            Promover la conservación de árboles nativos
                            y la recuperación de zonas naturales.
                        </p>
                    </div>

                    <div class="bg-white/10 rounded-xl p-6">
                        <h3 class="text-xl font-bold mb-3">
                            💧 Cuidar las fuentes hídricas
                        </h3>
                        <p class="text-green-100">
                            Evitar arrojar residuos a ríos, quebradas
                            y otros cuerpos de agua.
                        </p>
                    </div>

                    <div class="bg-white/10 rounded-xl p-6">
                        <h3 class="text-xl font-bold mb-3">
                            🐦 Respetar las aves
                        </h3>
                        <p class="text-green-100">
                            No destruir nidos, no capturar aves silvestres
                            y respetar sus espacios naturales.
                        </p>
                    </div>

                    <div class="bg-white/10 rounded-xl p-6">
                        <h3 class="text-xl font-bold mb-3">
                            🤝 Educar y participar
                        </h3>
                        <p class="text-green-100">
                            Compartir información ambiental y participar
                            en jornadas comunitarias de conservación.
                        </p>
                    </div>

                </div>
            </div>
        </section>
    </main>

    @include('partials.footer')

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const mobileMenuBtn = document.getElementById('mobile-menu-btn');
            const mobileMenu = document.getElementById('mobile-menu');
            if (mobileMenuBtn && mobileMenu) {
                mobileMenuBtn.addEventListener('click', function () {
                    mobileMenu.classList.toggle('hidden');
                });
            }
        });
    </script>

</body>
</html>