document.addEventListener("DOMContentLoaded", () => {
    const photoInput = document.getElementById("photo");
    const nextButton = document.getElementById("nextButton");
    const photoPreviewContainer = document.getElementById("photoPreviewContainer");
    const photoPreviewList = document.getElementById("photoPreviewList");
    const uploadAllButton = document.getElementById("uploadAllButton");
    const removeAllButton = document.getElementById("removeAllButton");

    let selectedFiles = [];

    // Maximum of 15 files
    const MAX_FILES = 15;

    // Handle "Next" button click
    nextButton.addEventListener("click", () => {
        if (selectedFiles.length > 0) {
            photoPreviewContainer.classList.remove("hidden");
        }
    });

    // Handle file input change
    photoInput.addEventListener("change", (event) => {
        // If the user selects more than 15 files, limit them to 15
        if (event.target.files.length + selectedFiles.length > MAX_FILES) {
            alert(`You can only upload a maximum of ${MAX_FILES} files.`);
            return;
        }

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
        fileRow.setAttribute("data-filename", file.name); 
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
                <button class="remove-button">Remove</button>
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

    uploadAllButton.addEventListener("click", () => {
        if (selectedFiles.length === 0) {
            displayMessage("No files to upload.", false); // Show error
            return;
        }
    
        let uploadedCount = 0;
        let failedUploads = [];
        const totalFiles = selectedFiles.length;
    
        selectedFiles.forEach(({ file, description }) => {
            const fileRow = photoPreviewList.querySelector(`.photo-row[data-filename="${file.name}"]`);
            uploadFile(
                file,
                description,
                fileRow,
                () => {
                    uploadedCount++;
                    console.log(`Uploaded ${file.name}`);
                    if (uploadedCount + failedUploads.length === totalFiles) {
                        handleUploadResults(uploadedCount, failedUploads);
                    }
                },
                (error) => {
                    console.error(`Error uploading ${file.name}: ${error}`);
                    failedUploads.push(file.name);
                    if (uploadedCount + failedUploads.length === totalFiles) {
                        handleUploadResults(uploadedCount, failedUploads);
                    }
                }
            );
        });
    });
    
    // Display upload results
    function handleUploadResults(successCount, failedUploads) {
        let message = `<strong>Upload Complete:</strong><br>`;
        if (successCount > 0) {
            message += `<span>${successCount} files uploaded successfully.</span><br>`;
        }
        if (failedUploads.length > 0) {
            message += `<span>The following files failed to upload:</span><br><ul>`;
            failedUploads.forEach((file) => {
                message += `<li>${file}</li>`;
            });
            message += `</ul>`;
        }
        const isSuccess = failedUploads.length === 0;
        displayMessage(message, isSuccess);
    
        // Reset UI if all uploads succeed
        if (isSuccess) {
            selectedFiles = [];
            photoPreviewList.innerHTML = "";
            togglePreviewVisibility();
        }
    }
    
    
    // Utility function to display messages
    function displayMessage(message, isSuccess) {
        const messageContainer = document.getElementById("uploadMessages");
        messageContainer.innerHTML = message; // Set message text
        messageContainer.className = `upload-messages ${isSuccess ? "success" : "error"}`; // Apply styling class
        messageContainer.style.display = "block"; // Show the message container

        // Optionally hide the message after a delay
        setTimeout(() => {
            messageContainer.style.display = "none";
        }, 5000);
    }

    
    // Reset the scrollable preview window
    function resetPreviewWindow() {
        selectedFiles = [];
        photoPreviewList.innerHTML = "";
        togglePreviewVisibility();
    }

    // Upload a single file
    function uploadFile(file, description, fileRow, onSuccess, onFailure) {
        const updatedFileName = fileRow.querySelector(".file-name-details").value;

        const formData = new FormData();
        formData.append("photo", file);
        formData.append("description", description);
        formData.append("updatedFileName", updatedFileName); // Send updated name

        fetch("../php/logic/admin_upload.php", {
            method: "POST",
            body: formData,
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.success) {
                    onSuccess();
                } else {
                    onFailure(data.message);
                }
            })
            .catch((error) => {
                onFailure(error.message);
            });
    }

});
