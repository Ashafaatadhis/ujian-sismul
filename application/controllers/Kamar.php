<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kamar extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['M_kamar' => 'model', 'M_tipe_kamar' => 'model_tipe']);
        $this->load->helper(['url', 'form']);
        $this->load->library(['session', 'form_validation']);
    }

    public function index() {
        $data['kamar'] = $this->model->getAll();
        $data['title'] = 'Data Kamar';
        $this->load->view('kamar/index', $data);
    }

    public function tambah() {
        $this->form_validation->set_rules('nomor_kamar', 'Nomor Kamar', 'required');
        $this->form_validation->set_rules('lantai', 'Lantai', 'required|numeric');
        $this->form_validation->set_rules('id_tipe_kamar', 'Tipe Kamar', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['tipe_list'] = $this->model_tipe->getAll();
            $data['title'] = 'Tambah Kamar';
            $this->load->view('kamar/form', $data);
        } else {
            $foto = NULL;
            if (!empty($_FILES['foto']['name'])) {
                $foto = $this->_uploadFoto();
                if ($foto === FALSE) {
                    $data['tipe_list'] = $this->model_tipe->getAll();
                    $data['title'] = 'Tambah Kamar';
                    $data['upload_error'] = $this->upload->display_errors();
                    $this->load->view('kamar/form', $data);
                    return;
                }
            }
            $this->model->insert([
                'nomor_kamar'   => $this->input->post('nomor_kamar', TRUE),
                'lantai'        => $this->input->post('lantai', TRUE),
                'id_tipe_kamar' => $this->input->post('id_tipe_kamar', TRUE),
                'foto'          => $foto,
                'status'        => 'tersedia',
            ]);
            $this->session->set_flashdata('success', 'Kamar berhasil ditambahkan.');
            redirect('kamar');
        }
    }

    public function edit($id) {
        $this->form_validation->set_rules('nomor_kamar', 'Nomor Kamar', 'required');
        $this->form_validation->set_rules('lantai', 'Lantai', 'required|numeric');
        $this->form_validation->set_rules('id_tipe_kamar', 'Tipe Kamar', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['kamar'] = $this->model->getById($id);
            $data['tipe_list'] = $this->model_tipe->getAll();
            $data['title'] = 'Edit Kamar';
            $this->load->view('kamar/form', $data);
        } else {
            $kamar = $this->model->getById($id);
            $foto = $kamar->foto;

            if (!empty($_FILES['foto']['name'])) {
                $foto_baru = $this->_uploadFoto();
                if ($foto_baru === FALSE) {
                    $data['kamar'] = $kamar;
                    $data['tipe_list'] = $this->model_tipe->getAll();
                    $data['title'] = 'Edit Kamar';
                    $data['upload_error'] = $this->upload->display_errors();
                    $this->load->view('kamar/form', $data);
                    return;
                }
                // hapus foto lama
                if ($kamar->foto && file_exists('./upload/kamar/' . $kamar->foto)) {
                    unlink('./upload/kamar/' . $kamar->foto);
                }
                $foto = $foto_baru;
            }

            $this->model->update($id, [
                'nomor_kamar'   => $this->input->post('nomor_kamar', TRUE),
                'lantai'        => $this->input->post('lantai', TRUE),
                'id_tipe_kamar' => $this->input->post('id_tipe_kamar', TRUE),
                'foto'          => $foto,
            ]);
            $this->session->set_flashdata('success', 'Kamar berhasil diperbarui.');
            redirect('kamar');
        }
    }

    public function hapus($id) {
        $kamar = $this->model->getById($id);
        if ($kamar->foto && file_exists('./upload/kamar/' . $kamar->foto)) {
            unlink('./upload/kamar/' . $kamar->foto);
        }
        $this->model->delete($id);
        $this->session->set_flashdata('success', 'Kamar berhasil dihapus.');
        redirect('kamar');
    }

    private function _uploadFoto() {
        $config = [
            'upload_path'   => './upload/kamar/',
            'allowed_types' => 'jpg|jpeg|png',
            'max_size'      => 2048,
            'file_ext_tolower' => TRUE,
            'encrypt_name'  => TRUE,
        ];
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('foto')) {
            return FALSE;
        }
        return $this->upload->data('file_name');
    }
}
