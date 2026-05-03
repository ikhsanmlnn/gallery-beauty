<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= isset($title) ? htmlspecialchars($title) : 'GaleriKita' ?></title>

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <style>
    /* CSS VARIABLES & RESET */
    :root {
      --black:       #0a0a0a;
      --off-black:   #111111;
      --dark:        #1a1a1a;
      --mid:         #2d2d2d;
      --border:      #2a2a2a;
      --muted:       #5a5a5a;
      --soft:        #888888;
      --silver:      #b0b0b0;
      --light:       #e8e8e8;
      --white:       #f8f8f8;
      --pure-white:  #ffffff;

      --accent:      #e8d5a3;
      --accent2:     #c9a96e;
      --accent-glow: rgba(232,213,163,0.15);

      --radius-sm:   6px;
      --radius:      12px;
      --radius-lg:   20px;
      --radius-xl:   32px;

      --nav-h:       68px;
      --transition:  0.3s cubic-bezier(0.4,0,0.2,1);
      --shadow-card: 0 4px 24px rgba(0,0,0,0.4);
      --shadow-hover: 0 12px 48px rgba(0,0,0,0.6);
    }

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    html { scroll-behavior: smooth; }

    body {
      font-family: 'DM Sans', sans-serif;
      background: var(--black);
      color: var(--light);
      min-height: 100vh;
      overflow-x: hidden;
      line-height: 1.6;
    }

    a { color: inherit; text-decoration: none; }
    img { display: block; max-width: 100%; }
    ul { list-style: none; }

    /* ============================================================
       SCROLLBAR
    ============================================================ */
    ::-webkit-scrollbar { width: 5px; }
    ::-webkit-scrollbar-track { background: var(--black); }
    ::-webkit-scrollbar-thumb { background: var(--mid); border-radius: 99px; }
    ::-webkit-scrollbar-thumb:hover { background: var(--muted); }

    /* ============================================================
       NAVBAR
    ============================================================ */
    .navbar {
      position: fixed;
      top: 0; left: 0; right: 0;
      height: var(--nav-h);
      z-index: 1000;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 32px;
      background: rgba(10,10,10,0.88);
      backdrop-filter: blur(20px) saturate(1.4);
      -webkit-backdrop-filter: blur(20px);
      border-bottom: 1px solid rgba(255,255,255,0.05);
      transition: all var(--transition);
    }

    .navbar.scrolled {
      background: rgba(10,10,10,0.97);
      box-shadow: 0 1px 40px rgba(0,0,0,0.6);
    }

    .nav-logo {
      display: flex;
      align-items: center;
      gap: 10px;
      font-family: 'Playfair Display', serif;
      font-size: 1.35rem;
      font-weight: 700;
      letter-spacing: -0.02em;
      color: var(--pure-white);
    }

    .nav-logo .logo-dot {
      width: 8px; height: 8px;
      background: var(--accent);
      border-radius: 50%;
      animation: pulse 2.5s ease-in-out infinite;
    }

    @keyframes pulse {
      0%, 100% { transform: scale(1); opacity: 1; }
      50% { transform: scale(1.3); opacity: 0.7; }
    }

    .nav-links {
      display: flex;
      align-items: center;
      gap: 4px;
    }

    .nav-links a {
      padding: 8px 16px;
      border-radius: var(--radius-sm);
      font-size: 0.875rem;
      font-weight: 500;
      color: var(--silver);
      transition: all var(--transition);
      letter-spacing: 0.01em;
      position: relative;
    }

    .nav-links a:hover,
    .nav-links a.active {
      color: var(--pure-white);
      background: rgba(255,255,255,0.07);
    }

    .nav-links a.active::after {
      content: '';
      position: absolute;
      bottom: 4px;
      left: 50%;
      transform: translateX(-50%);
      width: 4px; height: 4px;
      background: var(--accent);
      border-radius: 50%;
    }

    .nav-actions {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .btn-upload {
      display: flex;
      align-items: center;
      gap: 8px;
      padding: 9px 20px;
      background: var(--pure-white);
      color: var(--black);
      border-radius: var(--radius-sm);
      font-size: 0.85rem;
      font-weight: 600;
      transition: all var(--transition);
      letter-spacing: 0.01em;
    }

    .btn-upload:hover {
      background: var(--accent);
      transform: translateY(-1px);
      box-shadow: 0 4px 20px rgba(232,213,163,0.3);
    }

    .hamburger {
      display: none;
      flex-direction: column;
      gap: 5px;
      cursor: pointer;
      padding: 8px;
    }

    .hamburger span {
      display: block;
      width: 24px; height: 2px;
      background: var(--light);
      border-radius: 2px;
      transition: all var(--transition);
    }

    /* ============================================================
       FLASH MESSAGES
    ============================================================ */
    .flash-container {
      position: fixed;
      top: calc(var(--nav-h) + 16px);
      right: 20px;
      z-index: 999;
      display: flex;
      flex-direction: column;
      gap: 10px;
      max-width: 380px;
    }

    .flash {
      display: flex;
      align-items: flex-start;
      gap: 12px;
      padding: 14px 18px;
      border-radius: var(--radius);
      font-size: 0.875rem;
      font-weight: 500;
      backdrop-filter: blur(20px);
      animation: slideInRight 0.4s cubic-bezier(0.34,1.56,0.64,1);
      box-shadow: 0 8px 32px rgba(0,0,0,0.4);
    }

    .flash-success {
      background: rgba(16,185,129,0.15);
      border: 1px solid rgba(16,185,129,0.3);
      color: #6ee7b7;
    }

    .flash-error {
      background: rgba(239,68,68,0.15);
      border: 1px solid rgba(239,68,68,0.3);
      color: #fca5a5;
    }

    .flash i { margin-top: 1px; flex-shrink: 0; }

    .flash-close {
      margin-left: auto;
      cursor: pointer;
      opacity: 0.6;
      transition: opacity var(--transition);
      background: none; border: none;
      color: inherit; font-size: 0.9rem;
    }

    .flash-close:hover { opacity: 1; }

    @keyframes slideInRight {
      from { transform: translateX(120%); opacity: 0; }
      to   { transform: translateX(0);   opacity: 1; }
    }

    /* MAIN CONTENT OFFSET */
    .main-content {
      padding-top: var(--nav-h);
      min-height: 100vh;
    }

    /* RESPONSIVE NAV */
    @media (max-width: 768px) {
      .navbar { padding: 0 20px; }
      .hamburger { display: flex; }
      .nav-links {
        position: fixed;
        top: var(--nav-h); left: 0; right: 0;
        flex-direction: column;
        background: rgba(10,10,10,0.98);
        backdrop-filter: blur(20px);
        padding: 20px;
        gap: 8px;
        transform: translateY(-110%);
        transition: transform var(--transition);
        border-bottom: 1px solid var(--border);
      }
      .nav-links.open { transform: translateY(0); }
      .nav-links a { width: 100%; padding: 12px 16px; }
      .nav-actions .btn-upload span { display: none; }
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar" id="navbar">
  <a href="<?= base_url('galeri') ?>" class="nav-logo">
    <div class="logo-dot"></div>
    Gallery Beauty
  </a>

  <ul class="nav-links" id="navLinks">
    <li><a href="<?= base_url('galeri') ?>" class="<?= isset($active) && $active === 'galeri' ? 'active' : '' ?>">
      <i class="fas fa-images" style="margin-right:6px;font-size:0.8rem;"></i>Gallery
    </a></li>
    <li><a href="<?= base_url('anggota') ?>" class="<?= isset($active) && $active === 'anggota' ? 'active' : '' ?>">
      <i class="fas fa-users" style="margin-right:6px;font-size:0.8rem;"></i>Members
    </a></li>
  </ul>

  <div class="nav-actions">
    <a href="<?= base_url('galeri/create') ?>" class="btn-upload">
      <i class="fas fa-plus"></i>
      <span>Upload</span>
    </a>
    <div class="hamburger" id="hamburger" onclick="toggleNav()">
      <span></span><span></span><span></span>
    </div>
  </div>
</nav>

<!-- Flash messages -->
<?php if (!empty($flash_success) || !empty($flash_error)): ?>
<div class="flash-container" id="flashContainer">
  <?php if (!empty($flash_success)): ?>
  <div class="flash flash-success">
    <i class="fas fa-check-circle"></i>
    <span><?= htmlspecialchars($flash_success) ?></span>
    <button class="flash-close" onclick="this.parentElement.remove()"><i class="fas fa-times"></i></button>
  </div>
  <?php endif; ?>
  <?php if (!empty($flash_error)): ?>
  <div class="flash flash-error">
    <i class="fas fa-exclamation-circle"></i>
    <span><?= htmlspecialchars($flash_error) ?></span>
    <button class="flash-close" onclick="this.parentElement.remove()"><i class="fas fa-times"></i></button>
  </div>
  <?php endif; ?>
</div>
<script>
  setTimeout(() => {
    const fc = document.getElementById('flashContainer');
    if (fc) { fc.style.opacity = '0'; fc.style.transition = '0.5s'; setTimeout(() => fc.remove(), 500); }
  }, 4500);
</script>
<?php endif; ?>

<div class="main-content">

<script>
  // Navbar scroll
  window.addEventListener('scroll', () => {
    document.getElementById('navbar').classList.toggle('scrolled', window.scrollY > 20);
  });

  function toggleNav() {
    document.getElementById('navLinks').classList.toggle('open');
  }
</script>
