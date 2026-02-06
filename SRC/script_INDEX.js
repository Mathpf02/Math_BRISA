// =========================================
// JAVASCRIPT PARA O SITE ALQUÍMIA TAVERNA
// Compatível com: index.html, equipe_INDEX.html, sistema_INDEX.html
// =========================================

// ---------- FUNÇÕES GLOBAIS (usadas em todos os arquivos) ----------

// Função para rolagem suave ao clicar em links de âncora (ex.: #alquimia)
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
  anchor.addEventListener('click', function (e) {
    e.preventDefault();
    const target = document.querySelector(this.getAttribute('href'));
    if (target) {
      target.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
  });
});

// ---------- ESPECÍFICO PARA index.html (INDEX) ----------
// Suporte ao carrossel na seção ALQUÍMIA (se existir; caso contrário, ignorado)
let indexCarouselIndex = 0;
function indexCarouselMove(direction) {
  const track = document.getElementById('indexCarouselTrack');
  if (!track) return;
  const slides = track.querySelectorAll('.carousel-slide');
  if (slides.length === 0) return;
  indexCarouselIndex += direction;
  if (indexCarouselIndex >= slides.length) indexCarouselIndex = 0;
  if (indexCarouselIndex < 0) indexCarouselIndex = slides.length - 1;
  track.style.transform = `translateX(-${indexCarouselIndex * 100}%)`;
}

// ---------- ESPECÍFICO PARA equipe_INDEX.html ----------
// Sem carrossel específico; apenas animações básicas (ex.: hover em cards)
document.addEventListener('DOMContentLoaded', function() {
  // Animação de entrada para cards da equipe (fade-in)
  const cards = document.querySelectorAll('.equipe-item');
  cards.forEach((card, index) => {
    card.style.opacity = '0';
    card.style.transform = 'translateY(20px)';
    setTimeout(() => {
      card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
      card.style.opacity = '1';
      card.style.transform = 'translateY(0)';
    }, index * 100);
  });
});

// ---------- ESPECÍFICO PARA sistema_INDEX.html ----------
// Carrossel de telas do sistema (botões Anterior/Próximo)
let sistemaIndex = 0;
function sistemaMove(direction) {
  const track = document.getElementById('sistemaCarouselTrack');
  if (!track) return;
  const slides = track.querySelectorAll('.carousel-slide');
  if (slides.length === 0) return;
  sistemaIndex += direction;
  if (sistemaIndex >= slides.length) sistemaIndex = 0;
  if (sistemaIndex < 0) sistemaIndex = slides.length - 1;
  track.style.transform = `translateX(-${sistemaIndex * 100}%)`;
}

// ---------- INICIALIZAÇÃO GERAL (executa em qualquer arquivo) ----------
document.addEventListener('DOMContentLoaded', function() {
  // Verifica se estamos em sistema_INDEX.html e inicializa carrossel
  if (document.getElementById('sistemaCarouselTrack')) {
    // Carrossel já inicializado via onclick nos botões
  }

  // Verifica se estamos em index.html e inicializa carrossel (se existir)
  if (document.getElementById('indexCarouselTrack')) {
    // Carrossel já inicializado via onclick nos botões
  }

  // Animações gerais (ex.: fade-in no hero, se existir)
  const hero = document.querySelector('.hero');
  if (hero) {
    hero.style.opacity = '0';
    setTimeout(() => {
      hero.style.transition = 'opacity 1s ease';
      hero.style.opacity = '1';
    }, 200);
  }
});