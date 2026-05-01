<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pembayaran extends CI_Model {

    public function getAll() {
        $this->db->select('pembayaran.*, penghuni.nama, kamar.nomor_kamar');
        $this->db->from('pembayaran');
        $this->db->join('penghuni', 'penghuni.id = pembayaran.id_penghuni');
        $this->db->join('kamar', 'kamar.id = penghuni.id_kamar');
        $this->db->order_by('pembayaran.id', 'DESC');
        return $this->db->get()->result();
    }

    public function getById($id) {
        $this->db->select('pembayaran.*, penghuni.nama, kamar.nomor_kamar');
        $this->db->from('pembayaran');
        $this->db->join('penghuni', 'penghuni.id = pembayaran.id_penghuni');
        $this->db->join('kamar', 'kamar.id = penghuni.id_kamar');
        $this->db->where('pembayaran.id', $id);
        return $this->db->get()->row();
    }

    public function getPerBulan($tahun) {
        $this->db->select('bulan, SUM(jumlah_bayar) as total');
        $this->db->from('pembayaran');
        $this->db->where('tahun', $tahun);
        $this->db->where('status', 'lunas');
        $this->db->group_by('bulan');
        $this->db->order_by('bulan', 'ASC');
        return $this->db->get()->result();
    }

    public function insert($data) {
        return $this->db->insert('pembayaran', $data);
    }

    public function update($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('pembayaran', $data);
    }

    public function delete($id) {
        $this->db->where('id', $id);
        return $this->db->delete('pembayaran');
    }
}
