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
