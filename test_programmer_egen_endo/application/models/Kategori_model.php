<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_model extends CI_Model {

    public function get_kategori(){
        return $this->db->get('kategori')->result();
    }

}

/* End of file Kategori_model.php */
