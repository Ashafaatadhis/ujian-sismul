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
          <?php $id = isset($kamar) ? $kamar->id : ''; ?>
          <?php if (isset($upload_error)): ?>
            <div class="alert alert-danger"><?= $upload_error ?></div>
          <?php endif; ?>
          <form action="<?= site_url($id ? 'kamar/edit/' . $id : 'kamar/tambah') ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label>Nomor Kamar</label>
              <input type="text" name="nomor_kamar" class="form-control <?= form_error('nomor_kamar') ? 'is-invalid' : '' ?>"
                value="<?= isset($kamar) ? $kamar->nomor_kamar : set_value('nomor_kamar') ?>">
              <div class="invalid-feedback"><?= form_error('nomor_kamar') ?></div>
            </div>
            <div class="form-group">
              <label>Lantai</label>
              <input type="number" name="lantai" class="form-control <?= form_error('lantai') ? 'is-invalid' : '' ?>"
                value="<?= isset($kamar) ? $kamar->lantai : set_value('lantai') ?>">
              <div class="invalid-feedback"><?= form_error('lantai') ?></div>
            </div>
            <div class="form-group">
              <label>Tipe Kamar</label>
              <select name="id_tipe_kamar" class="form-control <?= form_error('id_tipe_kamar') ? 'is-invalid' : '' ?>">
                <option value="">-- Pilih Tipe --</option>
                <?php foreach ($tipe_list as $t): ?>
                <option value="<?= $t->id ?>" <?= (isset($kamar) && $kamar->id_tipe_kamar == $t->id) ? 'selected' : '' ?>>
                  <?= $t->nama_tipe ?> - Rp <?= number_format($t->harga, 0, ',', '.') ?>
                </option>
                <?php endforeach; ?>
              </select>
              <div class="invalid-feedback"><?= form_error('id_tipe_kamar') ?></div>
            </div>
            <div class="form-group">
              <label>Foto Kamar</label>
              <?php if (isset($kamar) && isset($kamar->foto) && $kamar->foto): ?>
                <div class="mb-2">
                  <img src="<?= base_url('upload/kamar/' . $kamar->foto) ?>" width="150" class="rounded img-thumbnail">
                  <small class="d-block text-muted mt-1">Upload baru untuk mengganti foto.</small>
                </div>
              <?php endif; ?>
              <input type="file" name="foto" class="form-control-file" accept="image/jpg,image/jpeg,image/png">
              <small class="text-muted">Format: JPG, JPEG, PNG. Maks 2MB.</small>
            </div>
            <a href="<?= site_url('kamar') ?>" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </form>
        </div>
      </div>
    </div>
  </section>
</div>

<?php $this->load->view('_layout/js'); ?>
