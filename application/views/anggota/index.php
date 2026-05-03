<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<style>
/* ANGGOTA PAGE */
.anggota-hero {
  position: relative;
  padding: 72px 32px 56px;
  text-align: center;
  overflow: hidden;
}
.anggota-hero::before {
  content: '';
  position: absolute;
  inset: 0;
  background: radial-gradient(ellipse 70% 50% at 50% 0%, rgba(232,213,163,0.07) 0%, transparent 70%);
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
.anggota-hero h1 {
  font-family: 'Playfair Display', serif;
  font-size: clamp(2.2rem, 4vw, 3.5rem);
  font-weight: 700;
  color: var(--pure-white);
  letter-spacing: -0.03em;
  line-height: 1.15;
  margin-bottom: 12px;
}
.anggota-hero h1 em { font-style: italic; color: var(--accent); }
.hero-sub { color: var(--soft); font-size: 0.95rem; max-width: 440px; margin: 0 auto; }

.anggota-section { max-width: 1200px; margin: 0 auto; padding: 0 32px 80px; }

.anggota-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
  gap: 20px;
  margin-bottom: 48px;
}

.anggota-card {
  background: var(--dark);
  border: 1px solid var(--border);
  border-radius: var(--radius-lg);
  padding: 28px 24px;
  position: relative;
  overflow: hidden;
  transition: all 0.35s cubic-bezier(0.34,1.56,0.64,1);
  opacity: 0;
  animation: fadeInUp 0.5s ease forwards;
}
.anggota-card:nth-child(1) { animation-delay: 0.1s; }
.anggota-card:nth-child(2) { animation-delay: 0.2s; }
.anggota-card:nth-child(3) { animation-delay: 0.3s; }
.anggota-card:nth-child(4) { animation-delay: 0.4s; }
.anggota-card:nth-child(n+5) { animation-delay: 0.5s; }
@keyframes fadeInUp {
  from { opacity: 0; transform: translateY(24px); }
  to   { opacity: 1; transform: translateY(0); }
}
.anggota-card:hover {
  transform: translateY(-6px);
  box-shadow: 0 16px 48px rgba(0,0,0,0.4);
}
.card-stripe { position: absolute; top: 0; left: 0; right: 0; height: 3px; border-radius: var(--radius-lg) var(--radius-lg) 0 0; }
.card-glow { position: absolute; top: -40px; right: -40px; width: 120px; height: 120px; border-radius: 50%; opacity: 0.06; pointer-events: none; transition: opacity 0.3s; }
.anggota-card:hover .card-glow { opacity: 0.12; }

.avatar { width: 64px; height: 64px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-family: 'Playfair Display', serif; font-size: 1.4rem; font-weight: 700; color: white; position: relative; margin-bottom: 20px; }
.avatar::after { content: ''; position: absolute; inset: -3px; border-radius: 50%; border: 1px solid rgba(255,255,255,0.15); }

.peran-badge { display: inline-flex; align-items: center; gap: 5px; padding: 4px 12px; border-radius: 99px; font-size: 0.72rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 12px; }
.anggota-name { font-family: 'Playfair Display', serif; font-size: 1.15rem; font-weight: 600; color: var(--pure-white); margin-bottom: 8px; line-height: 1.3; }
.anggota-npm { display: flex; align-items: center; gap: 6px; font-size: 0.78rem; color: var(--muted); }

.kelompok-card { background: var(--dark); border: 1px solid var(--border); border-radius: var(--radius-xl); padding: 36px; display: flex; align-items: center; gap: 28px; position: relative; overflow: hidden; }
.kelompok-card::before { content: ''; position: absolute; inset: 0; background: linear-gradient(135deg, rgba(232,213,163,0.04) 0%, transparent 60%); pointer-events: none; }
.ki-icon { width: 64px; height: 64px; flex-shrink: 0; border-radius: var(--radius); background: rgba(232,213,163,0.08); border: 1px solid rgba(232,213,163,0.15); display: flex; align-items: center; justify-content: center; font-size: 1.6rem; color: var(--accent); }
.ki-content h3 { font-family: 'Playfair Display', serif; font-size: 1.2rem; color: var(--pure-white); margin-bottom: 4px; }
.ki-content p { font-size: 0.85rem; color: var(--soft); margin-bottom: 16px; }
.ki-tags { display: flex; flex-wrap: wrap; gap: 8px; }
.ki-tag { display: inline-flex; align-items: center; gap: 6px; padding: 5px 12px; background: rgba(255,255,255,0.05); border: 1px solid var(--border); border-radius: 99px; font-size: 0.75rem; color: var(--silver); }

@media (max-width: 768px) {
  .anggota-hero { padding: 48px 20px 36px; }
  .anggota-section { padding: 0 16px 60px; }
  .anggota-grid { grid-template-columns: 1fr 1fr; gap: 12px; }
  .kelompok-card { flex-direction: column; padding: 24px; gap: 20px; }
}
@media (max-width: 480px) { .anggota-grid { grid-template-columns: 1fr; } }
</style>

<section class="anggota-hero">
  <div class="hero-eyebrow"><i class="fas fa-users"></i> Our Team</div>
  <h1>Members of <em>4IA07</em></h1>
  <p class="hero-sub">Gunadarma University &bull; Multimedia Systems &bull; <?= date('Y') ?></p>
</section>

<section class="anggota-section">
  <?php if (empty($anggota)): ?>
  <div style="text-align:center; padding: 80px 20px; color: var(--muted);">
    <i class="fas fa-users" style="font-size:3rem; margin-bottom:16px; display:block;"></i>
    <p>No member data yet.</p>
  </div>
  <?php else: ?>
  <div class="anggota-grid">
    <?php
      $icons  = ['fas fa-code','fas fa-database','fas fa-palette','fas fa-server','fas fa-mobile-alt','fas fa-cogs'];
      $colors = ['#e8d5a3','#c9a96e','#4ECDC4','#FF8E53','#6C63FF','#E84393'];
      $i = 0;
      foreach ($anggota as $row):
        $c   = $colors[$i % count($colors)];
        $ico = $icons[$i % count($icons)];
        $np  = explode(' ', trim($row['nama']));
        $ini = strtoupper(substr($np[0],0,1) . (isset($np[1]) ? substr($np[1],0,1) : ''));
    ?>
    <div class="anggota-card">
      <div class="card-stripe" style="background:<?= $c ?>;"></div>
      <div class="card-glow" style="background:<?= $c ?>;"></div>
      <div class="avatar" style="background: linear-gradient(135deg, <?= $c ?>cc, <?= $c ?>66);"><?= $ini ?></div>
      <div class="peran-badge" style="background:<?= $c ?>18; color:<?= $c ?>; border:1px solid <?= $c ?>33;">
        <i class="<?= $ico ?>"></i> <?= htmlspecialchars($row['peran']) ?>
      </div>
      <h3 class="anggota-name"><?= htmlspecialchars($row['nama']) ?></h3>
      <p class="anggota-npm"><i class="fas fa-id-card"></i> <?= htmlspecialchars($row['npm']) ?></p>
    </div>
    <?php $i++; endforeach; ?>
  </div>
  <?php endif; ?>

  <div class="kelompok-card">
    <div class="ki-icon"><i class="fas fa-university"></i></div>
    <div class="ki-content">
      <h3>Gunadarma University</h3>
      <p>Class 4IA07 &bull; Multimedia Systems Course &bull; Even Semester <?= date('Y') ?></p>
      <div class="ki-tags">
        <span class="ki-tag"><i class="fas fa-code"></i> CodeIgniter 3</span>
        <span class="ki-tag"><i class="fab fa-php"></i> PHP</span>
        <span class="ki-tag"><i class="fas fa-database"></i> MySQL</span>
        <span class="ki-tag"><i class="fas fa-images"></i> CRUD Gambar</span>
      </div>
    </div>
  </div>
</section>
