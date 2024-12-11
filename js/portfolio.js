document.addEventListener("DOMContentLoaded", () => {
    const lightbox = document.getElementById("lightbox");
    const lightboxImage = document.getElementById("lightbox-image");
    const lightboxTitle = document.getElementById("lightbox-title");
    const lightboxDescription = document.getElementById("lightbox-description");
    const closeBtn = document.querySelector(".close-btn");
    const editBtn = document.getElementById("edit-btn");
    const deleteBtn = document.getElementById("delete-btn");
    const saveBtn = document.getElementById("save-btn");
    const cancelBtn = document.getElementById("cancel-btn");
    const editTitleInput = document.getElementById("edit-title");
    const editDescriptionInput = document.getElementById("edit-description");
    const downloadBtn = document.getElementById("download-btn");
    const messageBox = document.getElementById("lightbox-message");
    const galleryItems = document.querySelectorAll(".gallery-item");

    const placeholderImage = "../images/placeholder.png";

    let currentImageId = null;

    // Check for the localStorage flag
    if (!localStorage.getItem("imageDeletedToast")) {
        localStorage.setItem("imageDeletedToast", "false");
    }

    // Function: Open Lightbox
    const openLightbox = async (id, src) => {
        currentImageId = id;
        lightboxImage.src = src;

        try {
            const metadata = await fetchMetadata(id);
            updateLightboxUI(metadata);
            clearMessage();
            lightbox.classList.add("visible");
        } catch (error) {
            console.error("Error opening lightbox:", error);
            alert("An error occurred while opening the lightbox.");
        }
    };

    // Function: Fetch Metadata
    const fetchMetadata = async (id) => {
        const response = await fetch(`../php/logic/portfolio_fetch_metadata.php?id=${id}`);
        if (!response.ok) {
            throw new Error("Failed to fetch metadata.");
        }
        return response.json();
    };

    // Function: Update Lightbox UI
    const updateLightboxUI = (metadata) => {
        lightboxTitle.textContent = metadata.file_name || "No Title";
        lightboxDescription.textContent = metadata.description || "No Description";

        if (editTitleInput && editDescriptionInput) {
            editTitleInput.value = metadata.file_name || "";
            editDescriptionInput.value = metadata.description || "";
        }
    };

    // Function: Clear Message Box
    const clearMessage = () => {
        if (messageBox) messageBox.textContent = "";
    };

    // Function: Close Lightbox
    const closeLightbox = () => {
        lightbox.classList.remove("visible");
        currentImageId = null;
    };

    // Function: Save Metadata
    const saveMetadata = async () => {
        const updatedTitle = editTitleInput.value;
        const updatedDescription = editDescriptionInput.value;

        try {
            const response = await fetch("../php/logic/portfolio_update.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ id: currentImageId, file_name: updatedTitle, description: updatedDescription }),
            });
            const result = await response.json();
            showMessage(result.message || "Metadata updated.", result.success ? "green" : "red");

            if (result.success) {
                //show a toast message that update was successful
                showToast("Metadata updated successfully. Reloading .....", "success");
            }
        } catch (error) {
            console.error("Error saving metadata:", error);
            showMessage("An error occurred while saving.", "red");
        }
    };

    // Function: Show Message in Lightbox
    const showMessage = (message, color) => {
        if (messageBox) {
            messageBox.textContent = message;
            messageBox.style.color = color;
        }
    };

    // Function: Delete Image
    const deleteImage = async () => {
        if (!confirm("Are you sure you want to delete this image?")) return;

        try {
            const response = await fetch(`../php/logic/portfolio_delete.php?id=${currentImageId}`, { method: "DELETE" });
            const result = await response.json();

            if (result.success) {
                localStorage.setItem("imageDeletedToast", "true");
                lightboxImage.src = placeholderImage;
                lightboxTitle.textContent = "Image Deleted";
                lightboxDescription.textContent = "This image has been removed.";

                showToast("Photo deleted successfully. Reloading .....", "success");

                setTimeout(() => {
                    closeLightbox();
                },1000);

                setTimeout(() => {
                    window.location.reload();
                }, 3000);
            } else {
                showToast(result.message || "Failed to delete the photo. Please try again.", "error");
            }
        } catch (error) {
            console.error("Error deleting photo:", error);
            lightboxImage.src = placeholderImage;
            lightboxTitle.textContent = "Image Deleted";
            lightboxDescription.textContent = "This image has been removed. Page will reload in 3 seconds.";

            localStorage.setItem("imageDeletedToast", "false");
            showToast("Photo deleted successfully. Reloading .....", "success");

            setTimeout(() => {
                closeLightbox();
            },1000);

            setTimeout(() => {
                window.location.reload();
            }, 3000);        
        }
    };

    // Function: Show Toast Notification
    const showToast = (message, type) => {
        const toast = document.createElement("div");
        toast.className = `toast ${type}`;
        toast.textContent = message;

        document.body.appendChild(toast);
        setTimeout(() => toast.remove(), 2500);
    };

    // Function: Download Image
    const downloadImage = () => {
        const link = document.createElement("a");
        link.href = lightboxImage.src;
        link.download = "image";
        link.click();
    };

    // Replace deleted images in the gallery during fetch
    galleryItems.forEach((item) => {
        const id = item.getAttribute("data-id");
        const src = item.getAttribute("data-image-src");

        fetchMetadata(id).then((metadata) => {
            if (metadata.is_deleted) {
                item.querySelector("img").src = placeholderImage;
            } else {
                item.querySelector("img").src = src;
            }
        }).catch((error) => {
            console.error(`Error fetching metadata for image ID ${id}:`, error);
            item.querySelector("img").src = placeholderImage;
        });

        item.addEventListener("click", () => openLightbox(id, src));
    });

    // Attach Event Listeners
    window.addEventListener("click", (event) => event.target === lightbox && closeLightbox());
    closeBtn?.addEventListener("click", closeLightbox);
    editBtn?.addEventListener("click", () => {
        document.getElementById("edit-controls").style.display = "block";
        editBtn.style.display = "none";
        deleteBtn.style.display = "none";
    });
    saveBtn?.addEventListener("click", saveMetadata);
    cancelBtn?.addEventListener("click", () => {
        document.getElementById("edit-controls").style.display = "none";
        editBtn.style.display = "inline";
        deleteBtn.style.display = "inline";
    });
    deleteBtn?.addEventListener("click", deleteImage);
    downloadBtn?.addEventListener("click", downloadImage);
});
