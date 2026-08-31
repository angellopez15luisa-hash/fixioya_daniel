<?php
/*
  Template Name: plantilla baners
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

?>

<head>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4">
  </script>
</head>

<body class="bg-slate-50 text-slate-800 font-sans">
  <!-- Contenedor Principal (Hero Banner) -->
  <div id="hero-banner" class="relative min-h-screen bg-[#021511] text-white flex flex-col justify-between overflow-hidden font-sans transition-all duration-1000 ease-in-out bg-cover bg-center">

    <!-- Gradiente de fondo aclarado -->
    <div class="absolute inset-0 bg-gradient-to-b from-[#021511]/60 via-[#021511]/20 to-[#021511]/70 pointer-events-none"></div>

    <!-- 2. CONTENIDO CENTRAL (Textos dinámicos) -->
    <!-- Cambiamos duration-500 a duration-1000 para que el desvanecimiento sea más lento y suave -->
    <main class="relative z-10 flex-1 flex flex-col items-center justify-center text-center px-4 max-w-4xl mx-auto my-12" id="hero-content">

      <!-- Etiqueta superior -->
      <div id="hero-tag" class="inline-flex items-center gap-2 rounded-full bg-black/60 border border-amber-500/30 px-5 py-1.5 text-xs sm:text-sm font-bold tracking-widest text-amber-400 uppercase mb-6 transition-opacity duration-1000 ease-in-out">
        ✦ Edición limitada de invierno
      </div>

      <h1 class="text-4xl sm:text-6xl md:text-7xl font-extrabold tracking-tight leading-none uppercase select-none">
        <span id="hero-title-1" class="block text-white transition-opacity duration-1000 ease-in-out">Estilo sin</span>
        <span id="hero-title-2" class="block text-transparent bg-clip-text bg-gradient-to-r from-[#0082c8] to-[#00a8ff] mt-2 filter drop-shadow-[0_5px_15px_rgba(0,130,200,0.3)] transition-opacity duration-1000 ease-in-out">
          Límites de oferta
        </span>
      </h1>

      <!-- Descripción -->
      <p id="hero-desc" class="mt-6 text-lg sm:text-2xl text-gray-100 max-w-2xl font-normal leading-relaxed transition-opacity duration-1000 ease-in-out drop-shadow-md">
        Aparta tus piezas favoritas antes de que se agoten en stock internacional.
      </p>

      <!-- Botón -->
      <div class="mt-8">
        <?php $button = get_field('button'); ?>
        <?php if ($button) : ?>
          <a id="hero-btn" href="<?php echo esc_url($button['url']); ?>" target="<?php echo esc_attr($button['target']); ?>" class="inline-block rounded-full bg-[#0082c8] hover:bg-[#0070ab] text-white font-extrabold text-xs tracking-wider uppercase px-8 py-3.5 transition-opacity transform hover:scale-105 duration-1000 ease-in-out shadow-lg shadow-[#0082c8]/40"><?php echo esc_html($button['title']); ?></a>
        <?php endif; ?>
      </div>

    </main>

    <!-- 3. INDICADORES INFERIORES -->
    <footer class="relative z-10 w-full flex justify-center gap-3 pb-8" id="hero-indicators">
      <!-- Se generan dinámicamente con interacción por JS -->
    </footer>

  </div>

  <!-- SCRIPT DE JAVASCRIPT -->
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
</body>
<?php
//get_footer();