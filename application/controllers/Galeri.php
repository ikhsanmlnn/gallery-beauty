<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Galeri extends CI_Controller
{
    private $uploadPath = './upload/images/';
    private $allowedTypes = 'jpg|jpeg|png|gif|webp';
    private $maxSize = 15360; 

    // Kategori yang tersedia
    private $kategoriList = ['Nature', 'Architecture', 'Technology', 'Art', 'Sports', 'Culinary', 'Fashion', 'Travel', 'General'];
    private $warnaList = ['#FF6B6B','#FF8E53','#FFC300','#4ECDC4','#6C63FF','#45B7D1','#96CEB4','#E84393','#A8E6CF'];

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Galeri', 'galeri_model');
        $this->load->library('form_validation');

        // Pastikan folder upload ada
        if (!is_dir($this->uploadPath)) {
            mkdir($this->uploadPath, 0755, TRUE);
        }
    }

    /* INDEX / GALLERY */
    public function index()
    {
        $kategori = $this->input->get('kategori');

        $data['title']       = 'Gallery Beauty — Beranda';
        $data['active']      = 'galeri';
        $data['gambar']      = $this->galeri_model->getAll($kategori);
        $data['kategoriList'] = array_merge(['Semua'], $this->kategoriList);
        $data['aktifKat']    = $kategori ?: 'Semua';
        $data['totalGambar'] = $this->galeri_model->countAll();
        $data['flash_success'] = $this->session->flashdata('success');
        $data['flash_error']   = $this->session->flashdata('error');

        $this->load->view('layouts/header', $data);
        $this->load->view('galeri/index', $data);
        $this->load->view('layouts/footer');
    }

    /* DETAIL */
    public function detail($id)
    {
        $gambar = $this->galeri_model->getById($id);
        if (!$gambar) {
            $this->session->set_flashdata('error', 'Image not found.');
            redirect('galeri');
        }

        $data['title']  = 'Detail — ' . $gambar['judul'];
        $data['active'] = 'galeri';
        $data['gambar'] = $gambar;

        $this->load->view('layouts/header', $data);
        $this->load->view('galeri/detail', $data);
        $this->load->view('layouts/footer');
    }

    /*  CREATE FORM  */
    public function create()
    {
        $data['title']       = 'Explore Your New Imagination';
        $data['active']      = 'galeri';
        $data['kategoriList'] = $this->kategoriList;
        $data['warnaList']   = $this->warnaList;

        $this->load->view('layouts/header', $data);
        $this->load->view('galeri/create', $data);
        $this->load->view('layouts/footer');
    }

    /*  STORE (POST)  */
    public function store()
    {
        $this->form_validation->set_rules('judul',     'Judul',     'required|max_length[150]');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');
        $this->form_validation->set_rules('kategori',  'Kategori',  'required');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('galeri/create');
            return;
        }

        // Upload gambar
        $config = [
            'upload_path'       => $this->uploadPath,
            'allowed_types'     => $this->allowedTypes,
            'max_size'          => $this->maxSize,
            'file_ext_tolower'  => TRUE,
            'encrypt_name'      => TRUE,
        ];
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('gambar')) {
            $this->session->set_flashdata('error', strip_tags($this->upload->display_errors()));
            redirect('galeri/create');
            return;
        }

        $upload   = $this->upload->data();
        $warna    = $this->input->post('warna') ?: $this->warnaList[array_rand($this->warnaList)];
        $kategori = $this->input->post('kategori', TRUE);

        $this->galeri_model->insert([
            'judul'      => $this->input->post('judul', TRUE),
            'deskripsi'  => $this->input->post('deskripsi', TRUE),
            'kategori'   => in_array($kategori, $this->kategoriList) ? $kategori : 'Umum',
            'filename'   => $upload['file_name'],
            'warna'      => preg_match('/^#[0-9A-Fa-f]{6}$/', $warna) ? $warna : '#6C63FF',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        $this->session->set_flashdata('success', 'Image added successfully!');
        redirect('galeri');
    }

    /* EDIT FORM  */
    public function edit($id)
    {
        $gambar = $this->galeri_model->getById($id);
        if (!$gambar) {
            $this->session->set_flashdata('error', 'Image not found.');
            redirect('galeri');
        }

        $data['title']        = 'Edit Image';
        $data['active']       = 'galeri';
        $data['gambar']       = $gambar;
        $data['kategoriList'] = $this->kategoriList;
        $data['warnaList']    = $this->warnaList;

        $this->load->view('layouts/header', $data);
        $this->load->view('galeri/edit', $data);
        $this->load->view('layouts/footer');
    }

    /*  UPDATE (POST) */
    public function update($id)
    {
        $gambar = $this->galeri_model->getById($id);
        if (!$gambar) {
            $this->session->set_flashdata('error', 'Image not found.');
            redirect('galeri');
        }

        $this->form_validation->set_rules('judul',     'Judul',     'required|max_length[150]');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');
        $this->form_validation->set_rules('kategori',  'Kategori',  'required');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('galeri/edit/' . $id);
            return;
        }

        $filename = $gambar['filename'];

        if (!empty($_FILES['gambar']['name'])) {
            $config = [
                'upload_path'      => $this->uploadPath,
                'allowed_types'    => $this->allowedTypes,
                'max_size'         => $this->maxSize,
                'file_ext_tolower' => TRUE,
                'encrypt_name'     => TRUE,
            ];
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('gambar')) {
                $this->session->set_flashdata('error', strip_tags($this->upload->display_errors()));
                redirect('galeri/edit/' . $id);
                return;
            }

            $oldFile = $this->uploadPath . $gambar['filename'];
            if (file_exists($oldFile)) {
                @unlink($oldFile);
            }

            $filename = $this->upload->data('file_name');
        }

        $warna    = $this->input->post('warna') ?: $gambar['warna'];
        $kategori = $this->input->post('kategori', TRUE);

        $this->galeri_model->update($id, [
            'judul'      => $this->input->post('judul', TRUE),
            'deskripsi'  => $this->input->post('deskripsi', TRUE),
            'kategori'   => in_array($kategori, $this->kategoriList) ? $kategori : 'Umum',
            'filename'   => $filename,
            'warna'      => preg_match('/^#[0-9A-Fa-f]{6}$/', $warna) ? $warna : $gambar['warna'],
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        $this->session->set_flashdata('success', 'Image updated successfully!');
        redirect('galeri');
    }

    /* DELETE  */
    public function delete($id)
    {
        $gambar = $this->galeri_model->getById($id);
        if ($gambar) {
            $file = $this->uploadPath . $gambar['filename'];
            if (file_exists($file)) {
                @unlink($file);
            }
            $this->galeri_model->delete($id);
            $this->session->set_flashdata('success', 'Image deleted successfully.');
        } else {
            $this->session->set_flashdata('error', 'Image not found.');
        }
        redirect('galeri');
    }
}
