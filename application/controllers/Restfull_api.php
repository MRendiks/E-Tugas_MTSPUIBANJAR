<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Restfull_api extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('telegram');
    }

    // POST
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $response = array(
                'status' => 400,
                'message' => 'Invalid request method'
            );

            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
            return;
        }

        $username = $this->input->post('username');
        $password = $this->input->post('password');

        if (empty($username) || empty($password)) {
            $response = array(
                'status' => 400,
                'message' => 'Username and password cannot be empty'
            );

            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
            return;
        }

        $user = $this->db->get_where('tb_user', ['username' => $username])->row_array();

        if (!$user) {
            $response = array(
                'status' => 401,
                'message' => 'Username is not registered!'
            );
        } else {
            if ($user['role_user'] != 3) {
                $response = array(
                    'status' => 202,
                    'message' => 'Invalid Access'
                );
            } else {
                if (password_verify($password, $user['password'])) {
                    $data_siswa = $this->db->get_where('tb_siswa', ['id_siswa' => $user['id_data']])->row();
                    $data_kelas = $this->db->get_where('tb_kelas', ['id_kelas' => $data_siswa->id_kelas])->row();

                    $response = array(
                        'status' => 200,
                        'message' => 'Login successful',
                        'data' => array(
                            'username' => $user['username'],
                            'roleUser' => $user['role_user'],
                            'idSiswa' => $data_siswa->id_siswa,
                            'namaSiswa' => $data_siswa->nama_siswa,
                            'nisn' => $data_siswa->nisn,
                            'ttlSiswa' => $data_siswa->ttl_siswa,
                            'idKelas' => $data_siswa->id_kelas,
                            'namaKelas' => $data_kelas->nama_kelas
                        )
                    );
                } else {
                    $response = array(
                        'status' => 401,
                        'message' => 'Wrong password!'
                    );
                }
            }
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    public function reset_pw()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $response = array(
                'status' => 400,
                'message' => 'Invalid request method'
            );

            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
            return;
        }

        $id = $this->input->post('id_user');
        $password = $this->input->post('password');

        if (empty($id) || empty($password)) {
            $response = array(
                'status' => 400,
                'message' => 'Username and password cannot be empty'
            );

            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($response));
            return;
        }

        $user = $this->db->get_where('tb_user', ['id_user' => $id])->row_array();
        $data = array(
            'password' => password_hash($password, PASSWORD_DEFAULT)
        );

        if (!$user) {
            $response = array(
                'status' => 401,
                'message' => 'Username is not registered!'
            );
        } else {
            $this->db->where('id_user', $user['id_user']);
            // var_dump($data) ;
            $this->db->update('tb_user', $data);

            if ($this->db->affected_rows() > 0) {
                $response = array(
                    'status' => True,
                    'message' => 'Password Terganti'
                );
            } else {
                $response = array(
                    'status' => False,
                    'message' => 'Password Tidak Terganti'
                );
            }
                
            }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }
    
    public function upload_jawaban()
    {
        // Mengambil ID pengumpulan
        $idPengumpulan = $this->input->post('idPengumpulan');
    
        // Mengambil data deadline
        $deadline = $this->db->select('stb_pengumpulan_tugas.id_pengumpulan, stb_pengumpulan_tugas.status, stb_tugas.deadline, stb_tugas.judul_tugas, stb_tugas.id_tugas')
            ->from('stb_pengumpulan_tugas')
            ->join('stb_tugas', 'stb_pengumpulan_tugas.id_tugas = stb_tugas.id_tugas')
            ->where('stb_pengumpulan_tugas.id_pengumpulan', $idPengumpulan)
            ->get()
            ->row();

        var_dump($deadline->deadline);
    
        // if ($deadline->deadline > time()) {
        //     $data = [
        //         'uploaded' => time(),
        //         'status' => 2
        //     ];
    
        //     $this->db->where('id_pengumpulan', $idPengumpulan);
        //     $this->db->update('stb_pengumpulan_tugas', $data);
    
        //     $this->output
        //         ->set_status_header(200)
        //         ->set_content_type('application/json')
        //         ->set_output(json_encode([
        //             'status' => 200,
        //             'message' => 'Kamu Telat Mengumpulkan'
        //         ]));
    
        //     return;
        // }
    
        // Mengambil data siswa
        // $siswa = $this->db->select('tb_siswa.nama_siswa, tb_siswa.id_kelas')->join('tb_siswa', 'stb_pengumpulan_tugas.id_siswa = tb_siswa.id_siswa')->where('stb_pengumpulan_tugas.id_pengumpulan', $idPengumpulan)->get()->row();
    
        // // Mengambil data ortu
        // $ortu = $this->db->get_where('tb_orangtua', ['id_kelas' => $siswa->id_kelas, 'parent' => $siswa->nama_siswa])->row();
    
        // // Cek apakah ada file yang diunggah
        // if (empty($_FILES['file']['name'])) {
        //     $this->output
        //         ->set_status_header(400)
        //         ->set_content_type('application/json')
        //         ->set_output(json_encode([
        //             'status' => 400,
        //             'message' => 'Missing file data'
        //         ]));
        //     return;
        // }
    
        // // Konfigurasi upload
        // $config['upload_path'] = './assets/jawaban/';
        // $config['allowed_types'] = '*';
        // $config['max_size'] = 12048;
        // $config['encrypt_name'] = true;
        // $config['file_ext_tolower'] = true;
    
        // $this->load->library('upload', $config);
    
        // // Lakukan proses upload
        // if (!$this->upload->do_upload('file')) {
        //     $this->output
        //         ->set_status_header(500)
        //         ->set_content_type('application/json')
        //         ->set_output(json_encode([
        //             'status' => 500,
        //             'message' => 'Failed to upload file: ' . $this->upload->display_errors('', '')
        //         ]));
        //     return;
        // }
    
        // // File berhasil diunggah, dapatkan informasi file
        // $fileName = $this->upload->data('file_name');
    
        // // Update record di database
        // $data = [
        //     'file_jawaban' => $fileName,
        //     'uploaded' => time(),
        //     'status' => 1
        // ];
    
        // $this->db->trans_start();
        // $this->db->where('id_pengumpulan', $idPengumpulan);
        // $this->db->update('stb_pengumpulan_tugas', $data);
        // $this->db->where('id_tugas', $deadline->id_tugas)->update('stb_tugas', ['closetime' => 0]);
        // $this->db->trans_complete();
    
        // if ($this->db->trans_status() === false) {
        //     $this->output
        //         ->set_status_header(500)
        //         ->set_content_type('application/json')
        //         ->set_output(json_encode([
        //             'status' => 500,
        //             'message' => 'Database transaction error'
        //         ]));
        //     return;
        // }
    
        // $chatid = $ortu->chat_id;
        // $text = 'Halo Bapak/Ibu ' . $ortu->nama_ortu . ', Terima kasih atas bimbingannya di rumah. Kami ingin memberitahukan bahwa saudara ' . $ortu->parent . ' telah berhasil menyelesaikan tugas "' . $deadline->judul_tugas . '" yang sebelumnya kami berikan.';
        // $this->telegram->sendTelegramMessage($chatid, $text);
    
        // $this->output
        //     ->set_status_header(200)
        //     ->set_content_type('application/json')
        //     ->set_output(json_encode([
        //         'status' => 200,
        //         'message' => 'File berhasil diunggah'
        //     ]));
    }    
    
    public function cek_detail_tugas($id, $id2)
    {
        if (empty($id)) {
            $response = array(
                'status' => 405,
                'message' => 'ID tidak boleh kosong',
                'data' => null
            );
        } else {
            $tugas = $this->db->select('*')
                ->from('stb_pengumpulan_tugas')
                ->join('stb_tugas', 'stb_pengumpulan_tugas.id_tugas = stb_tugas.id_tugas')
                ->order_by('stb_tugas.created', 'DESC')
                ->where('stb_pengumpulan_tugas.id_siswa', $id)
                ->where('stb_tugas.id_tugas', $id2)
                ->get()
                ->row_array(); // Mengubah menjadi row_array() agar mengembalikan hasil dalam bentuk array asosiatif

            if (!empty($tugas)) { // Mengubah pengecekan $tugas menjadi !empty() untuk memeriksa apakah ada data tugas atau tidak
                if (empty($tugas['uploaded'])) {
                    $tugas['uploaded'] = null;
                } else {
                    $tugas['uploaded'] = date('Y-m-d H:i:s', $tugas['uploaded']);
                }
                $tugas['status'] = ($tugas['status'] == 0) ? 'BELUM' : (($tugas['status'] == 1) ? 'DIKERJAKAN' : 'TIDAK');
                $tugas['created'] = date('Y-m-d H:i:s', $tugas['created']);
                $tugas['deadline'] = date('Y-m-d H:i:s', $tugas['deadline']);
                $tugas['closetime'] = date('Y-m-d H:i:s', $tugas['closetime']);

                $response = array(
                    'status' => 200,
                    'message' => 'Data tugas ditemukan',
                    'data' => $tugas
                );
            } else {
                $response = array(
                    'status' => 200,
                    'message' => 'Tidak ada tugas tersedia',
                    'data' => null
                );
            }
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    // GET
    public function cek_tugas($id)
    {
        if (empty($id)) {
            $response = array(
                'status' => 405,
                'message' => 'ID tidak boleh kosong',
                'data' => null
            );
        } else {
            $tugas = $this->db->select('*')
                ->from('stb_pengumpulan_tugas')
                ->join('stb_tugas', 'stb_pengumpulan_tugas.id_tugas = stb_tugas.id_tugas')
                ->order_by('stb_tugas.created', 'DESC')
                ->where('stb_pengumpulan_tugas.id_siswa', $id)
                ->get()
                ->result_array();

            if ($tugas) {
                foreach ($tugas as &$t) {
                    if (empty($t['uploaded'])) {
                        $t['uploaded'] = null;
                    } else {
                        $t['uploaded'] = date('Y-m-d H:i:s', $t['uploaded']);
                    }
                    $t['status'] = ($t['status'] == 0) ? 'BELUM' : (($t['status'] == 1) ? 'DIKERJAKAN' : 'TIDAK');
                    $t['created'] = date('Y-m-d H:i:s', $t['created']);
                    $t['deadline'] = date('Y-m-d H:i:s', $t['deadline']);
                    $t['closetime'] = date('Y-m-d H:i:s', $t['closetime']);
                }

                $response = array(
                    'status' => 200,
                    'message' => 'Data tugas ditemukan',
                    'data' => $tugas
                );
            } else {
                $response = array(
                    'status' => 200,
                    'message' => 'Tidak ada tugas tersedia',
                    'data' => null
                );
            }
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function cek_materi($id)
    {
        $query = $this->db->get_where('tb_siswa', ['id_siswa' => $id])->row();

        if (!$query) {
            $response = [
                'status' => 404,
                'message' => 'Tidak ada materi'
            ];
            $this->output->set_status_header(404);
            $this->output->set_content_type('application/json')->set_output(json_encode($response));
        } else {
            $materi = $this->db->select('tb_materi.id_materi, tb_materi.judul_materi, tb_materi.deskripsi, tb_materi.file_materi, tb_pelajaran.nama_pelajaran')
                ->from('tb_materi')
                ->join('tb_guru', 'tb_materi.id_guru = tb_guru.id_guru')
                ->join('tb_pelajaran', 'tb_materi.id_pelajaran = tb_pelajaran.id_pelajaran')
                ->join('tb_kelas', 'tb_materi.id_kelas = tb_kelas.id_kelas')
                ->order_by('tb_materi.created', 'DESC')
                ->where('tb_kelas.id_kelas', $query->id_kelas)
                ->get()
                ->result_array();
            
            $response = [
                'status' => 200,
                'message' => 'Data Found',
                'data' => $materi
            ];
            $this->output->set_content_type('application/json')->set_output(json_encode($response));
        }
    }  
    

    public function cek_mapel($id)
    {
        $query = $this->db->get_where('tb_siswa', ['id_siswa' => $id])->row();

        if(!$query){
            $response = [
                'status' => 404,
                'message' => 'Tidak ada Pelajaran'
            ];
            $this->output->set_status_header(404);
            $this->output->set_content_type('application/json')->set_output(json_encode($response));
        }else{
            $mapel = $this->db->select('tb_pelajaran.nama_pelajaran, tb_guru.nama_guru')
                ->from('stb_topik_pembelajaran')
                ->join('tb_guru', 'stb_topik_pembelajaran.id_guru = tb_guru.id_guru')
                ->join('tb_pelajaran', 'stb_topik_pembelajaran.id_pelajaran = tb_pelajaran.id_pelajaran')
                ->join('tb_kelas', 'stb_topik_pembelajaran.id_kelas = tb_kelas.id_kelas')
                ->order_by('tb_pelajaran.nama_pelajaran', 'ASC')
                ->where('tb_kelas.id_kelas', $query->id_kelas)
                ->get()
                ->result_array();

            $response = [
                'status' => 200,
                'message' => 'Data Found',
                'data' => $mapel
            ];
            $this->output->set_content_type('application/json')->set_output(json_encode($response));
        }
    }

    // PUT
    public function blastdaily()
    {
        $tasks = $this->db->select('stb_pengumpulan_tugas.id_pengumpulan, stb_pengumpulan_tugas.status, tb_siswa.id_siswa, tb_siswa.nama_siswa, stb_tugas.deadline, stb_tugas.judul_tugas, tb_kelas.nama_kelas, tb_orangtua.nama_ortu, tb_orangtua.chat_id')
            ->from('stb_pengumpulan_tugas')
            ->join('tb_siswa', 'stb_pengumpulan_tugas.id_siswa = tb_siswa.id_siswa')
            ->join('stb_tugas', 'stb_pengumpulan_tugas.id_tugas = stb_tugas.id_tugas')
            ->join('tb_kelas', 'tb_siswa.id_kelas = tb_kelas.id_kelas')
            ->join('tb_orangtua', 'tb_kelas.id_kelas = tb_orangtua.id_kelas')
            ->where('tb_orangtua.parent', 'tb_siswa.nama_siswa', FALSE)
            ->where('stb_pengumpulan_tugas.status', 0)
            ->get()
            ->result_array();
    
        $updatedTasks = [];
    
        foreach ($tasks as $task) {
            if ($task['deadline'] <= time()) {
                $chatid = $task['chat_id'];
                $text = 'Halo Bapak/Ibu ' . $task['nama_ortu'] . ', dengan segala permohonan maaf, kami ingin memberitahukan bahwa ' . $task['nama_siswa'] . ' tidak mengumpulkan tugas ' . $task['judul_tugas'] . '. Mohon perhatian dan bantuannya dalam menindaklanjuti masalah ini. Terima kasih.';
                $this->telegram->sendTelegramMessage($chatid, $text);
    
                $updatedTasks[] = [
                    'id_pengumpulan' => $task['id_pengumpulan'],
                    'status' => 5
                ];
            }
        }
    
        if (!empty($updatedTasks)) {
            $this->db->update_batch('stb_pengumpulan_tugas', $updatedTasks, 'id_pengumpulan');
        }
    
        return;
    }

}
