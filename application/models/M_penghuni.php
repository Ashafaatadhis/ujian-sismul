<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_penghuni extends CI_Model {

    public function getAll() {
        $this->db->select('penghuni.*, kamar.nomor_kamar, tipe_kamar.nama_tipe');
        $this->db->from('penghuni');
        $this->db->join('kamar', 'kamar.id = penghuni.id_kamar');
        $this->db->join('tipe_kamar', 'tipe_kamar.id = kamar.id_tipe_kamar');
        return $this->db->get()->result();
    }

    public function getById($id) {
        $this->db->select('penghuni.*, kamar.nomor_kamar, tipe_kamar.nama_tipe, tipe_kamar.harga');
        $this->db->from('penghuni');
        $this->db->join('kamar', 'kamar.id = penghuni.id_kamar');
        $this->db->join('tipe_kamar', 'tipe_kamar.id = kamar.id_tipe_kamar');
        $this->db->where('penghuni.id', $id);
        return $this->db->get()->row();
    }

    public function insert($data) {
        return $this->db->insert('penghuni', $data);
    }

    public function update($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('penghuni', $data);
    }

    public function delete($id) {
        $this->db->where('id', $id);
        return $this->db->delete('penghuni');
    }
}
