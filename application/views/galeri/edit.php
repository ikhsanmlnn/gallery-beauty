<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<style>
/* Reuse form styles same structure as create */
.form-page {
  max-width: 900px;
  margin: 0 auto;
  padding: 48px 32px 80px;
}
.form-back { display: inline-flex; align-items: center; gap: 8px; color: var(--soft); font-size: 0.875rem; margin-bottom: 32px; transition: color 0.2s; text-decoration: none; }
.form-back:hover { color: var(--pure-white); }
.form-header { margin-bottom: 40px; }
.form-eyebrow { display: inline-flex; align-items: center; gap: 8px; padding: 5px 14px; background: rgba(232,213,163,0.1); border: 1px solid rgba(232,213,163,0.2); border-radius: 99px; font-size: 0.75rem; font-weight: 600; letter-spacing: 0.08em; text-transform: uppercase; color: var(--accent); margin-bottom: 16px; }
.form-title { font-family: 'Playfair Display', serif; font-size: clamp(1.8rem, 3vw, 2.5rem); font-weight: 700; color: var(--pure-white); letter-spacing: -0.02em; line-height: 1.2; margin-bottom: 8px; }
.form-sub { color: var(--soft); font-size: 0.9rem; }
.form-grid { display: grid; grid-template-columns: 1fr 340px; gap: 24px; align-items: start; }
.form-card { background: var(--dark); border: 1px solid var(--border); border-radius: var(--radius-lg); padding: 28px; transition: border-color 0.2s; }
.form-card:focus-within { border-color: rgba(255,255,255,0.15); }
.form-section-title { font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.08em; color: var(--muted); margin-bottom: 20px; display: flex; align-items: center; gap: 10px; }
.form-section-title::after { content: ''; flex: 1; height: 1px; background: var(--border); }
.field-group { margin-bottom: 20px; }
.field-label { display: block; font-size: 0.8rem; font-weight: 600; color: var(--silver); margin-bottom: 8px; }
.field-label .required { color: #ef4444; margin-left: 2px; }
.field-input, .field-textarea, .field-select { width: 100%; padding: 12px 14px; background: rgba(255,255,255,0.04); border: 1px solid var(--border); border-radius: var(--radius-sm); color: var(--pure-white); font-family: 'DM Sans', sans-serif; font-size: 0.9rem; transition: all 0.2s; outline: none; }
.field-input:focus, .field-textarea:focus, .field-select:focus { border-color: rgba(232,213,163,0.4); background: rgba(232,213,163,0.04); box-shadow: 0 0 0 3px rgba(232,213,163,0.08); }
.field-input::placeholder, .field-textarea::placeholder { color: var(--muted); }
.field-textarea { resize: vertical; min-height: 110px; line-height: 1.6; }
.field-select { cursor: pointer; appearance: none; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath fill='%23888' d='M1 1l5 5 5-5'/%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 12px center; padding-right: 36px; }
.field-select option { background: var(--dark); }
.field-hint { font-size: 0.75rem; color: var(--muted); margin-top: 6px; }

/* Current image preview */
.current-img {
  width: 100%;
  border-radius: var(--radius);
  overflow: hidden;
  margin-bottom: 16px;
  position: relative;
}
.current-img img {
  width: 100%;
  height: 200px;
  object-fit: cover;
}
.current-img-label {
  position: absolute;
  top: 10px; left: 10px;
  padding: 4px 10px;
  background: rgba(0,0,0,0.7);
  backdrop-filter: blur(8px);
  border-radius: 99px;
  font-size: 0.7rem;
  color: var(--silver);
  font-weight: 600;
}

/* New file upload */
.upload-new { border: 2px dashed var(--border); border-radius: var(--radius-sm); padding: 20px; text-align: center; cursor: pointer; transition: all 0.2s; position: relative; background: rgba(255,255,255,0.02); }
.upload-new:hover { border-color: var(--soft); background: rgba(255,255,255,0.04); }
.upload-new input[type="file"] { position: absolute; inset: 0; opacity: 0; cursor: pointer; width: 100%; height: 100%; }
.upload-new-text { font-size: 0.85rem; color: var(--soft); }
.upload-new-text strong { color: var(--light); }

/* New preview */
.new-preview-wrap { display: none; position: relative; border-radius: var(--radius-sm); overflow: hidden; margin-top: 12px; }
.new-preview-wrap img { width: 100%; max-height: 200px; object-fit: cover; }

/* Color picker */
.color-picker-group { display: flex; flex-wrap: wrap; gap: 8px; margin-top: 4px; }
.color-swatch-btn { width: 30px; height: 30px; border-radius: 50%; border: 2px solid transparent; cursor: pointer; transition: all 0.2s; position: relative; }
.color-swatch-btn:hover { transform: scale(1.15); }
.color-swatch-btn.selected { border-color: var(--pure-white); box-shadow: 0 0 0 2px rgba(255,255,255,0.2); }
.color-swatch-btn.selected::after { content: '✓'; position: absolute; inset: 0; display: flex; align-items: center; justify-content: center; font-size: 0.65rem; color: white; font-weight: 700; }
.color-swatch { display: flex; align-items: center; gap: 10px; margin-top: 16px; }
.swatch { width: 24px; height: 24px; border-radius: 50%; border: 2px solid var(--border); }
.swatch-label { font-size: 0.8rem; color: var(--muted); font-family: monospace; }

/* Buttons */
.btn-submit { width: 100%; padding: 14px; border-radius: var(--radius); background: var(--pure-white); color: var(--black); font-family: 'DM Sans', sans-serif; font-size: 0.95rem; font-weight: 700; border: none; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 10px; transition: all 0.25s; margin-top: 24px; }
.btn-submit:hover { background: var(--accent); box-shadow: 0 4px 24px rgba(232,213,163,0.25); transform: translateY(-1px); }
.char-counter { font-size: 0.72rem; color: var(--muted); text-align: right; margin-top: 4px; }
.char-counter.warn { color: #f59e0b; }
.char-counter.over { color: #ef4444; }

@media (max-width: 768px) {
  .form-grid { grid-template-columns: 1fr; }
  .form-page { padding: 32px 16px 60px; }
}
</style>

<div class="form-page">
  <a href="<?= base_url('galeri/detail/' . $gambar['id']) ?>" class="form-back">
    <i class="fas fa-arrow-left"></i> Back
  </a>

  <div class="form-header">
    <div class="form-eyebrow"><i class="fas fa-pen"></i> Edit Photo</div>
    <h1 class="form-title">Update Photo Information</h1>
    <p class="form-sub">Update details or replace the photo file. Leave file empty to keep the current one.</p>
  </div>

  <form action="<?= base_url('galeri/update/' . $gambar['id']) ?>" method="POST" enctype="multipart/form-data" id="editForm">

    <div class="form-grid">
      <!-- Left -->
      <div>
        <div class="form-card" style="margin-bottom:16px;">
          <div class="form-section-title">Photo Information</div>

          <div class="field-group">
            <label class="field-label" for="judul"> Title <span class="required">*</span></label>
            <input type="text" id="judul" name="judul" class="field-input"
              value="<?= htmlspecialchars($gambar['judul']) ?>"
              maxlength="150" required>
            <div class="char-counter" id="judulCounter"><?= strlen($gambar['judul']) ?> / 150</div>
          </div>

          <div class="field-group">
            <label class="field-label" for="deskripsi"> Description <span class="required">*</span></label>
            <textarea id="deskripsi" name="deskripsi" class="field-textarea" rows="4" required><?= htmlspecialchars($gambar['deskripsi']) ?></textarea>
          </div>

          <div class="field-group" style="margin-bottom:0;">
            <label class="field-label" for="kategori"> Category <span class="required">*</span></label>
            <select id="kategori" name="kategori" class="field-select" required>
              <?php foreach ($kategoriList as $kat): ?>
              <option value="<?= htmlspecialchars($kat) ?>" <?= $gambar['kategori'] === $kat ? 'selected' : '' ?>>
                <?= htmlspecialchars($kat) ?>
              </option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>

        <!-- File update -->
        <div class="form-card">
          <div class="form-section-title"> Replace File (Optional) </div>

          <!-- Current image -->
          <?php if (!empty($gambar['filename'])): ?>
          <div class="current-img">
            <img src="<?= base_url('upload/images/' . $gambar['filename']) ?>" alt="<?= htmlspecialchars($gambar['judul']) ?>">
            <span class="current-img-label">Current photo</span>
          </div>
          <?php endif; ?>

          <div class="upload-new" id="uploadNew">
            <input type="file" name="gambar" id="gambarInput" accept="image/*">
            <div class="upload-new-text">
              <strong>Click to replace photo</strong><br>
              Leave empty to keep current
            </div>
          </div>

          <div class="new-preview-wrap" id="newPreviewWrap">
            <img src="" alt="Preview" id="newPreviewImg">
          </div>
        </div>
      </div>

      <!-- Right -->
      <div>
        <div class="form-card" style="margin-bottom:16px;">
          <div class="form-section-title">Accent Color</div>

          <div class="color-picker-group" id="colorPicker">
            <?php foreach ($warnaList as $w): ?>
            <button type="button"
              class="color-swatch-btn <?= $gambar['warna'] === $w ? 'selected' : '' ?>"
              style="background: <?= htmlspecialchars($w) ?>;"
              data-color="<?= htmlspecialchars($w) ?>"
              onclick="selectColor(this)">
            </button>
            <?php endforeach; ?>
          </div>
          <input type="hidden" name="warna" id="warnaInput" value="<?= htmlspecialchars($gambar['warna']) ?>">

          <div class="color-swatch" style="margin-top:16px;">
            <div class="swatch" id="colorPreview" style="background:<?= htmlspecialchars($gambar['warna']) ?>;"></div>
            <span class="swatch-label" id="colorLabel"><?= htmlspecialchars($gambar['warna']) ?></span>
          </div>
        </div>

        <div class="form-card">
          <div class="form-section-title">Actions</div>
          <button type="submit" class="btn-submit">
            <i class="fas fa-save"></i> Save Changes
          </button>
          <a href="<?= base_url('galeri/detail/' . $gambar['id']) ?>" style="display:block; text-align:center; margin-top:12px; color:var(--muted); font-size:0.85rem; transition:color 0.2s;" onmouseover="this.style.color='var(--light)'" onmouseout="this.style.color='var(--muted)'">
            Cancel
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

  // New file preview
  document.getElementById('gambarInput').addEventListener('change', function() {
    const file = this.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = (e) => {
      document.getElementById('newPreviewImg').src = e.target.result;
      document.getElementById('newPreviewWrap').style.display = 'block';
    };
    reader.readAsDataURL(file);
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
</script>
