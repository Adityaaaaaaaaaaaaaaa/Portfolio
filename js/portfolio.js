document.addEventListener("DOMContentLoaded", () => {
    const lightbox = document.getElementById("lightbox");
    const lightboxImage = document.getElementById("lightbox-image");
    const lightboxTitle = document.getElementById("lightbox-title");
    const lightboxDescription = document.getElementById("lightbox-description");
    const closeBtn = document.querySelector(".close-btn");

    // When an image is clicked, show the lightbox
    document.querySelectorAll(".gallery-item").forEach(item => {
        item.addEventListener("click", () => {
            const imageSrc = item.querySelector("img").src;
            const title = item.getAttribute("data-title");
            const description = item.getAttribute("data-description");

            // Populate the lightbox content with the image and metadata
            lightboxImage.src = imageSrc;
            lightboxTitle.textContent = title || "No Title";
            lightboxDescription.textContent = description || "No Metadata Available";

            // Show lightbox by adding the 'visible' class
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
