<?php $this->load->view('_layout/header'); ?>
<?php $this->load->view('_layout/sidebar'); ?>
<?php $this->load->view('_layout/navbar'); ?>

<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1><?= $title ?></h1>
    </div>
    <div class="section-body">
      <div class="card">
        <div class="card-body">
          <?php $id = isset($pembayaran) ? $pembayaran->id : ''; ?>
          <form action="<?= site_url($id ? 'pembayaran/edit/' . $id : 'pembayaran/tambah') ?>" method="post">
            <div class="form-group">
              <label>Penghuni</label>
              <select name="id_penghuni" class="form-control <?= form_error('id_penghuni') ? 'is-invalid' : '' ?>">
                <option value="">-- Pilih Penghuni --</option>
                <?php foreach ($penghuni_list as $p): ?>
                <option value="<?= $p->id ?>" <?= (isset($pembayaran) && $pembayaran->id_penghuni == $p->id) ? 'selected' : '' ?>>
                  <?= $p->nama ?> - Kamar <?= $p->nomor_kamar ?>
                </option>
                <?php endforeach; ?>
              </select>
              <div class="invalid-feedback"><?= form_error('id_penghuni') ?></div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label>Bulan</label>
                <select name="bulan" class="form-control <?= form_error('bulan') ? 'is-invalid' : '' ?>">
                  <?php
                  $bulan_nama = ['','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
                  for ($i = 1; $i <= 12; $i++): ?>
                  <option value="<?= $i ?>" <?= (isset($pembayaran) && $pembayaran->bulan == $i) ? 'selected' : ((!isset($pembayaran) && date('n') == $i) ? 'selected' : '') ?>>
                    <?= $bulan_nama[$i] ?>
                  </option>
                  <?php endfor; ?>
                </select>
                <div class="invalid-feedback"><?= form_error('bulan') ?></div>
              </div>
              <div class="form-group col-md-6">
                <label>Tahun</label>
                <input type="number" name="tahun" class="form-control <?= form_error('tahun') ? 'is-invalid' : '' ?>"
                  value="<?= isset($pembayaran) ? $pembayaran->tahun : date('Y') ?>">
                <div class="invalid-feedback"><?= form_error('tahun') ?></div>
              </div>
            </div>
            <div class="form-group">
              <label>Jumlah Bayar (Rp)</label>
              <input type="number" name="jumlah_bayar" class="form-control <?= form_error('jumlah_bayar') ? 'is-invalid' : '' ?>"
                value="<?= isset($pembayaran) ? $pembayaran->jumlah_bayar : set_value('jumlah_bayar') ?>">
              <div class="invalid-feedback"><?= form_error('jumlah_bayar') ?></div>
            </div>
            <div class="form-group">
              <label>Status</label>
              <select name="status" class="form-control">
                <option value="belum" <?= (isset($pembayaran) && $pembayaran->status == 'belum') ? 'selected' : '' ?>>Belum Lunas</option>
                <option value="lunas" <?= (isset($pembayaran) && $pembayaran->status == 'lunas') ? 'selected' : '' ?>>Lunas</option>
              </select>
            </div>
            <a href="<?= site_url('pembayaran') ?>" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </form>
        </div>
      </div>
    </div>
  </section>
</div>

<?php $this->load->view('_layout/js'); ?>
