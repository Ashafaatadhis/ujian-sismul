<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penghuni extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['M_penghuni' => 'model', 'M_kamar' => 'model_kamar']);
        $this->load->helper(['url', 'form']);
        $this->load->library(['session', 'form_validation']);
    }

    public function index() {
        $data['penghuni'] = $this->model->getAll();
        $data['title'] = 'Data Penghuni';
        $this->load->view('penghuni/index', $data);
    }

    public function tambah() {
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('nik', 'NIK', 'required|exact_length[16]');
        $this->form_validation->set_rules('id_kamar', 'Kamar', 'required');
        $this->form_validation->set_rules('tanggal_masuk', 'Tanggal Masuk', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['kamar_list'] = $this->model_kamar->getTersedia();
            $data['title'] = 'Tambah Penghuni';
            $this->load->view('penghuni/form', $data);
        } else {
            $id_kamar = $this->input->post('id_kamar', TRUE);
            $this->model->insert([
                'nama'          => $this->input->post('nama', TRUE),
                'nik'           => $this->input->post('nik', TRUE),
                'no_hp'         => $this->input->post('no_hp', TRUE),
                'alamat_asal'   => $this->input->post('alamat_asal', TRUE),
                'tanggal_masuk' => $this->input->post('tanggal_masuk', TRUE),
                'id_kamar'      => $id_kamar,
            ]);
            $this->model_kamar->updateStatus($id_kamar, 'terisi');
            $this->session->set_flashdata('success', 'Penghuni berhasil ditambahkan.');
            redirect('penghuni');
        }
    }

    public function edit($id) {
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('nik', 'NIK', 'required|exact_length[16]');
        $this->form_validation->set_rules('tanggal_masuk', 'Tanggal Masuk', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['penghuni'] = $this->model->getById($id);
            $data['kamar_list'] = $this->model_kamar->getAll();
            $data['title'] = 'Edit Penghuni';
            $this->load->view('penghuni/form', $data);
        } else {
            $this->model->update($id, [
                'nama'          => $this->input->post('nama', TRUE),
                'nik'           => $this->input->post('nik', TRUE),
                'no_hp'         => $this->input->post('no_hp', TRUE),
                'alamat_asal'   => $this->input->post('alamat_asal', TRUE),
                'tanggal_masuk' => $this->input->post('tanggal_masuk', TRUE),
                'id_kamar'      => $this->input->post('id_kamar', TRUE),
            ]);
            $this->session->set_flashdata('success', 'Data penghuni berhasil diperbarui.');
            redirect('penghuni');
        }
    }

    public function hapus($id) {
        $penghuni = $this->model->getById($id);
        $this->model_kamar->updateStatus($penghuni->id_kamar, 'tersedia');
        $this->model->delete($id);
        $this->session->set_flashdata('success', 'Penghuni berhasil dihapus.');
        redirect('penghuni');
    }
}
