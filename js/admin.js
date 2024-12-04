document.addEventListener("DOMContentLoaded", () => {
    const fileInput = document.getElementById("file-input");
    const nextButton = document.getElementById("next-button");
    const manageSection = document.getElementById("manage-section");
    const batchButtons = document.getElementById("batch-buttons");
    const uploadAllBtn = document.getElementById("upload-all");
    const removeAllBtn = document.getElementById("remove-all");
    const filesList = new Map(); // Store files for reference

    // Format file size
    const formatFileSize = (size) => {
        if (size > 1024 * 1024) return (size / (1024 * 1024)).toFixed(2) + " MB";
        if (size > 1024) return (size / 1024).toFixed(2) + " KB";
        return size + " bytes";
    };

    // Handle "Next" button click
    nextButton.addEventListener("click", () => {
        const files = Array.from(fileInput.files);
        if (!files.length) {
            alert("Please select at least one file.");
            return;
        }
        manageSection.innerHTML = ""; // Clear the section
        files.forEach((file, index) => {
            const fileId = `${file.name}-${index}`;
            if (filesList.has(fileId)) return;

            // Store file reference
            filesList.set(fileId, file);

            // Create file card
            const fileCard = document.createElement("div");
            fileCard.className = "photo-item";
            fileCard.id = fileId;

            const reader = new FileReader();
            reader.onload = (e) => {
                const metadata = `
                    <p><strong>Name:</strong> 
                        <input type="text" value="${file.name}" class="name-input">
                    </p>
                    <p><strong>Size:</strong> ${formatFileSize(file.size)}</p>
                    <p><strong>Type:</strong> ${file.type || "N/A"}</p>
                    <p><strong>Last Modified:</strong> ${file.lastModifiedDate ? file.lastModifiedDate.toLocaleString() : "N/A"}</p>
                `;
                fileCard.innerHTML = `
                    <img src="${e.target.result}" alt="${file.name}" width="100">
                    ${metadata}
                    <button class="upload-button">Upload</button>
                    <button class="remove-button">Remove</button>
                `;
                manageSection.appendChild(fileCard);
                batchButtons.style.display = "block";

                // Add event listeners for buttons
                fileCard.querySelector(".upload-button").addEventListener("click", () => handleUpload(fileId));
                fileCard.querySelector(".remove-button").addEventListener("click", () => handleRemove(fileId));
            };
            reader.readAsDataURL(file);
        });

        // GSAP animation for smooth appearance
        gsap.fromTo(".photo-item", { opacity: 0, y: 30 }, { opacity: 1, y: 0, stagger: 0.1, duration: 0.5 });
    });

    const handleUpload = (fileId) => {
        const file = filesList.get(fileId);
        if (!file) return;

        const fileCard = document.getElementById(fileId);
        const nameInput = fileCard.querySelector(".name-input");
        const fileName = nameInput.value;

        const formData = new FormData();
        formData.append("photo", file);
        formData.append("fileName", fileName);

        fetch("../php/logic/upload_file.php", {
            method: "POST",
            body: formData,
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.success) {
                    fileCard.querySelector(".upload-button").disabled = true;
                    alert("File uploaded successfully!");
                } else {
                    alert("Upload failed: " + data.message);
                }
            });
    };

    const handleRemove = (fileId) => {
        const fileCard = document.getElementById(fileId);
        fileCard.remove();
        filesList.delete(fileId);

        if (filesList.size === 0) batchButtons.style.display = "none";
    };

    uploadAllBtn.addEventListener("click", () => {
        filesList.forEach((_, fileId) => handleUpload(fileId));
    });

    removeAllBtn.addEventListener("click", () => {
        filesList.forEach((_, fileId) => handleRemove(fileId));
    });
});
