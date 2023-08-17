<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');


class Cms_update extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('username')) {
            redirect(base_url(''));
          }
    }

    public function data_guru()
    {
        $id = $this->input->post('id_guru');
        $nama = $this->input->post('editnama');
        $jabatan = $this->input->post('editjabatan');
        $birthday = $this->input->post('editbirthday');

        $data = array(
            'nama_guru' => $nama,
            'title_guru' => $jabatan,
            'ttl_guru' => $birthday
        );
        
        $this->db->where('id_guru', $id);
        $this->db->update('tb_guru', $data);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Guru Updated</div>');
        redirect(base_url('admin/guru'));
    }

    public function data_siswa()
    {
        $id = $this->input->post('id_siswa');

        $nama = $this->input->post('nama');
        $nisn = $this->input->post('nisn');
        $birthday = $this->input->post('birthday');
        $kelas = $this->input->post('kelas');

        $data = array(
            'nama_siswa' => $nama,
            'nisn' => $nisn,
            'ttl_siswa' => $birthday,
            'id_kelas' => $kelas
        );
        
        $this->db->where('id_siswa', $id);
        $this->db->update('tb_siswa', $data);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Siswa Updated</div>');
        redirect(base_url('admin/siswa'));
    }

    public function password_guru()
    {
        $id = $this->input->post('id_user');
        $password = $this->input->post('password');

        $query = $this->db->get_where('tb_guru', ['id_guru' => $id])->row();

        $data = array(
            'password' => password_hash($password, PASSWORD_DEFAULT)
        );
        
        $this->db->where('username', $query->username);
        $this->db->update('tb_user', $data);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password Guru Updated</div>');
        redirect(base_url('admin/guru'));
    }

    public function password_siswa()
    {
        $id = $this->input->post('id_user');
        $password = $this->input->post('password');

        $query = $this->db->get_where('tb_siswa', ['id_siswa' => $id])->row();

        $data = array(
            'password' => password_hash($password, PASSWORD_DEFAULT)
        );
        
        $this->db->where('username', $query->nisn);
        $this->db->update('tb_user', $data);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password Siswa Updated</div>');
        redirect(base_url('admin/siswa'));
    }

    public function data_pelajaran()
    {
        $id_pelajaran = $this->input->post('id_pelajaran');
        $editnama = $this->input->post('editnama');

        $data = array(
            'nama_pelajaran' => $editnama
        );
        
        $this->db->where('id_pelajaran', $id_pelajaran);
        $this->db->update('tb_pelajaran', $data);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Mata Pelajaran Updated</div>');
        redirect(base_url('admin/pelajaran'));
    }

    public function topik_pelajaran()
    {
        $nama = $this->input->post('editnama');
        $id_pelajaran = $this->input->post('id_pelajaran');
        $kelas = $this->input->post('kelas');
        $guru = $this->input->post('guru');
        $topik = $this->input->post('topik');
        $deksripsi = $this->input->post('deksripsi');
        $id_topik = $this->input->post('id_topik');

        $data = array(
            'id_kelas' => $kelas,
            'id_guru' => $guru,
            'judul_topik' => $topik,
            'deskripsi' => $deksripsi
        );

        $this->db->where('id_topik', $id_topik);
        $this->db->update('stb_topik_pembelajaran', $data);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Topik Pelajaran Updated</div>');
        redirect(base_url('admin/topik'));
    }

}