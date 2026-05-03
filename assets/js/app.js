/* ============================================================
   GaleriKita — app.js
   ============================================================ */

document.addEventListener('DOMContentLoaded', () => {

  /* ── Navbar scroll effect ── */
  const navbar = document.getElementById('navbar');
  if (navbar) {
    window.addEventListener('scroll', () => {
      navbar.classList.toggle('scrolled', window.scrollY > 10);
    });
  }

  /* ── Hamburger menu ── */
  const hamburger   = document.getElementById('hamburger');
  const mobileMenu  = document.getElementById('mobileMenu');
  if (hamburger && mobileMenu) {
    hamburger.addEventListener('click', () => {
      mobileMenu.classList.toggle('open');
      hamburger.classList.toggle('open');
    });
  }

  /* ── Toast auto-dismiss ── */
  const toast = document.getElementById('toast');
  if (toast) {
    setTimeout(() => {
      toast.style.opacity = '0';
      toast.style.transform = 'translateX(60px)';
      toast.style.transition = '.4s ease';
      setTimeout(() => toast.remove(), 400);
    }, 4000);
  }

  /* ── Upload zone drag & drop ── */
  initUploadZone();

  /* ── Masonry layout fix for images ── */
  const imgs = document.querySelectorAll('.card-img');
  let loaded = 0;
  if (imgs.length === 0) return;
  imgs.forEach(img => {
    if (img.complete) { loaded++; }
    else {
      img.addEventListener('load', () => {
        loaded++;
      });
    }
  });
});

/* ============================================================
   UPLOAD ZONE
   ============================================================ */
function initUploadZone() {
  const zone      = document.getElementById('uploadZone');
  const fileInput = document.getElementById('fileInput');
  const prompt    = document.getElementById('uploadPrompt');
  const preview   = document.getElementById('uploadPreview');
  const previewImg = document.getElementById('previewImg');

  if (!zone || !fileInput) return;

  // Click on zone opens file picker
  zone.addEventListener('click', (e) => {
    if (e.target.tagName !== 'BUTTON' && e.target.tagName !== 'INPUT') {
      fileInput.click();
    }
  });

  // File selected
  fileInput.addEventListener('change', () => handleFile(fileInput.files[0]));

  // Drag & drop
  zone.addEventListener('dragover', (e) => {
    e.preventDefault();
    zone.classList.add('dragover');
  });
  zone.addEventListener('dragleave', () => zone.classList.remove('dragover'));
  zone.addEventListener('drop', (e) => {
    e.preventDefault();
    zone.classList.remove('dragover');
    const file = e.dataTransfer.files[0];
    if (file) {
      fileInput.files = e.dataTransfer.files; // assign for form
      handleFile(file);
    }
  });

  function handleFile(file) {
    if (!file) return;
    // Validate type
    const allowed = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
    if (!allowed.includes(file.type)) {
      showZoneError('Format file tidak didukung. Gunakan JPG, PNG, GIF, atau WEBP.');
      return;
    }
    // Validate size (5MB)
    if (file.size > 5 * 1024 * 1024) {
      showZoneError('Ukuran file terlalu besar. Maks. 5 MB.');
      return;
    }

    const reader = new FileReader();
    reader.onload = (e) => {
      if (previewImg) previewImg.src = e.target.result;
      if (prompt)  prompt.style.display  = 'none';
      if (preview) preview.style.display = 'block';

      // Update current-img in edit mode
      const currentImg = document.getElementById('currentImg');
      if (currentImg) currentImg.src = e.target.result;
    };
    reader.readAsDataURL(file);
  }

  function showZoneError(msg) {
    alert(msg);
  }
}

/* ── Called by "Ganti Gambar" button ── */
function clearFile() {
  const fileInput = document.getElementById('fileInput');
  const prompt    = document.getElementById('uploadPrompt');
  const preview   = document.getElementById('uploadPreview');
  if (fileInput) fileInput.value = '';
  if (prompt)  prompt.style.display  = 'flex';
  if (preview) preview.style.display = 'none';
}

/* ============================================================
   LIGHTBOX
   ============================================================ */
function openLightbox(src, title, desc) {
  document.getElementById('lightboxImg').src   = src;
  document.getElementById('lbTitle').textContent = title;
  document.getElementById('lbDesc').textContent  = desc;
  document.getElementById('lightboxOverlay').classList.add('open');
  document.body.style.overflow = 'hidden';
}

function closeLightbox() {
  document.getElementById('lightboxOverlay').classList.remove('open');
  document.body.style.overflow = '';
}

/* ============================================================
   DELETE MODAL
   ============================================================ */
function openDeleteModal(id) {
  const modal = document.getElementById('deleteModal');
  const btn   = document.getElementById('confirmDeleteBtn');
  // Build delete URL — use base path
  btn.href = (window._basePath || '') + 'galeri/delete/' + id;
  modal.classList.add('open');
  document.body.style.overflow = 'hidden';
}

function closeDeleteModal() {
  document.getElementById('deleteModal').classList.remove('open');
  document.body.style.overflow = '';
}

// Close modals on Escape
document.addEventListener('keydown', (e) => {
  if (e.key === 'Escape') {
    closeLightbox();
    closeDeleteModal();
  }
});
