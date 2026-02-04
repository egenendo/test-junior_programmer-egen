<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Produk_model');
        $this->load->model('Kategori_model');
        $this->load->model('Status_model');
    }
    
    public function index()
    {
        $data['title'] = 'Produk';
        try {
            $data_produk = $this->Produk_model->fetch_api_data();

            if (!empty($data_produk)){
                $this->Produk_model->sync_products($data_produk);
            }

            $data['produk'] = $this->Produk_model->get_produk_aktif();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('pages/produk/index', $data);
            $this->load->view('templates/footer');
        } catch (Exception $error) {
            log_message('error', 'Terjadi kesalahan di Produk/index: ' . $error->getMessage());
            $this->session->set_flashdata('error', 'Gagal memuat data: ' . $error->getMessage());
            redirect('produk');
        }
    }

    public function create(){
        $data['title'] = 'Create Produk';
        $data['data_kategori'] = $this->Kategori_model->get_kategori();
        $data['data_status'] = $this->Status_model->get_status();
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('pages/produk/create', $data);
        $this->load->view('templates/footer');
    }

    public function store(){
        $this->load->library('form_validation');

        $this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required', [
            'required' => 'Nama produk harus di isi!'
        ]);
        $this->form_validation->set_rules('harga', 'Harga', 'required', [
            'required' => 'Harga harus di isi!'
        ]);
        $this->form_validation->set_rules('kategori_id', 'Kategori', 'required', [
            'required' => 'Kategori harus di isi!'
        ]);
        $this->form_validation->set_rules('status_id', 'Status', 'required', [
            'required' => 'Nama produk harus di isi!'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = [
                'nama_produk' => $this->input->post('nama_produk'),
                'harga' => $this->input->post('harga'),
                'kategori_id' => $this->input->post('kategori_id'),
                'status_id' => $this->input->post('status_id')
            ];

            $this->Produk_model->insert_produk($data);
            $this->session->set_flashdata('success', '<div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-check"></i> Success!</h5>
                  Data Produk Behasil Ditambahkan!
                </div>');
            
            redirect('produk');
            
        }
    }

    public function edit($id_produk){
        $data['title'] = 'Edit Produk';
        $data['data_kategori'] = $this->Kategori_model->get_kategori();
        $data['data_status'] = $this->Status_model->get_status();
        $data['produk'] = $this->Produk_model->get_detail_produk($id_produk);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('pages/produk/edit', $data);
        $this->load->view('templates/footer');
    }

    public function update($id_produk){
        $this->load->library('form_validation');

        $this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required', [
            'required' => 'Nama produk harus di isi!'
        ]);
        $this->form_validation->set_rules('harga', 'Harga', 'required', [
            'required' => 'Harga harus di isi!'
        ]);
        $this->form_validation->set_rules('kategori_id', 'Kategori', 'required', [
            'required' => 'Kategori harus di isi!'
        ]);
        $this->form_validation->set_rules('status_id', 'Status', 'required', [
            'required' => 'Nama produk harus di isi!'
        ]);

        if ($this->form_validation->run() == FALSE) {
            $this->edit($id_produk);
        } else {
            $data = [
                'nama_produk' => $this->input->post('nama_produk'),
                'harga' => $this->input->post('harga'),
                'kategori_id' => $this->input->post('kategori_id'),
                'status_id' => $this->input->post('status_id')
            ];

            $this->Produk_model->update_produk($data, $id_produk);
            $this->session->set_flashdata('success', '<div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-check"></i> Success!</h5>
                  Data Produk Behasil Diubah!
                </div>');
            
            redirect('produk');
            
        }
    }

    public function delete($id_produk){
        $this->Produk_model->delete_produk($id_produk);
        $this->session->set_flashdata('success', '<div class="alert alert-warning alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h5><i class="icon fas fa-check"></i> Deleted!</h5>
          Data Produk Berhasil Dihapus!
        </div>');

        redirect('produk');

    }
}

/* End of file Produk.php */
