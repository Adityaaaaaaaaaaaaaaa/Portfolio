document.addEventListener('DOMContentLoaded', function() {
    const toggleBtn = document.getElementById('toggle-btn');
    const root = document.documentElement;
    const darkModeClass = 'dark-mode';
    
    // Check stored theme preference
    if (localStorage.getItem('darkMode') === 'true') {
        root.classList.add(darkModeClass);
    }

    // Toggle dark/light mode
    toggleBtn.addEventListener('click', () => {
        const isDarkMode = root.classList.toggle(darkModeClass);
        localStorage.setItem('darkMode', isDarkMode);
    });
});

document.getElementById("toggle-btn").addEventListener("click", (event) => {
    event.preventDefault(); // Prevents the link from navigating
});
