<?php
/*
  Template Name: plantilla home
 */
//get_header(); 

$slides_php = [];

if (have_rows('baner')) :
    while (have_rows('baner')) : the_row();
        $image = get_sub_field('image');

        // Guardamos cada elemento como un array asociativo
        $slides_php[] = [
            'image'  => $image ? esc_url($image['url']) : '',
            'tag'    => get_sub_field('Label'),
            'title1' => get_sub_field('title1'),
            'title2' => get_sub_field('title2'),
            'desc'   => get_sub_field('description'),
            'buton'  => get_sub_field('buton')
        ];

    endwhile;
endif;

$primer_slide = !empty($slides_php) ? $slides_php[0] : null;
$primer_imagen = $primer_slide ? $primer_slide['image'] : '';
?>
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

<script>
    tailwind.config = {
        theme: {
            extend: {
                fontFamily: {
                    sans: ['"Inter"', 'sans-serif'],
                },
                colors: {
                    desirable: {
                        cyan: '#00bcd4',
                        cyanDark: '#0097a7',
                        topDark: '#1a1a1a',
                        grayBg: '#f2f2f2'
                    }
                }
            }
        }
    }
</script>

<style>
    html {
        scroll-behavior: smooth !important;
    }

    .nav-item {
        position: relative;
        transition: color 0.5s cubic-bezier(0.16, 1, 0.3, 1), background-color 0.5s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .nav-item.active-tab,
    .nav-item:hover {
        background-color: #00bcd4 !important;
        color: white !important;
        height: calc(100% + 14px);
        margin-top: 0;
        clip-path: polygon(0 0, 100% 0, 100% 100%, 0 calc(100% - 8px));
        z-index: 30;
    }

    .diagonal-section {
        clip-path: polygon(0 3vw, 100% 0, 100% calc(100% - 3vw), 0 100%);
    }

    /* Efecto súper chévere y dinámico para las 4 tarjetas debajo del banner */
    .feature-card-hover {
        clip-path: polygon(0 0, 100% 0, 100% calc(100% - 25px), 0 100%);
        transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .feature-card-hover:hover {
        transform: translateY(-10px) scale(1.02);
        background-color: #0097a7 !important;
        box-shadow: 0 20px 30px -10px rgba(0, 188, 212, 0.4);
    }

    .feature-card-hover:hover .card-icon {
        transform: scale(1.15) rotate(5deg);
    }

    .card-icon {
        transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .feature-icon-box {
        clip-path: polygon(0 0, 100% 0, 100% 100%, 0 calc(100% - 15px));
    }

    .hero-bg-slide {
        opacity: 0;
        visibility: hidden;
        transition: opacity 1s ease-in-out, visibility 1s ease-in-out;
        position: absolute;
        inset: 0;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }

    .hero-bg-slide.active {
        opacity: 1;
        visibility: visible;
    }

    .menu-item {
        list-style: none !important;
        line-height: 80px !important;
    }
    .custom-logo-link img {
    max-height: 50px; /* Controla la altura máxima del logo */
    width: auto;
    display: block;
}
</style>

<body class="bg-white text-slate-700 font-sans antialiased overflow-x-hidden selection:bg-cyan-500 selection:text-white">
    <div class="bg-[#1a1a1a] text-slate-400 text-xs py-2 px-6 hidden sm:block border-b border-slate-800">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center gap-6">
                <span>Language: <strong class="text-white">Eng / ES</strong></span>
                <span>📧 info@yoursite.com</span>
                <span>📞 +12 123 456 789</span>
            </div>
            <div class="flex items-center gap-4 text-slate-300">
                <a href="#" class="hover:text-cyan-400 transition-colors">🌐</a>
                <a href="#" class="hover:text-cyan-400 transition-colors">f</a>
                <a href="#" class="hover:text-cyan-400 transition-colors">t</a>
                <a href="#" class="hover:text-cyan-400 transition-colors">in</a>
                <a href="#" class="hover:text-cyan-400 transition-colors">ig</a>
            </div>
        </div>
    </div>

    <header class="sticky top-0 z-50 bg-white border-t border-b border-slate-200 shadow-sm">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">

            <!-- LOGO A LA IZQUIERDA -->
            <div class="flex items-center">
                <?php if (has_custom_logo()) : ?>
                    <div class="custom-logo-link flex items-center">
                        <?php the_custom_logo(); ?>
                    </div>
                <?php else : ?>
                    <a href="<?php echo esc_url(home_url()); ?>" rel="home" class="flex items-center gap-2 text-2xl font-black tracking-wider text-slate-700 uppercase">
                        <div class="header-logo__name"><?php bloginfo('name'); ?></div>
                        <?php if (get_bloginfo('description')) : ?>
                            <div class="header-logo__description text-xs text-slate-500 font-normal"><?php bloginfo('description'); ?></div>
                        <?php endif; ?>
                    </a>
                <?php endif; ?>
            </div>

            <!-- MENÚ A LA DERECHA -->
            <nav id="main-nav" class="hidden lg:flex items-center font-bold text-xs tracking-wider uppercase text-slate-600 h-full items-stretch">
                <?php
                wp_nav_menu(array(
                    'menu' => 'header',
                    'container' => false, // Elimina el <div> contenedor
                    'items_wrap' => '%3$s', // Elimina por completo el <ul> y deja solo los elementos limpios
                ));
                ?>
            </nav>

        </div>
    </header>

    <!-- BANNER A PANTALLA COMPLETA (ESTILO IMPACTANTE CENTRADO) -->
   <section id="home">
        <div id="hero-banner" class="relative min-h-screen text-white flex flex-col justify-between overflow-hidden font-sans transition-all duration-1000 ease-in-out bg-cover bg-center" style="background-image: url('<?php echo esc_url($primer_imagen); ?>');">

            <!-- Gradiente de fondo -->
            <div class="absolute inset-0 bg-gradient-to-b from-[#021511]/60 via-[#021511]/20 to-[#021511]/70 pointer-events-none"></div>

            <!-- CONTENIDO CENTRAL -->
            <main class="relative z-10 flex-1 flex flex-col items-center justify-center text-center px-4 max-w-4xl mx-auto my-12" id="hero-content">

                <!-- Etiqueta superior -->
                <div id="hero-tag" class="inline-flex items-center gap-2 rounded-full bg-black/60 border border-amber-500/30 px-5 py-1.5 text-xs sm:text-sm font-bold tracking-widest text-amber-400 uppercase mb-6 transition-opacity duration-1000 ease-in-out">
                    <?php echo esc_html($primer_slide ? $primer_slide['tag'] : ''); ?>
                </div>

                <h1 class="text-4xl sm:text-6xl md:text-7xl font-extrabold tracking-tight leading-none uppercase select-none">
                    <span id="hero-title-1" class="block text-white transition-opacity duration-1000 ease-in-out"><?php echo esc_html($primer_slide ? $primer_slide['title1'] : ''); ?></span>
                    <span id="hero-title-2" class="block text-transparent bg-clip-text bg-gradient-to-r from-[#0082c8] to-[#00a8ff] mt-2 filter drop-shadow-[0_5px_15px_rgba(0,130,200,0.3)] transition-opacity duration-1000 ease-in-out">
                        <?php echo esc_html($primer_slide ? $primer_slide['title2'] : ''); ?>
                    </span>
                </h1>

                <!-- Descripción -->
                <p id="hero-desc" class="mt-6 text-lg sm:text-2xl text-gray-100 max-w-2xl font-normal leading-relaxed transition-opacity duration-1000 ease-in-out drop-shadow-md">
                    <?php echo esc_html($primer_slide ? $primer_slide['desc'] : ''); ?>
                </p>

                <!-- Botón -->
                <div class="mt-8">
                    <?php if ($primer_slide && !empty($primer_slide['buton'])) : 
                        $btn = $primer_slide['buton'];
                    ?>
                        <a id="hero-btn" href="<?php echo esc_url($btn['url']); ?>" target="<?php echo esc_attr($btn['target']); ?>" class="inline-block rounded-full bg-[#0082c8] hover:bg-[#0070ab] text-white font-extrabold text-xs tracking-wider uppercase px-8 py-3.5 transition-opacity transform hover:scale-105 duration-1000 ease-in-out shadow-lg shadow-[#0082c8]/40"><?php echo esc_html($btn['title']); ?></a>
                    <?php endif; ?>
                </div>

            </main>

            <!-- INDICADORES INFERIORES -->
            <footer class="relative z-10 w-full flex justify-center gap-3 pb-8" id="hero-indicators">
                <!-- Se generan y controlan dinámicamente con tu JS -->
            </footer>

        </div>
    </section>

    <!-- TARJETAS CON EFECTO CHÉVERE EN HOVER -->
    <section class="relative z-20 max-w-7xl mx-auto px-6 mt-12 mb-24">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 pt-4 pb-8">
            <div class="bg-cyan-500 text-white p-8 pb-12 text-center shadow-2xl feature-card-hover cursor-pointer" data-aos="fade-up" data-aos-duration="800" data-aos-delay="100">
                <div class="text-3xl mb-4 inline-block card-icon">⚙️</div>
                <h3 class="font-bold text-base mb-3">Fully Customizable</h3>
                <p class="text-xs text-cyan-50 leading-relaxed mb-6 font-normal">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text.</p>
                <a href="#" class="text-xs font-bold underline hover:text-white">More</a>
            </div>

            <div class="bg-cyan-500 text-white p-8 pb-12 text-center shadow-2xl feature-card-hover cursor-pointer" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                <div class="text-3xl mb-4 inline-block card-icon">📱</div>
                <h3 class="font-bold text-base mb-3">Responsive Ready</h3>
                <p class="text-xs text-cyan-50 leading-relaxed mb-6 font-normal">Unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries.</p>
                <a href="#" class="text-xs font-bold underline hover:text-white">More</a>
            </div>

            <div class="bg-cyan-500 text-white p-8 pb-12 text-center shadow-2xl feature-card-hover cursor-pointer" data-aos="fade-up" data-aos-duration="800" data-aos-delay="300">
                <div class="text-3xl mb-4 inline-block card-icon">🔄</div>
                <h3 class="font-bold text-base mb-3">Free Updates</h3>
                <p class="text-xs text-cyan-50 leading-relaxed mb-6 font-normal">Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley.</p>
                <a href="#" class="text-xs font-bold underline hover:text-white">More</a>
            </div>

            <div class="bg-cyan-500 text-white p-8 pb-12 text-center shadow-2xl feature-card-hover cursor-pointer" data-aos="fade-up" data-aos-duration="800" data-aos-delay="400">
                <div class="text-3xl mb-4 inline-block card-icon">👥</div>
                <h3 class="font-bold text-base mb-3">Friendly Support</h3>
                <p class="text-xs text-cyan-50 leading-relaxed mb-6 font-normal">It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
                <a href="#" class="text-xs font-bold underline hover:text-white">More</a>
            </div>
        </div>
    </section>

    <!-- ABOUT US -->
    <section id="about" class="relative pt-32 pb-24 bg-slate-900 text-white overflow-hidden diagonal-section my-8">
        <div class="absolute inset-0 bg-cover bg-center opacity-25" style="background-image: url('https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&w=1600&q=80');"></div>

        <div class="max-w-7xl mx-auto px-6 relative z-20">
            <div class="text-center max-w-2xl mx-auto mb-12" data-aos="fade-down" data-aos-duration="800">
                <h2 class="text-3xl font-extrabold uppercase tracking-tight text-white mb-3">About us</h2>
                <p class="text-slate-300 text-xs sm:text-sm leading-relaxed" data-aos="fade-up" data-aos-duration="800" data-aos-delay="150">
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
                <div class="lg:col-span-5" data-aos="fade-right" data-aos-duration="1000">
                    <div class="relative bg-slate-800/80 p-3 rounded-xl border border-slate-700 shadow-2xl backdrop-blur-sm max-w-sm mx-auto lg:max-w-none">
                        <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=800&q=80" alt="About our company" class="rounded-lg w-full h-auto object-cover shadow-md">
                    </div>
                </div>

                <div class="lg:col-span-7" data-aos="fade-left" data-aos-duration="1000">
                    <h3 class="text-xl font-bold text-white mb-3 tracking-wide" data-aos="fade-up" data-aos-duration="800">About our company</h3>
                    <p class="text-slate-300 text-sm leading-relaxed mb-4 font-normal" data-aos="fade-up" data-aos-duration="800" data-aos-delay="150">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                    </p>
                    <p class="text-slate-300 text-sm leading-relaxed font-normal" data-aos="fade-up" data-aos-duration="800" data-aos-delay="300">
                        It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- FEATURES -->
    <section id="features" class="relative pt-32 pb-24 bg-white text-slate-800 overflow-hidden my-8" style="clip-path: polygon(0 3vw, 100% 0, 100% calc(100% - 3vw), 0 100%);">
        <div class="max-w-7xl mx-auto px-6 relative z-20">
            <div class="text-center max-w-2xl mx-auto mb-12">
                <h2 class="text-3xl font-extrabold uppercase tracking-tight text-slate-900 mb-3" data-aos="fade-down" data-aos-duration="800">Features</h2>
                <p class="text-slate-600 text-xs sm:text-sm leading-relaxed" data-aos="fade-up" data-aos-duration="800" data-aos-delay="150">
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-y-8 gap-x-10">
                <div class="flex items-start gap-4" data-aos="fade-up" data-aos-duration="800" data-aos-delay="100">
                    <div class="w-14 h-14 shrink-0 bg-cyan-500 text-white flex items-center justify-center text-2xl feature-icon-box shadow-md">⚙️</div>
                    <div>
                        <h3 class="font-bold text-slate-900 text-base mb-1.5">Features</h3>
                        <p class="text-xs text-slate-600 leading-relaxed">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                    </div>
                </div>

                <div class="flex items-start gap-4" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                    <div class="w-14 h-14 shrink-0 bg-cyan-500 text-white flex items-center justify-center text-2xl feature-icon-box shadow-md">📱</div>
                    <div>
                        <h3 class="font-bold text-slate-900 text-base mb-1.5">Mobile ready</h3>
                        <p class="text-xs text-slate-600 leading-relaxed">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                    </div>
                </div>

                <div class="flex items-start gap-4" data-aos="fade-up" data-aos-duration="800" data-aos-delay="300">
                    <div class="w-14 h-14 shrink-0 bg-cyan-500 text-white flex items-center justify-center text-2xl feature-icon-box shadow-md">💬</div>
                    <div>
                        <h3 class="font-bold text-slate-900 text-base mb-1.5">Validate code</h3>
                        <p class="text-xs text-slate-600 leading-relaxed">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                    </div>
                </div>

                <div class="flex items-start gap-4" data-aos="fade-up" data-aos-duration="800" data-aos-delay="400">
                    <div class="w-14 h-14 shrink-0 bg-cyan-500 text-white flex items-center justify-center text-2xl feature-icon-box shadow-md">🗂️</div>
                    <div>
                        <h3 class="font-bold text-slate-900 text-base mb-1.5">Responsive design</h3>
                        <p class="text-xs text-slate-600 leading-relaxed">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                    </div>
                </div>

                <div class="flex items-start gap-4" data-aos="fade-up" data-aos-duration="800" data-aos-delay="500">
                    <div class="w-14 h-14 shrink-0 bg-cyan-500 text-white flex items-center justify-center text-2xl feature-icon-box shadow-md">💻</div>
                    <div>
                        <h3 class="font-bold text-slate-900 text-base mb-1.5">Easy to Customize</h3>
                        <p class="text-xs text-slate-600 leading-relaxed">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                    </div>
                </div>

                <div class="flex items-start gap-4" data-aos="fade-up" data-aos-duration="800" data-aos-delay="600">
                    <div class="w-14 h-14 shrink-0 bg-cyan-500 text-white flex items-center justify-center text-2xl feature-icon-box shadow-md">ℹ️</div>
                    <div>
                        <h3 class="font-bold text-slate-900 text-base mb-1.5">Free support</h3>
                        <p class="text-xs text-slate-600 leading-relaxed">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SCREENSHOTS -->
    <section id="screenshots" class="relative pt-32 pb-24 bg-slate-900 text-white overflow-hidden diagonal-section my-8 text-center">
        <div class="absolute inset-0 bg-cover bg-center opacity-20" style="background-image: url('https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=1600&q=80');"></div>

        <div class="max-w-7xl mx-auto px-6 relative z-20">
            <div class="text-center max-w-2xl mx-auto mb-12">
                <h2 class="text-3xl font-extrabold uppercase mb-3 text-white tracking-tight" data-aos="fade-down" data-aos-duration="800">
                    Categorias</h2>
                <p class="text-slate-300 text-xs sm:text-sm leading-relaxed" data-aos="fade-up" data-aos-duration="800" data-aos-delay="150">
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 items-center">
                <div class="bg-slate-800/90 p-3 rounded-2xl border border-slate-700 shadow-2xl backdrop-blur-sm transform hover:-translate-y-1 transition-transform" data-aos="fade-up" data-aos-duration="800" data-aos-delay="100">
                    <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=600&q=80" alt="Screenshot 1" class="rounded-xl w-full h-64 object-cover">
                </div>
                <div class="bg-slate-800/90 p-3 rounded-2xl border border-slate-700 shadow-2xl backdrop-blur-sm transform hover:-translate-y-1 transition-transform" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                    <img src="https://images.unsplash.com/photo-1556761175-5973dc0f32e7?auto=format&fit=crop&w=600&q=80" alt="Screenshot 2" class="rounded-xl w-full h-64 object-cover">
                </div>
                <div class="bg-slate-800/90 p-3 rounded-2xl border border-slate-700 shadow-2xl backdrop-blur-sm transform hover:-translate-y-1 transition-transform" data-aos="fade-up" data-aos-duration="800" data-aos-delay="300">
                    <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=600&q=80" alt="Screenshot 3" class="rounded-xl w-full h-64 object-cover">
                </div>
                <div class="bg-slate-800/90 p-3 rounded-2xl border border-slate-700 shadow-2xl backdrop-blur-sm transform hover:-translate-y-1 transition-transform" data-aos="fade-up" data-aos-duration="800" data-aos-delay="400">
                    <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=600&q=80" alt="Screenshot 4" class="rounded-xl w-full h-64 object-cover">
                </div>
            </div>
        </div>
    </section>

    <!-- TEAM -->
    <section id="team" class="relative pt-32 pb-24 bg-white text-slate-800 overflow-hidden my-8">
        <div class="max-w-7xl mx-auto px-6 relative z-20">
            <div class="text-center max-w-2xl mx-auto mb-12">
                <h2 class="text-3xl font-extrabold uppercase tracking-tight text-slate-900 mb-3" data-aos="fade-down" data-aos-duration="800">Recent Listings</h2>
                <p class="text-slate-600 text-xs sm:text-sm leading-relaxed" data-aos="fade-up" data-aos-duration="800" data-aos-delay="150">
                    There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white border border-slate-200 p-4 rounded shadow-sm hover:shadow-md transition-shadow" data-aos="fade-up" data-aos-duration="800" data-aos-delay="100">
                    <div class="overflow-hidden rounded mb-4">
                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=600&q=80" alt="Veronika Klark" class="w-full h-56 object-cover hover:scale-105 transition-transform duration-300">
                    </div>
                    <h4 class="font-bold text-cyan-500 text-sm mb-0.5">Veronika Klark</h4>
                    <p class="text-xs font-semibold text-slate-700 mb-3">Designer</p>
                    <p class="text-xs text-slate-600 leading-relaxed mb-4">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                    </p>
                    <div class="flex gap-3 text-slate-400 text-xs">
                        <a href="#" class="hover:text-cyan-500 transition-colors">f</a>
                        <a href="#" class="hover:text-cyan-500 transition-colors">t</a>
                        <a href="#" class="hover:text-cyan-500 transition-colors">in</a>
                    </div>
                </div>

                <div class="bg-white border border-slate-200 p-4 rounded shadow-sm hover:shadow-md transition-shadow" data-aos="fade-up" data-aos-duration="800" data-aos-delay="250">
                    <div class="overflow-hidden rounded mb-4">
                        <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=600&q=80" alt="John Newman" class="w-full h-56 object-cover hover:scale-105 transition-transform duration-300">
                    </div>
                    <h4 class="font-bold text-cyan-500 text-sm mb-0.5">John Newman</h4>
                    <p class="text-xs font-semibold text-slate-700 mb-3">Designer</p>
                    <p class="text-xs text-slate-600 leading-relaxed mb-4">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                    </p>
                    <div class="flex gap-3 text-slate-400 text-xs">
                        <a href="#" class="hover:text-cyan-500 transition-colors">f</a>
                        <a href="#" class="hover:text-cyan-500 transition-colors">t</a>
                        <a href="#" class="hover:text-cyan-500 transition-colors">in</a>
                    </div>
                </div>

                <div class="bg-white border border-slate-200 p-4 rounded shadow-sm hover:shadow-md transition-shadow" data-aos="fade-up" data-aos-duration="800" data-aos-delay="400">
                    <div class="overflow-hidden rounded mb-4">
                        <img src="https://images.unsplash.com/photo-1580489944761-15a19d654956?auto=format&fit=crop&w=600&q=80" alt="Nika Nilson" class="w-full h-56 object-cover hover:scale-105 transition-transform duration-300">
                    </div>
                    <h4 class="font-bold text-cyan-500 text-sm mb-0.5">Nika Nilson</h4>
                    <p class="text-xs font-semibold text-slate-700 mb-3">Support</p>
                    <p class="text-xs text-slate-600 leading-relaxed mb-4">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                    </p>
                    <div class="flex gap-3 text-slate-400 text-xs">
                        <a href="#" class="hover:text-cyan-500 transition-colors">f</a>
                        <a href="#" class="hover:text-cyan-500 transition-colors">t</a>
                        <a href="#" class="hover:text-cyan-500 transition-colors">in</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- BLOG -->
    <section id="blog" class="relative pt-32 pb-24 bg-slate-900 text-white overflow-hidden diagonal-section my-8">
        <div class="absolute inset-0 bg-cover bg-center opacity-15" style="background-image: url('https://images.unsplash.com/photo-1499750310107-5fef28a66643?auto=format&fit=crop&w=1600&q=80');"></div>

        <div class="max-w-7xl mx-auto px-6 relative z-20">
            <div class="text-center max-w-2xl mx-auto mb-12">
                <h2 class="text-3xl font-extrabold uppercase tracking-tight text-white mb-3" data-aos="fade-down" data-aos-duration="800">Blog</h2>
                <p class="text-slate-300 text-xs sm:text-sm leading-relaxed" data-aos="fade-up" data-aos-duration="800" data-aos-delay="150">
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-slate-800/90 border border-slate-700 p-3 rounded shadow-lg backdrop-blur-sm" data-aos="fade-up" data-aos-duration="800" data-aos-delay="100">
                    <div class="relative overflow-hidden rounded mb-4">
                        <img src="https://images.unsplash.com/photo-1499750310107-5fef28a66643?auto=format&fit=crop&w=600&q=80" alt="Blog 1" class="w-full h-40 object-cover hover:scale-105 transition-transform duration-300">
                        <span class="absolute bottom-2 right-2 bg-cyan-600 text-white text-[10px] font-bold px-2 py-1 rounded shadow">04 Nov</span>
                    </div>
                    <h4 class="font-bold text-white text-xs mb-2 leading-snug">Unusual photo was taken near the town today:</h4>
                    <p class="text-[11px] text-slate-300 leading-relaxed mb-3">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry...
                    </p>
                    <a href="#" class="inline-block text-cyan-400 text-xs font-bold mt-2 hover:underline">Read more&gt;</a>
                </div>

                <div class="bg-slate-800/90 border border-slate-700 p-3 rounded shadow-lg backdrop-blur-sm" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                    <div class="relative overflow-hidden rounded mb-4">
                        <img src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=600&q=80" alt="Blog 2" class="w-full h-40 object-cover hover:scale-105 transition-transform duration-300">
                        <span class="absolute bottom-2 right-2 bg-cyan-600 text-white text-[10px] font-bold px-2 py-1 rounded shadow">02 Nov</span>
                    </div>
                    <h4 class="font-bold text-white text-xs mb-2 leading-snug">Unusual photo was taken near the town today:</h4>
                    <p class="text-[11px] text-slate-300 leading-relaxed mb-3">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry...
                    </p>
                    <a href="#" class="inline-block text-cyan-400 text-xs font-bold mt-2 hover:underline">Read more&gt;</a>
                </div>

                <div class="bg-slate-800/90 border border-slate-700 p-3 rounded shadow-lg backdrop-blur-sm" data-aos="fade-up" data-aos-duration="800" data-aos-delay="300">
                    <div class="relative overflow-hidden rounded mb-4">
                        <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=600&q=80" alt="Blog 3" class="w-full h-40 object-cover hover:scale-105 transition-transform duration-300">
                        <span class="absolute bottom-2 right-2 bg-cyan-600 text-white text-[10px] font-bold px-2 py-1 rounded shadow">29 Oct</span>
                    </div>
                    <h4 class="font-bold text-white text-xs mb-2 leading-snug">Unusual photo was taken near the town today:</h4>
                    <p class="text-[11px] text-slate-300 leading-relaxed mb-3">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry...
                    </p>
                    <a href="#" class="inline-block text-cyan-400 text-xs font-bold mt-2 hover:underline">Read more&gt;</a>
                </div>

                <div class="bg-slate-800/90 border border-slate-700 p-3 rounded shadow-lg backdrop-blur-sm" data-aos="fade-up" data-aos-duration="800" data-aos-delay="400">
                    <div class="relative overflow-hidden rounded mb-4">
                        <img src="https://images.unsplash.com/photo-1447752875215-b2761acb3c5d?auto=format&fit=crop&w=600&q=80" alt="Blog 4" class="w-full h-40 object-cover hover:scale-105 transition-transform duration-300">
                        <span class="absolute bottom-2 right-2 bg-cyan-600 text-white text-[10px] font-bold px-2 py-1 rounded shadow">15 Oct</span>
                    </div>
                    <h4 class="font-bold text-white text-xs mb-2 leading-snug">Unusual photo was taken near the town today:</h4>
                    <p class="text-[11px] text-slate-300 leading-relaxed mb-3">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry...
                    </p>
                    <a href="#" class="inline-block text-cyan-400 text-xs font-bold mt-2 hover:underline">Read more&gt;</a>
                </div>
            </div>
        </div>
    </section>

    <!-- CONTACT -->
    <section id="contact" class="relative pt-24 pb-20 bg-white text-slate-800 overflow-hidden">
        <div class="max-w-5xl mx-auto px-6 relative z-20">
            <div class="text-center max-w-2xl mx-auto mb-10">
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mb-3 tracking-tight" data-aos="fade-down" data-aos-duration="800">Write to us at Customer Support</h2>
                <p class="text-slate-500 text-xs leading-relaxed" data-aos="fade-up" data-aos-duration="800" data-aos-delay="150">
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                </p>
            </div>

            <form class="max-w-4xl mx-auto space-y-6" data-aos="fade-up" data-aos-duration="900" data-aos-delay="250">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="relative flex items-center border border-slate-300 rounded bg-white shadow-sm px-3 py-2">
                        <span class="text-slate-400 mr-2">👤</span>
                        <input type="text" placeholder="Your Name" class="w-full text-xs text-slate-700 outline-none bg-transparent placeholder-slate-400">
                    </div>
                    <div class="relative flex items-center border border-slate-300 rounded bg-white shadow-sm px-3 py-2">
                        <span class="text-slate-400 mr-2">✉️</span>
                        <input type="email" placeholder="E-mail" class="w-full text-xs text-slate-700 outline-none bg-transparent placeholder-slate-400">
                    </div>
                    <div class="relative flex items-center border border-slate-300 rounded bg-white shadow-sm px-3 py-2">
                        <span class="text-slate-400 mr-2">📞</span>
                        <input type="text" placeholder="Your Tele Phone Number" class="w-full text-xs text-slate-700 outline-none bg-transparent placeholder-slate-400">
                    </div>
                </div>

                <div>
                    <textarea rows="5" placeholder="Write Your Questions here..." class="w-full text-xs text-slate-700 border border-slate-300 rounded bg-white shadow-sm p-3 outline-none placeholder-slate-400 resize-none"></textarea>
                </div>

                <div class="text-center">
                    <button type="submit" class="bg-cyan-500 hover:bg-cyan-600 text-white text-xs font-bold uppercase tracking-wider px-8 py-3 rounded shadow-md transition-all">
                        Send Message
                    </button>
                </div>
            </form>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-[#191919] text-slate-400 pt-16 pb-8 border-t border-slate-800 text-xs" data-aos="fade-up" data-aos-duration="800">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10 mb-12">
            <div>
                <h4 class="text-white font-bold text-xs uppercase tracking-wider mb-4 border-b border-slate-800 pb-2">About Us</h4>
                <p class="text-[11px] text-slate-400 leading-relaxed mb-4">
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                </p>
                <p class="text-[11px] text-slate-300 leading-relaxed font-semibold">
                    123 Street Name<br>
                    Road Name<br>
                    Country Name<br>
                    +123 123 456 789
                </p>
            </div>

            <div>
                <h4 class="text-white font-bold text-xs uppercase tracking-wider mb-4 border-b border-slate-800 pb-2">Latest tweets</h4>
                <p class="text-[11px] text-slate-400 italic">No tweets available at the moment.</p>
            </div>

            <div>
                <h4 class="text-white font-bold text-xs uppercase tracking-wider mb-4 border-b border-slate-800 pb-2">Latest post</h4>
                <ul class="space-y-2 text-[11px]">
                    <li><a href="#" class="hover:text-cyan-400 transition-colors block border-b border-slate-800/60 pb-1">Click here to what next?</a></li>
                    <li><a href="#" class="hover:text-cyan-400 transition-colors block border-b border-slate-800/60 pb-1">Latest Project Post</a></li>
                    <li><a href="#" class="hover:text-cyan-400 transition-colors block border-b border-slate-800/60 pb-1">Blog Video Post</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-white font-bold text-xs uppercase tracking-wider mb-4 border-b border-slate-800 pb-2">Flickr</h4>
                <div class="grid grid-cols-4 gap-2">
                    <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=150&q=80" alt="Flickr 1" class="w-full h-12 object-cover rounded hover:opacity-75 transition-opacity">
                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=150&q=80" alt="Flickr 2" class="w-full h-12 object-cover rounded hover:opacity-75 transition-opacity">
                    <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=150&q=80" alt="Flickr 3" class="w-full h-12 object-cover rounded hover:opacity-75 transition-opacity">
                    <img src="https://images.unsplash.com/photo-1580489944761-15a19d654956?auto=format&fit=crop&w=150&q=80" alt="Flickr 4" class="w-full h-12 object-cover rounded hover:opacity-75 transition-opacity">
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-6 pt-6 border-t border-slate-800 flex flex-col sm:flex-row items-center justify-between gap-4 text-[11px]">
            <p>© Copyright 2026. "DESIRABLE" By RaulDesign. All Rights Reserved.</p>
            <div class="flex gap-4 text-slate-300 text-sm">
                <a href="#" class="hover:text-cyan-400 transition-colors">🌐</a>
                <a href="#" class="hover:text-cyan-400 transition-colors">f</a>
                <a href="#" class="hover:text-cyan-400 transition-colors">t</a>
                <a href="#" class="hover:text-cyan-400 transition-colors">in</a>
            </div>
        </div>
    </footer>


    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            once: false,
            mirror: true,
            offset: 80,
            duration: 900,
            easing: 'ease-out-cubic',
        });

        window.addEventListener('load', () => {
            if (window.location.hash !== '#home') {
                window.scrollTo(0, 0);
            }
        });

        const navLinks = document.querySelectorAll('#main-nav .nav-item');

        navLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                const targetId = this.getAttribute('href');
                if (targetId && targetId.length > 1) {
                    const targetElement = document.querySelector(targetId);
                    if (targetElement) {
                        e.preventDefault();

                        navLinks.forEach(nav => nav.classList.remove('active-tab'));
                        this.classList.add('active-tab');

                        const headerOffset = 80;
                        const elementPosition = targetElement.getBoundingClientRect().top;
                        const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

                        window.scrollTo({
                            top: offsetPosition,
                            behavior: 'smooth'
                        });
                    }
                }
            });
        });

        const sections = document.querySelectorAll('section[id], footer[id]');

        const observerOptions = {
            root: null,
            rootMargin: '-80px 0px -50% 0px',
            threshold: 0
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const id = entry.target.getAttribute('id');
                    navLinks.forEach(link => {
                        if (link.getAttribute('href') === `#${id}`) {
                            link.classList.add('active-tab');
                        } else {
                            link.classList.remove('active-tab');
                        }
                    });
                }
            });
        }, observerOptions);

        sections.forEach(section => {
            observer.observe(section);
        });
    </script>

    <script>
        const slides = <?php echo json_encode($slides_php, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP); ?>

        let currentIndex = 0;
        let slideInterval;

        const banner = document.getElementById('hero-banner');
        const tag = document.getElementById('hero-tag');
        const title1 = document.getElementById('hero-title-1');
        const title2 = document.getElementById('hero-title-2');
        const desc = document.getElementById('hero-desc');
        const btn = document.getElementById('hero-btn');
        const indicatorsContainer = document.getElementById('hero-indicators');

        function createIndicators() {
            indicatorsContainer.innerHTML = '';
            slides.forEach((_, index) => {
                const bar = document.createElement('button');
                bar.className = `h-1.5 rounded-full transition-all duration-500 focus:outline-none cursor-pointer ${index === currentIndex ? 'w-12 bg-[#0082c8]' : 'w-8 bg-gray-600 hover:bg-gray-400'}`;
                bar.addEventListener('click', () => {
                    goToSlide(index);
                });
                indicatorsContainer.appendChild(bar);
            });
        }

        function updateSlide() {
            const current = slides[currentIndex];

            // 1. Iniciar desvanecimiento (Fade Out)
            tag.style.opacity = 0;
            title1.style.opacity = 0;
            title2.style.opacity = 0;
            desc.style.opacity = 0;
            if (btn) btn.style.opacity = 0;

            // Subimos el tiempo de espera a 600ms para que el texto viejo termine de borrarse con calma
            setTimeout(() => {
                // Cambiar fondo e información de la diapositiva
                banner.style.backgroundImage = `linear-gradient(to bottom, rgba(2,21,17,0.45), rgba(2,21,17,0.15)), url('${current.image}')`;

                tag.innerHTML = current.tag;
                title1.innerHTML = current.title1;
                title2.innerHTML = current.title2;
                desc.innerHTML = current.desc;

                // 2. Mostrar nuevo texto suavemente (Fade In)
                tag.style.opacity = 1;
                title1.style.opacity = 1;
                title2.style.opacity = 1;
                desc.style.opacity = 1;
                if (btn) btn.style.opacity = 1;

                createIndicators();
            }, 600); // 600ms de pausa entre el ocultado y la aparición
        }

        function goToSlide(index) {
            currentIndex = index;
            updateSlide();
            resetTimer();
        }

        function nextSlide() {
            currentIndex = (currentIndex + 1) % slides.length;
            updateSlide();
        }

        function startTimer() {
            slideInterval = setInterval(nextSlide, 5000); // Subido a 5 segundos para que la gente alcance a leer bien
        }

        function resetTimer() {
            clearInterval(slideInterval);
            startTimer();
        }

        updateSlide();
        startTimer();
    </script>
    <!-- BOTÓN FLOTANTE IR ARRIBA -->
    <!-- BOTÓN FLOTANTE IR ARRIBA SUAVE -->
    <!-- BOTÓN FLOTANTE IR ARRIBA -->
    <!-- BOTÓN FLOTANTE IR ARRIBA -->
    <!-- BOTÓN FLOTANTE IR ARRIBA -->
    <!-- BOTÓN FLOTANTE IR ARRIBA -->
    <a href="#home"
        id="scrollTopBtn"
        aria-label="Volver al inicio"
        class="fixed bottom-6 right-6 z-50 bg-cyan-500 hover:bg-cyan-600 text-white w-12 h-12 rounded-full flex items-center justify-center shadow-2xl transition-all duration-500 ease-in-out transform hover:scale-110 opacity-0 invisible translate-y-4">
        <!-- Ícono de Flecha hacia arriba -->
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" />
        </svg>
    </a>

    <!-- SCRIPT ROBUSTO Y REUTILIZABLE -->
    <!-- SCRIPT DE SUBIDA SUAVE CON EFECTO DE FRENADO Y REUTILIZABLE -->
    <!-- SCRIPT DE SUBIDA SUAVE CON EFECTO DE FRENADO Y REUTILIZABLE -->
    <!-- SCRIPT DEFINITIVO Y ESTABLE PARA SCROLL SUAVE -->
    <!-- SCRIPT DE SUBIDA SUAVE Y FLUIDA ASEGURADA -->
    <!-- SCRIPT DE SUBIDA LENTA, FLUIDA Y SUAVE -->
    <script>
        const scrollTopBtn = document.getElementById('scrollTopBtn');

        // 1. Mostrar / Ocultar el botón suavemente al hacer scroll
        window.addEventListener('scroll', () => {
            if (window.scrollY > 300) {
                scrollTopBtn.classList.remove('opacity-0', 'invisible', 'translate-y-4');
                scrollTopBtn.classList.add('opacity-100', 'visible', 'translate-y-0');
            } else {
                scrollTopBtn.classList.remove('opacity-100', 'visible', 'translate-y-0');
                scrollTopBtn.classList.add('opacity-0', 'invisible', 'translate-y-4');
            }
        });

        // 2. Animación de subida lenta y con frenado ultra suave
        scrollTopBtn.addEventListener('click', (e) => {
            e.preventDefault();

            const targetPosition = 0;
            const startPosition = window.pageYOffset;
            const distance = targetPosition - startPosition;
            const duration = 2000; // Duración aumentada a 1.1 segundos para que vaya más lento y suave
            let startTime = null;

            function animation(currentTime) {
                if (startTime === null)
                    startTime = currentTime;
                const timeElapsed = currentTime - startTime;

                // Función matemática de aceleración y desaceleración suave (easeInOutCubic)
                const run = easeInOutCubic(timeElapsed, startPosition, distance, duration);

                window.scrollTo(0, run);

                if (timeElapsed < duration) {
                    requestAnimationFrame(animation);
                } else {
                    window.scrollTo(0, targetPosition);
                }
            }

            function easeInOutCubic(t, b, c, d) {
                t /= d / 2;
                if (t < 1)
                    return c / 2 * t * t * t + b;
                t -= 2;
                return c / 2 * (t * t * t + 2) + b;
            }

            requestAnimationFrame(animation);
        });
    </script>

</body>

<?php
//get_footer();
