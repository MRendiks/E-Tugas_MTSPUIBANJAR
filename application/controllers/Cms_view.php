<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Cms_view extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('username') || $this->session->userdata('role_user') != 1) {
            redirect(base_url(''));
        }
        
    }

    public function dashboard()
    {
        $id_data  = $this->session->userdata('id_data');

        $data['title'] = 'Admin Dashboad';
        $data['page'] = 'dashboard';
        $data['user'] = $this->db->get_where('tb_admin', ['id_admin' => $id_data])->row_array();
        
        $this->load->view('cms/templates/header', $data);
        $this->load->view('cms/dashboard');
        $this->load->view('cms/templates/footer');
        
    }

    public function guru()
    {
        $id_data  = $this->session->userdata('id_data');

        $data['title'] = 'Admin Guru';
        $data['page'] = 'guru';
        $data['user'] = $this->db->get_where('tb_admin', ['id_admin' => $id_data])->row_array();
        $data['guru'] = $this->db->select('*')->from('tb_guru')->join('tb_user', 'tb_guru.id_guru = tb_user.id_data')->get()->result_array();
        
        $this->load->view('cms/templates/header', $data);
        $this->load->view('cms/guru');
        $this->load->view('cms/templates/footer');
        
    }

    public function siswa()
    {
        $id_data  = $this->session->userdata('id_data');

        $data['title'] = 'Admin Siswa';
        $data['page'] = 'siswa';
        $data['user'] = $this->db->get_where('tb_admin', ['id_admin' => $id_data])->row_array();
        $data['siswa'] = $this->db->select('*')->from('tb_siswa')->join('tb_kelas', 'tb_siswa.id_kelas = tb_kelas.id_kelas')->get()->result_array();
        $data['kelas'] = $this->db->get('tb_kelas')->result_array();
        
        $this->load->view('cms/templates/header', $data);
        $this->load->view('cms/siswa');
        $this->load->view('cms/templates/footer');
        
    }

    public function wali()
    {
        $id_data  = $this->session->userdata('id_data');

        $data['title'] = 'Admin wali';
        $data['page'] = 'wali';
        $data['user'] = $this->db->get_where('tb_admin', ['id_admin' => $id_data])->row_array();
        $data['wali'] = $this->db->select('*')->from('tb_orangtua')->join('tb_siswa', 'tb_orangtua.parent = tb_siswa.nisn')->get()->result_array();
        
        $this->load->view('cms/templates/header', $data);
        $this->load->view('cms/wali');
        $this->load->view('cms/templates/footer');
        
    }

    public function kelas()
    {
        $id_data  = $this->session->userdata('id_data');

        $data['title'] = 'Admin kelas';
        $data['page'] = 'kelas';
        $data['user'] = $this->db->get_where('tb_admin', ['id_admin' => $id_data])->row_array();
        $data['kelas'] = $this->db->get('tb_kelas')->result_array();
        
        $this->load->view('cms/templates/header', $data);
        $this->load->view('cms/kelas');
        $this->load->view('cms/templates/footer');
        
    }

    public function anggota_kelas($id){
        $id_data  = $this->session->userdata('id_data');
        $anggota =  $this->db->select('id_siswa, nama_siswa, nisn, ttl_siswa, nama_kelas')->from('tb_siswa')->join('tb_kelas', 'tb_siswa.id_kelas = tb_kelas.id_kelas')->where('tb_kelas.id_kelas', $id)->get()->result_array();
        $kelas = $this->db->get_where('tb_kelas', ['id_kelas' => $id])->row();

        $data['title'] = 'Admin Anggota Kelas ' . $kelas->nama_kelas;
        $data['page'] = 'kelas';
        $data['user'] = $this->db->get_where('tb_admin', ['id_admin' => $id_data])->row_array();
        $data['anggota'] = $anggota;
        
        $this->load->view('cms/templates/header', $data);
        $this->load->view('cms/anggota_kelas');
        $this->load->view('cms/templates/footer');
    }

    public function pelajaran(){
        $id_data  = $this->session->userdata('id_data');

        $data['title'] = 'Admin Topi Pembelajaran';
        $data['page'] = 'pelajaran';
        $data['user'] = $this->db->get_where('tb_admin', ['id_admin' => $id_data])->row_array();
        $data['pelajaran'] = $this->db->get('tb_pelajaran')->result_array();

        $data['kelas'] = $this->db->get('tb_kelas')->result_array();
        $data['guru'] = $this->db->get('tb_guru')->result_array();
        
        $this->load->view('cms/templates/header', $data);
        $this->load->view('cms/pelajaran');
        $this->load->view('cms/templates/footer');
    }

    public function topik(){
        $id_data  = $this->session->userdata('id_data');

        $data['title'] = 'Admin Topi Pembelajaran';
        $data['page'] = 'pelajaran';
        $data['user'] = $this->db->get_where('tb_admin', ['id_admin' => $id_data])->row_array();

        $data['pelajaran'] = $this->db->select('tb_kelas.nama_kelas, tb_guru.nama_guru, tb_kelas.id_kelas, tb_pelajaran.nama_pelajaran, stb_topik_pembelajaran.judul_topik, stb_topik_pembelajaran.id_topik, tb_pelajaran.id_pelajaran')
        ->from('tb_kelas')
        ->join('stb_topik_pembelajaran', 'tb_kelas.id_kelas = stb_topik_pembelajaran.id_kelas')
        ->join('tb_guru', 'tb_guru.id_guru = stb_topik_pembelajaran.id_guru')
        ->join('tb_pelajaran', 'tb_pelajaran.id_pelajaran = stb_topik_pembelajaran.id_pelajaran')
        ->get()
        ->result_array();

        $data['kelas'] = $this->db->get('tb_kelas')->result_array();
        $data['guru'] = $this->db->get('tb_guru')->result_array();
        
        $this->load->view('cms/templates/header', $data);
        $this->load->view('cms/topik');
        $this->load->view('cms/templates/footer');
    }

    public function detail_pelajaran($id){
        $id_data  = $this->session->userdata('id_data');

        $data['pelajaran'] = $this->db->select('tb_kelas.nama_kelas, tb_guru.nama_guru, tb_kelas.id_kelas, tb_pelajaran.nama_pelajaran')
        ->from('tb_kelas')
        ->join('stb_topik_pembelajaran', 'tb_kelas.id_kelas = stb_topik_pembelajaran.id_kelas')
        ->join('tb_guru', 'tb_guru.id_guru = stb_topik_pembelajaran.id_guru')
        ->join('tb_pelajaran', 'tb_pelajaran.id_pelajaran = stb_topik_pembelajaran.id_pelajaran')
        ->where('stb_topik_pembelajaran.id_pelajaran', $id)
        ->get()
        ->result_array();

        $data['title'] = 'Admin Topi Pembelajaran';
        $data['page'] = 'pelajaran';
        $data['user'] = $this->db->get_where('tb_admin', ['id_admin' => $id_data])->row_array();
        
        
        $this->load->view('cms/templates/header', $data);
        $this->load->view('cms/detail_pelajaran');
        $this->load->view('cms/templates/footer');
    }

    public function notif()
    {
        $id_data  = $this->session->userdata('id_data');

        $data['title'] = 'Notifikasi';
        $data['page'] = 'notif';
        $data['user'] = $this->db->get_where('tb_admin', ['id_admin' => $id_data])->row_array();
        $data['guru'] = $this->db->select('*')->from('tb_guru')->join('tb_user', 'tb_guru.id_guru = tb_user.id_data')->get()->result_array();

        $data['notif'] = $this->db->select('tb_notification.id_notif, tb_notification.time, tb_notification.category, tb_orangtua.nama_ortu, tb_siswa.nama_siswa')
        ->from('tb_notification')
        ->join('tb_siswa', 'tb_notification.id_siswa = tb_siswa.id_siswa')
        ->join('tb_orangtua', 'tb_notification.id_wali = tb_orangtua.id_ortu')
        ->get()
        ->result_array();
        
        $this->load->view('cms/templates/header', $data);
        $this->load->view('cms/notif');
        $this->load->view('cms/templates/footer');
        
    }
}