<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<style>
/* GALLERY INDEX */

/* Hero */
.gallery-hero {
  position: relative;
  padding: 72px 32px 56px;
  text-align: center;
  overflow: hidden;
}

.gallery-hero::before {
  content: '';
  position: absolute;
  inset: 0;
  background: radial-gradient(ellipse 80% 60% at 50% 0%, rgba(232,213,163,0.08) 0%, transparent 70%);
  pointer-events: none;
}

.hero-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 6px 16px;
  background: rgba(232,213,163,0.1);
  border: 1px solid rgba(232,213,163,0.2);
  border-radius: 99px;
  font-size: 0.78rem;
  font-weight: 600;
  letter-spacing: 0.08em;
  text-transform: uppercase;
  color: var(--accent);
  margin-bottom: 24px;
}

.hero-eyebrow::before {
  content: '';
  width: 6px; height: 6px;
  background: var(--accent);
  border-radius: 50%;
  animation: pulse 2s ease-in-out infinite;
}

.gallery-hero h1 {
  font-family: 'Playfair Display', serif;
  font-size: clamp(2.4rem, 5vw, 4rem);
  font-weight: 700;
  color: var(--pure-white);
  letter-spacing: -0.03em;
  line-height: 1.1;
  margin-bottom: 16px;
}

.gallery-hero h1 em {
  font-style: italic;
  color: var(--accent);
}

.hero-sub {
  color: var(--soft);
  font-size: 1rem;
  max-width: 480px;
  margin: 0 auto 32px;
}

.hero-stats {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 32px;
  flex-wrap: wrap;
}

.stat-item {
  display: flex;
  flex-direction: column;
  align-items: center;
}

.stat-num {
  font-family: 'Playfair Display', serif;
  font-size: 1.8rem;
  font-weight: 700;
  color: var(--pure-white);
  line-height: 1;
}

.stat-label {
  font-size: 0.75rem;
  color: var(--muted);
  margin-top: 4px;
  text-transform: uppercase;
  letter-spacing: 0.05em;
}

.stat-divider {
  width: 1px;
  height: 32px;
  background: var(--border);
}

/* Search + Filter bar */
.filter-bar {
  position: sticky;
  top: 68px;
  z-index: 100;
  background: rgba(10,10,10,0.9);
  backdrop-filter: blur(20px);
  border-bottom: 1px solid var(--border);
  padding: 0 32px;
}

.filter-inner {
  max-width: 1400px;
  margin: 0 auto;
  display: flex;
  align-items: center;
  gap: 16px;
  height: 60px;
  overflow-x: auto;
  scrollbar-width: none;
}

.filter-inner::-webkit-scrollbar { display: none; }

.filter-btn {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  padding: 7px 16px;
  border-radius: 99px;
  border: 1px solid var(--border);
  background: transparent;
  color: var(--silver);
  font-family: 'DM Sans', sans-serif;
  font-size: 0.82rem;
  font-weight: 500;
  cursor: pointer;
  transition: all 0.2s;
  white-space: nowrap;
  text-decoration: none;
}

.filter-btn:hover {
  border-color: var(--soft);
  color: var(--pure-white);
  background: rgba(255,255,255,0.05);
}

.filter-btn.active {
  background: var(--pure-white);
  color: var(--black);
  border-color: var(--pure-white);
  font-weight: 600;
}

/* Gallery grid — Masonry/Pinterest style */
.gallery-section {
  padding: 32px 32px 60px;
  max-width: 1400px;
  margin: 0 auto;
}

/* Masonry columns */
.masonry-grid {
  columns: 5 240px;
  column-gap: 16px;
}

.masonry-item {
  break-inside: avoid;
  margin-bottom: 16px;
  position: relative;
  border-radius: var(--radius);
  overflow: hidden;
  cursor: pointer;
  background: var(--dark);
  box-shadow: var(--shadow-card);
  transition: transform 0.35s cubic-bezier(0.34,1.56,0.64,1), box-shadow 0.35s ease;
  opacity: 0;
  animation: fadeInUp 0.5s ease forwards;
}

.masonry-item:hover {
  transform: translateY(-4px) scale(1.01);
  box-shadow: var(--shadow-hover);
  z-index: 10;
}

@keyframes fadeInUp {
  from { opacity: 0; transform: translateY(20px); }
  to   { opacity: 1; transform: translateY(0); }
}

/* Stagger delays */
.masonry-item:nth-child(1)  { animation-delay: 0.05s; }
.masonry-item:nth-child(2)  { animation-delay: 0.10s; }
.masonry-item:nth-child(3)  { animation-delay: 0.15s; }
.masonry-item:nth-child(4)  { animation-delay: 0.20s; }
.masonry-item:nth-child(5)  { animation-delay: 0.25s; }
.masonry-item:nth-child(6)  { animation-delay: 0.30s; }
.masonry-item:nth-child(7)  { animation-delay: 0.35s; }
.masonry-item:nth-child(8)  { animation-delay: 0.40s; }
.masonry-item:nth-child(9)  { animation-delay: 0.45s; }
.masonry-item:nth-child(10) { animation-delay: 0.50s; }
.masonry-item:nth-child(n+11) { animation-delay: 0.55s; }

.item-img-wrap {
  position: relative;
  display: block;
  background: var(--dark);
}

.item-img-wrap img {
  width: 100%;
  height: auto;
  display: block;
  transition: transform 0.5s ease;
}

.masonry-item:hover .item-img-wrap img {
  transform: scale(1.04);
}

/* Overlay on hover */
.item-overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(
    to top,
    rgba(0,0,0,0.85) 0%,
    rgba(0,0,0,0.3) 50%,
    rgba(0,0,0,0) 100%
  );
  opacity: 0;
  transition: opacity 0.3s ease;
  display: flex;
  flex-direction: column;
  justify-content: flex-end;
  padding: 20px;
}

.masonry-item:hover .item-overlay { opacity: 1; }

.overlay-info {}

.overlay-cat {
  display: inline-block;
  padding: 3px 10px;
  background: rgba(255,255,255,0.15);
  backdrop-filter: blur(8px);
  border-radius: 99px;
  font-size: 0.7rem;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.06em;
  color: var(--pure-white);
  margin-bottom: 8px;
}

.overlay-title {
  font-family: 'Playfair Display', serif;
  font-size: 1.05rem;
  font-weight: 600;
  color: var(--pure-white);
  line-height: 1.3;
  margin-bottom: 12px;
}

.overlay-actions {
  display: flex;
  align-items: center;
  gap: 8px;
}

.overlay-btn {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  padding: 7px 14px;
  border-radius: var(--radius-sm);
  font-size: 0.78rem;
  font-weight: 600;
  transition: all 0.2s;
  cursor: pointer;
  text-decoration: none;
}

.btn-view {
  background: var(--pure-white);
  color: var(--black);
}

.btn-view:hover {
  background: var(--accent);
}

.btn-edit {
  background: rgba(255,255,255,0.15);
  backdrop-filter: blur(8px);
  color: var(--pure-white);
  border: 1px solid rgba(255,255,255,0.2);
}

.btn-edit:hover {
  background: rgba(255,255,255,0.25);
}

.btn-del {
  background: rgba(239,68,68,0.2);
  backdrop-filter: blur(8px);
  color: #fca5a5;
  border: 1px solid rgba(239,68,68,0.3);
  margin-left: auto;
}

.btn-del:hover {
  background: rgba(239,68,68,0.35);
}

/* Color accent line at top */
.item-accent {
  position: absolute;
  top: 0; left: 0; right: 0;
  height: 3px;
  opacity: 0;
  transition: opacity 0.3s;
}

.masonry-item:hover .item-accent { opacity: 1; }

/* Skeleton placeholder for no-image */
.item-skeleton {
  width: 100%;
  min-height: 180px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 2rem;
  color: var(--muted);
  background: linear-gradient(135deg, var(--dark) 0%, var(--mid) 100%);
}

/* Empty state */
.empty-state {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  min-height: 400px;
  text-align: center;
  gap: 20px;
}

.empty-icon {
  width: 90px; height: 90px;
  border-radius: 50%;
  background: var(--dark);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 2rem;
  color: var(--muted);
  border: 2px dashed var(--border);
}

.empty-title {
  font-family: 'Playfair Display', serif;
  font-size: 1.6rem;
  color: var(--light);
}

.empty-sub { color: var(--muted); font-size: 0.9rem; }

/* Upload CTA button */
.btn-cta {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  padding: 13px 28px;
  background: var(--pure-white);
  color: var(--black);
  border-radius: var(--radius);
  font-weight: 600;
  font-size: 0.9rem;
  transition: all 0.25s;
}

.btn-cta:hover {
  background: var(--accent);
  transform: translateY(-2px);
  box-shadow: 0 8px 32px rgba(232,213,163,0.25);
}

/* Lightbox */
.lightbox {
  position: fixed;
  inset: 0;
  z-index: 9999;
  display: flex;
  align-items: center;
  justify-content: center;
  background: rgba(0,0,0,0.92);
  backdrop-filter: blur(12px);
  opacity: 0;
  pointer-events: none;
  transition: opacity 0.3s;
}

.lightbox.open {
  opacity: 1;
  pointer-events: all;
}

.lightbox-inner {
  position: relative;
  max-width: 90vw;
  max-height: 90vh;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 16px;
  transform: scale(0.92);
  transition: transform 0.35s cubic-bezier(0.34,1.56,0.64,1);
}

.lightbox.open .lightbox-inner { transform: scale(1); }

.lightbox-img {
  max-width: 85vw;
  max-height: 75vh;
  object-fit: contain;
  border-radius: var(--radius);
  box-shadow: 0 24px 80px rgba(0,0,0,0.8);
}

.lightbox-info {
  text-align: center;
  color: var(--light);
}

.lightbox-title {
  font-family: 'Playfair Display', serif;
  font-size: 1.2rem;
  margin-bottom: 4px;
}

.lightbox-desc { font-size: 0.85rem; color: var(--soft); max-width: 500px; }

.lightbox-close {
  position: fixed;
  top: 20px; right: 24px;
  width: 44px; height: 44px;
  border-radius: 50%;
  background: rgba(255,255,255,0.1);
  border: 1px solid rgba(255,255,255,0.15);
  color: var(--pure-white);
  font-size: 1.2rem;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: all 0.2s;
}

.lightbox-close:hover {
  background: rgba(255,255,255,0.2);
  transform: rotate(90deg);
}

/* Confirm delete modal */
.modal-overlay {
  position: fixed;
  inset: 0;
  z-index: 9998;
  background: rgba(0,0,0,0.7);
  backdrop-filter: blur(8px);
  display: flex;
  align-items: center;
  justify-content: center;
  opacity: 0;
  pointer-events: none;
  transition: opacity 0.25s;
}

.modal-overlay.open { opacity: 1; pointer-events: all; }

.modal-box {
  background: var(--dark);
  border: 1px solid var(--border);
  border-radius: var(--radius-lg);
  padding: 32px;
  max-width: 400px;
  width: 90%;
  text-align: center;
  transform: scale(0.9);
  transition: transform 0.3s cubic-bezier(0.34,1.56,0.64,1);
}

.modal-overlay.open .modal-box { transform: scale(1); }

.modal-icon {
  width: 56px; height: 56px;
  border-radius: 50%;
  background: rgba(239,68,68,0.15);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.4rem;
  color: #ef4444;
  margin: 0 auto 20px;
}

.modal-title {
  font-family: 'Playfair Display', serif;
  font-size: 1.3rem;
  color: var(--pure-white);
  margin-bottom: 10px;
}

.modal-text { color: var(--soft); font-size: 0.9rem; margin-bottom: 28px; line-height: 1.5; }

.modal-actions { display: flex; gap: 12px; justify-content: center; }

.btn-cancel {
  padding: 10px 24px;
  border-radius: var(--radius-sm);
  background: var(--mid);
  color: var(--light);
  border: none;
  cursor: pointer;
  font-family: 'DM Sans', sans-serif;
  font-size: 0.9rem;
  transition: all 0.2s;
}

.btn-cancel:hover { background: var(--muted); }

.btn-confirm-del {
  padding: 10px 24px;
  border-radius: var(--radius-sm);
  background: #ef4444;
  color: white;
  border: none;
  cursor: pointer;
  font-family: 'DM Sans', sans-serif;
  font-size: 0.9rem;
  font-weight: 600;
  transition: all 0.2s;
}

.btn-confirm-del:hover { background: #dc2626; }

/* Loading skeleton shimmer */
@keyframes shimmer {
  0% { background-position: -400px 0; }
  100% { background-position: 400px 0; }
}

.shimmer {
  background: linear-gradient(90deg, var(--dark) 25%, var(--mid) 50%, var(--dark) 75%);
  background-size: 800px 100%;
  animation: shimmer 1.5s infinite;
}

/* Back-to-top */
.back-to-top {
  position: fixed;
  bottom: 28px; right: 28px;
  width: 44px; height: 44px;
  border-radius: 50%;
  background: var(--pure-white);
  color: var(--black);
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  opacity: 0;
  transform: translateY(20px);
  transition: all 0.3s;
  box-shadow: 0 4px 20px rgba(0,0,0,0.4);
  z-index: 500;
  border: none;
  font-size: 1rem;
}

.back-to-top.visible {
  opacity: 1;
  transform: translateY(0);
}

.back-to-top:hover {
  background: var(--accent);
  transform: translateY(-3px);
}

@media (max-width: 768px) {
  .gallery-hero { padding: 48px 20px 36px; }
  .filter-bar { padding: 0 16px; }
  .gallery-section { padding: 24px 16px 48px; }
  .masonry-grid { columns: 2 150px; column-gap: 10px; }
  .masonry-item { margin-bottom: 10px; }
  .hero-stats { gap: 20px; }
}
</style>

<!-- Hero -->
<section class="gallery-hero">
  <div class="hero-eyebrow">Our Collection</div>
  <h1>Explore <em>The Best</em> Moment</h1>
  <p class="hero-sub">Discover visual inspiration from our ever growing curated Image collection</p>
  <div class="hero-stats">
    <div class="stat-item">
      <div class="stat-num"><?= $totalGambar ?></div>
      <div class="stat-label">Image</div>
    </div>
    <div class="stat-divider"></div>
    <div class="stat-item">
      <div class="stat-num"><?= count($kategoriList) - 1 ?></div>
      <div class="stat-label">Category</div>
    </div>
    <div class="stat-divider"></div>
    <div class="stat-item">
      <div class="stat-num">Free</div>
      <div class="stat-label">Access</div>
    </div>
  </div>
</section>

<!-- Filter Bar -->
<div class="filter-bar">
  <div class="filter-inner">
    <?php foreach ($kategoriList as $kat): ?>
    <a href="<?= $kat === 'Semua' ? base_url('galeri') : base_url('galeri?kategori=' . urlencode($kat)) ?>"
       class="filter-btn <?= $aktifKat === $kat ? 'active' : '' ?>">
      <?php
        $icons = [
          'Semua' => 'fa-th', 'Nature' => 'fa-leaf', 'Arsitektur' => 'fa-building',
          'Teknologi' => 'fa-microchip', 'Seni' => 'fa-palette', 'Olahraga' => 'fa-running',
          'Kuliner' => 'fa-utensils', 'Fashion' => 'fa-tshirt', 'Travel' => 'fa-globe', 'Umum' => 'fa-star',
        ];
        $ico = isset($icons[$kat]) ? $icons[$kat] : 'fa-tag';
      ?>
      <i class="fas <?= $ico ?>"></i>
      <?= htmlspecialchars($kat) ?>
    </a>
    <?php endforeach; ?>
  </div>
</div>

<!-- Gallery -->
<section class="gallery-section">
  <?php if (empty($gambar)): ?>
    <div class="empty-state">
      <div class="empty-icon"><i class="fas fa-images"></i></div>
      <h2 class="empty-title">No photos yet</h2>
      <p class="empty-sub">
        <?= $aktifKat !== 'Semua' ? "Tidak ada foto dalam kategori <strong>{$aktifKat}</strong>" : "Mulai bagikan foto pertama Anda" ?>
      </p>
      <a href="<?= base_url('galeri/create') ?>" class="btn-cta">
        <i class="fas fa-plus"></i> Upload First Photo
      </a>
    </div>
  <?php else: ?>
  <div class="masonry-grid" id="masonryGrid">
    <?php foreach ($gambar as $g): ?>
    <?php $imgPath = base_url('upload/images/' . $g['filename']); ?>
    <div class="masonry-item">
      <div class="item-accent" style="background: <?= htmlspecialchars($g['warna'] ?? '#6C63FF') ?>;"></div>

      <!-- Image -->
      <div class="item-img-wrap">
        <?php if (!empty($g['filename'])): ?>
        <img
          src="<?= $imgPath ?>"
          alt="<?= htmlspecialchars($g['judul']) ?>"
          loading="lazy"
          onerror="this.parentElement.innerHTML='<div class=\'item-skeleton\'><i class=\'fas fa-image\'></i></div>'"
        >
        <?php else: ?>
        <div class="item-skeleton" style="background: <?= htmlspecialchars($g['warna'] ?? '#1a1a1a') ?>22;">
          <i class="fas fa-image"></i>
        </div>
        <?php endif; ?>

        <!-- Hover Overlay -->
        <div class="item-overlay">
          <div class="overlay-info">
            <span class="overlay-cat"><?= htmlspecialchars($g['kategori']) ?></span>
            <div class="overlay-title"><?= htmlspecialchars($g['judul']) ?></div>
            <div class="overlay-actions">
              <!-- Quick view (lightbox) -->
              <button class="overlay-btn btn-view"
                onclick="openLightbox('<?= $imgPath ?>', '<?= addslashes(htmlspecialchars($g['judul'])) ?>', '<?= addslashes(htmlspecialchars($g['deskripsi'])) ?>')"
              >
                <i class="fas fa-expand-alt"></i> View
              </button>
              <!-- Detail -->
              <a href="<?= base_url('galeri/detail/' . $g['id']) ?>" class="overlay-btn btn-edit">
                <i class="fas fa-arrow-right"></i>
              </a>
              <!-- Edit -->
              <a href="<?= base_url('galeri/edit/' . $g['id']) ?>" class="overlay-btn btn-edit">
                <i class="fas fa-pen"></i>
              </a>
              <!-- Delete -->
              <button class="overlay-btn btn-del"
                onclick="confirmDelete(<?= $g['id'] ?>, '<?= addslashes(htmlspecialchars($g['judul'])) ?>')"
              >
                <i class="fas fa-trash"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
  <?php endif; ?>
</section>

<!-- Upload FAB (mobile) -->
<a href="<?= base_url('galeri/create') ?>" class="back-to-top" id="fabUpload" title="Upload Foto" style="bottom:80px; background: var(--accent); color: var(--black);">
  <i class="fas fa-plus"></i>
</a>

<!-- Back to top -->
<button class="back-to-top" id="backTop" onclick="window.scrollTo({top:0,behavior:'smooth'})">
  <i class="fas fa-arrow-up"></i>
</button>

<!-- Lightbox -->
<div class="lightbox" id="lightbox" onclick="closeLightbox(event)">
  <button class="lightbox-close" onclick="closeLightbox()"><i class="fas fa-times"></i></button>
  <div class="lightbox-inner">
    <img src="" alt="" class="lightbox-img" id="lightboxImg">
    <div class="lightbox-info">
      <div class="lightbox-title" id="lightboxTitle"></div>
      <div class="lightbox-desc" id="lightboxDesc"></div>
    </div>
  </div>
</div>

<!-- Delete Modal -->
<div class="modal-overlay" id="deleteModal">
  <div class="modal-box">
    <div class="modal-icon"><i class="fas fa-trash"></i></div>
    <div class="modal-title">Delete Photo?</div>
    <div class="modal-text" id="deleteModalText">This photo will be permanently deleted.</div>
    <div class="modal-actions">
      <button class="btn-cancel" onclick="closeDeleteModal()">Cancel</button>
      <a href="#" class="btn-confirm-del" id="deleteConfirmLink">Yes, Delete</a>
    </div>
  </div>
</div>

<script>
  // Back-to-top & FAB visibility
  const backTop = document.getElementById('backTop');
  const fabUpload = document.getElementById('fabUpload');
  window.addEventListener('scroll', () => {
    const show = window.scrollY > 400;
    backTop.classList.toggle('visible', show);
    fabUpload.classList.toggle('visible', show);
  });

  // Lightbox
  function openLightbox(src, title, desc) {
    document.getElementById('lightboxImg').src = src;
    document.getElementById('lightboxTitle').textContent = title;
    document.getElementById('lightboxDesc').textContent = desc;
    document.getElementById('lightbox').classList.add('open');
    document.body.style.overflow = 'hidden';
  }

  function closeLightbox(e) {
    if (!e || e.target === document.getElementById('lightbox') || e.currentTarget.classList.contains('lightbox-close')) {
      document.getElementById('lightbox').classList.remove('open');
      document.body.style.overflow = '';
    }
  }

  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
      closeLightbox();
      closeDeleteModal();
    }
  });

  // Delete modal
  function confirmDelete(id, title) {
    document.getElementById('deleteModalText').textContent = `"${title}" akan dihapus secara permanen dan tidak bisa dikembalikan.`;
    document.getElementById('deleteConfirmLink').href = '<?= base_url('galeri/delete/') ?>' + id;
    document.getElementById('deleteModal').classList.add('open');
    document.body.style.overflow = 'hidden';
  }

  function closeDeleteModal() {
    document.getElementById('deleteModal').classList.remove('open');
    document.body.style.overflow = '';
  }

  document.getElementById('deleteModal').addEventListener('click', function(e) {
    if (e.target === this) closeDeleteModal();
  });
</script>
