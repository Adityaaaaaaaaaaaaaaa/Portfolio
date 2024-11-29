document.addEventListener("DOMContentLoaded", () => {
    const lightbox = document.getElementById("lightbox");
    const lightboxImage = document.getElementById("lightbox-image");
    const lightboxTitle = document.getElementById("lightbox-title");
    const lightboxDescription = document.getElementById("lightbox-description");
    const closeBtn = document.querySelector(".close-btn");

    document.querySelectorAll(".gallery-item").forEach(item => {
        item.addEventListener("click", () => {
            const imageSrc = item.querySelector("img").src;
            const title = item.getAttribute("data-title");
            const description = item.getAttribute("data-description");

            lightboxImage.src = imageSrc;
            lightboxTitle.textContent = title;
            lightboxDescription.textContent = description;

            lightbox.classList.add("visible");
        });
    });

    closeBtn.addEventListener("click", () => {
        lightbox.classList.remove("visible");
    });

    lightbox.addEventListener("click", (event) => {
        if (event.target === lightbox) {
            lightbox.classList.remove("visible");
        }
    });
});
