document.addEventListener("DOMContentLoaded", () => {
    const photoInput = document.getElementById("photo");
    const nextButton = document.getElementById("nextButton");
    const photoPreviewContainer = document.getElementById("photoPreviewContainer");
    const photoPreviewList = document.getElementById("photoPreviewList");
    const uploadAllButton = document.getElementById("uploadAllButton");
    const removeAllButton = document.getElementById("removeAllButton");

    let selectedFiles = [];

    // Handle "Next" button click
    nextButton.addEventListener("click", () => {
        if (selectedFiles.length > 0) {
            photoPreviewContainer.classList.remove("hidden");
        }
    });

    // Handle file input change
    photoInput.addEventListener("change", (event) => {
        Array.from(event.target.files).forEach((file) => {
            if (!selectedFiles.find((f) => f.file.name === file.name)) {
                selectedFiles.push({ file, description: "No description available for this image" });
                renderPhotoRow(file);
            }
        });
    });

    // Render a photo row
    function renderPhotoRow(file) {
        const fileRow = document.createElement("div");
        fileRow.classList.add("photo-row");
        fileRow.innerHTML = `
            <div class="photo-left">
                <img src="${URL.createObjectURL(file)}" alt="${file.name}" width="100" height="100">
            </div>
            <div class="photo-middle">
                <p class="photo-text"><strong>Name:</strong> <input type="text" value="${file.name}" class="file-name-details"></p>
                <p class="photo-text"><strong>Size:</strong> ${formatFileSize(file.size)}</p>
                <p class="photo-text"><strong>Description:</strong> 
                    <textarea class="file-name-details file-description" rows="2" placeholder="Enter a description...">No description available for this image</textarea>
                </p>
            </div>
            <div class="photo-right">
                <button class="upload-button action-button">Upload</button>
                <button class="remove-button action-button">Remove</button>
            </div>
        `;

        // Handle "Remove" button click for individual rows
        fileRow.querySelector(".remove-button").addEventListener("click", () => {
            selectedFiles = selectedFiles.filter((f) => f.file.name !== file.name);
            fileRow.remove();
            togglePreviewVisibility();
        });

        // Handle description input change
        fileRow.querySelector(".file-description").addEventListener("input", (event) => {
            const selectedFile = selectedFiles.find((f) => f.file.name === file.name);
            selectedFile.description = event.target.value;
        });

        photoPreviewList.appendChild(fileRow);
    }

    // Format file size to KB or MB
    function formatFileSize(size) {
        return size >= 1024 * 1024
            ? `${(size / (1024 * 1024)).toFixed(2)} MB`
            : `${(size / 1024).toFixed(2)} KB`;
    }

    // Remove all files
    removeAllButton.addEventListener("click", () => {
        selectedFiles = [];
        photoPreviewList.innerHTML = "";
        togglePreviewVisibility();
    });

    // Toggle visibility of the scrollable window
    function togglePreviewVisibility() {
        if (selectedFiles.length === 0) {
            photoPreviewContainer.classList.add("hidden");
        }
    }

    // Dummy upload for all files
    uploadAllButton.addEventListener("click", () => {
        selectedFiles.forEach((fileObj) => {
            console.log("Dummy upload for:", fileObj.file.name, fileObj.description);
        });
        alert("Dummy upload completed.");
    });
});
