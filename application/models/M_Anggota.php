<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Anggota extends CI_Model
{
    protected $table = 'anggota';

    public function getAll()
    {
        return $this->db->get($this->table)->result_array();
    }
}
