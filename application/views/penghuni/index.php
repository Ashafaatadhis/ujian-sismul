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
          <a href="<?= site_url('penghuni/tambah') ?>" class="btn btn-primary">+ Tambah</a>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-striped" id="table-1">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nama</th>
                  <th>NIK</th>
                  <th>No. HP</th>
                  <th>Kamar</th>
                  <th>Tipe</th>
                  <th>Tanggal Masuk</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1; foreach ($penghuni as $p): ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td><?= $p->nama ?></td>
                  <td><?= $p->nik ?></td>
                  <td><?= $p->no_hp ?></td>
                  <td><?= $p->nomor_kamar ?></td>
                  <td><?= $p->nama_tipe ?></td>
                  <td><?= date('d/m/Y', strtotime($p->tanggal_masuk)) ?></td>
                  <td>
                    <a href="<?= site_url('penghuni/edit/' . $p->id) ?>" class="btn btn-sm btn-warning">Edit</a>
                    <a href="<?= site_url('penghuni/hapus/' . $p->id) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</a>
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
