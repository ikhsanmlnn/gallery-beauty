<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
</div><!-- main-content -->

<footer class="site-footer">
  <div class="footer-inner">
    <div class="footer-brand">
      <span class="footer-logo">Gallery Beauty</span>
      <p>Photo gallery platform<br>Gunadarma University</p>
    </div>
    <div class="footer-links">
      <a href="<?= base_url('galeri') ?>"><i class="fas fa-images"></i> Galeri</a>
      <a href="<?= base_url('galeri/create') ?>"><i class="fas fa-upload"></i> Upload</a>
      <a href="<?= base_url('anggota') ?>"><i class="fas fa-users"></i> Anggota</a>
    </div>
    <div class="footer-meta">
      <span>Multimedia Systems &bull; <?= date('Y') ?></span>
      <span>Built with CodeIgniter 3</span>
    </div>
  </div>
</footer>

<style>
  .site-footer {
    margin-top: 80px;
    border-top: 1px solid var(--border, #2a2a2a);
    padding: 40px 32px 32px;
    background: var(--off-black, #111);
  }

  .footer-inner {
    max-width: 1400px;
    margin: 0 auto;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 24px;
    flex-wrap: wrap;
  }

  .footer-logo {
    font-family: 'Playfair Display', serif;
    font-size: 1.2rem;
    font-weight: 700;
    color: var(--pure-white, #fff);
    display: block;
    margin-bottom: 6px;
  }

  .footer-brand p {
    font-size: 0.8rem;
    color: var(--muted, #5a5a5a);
    line-height: 1.5;
  }

  .footer-links {
    display: flex;
    gap: 20px;
  }

  .footer-links a {
    font-size: 0.85rem;
    color: var(--soft, #888);
    display: flex;
    align-items: center;
    gap: 6px;
    transition: color 0.2s;
  }

  .footer-links a:hover { color: var(--pure-white, #fff); }

  .footer-meta {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    gap: 4px;
    font-size: 0.78rem;
    color: var(--muted, #5a5a5a);
  }

  @media (max-width: 640px) {
    .footer-inner { flex-direction: column; align-items: flex-start; }
    .footer-meta { align-items: flex-start; }
  }
</style>

</body>
</html>
