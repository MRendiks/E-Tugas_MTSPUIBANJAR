<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		$this->form_validation->set_rules('answer', 'Answer', 'trim|required');

		if ($this->form_validation->run() == false) {
			$this->load->view('login/templates/header');
			$this->load->view('login/login');
			$this->load->view('login/templates/footer');
		} else {
			// validasi sukses
			$this->_login();
		}
    }

    private function _login()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$firstNumber = $this->input->post('firstNumber');
		$secondNumber = $this->input->post('secondNumber');
		$answer = $this->input->post('answer');

		$key = $firstNumber + $secondNumber;

		$user = $this->db->get_where('tb_user', ['username' => $username])->row_array();

		// jika chaptcha benar
		if ($answer == $key) {
			// jika usernya ada
			if ($user) {
				// cek password
				if (password_verify($password, $user['password'])) {
					$data = [
						'username' => $user['username'],
						'role_user' => $user['role_user'],
						'id_data' => $user['id_data']
					];
					$this->session->set_userdata($data);
					if ($user['role_user'] == 1) {
						redirect(base_url('admin/dashboard'));
					} elseif ($user['role_user'] == 2) {
						redirect(base_url('guru/dashboard'));
					} else {
						$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Akses Tidak Ditemukan</div>');
						redirect(base_url(''));
					}
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong password!</div>');
					redirect(base_url(''));
				}
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Username is not registered!</div>');
				redirect(base_url(''));
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong Captcha!</div>');
			redirect(base_url(''));
		}
	}

    public function logout()
	{
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('role_id');

		redirect(base_url(''));
	}

	public function registration()
	{
		$this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[tb_user.username]', [
			'is_unique' => 'This username has already registered!'
		]);
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');

		if ($this->form_validation->run() == false) {
			$this->load->view('login/templates/header');
			$this->load->view('login/registration');
			$this->load->view('login/templates/footer');
		} else {
			$username = $this->input->post('username', true);
			$password = $this->input->post('password', true);
			$nama = $this->input->post('nama', true);

			$this->db->trans_start();
  
			$data1 = array(
				'nama_admin' => $nama
			);
		
			$query = $this->db->insert('tb_admin', $data1);
			$id_data = $this->db->insert_id();
		
			if($query){
				$data2 = array(
					'id_data' => $id_data,
					'role_user' => 1,
					'username' => $username,
					'password' => password_hash($password, PASSWORD_DEFAULT)
				);
		
				$query2 = $this->db->insert('tb_user', $data2);
		
				if($query2){
					$this->db->trans_commit();
					$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Tambah Data Guru Sukses</div>');
					redirect(base_url(''));
				} else {
					$this->db->trans_rollback();
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal menambah data guru</div>');
					redirect(base_url(''));
				}
			} else {
				$this->db->trans_rollback();
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal menambah data guru</div>');
				redirect(base_url(''));
			}
		}
	}
}