<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<style>
/* DETAIL PAGE */
.detail-page {
  max-width: 1200px;
  margin: 0 auto;
  padding: 48px 32px 80px;
}

.detail-back {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  color: var(--soft);
  font-size: 0.875rem;
  margin-bottom: 32px;
  transition: color 0.2s;
}

.detail-back:hover { color: var(--pure-white); }
.detail-back i { font-size: 0.8rem; }

.detail-layout {
  display: grid;
  grid-template-columns: 1fr 380px;
  gap: 40px;
  align-items: start;
}

/* Image */
.detail-img-wrap {
  position: relative;
  border-radius: var(--radius-lg);
  overflow: hidden;
  background: var(--dark);
  box-shadow: var(--shadow-card);
}

.detail-img-wrap::before {
  content: '';
  position: absolute;
  top: 0; left: 0; right: 0;
  height: 4px;
  background: <?= htmlspecialchars($gambar['warna'] ?? '#6C63FF') ?>;
  z-index: 1;
}

.detail-img-wrap img {
  width: 100%;
  height: auto;
  display: block;
  max-height: 80vh;
  object-fit: contain;
}

.detail-img-placeholder {
  width: 100%;
  min-height: 400px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 4rem;
  color: var(--muted);
  background: var(--dark);
}

/* Sidebar */
.detail-sidebar {
  position: sticky;
  top: calc(68px + 24px);
}

.sidebar-card {
  background: var(--dark);
  border: 1px solid var(--border);
  border-radius: var(--radius-lg);
  padding: 28px;
  margin-bottom: 16px;
}

.detail-cat {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  padding: 5px 14px;
  border-radius: 99px;
  background: rgba(255,255,255,0.07);
  border: 1px solid rgba(255,255,255,0.1);
  font-size: 0.75rem;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.07em;
  color: var(--silver);
  margin-bottom: 16px;
}

.detail-title {
  font-family: 'Playfair Display', serif;
  font-size: 1.7rem;
  font-weight: 700;
  color: var(--pure-white);
  line-height: 1.25;
  letter-spacing: -0.02em;
  margin-bottom: 16px;
}

.detail-meta {
  display: flex;
  flex-direction: column;
  gap: 8px;
  padding: 16px 0;
  border-top: 1px solid var(--border);
  border-bottom: 1px solid var(--border);
  margin-bottom: 20px;
}

.meta-row {
  display: flex;
  align-items: center;
  gap: 8px;
  font-size: 0.8rem;
  color: var(--muted);
}

.meta-row i { width: 16px; text-align: center; color: var(--soft); }
.meta-row strong { color: var(--silver); }

.detail-desc {
  color: var(--soft);
  font-size: 0.9rem;
  line-height: 1.7;
}

/* Color swatch */
.color-swatch {
  display: flex;
  align-items: center;
  gap: 10px;
  margin-top: 16px;
}

.swatch {
  width: 24px; height: 24px;
  border-radius: 50%;
  border: 2px solid var(--border);
  flex-shrink: 0;
}

.swatch-label { font-size: 0.8rem; color: var(--muted); font-family: monospace; }

/* Action buttons */
.detail-actions {
  display: flex;
  flex-direction: column;
  gap: 10px;
}

.btn-action {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 10px;
  padding: 13px;
  border-radius: var(--radius);
  font-size: 0.9rem;
  font-weight: 600;
  transition: all 0.2s;
  cursor: pointer;
  text-decoration: none;
  font-family: 'DM Sans', sans-serif;
  border: none;
}

.btn-primary-action {
  background: var(--pure-white);
  color: var(--black);
}

.btn-primary-action:hover {
  background: var(--accent);
  box-shadow: 0 4px 20px rgba(232,213,163,0.2);
  transform: translateY(-1px);
}

.btn-secondary-action {
  background: rgba(255,255,255,0.06);
  color: var(--silver);
  border: 1px solid var(--border);
}

.btn-secondary-action:hover {
  background: rgba(255,255,255,0.1);
  color: var(--pure-white);
}

.btn-danger-action {
  background: rgba(239,68,68,0.1);
  color: #fca5a5;
  border: 1px solid rgba(239,68,68,0.2);
}

.btn-danger-action:hover {
  background: rgba(239,68,68,0.2);
}

/* Confirm delete overlay */
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
.modal-icon { width:56px; height:56px; border-radius:50%; background:rgba(239,68,68,0.15); display:flex; align-items:center; justify-content:center; font-size:1.4rem; color:#ef4444; margin:0 auto 20px; }
.modal-title { font-family:'Playfair Display',serif; font-size:1.3rem; color:var(--pure-white); margin-bottom:10px; }
.modal-text { color:var(--soft); font-size:0.9rem; margin-bottom:28px; line-height:1.5; }
.modal-actions { display:flex; gap:12px; justify-content:center; }
.btn-cancel { padding:10px 24px; border-radius:var(--radius-sm); background:var(--mid); color:var(--light); border:none; cursor:pointer; font-family:'DM Sans',sans-serif; font-size:0.9rem; transition:all 0.2s; }
.btn-cancel:hover { background:var(--muted); }
.btn-confirm-del { padding:10px 24px; border-radius:var(--radius-sm); background:#ef4444; color:white; border:none; cursor:pointer; font-family:'DM Sans',sans-serif; font-size:0.9rem; font-weight:600; transition:all 0.2s; text-decoration:none; display:inline-block; }
.btn-confirm-del:hover { background:#dc2626; }

@media (max-width: 900px) {
  .detail-layout { grid-template-columns: 1fr; }
  .detail-sidebar { position: static; }
  .detail-page { padding: 32px 20px 60px; }
}
</style>

<div class="detail-page">
  <a href="<?= base_url('galeri') ?>" class="detail-back">
    <i class="fas fa-arrow-left"></i> Back to Gallery
  </a>

  <div class="detail-layout">
    <!-- Image -->
    <div class="detail-img-wrap">
      <?php if (!empty($gambar['filename'])): ?>
      <img
        src="<?= base_url('upload/images/' . $gambar['filename']) ?>"
        alt="<?= htmlspecialchars($gambar['judul']) ?>"
      >
      <?php else: ?>
      <div class="detail-img-placeholder">
        <i class="fas fa-image"></i>
      </div>
      <?php endif; ?>
    </div>

    <!-- Sidebar -->
    <div class="detail-sidebar">
      <!-- Info card -->
      <div class="sidebar-card">
        <span class="detail-cat">
          <i class="fas fa-tag"></i>
          <?= htmlspecialchars($gambar['kategori']) ?>
        </span>

        <h1 class="detail-title"><?= htmlspecialchars($gambar['judul']) ?></h1>

        <div class="detail-meta">
          <div class="meta-row">
            <i class="fas fa-calendar"></i>
            <span>Diunggah <strong><?= date('d M Y', strtotime($gambar['created_at'])) ?></strong></span>
          </div>
          <?php if (!empty($gambar['updated_at']) && $gambar['updated_at'] !== $gambar['created_at']): ?>
          <div class="meta-row">
            <i class="fas fa-edit"></i>
            <span>Diperbarui <strong><?= date('d M Y', strtotime($gambar['updated_at'])) ?></strong></span>
          </div>
          <?php endif; ?>
          <div class="meta-row">
            <i class="fas fa-hashtag"></i>
            <span>ID <strong>#<?= $gambar['id'] ?></strong></span>
          </div>
        </div>

        <p class="detail-desc"><?= nl2br(htmlspecialchars($gambar['deskripsi'])) ?></p>

        <!-- Color swatch -->
        <?php if (!empty($gambar['warna'])): ?>
        <div class="color-swatch">
          <div class="swatch" style="background: <?= htmlspecialchars($gambar['warna']) ?>;"></div>
          <span class="swatch-label"><?= htmlspecialchars($gambar['warna']) ?></span>
        </div>
        <?php endif; ?>
      </div>

      <!-- Actions card -->
      <div class="sidebar-card">
        <div class="detail-actions">
          <a href="<?= base_url('galeri/edit/' . $gambar['id']) ?>" class="btn-action btn-primary-action">
            <i class="fas fa-pen"></i> Edit Photo
          </a>
          <a href="<?= base_url('upload/images/' . $gambar['filename']) ?>" download class="btn-action btn-secondary-action">
            <i class="fas fa-download"></i> Download
          </a>
          <button class="btn-action btn-danger-action" onclick="document.getElementById('deleteModal').classList.add('open'); document.body.style.overflow='hidden'">
            <i class="fas fa-trash"></i> Delete Photo
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Delete Modal -->
<div class="modal-overlay" id="deleteModal">
  <div class="modal-box">
    <div class="modal-icon"><i class="fas fa-trash"></i></div>
    <div class="modal-title">Delete Photo?</div>
    <div class="modal-text">"<?= htmlspecialchars($gambar['judul']) ?>" will be permanently deleted and cannot be recovered.</div>
    <div class="modal-actions">
      <button class="btn-cancel" onclick="document.getElementById('deleteModal').classList.remove('open'); document.body.style.overflow=''">Batal</button>
      <a href="<?= base_url('galeri/delete/' . $gambar['id']) ?>" class="btn-confirm-del">Ya, Hapus</a>
    </div>
  </div>
</div>

<script>
  document.getElementById('deleteModal').addEventListener('click', function(e) {
    if (e.target === this) { this.classList.remove('open'); document.body.style.overflow = ''; }
  });
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') { document.getElementById('deleteModal').classList.remove('open'); document.body.style.overflow = ''; }
  });
</script>
