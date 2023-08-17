<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Cms_delete extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('username')) {
            redirect(base_url(''));
          }
    }

    public function delete_guru($id)
    {
        $query = $this->db->select('*')->from('tb_guru')->join('tb_user', 'tb_guru.username = tb_user.username')->where('tb_guru.id_guru', $id)->get()->row();

        $this->db->delete('tb_guru', ['id_guru' => $id]);
        $this->db->delete('tb_user', ['username' => $query->username]);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Guru Deleted</div>');
        redirect(base_url('admin/guru'));
    }

    public function delete_siswa($id)
    {
        $query = $this->db->select('*')->from('tb_siswa')->join('tb_user', 'tb_siswa.nisn = tb_user.username')->where('tb_siswa.id_siswa', $id)->get()->row();

        $this->db->delete('tb_siswa', ['id_siswa' => $id]);
        $this->db->delete('tb_user', ['username' => $query->nisn]);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Siswa Deleted</div>');
        redirect(base_url('admin/siswa'));
    }

    public function delete_pelajaran($id)
    {
        $this->db->delete('tb_pelajaran', ['id_pelajaran' => $id]);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Mata Pelajaran Deleted</div>');
        redirect(base_url('admin/pelajaran'));
    }

    public function delete_kelas($id)
    {
        $this->db->delete('tb_kelas', ['id_kelas' => $id]);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Kelas Deleted</div>');
        redirect(base_url('admin/kelas'));
    }

    public function delete_topik($id)
    {
        $this->db->delete('stb_topik_pembelajaran', ['id_topik' => $id]);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Topik Pembelajaran Deleted</div>');
        redirect(base_url('admin/topik'));
    }

    public function delete_materi($id)
    {
        $query = $this->db->get_where('tb_materi', $id)->row();
        
        unlink(FCPATH . 'assets/materi/' . $query->file_materi);

        $this->db->delete('tb_materi', ['id_materi' => $id]);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Materi Deleted</div>');
        redirect(base_url('guru/materi'));
    }
}