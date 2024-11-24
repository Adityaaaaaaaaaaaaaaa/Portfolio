// Register the ScrollTrigger plugin
gsap.registerPlugin(ScrollTrigger);

document.addEventListener('DOMContentLoaded', () => {
    // Hero Section with "Flying In" Effects
    gsap.fromTo(
        ".hero h1",
        { x: -200, opacity: 0, rotation: 10 }, // Initial styles
        { 
            duration: 1.5, 
            x: 0, 
            opacity: 1, 
            rotation: 0, // Final styles
            ease: "power4.out", 
            delay: 0.3 
        }
    );

    gsap.fromTo(
        ".hero p",
        { y: 200, opacity: 0 }, // Initial styles
        { 
            duration: 1.5, 
            y: 0, 
            opacity: 1, 
            ease: "power4.out", 
            delay: 0.6 
        }
    );

    gsap.fromTo(
        "#scroll-btn",
        { scale: 0.8, opacity: 0 }, // Initial styles
        { 
            duration: 1.5, 
            scale: 1, 
            opacity: 1, 
            ease: "elastic.out(1, 0.5)", 
            delay: 1 
        }
    );

    // Cool Hover Animation with 3D Tilt Effect
    const quickLinks = document.querySelectorAll('.quick-link');
    quickLinks.forEach(link => {
        link.addEventListener('mouseenter', () => {
            gsap.to(link, {
                scale: 1.2,
                rotationY: 10,
                rotationX: -10,
                boxShadow: "0px 5px 15px rgba(0, 0, 0, 0.2)",
                duration: 0.3,
                ease: "power2.out",
                transformOrigin: "center center"
            });
        });

        link.addEventListener('mouseleave', () => {
            gsap.to(link, {
                scale: 1,
                rotationY: 0,
                rotationX: 0,
                boxShadow: "none",
                duration: 0.3,
                ease: "power2.out"
            });
        });
    });

    // Staggered Animation for Quick Links with Perspective Effect
    gsap.fromTo(
        ".quick-link",
        { y: 50, opacity: 0 }, // Initial styles
        { 
            duration: 1, 
            y: 0, 
            opacity: 1, 
            stagger: 0.2, 
            ease: "expo.out", 
            delay: 2.2 
        }
    );

    // Scroll Animations with Parallax Zoom Effect
    const sections = document.querySelectorAll('.section-title, .section-description');
    sections.forEach(section => {
        gsap.fromTo(
            section,
            { opacity: 0, y: 100, scale: 0.95 }, // Initial styles
            { 
                opacity: 1, 
                y: 0, 
                scale: 1, // Final styles
                duration: 1.5, 
                ease: "expo.out",
                scrollTrigger: {
                    trigger: section,
                    start: "top 80%",
                    toggleActions: "play none none reverse"
                }
            }
        );
    });

    // "Explore More" Button Scroll Animation with "Zoom In"
    const scrollButton = document.getElementById('scroll-btn');
    scrollButton.addEventListener('click', () => {
        gsap.to(window, {
            duration: 2,
            scrollTo: { y: "#intro-section", offsetY: 70 },
            ease: "power2.out"
        });
    });

    // Hero Image Zoom-In Effect
    gsap.fromTo(
        ".hero",
        { scale: 1.05, opacity: 0.8 }, // Initial styles
        { 
            scale: 1, 
            opacity: 1, 
            duration: 2, 
            ease: "expo.out", 
            delay: 0.2 
        }
    );

    // Scroll-In Animation for Sections with "Parallax"
    gsap.fromTo(
        ".intro, .quick-links, footer",
        { y: 100, opacity: 0 }, // Initial styles
        { 
            scrollTrigger: {
                trigger: ".intro",
                start: "top 80%",
                end: "bottom 40%",
                scrub: 1,
                markers: false
            },
            y: 0, 
            opacity: 1, 
            ease: "expo.out", 
            duration: 1.5 
        }
    );
});
