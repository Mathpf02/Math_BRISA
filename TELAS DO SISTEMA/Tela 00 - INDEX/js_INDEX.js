// ==================== VARIÁVEIS GLOBAIS ====================
let currentSlide = 0;
const totalSlides = 4;

// ==================== FUNÇÃO: MOVER CARROSSEL ====================
function moveCarousel(direction) {
  const carousel = document.querySelector('.carousel');
  const dots = document.querySelectorAll('.dot');

  currentSlide += direction;

  // Loop infinito
  if (currentSlide >= totalSlides) {
    currentSlide = 0;
  } else if (currentSlide < 0) {
    currentSlide = totalSlides - 1;
  }

  // Atualiza posição do carrossel
  carousel.style.transform = `translateX(-${currentSlide * 100}%)`;

  // Atualiza dots
  updateDots(dots);
}

// ==================== FUNÇÃO: IR PARA SLIDE ESPECÍFICO ====================
function currentSlide(n) {
  const carousel = document.querySelector('.carousel');
  const dots = document.querySelectorAll('.dot');

  currentSlide = n;
  carousel.style.transform = `translateX(-${currentSlide * 100}%)`;

  updateDots(dots);
}

// ==================== FUNÇÃO: ATUALIZAR DOTS ====================
function updateDots(dots) {
  dots.forEach((dot, index) => {
    dot.classList.remove('active');
    if (index === currentSlide) {
      dot.classList.add('active');
    }
  });
}

// ==================== INICIALIZAÇÃO ====================
document.addEventListener('DOMContentLoaded', () => {
  const dots = document.querySelectorAll('.dot');
  if (dots.length > 0) {
    dots[0].classList.add('active');
  }

  // Navegação por botões
  document.querySelectorAll('.nav-btn').forEach(btn => {
    btn.addEventListener('click', (e) => {
      const section = btn.getAttribute('data-section');
      if (section) {
        const element = document.getElementById(section);
        if (element) {
          element.scrollIntoView({ behavior: 'smooth' });
        }
      }
    });
  });
});

// ==================== AUTO-PLAY (OPCIONAL) ====================
// Descomente a linha abaixo para ativar auto-play a cada 6 segundos
// setInterval(() => { moveCarousel(1); }, 6000);

// ==================== NAVEGAÇÃO POR TECLADO ====================
document.addEventListener('keydown', (e) => {
  if (e.key === 'ArrowLeft') {
    moveCarousel(-1);
  } else if (e.key === 'ArrowRight') {
    moveCarousel(1);
  }
});

<script>
  let sistemaIndex = 0;

  function sistemaMove(direction){
    const track = document.getElementById('sistemaCarouselTrack');
    if(!track) return;

    const slides = track.querySelectorAll('.carousel-slide');
    if(slides.length === 0) return;

    sistemaIndex += direction;

    if(sistemaIndex >= slides.length) sistemaIndex = 0;
    if(sistemaIndex < 0) sistemaIndex = slides.length - 1;

    track.style.transform = `translateX(-${sistemaIndex * 100}%)`;
  }
</script>