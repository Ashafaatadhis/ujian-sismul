<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$seg1 = $this->uri->segment(1);
?>
<div class="main-sidebar sidebar-style-2">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="<?= site_url() ?>">Sistem Kos</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="<?= site_url() ?>">SK</a>
    </div>
    <ul class="sidebar-menu">
      <li class="menu-header">Menu</li>

      <li class="<?= $seg1 == '' || $seg1 == 'welcome' ? 'active' : '' ?>">
        <a class="nav-link" href="<?= site_url('welcome') ?>">
          <i class="fas fa-home"></i> <span>Dashboard</span>
        </a>
      </li>

      <li class="<?= $seg1 == 'tipe_kamar' ? 'active' : '' ?>">
        <a class="nav-link" href="<?= site_url('tipe_kamar') ?>">
          <i class="fas fa-tags"></i> <span>Tipe Kamar</span>
        </a>
      </li>

      <li class="<?= $seg1 == 'kamar' ? 'active' : '' ?>">
        <a class="nav-link" href="<?= site_url('kamar') ?>">
          <i class="fas fa-door-open"></i> <span>Data Kamar</span>
        </a>
      </li>

      <li class="<?= $seg1 == 'penghuni' ? 'active' : '' ?>">
        <a class="nav-link" href="<?= site_url('penghuni') ?>">
          <i class="fas fa-users"></i> <span>Data Penghuni</span>
        </a>
      </li>

      <li class="<?= $seg1 == 'pembayaran' ? 'active' : '' ?>">
        <a class="nav-link" href="<?= site_url('pembayaran') ?>">
          <i class="fas fa-money-bill-wave"></i> <span>Pembayaran</span>
        </a>
      </li>

    </ul>
  </aside>
</div>
