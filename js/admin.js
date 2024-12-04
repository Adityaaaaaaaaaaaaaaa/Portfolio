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
            if (!selectedFiles.find((f) => f.name === file.name)) {
                selectedFiles.push(file);
                displayFile(file);
            }
        });
    });

    // Display a file in the preview list
    function displayFile(file) {
        const fileRow = document.createElement("div");
        fileRow.classList.add("photo-item");

        // Calculate file size in KB or MB
        const fileSize =
            file.size >= 1024 * 1024
                ? `${(file.size / (1024 * 1024)).toFixed(2)} MB`
                : `${(file.size / 1024).toFixed(2)} KB`;

        fileRow.innerHTML = `
            <img src="${URL.createObjectURL(file)}" alt="${file.name}" width="100">
            <p><strong>Name:</strong> <input type="text" value="${file.name}" class="file-name"></p>
            <p><strong>Size:</strong> ${fileSize}</p>
            <p><strong>Type:</strong> ${file.type || "Unknown"}</p>
            <p><strong>Last Modified:</strong> ${
                file.lastModifiedDate ? file.lastModifiedDate.toLocaleString() : "Unknown"
            }</p>
            <button class="upload-button action-button">Upload</button>
            <button class="remove-button action-button">Remove</button>
        `;

        // Handle remove button
        fileRow.querySelector(".remove-button").addEventListener("click", () => {
            selectedFiles = selectedFiles.filter((f) => f.name !== file.name);
            fileRow.remove();
        });

        photoPreviewList.appendChild(fileRow);
    }

    // Remove all files
    removeAllButton.addEventListener("click", () => {
        selectedFiles = [];
        photoPreviewList.innerHTML = "";
        photoPreviewContainer.classList.add("hidden");
    });

    // Upload all files (dummy path)
    uploadAllButton.addEventListener("click", () => {
        console.log("Dummy upload triggered for files:", selectedFiles);
        alert("Dummy upload completed.");
    });
});
