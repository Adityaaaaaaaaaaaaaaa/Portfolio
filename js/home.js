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

// Function to update the phrase every 5 seconds
function updatePhrase() {
    const timeIndex = Math.floor(Date.now() / 5000) % phrases.length;  // 5000 ms = 5 seconds
    const phraseElement = document.getElementById('dynamic-phrase');
    if (phraseElement) {  // Check if the element exists
        phraseElement.innerHTML = phrases[timeIndex];
    }
}

// Ensure the DOM is loaded before running the script
document.addEventListener('DOMContentLoaded', function() {
    // Update the phrase immediately and then every 5 seconds
    updatePhrase();  // Run immediately on page load
    setInterval(updatePhrase, 7500);  // Update every 7.5 seconds
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

// Arrays of images for light and dark themes
const lightImages = [
    'assets/images-home/img1.png', 
    'assets/images-home/img2.png',
    'assets/images-home/img3.png', 
    'assets/images-home/img4.png',
    'assets/images-home/img5.png',
    'assets/images-home/img6.png',
    'assets/images-home/img7.png',
    'assets/images-home/img8.png',
    'assets/images-home/img9.png',
    'assets/images-home/img10.png',
    'assets/images-home/img11.png',
    'assets/images-home/img12.png',
    'assets/images-home/img13.png',
    'assets/images-home/img14.png',
    'assets/images-home/img15.png',
    'assets/images-home/img16.png',
    'assets/images-home/img17.png'
];

const darkImages = [
    'assets/images-home/img1.png',
    'assets/images-home/img2.png',
    'assets/images-home/img3.png',
    'assets/images-home/img4.png',
    'assets/images-home/img5.png',
    'assets/images-home/img6.png',
    'assets/images-home/img7.png',
    'assets/images-home/img8.png',
    'assets/images-home/img9.png',
    'assets/images-home/img10.png',
    'assets/images-home/img11.png',
    'assets/images-home/img12.png',
    'assets/images-home/img13.png',
    'assets/images-home/img14.png',
    'assets/images-home/img15.png',
    'assets/images-home/img16.png',
    'assets/images-home/img17.png'
];

// Function to randomly select an image from an array
function getRandomImage(imagesArray) {
    const randomIndex = Math.floor(Math.random() * imagesArray.length);
    return imagesArray[randomIndex];
}

// Set the background image based on the current theme
function setThemeImage() {
    const theme = localStorage.getItem('theme') || 'light'; // Default to 'light' if no theme is stored
    const imageContainer = document.getElementById('theme-image');

    // Remove any existing image element if present
    const existingImage = imageContainer.querySelector('img');
    if (existingImage) {
        existingImage.remove();
    }

    // Create a new image element
    const imagePath = theme === 'dark' ? getRandomImage(darkImages) : getRandomImage(lightImages);
    const img = document.createElement('img');
    img.src = imagePath;
    img.alt = "Hero Image";  // Optional: Add alt text for accessibility

    // Append the new image element to the hero section
    imageContainer.appendChild(img);
}

// Handle theme toggle
document.getElementById('toggle-btn').addEventListener('click', () => {
    let currentTheme = localStorage.getItem('theme');
    currentTheme = currentTheme === 'dark' ? 'light' : 'dark';
    localStorage.setItem('theme', currentTheme); // Save the theme to local storage
    setThemeImage(); // Set the new theme image
});

// Call setThemeImage on page load to set the initial image
window.onload = () => {
    setThemeImage();
};
