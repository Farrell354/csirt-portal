/**
 * hero-interactive.js
 * Efek untuk hero section JatimProv-CSIRT:
 * 1. Tilt 3D + ekstrusi pada judul "JatimProv-CSIRT" (scoped ke #hero-title-region)
 * 2. Background partikel interaktif yang mengisi seluruh <header> hero
 */
(function () {
    document.addEventListener('DOMContentLoaded', () => {
        const heroHeader = document.querySelector('header');
        const titleRegion = document.getElementById('hero-title-region');
        const title = document.getElementById('hero-title');
        const underline = document.getElementById('hero-title-underline');
        const canvas = document.getElementById('hero-particles-canvas');

        if (!heroHeader || !titleRegion || !title || !canvas) return;

        const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

        initTitleTilt({ titleRegion, title, underline });

        if (!prefersReducedMotion) {
            initParticleBackground({ heroHeader, canvas });
        }
    });

    // ---------------------------------------------------------------
    // Tilt 3D + ekstrusi teks judul
    // ---------------------------------------------------------------
    function initTitleTilt({ titleRegion, title, underline }) {
        const MAX_TILT = 10;
        const LAYERS = 16;

        function buildExtrusion(dx, dy) {
            const shadows = [`0 0 22px rgba(34,211,238,0.55)`];
            for (let i = 1; i <= LAYERS; i++) {
                const t = i / LAYERS;
                const r = Math.round(56 + (10 - 56) * t);
                const g = Math.round(189 + (35 - 189) * t);
                const b = Math.round(248 + (66 - 248) * t);
                const offsetX = (dx * 16 * t).toFixed(2);
                const offsetY = (dy * 16 * t + i * 0.55).toFixed(2);
                shadows.push(`${offsetX}px ${offsetY}px 0 rgba(${r},${g},${b},0.92)`);
            }
            shadows.push(`${(dx * 20).toFixed(1)}px ${(dy * 20 + 20).toFixed(1)}px 26px rgba(0,0,0,0.5)`);
            return shadows.join(', ');
        }

        titleRegion.addEventListener('mousemove', (e) => {
            const rect = titleRegion.getBoundingClientRect();
            const dxNorm = (e.clientX - rect.left) / rect.width - 0.5;
            const dyNorm = (e.clientY - rect.top) / rect.height - 0.5;
            title.style.transform = `rotateX(${-dyNorm * MAX_TILT * 2}deg) rotateY(${dxNorm * MAX_TILT * 2}deg) scale(1.03)`;
            title.style.textShadow = buildExtrusion(dxNorm, dyNorm);
        });

        titleRegion.addEventListener('mouseenter', () => {
            underline.style.width = '66%';
        });

        titleRegion.addEventListener('mouseleave', () => {
            title.style.transform = 'rotateX(0deg) rotateY(0deg) scale(1)';
            title.style.textShadow = buildExtrusion(0.12, 0.12);
            underline.style.width = '0%';
        });

        title.style.textShadow = buildExtrusion(0.12, 0.12);
    }

    // ---------------------------------------------------------------
    // Background partikel interaktif di seluruh hero
    // ---------------------------------------------------------------
    function initParticleBackground({ heroHeader, canvas }) {
        const ctx = canvas.getContext('2d');
        const DPR = Math.min(window.devicePixelRatio || 1, 2);
        const LINK_DIST = 110;
        const MOUSE_LINK_DIST = 160;
        const MOUSE_PUSH_DIST = 90;

        let width, height, particles = [];
        let mouseInHero = false;
        let mouseX = 0, mouseY = 0;
        let resizeTimeout;

        function particleCountForArea(w, h) {
            const density = (w * h) / 14000;
            return Math.max(60, Math.min(160, Math.round(density)));
        }

        function sizeCanvas() {
            const rect = heroHeader.getBoundingClientRect();
            width = rect.width;
            height = rect.height;
            canvas.width = width * DPR;
            canvas.height = height * DPR;
            canvas.style.width = width + 'px';
            canvas.style.height = height + 'px';
            ctx.setTransform(DPR, 0, 0, DPR, 0, 0);
        }

        function initParticles() {
            const count = particleCountForArea(width, height);
            particles = Array.from({ length: count }, () => ({
                x: Math.random() * width,
                y: Math.random() * height,
                vx: (Math.random() - 0.5) * 0.25,
                vy: (Math.random() - 0.5) * 0.25,
            }));
        }

        function step() {
            ctx.clearRect(0, 0, width, height);

            particles.forEach((p) => {
                p.x += p.vx;
                p.y += p.vy;
                if (p.x < 0 || p.x > width) p.vx *= -1;
                if (p.y < 0 || p.y > height) p.vy *= -1;

                if (mouseInHero) {
                    const dx = p.x - mouseX;
                    const dy = p.y - mouseY;
                    const dist = Math.hypot(dx, dy);
                    if (dist < MOUSE_PUSH_DIST && dist > 0.01) {
                        const force = (MOUSE_PUSH_DIST - dist) / MOUSE_PUSH_DIST;
                        p.x += (dx / dist) * force * 1.4;
                        p.y += (dy / dist) * force * 1.4;
                    }
                }
            });

            for (let i = 0; i < particles.length; i++) {
                for (let j = i + 1; j < particles.length; j++) {
                    const a = particles[i], b = particles[j];
                    const dist = Math.hypot(a.x - b.x, a.y - b.y);
                    if (dist < LINK_DIST) {
                        ctx.strokeStyle = `rgba(34, 211, 238, ${0.12 * (1 - dist / LINK_DIST)})`;
                        ctx.lineWidth = 1;
                        ctx.beginPath();
                        ctx.moveTo(a.x, a.y);
                        ctx.lineTo(b.x, b.y);
                        ctx.stroke();
                    }
                }
                if (mouseInHero) {
                    const dist = Math.hypot(particles[i].x - mouseX, particles[i].y - mouseY);
                    if (dist < MOUSE_LINK_DIST) {
                        ctx.strokeStyle = `rgba(245, 158, 11, ${0.28 * (1 - dist / MOUSE_LINK_DIST)})`;
                        ctx.lineWidth = 1;
                        ctx.beginPath();
                        ctx.moveTo(particles[i].x, particles[i].y);
                        ctx.lineTo(mouseX, mouseY);
                        ctx.stroke();
                    }
                }
            }

            particles.forEach((p) => {
                ctx.fillStyle = 'rgba(103, 232, 249, 0.7)';
                ctx.beginPath();
                ctx.arc(p.x, p.y, 1.4, 0, Math.PI * 2);
                ctx.fill();
            });

            requestAnimationFrame(step);
        }

        heroHeader.addEventListener('mousemove', (e) => {
            const rect = heroHeader.getBoundingClientRect();
            mouseX = e.clientX - rect.left;
            mouseY = e.clientY - rect.top;
        });
        heroHeader.addEventListener('mouseenter', () => { mouseInHero = true; });
        heroHeader.addEventListener('mouseleave', () => { mouseInHero = false; });

        sizeCanvas();
        initParticles();
        requestAnimationFrame(step);

        window.addEventListener('resize', () => {
            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(() => {
                sizeCanvas();
                initParticles();
            }, 200);
        });
    }
})();