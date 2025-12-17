/* =========================================
   LÓGICA DO MENU, DARK MODE E LINK ATIVO
   ========================================= */

document.addEventListener('DOMContentLoaded', () => {
    
    // --- DETECTAR QUAL PÁGINA ESTÁ ATIVA ---
    const currentUrl = window.location.href; 
    const links = document.querySelectorAll('.nav-links a');

    links.forEach(link => {
        const href = link.getAttribute('href');
        
        if (href.includes('home.php') && currentUrl.includes('home.php')) {
            link.classList.add('ativo');
        }
        else if (href.includes('/entidade/') && currentUrl.includes('/entidade/')) {
            link.classList.add('ativo');
        }
        else if (href.includes('/turma/') && currentUrl.includes('/turma/')) {
            link.classList.add('ativo');
        }
        else if (href.includes('/ginasta/') && currentUrl.includes('/ginasta/')) {
            link.classList.add('ativo');
        }
        else if (href.includes('/usuario/') && currentUrl.includes('/usuario/')) {
            link.classList.add('ativo');
        }
    });


    // --- MENU HAMBÚRGUER Mobile ---
    const btnMenu = document.querySelector('.menu-toggle');
    const navLinks = document.querySelector('.nav-links');

    if(btnMenu && navLinks) {
        btnMenu.addEventListener('click', () => {
            navLinks.classList.toggle('ativo'); // Abre/Fecha o menu mobile
            
            // Troca ícone ☰ por X
            if(navLinks.classList.contains('ativo')) {
                btnMenu.innerText = '✕';
            } else {
                btnMenu.innerText = '☰';
            }
        });
    }


    // --- DARK MODE ---
    const btnTema = document.getElementById('btn-tema-menu');
    const body = document.body;
    
    // Verifica preferência salva ao carregar
    if (localStorage.getItem('tema') === 'escuro') {
        body.classList.add('dark-mode');
        if(btnTema) btnTema.innerText = '☀️';
    }

    if(btnTema) {
        btnTema.addEventListener('click', () => {
            body.classList.toggle('dark-mode');
            
            if (body.classList.contains('dark-mode')) {
                localStorage.setItem('tema', 'escuro');
                btnTema.innerText = '☀️';
            } else {
                localStorage.setItem('tema', 'claro');
                btnTema.innerText = '🌙';
            }
        });
    }
});