document.addEventListener("DOMContentLoaded", () => {
    const swiper = new Swiper('.swiper-container', {
        slidesPerView: 3,
        spaceBetween: 50,
        loop: true,
        autoplay: {
            delay: 3500,
            disableOnInteraction: true,
        },
        breakpoints: {
            640: { slidesPerView: 1 },
            768: { slidesPerView: 2 },
            1024: { slidesPerView: 3 },
        },
    });

    const popup = document.getElementById("photo-popup");
    const popupImage = document.getElementById("popup-image");
    const popupDescription = document.getElementById("popup-description");
    const popupLink = document.getElementById("popup-link");
    const closeBtn = document.querySelector(".popup-close");

    if (closeBtn) {
        closeBtn.addEventListener("click", () => {
            popup.classList.remove("visible");
            popup.classList.add("hidden");
            document.body.style.overflow = ""; // Re-enable background scrolling
        });
    }

    document.querySelectorAll(".swiper-slide img").forEach(img => {
        img.addEventListener("click", () => {
            const description = img.dataset.description;
            const link = img.dataset.link;
            popupImage.src = img.src;
            popupDescription.textContent = description;
            popupLink.href = link;
            popup.classList.remove("hidden");
            popup.classList.add("visible");
            document.body.style.overflow = "hidden"; // Disable background scrolling
        });
    });
});
