<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Galeri extends CI_Model
{
    protected $table = 'gambar';

    public function getAll($kategori = null)
    {
        if ($kategori && $kategori !== 'Semua') {
            $this->db->where('kategori', $kategori);
        }
        return $this->db->order_by('created_at', 'DESC')->get($this->table)->result_array();
    }

    public function getById($id)
    {
        return $this->db->get_where($this->table, ['id' => $id])->row_array();
    }

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    public function delete($id)
    {
        return $this->db->delete($this->table, ['id' => $id]);
    }

    public function getKategori()
    {
        $q = $this->db->select('kategori')->distinct()->get($this->table);
        return array_column($q->result_array(), 'kategori');
    }

    public function countAll()
    {
        return $this->db->count_all($this->table);
    }

    public function countByKategori()
    {
        $this->db->select('kategori, COUNT(*) as total');
        $this->db->group_by('kategori');
        return $this->db->get($this->table)->result_array();
    }
}
