<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');

class Guru_save extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('telegram');
        $this->load->database();
    }

    public function sendtugas()
    {
        $id_guru = $this->input->post('id_guru');
        $id_topik = $this->input->post('id_topik');
        $id_kelas = $this->input->post('id_kelas');
        $judul = $this->input->post('judul');
        $deadline = $this->input->post('deadline');
        $deskripsi = $this->input->post('deskripsi');
    
        $file = $_FILES['file']['name'];
    
        $config['encrypt_name'] = true;
        $config['allowed_types'] = 'pdf';
        $config['max_size'] = '5120';
        $config['upload_path'] = './assets/soal/';
        $config['file_ext_tolower'] = true;
        $this->load->library('upload', $config);
    
        if (!empty($file)) {
            if (!$this->upload->do_upload('file')) {
                // Gagal mengupload file
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal mengupload file</div>');
                redirect(base_url('guru/kelas'));
                return;
            }
            $soal = $this->upload->data('');
            $file = $soal['file_name'];
        } else {
            $file = null;
        }
    
        $this->db->trans_start();
    
        $data = array(
            'id_guru' => $id_guru,
            'id_topik' => $id_topik,
            'judul_tugas' => $judul,
            'deskripsi' => $deskripsi,
            'file_tugas' => $file,
            'created' => time(),
            'deadline' => strtotime($deadline),
            'closetime' => strtotime($deadline) + 300
        );
    
        $this->db->insert('stb_tugas', $data);
        $id_tugas = $this->db->insert_id();
    
        $siswa = $this->db->get_where('tb_siswa', ['id_kelas' => $id_kelas])->result_array();
    
        foreach ($siswa as $s) {
            $data2 = array(
                'id_tugas' => $id_tugas,
                'id_siswa' => $s['id_siswa'],
                'id_guru' => $id_guru,
                'file_jawaban' => null,
                'uploaded' => null,
                'status' => 0
            );
            $this->db->insert('stb_pengumpulan_tugas', $data2);
        }
    
        $wali = $this->db->get_where('tb_orangtua', ['id_kelas' => $id_kelas])->result_array();
    
        foreach ($wali as $w) {
            $chatid = $w['chat_id'];
            $text = 'Hallo Bapak/Ibu '.$w['nama_ortu'].' Kami ingin memberitahukan bahwa anak Bapak/Ibu, '.$w['parent'].', telah diberikan tugas sekolah "'.$judul.'". Tugas ini memiliki batas waktu pengumpulan pada '.date('j-m-Y H:i a', strtotime($deadline)).'. Saya berharap Bapak/Ibu dapat memberikan dukungan dan bimbingan kepada '.$w['parent'].' dalam menyelesaikan tugas ini. Terima kasih atas perhatian dan kerjasamanya.';
            
            if (!$this->telegram->sendTelegramMessage($chatid, $text)) {
                // Gagal mengirim pesan ke Telegram
                $this->db->trans_rollback();
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal mengirim pesan ke Telegram</div>');
                redirect(base_url('guru/kelas'));
                return;
            }
    
            $data3 = [
                'id_wali' => $w['id_ortu'], 
                'id_siswa' => $s['id_siswa'], 
                'time' => time(),
                'category' => 2
            ];
    
            $this->db->insert('tb_notification', $data3);
        }
    
        $this->db->trans_complete();
    
        if ($this->db->trans_status() === false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal mengirim tugas</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Tugas Terkirim</div>');
        }
    
        redirect(base_url('guru/kelas'));
    } 
    
    public function sendmateri()
    {
        $id_guru = $this->input->post('id_guru');
        $id_topik = $this->input->post('id_topik');
        $id_kelas = $this->input->post('id_kelas');
        $id_pelajaran = $this->input->post('id_pelajaran');
        $judul = $this->input->post('judul');
        $deadline = $this->input->post('deadline');
        $deskripsi = $this->input->post('deskripsi');
    
        $file = $_FILES['file']['name'];
    
        $config['encrypt_name'] = true;
        $config['allowed_types'] = 'pdf';
        $config['max_size'] = '5120';
        $config['upload_path'] = './assets/materi/';
        $config['file_ext_tolower'] = true;
        $this->load->library('upload', $config);
    
        if (!empty($file)) {
            if (!$this->upload->do_upload('file')) {
                // Gagal mengupload file
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal mengupload file</div>');
                redirect(base_url('guru/kelas'));
                return;
            }
            $soal = $this->upload->data('');
            $file = $soal['file_name'];
        } else {
            $file = null;
        }
    
        $this->db->trans_start();
    
        $data = array(
            'id_guru' => $id_guru,
            'id_pelajaran' => $id_pelajaran,
            'id_kelas' => $id_kelas,
            'judul_materi' => $judul,
            'deskripsi' => $deskripsi,
            'file_materi' => $file,
            'created' => time()
        );
    
        $this->db->insert('tb_materi', $data);
        $id_tugas = $this->db->insert_id();

        $siswa = $this->db->get_where('tb_siswa', ['id_kelas' => $id_kelas])->result_array();
        foreach ($siswa as $s) {
        }
    
        $wali = $this->db->get_where('tb_orangtua', ['id_kelas' => $id_kelas])->result_array();
    
        foreach ($wali as $w) {
            $chatid = $w['chat_id'];
            $text = 'Hallo Bapak/Ibu '.$w['nama_ortu'].' Kami ingin memberitahukan bahwa guru telah mengirimkan materi pembelajaran untuk anak Bapak/Ibu, '.$w['parent'].'. Materi ini dapat digunakan untuk belajar. Kami berharap Bapak/Ibu dapat memberikan dukungan dan bimbingan kepada '.$w['parent'].' dalam mempelajari materi ini. Terima kasih atas perhatian dan kerjasamanya.';
            
            if (!$this->telegram->sendTelegramMessage($chatid, $text)) {
                // Gagal mengirim pesan ke Telegram
                $this->db->trans_rollback();
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal mengirim pesan ke Telegram</div>');
                redirect(base_url('guru/kelas'));
                return;
            }
    
            $data3 = [
                'id_wali' => $w['id_ortu'], 
                'id_siswa' => $s['id_siswa'], 
                'time' => time(),
                'category' => 5
            ];
    
            $this->db->insert('tb_notification', $data3);
        }
    
        $this->db->trans_complete();
    
        if ($this->db->trans_status() === false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal mengirim tugas</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Tugas Terkirim</div>');
        }
    
        redirect(base_url('guru/kelas')); 
    }
  
    public function nilaitugas()
    {
        $nilai = $this->input->post('nilai');
        $id_tugas = $this->input->post('id_tugas');
        $id_siswa = $this->input->post('id_siswa');

        $id1 = $this->input->post('id1');
        $id2 = $this->input->post('id2');

        $data = array(
            'id_siswa' => $id_siswa,
            'id_tugas' => $id_tugas,
            'nilai' => $nilai
        );
        // insert
        $this->db->insert('stb_nilai', $data);

        // update

        $this->db->where('id_siswa', $id_siswa);
        $this->db->where('id_tugas', $id_tugas);
        $this->db->update('stb_pengumpulan_tugas', ['status' => 2]);


        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Sudah Ternilai</div>');
        redirect(base_url('guru/tugas/'.$id1.'/'.$id2));
    }

    public function password_guru()
    {
        $id = $this->input->post('id_user');
        $password = $this->input->post('password');

        $query = $this->db->get_where('tb_guru', ['id_guru' => $id])->row();

        $data = array(
            'password' => password_hash($password, PASSWORD_DEFAULT)
        );
        
        // $this->db->where('username', $query->username);
        $this->db->update('tb_user', $data, array('username' => $query->username));
        

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Sudah Terupdate</div>');
        redirect(base_url('guru/dashboard'));
    }
}
