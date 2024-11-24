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
    const popupContent = document.querySelector(".popup-content"); // Adjust this to your modal content selector
    const popupImage = document.getElementById("popup-image");
    const popupDescription = document.getElementById("popup-description");
    const popupLink = document.getElementById("popup-link");
    const closeBtn = document.querySelector(".popup-close");

    // Close button functionality
    if (closeBtn) {
        closeBtn.addEventListener("click", closePopup);
    }

    // Function to close popup
    function closePopup() {
        popup.classList.remove("visible");
        popup.classList.add("hidden");
        document.body.style.overflow = ""; // Re-enable background scrolling
    }

    // Show popup on image click
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

    // Close popup when clicking outside the content
    if (popup) {
        popup.addEventListener("click", (e) => {
            if (!popupContent.contains(e.target)) {
                closePopup();
            }
        });
    }
});
