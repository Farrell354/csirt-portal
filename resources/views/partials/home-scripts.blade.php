    <!-- ═══════════════════════════════════════════════════════
         SCRIPTS
    ═══════════════════════════════════════════════════════ -->
    <script>
    (() => {
        const isTouchDevice = window.matchMedia('(hover: none)').matches;

        /* ─── Cursor Glow (desktop only) ─── */
        if (!isTouchDevice) {
            const glow = document.getElementById('cursor-glow');
            document.addEventListener('mousemove', e => {
                glow.style.left = e.clientX + 'px';
                glow.style.top  = e.clientY + 'px';
            }, { passive: true });
        }

        /* ─── Neural-Net Canvas (desktop only) ─── */
        if (!isTouchDevice) {
            const canvas = document.getElementById('neural-canvas');
            const ctx    = canvas.getContext('2d');
            let W, H, particles;
            let mouse = { x: -9999, y: -9999 };
            const COUNT      = 70;
            const MAX_DIST   = 150;
            const MOUSE_DIST = 180;

            const resize = () => {
                W = canvas.width  = canvas.offsetWidth;
                H = canvas.height = canvas.offsetHeight;
            };

            class Particle {
                constructor() { this.reset(true); }
                reset(init = false) {
                    this.x  = Math.random() * W;
                    this.y  = Math.random() * H;
                    this.vx = (Math.random() - 0.5) * 0.45;
                    this.vy = (Math.random() - 0.5) * 0.45;
                    this.r  = Math.random() * 1.5 + 0.5;
                }
                update() {
                    const dx = this.x - mouse.x;
                    const dy = this.y - mouse.y;
                    const d  = Math.sqrt(dx * dx + dy * dy);
                    if (d < MOUSE_DIST && d > 0) {
                        const force = (MOUSE_DIST - d) / MOUSE_DIST;
                        this.vx += (dx / d) * force * 0.9;
                        this.vy += (dy / d) * force * 0.9;
                    }
                    const speed = Math.sqrt(this.vx * this.vx + this.vy * this.vy);
                    if (speed > 2.5) { this.vx = (this.vx / speed) * 2.5; this.vy = (this.vy / speed) * 2.5; }
                    this.vx *= 0.98;
                    this.vy *= 0.98;
                    this.x += this.vx;
                    this.y += this.vy;
                    if (this.x < -10) this.x = W + 10;
                    if (this.x > W + 10) this.x = -10;
                    if (this.y < -10) this.y = H + 10;
                    if (this.y > H + 10) this.y = -10;
                }
                draw() {
                    ctx.beginPath();
                    ctx.arc(this.x, this.y, this.r, 0, Math.PI * 2);
                    ctx.fillStyle = 'rgba(6,182,212,0.75)';
                    ctx.fill();
                }
            }

            const init = () => {
                resize();
                particles = Array.from({ length: COUNT }, () => new Particle());
            };

            const drawLines = () => {
                for (let i = 0; i < particles.length; i++) {
                    for (let j = i + 1; j < particles.length; j++) {
                        const a = particles[i], b = particles[j];
                        const dx = a.x - b.x, dy = a.y - b.y;
                        const dist = Math.sqrt(dx * dx + dy * dy);
                        if (dist < MAX_DIST) {
                            const alpha = (1 - dist / MAX_DIST) * 0.3;
                            ctx.beginPath();
                            ctx.strokeStyle = `rgba(6,182,212,${alpha})`;
                            ctx.lineWidth = 0.7;
                            ctx.moveTo(a.x, a.y);
                            ctx.lineTo(b.x, b.y);
                            ctx.stroke();
                        }
                    }
                }
            };

            const loop = () => {
                ctx.clearRect(0, 0, W, H);
                particles.forEach(p => { p.update(); p.draw(); });
                drawLines();
                requestAnimationFrame(loop);
            };

            const header = canvas.closest('header');
            header.addEventListener('mousemove', e => {
                const rect = canvas.getBoundingClientRect();
                mouse.x = e.clientX - rect.left;
                mouse.y = e.clientY - rect.top;
            }, { passive: true });
            header.addEventListener('mouseleave', () => { mouse.x = -9999; mouse.y = -9999; });

            let resizeTimer;
            window.addEventListener('resize', () => {
                clearTimeout(resizeTimer);
                resizeTimer = setTimeout(resize, 100);
            }, { passive: true });

            init();
            loop();
        }

        /* ─── Card Magnetic Tilt (desktop only) ─── */
        if (!isTouchDevice) {
            document.querySelectorAll('.card-tilt').forEach(card => {
                card.addEventListener('mousemove', e => {
                    const rect = card.getBoundingClientRect();
                    const cx   = rect.left + rect.width / 2;
                    const cy   = rect.top  + rect.height / 2;
                    const dx   = (e.clientX - cx) / (rect.width / 2);
                    const dy   = (e.clientY - cy) / (rect.height / 2);
                    card.style.transform  = `perspective(800px) rotateX(${-dy * 3}deg) rotateY(${dx * 3}deg) translateY(-4px)`;
                    card.style.boxShadow  = `${-dx * 6}px ${dy * 6}px 40px rgba(6,182,212,0.07)`;
                }, { passive: true });
                card.addEventListener('mouseleave', () => {
                    card.style.transform = '';
                    card.style.boxShadow = '';
                });
            });
        }

        /* ─── Scroll Reveal ─── */
        const ro = new IntersectionObserver((entries, obs) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-fade-in-up');
                    entry.target.style.opacity = '1';
                    obs.unobserve(entry.target);
                }
            });
        }, { threshold: 0.08 });

        document.querySelectorAll('.reveal-on-scroll').forEach(el => {
            el.style.opacity = '0';
            ro.observe(el);
        });

        /* ─── Hero Title Hacker Scramble & 3D Tilt (desktop only) ─── */
        if (!isTouchDevice) {
            const letters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+-=[]{}|;':,./<>?";
            
            document.querySelectorAll('.hacker-text').forEach(element => {
                element.addEventListener('mouseover', event => {
                    let iterations = 0;
                    const target = event.target;
                    const originalText = target.dataset.text;
                    
                    if(target.dataset.animating === "true") return;
                    target.dataset.animating = "true";
                    
                    clearInterval(target.interval);
                    
                    target.interval = setInterval(() => {
                        target.innerText = originalText.split("")
                            .map((letter, index) => {
                                if(index < iterations) {
                                    return originalText[index];
                                }
                                return letters[Math.floor(Math.random() * letters.length)]
                            })
                            .join("");
                        
                        if(iterations >= originalText.length) {
                            clearInterval(target.interval);
                            target.dataset.animating = "false";
                        }
                        
                        iterations += 1 / 3;
                    }, 30);
                });
            });

            const titleContainer = document.querySelector('.hero-title-container');
            if(titleContainer) {
                titleContainer.addEventListener('mousemove', (e) => {
                    const rect = titleContainer.getBoundingClientRect();
                    const x = e.clientX - rect.left;
                    const y = e.clientY - rect.top;
                    
                    const xPct = (x / rect.width - 0.5) * 20; 
                    const yPct = (y / rect.height - 0.5) * -20;
                    
                    titleContainer.style.transform = `perspective(1000px) rotateX(${yPct}deg) rotateY(${xPct}deg) scale(1.02)`;
                }, { passive: true });
                titleContainer.addEventListener('mouseleave', () => {
                    titleContainer.style.transform = `perspective(1000px) rotateX(0) rotateY(0) scale(1)`;
                });
            }
        }
    })();
    </script>
