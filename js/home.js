// Register the ScrollTrigger plugin
gsap.registerPlugin(ScrollTrigger);

// Animation for the Hero Section
document.addEventListener('DOMContentLoaded', () => {
    // Smooth Hero Animations
    gsap.fromTo(
        ".hero h1",
        { x: -300, opacity: 0, rotation: 15 },
        { duration: 1.2, x: 0, opacity: 1, rotation: 0, ease: "back.out(1.7)", delay: 0.2 }
    );

    gsap.fromTo(
        ".hero p",
        { y: 300, opacity: 0 },
        { duration: 1.2, y: 0, opacity: 1, ease: "power4.out", delay: 0.5 }
    );

    gsap.fromTo(
        "#scroll-btn",
        { scale: 0.8, opacity: 0 },
        { duration: 1, scale: 1, opacity: 1, ease: "elastic.out(1, 0.3)", delay: 1 }
    );

    // Quick Links Hover Effects
    document.querySelectorAll('.quick-link').forEach(link => {
        link.addEventListener('mouseenter', () => {
            gsap.to(link, {
                scale: 1.3,
                rotationY: 15,
                rotationX: -15,
                boxShadow: "0px 10px 20px rgba(0, 0, 0, 0.3)",
                duration: 0.4,
                ease: "elastic.out(1, 0.5)"
            });
        });

        link.addEventListener('mouseleave', () => {
            gsap.to(link, {
                scale: 1,
                rotationY: 0,
                rotationX: 0,
                boxShadow: "none",
                duration: 0.4,
                ease: "power2.out"
            });
        });
    });

    // ScrollTrigger Animations
    gsap.utils.toArray('.section-title, .section-description').forEach(section => {
        gsap.fromTo(
            section,
            { y: 100, opacity: 0 },
            {
                y: 0,
                opacity: 1,
                duration: 1.5,
                ease: "power3.out",
                scrollTrigger: {
                    trigger: section,
                    start: "top 85%",
                    toggleActions: "play none none reverse"
                }
            }
        );
    });
});

let phrases = []; // Initialize an empty array for phrases

// Function to update the phrase every 5 seconds
function updatePhrase() {
    const timeIndex = Math.floor(Date.now() / 7500) % phrases.length;  // 5000 ms = 5 seconds
    const phraseElement = document.getElementById('dynamic-phrase');
    if (phraseElement && phrases.length > 0) {  // Check if the element exists and phrases array is not empty
        phraseElement.innerHTML = phrases[timeIndex];
    }
}

// Ensure the DOM is loaded before running the script
document.addEventListener('DOMContentLoaded', function() {
    // Fetch phrases from the JSON file
    fetch('config/home.json')
        .then(response => response.json())
        .then(data => {
            phrases = data.phrases || [];  // Load phrases from JSON
            updatePhrase();  // Update the phrase immediately on page load
            setInterval(updatePhrase, 7500);  // Update every 5 seconds
        })
        .catch(error => console.error(error));
});


// Function to scroll smoothly to the next section
function smoothScrollToSection() {
    const targetSection = document.getElementById('intro-section'); // The section you want to scroll to
    if (targetSection) {
        targetSection.scrollIntoView({
            behavior: 'smooth', // Enables smooth scrolling
            block: 'start' // Align the top of the target section to the top of the viewport
        });
    }
}

// Event listener for the "Explore More" button
document.getElementById('scroll-btn').addEventListener('click', smoothScrollToSection);

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
        popupImage.src = "";  // Clear the image source
        popupDescription.textContent = "";  // Clear the description    
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

let lightImages = [];
let darkImages = [];
let lightImageIndices = [];
let darkImageIndices = [];

// Function to shuffle an array
function shuffleArray(array) {
    for (let i = array.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [array[i], array[j]] = [array[j], array[i]]; // Swap elements
    }
}

// Function to get the next unique image from the array
function getNextUniqueImage(imagesArray, indicesArray) {
    if (indicesArray.length === 0) {
        // If all images have been used, reshuffle the indices array
        indicesArray.push(...Array(imagesArray.length).keys());  // Refill with indices
        shuffleArray(indicesArray);  // Shuffle the indices array
    }
    const index = indicesArray.pop();  // Get the last index from the shuffled array
    return imagesArray[index];        // Get the image at that index
}

// Function to set the theme image
function setThemeImage() {
    const theme = localStorage.getItem('theme') || 'light'; // Default to 'light' if no theme is stored
    const imageContainer = document.getElementById('theme-image');

    let imagePath;
    if (theme === 'dark') {
        imagePath = getNextUniqueImage(darkImages, darkImageIndices);
    } else {
        imagePath = getNextUniqueImage(lightImages, lightImageIndices);
    }

    // Set the background image of the hero div
    imageContainer.style.backgroundImage = `url(${imagePath})`;
}

// Load images from JSON and initialize the arrays
fetch('config//home.json')  // Replace 'path/to/config.json' with the actual path to your JSON file
    .then(response => response.json())
    .then(data => {
        const allImages = data.images;

        // Split the images into light and dark images
        lightImages = allImages.filter((_, index) => index % 2 === 0); // Even indices for light images
        darkImages = allImages.filter((_, index) => index % 2 !== 0); // Odd indices for dark images

        // Initialize indices arrays
        lightImageIndices = [...Array(lightImages.length).keys()];
        darkImageIndices = [...Array(darkImages.length).keys()];

        // Shuffle indices initially
        shuffleArray(lightImageIndices);
        shuffleArray(darkImageIndices);

        // Set the initial theme image
        setThemeImage();
    })
    .catch(error => console.error("Error loading JSON file:", error));

// Handle theme toggle
document.getElementById('toggle-btn').addEventListener('click', () => {
    let currentTheme = localStorage.getItem('theme');
    currentTheme = (currentTheme === 'dark') ? 'light' : 'dark';

    localStorage.setItem('theme', currentTheme); // Save the theme to local storage
    setThemeImage(); // Set the new theme image
});

// Call setThemeImage on page load to set the initial image
window.onload = () => {
    // The fetch will handle the logic when JSON is loaded
};
