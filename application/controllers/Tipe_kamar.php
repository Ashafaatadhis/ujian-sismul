<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tipe_kamar extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('M_tipe_kamar', 'model');
        $this->load->helper(['url', 'form']);
        $this->load->library(['session', 'form_validation']);
    }

    public function index() {
        $data['tipe_kamar'] = $this->model->getAll();
        $data['title'] = 'Tipe Kamar';
        $this->load->view('tipe_kamar/index', $data);
    }

    public function tambah() {
        $this->form_validation->set_rules('nama_tipe', 'Nama Tipe', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Tambah Tipe Kamar';
            $this->load->view('tipe_kamar/form', $data);
        } else {
            $this->model->insert([
                'nama_tipe' => $this->input->post('nama_tipe', TRUE),
                'harga'     => $this->input->post('harga', TRUE),
                'fasilitas' => $this->input->post('fasilitas', TRUE),
            ]);
            $this->session->set_flashdata('success', 'Tipe kamar berhasil ditambahkan.');
            redirect('tipe_kamar');
        }
    }

    public function edit($id) {
        $this->form_validation->set_rules('nama_tipe', 'Nama Tipe', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $data['tipe'] = $this->model->getById($id);
            $data['title'] = 'Edit Tipe Kamar';
            $this->load->view('tipe_kamar/form', $data);
        } else {
            $this->model->update($id, [
                'nama_tipe' => $this->input->post('nama_tipe', TRUE),
                'harga'     => $this->input->post('harga', TRUE),
                'fasilitas' => $this->input->post('fasilitas', TRUE),
            ]);
            $this->session->set_flashdata('success', 'Tipe kamar berhasil diperbarui.');
            redirect('tipe_kamar');
        }
    }

    public function hapus($id) {
        $this->model->delete($id);
        $this->session->set_flashdata('success', 'Tipe kamar berhasil dihapus.');
        redirect('tipe_kamar');
    }
}
