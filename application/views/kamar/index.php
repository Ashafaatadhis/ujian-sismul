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
          <a href="<?= site_url('kamar/tambah') ?>" class="btn btn-primary">+ Tambah</a>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-striped" id="table-1">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Foto</th>
                  <th>Nomor Kamar</th>
                  <th>Lantai</th>
                  <th>Tipe</th>
                  <th>Harga</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1; foreach ($kamar as $k): ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td>
                    <?php if (isset($k->foto) && $k->foto): ?>
                      <img src="<?= base_url('upload/kamar/' . $k->foto) ?>" width="60" height="50" class="rounded" style="object-fit:cover">
                    <?php else: ?>
                      <span class="text-muted">-</span>
                    <?php endif; ?>
                  </td>
                  <td><?= $k->nomor_kamar ?></td>
                  <td><?= $k->lantai ?></td>
                  <td><?= $k->nama_tipe ?></td>
                  <td>Rp <?= number_format($k->harga, 0, ',', '.') ?></td>
                  <td>
                    <span class="badge badge-<?= $k->status == 'tersedia' ? 'success' : 'danger' ?>">
                      <?= ucfirst($k->status) ?>
                    </span>
                  </td>
                  <td>
                    <a href="<?= site_url('kamar/edit/' . $k->id) ?>" class="btn btn-sm btn-warning">Edit</a>
                    <a href="<?= site_url('kamar/hapus/' . $k->id) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</a>
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
