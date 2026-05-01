<?php $this->load->view('_layout/header'); ?>
<?php $this->load->view('_layout/sidebar'); ?>
<?php $this->load->view('_layout/navbar'); ?>

<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Dashboard</h1>
    </div>
    <div class="section-body">

      <!-- Statistik Card -->
      <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-primary">
              <i class="fas fa-door-open"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header"><h4>Total Kamar</h4></div>
              <div class="card-body"><?= $total_kamar ?></div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-success">
              <i class="fas fa-check-circle"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header"><h4>Kamar Tersedia</h4></div>
              <div class="card-body"><?= $kamar_tersedia ?></div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-warning">
              <i class="fas fa-users"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header"><h4>Total Penghuni</h4></div>
              <div class="card-body"><?= $total_penghuni ?></div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-danger">
              <i class="fas fa-money-bill-wave"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header"><h4>Data Pembayaran</h4></div>
              <div class="card-body"><?= $total_bayar ?></div>
            </div>
          </div>
        </div>
      </div>

      <!-- Chart Row -->
      <div class="row">

        <!-- Bar Chart: Pendapatan per Bulan -->
        <div class="col-lg-8 col-md-12">
          <div class="card">
            <div class="card-header">
              <h4>Pendapatan per Bulan (<?= date('Y') ?>)</h4>
            </div>
            <div class="card-body">
              <canvas id="chartPendapatan" height="120"></canvas>
            </div>
          </div>
        </div>

        <!-- Doughnut Chart: Status Kamar -->
        <div class="col-lg-4 col-md-12">
          <div class="card">
            <div class="card-header">
              <h4>Status Kamar</h4>
            </div>
            <div class="card-body">
              <canvas id="chartKamar" height="220"></canvas>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>
</div>

<?php $this->load->view('_layout/js'); ?>
<script src="<?= base_url() ?>assets/modules/chart.min.js"></script>
<script>
// Bar chart - Pendapatan per Bulan
var ctxBar = document.getElementById('chartPendapatan').getContext('2d');
new Chart(ctxBar, {
  type: 'bar',
  data: {
    labels: <?= $chart_labels ?>,
    datasets: [{
      label: 'Total Pendapatan (Rp)',
      data: <?= $chart_data ?>,
      backgroundColor: 'rgba(99, 102, 241, 0.7)',
      borderColor: 'rgba(99, 102, 241, 1)',
      borderWidth: 1,
      borderRadius: 4,
    }]
  },
  options: {
    responsive: true,
    scales: {
      y: {
        beginAtZero: true,
        ticks: {
          callback: function(value) {
            return 'Rp ' + value.toLocaleString('id-ID');
          }
        }
      }
    },
    plugins: {
      tooltip: {
        callbacks: {
          label: function(ctx) {
            return 'Rp ' + ctx.raw.toLocaleString('id-ID');
          }
        }
      }
    }
  }
});

// Doughnut chart - Status Kamar
var ctxDoughnut = document.getElementById('chartKamar').getContext('2d');
new Chart(ctxDoughnut, {
  type: 'doughnut',
  data: {
    labels: ['Tersedia', 'Terisi'],
    datasets: [{
      data: [<?= $kamar_tersedia ?>, <?= $kamar_terisi ?>],
      backgroundColor: ['#47c363', '#fc544b'],
      borderWidth: 2,
    }]
  },
  options: {
    responsive: true,
    plugins: {
      legend: { position: 'bottom' }
    }
  }
});
</script>
