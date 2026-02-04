<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Status_model extends CI_Model {

    public function get_status(){
        return $this->db->get('status')->result();
    }

}

/* End of file Status_model.php */
