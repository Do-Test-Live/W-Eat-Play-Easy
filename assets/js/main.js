const prevButton = document.getElementById('prevButton');
const nextButton = document.getElementById('nextButton');
const carouselItems = document.querySelectorAll('.carousel-inner .carousel-item');
let activeIndex = 0; // Track the active item index

prevButton.addEventListener('click', function () {
    carouselItems[activeIndex].classList.remove('active');
    activeIndex = (activeIndex - 1 + carouselItems.length) % carouselItems.length;
    if (activeIndex == 0) {
        activeIndex = 4;
    }

    carouselItems[activeIndex].classList.add('active');
});

nextButton.addEventListener('click', function () {
    carouselItems[activeIndex].classList.remove('active');
    activeIndex = (activeIndex + 1) % carouselItems.length;
    if (activeIndex == 0) {
        activeIndex = 1;
    }
    carouselItems[activeIndex].classList.add('active');
});