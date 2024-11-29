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

            // Populate lightbox content
            lightboxImage.src = imageSrc;
            lightboxTitle.textContent = title || "No Title";
            lightboxDescription.textContent = description || "No Metadata Available";

            // Show lightbox
            lightbox.classList.add("visible");
        });
    });

    // Close lightbox when clicking the close button
    closeBtn.addEventListener("click", () => {
        lightbox.classList.remove("visible");
    });

    // Close lightbox when clicking outside the content area
    lightbox.addEventListener("click", (event) => {
        if (event.target === lightbox) {
            lightbox.classList.remove("visible");
        }
    });
});
