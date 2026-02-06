// script.js
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const submitBtn = document.querySelector('button[type="submit"]');
    
    // Validação simples
    form.addEventListener('submit', function(e) {
        const email = document.querySelector('input[type="email"]').value;
        const password = document.querySelector('input[type="password"]').value;
        
        if (!email || !password) {
            alert('Preencha todos os campos!');
            e.preventDefault();
        }
    });
    
    // Animação no hover do botão
    submitBtn.addEventListener('mouseenter', function() {
        this.style.transform = 'scale(1.05)';
    });
    
    submitBtn.addEventListener('mouseleave', function() {
        this.style.transform = 'scale(1)';
    });
});