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
          <a href="<?= site_url('pembayaran/tambah') ?>" class="btn btn-primary">+ Tambah</a>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-striped" id="table-1">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Penghuni</th>
                  <th>Kamar</th>
                  <th>Bulan/Tahun</th>
                  <th>Jumlah</th>
                  <th>Status</th>
                  <th>Tanggal Bayar</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $bulan_nama = ['','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
                $no = 1;
                foreach ($pembayaran as $p): ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td><?= $p->nama ?></td>
                  <td><?= $p->nomor_kamar ?></td>
                  <td><?= $bulan_nama[$p->bulan] ?> <?= $p->tahun ?></td>
                  <td>Rp <?= number_format($p->jumlah_bayar, 0, ',', '.') ?></td>
                  <td>
                    <span class="badge badge-<?= $p->status == 'lunas' ? 'success' : 'warning' ?>">
                      <?= ucfirst($p->status) ?>
                    </span>
                  </td>
                  <td><?= $p->tanggal_bayar ? date('d/m/Y', strtotime($p->tanggal_bayar)) : '-' ?></td>
                  <td>
                    <a href="<?= site_url('pembayaran/edit/' . $p->id) ?>" class="btn btn-sm btn-warning">Edit</a>
                    <a href="<?= site_url('pembayaran/hapus/' . $p->id) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</a>
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
