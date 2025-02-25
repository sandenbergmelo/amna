<div class="relative max-w-4xl mx-auto p-4 border-2 border-transparent rounded-lg cursor-pointer w-[26rem] h-[13rem] lg:w-[50rem] lg:h-[25rem] md:w-[40rem] md:h-[20rem]" id="carousel">
    <div class="carousel-item active absolute top-0 left-0 w-full h-full opacity-0 transition-opacity duration-1000 ease-in-out z-1">
        <img src="{{ asset('carousel/carousel-1.jpeg') }}" class="w-full h-full object-cover rounded-lg shadow-lg">
    </div>
    <div class="carousel-item absolute top-0 left-0 w-full h-full opacity-0 transition-opacity duration-1000 ease-in-out z-1">
        <img src="{{ asset('carousel/carousel-2.jpeg') }}" class="w-full h-full object-cover rounded-lg shadow-lg">
    </div>
    <div class="carousel-item absolute top-0 left-0 w-full h-full opacity-0 transition-opacity duration-1000 ease-in-out z-1">
        <img src="{{ asset('carousel/carousel-3.jpeg') }}" class="w-full h-full object-cover rounded-lg shadow-lg">
    </div>
    <button class="absolute top-1/2 left-0 transform -translate-y-1/2 bg-gray-800 text-white p-2 rounded-full z-10" onclick="prevSlide()">&#10094;</button>
    <button class="absolute top-1/2 right-0 transform -translate-y-1/2 bg-gray-800 text-white p-2 rounded-full z-10" onclick="nextSlide()">&#10095;</button>
</div>

<script>
    let currentSlide = 0;
    const slides = document.querySelectorAll('.carousel-item');
    let slideInterval;

    function showSlide(index) {
        slides.forEach((slide, i) => {
            slide.classList.toggle('active', i === index);
        });
    }

    function nextSlide() {
        currentSlide = (currentSlide + 1) % slides.length;
        showSlide(currentSlide);
    }

    function prevSlide() {
        currentSlide = (currentSlide - 1 + slides.length) % slides.length;
        showSlide(currentSlide);
    }

    function startSlideShow() {
        slideInterval = setInterval(nextSlide, 4000); // Muda de slide a cada 4 segundos
    }

    function stopSlideShow() {
        clearInterval(slideInterval);
    }

    document.getElementById('carousel').addEventListener('mouseover', stopSlideShow);
    document.getElementById('carousel').addEventListener('mouseout', startSlideShow);

    // Iniciar a transição automática
    startSlideShow();
</script>

<style>
    .carousel-item.active {
        opacity: 1;
    }
</style>
