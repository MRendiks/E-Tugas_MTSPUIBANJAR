<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function cekusername()
    {
    $username = $this->input->post('username');

    $this->db->where('username', $username);
    $query = $this->db->get('tb_user')->num_rows();

    $response = array();
    if ($query > 0) {
        $response['code'] = 1;
        $response['message'] = 'Username sudah terdaftar';
    } else {
        $response['code'] = 0;
        $response['message'] = 'Username tersedia';
    }

    header('Content-Type: application/json');
    echo json_encode($response);
    }

}
