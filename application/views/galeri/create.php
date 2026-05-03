<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<style>
/* CREATE / UPLOAD PAGE */
.form-page {
  max-width: 900px;
  margin: 0 auto;
  padding: 48px 32px 80px;
}

.form-back {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  color: var(--soft);
  font-size: 0.875rem;
  margin-bottom: 32px;
  transition: color 0.2s;
  text-decoration: none;
}

.form-back:hover { color: var(--pure-white); }

.form-header {
  margin-bottom: 40px;
}

.form-eyebrow {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 5px 14px;
  background: rgba(232,213,163,0.1);
  border: 1px solid rgba(232,213,163,0.2);
  border-radius: 99px;
  font-size: 0.75rem;
  font-weight: 600;
  letter-spacing: 0.08em;
  text-transform: uppercase;
  color: var(--accent);
  margin-bottom: 16px;
}

.form-title {
  font-family: 'Playfair Display', serif;
  font-size: clamp(1.8rem, 3vw, 2.5rem);
  font-weight: 700;
  color: var(--pure-white);
  letter-spacing: -0.02em;
  line-height: 1.2;
  margin-bottom: 8px;
}

.form-sub { color: var(--soft); font-size: 0.9rem; }

/* Form layout */
.form-grid {
  display: grid;
  grid-template-columns: 1fr 340px;
  gap: 24px;
  align-items: start;
}

.form-card {
  background: var(--dark);
  border: 1px solid var(--border);
  border-radius: var(--radius-lg);
  padding: 28px;
  transition: border-color 0.2s;
}

.form-card:focus-within { border-color: rgba(255,255,255,0.15); }

.form-section-title {
  font-size: 0.75rem;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.08em;
  color: var(--muted);
  margin-bottom: 20px;
  display: flex;
  align-items: center;
  gap: 10px;
}

.form-section-title::after {
  content: '';
  flex: 1;
  height: 1px;
  background: var(--border);
}

/* Upload drop zone */
.drop-zone {
  border: 2px dashed var(--border);
  border-radius: var(--radius);
  padding: 40px 20px;
  text-align: center;
  cursor: pointer;
  transition: all 0.3s;
  position: relative;
  background: rgba(255,255,255,0.02);
}

.drop-zone:hover,
.drop-zone.dragover {
  border-color: var(--accent);
  background: rgba(232,213,163,0.05);
}

.drop-zone input[type="file"] {
  position: absolute;
  inset: 0;
  opacity: 0;
  cursor: pointer;
  width: 100%;
  height: 100%;
}

.drop-icon {
  width: 56px; height: 56px;
  border-radius: 50%;
  background: var(--mid);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.4rem;
  color: var(--muted);
  margin: 0 auto 16px;
  transition: all 0.3s;
}

.drop-zone:hover .drop-icon,
.drop-zone.dragover .drop-icon {
  background: rgba(232,213,163,0.15);
  color: var(--accent);
}

.drop-title {
  font-weight: 600;
  color: var(--light);
  margin-bottom: 6px;
}

.drop-sub {
  font-size: 0.8rem;
  color: var(--muted);
}

.drop-formats {
  display: flex;
  gap: 8px;
  justify-content: center;
  margin-top: 16px;
  flex-wrap: wrap;
}

.fmt-badge {
  padding: 3px 10px;
  border-radius: 99px;
  background: var(--mid);
  font-size: 0.7rem;
  color: var(--soft);
  font-weight: 600;
  text-transform: uppercase;
}

/* Preview */
.preview-wrap {
  display: none;
  position: relative;
  border-radius: var(--radius);
  overflow: hidden;
  margin-top: 16px;
}

.preview-wrap img {
  width: 100%;
  height: auto;
  max-height: 300px;
  object-fit: cover;
}

.preview-remove {
  position: absolute;
  top: 8px; right: 8px;
  width: 32px; height: 32px;
  border-radius: 50%;
  background: rgba(0,0,0,0.6);
  border: 1px solid rgba(255,255,255,0.2);
  color: var(--pure-white);
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  font-size: 0.85rem;
  transition: all 0.2s;
}

.preview-remove:hover { background: rgba(239,68,68,0.6); }

/* Form fields */
.field-group {
  margin-bottom: 20px;
}

.field-label {
  display: block;
  font-size: 0.8rem;
  font-weight: 600;
  color: var(--silver);
  margin-bottom: 8px;
  letter-spacing: 0.01em;
}

.field-label .required { color: #ef4444; margin-left: 2px; }

.field-input,
.field-textarea,
.field-select {
  width: 100%;
  padding: 12px 14px;
  background: rgba(255,255,255,0.04);
  border: 1px solid var(--border);
  border-radius: var(--radius-sm);
  color: var(--pure-white);
  font-family: 'DM Sans', sans-serif;
  font-size: 0.9rem;
  transition: all 0.2s;
  outline: none;
}

.field-input:focus,
.field-textarea:focus,
.field-select:focus {
  border-color: rgba(232,213,163,0.4);
  background: rgba(232,213,163,0.04);
  box-shadow: 0 0 0 3px rgba(232,213,163,0.08);
}

.field-input::placeholder,
.field-textarea::placeholder { color: var(--muted); }

.field-textarea { resize: vertical; min-height: 110px; line-height: 1.6; }

.field-select {
  cursor: pointer;
  appearance: none;
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath fill='%23888' d='M1 1l5 5 5-5'/%3E%3C/svg%3E");
  background-repeat: no-repeat;
  background-position: right 12px center;
  padding-right: 36px;
}

.field-select option { background: var(--dark); }

.field-hint {
  font-size: 0.75rem;
  color: var(--muted);
  margin-top: 6px;
}

/* Color picker */
.color-picker-group {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
  margin-top: 4px;
}

.color-swatch-btn {
  width: 30px; height: 30px;
  border-radius: 50%;
  border: 2px solid transparent;
  cursor: pointer;
  transition: all 0.2s;
  position: relative;
}

.color-swatch-btn:hover { transform: scale(1.15); }

.color-swatch-btn.selected {
  border-color: var(--pure-white);
  box-shadow: 0 0 0 2px rgba(255,255,255,0.2);
}

.color-swatch-btn.selected::after {
  content: '✓';
  position: absolute;
  inset: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 0.65rem;
  color: white;
  font-weight: 700;
}

/* Submit */
.btn-submit {
  width: 100%;
  padding: 14px;
  border-radius: var(--radius);
  background: var(--pure-white);
  color: var(--black);
  font-family: 'DM Sans', sans-serif;
  font-size: 0.95rem;
  font-weight: 700;
  border: none;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 10px;
  transition: all 0.25s;
  margin-top: 24px;
}

.btn-submit:hover {
  background: var(--accent);
  box-shadow: 0 4px 24px rgba(232,213,163,0.25);
  transform: translateY(-1px);
}

.btn-submit:active { transform: translateY(0); }

.btn-submit .spinner {
  display: none;
  width: 18px; height: 18px;
  border: 2px solid rgba(0,0,0,0.2);
  border-top-color: var(--black);
  border-radius: 50%;
  animation: spin 0.7s linear infinite;
}

@keyframes spin { to { transform: rotate(360deg); } }

/* Char counter */
.char-counter {
  font-size: 0.72rem;
  color: var(--muted);
  text-align: right;
  margin-top: 4px;
}

.char-counter.warn { color: #f59e0b; }
.char-counter.over { color: #ef4444; }

@media (max-width: 768px) {
  .form-grid { grid-template-columns: 1fr; }
  .form-page { padding: 32px 16px 60px; }
}
</style>

<div class="form-page">
  <a href="<?= base_url('galeri') ?>" class="form-back">
    <i class="fas fa-arrow-left"></i> Back
  </a>

  <div class="form-header">
    <div class="form-eyebrow"><i class="fas fa-upload"></i> Upload New Image </div>
    <h1 class="form-title">Add Photo to Gallery</h1>
    <p class="form-sub">Share your photo with the community.</p>
  </div>

  <form action="<?= base_url('galeri/store') ?>" method="POST" enctype="multipart/form-data" id="uploadForm" novalidate>

    <div class="form-grid">
      <!--Left: main fields -->
      <div>
        <div class="form-card" style="margin-bottom:16px;">
          <div class="form-section-title">Image Info</div>

          <!-- Judul -->
          <div class="field-group">
            <label class="field-label" for="judul"> Title <span class="required">*</span></label>
            <input type="text" id="judul" name="judul" class="field-input"
              placeholder="Berikan judul yang menarik..."
              maxlength="150" required>
            <div class="char-counter" id="judulCounter">0 / 150</div>
          </div>

          <!-- Deskripsi -->
          <div class="field-group">
            <label class="field-label" for="deskripsi"> Description <span class="required">*</span></label>
            <textarea id="deskripsi" name="deskripsi" class="field-textarea"
              placeholder="Ceritakan tentang foto ini..." rows="4" required></textarea>
          </div>

          <!-- Kategori -->
          <div class="field-group" style="margin-bottom:0;">
            <label class="field-label" for="kategori"> Category <span class="required">*</span></label>
            <select id="kategori" name="kategori" class="field-select" required>
              <option value="" disabled selected>Select category...</option>
              <?php foreach ($kategoriList as $kat): ?>
              <option value="<?= htmlspecialchars($kat) ?>"><?= htmlspecialchars($kat) ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>

        <!-- Upload zone -->
        <div class="form-card">
          <div class="form-section-title">Photo File</div>

          <div class="drop-zone" id="dropZone">
            <input type="file" name="gambar" id="gambarInput" accept="image/*" required>
            <div class="drop-icon"><i class="fas fa-cloud-upload-alt"></i></div>
            <div class="drop-title">Drag & drop or click to select</div>
            <div class="drop-sub">Maximum size 15 MB</div>
            <div class="drop-formats">
              <span class="fmt-badge">JPG</span>
              <span class="fmt-badge">PNG</span>
              <span class="fmt-badge">GIF</span>
              <span class="fmt-badge">WebP</span>
            </div>
          </div>

          <div class="preview-wrap" id="previewWrap">
            <img src="" alt="Preview" id="previewImg">
            <button type="button" class="preview-remove" onclick="removePreview()">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Right: sidebar -->
      <div>
        <div class="form-card" style="margin-bottom:16px;">
          <div class="form-section-title">Accent Color</div>
          <p class="field-hint" style="margin-bottom:14px;">Choose an accent color for this photo card.</p>

          <div class="color-picker-group" id="colorPicker">
            <?php
              $defaultWarna = $warnaList[0];
              foreach ($warnaList as $i => $w):
            ?>
            <button type="button"
              class="color-swatch-btn <?= $i === 0 ? 'selected' : '' ?>"
              style="background: <?= htmlspecialchars($w) ?>;"
              data-color="<?= htmlspecialchars($w) ?>"
              onclick="selectColor(this)"
              title="<?= htmlspecialchars($w) ?>">
            </button>
            <?php endforeach; ?>
          </div>
          <input type="hidden" name="warna" id="warnaInput" value="<?= htmlspecialchars($defaultWarna) ?>">

          <div class="color-swatch" style="margin-top:16px;">
            <div class="swatch" id="colorPreview" style="background:<?= htmlspecialchars($defaultWarna) ?>;"></div>
            <span class="swatch-label" id="colorLabel"><?= htmlspecialchars($defaultWarna) ?></span>
          </div>
        </div>

        <div class="form-card">
          <div class="form-section-title">Actions</div>
          <button type="submit" class="btn-submit" id="submitBtn">
            <span class="spinner" id="spinner"></span>
            <i class="fas fa-upload" id="submitIcon"></i>
            <span id="submitText">Upload Photo</span>
          </button>
          <a href="<?= base_url('galeri') ?>" style="display:block; text-align:center; margin-top:12px; color:var(--muted); font-size:0.85rem; transition:color 0.2s;" onmouseover="this.style.color='var(--light)'" onmouseout="this.style.color='var(--muted)'">
            Batal
          </a>
        </div>
      </div>
    </div>

  </form>
</div>

<script>
  // Char counter
  const judulInput = document.getElementById('judul');
  const counter = document.getElementById('judulCounter');
  judulInput.addEventListener('input', () => {
    const len = judulInput.value.length;
    counter.textContent = `${len} / 150`;
    counter.className = 'char-counter' + (len > 140 ? ' warn' : '') + (len >= 150 ? ' over' : '');
  });

  // File preview
  const gambarInput = document.getElementById('gambarInput');
  const dropZone = document.getElementById('dropZone');
  const previewWrap = document.getElementById('previewWrap');
  const previewImg = document.getElementById('previewImg');

  gambarInput.addEventListener('change', () => showPreview(gambarInput.files[0]));

  function showPreview(file) {
    if (!file || !file.type.startsWith('image/')) return;
    const reader = new FileReader();
    reader.onload = (e) => {
      previewImg.src = e.target.result;
      previewWrap.style.display = 'block';
      dropZone.style.display = 'none';
    };
    reader.readAsDataURL(file);
  }

  function removePreview() {
    gambarInput.value = '';
    previewWrap.style.display = 'none';
    dropZone.style.display = 'block';
    previewImg.src = '';
  }

  // Drag & drop
  ['dragenter','dragover'].forEach(e => {
    dropZone.addEventListener(e, (ev) => { ev.preventDefault(); dropZone.classList.add('dragover'); });
  });

  ['dragleave','drop'].forEach(e => {
    dropZone.addEventListener(e, (ev) => { ev.preventDefault(); dropZone.classList.remove('dragover'); });
  });

  dropZone.addEventListener('drop', (ev) => {
    const file = ev.dataTransfer.files[0];
    if (file) {
      const dt = new DataTransfer();
      dt.items.add(file);
      gambarInput.files = dt.files;
      showPreview(file);
    }
  });

  // Color picker
  function selectColor(btn) {
    document.querySelectorAll('.color-swatch-btn').forEach(b => b.classList.remove('selected'));
    btn.classList.add('selected');
    const color = btn.dataset.color;
    document.getElementById('warnaInput').value = color;
    document.getElementById('colorPreview').style.background = color;
    document.getElementById('colorLabel').textContent = color;
  }

  // Submit loading state
  document.getElementById('uploadForm').addEventListener('submit', function(e) {
    const judul = document.getElementById('judul').value.trim();
    const deskripsi = document.getElementById('deskripsi').value.trim();
    const kat = document.getElementById('kategori').value;
    const file = gambarInput.files[0];

    if (!judul || !deskripsi || !kat || !file) {
      e.preventDefault();
      alert('Mohon lengkapi semua field yang wajib diisi.');
      return;
    }

    document.getElementById('submitIcon').style.display = 'none';
    document.getElementById('spinner').style.display = 'block';
    document.getElementById('submitText').textContent = 'Mengupload...';
    document.getElementById('submitBtn').disabled = true;
  });
</script>
