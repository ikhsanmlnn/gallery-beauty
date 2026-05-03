<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Anggota extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Anggota', 'anggota_model');
    }

    public function index()
    {
        $data['title']    = 'Anggota Kelompok 4IA07';
        $data['active']   = 'anggota';
        $data['anggota']  = $this->anggota_model->getAll();

        $this->load->view('layouts/header', $data);
        $this->load->view('anggota/index', $data);
        $this->load->view('layouts/footer');
    }
}
