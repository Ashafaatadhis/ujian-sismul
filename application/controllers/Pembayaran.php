<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembayaran extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['M_pembayaran' => 'model', 'M_penghuni' => 'model_penghuni']);
        $this->load->helper(['url', 'form']);
        $this->load->library(['session', 'form_validation']);
    }

    public function index() {
        $data['pembayaran'] = $this->model->getAll();
        $data['title'] = 'Data Pembayaran';
        $this->load->view('pembayaran/index', $data);
    }

    public function tambah() {
        $this->form_validation->set_rules('id_penghuni', 'Penghuni', 'required');
        $this->form_validation->set_rules('bulan', 'Bulan', 'required|numeric');
        $this->form_validation->set_rules('tahun', 'Tahun', 'required|numeric');
        $this->form_validation->set_rules('jumlah_bayar', 'Jumlah Bayar', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $data['penghuni_list'] = $this->model_penghuni->getAll();
            $data['title'] = 'Tambah Pembayaran';
            $this->load->view('pembayaran/form', $data);
        } else {
            $status = $this->input->post('status', TRUE);
            $this->model->insert([
                'id_penghuni'   => $this->input->post('id_penghuni', TRUE),
                'bulan'         => $this->input->post('bulan', TRUE),
                'tahun'         => $this->input->post('tahun', TRUE),
                'jumlah_bayar'  => $this->input->post('jumlah_bayar', TRUE),
                'status'        => $status,
                'tanggal_bayar' => $status == 'lunas' ? date('Y-m-d') : NULL,
            ]);
            $this->session->set_flashdata('success', 'Pembayaran berhasil dicatat.');
            redirect('pembayaran');
        }
    }

    public function edit($id) {
        $this->form_validation->set_rules('bulan', 'Bulan', 'required|numeric');
        $this->form_validation->set_rules('tahun', 'Tahun', 'required|numeric');
        $this->form_validation->set_rules('jumlah_bayar', 'Jumlah Bayar', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $data['pembayaran'] = $this->model->getById($id);
            $data['penghuni_list'] = $this->model_penghuni->getAll();
            $data['title'] = 'Edit Pembayaran';
            $this->load->view('pembayaran/form', $data);
        } else {
            $status = $this->input->post('status', TRUE);
            $this->model->update($id, [
                'id_penghuni'   => $this->input->post('id_penghuni', TRUE),
                'bulan'         => $this->input->post('bulan', TRUE),
                'tahun'         => $this->input->post('tahun', TRUE),
                'jumlah_bayar'  => $this->input->post('jumlah_bayar', TRUE),
                'status'        => $status,
                'tanggal_bayar' => $status == 'lunas' ? date('Y-m-d') : NULL,
            ]);
            $this->session->set_flashdata('success', 'Pembayaran berhasil diperbarui.');
            redirect('pembayaran');
        }
    }

    public function hapus($id) {
        $this->model->delete($id);
        $this->session->set_flashdata('success', 'Data pembayaran berhasil dihapus.');
        redirect('pembayaran');
    }
}
