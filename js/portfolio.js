document.addEventListener("DOMContentLoaded", () => {
    const lightbox = document.getElementById("lightbox");
    const lightboxImage = document.getElementById("lightbox-image");
    const lightboxTitle = document.getElementById("lightbox-title");
    const lightboxDescription = document.getElementById("lightbox-description");
    const lightboxFileSize = document.getElementById("lightbox-file-size");
    const lightboxDimensions = document.getElementById("lightbox-dimensions");
    const lightboxUploadDate = document.getElementById("lightbox-upload-date");
    const closeBtn = document.querySelector(".close-btn");
    const lightboxContent = document.querySelector(".lightbox-content");

    // Close lightbox when clicking the close button
    closeBtn.addEventListener("click", () => {
        lightbox.classList.remove("visible");
    });

    // Close lightbox when clicking outside the lightbox content
    lightbox.addEventListener("click", (event) => {
        if (!lightboxContent.contains(event.target)) {
            lightbox.classList.remove("visible");
        }
    });

    // Debugging - Check if gallery items are detected
    const galleryItems = document.querySelectorAll(".gallery-item");
    if (galleryItems.length) {
        console.log("Gallery items loaded:", galleryItems.length);
    } else {
        console.error("No gallery items found.");
    }

    galleryItems.forEach(item => {
        item.addEventListener("click", async (event) => {
            const id = event.currentTarget.getAttribute("data-id");
            const imageSrc = event.currentTarget.getAttribute("data-image-src");
            console.log("Fetching metadata for ID:", id);

            try {
                const response = await fetch(`../php/logic/portfolio_fetch_metadata.php?id=${id}`);
                if (!response.ok) {
                    throw new Error("Failed to fetch metadata");
                }

                const metadata = await response.json();
                console.log("Metadata received:", metadata);

                if (metadata && !metadata.error) {
                    // Populate popup UI
                    lightboxImage.src = imageSrc;
                    lightboxTitle.textContent = metadata.file_name || "No Title";
                    lightboxDescription.textContent = metadata.description || "No Description";
                    lightboxFileSize.textContent = metadata.file_size 
                        ? `File Size: ${metadata.file_size} KB` 
                        : "File Size: N/A";
                    lightboxDimensions.textContent = metadata.width && metadata.height 
                        ? `Dimensions: ${metadata.width} x ${metadata.height}` 
                        : "Dimensions: N/A";
                    lightboxUploadDate.textContent = metadata.upload_date 
                        ? `Upload Date: ${metadata.upload_date}` 
                        : "Upload Date: N/A";

                    // Display the popup
                    lightbox.classList.add("visible");
                } else {
                    console.error("Metadata is empty or error occurred.");
                }
            } catch (error) {
                console.error("Error during fetch:", error);
            }
        });
    });
});
