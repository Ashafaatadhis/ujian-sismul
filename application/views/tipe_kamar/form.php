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
          <?php $id = isset($tipe) ? $tipe->id : ''; ?>
          <form action="<?= site_url($id ? 'tipe_kamar/edit/' . $id : 'tipe_kamar/tambah') ?>" method="post">
            <div class="form-group">
              <label>Nama Tipe</label>
              <input type="text" name="nama_tipe" class="form-control <?= form_error('nama_tipe') ? 'is-invalid' : '' ?>"
                value="<?= isset($tipe) ? $tipe->nama_tipe : set_value('nama_tipe') ?>">
              <div class="invalid-feedback"><?= form_error('nama_tipe') ?></div>
            </div>
            <div class="form-group">
              <label>Harga (Rp)</label>
              <input type="number" name="harga" class="form-control <?= form_error('harga') ? 'is-invalid' : '' ?>"
                value="<?= isset($tipe) ? $tipe->harga : set_value('harga') ?>">
              <div class="invalid-feedback"><?= form_error('harga') ?></div>
            </div>
            <div class="form-group">
              <label>Fasilitas</label>
              <textarea name="fasilitas" class="form-control" rows="3"><?= isset($tipe) ? $tipe->fasilitas : set_value('fasilitas') ?></textarea>
            </div>
            <a href="<?= site_url('tipe_kamar') ?>" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </form>
        </div>
      </div>
    </div>
  </section>
</div>

<?php $this->load->view('_layout/js'); ?>
