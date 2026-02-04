<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Produk_model extends CI_Model {

    private function get_auth(){
        date_default_timezone_set('Asia/Jakarta');

        $tgl = date('d');
        $bln = date('m');
        $thn = date('y');
        $jam = date ('H');

        return [
            'username' => "tesprogrammer" . $tgl . $bln . $thn . "C" . $jam,
            'password' => md5("bisacoding-$tgl-$bln-$thn")
        ];

    }

    public function fetch_api_data(){
        $url  = "https://recruitment.fastprint.co.id/tes/api_tes_programmer";
        $auth = $this->get_auth();

        try{
            $curl_handle = curl_init($url);
            curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl_handle, CURLOPT_POST, true);
            curl_setopt($curl_handle, CURLOPT_POSTFIELDS, http_build_query($auth));

            $response = curl_exec($curl_handle);
            if (curl_errno($curl_handle)) {
                throw new Exception(curl_error($curl_handle));
            }

            curl_close($curl_handle);

            $result = json_decode($response, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new Exception('Response API bukan format JSON yang valid');
            }

            return (isset($result['error']) && $result['error'] == 0) ? $result['data'] : [];

        } catch (Exception $error) {
            log_message('error', 'API Fetch Error: ' . $error->getMessage());
            return [];
        } 
    }

    public function sync_products($data_produk){
        if(empty($data_produk)) return false;

        $this->db->trans_start();
        
        foreach ($data_produk as $produk){
            $kategori_id = $this->_get_or_insert('kategori', 'nama_kategori', $produk['kategori']);
            $status_id = $this->_get_or_insert('status', 'nama_status', $produk['status']);

            $data_produk_db = [
                'id_produk' => $produk['id_produk'],
                'nama_produk' => $produk['nama_produk'],
                'harga' => $produk['harga'],
                'kategori_id' => $kategori_id,
                'status_id' => $status_id
            ];

            $this->db->replace('produk', $data_produk_db);
        }

        $this->db->trans_complete();

        return $this->db->trans_status();
    }

    private function _get_or_insert($table, $column, $value) {
        $query = $this->db->get_where($table, [$column => $value])->row();
        if($query) {
            $primary_key = 'id_' . $table;
            return $query->$primary_key;
        } else {
            $this->db->insert($table, [$column => $value]);
            return $this->db->insert_id();
        }
    }

    public function get_produk_aktif(){
        $this->db->select('produk.*, kategori.nama_kategori, status.nama_status');
        $this->db->from('produk');
        $this->db->join('kategori', 'kategori.id_kategori = produk.kategori_id');
        $this->db->join('status', 'status.id_status = produk.status_id');
        $this->db->where('status.nama_status', 'bisa dijual');
        return $this->db->get()->result();
    }

    public function insert_produk($data){
        return $this->db->insert('produk', $data);
    }

    public function get_detail_produk($id_produk){
      return $this->db->get_where('produk', ['id_produk' => $id_produk])->row();
    }

    public function update_produk($data, $id_produk){
      return $this->db->update('produk', $data, ['id_produk' => $id_produk]);
    }

    public function delete_produk($id_produk){
        return $this->db->delete('produk', ['id_produk' => $id_produk]);
    }

}

/* End of file ModelName.php */
