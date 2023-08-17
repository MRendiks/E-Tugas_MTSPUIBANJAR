<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Guru_view extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('username') || $this->session->userdata('role_user') != 2) {
            redirect(base_url(''));
        }
    }

    public function dashboard()
    {
        $id_data  = $this->session->userdata('id_data');

        $data['title'] = 'Guru Dashboad';
        $data['page'] = 'dashboard';
        $data['user'] = $this->db->get_where('tb_guru', ['id_guru' => $id_data])->row_array();

        $data['alltugas'] = $this->db->get_where('stb_tugas', ['id_guru' => $id_data])->num_rows();
        $data['ontugas'] = $this->db->select('*')->where('id_guru', $id_data)->where('deadline >=', time())->get('stb_tugas')->num_rows();
        $data['jawaban'] = $this->db->get_where('stb_pengumpulan_tugas', ['id_guru' => $id_data])->num_rows();
        $data['materi'] = $this->db->get_where('tb_materi', ['id_guru' => $id_data])->num_rows();
        $data['siswa'] = $this->db->select('*')->join('tb_kelas', 'stb_topik_pembelajaran.id_kelas = tb_kelas.id_kelas')->join('tb_guru', 'stb_topik_pembelajaran.id_guru = tb_guru.id_guru')->join('tb_siswa', 'tb_kelas.id_kelas = tb_siswa.id_kelas')->where('tb_guru.id_guru', $id_data)->get('stb_topik_pembelajaran')->num_rows();
        $data['kelas'] = $this->db->get_where('stb_topik_pembelajaran', ['id_guru' =>   $id_data])->num_rows();
        $data['guru'] = $this->db->select('*')->from('tb_guru')->join('tb_user', 'tb_guru.id_guru = tb_user.id_data')->where('tb_guru.id_guru', $id_data)->get()->result_array();

        $this->load->view('guru/templates/header', $data);
        $this->load->view('guru/dashboard');
        $this->load->view('guru/templates/footer');
        
    }

    public function kelas()
    {
        $id_data  = $this->session->userdata('id_data');

        $data['pelajaran'] = $this->db->select('tb_guru.id_guru, stb_topik_pembelajaran.id_topik, tb_guru.nama_guru, tb_pelajaran.nama_pelajaran, tb_pelajaran.id_pelajaran, tb_kelas.nama_kelas, tb_kelas.id_kelas')
        ->from('tb_kelas')
        ->join('stb_topik_pembelajaran', 'tb_kelas.id_kelas = stb_topik_pembelajaran.id_kelas')
        ->join('tb_guru', 'tb_guru.id_guru = stb_topik_pembelajaran.id_guru')
        ->join('tb_pelajaran', 'tb_pelajaran.id_pelajaran = stb_topik_pembelajaran.id_pelajaran')
        ->where('stb_topik_pembelajaran.id_guru', $id_data)
        ->get()
        ->result_array();

        $data['title'] = 'Guru Kelas';
        $data['page'] = 'kelas';
        $data['user'] = $this->db->get_where('tb_guru', ['id_guru' => $id_data])->row_array();
        $data['guru'] = $this->db->select('*')->from('tb_guru')->join('tb_user', 'tb_guru.id_guru = tb_user.id_data')->where('tb_guru.id_guru', $id_data)->get()->result_array();
        
        $this->load->view('guru/templates/header', $data);
        $this->load->view('guru/kelas');
        $this->load->view('guru/templates/footer');
        
    }

    public function siswakelas($id){
        $id_data  = $this->session->userdata('id_data');
        $data['pelajaran'] = $this->db->select('nama_kelas, nama_siswa, nisn')
        ->from('tb_kelas')
        ->join('tb_siswa', 'tb_kelas.id_kelas = tb_siswa.id_kelas')
        ->where('tb_kelas.id_kelas', $id)
        ->get()
        ->result_array();

        $data['title'] = 'Detail Siswa Kelas';
        $data['page'] = 'kelas';
        $data['user'] = $this->db->get_where('tb_guru', ['id_guru' => $id_data])->row_array();
        $data['kelas'] = $this->db->get_where('tb_kelas', ['id_kelas' => $id])->row();
        $data['guru'] = $this->db->select('*')->from('tb_guru')->join('tb_user', 'tb_guru.id_guru = tb_user.id_data')->where('tb_guru.id_guru', $id_data)->get()->result_array();

        $this->load->view('guru/templates/header', $data);
        $this->load->view('guru/siswakelas');
        $this->load->view('guru/templates/footer');
    }

    public function siswa()
    {
        $id_data  = $this->session->userdata('id_data');

        $data['title'] = 'Guru Siswa';
        $data['page'] = 'siswa';
        $data['user'] = $this->db->get_where('tb_guru', ['id_guru' => $id_data])->row_array();
        $data['guru'] = $this->db->select('*')->from('tb_guru')->join('tb_user', 'tb_guru.id_guru = tb_user.id_data')->where('tb_guru.id_guru', $id_data)->get()->result_array();
        
        $this->load->view('guru/templates/header', $data);
        $this->load->view('guru/siswa');
        $this->load->view('guru/templates/footer');
        
    }

    public function materi()
    {
        $id_data  = $this->session->userdata('id_data');

        $data['title'] = 'Guru Meteri';
        $data['page'] = 'materi';
        $data['user'] = $this->db->get_where('tb_guru', ['id_guru' => $id_data])->row_array();

        $data['materi'] = $this->db->select('tb_materi.id_materi, tb_materi.judul_materi, tb_materi.deskripsi, tb_materi.file_materi, tb_materi.created, tb_kelas.nama_kelas')
        ->from('tb_materi')
        ->join('tb_guru', 'tb_materi.id_guru = tb_guru.id_guru')
        // ->join('tb_pelajaran', 'tb_materi.id_pelajaran = tb_pelajaran.id_pelajaran')
        ->join('tb_kelas', 'tb_materi.id_kelas = tb_kelas.id_kelas')
        ->order_by('tb_materi.created', 'DESC')
        ->get()
        ->result_array();
        $data['guru'] = $this->db->select('*')->from('tb_guru')->join('tb_user', 'tb_guru.id_guru = tb_user.id_data')->where('tb_guru.id_guru', $id_data)->get()->result_array();
        
        $this->load->view('guru/templates/header', $data);
        $this->load->view('guru/materi');
        $this->load->view('guru/templates/footer');
        
    }

    public function tugas()
    {
        $id_data  = $this->session->userdata('id_data');

        $data['title'] = 'Guru Tugas';
        $data['page'] = 'tugas';
        $data['user'] = $this->db->get_where('tb_guru', ['id_guru' => $id_data])->row_array();

        $data['tugas'] = $this->db->select('stb_tugas.id_tugas, stb_tugas.judul_tugas, stb_tugas.created, stb_tugas.deadline, tb_kelas.nama_kelas, tb_kelas.id_kelas, tb_pelajaran.nama_pelajaran')
        ->from('stb_tugas')
        ->join('stb_topik_pembelajaran', 'stb_topik_pembelajaran.id_topik = stb_tugas.id_topik')
        ->join('tb_guru', 'tb_guru.id_guru = stb_tugas.id_guru')
        ->join('tb_kelas', 'stb_topik_pembelajaran.id_kelas = tb_kelas.id_kelas')
        ->join('tb_pelajaran', 'tb_pelajaran.id_pelajaran = stb_topik_pembelajaran.id_pelajaran')
        ->order_by('stb_tugas.created', 'DESC')
        ->get()
        ->result_array();
        $data['guru'] = $this->db->select('*')->from('tb_guru')->join('tb_user', 'tb_guru.id_guru = tb_user.id_data')->where('tb_guru.id_guru', $id_data)->get()->result_array();
        
        $this->load->view('guru/templates/header', $data);
        $this->load->view('guru/tugas');
        $this->load->view('guru/templates/footer');
        
    }

    public function tugas_progress($id1, $id2)
    {
        $id_data  = $this->session->userdata('id_data');

        $data['pengumpulan'] = $this->db->select('tb_kelas.id_kelas, stb_pengumpulan_tugas.id_pengumpulan, stb_pengumpulan_tugas.id_tugas, stb_pengumpulan_tugas.file_jawaban, stb_pengumpulan_tugas.uploaded, stb_pengumpulan_tugas.status, stb_tugas.judul_tugas, tb_guru.nama_guru, tb_siswa.nama_siswa, tb_siswa.nisn, tb_siswa.id_siswa')
        ->from('stb_pengumpulan_tugas')
        ->join('stb_tugas', 'stb_pengumpulan_tugas.id_tugas = stb_tugas.id_tugas')
        ->join('tb_siswa', 'stb_pengumpulan_tugas.id_siswa = tb_siswa.id_siswa')
        ->join('tb_kelas', 'tb_siswa.id_kelas = tb_kelas.id_kelas')
        ->join('tb_guru', 'stb_pengumpulan_tugas.id_guru = tb_guru.id_guru')
        ->where('stb_pengumpulan_tugas.id_tugas', $id1)
        ->where('tb_kelas.id_kelas', $id2)
        ->order_by('stb_pengumpulan_tugas.uploaded', 'DESC')
        ->get()
        ->result_array();

        $data['tugas'] = $this->db->get_where('stb_tugas', ['id_tugas' => $id1])->row();

        // echo json_encode($data['pengumpulan']);

        $data['title'] = 'Guru Tugas';
        $data['page'] = 'tugas';
        $data['user'] = $this->db->get_where('tb_guru', ['id_guru' => $id_data])->row_array();
        $data['guru'] = $this->db->select('*')->from('tb_guru')->join('tb_user', 'tb_guru.id_guru = tb_user.id_data')->where('tb_guru.id_guru', $id_data)->get()->result_array();

        $data['id1'] = $id1;
        $data['id2'] = $id2;

        $this->load->view('guru/templates/header', $data);
        $this->load->view('guru/tugas_progress');
        $this->load->view('guru/templates/footer');
    }

    public function rekap_tugas($id1, $id2)
    {
        $id_data  = $this->session->userdata('id_data');

        $data['datatugas'] = $this->db->select('tb_kelas.id_kelas, stb_pengumpulan_tugas.id_pengumpulan, stb_pengumpulan_tugas.id_tugas, stb_pengumpulan_tugas.file_jawaban, stb_pengumpulan_tugas.uploaded, stb_pengumpulan_tugas.status, stb_tugas.judul_tugas, tb_guru.nama_guru, tb_siswa.nama_siswa, tb_siswa.nisn, tb_siswa.id_siswa')
        ->from('stb_pengumpulan_tugas')
        ->join('stb_tugas', 'stb_pengumpulan_tugas.id_tugas = stb_tugas.id_tugas')
        ->join('tb_siswa', 'stb_pengumpulan_tugas.id_siswa = tb_siswa.id_siswa')
        ->join('tb_kelas', 'tb_siswa.id_kelas = tb_kelas.id_kelas')
        ->join('tb_guru', 'stb_pengumpulan_tugas.id_guru = tb_guru.id_guru')
        ->where('stb_pengumpulan_tugas.id_tugas', $id1)
        ->where('tb_kelas.id_kelas', $id2)
        ->order_by('stb_pengumpulan_tugas.uploaded', 'DESC')
        ->get()
        ->result_array();

        $data['tugas'] = $this->db->get_where('stb_tugas', ['id_tugas' => $id1])->row();

        // echo json_encode($data['pengumpulan']);

        $data['title'] = 'Guru Tugas';
        $data['page'] = 'tugas';
        $data['user'] = $this->db->get_where('tb_guru', ['id_guru' => $id_data])->row_array();

        $data['id1'] = $id1;
        $data['id2'] = $id2;

        // $this->load->view('guru/templates/header', $data);
        $this->load->view('guru/cetak/laporan_datatugas_permapel', $data);
        // $this->load->view('guru/templates/footer');
    }

    public function datanilai()
    {
        $id_data  = $this->session->userdata('id_data');

        $data['title'] = 'Guru Nilai';
        $data['page'] = 'nilai';
        $data['user'] = $this->db->get_where('tb_guru', ['id_guru' => $id_data])->row_array();

        $data['tugas'] = $this->db->select('stb_tugas.id_tugas, stb_tugas.judul_tugas, stb_tugas.created, stb_tugas.deadline, tb_kelas.nama_kelas, tb_kelas.id_kelas, tb_pelajaran.nama_pelajaran')
        ->from('stb_tugas')
        ->join('stb_topik_pembelajaran', 'stb_topik_pembelajaran.id_topik = stb_tugas.id_topik')
        ->join('tb_guru', 'tb_guru.id_guru = stb_tugas.id_guru')
        ->join('tb_kelas', 'stb_topik_pembelajaran.id_kelas = tb_kelas.id_kelas')
        ->join('tb_pelajaran', 'tb_pelajaran.id_pelajaran = stb_topik_pembelajaran.id_pelajaran')
        ->order_by('stb_tugas.created', 'DESC')
        ->get()
        ->result_array();
        $data['guru'] = $this->db->select('*')->from('tb_guru')->join('tb_user', 'tb_guru.id_guru = tb_user.id_data')->where('tb_guru.id_guru', $id_data)->get()->result_array();
        
        $this->load->view('guru/templates/header', $data);
        $this->load->view('guru/datanilai');
        $this->load->view('guru/templates/footer');
        
    }

    public function detail_datanilai($id1, $id2)
    {
        $id_data  = $this->session->userdata('id_data');

        $data['pengumpulan'] = $this->db->select('tb_siswa.nama_siswa, tb_siswa.nisn, stb_nilai.nilai, tb_kelas.nama_kelas')
        ->from('stb_nilai')
        ->join('tb_siswa', 'stb_nilai.id_siswa = tb_siswa.id_siswa')
        ->join('stb_tugas', 'stb_nilai.id_tugas = stb_tugas.id_tugas')
        ->join('tb_kelas', 'tb_siswa.id_kelas = tb_kelas.id_kelas')
        ->where('stb_nilai.id_tugas', $id1)
        ->where('tb_kelas.id_kelas', $id2)
        ->get()
        ->result_array();

        $data['tugas'] = $this->db->get_where('stb_tugas', ['id_tugas' => $id1])->row();

        $data['title'] = 'Guru List Nilai';
        $data['page'] = 'nilai';
        $data['user'] = $this->db->get_where('tb_guru', ['id_guru' => $id_data])->row_array();
        $data['guru'] = $this->db->select('*')->from('tb_guru')->join('tb_user', 'tb_guru.id_guru = tb_user.id_data')->where('tb_guru.id_guru', $id_data)->get()->result_array();

        $data['id1'] = $id1;
        $data['id2'] = $id2;

        $this->load->view('guru/templates/header', $data);
        $this->load->view('guru/detail_datanilai');
        $this->load->view('guru/templates/footer');
    }

    public function rekap_nilai($id1, $id2)
    {
        $id_data  = $this->session->userdata('id_data');

        $data['datanilai'] = $this->db->select('tb_siswa.nama_siswa, tb_siswa.nisn, stb_nilai.nilai, tb_kelas.nama_kelas')
        ->from('stb_nilai')
        ->join('tb_siswa', 'stb_nilai.id_siswa = tb_siswa.id_siswa')
        ->join('stb_tugas', 'stb_nilai.id_tugas = stb_tugas.id_tugas')
        ->join('tb_kelas', 'tb_siswa.id_kelas = tb_kelas.id_kelas')
        ->where('stb_nilai.id_tugas', $id1)
        ->or_where('tb_kelas.id_kelas', $id2)
        ->get()
        ->result_array();

        
        $data['nama_kelas'] = $data['datanilai'][0]['nama_kelas'];

        $data['tugas'] = $this->db->get_where('stb_tugas', ['id_tugas' => $id1])->row();

        $data['title'] = 'Guru List Nilai';
        $data['page'] = 'nilai';
        $data['user'] = $this->db->get_where('tb_guru', ['id_guru' => $id_data])->row_array();

        $data['id1'] = $id1;
        $data['id2'] = $id2;

        $this->load->view('guru/cetak/laporan_datanilai_permapel', $data);
    }

    public function rekap_nilai_kelas($id1, $id2)
    {
        $id_data  = $this->session->userdata('id_data');

        $data['datanilai'] = $this->db->select('tb_siswa.nama_siswa, tb_siswa.nisn, stb_nilai.nilai, stb_tugas.judul_tugas, tb_kelas.nama_kelas')
        ->from('stb_nilai')
        ->join('tb_siswa', 'stb_nilai.id_siswa = tb_siswa.id_siswa')
        ->join('stb_tugas', 'stb_nilai.id_tugas = stb_tugas.id_tugas')
        ->join('tb_kelas', 'tb_siswa.id_kelas = tb_kelas.id_kelas')
        ->where('stb_nilai.id_tugas', $id1)
        ->where('tb_kelas.id_kelas', $id2)
        ->get()
        ->result_array();

        $data['datanilai_pertugas'] = $this->db->select('tb_siswa.nama_siswa, tb_siswa.nisn, stb_nilai.nilai, stb_tugas.judul_tugas, tb_kelas.nama_kelas')
        ->from('stb_nilai')
        ->join('tb_siswa', 'stb_nilai.id_siswa = tb_siswa.id_siswa')
        ->join('stb_tugas', 'stb_nilai.id_tugas = stb_tugas.id_tugas')
        ->join('tb_kelas', 'tb_siswa.id_kelas = tb_kelas.id_kelas')
        ->where('tb_kelas.id_kelas', $id2)
        ->group_by('stb_nilai.id_tugas')        
        ->get()
        ->result_array();

        $data['datanilai_pertugas_2'] = $this->db->select('tb_siswa.nama_siswa, tb_siswa.nisn, stb_nilai.nilai, stb_tugas.judul_tugas, tb_kelas.nama_kelas')
        ->from('stb_nilai')
        ->join('tb_siswa', 'stb_nilai.id_siswa = tb_siswa.id_siswa')
        ->join('stb_tugas', 'stb_nilai.id_tugas = stb_tugas.id_tugas')
        ->join('tb_kelas', 'tb_siswa.id_kelas = tb_kelas.id_kelas')
        ->where('tb_kelas.id_kelas', $id2)  
        ->order_by('stb_nilai.id_nilai', 'asc')   
        ->get()
        ->result_array();

        // var_dump($data['datanilai_pertugas_2']);
        
        $data['nama_kelas'] = $data['datanilai'][0]['nama_kelas'];
        
        $data['tugas'] = $this->db->get_where('stb_tugas', ['id_tugas' => $id1])->row();

        $data['title'] = 'Guru List Nilai';
        $data['page'] = 'nilai';
        $data['user'] = $this->db->get_where('tb_guru', ['id_guru' => $id_data])->row_array();

        $data['id1'] = $id1;
        $data['id2'] = $id2;

        $this->load->view('guru/cetak/laporan_datanilai_perkelas', $data);
    }
}
