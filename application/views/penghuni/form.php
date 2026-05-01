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
          <?php $id = isset($penghuni) ? $penghuni->id : ''; ?>
          <form action="<?= site_url($id ? 'penghuni/edit/' . $id : 'penghuni/tambah') ?>" method="post">
            <div class="form-group">
              <label>Nama Lengkap</label>
              <input type="text" name="nama" class="form-control <?= form_error('nama') ? 'is-invalid' : '' ?>"
                value="<?= isset($penghuni) ? $penghuni->nama : set_value('nama') ?>">
              <div class="invalid-feedback"><?= form_error('nama') ?></div>
            </div>
            <div class="form-group">
              <label>NIK (16 digit)</label>
              <input type="text" name="nik" maxlength="16" class="form-control <?= form_error('nik') ? 'is-invalid' : '' ?>"
                value="<?= isset($penghuni) ? $penghuni->nik : set_value('nik') ?>">
              <div class="invalid-feedback"><?= form_error('nik') ?></div>
            </div>
            <div class="form-group">
              <label>No. HP</label>
              <input type="text" name="no_hp" class="form-control"
                value="<?= isset($penghuni) ? $penghuni->no_hp : set_value('no_hp') ?>">
            </div>
            <div class="form-group">
              <label>Alamat Asal</label>
              <textarea name="alamat_asal" class="form-control" rows="3"><?= isset($penghuni) ? $penghuni->alamat_asal : set_value('alamat_asal') ?></textarea>
            </div>
            <div class="form-group">
              <label>Tanggal Masuk</label>
              <input type="date" name="tanggal_masuk" class="form-control <?= form_error('tanggal_masuk') ? 'is-invalid' : '' ?>"
                value="<?= isset($penghuni) ? $penghuni->tanggal_masuk : set_value('tanggal_masuk') ?>">
              <div class="invalid-feedback"><?= form_error('tanggal_masuk') ?></div>
            </div>
            <div class="form-group">
              <label>Kamar</label>
              <select name="id_kamar" class="form-control <?= form_error('id_kamar') ? 'is-invalid' : '' ?>">
                <option value="">-- Pilih Kamar --</option>
                <?php foreach ($kamar_list as $k): ?>
                <option value="<?= $k->id ?>" <?= (isset($penghuni) && $penghuni->id_kamar == $k->id) ? 'selected' : '' ?>>
                  <?= $k->nomor_kamar ?> (<?= isset($k->status) ? ucfirst($k->status) : '' ?>)
                </option>
                <?php endforeach; ?>
              </select>
              <div class="invalid-feedback"><?= form_error('id_kamar') ?></div>
            </div>
            <a href="<?= site_url('penghuni') ?>" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </form>
        </div>
      </div>
    </div>
  </section>
</div>

<?php $this->load->view('_layout/js'); ?>
