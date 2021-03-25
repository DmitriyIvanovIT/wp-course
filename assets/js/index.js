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

});

let contactsForm = document.querySelector('.contacts-form');

const sendData = (body, url) => fetch(url, {
    method: 'POST',
    body: body
});

contactsForm.addEventListener('submit', e => {
    e.preventDefault();
    const formData = new FormData(contactsForm);
    formData.append('action', 'contacts_form')
    console.log(formData);

    sendData(formData, adminAjax.url)
    .then(response => {
        if (response.status !== 200) {
            throw new Error(`status network ${response.status}!`);
        }
        console.log(response.text());
        contactsForm.reset();
    })
    .catch(error => {
        console.error(error);
    });
    

    // alert(adminAjax.url);
})