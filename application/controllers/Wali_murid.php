<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Wali_murid extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('telegram');
    }

    public function index()
    {
        $data['kelas'] = $this->db->get('tb_kelas')->result_array();

        $this->load->view('wali/hero', $data);
    }

    public function validasi()
    {
        $nisn = $this->input->post('nisn');
        $id_kelas = $this->input->post('id_kelas');
    
        $siswa = $this->db->get_where('tb_siswa', ['nisn' => $nisn, 'id_kelas' => $id_kelas])->row();

        if($siswa){
            $data['siswa'] = $siswa;
    
            $this->load->view('login/templates/header', $data);
            $this->load->view('wali/validasi');
            $this->load->view('login/templates/footer');
        }else{
            $this->session->set_flashdata(array('message' => 'Data Siswa Tidak ditemukan', 'message_type' => 'error'));
            redirect(base_url(''));
        }
    }    

    public function validasi_siswa()
    {
        $nisn = $this->input->post('nisn');
        $nama = $this->input->post('nama');
        $namawali = $this->input->post('namawali');
        $birthday = $this->input->post('birthday');
        $chatid = $this->input->post('chatid');
    
        $this->db->trans_start(); // Memulai transaksi
    
        $siswa = $this->db->get_where('tb_siswa', ['nisn' => $nisn, 'ttl_siswa' => $birthday])->row();
    
        if (!$siswa) {
            $this->session->set_flashdata(array('message' => 'Validasi Gagal, Tanggal Lahir Salah', 'message_type' => 'error'));
            redirect(base_url(''));
        }
    
        $data1 = [
            'nama_ortu' => $namawali,
            'parent' => $siswa->nama_siswa,
            'id_kelas' => $siswa->id_kelas,
            'chat_id' => $chatid,
            'created' => time()
        ];
    
        $this->db->insert('tb_orangtua', $data1);
        $id_wali = $this->db->insert_id();
    
        if (!$id_wali) {
            $this->db->trans_rollback(); // Batalkan transaksi
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal menyimpan data orang tua</div>');
            redirect(base_url('validasi'));
        }
    
        $text = 'Selamat Bapak/Ibu '.$namawali.', selaku wali dari '.$siswa->nama_siswa.'. Akun Telegram Anda telah terhubung dengan sistem kami.';
        $send = $this->telegram->sendTelegramMessage($chatid, $text);
    
        if ($send != "Pesan berhasil dikirim!") {
            $this->db->trans_rollback(); // Batalkan transaksi
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal mengirim pesan ke Telegram</div>');
            redirect(base_url('validasi'));
        }
    
        $data2 = [
            'id_wali' => $id_wali,
            'id_siswa' => $siswa->id_siswa,
            'time' => time(),
            'category' => 1
        ];
    
        $this->db->insert('tb_notification', $data2);
    
        $this->db->trans_commit(); // Komit transaksi
    
        $this->session->set_flashdata(array('message' => 'Akun Telegram Sudah Terhubung', 'message_type' => 'success'));
        redirect(base_url());
    }
    
}

