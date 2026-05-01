<?php $this->load->view('_layout/header'); ?>
<?php $this->load->view('_layout/sidebar'); ?>
<?php $this->load->view('_layout/navbar'); ?>

<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1><?= $title ?></h1>
    </div>
    <div class="section-body">
      <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success"><?= $this->session->flashdata('success') ?></div>
      <?php endif; ?>
      <div class="card">
        <div class="card-header">
          <a href="<?= site_url('tipe_kamar/tambah') ?>" class="btn btn-primary">+ Tambah</a>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-striped" id="table-1">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nama Tipe</th>
                  <th>Harga</th>
                  <th>Fasilitas</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1; foreach ($tipe_kamar as $t): ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td><?= $t->nama_tipe ?></td>
                  <td>Rp <?= number_format($t->harga, 0, ',', '.') ?></td>
                  <td><?= $t->fasilitas ?></td>
                  <td>
                    <a href="<?= site_url('tipe_kamar/edit/' . $t->id) ?>" class="btn btn-sm btn-warning">Edit</a>
                    <a href="<?= site_url('tipe_kamar/hapus/' . $t->id) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</a>
                  </td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<?php $this->load->view('_layout/js'); ?>
