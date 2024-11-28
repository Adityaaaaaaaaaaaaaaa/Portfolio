// Register the ScrollTrigger plugin
gsap.registerPlugin(ScrollTrigger);

document.addEventListener("DOMContentLoaded", () => {
    // Timeline Item Animations (Fade-in, Slide-in from left)
    const timelineItems = document.querySelectorAll('.timeline-item');
    gsap.fromTo(
        timelineItems,
        { opacity: 0, x: 0 },
        {
            opacity: 1,
            x: 0,
            stagger: 0.2, // Stagger the animation of each timeline item
            duration: 1.2,
            ease: "power4.out",
            scrollTrigger: {
                trigger: ".timeline-section", // Trigger when the timeline section enters the viewport
                start: "top 85%", // Start when the top of the section hits 85% of the viewport
                toggleActions: "play none none reverse", // Play the animation when entering, and reverse on leaving
            },
        }
    );

    // Hero Section Animations
    gsap.fromTo(
        ".about-hero h1",
        { x: -300, opacity: 0, rotation: 15 },
        { duration: 1.2, x: 0, opacity: 1, rotation: 0, ease: "back.out(1.7)", delay: 0.2 }
    );

    gsap.fromTo(
        ".about-hero p",
        { y: 300, opacity: 0 },
        { duration: 1.2, y: 0, opacity: 1, ease: "power4.out", delay: 0.5 }
    );

    // ScrollTrigger Animations for Other Sections
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

    // Hover Effects for Timeline Items (Scale, Rotate, Shadow)
    timelineItems.forEach(item => {
        item.addEventListener('mouseenter', () => {
            gsap.to(item, {
                scale: 1.05,
                rotation: 2,
                ease: "power3.out",
                duration: 0.3,
                y: -10,  // Adds a little lift effect
                backgroundColor: "tranparent", // Lightens the background on hover
            });
        });

        item.addEventListener('mouseleave', () => {
            gsap.to(item, {
                scale: 1,
                rotation: 0,
                ease: "power3.inOut",
                duration: 0.3,
                y: 0,
                backgroundColor: "transparent", // Reverts to original color
            });
        });

        // Click Effect (Zoom-in and Display Title)
        item.addEventListener('click', () => {
            gsap.to(item, {
                scale: 1.1,
                duration: 0.4,
                ease: "elastic.out(1, 0.5)",
            });
        });
    });
});

document.addEventListener("DOMContentLoaded", () => {
    const quoteElement = document.getElementById("quote");
    const authorElement = document.getElementById("author");
    const categorySelector = document.getElementById("category-selector");
    const fetchQuoteBtn = document.getElementById("fetch-quote-btn");

    const API_KEY = "ZMGFLGWxaiBrhjvWCtC+FQ==mnWI91G5I8lKS4fw"; // Replace with your API key
    const API_URL = "https://api.api-ninjas.com/v1/quotes";

    let autoRefreshTimer; // Variable to hold the timer

    // Load categories from JSON
    fetch("/Portfolio/config/about.json")
        .then((response) => response.json())
        .then((data) => {
            const categories = data.categories;
            categories.forEach((category) => {
                const option = document.createElement("option");
                option.value = category;
                option.textContent = category.charAt(0).toUpperCase() + category.slice(1);
                categorySelector.appendChild(option);
            });
        })
        .catch((error) => console.error("Error loading categories:", error));

    // Fetch and display quote
    const fetchQuote = (category = "") => {
        const url = category ? `${API_URL}?category=${category}` : API_URL;
        fetch(url, {
            method: "GET",
            headers: {
                "X-Api-Key": API_KEY,
                "Content-Type": "application/json",
            },
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.length > 0) {
                    const quote = data[0];
                    quoteElement.textContent = `"${quote.quote}"`;
                    authorElement.textContent = `- ${quote.author}`;
                } else {
                    quoteElement.textContent = "No quote available for this category.";
                    authorElement.textContent = "";
                }
                resetAutoRefresh(); // Reset the auto-refresh timer whenever a new quote is fetched
            })
            .catch((error) => {
                console.error("Error fetching quote:", error);
                quoteElement.textContent = "Failed to fetch a quote.";
                authorElement.textContent = "";
            });
    };

    // Reset the auto-refresh timer
    const resetAutoRefresh = () => {
        clearTimeout(autoRefreshTimer); // Clear the previous timer
        autoRefreshTimer = setTimeout(() => {
            const selectedCategory = categorySelector.value;
            fetchQuote(selectedCategory); // Fetch a new quote after 30 seconds
        }, 30000);
    };

    // Fetch quote on button click
    fetchQuoteBtn.addEventListener("click", () => {
        const selectedCategory = categorySelector.value;
        fetchQuote(selectedCategory);
    });

    // Initial random quote
    fetchQuote();
});
