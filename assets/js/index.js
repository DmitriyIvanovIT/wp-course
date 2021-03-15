const swiperPhotoReport = new Swiper('.photo-report-slider', {
    loop: true,
    autoplay: {
        delay: 5000,
    },
    // If we need pagination
    pagination: {
        el: '.swiper-pagination',
    },
});

const headerMenuToggle = document.querySelector('.header-menu-toggle'),
headerNav = document.querySelector('.header-nav');

headerMenuToggle.addEventListener('click', e => {
    e.preventDefault();

    if (!headerNav.classList.contains('active')) {
        headerNav.classList.toggle('active');
        headerNav.style.height = `${headerNav.scrollHeight}px`;
    } else {
        headerNav.style.height = ``;
        headerNav.classList.toggle('active');
    }
    
})