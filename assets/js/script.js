document.addEventListener('DOMContentLoaded', () => {
    // Theme handling
    const savedTheme = localStorage.getItem('theme') || 'light';
    document.body.setAttribute('data-theme', savedTheme);

    // Initialize star background
    const canvas = document.createElement('canvas');
    canvas.className = 'stars';
    document.body.prepend(canvas);
    
    const ctx = canvas.getContext('2d');
    let particles = [];

    function resizeCanvas() {
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
    }

    function createParticles() {
        particles = [];
        const particleCount = Math.floor(canvas.width * canvas.height / 15000);
        
        for (let i = 0; i < particleCount; i++) {
            particles.push({
                x: Math.random() * canvas.width,
                y: Math.random() * canvas.height,
                radius: Math.random() * 1.5,
                dx: (Math.random() - 0.5) * 0.1,
                dy: (Math.random() - 0.5) * 0.1
            });
        }
    }

    function drawParticles() {
        ctx.fillStyle = document.body.getAttribute('data-theme') === 'dark' ? 'rgba(255,255,255,0.8)' : 'rgba(30,41,59,0.8)';
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        
        particles.forEach(particle => {
            ctx.beginPath();
            ctx.arc(particle.x, particle.y, particle.radius, 0, Math.PI * 2);
            ctx.fill();
            
            particle.x += particle.dx;
            particle.y += particle.dy;
            
            if (particle.x < 0 || particle.x > canvas.width) particle.dx *= -1;
            if (particle.y < 0 || particle.y > canvas.height) particle.dy *= -1;
        });
        
        requestAnimationFrame(drawParticles);
    }

    // Initial setup
    resizeCanvas();
    createParticles();
    drawParticles();
    
    window.addEventListener('resize', () => {
        resizeCanvas();
        createParticles();
    });

    // File input handling
    const fileInput = document.getElementById('fileInput');
    const fileNameDisplay = document.getElementById('fileName');
    
    if (fileInput && fileNameDisplay) {
        fileInput.addEventListener('change', (e) => {
            fileNameDisplay.textContent = e.target.files[0]?.name || 'No file chosen';
        });
    }

    // Copy to clipboard
    document.querySelector('.copy-code')?.addEventListener('click', async () => {
        try {
            await navigator.clipboard.writeText(document.querySelector('.download-code').textContent);
            alert('Code copied to clipboard!');
        } catch (err) {
            alert('Failed to copy code');
        }
    });
});

function toggleTheme() {
    const body = document.body;
    const theme = body.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
    body.setAttribute('data-theme', theme);
    localStorage.setItem('theme', theme);
    
    if (theme === 'dark') {
        confetti({
            particleCount: 100,
            spread: 70,
            origin: { y: 0.6 },
            colors: ['#2563eb', '#3b82f6', '#60a5fa']
        });
    }
}