document.addEventListener('DOMContentLoaded', () => {
            const hamburger = document.getElementById('hamburger');
            const navMenuMobile = document.getElementById('nav-menu-mobile');

            if (hamburger && navMenuMobile) {
                hamburger.addEventListener('click', () => {
                    navMenuMobile.classList.toggle('active');
                });
            }
        });
