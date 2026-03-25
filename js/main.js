document.addEventListener('DOMContentLoaded', () => {
    loadHeader();
    loadFooter();
    initGreetings();
    initThreeJS();
});

function loadHeader() {
    const headerPlaceholder = document.getElementById('header-placeholder');
    if (headerPlaceholder) {
        const isPage = window.location.pathname.includes('/pages/');
        const path = isPage ? '../templates/header.html' : 'templates/header.html';
        
        fetch(path)
            .then(response => response.text())
            .then(data => {
                headerPlaceholder.innerHTML = data;
                setupAuthLinks(); // Setup login/logout links after header loads
            });
    }
}

function loadFooter() {
    const footerPlaceholder = document.getElementById('footer-placeholder');
    if (footerPlaceholder) {
        const isPage = window.location.pathname.includes('/pages/');
        const path = isPage ? '../templates/footer.html' : 'templates/footer.html';

        fetch(path)
            .then(response => response.text())
            .then(data => {
                footerPlaceholder.innerHTML = data;
                const yearSpan = document.getElementById('current-year');
                if (yearSpan) yearSpan.textContent = new Date().getFullYear();
            });
    }
}

function initGreetings() {
    const hour = new Date().getHours();
    let greeting = "Hello!";
    let phrase = "Welcome to my portfolio.";

    // Simple logic for now, can be replaced with Firestore fetch later
    if (hour < 12) {
        greeting = "Good Morning";
        phrase = "Start your day with some creativity.";
    } else if (hour < 18) {
        greeting = "Good Afternoon";
        phrase = "Hope you are having a productive day.";
    } else {
        greeting = "Good Evening";
        phrase = "Relax and explore my work.";
    }

    const greetingEl = document.querySelector('.greeting-text');
    const phraseEl = document.querySelector('.phrase-text');

    if (greetingEl) greetingEl.textContent = `${greeting}, Welcome to My Portfolio!`;
    if (phraseEl) phraseEl.textContent = phrase;
}

function setupAuthLinks() {
    firebase.auth().onAuthStateChanged(user => {
        const authLink = document.getElementById('auth-link');
        const adminLink = document.getElementById('admin-link');
        
        if (user) {
            // User is signed in
            if (authLink) {
                authLink.textContent = "Logout";
                authLink.href = "#";
                authLink.addEventListener('click', (e) => {
                    e.preventDefault();
                    firebase.auth().signOut().then(() => {
                        window.location.reload();
                    });
                });
            }
            if (adminLink) adminLink.style.display = 'inline-block';
        } else {
            // User is signed out
            if (authLink) {
                authLink.textContent = "Login";
                authLink.href = "pages/login.html";
            }
            if (adminLink) adminLink.style.display = 'none';
        }
    });
}

function initThreeJS() {
    const canvas = document.getElementById('bg-canvas');
    if (!canvas) return;

    // Basic Three.js Setup
    const scene = new THREE.Scene();
    const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
    const renderer = new THREE.WebGLRenderer({ canvas: canvas, alpha: true });
    
    renderer.setSize(window.innerWidth, window.innerHeight);
    renderer.setPixelRatio(window.devicePixelRatio);

    // Example: Add a simple particle system or mesh
    const geometry = new THREE.TorusGeometry(10, 3, 16, 100);
    const material = new THREE.MeshBasicMaterial({ color: 0x666666, wireframe: true });
    const torus = new THREE.Mesh(geometry, material);
    scene.add(torus);

    camera.position.z = 30;

    function animate() {
        requestAnimationFrame(animate);
        torus.rotation.x += 0.01;
        torus.rotation.y += 0.005;
        renderer.render(scene, camera);
    }

    animate();

    // Handle Resize
    window.addEventListener('resize', () => {
        camera.aspect = window.innerWidth / window.innerHeight;
        camera.updateProjectionMatrix();
        renderer.setSize(window.innerWidth, window.innerHeight);
    });
}
