<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['M_kamar' => 'model_kamar', 'M_penghuni' => 'model_penghuni', 'M_pembayaran' => 'model_pembayaran']);
        $this->load->helper('url');
    }

    public function index() {
        $kamar_status = $this->model_kamar->countByStatus();
        $tersedia = 0; $terisi = 0;
        foreach ($kamar_status as $s) {
            if ($s->status == 'tersedia') $tersedia = $s->total;
            else $terisi = $s->total;
        }

        $bulan_nama = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
        $bayar_per_bulan = $this->model_pembayaran->getPerBulan(date('Y'));
        $chart_labels = [];
        $chart_data   = [];
        $map = [];
        foreach ($bayar_per_bulan as $b) $map[$b->bulan] = $b->total;
        for ($i = 1; $i <= 12; $i++) {
            $chart_labels[] = $bulan_nama[$i - 1];
            $chart_data[]   = isset($map[$i]) ? (int)$map[$i] : 0;
        }

        $data['title']          = 'Dashboard';
        $data['total_kamar']    = $tersedia + $terisi;
        $data['kamar_tersedia'] = $tersedia;
        $data['kamar_terisi']   = $terisi;
        $data['total_penghuni'] = count($this->model_penghuni->getAll());
        $data['total_bayar']    = count($this->model_pembayaran->getAll());
        $data['chart_labels']   = json_encode($chart_labels);
        $data['chart_data']     = json_encode($chart_data);

        $this->load->view('dashboard', $data);
    }
}
