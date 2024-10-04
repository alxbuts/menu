document.addEventListener('DOMContentLoaded', function() {
    const productsMenu = document.querySelector('.products-menu');
    const primaryMenu = document.querySelector('.primary-menu');
    const primaryMenuContainer = document.querySelector('.primary-menu-container');
    const subMenu = document.querySelectorAll('.sub-menu');

    productsMenu.addEventListener('click', function(e) {
        e.preventDefault();
        primaryMenuContainer.classList.toggle('hidden');

        const menuWidth = document.querySelector('.primary-menu').offsetWidth;
        const btnMenuHeight = document.querySelector('.products-menu').offsetHeight;
        const rect = primaryMenu.getBoundingClientRect();

        document.documentElement.style.setProperty('--primary-menu-width', `${rect.left + menuWidth}px`);
        document.documentElement.style.setProperty('--primary-menu-left', `${rect.left}px`);
        document.documentElement.style.setProperty('--products-menu-button-height', `${btnMenuHeight}px`);
    });
});