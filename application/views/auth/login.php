<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
  <title>Login &mdash; Sistem Kos</title>
  <link rel="stylesheet" href="<?= base_url() ?>assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/modules/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/css/style.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/css/components.css">
</head>
<body>
<div id="app">
  <section class="section">
    <div class="container mt-5">
      <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
          <div class="card card-primary">
            <div class="card-header">
              <h4>Login</h4>
            </div>
            <div class="card-body">
              <?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-danger"><?= $this->session->flashdata('error') ?></div>
              <?php endif; ?>
              <form action="<?= site_url('auth/login') ?>" method="POST">
                <div class="form-group">
                  <label for="username">Username</label>
                  <input type="text" class="form-control <?= form_error('username') ? 'is-invalid' : '' ?>"
                    name="username" id="username" value="<?= set_value('username') ?>" autofocus>
                  <div class="invalid-feedback"><?= form_error('username') ?></div>
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" class="form-control <?= form_error('password') ? 'is-invalid' : '' ?>"
                    name="password" id="password">
                  <div class="invalid-feedback"><?= form_error('password') ?></div>
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-primary btn-block">Login</button>
                </div>
              </form>
            </div>
          </div>
          <div class="mt-5 text-muted text-center">
            Sistem Informasi Kos &copy; <?= date('Y') ?>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<script src="<?= base_url() ?>assets/modules/jquery.min.js"></script>
<script src="<?= base_url() ?>assets/modules/bootstrap/js/bootstrap.min.js"></script>
<script src="<?= base_url() ?>assets/js/scripts.js"></script>
</body>
</html>
