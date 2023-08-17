<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Cms_save extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('username')) {
          redirect(base_url(''));
        }
    }

    public function addguru(){
      $nama = $this->input->post('nama');
      $jabatan = $this->input->post('jabatan');
      $birthday = $this->input->post('birthday');
      $username = $this->input->post('username');
  
      $password = date("dmY", strtotime($birthday));
  
      $this->db->trans_start();
  
      $data1 = array(
          'nama_guru' => $nama,
          'title_guru' => $jabatan,
          'ttl_guru' => $birthday
      );
  
      $query = $this->db->insert('tb_guru', $data1);
      $id_data = $this->db->insert_id();
  
      if($query){
          $data2 = array(
              'id_data' => $id_data,
              'role_user' => 2,
              'username' => $username,
              'password' => password_hash($password, PASSWORD_DEFAULT)
          );
  
          $query2 = $this->db->insert('tb_user', $data2);
  
          if($query2){
              $this->db->trans_commit();
              $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Tambah Data Guru Sukses</div>');
              redirect(base_url('admin/guru'));
          } else {
              $this->db->trans_rollback();
              $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal menambah data guru</div>');
              redirect(base_url('admin/guru'));
          }
      } else {
          $this->db->trans_rollback();
          $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal menambah data guru</div>');
          redirect(base_url('admin/guru'));
      }
    }

    public function addsiswa(){
      $nama = $this->input->post('nama');
      $nisn = $this->input->post('nisn');
      $birthday = $this->input->post('birthday');
      $kelas = $this->input->post('kelas');
  
      $password = date("dmY", strtotime($birthday));
  
      $this->db->trans_start();
  
      $data1 = array(
          'nama_siswa' => $nama,
          'nisn' => $nisn,
          'ttl_siswa' => $birthday,
          'id_kelas' => $kelas
      );
  
      $query = $this->db->insert('tb_siswa', $data1);
      $id_data = $this->db->insert_id();
  
      if($query){
          $data2 = array(
              'id_data' => $id_data,
              'role_user' => 3,
              'username' => $nisn,
              'password' => password_hash($password, PASSWORD_DEFAULT)
          );
  
          $query2 = $this->db->insert('tb_user', $data2);
  
          if($query2){
              $this->db->trans_commit();
              $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Tambah Data siswa Sukses</div>');
              redirect(base_url('admin/siswa'));
          } else {
              $this->db->trans_rollback();
              $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal menambah data siswa</div>');
              redirect(base_url('admin/siswa'));
          }
      } else {
          $this->db->trans_rollback();
          $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal menambah data siswa</div>');
          redirect(base_url('admin/siswa'));
      }
    }

    public function addmapel(){
        $nama = $this->input->post('nama'); 

        $data = array(
            'nama_pelajaran' => $nama
        );
    
        $query = $this->db->insert('tb_pelajaran', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Tambah Pelajaran Berhasil</div>');
        redirect(base_url('admin/pelajaran'));
    }

    public function addkelas(){
        $nama = $this->input->post('nama'); 

        $data = array(
            'nama_kelas' => $nama
        );
    
        $query = $this->db->insert('tb_kelas', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Tambah Kelas Berhasil</div>');
        redirect(base_url('admin/kelas'));
    }
    
    public function topik_pelajaran(){
        $nama = $this->input->post('editnama');
        $id_pelajaran = $this->input->post('id_pelajaran');
        $kelas = $this->input->post('kelas');
        $guru = $this->input->post('guru');
        $topik = $this->input->post('topik');
        $deksripsi = $this->input->post('deksripsi');

        $data = array(
            'id_pelajaran' => $id_pelajaran,
            'id_kelas' => $kelas,
            'id_guru' => $guru,
            'judul_topik' => $topik,
            'deskripsi' => $deksripsi
        );
        $this->db->insert('stb_topik_pembelajaran', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Tambah Kelas Berhasil</div>');
        redirect(base_url('admin/pelajaran'));
    }
}