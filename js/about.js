// Register the ScrollTrigger plugin
gsap.registerPlugin(ScrollTrigger);

document.addEventListener("DOMContentLoaded", () => {
    // Timeline Item Animations (Fade-in, Slide-in from left)
    const timelineItems = document.querySelectorAll('.timeline-item');
    gsap.fromTo(
        timelineItems,
        { opacity: 0, x: -200 },
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
                rotation: 5,
                boxShadow: "0px 10px 20px rgba(0, 0, 0, 0.2)",
                ease: "power3.out",
                duration: 0.3,
                y: -10,  // Adds a little lift effect
                backgroundColor: "#f8f8f8", // Lightens the background on hover
            });
        });

        item.addEventListener('mouseleave', () => {
            gsap.to(item, {
                scale: 1,
                rotation: 0,
                boxShadow: "none",
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
                onComplete: () => {
                    alert(item.querySelector('p').textContent); // For demo: show the text of the clicked item
                }
            });
        });
    });

    // Optional: Additional Scroll Animation for Active Timeline Item
    timelineItems.forEach((item, index) => {
        ScrollTrigger.create({
            trigger: item,
            start: "top 80%",
            onEnter: () => gsap.to(item, { opacity: 1, scale: 1.1, duration: 0.5 }),
            onLeave: () => gsap.to(item, { opacity: 0.5, scale: 1, duration: 0.3 }),
        });
    });
});
