<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_tipe_kamar extends CI_Model {

    public function getAll() {
        return $this->db->get('tipe_kamar')->result();
    }

    public function getById($id) {
        return $this->db->get_where('tipe_kamar', ['id' => $id])->row();
    }

    public function insert($data) {
        return $this->db->insert('tipe_kamar', $data);
    }

    public function update($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('tipe_kamar', $data);
    }

    public function delete($id) {
        $this->db->where('id', $id);
        return $this->db->delete('tipe_kamar');
    }
}
