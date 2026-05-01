<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kamar extends CI_Model {

    public function getAll() {
        $this->db->select('kamar.*, tipe_kamar.nama_tipe, tipe_kamar.harga');
        $this->db->from('kamar');
        $this->db->join('tipe_kamar', 'tipe_kamar.id = kamar.id_tipe_kamar');
        return $this->db->get()->result();
    }

    public function getById($id) {
        $this->db->select('kamar.*, tipe_kamar.nama_tipe, tipe_kamar.harga');
        $this->db->from('kamar');
        $this->db->join('tipe_kamar', 'tipe_kamar.id = kamar.id_tipe_kamar');
        $this->db->where('kamar.id', $id);
        return $this->db->get()->row();
    }

    public function getTersedia() {
        return $this->db->get_where('kamar', ['status' => 'tersedia'])->result();
    }

    public function countByStatus() {
        $this->db->select('status, COUNT(*) as total');
        $this->db->from('kamar');
        $this->db->group_by('status');
        return $this->db->get()->result();
    }

    public function insert($data) {
        return $this->db->insert('kamar', $data);
    }

    public function update($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('kamar', $data);
    }

    public function updateStatus($id, $status) {
        $this->db->where('id', $id);
        return $this->db->update('kamar', ['status' => $status]);
    }

    public function delete($id) {
        $this->db->where('id', $id);
        return $this->db->delete('kamar');
    }
}
