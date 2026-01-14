<?php
/*
Template Name: Big City Landing (Full Bleed)
*/
defined('ABSPATH') || exit;

/**
 * IMPORTANT:
 * We keep WordPress in control of <html>, <head>, <body>.
 * This avoids conflicts with themes/plugins and keeps the site stable.
 */
get_header();
?>

<style>
  /* ===============================
     HARD RESET — kill boxed layout
     =============================== */
  html, body { height: 100%; width: 100%; margin: 0 !important; padding: 0 !important; }
  body { background: #0a0e27; }

  /* Remove theme wrappers / constraints */
  #page, #content, .site, .site-content, .content-area, .container, .wp-site-blocks,
  .entry-content, .wp-block-group, .wp-block-post-content, main, .site-main, .wp-block-template-part {
    max-width: none !important;
    width: 100% !important;
    margin: 0 !important;
    padding: 0 !important;
  }

  /* If theme adds padding to body or main */
  body, .site, .site-content, main { padding: 0 !important; }

  /* ===============================
     YOUR ORIGINAL CSS (kept)
     =============================== */
  :root{
    --bg: #0a0e27;
    --bg-secondary: #111827;
    --deep: #1a1f3a;
    --accent: #06b6d4;
    --accent-secondary: #8b5cf6;
    --accent-tertiary: #3b82f6;
    --glow: rgba(6,182,212,0.5);
    --glow-purple: rgba(139,92,246,0.4);
    --video-opacity: 0.90;
    --fx-opacity: 0.36;
    --glass-bg: rgba(17,24,39,0.6);
    --glass-border: rgba(6,182,212,0.15);
    --glass-highlight: rgba(255,255,255,0.05);
    --text: rgba(255,255,255,0.98);
    --text-secondary: rgba(255,255,255,0.85);
    --text-muted: rgba(255,255,255,0.65);
    --text-shadow: 0 2px 20px rgba(0,0,0,0.7);
    --shadow-sm: 0 4px 12px rgba(0,0,0,0.3);
    --shadow-md: 0 10px 40px rgba(0,0,0,0.4);
    --shadow-lg: 0 20px 60px rgba(0,0,0,0.5);
    --shadow-xl: 0 30px 90px rgba(0,0,0,0.6);
    --radius-sm: 12px;
    --radius-md: 18px;
    --radius-lg: 24px;
    --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    --font-body: Inter, ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial;
    --font-display: Sora, ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial;
  }

  *{ box-sizing: border-box; margin: 0; padding: 0; }
  html{ scroll-behavior: smooth; }
  body{
    background: var(--bg);
    color: var(--text);
    font-family: var(--font-body);
    width: 100%;
  }
  a{ color: inherit; text-decoration: none; }
  button{ font: inherit; color: inherit; }

  /* Make page full screen and handle scroll on .wrap (not body) */
  body.bcf-landing { overflow: hidden; }
  .wrap{
    position: relative;
    height: 100vh;
    width: 100%;
    overflow-x: hidden;
    overflow-y: auto;
    isolation: isolate;
    background: var(--bg);
    background-size: cover;
    background-position: center;
  }
  .wrap::before{
    content: '';
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 150%;
    height: 150%;
    background:
      radial-gradient(circle at 20% 80%, rgba(139,92,246,0.08) 0%, transparent 50%),
      radial-gradient(circle at 80% 20%, rgba(6,182,212,0.08) 0%, transparent 50%),
      radial-gradient(circle at 40% 40%, rgba(59,130,246,0.05) 0%, transparent 50%);
    animation: gradientShift 20s ease-in-out infinite;
    pointer-events: none;
    z-index: 0;
  }
  @keyframes gradientShift{
    0%, 100%{ transform: translate(-50%, -50%) rotate(0deg); }
    50%{ transform: translate(-50%, -50%) rotate(180deg); }
  }

  .bg-video{
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    filter: contrast(1.08) saturate(1.14) brightness(1.06);
    opacity: var(--video-opacity);
    z-index: 0;
  }

  .glass-bg{
    position: absolute;
    inset: -2px;
    pointer-events: none;
    z-index: 1;
    background:
      radial-gradient(1200px 760px at 50% 38%, rgba(255,255,255,0.06), rgba(0,0,0,0.12) 70%),
      linear-gradient(135deg, rgba(255,255,255,0.045), rgba(0,0,0,0.14));
    backdrop-filter: blur(0.6px) saturate(120%);
    -webkit-backdrop-filter: blur(0.6px) saturate(120%);
  }
  .vignette{
    position: absolute;
    inset: -2px;
    background:
      radial-gradient(1200px 760px at 50% 40%, rgba(0,0,0,0.00), rgba(0,0,0,0.18) 74%),
      linear-gradient(to bottom, rgba(0,0,0,0.10), rgba(0,0,0,0.18));
    z-index: 2;
  }

  #fx{
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    z-index: 3;
    pointer-events: none;
    opacity: 0;
    transition: opacity 900ms ease;
  }
  body.fx-on #fx{ opacity: var(--fx-opacity); }

  .content{
    position: relative;
    z-index: 4;
    min-height: 100vh;
    padding-bottom: 90px;
    width: 100%;
    margin: 0;
    display: flex;
    flex-direction: column;
    align-items: stretch;
  }
  .content > *:not(.hero){
    width: min(1400px, 100%);
    margin-left: auto;
    margin-right: auto;
    padding-left: clamp(24px, 4vw, 60px);
    padding-right: clamp(24px, 4vw, 60px);
  }

  .topnav{
    position: fixed;
    top: 0; left: 0; right: 0;
    z-index: 6;
    padding: clamp(14px, 2vw, 20px) clamp(18px, 3vw, 32px);
    background: linear-gradient(to bottom, rgba(10,14,39,0.8), rgba(10,14,39,0.4));
    backdrop-filter: blur(20px) saturate(180%);
    -webkit-backdrop-filter: blur(20px) saturate(180%);
    border-bottom: 1px solid var(--glass-border);
    box-shadow: 0 4px 20px rgba(0,0,0,0.3);
    opacity: 1;
    transform: translateY(0);
    transition: opacity 0.4s ease, transform 0.4s ease;
    will-change: opacity, transform;
  }
  body.at-top .topnav{ opacity: 0; transform: translateY(-20px); pointer-events:none; }
  .nav-inner{ width: min(1040px, 100%); margin: 0 auto; display:flex; justify-content:center; }
  .nav-actions{ display:flex; gap:12px; flex-wrap:wrap; justify-content:center; width:100%; }

  .nav-link{
    appearance:none;
    background: transparent;
    border: 1px solid transparent;
    padding: 12px 20px;
    cursor: pointer;
    color: var(--text-secondary);
    font-weight: 600;
    letter-spacing: 0.05em;
    text-transform: uppercase;
    font-size: clamp(11px, 1.2vw, 13px);
    text-shadow: var(--text-shadow);
    border-radius: var(--radius-sm);
    transition: var(--transition);
  }
  .nav-link:hover{
    color: var(--accent);
    background: rgba(6,182,212,0.1);
    border-color: var(--glass-border);
    transform: translateY(-2px);
  }

  .hero{
    width: 100%;
    min-height: 100vh;
    position: relative;
    overflow: hidden;
    isolation: isolate;
    display: grid;
    place-items: center;
    text-align: center;
    padding: clamp(18px, 3vw, 30px);
    background: transparent;
    margin: 0;
    text-shadow: 0 2px 18px rgba(0,0,0,0.82);
  }

  .hero-bg{ position:absolute; inset:0; z-index:0; pointer-events:none; }
  .hero .brand{ width: min(920px, 100%); position: relative; z-index: 4; }

  .hero-title{
    margin: 10px 0 0;
    font-family: var(--font-display);
    font-weight: 750;
    font-size: clamp(44px, 6.6vw, 82px);
    line-height: 0.98;
    letter-spacing: -0.03em;
    color: rgba(255,255,255,0.98);
  }

  .hero-brand{
    margin: 10px 0 0;
    font-family: var(--font-display);
    font-weight: 800;
    font-size: clamp(18px, 2.8vw, 30px);
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: rgba(255,255,255,0.96);
  }

  .hero-tagline{
    margin: 12px auto 0;
    color: rgba(255,255,255,0.90);
    font-size: clamp(13px, 1.7vw, 16px);
    line-height: 1.6;
    max-width: 76ch;
  }

  .kicker{
    display:inline-flex;
    gap: 10px;
    align-items:center;
    font-size: 12.5px;
    letter-spacing: 0.22em;
    text-transform: uppercase;
    font-weight: 800;
    color: var(--accent);
    text-shadow: 0 0 20px rgba(6,182,212,0.6), 0 2px 8px rgba(0,0,0,0.8);
    justify-content:center;
  }
  .dot{
    width: 8px; height: 8px; border-radius: 50%;
    background: var(--accent);
    box-shadow: 0 0 16px var(--glow), 0 0 28px rgba(6,182,212,0.4);
  }

  /* Safety */
  .wrap, .hero, .content, footer { max-width:none !important; width:100% !important; margin:0 !important; }
</style>

<?php
// Add a special class to body so we can safely set overflow hidden only on this page.
add_filter('body_class', function($classes){
  $classes[] = 'bcf-landing';
  return $classes;
});
?>

<link rel="icon" type="image/png" href="<?php echo esc_url( site_url('/wp-content/uploads/landing/favicon.png') ); ?>" />
<link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
<link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Sora:wght@500;600;700;800&display=swap" rel="stylesheet">

<div class="wrap" id="wrap">
  <header class="topnav" aria-label="Top navigation">
    <div class="nav-inner">
      <div class="nav-actions" role="navigation" aria-label="Primary links">
        <button class="nav-link" id="btnShop" type="button">Shop Here</button>
        <button class="nav-link" id="btnContact" type="button">Contact</button>
      </div>
    </div>
  </header>

  <main class="content">
    <section class="hero" aria-label="Hero">
      <div class="hero-bg" aria-hidden="true">
        <video class="bg-video" autoplay muted loop playsinline preload="metadata"
               poster="<?php echo esc_url( site_url('/wp-content/uploads/landing/poster.jpg.jpeg') ); ?>"
               aria-hidden="true">
          <source src="<?php echo esc_url( site_url('/wp-content/uploads/landing/hero.mp4') ); ?>" type="video/mp4" />
        </video>

        <div class="glass-bg" aria-hidden="true"></div>
        <div class="vignette" aria-hidden="true"></div>
        <canvas id="fx" aria-hidden="true"></canvas>
      </div>

      <div class="brand">
        <div class="kicker"><span class="dot"></span> LEGAL • PREMIUM • FAST • LOCAL</div>
        <h1 class="hero-title">BIG CITY FLAVORS</h1>
        <div class="hero-brand">Legal Cannabis <span class="break">is here</span></div>
        <p class="hero-tagline">We are now open — doors open at 11AM. Order online and pick up today.</p>

        <div class="info-rail" aria-label="Key info">
          <div class="slot left">
            <div class="label">Hours</div>
            <div class="value">Doors open at 11AM</div>
          </div>
          <div class="slot center">
            <div class="label">Order</div>
            <div class="value">Order online & pick up today</div>
          </div>
          <div class="slot right">
            <div class="label">Location</div>
            <div class="value">
              111-19 Liberty Av<br/>
              <small>South Richmond Hill, NY 11419</small>
            </div>
          </div>
        </div>

        <div class="cta-row" style="margin-top:24px; display:flex; gap:16px; justify-content:center; flex-wrap:wrap;">
          <button class="cta primary" type="button" id="ctaShop">Shop Here</button>
          <button class="cta" type="button" id="ctaOrder">ORDER AHEAD OF TIME</button>
        </div>
      </div>
    </section>

    <div class="sections" aria-label="Main content">
      <section class="section" aria-label="Stats" id="stats">
        <div class="section-row align-center" data-reveal>
          <div class="section-content">
            <div class="glass" data-tilt>
              <p class="kicker" style="margin:0 0 10px;"><span class="dot"></span> QUICK STATS</p>
              <h2>Big City by the numbers</h2>
              <div class="stats" aria-label="Stats" data-reveal>
                <div class="stat" style="--i:0" data-reveal>
                  <div class="num">689</div>
                  <div class="lbl">Products</div>
                </div>
                <div class="stat" style="--i:1" data-reveal>
                  <div class="num">2,773,100,888</div>
                  <div class="lbl">Happy Clients</div>
                </div>
                <div class="stat" style="--i:2" data-reveal>
                  <div class="num">82,150,044</div>
                  <div class="lbl">VIP Members</div>
                </div>
                <div class="stat" style="--i:3" data-reveal>
                  <div class="num">NYC</div>
                  <div class="lbl">Location</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="video-feature" aria-label="Featured video" id="feature" data-reveal>
        <div class="section-row align-center">
          <div class="section-content">
            <div class="video-card" data-tilt>
              <video class="promo-video" autoplay muted loop playsinline preload="metadata">
                <source src="<?php echo esc_url( site_url('/wp-content/uploads/landing/products.mp4') ); ?>" type="video/mp4" />
              </video>
              <div class="video-caption">
                <div>
                  <div class="title">Premium products • NYC energy</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="section" aria-label="Products" id="products">
        <div class="section-row align-center" data-reveal>
          <div class="section-content">
            <div class="glass" data-tilt>
              <p class="kicker" style="margin:0 0 10px;"><span class="dot"></span> OUR PRODUCTS</p>
              <h2>LEGAL DISPENSARY</h2>
              <div class="product-grid">
                <div class="product">
                  <h3>FLOWER</h3>
                  <p>BEST QUALITY FLOWER FROM THE BEST GROWERS IN NYC</p>
                  <div style="margin-top:auto;">
                    <button class="cta" type="button" id="ctaFlower">View More</button>
                  </div>
                </div>
                <div class="product">
                  <h3>OILS</h3>
                  <p>NO ADITIVES 100% NATURAL</p>
                  <div style="margin-top:auto;">
                    <button class="cta" type="button" id="ctaOils">View More</button>
                  </div>
                </div>
                <div class="product">
                  <h3>EDIBLES</h3>
                  <p>MADE FROM PREMIUM FLOWER</p>
                  <div style="margin-top:auto;">
                    <button class="cta" type="button" id="ctaEdibles">View More</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="section" aria-label="About" id="about">
        <div class="section-row align-center" data-reveal>
          <div class="section-content">
            <div class="glass" data-tilt>
              <div class="grid-2">
                <div>
                  <p class="kicker" style="margin:0 0 10px;"><span class="dot"></span> CANNABIS IN THE CITY</p>
                  <h2 style="font-size: clamp(24px, 3.5vw, 38px);">BIG CITY FLAVORS</h2>
                  <p>
                    We carry premium cannabis products from local NYC farms. Every product is tested and compliant with regulations to help ensure a clean and safe experience.
                  </p>
                </div>
                <div>
                  <p class="kicker" style="margin:0 0 10px;"><span class="dot"></span> NYC LOCATION</p>
                  <p style="color: rgba(255,255,255,0.92); font-weight: 750; letter-spacing: -0.01em;">
                    111-19 liberty av, south Richmond hill,ny 11419
                  </p>
                  <p style="margin-top:10px;">ocm-caurd-25-000263</p>
                  <div class="cta-row" style="margin-top:14px;">
                    <button class="cta" type="button" id="ctaContactAbout">Get Started</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="section" aria-label="Order" id="order">
        <div class="section-row align-center" data-reveal>
          <div class="section-content">
            <div class="glass" data-tilt>
              <p class="kicker" style="margin:0 0 16px;"><span class="dot"></span> MAKE SURE WE HAVE WHAT YOU NEED</p>
              <h2 style="font-size: clamp(32px, 5vw, 56px); margin-bottom: 20px;">ORDER AHEAD OF TIME</h2>
              <p style="margin-top: 20px; font-size: clamp(16px, 2vw, 20px); color: var(--text); font-weight: 500; letter-spacing: 0.02em;">ORDER ONLINE AND PICK UP TODAY</p>
              <div class="cta-row" style="margin-top:32px;">
                <button class="cta primary" type="button" id="ctaOrderHere" style="padding: 16px 40px; font-size: clamp(15px, 1.8vw, 18px); box-shadow: 0 8px 32px rgba(6,182,212,0.4), 0 0 60px rgba(139,92,246,0.3);">ORDER HERE</button>
              </div>
            </div>
          </div>
        </div>
      </section>

    </div>
  </main>

  <footer class="site-footer" aria-label="Footer" data-reveal>
    <div class="footer-inner">
      <div class="footer-topline" aria-hidden="true"></div>

      <div class="footer-grid">
        <div class="footer-col">
          <div class="footer-title">Big city flavors</div>
          <p class="footer-text">ocm-caurd-25-000263</p>
          <p class="footer-text footer-meta">111-19 liberty av, south Richmond hill,ny 11419</p>
          <div class="footer-links" style="margin-top:14px;">
            <a class="footer-link" href="#" onclick="document.getElementById('about')?.scrollIntoView({behavior:'smooth',block:'start'}); return false;">OCM regulations</a>
          </div>
        </div>

        <div class="footer-col">
          <div class="footer-h">Job Links</div>
          <div class="footer-links">
            <a class="footer-link" href="#" onclick="document.getElementById('contactModal')?.classList.add('show'); return false;">SOCIAL MEDIA</a>
          </div>
        </div>

        <div class="footer-col">
          <div class="footer-h">New York State HOPEline</div>
          <div class="footer-links">
            <a class="footer-link" href="tel:+18778467369">Call: <small>1-877-846-7369</small></a>
            <a class="footer-link" href="sms:467369?&body=HOPENY">Text: <small>Text "HOPENY" to 467369</small></a>
            <a class="footer-link" href="https://oasas.ny.gov/HOPEline" target="_blank" rel="noreferrer">website <small>oasas.ny.gov/HOPEline</small></a>
          </div>
        </div>

        <div class="footer-col">
          <div class="footer-h">Join Our Mailing</div>
          <p class="footer-text">Get updates, drops, and store news.</p>
          <div class="footer-links" style="margin-top:10px;">
            <a class="footer-link" href="mailto:BIGCITYFLAVORS@GMAIL.COM?subject=Join%20Mailing%20List">Email us to join</a>
          </div>
        </div>

        <div class="footer-col">
          <div class="footer-h">YouTube Channel</div>
          <p class="footer-text">Videos and updates coming soon.</p>
          <div class="footer-links" style="margin-top:10px;">
            <a class="footer-link" href="https://www.youtube.com" target="_blank" rel="noreferrer">Open YouTube</a>
          </div>
        </div>

        <div class="footer-col">
          <div class="footer-h">Customer Support</div>
          <div class="footer-links">
            <a class="footer-link" href="mailto:BIGCITYFLAVORS@GMAIL.COM">BIGCITYFLAVORS@GMAIL.COM</a>
            <a class="footer-link" href="#" onclick="alert('Privacy Policy: add your policy link here.'); return false;">Privacy Policy</a>
          </div>
        </div>
      </div>

      <div class="footer-bottom">
        <span>© <span id="year"></span> Big City Flavors</span>
        <span>
          <a href="#" onclick="window.scrollTo({top:0,behavior:'smooth'}); return false;">Back to top</a>
        </span>
      </div>
    </div>
  </footer>

  <div class="overlay" id="ageGate" role="dialog" aria-modal="true" aria-label="Age Verification">
    <div class="age-card" id="ageCard">
      <p class="age-topline">ORDER ONLINE AND PICK UP TODAY</p>
      <p class="age-topline">AT 111-19 liberty av, south Richmond hill,ny 11419</p>
      <h2 class="age-title">Please verify your age to enter.</h2>
      <p class="age-sub">This website contains cannabis-related content. You must be 21 or older to access this site.</p>

      <div class="age-actions" id="ageActions">
        <button class="age-btn primary" id="ageYes" type="button">I Am 21 Or Older</button>
        <button class="age-btn secondary" id="ageNo" type="button">I Am Under 21</button>
      </div>

      <div class="age-locked" id="ageLocked" aria-live="polite">
        Access denied. You must be 21+ to enter this website.
      </div>

      <p class="age-legal">
        Keep all marijuana and marijuana products out of reach of children and animals. Intoxicating effects may be delayed up to two (2) hours.
        Use of marijuana while pregnant or breastfeeding may be harmful.
      </p>
      <p class="age-note">By entering, you confirm you are of legal age in your jurisdiction.</p>
    </div>
  </div>

  <div class="modal" id="contactModal" role="dialog" aria-modal="true" aria-label="Contact">
    <div class="card">
      <div style="display:flex; gap:12px; align-items:center;">
        <h2 style="margin:0;">Contact</h2>
        <button class="close" id="closeContact" aria-label="Close contact modal" type="button">✕</button>
      </div>
      <p style="margin-top:10px;">
        Email:
        <a href="mailto:BIGCITYFLAVORS@GMAIL.COM" style="text-decoration:underline;">BIGCITYFLAVORS@GMAIL.COM</a>
        <br/>Phone: <span style="color: var(--muted);">(add your number)</span>
        <br/>Address: 111-19 liberty av, south Richmond hill, NY 11419
      </p>
      <p style="margin:0; color: var(--dim); font-size:12px;">Tip: You can replace this modal with a direct contact page anytime.</p>
    </div>
  </div>
</div>

<!-- Scripts (defer) -->
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js" referrerpolicy="no-referrer"></script>
<script defer src="https://cdn.jsdelivr.net/npm/three@0.160.0/build/three.min.js" referrerpolicy="no-referrer"></script>

<script>
  // Add classes safely (body exists here)
  document.documentElement.classList.add('js');
  document.documentElement.classList.add('js-enhanced');
  document.body.classList.add('at-top');

  const URL_SHOP = "https://bigcityflavors.com/?page_id=315";
  const prefersReducedMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

  // Get the scrollable container
  const scrollContainer = document.querySelector('.wrap');
  
  const setAtTop = () => {
    const scrollTop = scrollContainer ? scrollContainer.scrollTop : (window.scrollY || document.documentElement.scrollTop || 0);
    const atTop = scrollTop < 10;
    document.body.classList.toggle("at-top", atTop);
  };
  setAtTop();
  
  // Listen to scroll on the actual container
  if (scrollContainer) {
    scrollContainer.addEventListener("scroll", setAtTop, { passive: true });
  } else {
    window.addEventListener("scroll", setAtTop, { passive: true });
  }

  // ====== UI ======
  const btnShop = document.getElementById("btnShop");
  const btnContact = document.getElementById("btnContact");
  const contactModal = document.getElementById("contactModal");
  const closeContact = document.getElementById("closeContact");
  document.getElementById("year").textContent = String(new Date().getFullYear());

  const ctaShop = document.getElementById("ctaShop");
  const ctaOrder = document.getElementById("ctaOrder");
  const ctaOrderHere = document.getElementById("ctaOrderHere");
  const ctaContact = document.getElementById("ctaContact");
  const ctaContactAbout = document.getElementById("ctaContactAbout");

  if (btnShop) btnShop.addEventListener("click", () => window.location.href = URL_SHOP);
  if (btnContact) btnContact.addEventListener("click", () => contactModal.classList.add("show"));
  if (closeContact) closeContact.addEventListener("click", () => contactModal.classList.remove("show"));
  if (contactModal) contactModal.addEventListener("click", (e) => { if (e.target === contactModal) contactModal.classList.remove("show"); });

  if (ctaShop) ctaShop.addEventListener("click", () => window.location.href = URL_SHOP);
  if (ctaOrderHere) ctaOrderHere.addEventListener("click", () => window.location.href = URL_SHOP);
  if (ctaOrder) ctaOrder.addEventListener("click", () => {
    document.getElementById("order")?.scrollIntoView({ behavior: prefersReducedMotion ? "auto" : "smooth", block: "start" });
  });
  if (ctaContact) ctaContact.addEventListener("click", () => contactModal.classList.add("show"));
  if (ctaContactAbout) ctaContactAbout.addEventListener("click", () => contactModal.classList.add("show"));

  // Product CTAs
  const ctaFlower = document.getElementById("ctaFlower");
  const ctaOils = document.getElementById("ctaOils");
  const ctaEdibles = document.getElementById("ctaEdibles");
  if (ctaFlower) ctaFlower.addEventListener("click", () => window.location.href = URL_SHOP);
  if (ctaOils) ctaOils.addEventListener("click", () => window.location.href = URL_SHOP);
  if (ctaEdibles) ctaEdibles.addEventListener("click", () => window.location.href = URL_SHOP);

  // ====== AGE GATE ======
  const ageGate = document.getElementById("ageGate");
  const ageCard = document.getElementById("ageCard");
  const ageYesBtn = document.getElementById("ageYes");
  const ageNoBtn = document.getElementById("ageNo");

  const setGateOpen = (open) => {
    ageGate.classList.toggle("show", open);
    document.body.style.overflow = "";

    if (!prefersReducedMotion && typeof gsap !== "undefined") {
      if (open) {
        gsap.fromTo("#ageCard", { y: 18, opacity: 0 }, { y: 0, opacity: 1, duration: 0.45, ease: "power2.out" });
      } else {
        gsap.to("#ageCard", { y: 10, opacity: 0, duration: 0.22, ease: "power2.in" });
      }
    }
  };

  const setLocked = (locked) => {
    ageCard.classList.toggle("locked", locked);
    ageYesBtn.disabled = locked;
    ageYesBtn.style.display = locked ? "none" : "";
    ageNoBtn.textContent = locked ? "Exit Site" : "I Am Under 21";
    ageNoBtn.classList.toggle("secondary", !locked);
    ageNoBtn.classList.toggle("primary", locked);
  };

  // Always show on refresh (no persistence)
  const ageOk = false;
  setGateOpen(true);
  setLocked(false);

  ageYesBtn.addEventListener("click", () => {
    setLocked(false);
    setGateOpen(false);
    if (typeof gsap !== "undefined") {
      gsap.fromTo(".hero", { y: 14, opacity: 0 }, { y: 0, opacity: 1, duration: 0.7, ease: "power2.out" });
    }
  });

  ageNoBtn.addEventListener("click", () => {
    const isLocked = ageCard.classList.contains("locked");
    if (!isLocked) {
      setLocked(true);
      if (!prefersReducedMotion && typeof gsap !== "undefined") {
        gsap.fromTo("#ageLocked", { opacity: 0 }, { opacity: 1, duration: 0.35, ease: "power2.out" });
      }
      return;
    }
    window.location.href = "https://www.google.com";
  });

  // Subtle 3D tilt on the age card
  if (!prefersReducedMotion) {
    const maxTilt = 7;
    const resetTilt = () => {
      ageCard.style.transform = "translateY(0px) scale(1) rotateX(0deg) rotateY(0deg)";
    };
    const onMove = (e) => {
      const r = ageCard.getBoundingClientRect();
      const px = (e.clientX - r.left) / r.width;
      const py = (e.clientY - r.top) / r.height;
      const rx = (0.5 - py) * (maxTilt * 2);
      const ry = (px - 0.5) * (maxTilt * 2);
      ageCard.style.transform = `translateY(0px) scale(1) rotateX(${rx.toFixed(2)}deg) rotateY(${ry.toFixed(2)}deg)`;
    };
    ageCard.addEventListener("pointermove", onMove);
    ageCard.addEventListener("pointerleave", resetTilt);
  }

  // Reveal-on-scroll
  try {
    if (!prefersReducedMotion) {
      const revealEls = Array.from(document.querySelectorAll("[data-reveal]"));
      const io = new IntersectionObserver((entries) => {
        for (const entry of entries) {
          if (!entry.isIntersecting) continue;
          entry.target.classList.add("in");
          io.unobserve(entry.target);
        }
      }, { threshold: 0.12 });
      for (const el of revealEls) io.observe(el);
    } else {
      document.querySelectorAll("[data-reveal]").forEach((el) => el.classList.add("in"));
    }
  } catch {
    document.querySelectorAll("[data-reveal]").forEach((el) => el.classList.add("in"));
  }

  // Promo video: pause offscreen, play onscreen
  const promoVideo = document.querySelector(".promo-video");
  if (promoVideo) {
    promoVideo.muted = true;
    promoVideo.playsInline = true;

    if (prefersReducedMotion) {
      promoVideo.pause();
      promoVideo.removeAttribute("autoplay");
      promoVideo.setAttribute("controls", "");
    }

    const safePlay = () => {
      if (prefersReducedMotion) return;
      const p = promoVideo.play();
      if (p && typeof p.catch === "function") p.catch(() => {});
    };

    if ("IntersectionObserver" in window) {
      const vio = new IntersectionObserver((entries) => {
        for (const entry of entries) {
          if (entry.isIntersecting) safePlay();
          else promoVideo.pause();
        }
      }, { threshold: 0.35 });
      vio.observe(promoVideo);
    } else {
      safePlay();
    }
  }

  // ====== ENTRANCE ANIMATIONS ======
  if (typeof gsap !== "undefined") {
    gsap.fromTo(".hero", { y: 14, opacity: 0 }, { y: 0, opacity: 1, duration: 0.8, ease: "power2.out", delay: ageOk ? 0.05 : 0 });
    gsap.fromTo(".nav-link", { y: 8, opacity: 0 }, { y: 0, opacity: 1, duration: 0.55, ease: "power2.out", stagger: 0.06, delay: ageOk ? 0.22 : 0.05 });
  }

  // ====== SCATTERED BUBBLES (Three.js) ======
  const ENABLE_BUBBLES = true;

  if (ENABLE_BUBBLES && typeof THREE !== "undefined") {
    const canvas = document.getElementById("fx");
    if (canvas) {
      const renderer = new THREE.WebGLRenderer({
        canvas,
        antialias: true,
        alpha: true,
        powerPreference: "high-performance"
      });
      renderer.setClearColor(0x000000, 0);
      renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));

      const scene = new THREE.Scene();
      const camera = new THREE.PerspectiveCamera(45, 1, 0.1, 100);
      camera.position.set(0, 0.10, 7.4);

      scene.add(new THREE.AmbientLight(0xffffff, 0.55));
      const rim = new THREE.DirectionalLight(0xffffff, 0.65);
      rim.position.set(-2.5, 3.0, 2.0);
      scene.add(rim);
      const key = new THREE.DirectionalLight(0xffffff, 0.45);
      key.position.set(3.5, 2.2, 1.5);
      scene.add(key);

      const bounds = {
        x: 9.0,
        y: 5.2,
        zNear: -0.9,
        zFar: -13.5
      };

      const palette = [
        new THREE.Color("#93B1A6"),
        new THREE.Color("#5C8374"),
        new THREE.Color("#ffffff"),
      ];

      const rand = (a, b) => a + Math.random() * (b - a);
      const getBubbleCount = () => {
        if (prefersReducedMotion) return 0;
        const hero = document.querySelector(".hero");
        const rect = hero ? hero.getBoundingClientRect() : { width: window.innerWidth, height: window.innerHeight };
        const area = rect.width * rect.height;
        const base = Math.round(area / 52000);
        return Math.max(12, Math.min(22, base));
      };

      const bubbleGeo = new THREE.SphereGeometry(1, 20, 20);
      const makeBubbleMaterial = (tint) => {
        const m = new THREE.MeshPhysicalMaterial({
          color: tint.clone().lerp(new THREE.Color("#ffffff"), 0.55),
          metalness: 0.0,
          roughness: 0.10,
          transmission: 0.96,
          thickness: 0.65,
          ior: 1.18,
          clearcoat: 1.0,
          clearcoatRoughness: 0.06,
          transparent: true,
          opacity: 0.0,
          depthWrite: false
        });
        m.emissive = new THREE.Color("#ffffff");
        m.emissiveIntensity = 0.0;
        return m;
      };

      const bubbles = [];
      const bubbleCount = getBubbleCount();

      const spawnBubble = (mesh, yOverride) => {
        mesh.position.set(
          (Math.random() - 0.5) * bounds.x,
          (typeof yOverride === "number" ? yOverride : (Math.random() - 0.5) * bounds.y),
          THREE.MathUtils.lerp(bounds.zNear, bounds.zFar, Math.random())
        );
      };

      for (let i = 0; i < bubbleCount; i++) {
        const radius = rand(0.18, 0.92) * (Math.random() ** 1.3);
        const tint = palette[Math.floor(Math.random() * palette.length)];
        const mesh = new THREE.Mesh(bubbleGeo, makeBubbleMaterial(tint));
        mesh.scale.setScalar(radius);
        spawnBubble(mesh);
        bubbles.push({
          mesh,
          vy: rand(0.0012, 0.0048),
          vx: rand(0.0007, 0.0030) * (Math.random() < 0.5 ? -1 : 1),
          wobble: rand(0.001, 0.006),
          phase: Math.random() * Math.PI * 2,
          fadeSpeed: rand(0.55, 1.05),
          baseOpacity: rand(0.03, 0.08),
          ampOpacity: rand(0.02, 0.08),
          glint: Math.random()
        });
        scene.add(mesh);
      }

      // Sparkles
      const sparkleGeo = new THREE.BufferGeometry();
      const sparkleCount = prefersReducedMotion ? 0 : (bubbleCount * 7 + 70);
      const sparklePos = new Float32Array(sparkleCount * 3);
      const sparkleSize = new Float32Array(sparkleCount);
      const sparkleSeed = new Float32Array(sparkleCount);
      const sparkleBubble = new Uint16Array(sparkleCount);
      const sparkleOff = new Float32Array(sparkleCount * 3);
      const sparkleDrift = new Float32Array(sparkleCount);

      const resetSparkle = (i) => {
        sparkleBubble[i] = bubbleCount ? Math.floor(Math.random() * bubbleCount) : 0;
        const oi = i * 3;
        sparkleOff[oi + 0] = rand(-0.85, 0.85);
        sparkleOff[oi + 1] = rand(-0.85, 0.85);
        sparkleOff[oi + 2] = rand(-0.85, 0.85);
        sparkleDrift[i] = rand(0.0005, 0.0019);
        sparkleSize[i] = rand(8.0, 20.0) * (Math.random() ** 0.4);
        sparkleSeed[i] = Math.random();
      };
      for (let i = 0; i < sparkleCount; i++) resetSparkle(i);

      sparkleGeo.setAttribute("position", new THREE.BufferAttribute(sparklePos, 3));
      sparkleGeo.setAttribute("aSize", new THREE.BufferAttribute(sparkleSize, 1));
      sparkleGeo.setAttribute("aSeed", new THREE.BufferAttribute(sparkleSeed, 1));

      const sparkleMat = new THREE.ShaderMaterial({
        transparent: true,
        depthWrite: false,
        blending: THREE.AdditiveBlending,
        uniforms: {
          uTime: { value: 0 },
          uOpacity: { value: 0.24 },
          uColorA: { value: new THREE.Color("#93B1A6") },
          uColorB: { value: new THREE.Color("#ffffff") }
        },
        vertexShader: `
          uniform float uTime;
          attribute float aSize;
          attribute float aSeed;
          varying float vSeed;
          void main(){
            vSeed = aSeed;
            vec4 mv = modelViewMatrix * vec4(position, 1.0);
            float tw = 0.72 + 0.28 * sin(uTime*3.1 + aSeed*18.0);
            float ps = aSize * tw * (1.0 / max(0.6, -mv.z));
            gl_PointSize = clamp(ps, 2.0, 40.0);
            gl_Position = projectionMatrix * mv;
          }
        `,
        fragmentShader: `
          uniform float uTime;
          uniform float uOpacity;
          uniform vec3 uColorA;
          uniform vec3 uColorB;
          varying float vSeed;
          void main(){
            vec2 uv = gl_PointCoord - vec2(0.5);
            float d = length(uv);
            float core = smoothstep(0.50, 0.06, d);
            float ring = smoothstep(0.48, 0.00, d) * smoothstep(0.20, 0.00, d);
            float sx = smoothstep(0.06, 0.00, abs(uv.x)) * smoothstep(0.48, 0.00, abs(uv.y));
            float sy = smoothstep(0.06, 0.00, abs(uv.y)) * smoothstep(0.48, 0.00, abs(uv.x));
            float streak = (sx + sy) * 0.65;
            float tw = 0.55 + 0.45 * sin(uTime*4.2 + vSeed*14.0);
            vec3 col = mix(uColorA, uColorB, fract(vSeed*5.3));
            float a = (core*0.50 + ring*0.90 + streak) * uOpacity * tw;
            if (a < 0.01) discard;
            gl_FragColor = vec4(col, a);
          }
        `
      });
      const sparkles = new THREE.Points(sparkleGeo, sparkleMat);
      scene.add(sparkles);

      const heroEl = document.querySelector(".hero");

      const resize = () => {
        const rect = heroEl ? heroEl.getBoundingClientRect() : { width: window.innerWidth, height: window.innerHeight };
        const w = Math.max(1, Math.round(rect.width));
        const h = Math.max(1, Math.round(rect.height));
        renderer.setSize(w, h, false);
        camera.aspect = w / h;
        camera.updateProjectionMatrix();
        const ar = w / h;
        bounds.x = 10.8 * ar;
        bounds.y = 6.2;
      };
      window.addEventListener("resize", resize);
      resize();

      let mx = 0, my = 0;
      window.addEventListener("pointermove", (e) => {
        mx = (e.clientX / window.innerWidth) * 2 - 1;
        my = (e.clientY / window.innerHeight) * 2 - 1;
      });

      let rafId = 0;
      let t = 0;
      const tick = () => {
        t += 0.010;
        sparkleMat.uniforms.uTime.value = t;

        camera.position.x = mx * 0.18;
        camera.position.y = 0.10 + (-my) * 0.10;
        camera.lookAt(0, 0, -6);

        for (const b of bubbles) {
          const m = b.mesh;
          m.position.y += b.vy;
          m.position.x += b.vx + Math.sin(t * 0.8 + b.phase) * b.wobble * 0.35;

          if (m.position.y > bounds.y * 0.55) spawnBubble(m, -bounds.y * 0.55);
          if (m.position.x > bounds.x * 0.55) m.position.x = -bounds.x * 0.55;
          if (m.position.x < -bounds.x * 0.55) m.position.x = bounds.x * 0.55;

          m.rotation.y += 0.0016;
          m.rotation.x += 0.0010;

          const fade = (Math.sin(t * b.fadeSpeed + b.phase) + 1) * 0.5;
          const op = THREE.MathUtils.clamp(b.baseOpacity + fade * b.ampOpacity, 0.0, 0.16);
          m.material.opacity = op;

          const gl = Math.max(0, Math.sin(t * 3.2 + b.glint * 14.0));
          m.material.emissiveIntensity = 0.02 + gl * 0.06;
        }

        for (let i = 0; i < sparkleCount; i++) {
          const bi = sparkleBubble[i];
          const b = bubbles[bi];
          const oi = i * 3;
          if (b) {
            sparkleOff[oi + 1] += sparkleDrift[i];
            if (sparkleOff[oi + 1] > 1.1) resetSparkle(i);
            sparklePos[oi + 0] = b.mesh.position.x + sparkleOff[oi + 0];
            sparklePos[oi + 1] = b.mesh.position.y + sparkleOff[oi + 1];
            sparklePos[oi + 2] = b.mesh.position.z + sparkleOff[oi + 2];
          }
        }
        sparkleGeo.attributes.position.needsUpdate = true;

        renderer.render(scene, camera);
        rafId = requestAnimationFrame(tick);
      };

      const startFx = () => {
        if (!rafId) rafId = requestAnimationFrame(tick);
      };
      const stopFx = () => {
        if (rafId) cancelAnimationFrame(rafId);
        rafId = 0;
      };

      document.addEventListener("visibilitychange", () => {
        if (document.hidden) stopFx();
        else startFx();
      });

      if (!prefersReducedMotion && heroEl && "IntersectionObserver" in window) {
        const io = new IntersectionObserver((entries) => {
          for (const entry of entries) {
            if (entry.isIntersecting) {
              document.body.classList.add("fx-on");
              resize();
              startFx();
            } else {
              document.body.classList.remove("fx-on");
              stopFx();
            }
          }
        }, { threshold: 0.15 });
        io.observe(heroEl);
      } else {
        if (!prefersReducedMotion) document.body.classList.add("fx-on");
        startFx();
      }
    }
  }
</script>

<?php get_footer(); ?>
