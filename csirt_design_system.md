## Design System: JatimProv-CSIRT

### Pattern
- **Name:** Real-Time / Operations Landing
- **Conversion Focus:** Offer a demo or sandbox and show trust signals. Label telemetry as live only when backed by a current source, with update time and stale state. Provide pause/hide or update-frequency controls for tickers and previews, stop offscreen/hidden work, support keyboard controls, and render a static final snapshot under reduced motion.
- **CTA Placement:** Primary CTA in nav + After metrics
- **Color Strategy:** Dark or neutral. Status colors (green/amber/red). Data-dense but scannable.
- **Sections:** Hero (product + live preview or status) > Key metrics/indicators > How it works > CTA (Start trial / Contact)

### Style
- **Name:** Cyberpunk UI
- **Mode Support:** Light not-recommended | Dark supported
- **Keywords:** Neon, dark mode, terminal, HUD, sci-fi, glitch, dystopian, futuristic, matrix, tech noir
- **Best For:** Gaming platforms, tech products, crypto apps, sci-fi applications, developer tools, entertainment
- **Performance:** cost:moderate|drivers:animation,blur | **Accessibility:** risk:low|requires:contrast-text-4.5,keyboard,visible-focus,reduced-motion

### Colors
| Role | Hex | CSS Variable |
|------|-----|--------------|
| Primary | `#00FF41` | `--color-primary` |
| On Primary | `#0F172A` | `--color-on-primary` |
| Secondary | `#0D0D0D` | `--color-secondary` |
| On Secondary | `#FFFFFF` | `--color-on-secondary` |
| Accent/CTA | `#FF3333` | `--color-accent` |
| On Accent/CTA | `#000000` | `--color-on-accent` |
| Background | `#000000` | `--color-background` |
| Foreground | `#E0E0E0` | `--color-foreground` |
| Card | `#0C130E` | `--color-card` |
| Card Foreground | `#E0E0E0` | `--color-card-foreground` |
| Muted | `#181818` | `--color-muted` |
| Muted Foreground | `#94A3B8` | `--color-muted-foreground` |
| Border | `#1F1F1F` | `--color-border` |
| Destructive | `#EF4444` | `--color-destructive` |
| On Destructive | `#000000` | `--color-on-destructive` |
| Ring | `#00FF41` | `--color-ring` |

*Notes: Matrix green + alert red*

### Typography
- **Heading:** Inter
- **Body:** Inter
- **Mood:** flat, clean, system, bold, geometric, cross-platform, icon, poster, minimal, functional, responsive
- **Best For:** Cross-platform apps, dashboards, system UI, onboarding, marketing pages, informational apps, icon-heavy interfaces
- **Google Fonts:** https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap
- **CSS Import:**
```css
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap');
```

### Key Effects
Neon glow (text-shadow), glitch animations (skew/offset), scanlines (::before overlay), terminal fonts

### Avoid (Anti-patterns)
- Light mode
- Poor data viz

### Pre-Delivery Checklist
- [ ] No emojis as icons (use SVG: Heroicons/Lucide)
- [ ] cursor-pointer on all clickable elements
- [ ] Hover states with smooth transitions (150-300ms)
- [ ] Light mode: text contrast 4.5:1 minimum
- [ ] Focus states visible for keyboard nav
- [ ] prefers-reduced-motion respected
- [ ] Responsive: 375px, 768px, 1024px, 1440px

