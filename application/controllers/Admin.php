<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('npm')) {
            redirect('auth');
        } else {
            $user = $this->db->get_where('user', ['npm' => $this->session->userdata('npm')])->row_array();
            if (!($user['role_id'] == 1)) {
                redirect('user');
            }
        }
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['npm' => $this->session->userdata('npm')])->row_array();
        $data['pemilih'] = $this->db->get_where('user', ['role_id' => 2])->result_array();
        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/admin_sidebar', $data);
        $this->load->view('templates/admin_topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/admin_footer');
    }

    public function dataPemilih()
    {
        $data['title'] = 'Data Pemilih';
        $data['user'] = $this->db->get_where('user', ['npm' => $this->session->userdata('npm')])->row_array();
        $data['pemilih'] = $this->db->get_where('user', ['role_id' => 2])->result_array();

        $this->form_validation->set_rules('npm', 'NPM', 'required|trim|is_unique[user.npm]');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/admin_header', $data);
            $this->load->view('templates/admin_sidebar', $data);
            $this->load->view('templates/admin_topbar');
            $this->load->view('admin/datapemilih', $data);
            $this->load->view('templates/admin_footer');
        } else {
            $npm = $this->input->post('npm');
            $password = $this->input->post('password');
            $data = [
                'npm' => $npm,
                'password' => $password,
                'role_id' => 2
            ];
            $this->db->insert('user', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil ditambahkan !</div>');
            redirect('Admin/datapemilih');
        }
    }

    public function editPemilih($id)
    {
        $pemilih = $this->db->get_where('user', ['id' => $id])->row_array();

        $npm = $this->input->post('npm');
        if ($this->input->post('password')) {
            $password = $this->input->post('password');
        } else {
            $password = $pemilih['password'];
        }
        $nama = $this->input->post('nama');
        $email = $this->input->post('email');
        $fakultas = $this->input->post('fakultas');
        $jurusan = $this->input->post('jurusan');

        $data = [
            'npm' => $npm,
            'password' => $password,
            'nama' => $nama,
            'email' => $email,
            'fakultas' => $fakultas,
            'jurusan' => $jurusan
        ];

        $upload_image = $_FILES['foto']['name'];

        if ($upload_image) {
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size']     = '4096';
            $config['upload_path'] = './assets/img/profile/';

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('foto')) {
                $old_image = $pemilih['foto'];
                if ($old_image != 'default.png') {
                    unlink(FCPATH . 'assets/img/profile/' . $old_image);
                }
                $image = $this->upload->data('file_name');
                $data['foto'] = $image;
            } else {
                echo $this->upload->display_errors();
                die;
            }
        }

        $this->db->set($data);
        $this->db->where('id', $id);
        $this->db->update('user');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil diubah !</div>');
        redirect('Admin/dataPemilih');
    }

    public function deletePemilih($id)
    {
        $pemilih = $this->db->get_where('user', ['id' => $id])->row_array();
        if ($pemilih['foto'] != "default.png") {
            unlink(FCPATH . 'assets/img/profile/' . $pemilih['foto']);
        }
        $this->db->where('id', $id);
        $this->db->delete('user');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil dihapus !</div>');
        redirect('Admin/dataPemilih');
    }

    public function presiden()
    {
        $data['title'] = 'Data Calon';
        $data['user'] = $this->db->get_where('user', ['npm' => $this->session->userdata('npm')])->row_array();
        $data['presiden'] = $this->db->get('presiden')->result_array();

        $this->form_validation->set_rules('no_urut', 'No Urut', 'required|trim');
        $this->form_validation->set_rules('nama_ketua', 'Nama Ketua', 'required|trim');
        $this->form_validation->set_rules('nama_wakil', 'Nama Wakil', 'required|trim');
        $this->form_validation->set_rules('fak_ketua', 'Fakultas Ketua', 'required|alpha_numeric_spaces');
        $this->form_validation->set_rules('fak_wakil', 'Fakultas Wakil', 'required|alpha_numeric_spaces');
        $this->form_validation->set_rules('jur_ketua', 'Jurusan Ketua', 'alpha_numeric_spaces');
        $this->form_validation->set_rules('jur_wakil', 'Jurusan Wakil', 'alpha_numeric_spaces');
        $this->form_validation->set_rules('visi', 'Visi', 'required|trim');
        $this->form_validation->set_rules('misi', 'Misi', 'required|trim');
        if (empty($_FILES['foto']['name'])) {
            $this->form_validation->set_rules('foto', 'Foto Paslon', 'required');
        }
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/admin_header', $data);
            $this->load->view('templates/admin_sidebar', $data);
            $this->load->view('templates/admin_topbar');
            $this->load->view('admin/presiden', $data);
            $this->load->view('templates/admin_footer');
        } else {
            $no_urut = $this->input->post('no_urut');
            $nama_ketua = $this->input->post('nama_ketua');
            $nama_wakil = $this->input->post('nama_wakil');
            $fak_ketua = $this->input->post('fak_ketua');
            $fak_wakil = $this->input->post('fak_wakil');
            $jur_ketua = $this->input->post('jur_ketua');
            $jur_wakil = $this->input->post('jur_wakil');
            $visi = $this->input->post('visi');
            $misi = $this->input->post('misi');

            $data = [
                'no_urut' => $no_urut,
                'nama_ketua' => $nama_ketua,
                'nama_wakil' => $nama_wakil,
                'fak_ketua' => $fak_ketua,
                'fak_wakil' => $fak_wakil,
                'jur_ketua' => $jur_ketua,
                'jur_wakil' => $jur_wakil,
                'visi' => $visi,
                'misi' => $misi
            ];

            $upload_image = $_FILES['foto']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']     = '4096';
                $config['upload_path'] = './assets/img/foto_calon/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('foto')) {
                    $data['foto'] = $upload_image;
                } else {
                    echo $this->upload->display_errors();
                    die;
                }
            }

            $this->db->insert('presiden', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil ditambahkan !</div>');
            redirect('Admin/presiden');
        }
    }

    public function editPresiden($id)
    {
        $presiden = $this->db->get_where('presiden', ['id' => $id])->row_array();

        $no_urut = $this->input->post('no_urut');
        $nama_ketua = $this->input->post('nama_ketua');
        $nama_wakil = $this->input->post('nama_wakil');
        $fak_ketua = $this->input->post('fak_ketua');
        $fak_wakil = $this->input->post('fak_wakil');
        $jur_ketua = $this->input->post('jur_ketua');
        $jur_wakil = $this->input->post('jur_wakil');
        $visi = $this->input->post('visi');
        $misi = $this->input->post('misi');

        $data = [
            'no_urut' => $no_urut,
            'nama_ketua' => $nama_ketua,
            'nama_wakil' => $nama_wakil,
            'fak_ketua' => $fak_ketua,
            'fak_wakil' => $fak_wakil,
            'jur_ketua' => $jur_ketua,
            'jur_wakil' => $jur_wakil,
            'visi' => $visi,
            'misi' => $misi
        ];

        $upload_image = $_FILES['foto']['name'];

        if ($upload_image) {
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size']     = '4096';
            $config['upload_path'] = './assets/img/foto_calon/';

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('foto')) {
                $old_image = $presiden['foto'];
                if ($old_image != 'default.png') {
                    unlink(FCPATH . 'assets/img/foto_calon/' . $old_image);
                }
                $image = $this->upload->data('file_name');
                $data['foto'] = $image;
            } else {
                echo $this->upload->display_errors();
                die;
            }
        }

        $this->db->set($data);
        $this->db->where('id', $id);
        $this->db->update('presiden');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil diubah !</div>');
        redirect('Admin/presiden');
    }

    public function deletePresiden($id)
    {
        $presiden = $this->db->get_where('presiden', ['id' => $id])->row_array();
        if ($presiden['foto'] != "default.png") {
            unlink(FCPATH . 'assets/img/foto_calon/' . $presiden['foto']);
        }
        $this->db->where('id', $id);
        $this->db->delete('presiden');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil dihapus !</div>');
        redirect('Admin/presiden');
    }

    public function gubernur()
    {
        $data['title'] = 'Data Calon';
        $data['user'] = $this->db->get_where('user', ['npm' => $this->session->userdata('npm')])->row_array();
        $data['gubernur'] = $this->db->get('gubernur')->result_array();

        $this->form_validation->set_rules('no_urut', 'No Urut', 'required|trim');
        $this->form_validation->set_rules('nama_ketua', 'Nama Ketua', 'required|trim');
        $this->form_validation->set_rules('nama_wakil', 'Nama Wakil', 'required|trim');
        $this->form_validation->set_rules('jur_ketua', 'Jurusan Ketua', 'alpha_numeric_spaces');
        $this->form_validation->set_rules('jur_wakil', 'Jurusan Wakil', 'alpha_numeric_spaces');
        $this->form_validation->set_rules('dapil', 'Dapil', 'required|alpha_numeric_spaces');
        $this->form_validation->set_rules('visi', 'Visi', 'required|trim');
        $this->form_validation->set_rules('misi', 'Misi', 'required|trim');
        if (empty($_FILES['foto']['name'])) {
            $this->form_validation->set_rules('foto', 'Foto Paslon', 'required');
        }
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/admin_header', $data);
            $this->load->view('templates/admin_sidebar', $data);
            $this->load->view('templates/admin_topbar');
            $this->load->view('admin/gubernur', $data);
            $this->load->view('templates/admin_footer');
        } else {
            $no_urut = $this->input->post('no_urut');
            $nama_ketua = $this->input->post('nama_ketua');
            $nama_wakil = $this->input->post('nama_wakil');
            $jur_ketua = $this->input->post('jur_ketua');
            $jur_wakil = $this->input->post('jur_wakil');
            $dapil = $this->input->post('dapil');
            $visi = $this->input->post('visi');
            $misi = $this->input->post('misi');

            $data = [
                'no_urut' => $no_urut,
                'nama_ketua' => $nama_ketua,
                'nama_wakil' => $nama_wakil,
                'jur_ketua' => $jur_ketua,
                'jur_wakil' => $jur_wakil,
                'dapil' => $dapil,
                'visi' => $visi,
                'misi' => $misi
            ];

            $upload_image = $_FILES['foto']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']     = '4096';
                $config['upload_path'] = './assets/img/foto_calon/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('foto')) {
                    $data['foto'] = $upload_image;
                } else {
                    echo $this->upload->display_errors();
                    die;
                }
            }
            $this->db->insert('gubernur', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil ditambahkan !</div>');
            redirect('Admin/gubernur');
        }
    }

    public function editGubernur($id)
    {
        $gubernur = $this->db->get_where('gubernur', ['id' => $id])->row_array();

        $no_urut = $this->input->post('no_urut');
        $nama_ketua = $this->input->post('nama_ketua');
        $nama_wakil = $this->input->post('nama_wakil');
        $jur_ketua = $this->input->post('jur_ketua');
        $jur_wakil = $this->input->post('jur_wakil');
        $dapil = $this->input->post('dapil');
        $visi = $this->input->post('visi');
        $misi = $this->input->post('misi');

        $data = [
            'no_urut' => $no_urut,
            'nama_ketua' => $nama_ketua,
            'nama_wakil' => $nama_wakil,
            'jur_ketua' => $jur_ketua,
            'jur_wakil' => $jur_wakil,
            'dapil' => $dapil,
            'visi' => $visi,
            'misi' => $misi
        ];

        $upload_image = $_FILES['foto']['name'];

        if ($upload_image) {
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size']     = '4096';
            $config['upload_path'] = './assets/img/foto_calon/';

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('foto')) {
                $old_image = $gubernur['foto'];
                if ($old_image != 'default.png') {
                    unlink(FCPATH . 'assets/img/foto_calon/' . $old_image);
                }
                $image = $this->upload->data('file_name');
                $data['foto'] = $image;
            } else {
                echo $this->upload->display_errors();
                die;
            }
        }

        $this->db->set($data);
        $this->db->where('id', $id);
        $this->db->update('gubernur');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil diubah !</div>');
        redirect('Admin/gubernur');
    }

    public function deleteGubernur($id)
    {
        $gubernur = $this->db->get_where('gubernur', ['id' => $id])->row_array();
        if ($gubernur['foto'] != "default.png") {
            unlink(FCPATH . 'assets/img/foto_calon/' . $gubernur['foto']);
        }
        $this->db->where('id', $id);
        $this->db->delete('gubernur');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil dihapus !</div>');
        redirect('Admin/gubernur');
    }

    public function dpmu()
    {
        $data['title'] = 'Data Calon';
        $data['user'] = $this->db->get_where('user', ['npm' => $this->session->userdata('npm')])->row_array();
        $data['dpmu'] = $this->db->get('dpmu')->result_array();

        $this->form_validation->set_rules('no_urut', 'No Urut', 'required|trim');
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('jurusan', 'Jurusan', 'alpha_numeric_spaces');
        $this->form_validation->set_rules('fakultas', 'Fakultas', 'required|alpha_numeric_spaces');
        $this->form_validation->set_rules('visi', 'Visi', 'required|trim');
        $this->form_validation->set_rules('misi', 'Misi', 'required|trim');
        if (empty($_FILES['foto']['name'])) {
            $this->form_validation->set_rules('foto', 'Foto Paslon', 'required');
        }
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/admin_header', $data);
            $this->load->view('templates/admin_sidebar', $data);
            $this->load->view('templates/admin_topbar');
            $this->load->view('admin/dpmu', $data);
            $this->load->view('templates/admin_footer');
        } else {
            $no_urut = $this->input->post('no_urut');
            $nama = $this->input->post('nama');
            $jurusan = $this->input->post('jurusan');
            $fakultas = $this->input->post('fakultas');
            $visi = $this->input->post('visi');
            $misi = $this->input->post('misi');

            $data = [
                'no_urut' => $no_urut,
                'nama' => $nama,
                'jurusan' => $jurusan,
                'fakultas' => $fakultas,
                'visi' => $visi,
                'misi' => $misi
            ];

            $upload_image = $_FILES['foto']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']     = '4096';
                $config['upload_path'] = './assets/img/foto_calon/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('foto')) {
                    $data['foto'] = $upload_image;
                } else {
                    echo $this->upload->display_errors();
                    die;
                }
            }
            $this->db->insert('dpmu', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil ditambahkan !</div>');
            redirect('Admin/dpmu');
        }
    }

    public function editDpmu($id)
    {
        $dpmu = $this->db->get_where('dpmu', ['id' => $id])->row_array();

        $no_urut = $this->input->post('no_urut');
        $nama = $this->input->post('nama');
        $jurusan = $this->input->post('jurusan');
        $fakultas = $this->input->post('fakultas');
        $visi = $this->input->post('visi');
        $misi = $this->input->post('misi');

        $data = [
            'no_urut' => $no_urut,
            'nama' => $nama,
            'jurusan' => $jurusan,
            'fakultas' => $fakultas,
            'visi' => $visi,
            'misi' => $misi
        ];

        $upload_image = $_FILES['foto']['name'];

        if ($upload_image) {
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size']     = '4096';
            $config['upload_path'] = './assets/img/foto_calon/';

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('foto')) {
                $old_image = $dpmu['foto'];
                if ($old_image != 'default.png') {
                    unlink(FCPATH . 'assets/img/foto_calon/' . $old_image);
                }
                $image = $this->upload->data('file_name');
                $data['foto'] = $image;
            } else {
                echo $this->upload->display_errors();
                die;
            }
        }

        $this->db->set($data);
        $this->db->where('id', $id);
        $this->db->update('dpmu');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil diubah !</div>');
        redirect('Admin/dpmu');
    }

    public function deleteDpmu($id)
    {
        $dpmu = $this->db->get_where('dpmu', ['id' => $id])->row_array();
        if ($dpmu['foto'] != "default.png") {
            unlink(FCPATH . 'assets/img/foto_calon/' . $dpmu['foto']);
        }
        $this->db->where('id', $id);
        $this->db->delete('dpmu');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil dihapus !</div>');
        redirect('Admin/dpmu');
    }

    public function dpmf()
    {
        $data['title'] = 'Data Calon';
        $data['user'] = $this->db->get_where('user', ['npm' => $this->session->userdata('npm')])->row_array();
        $data['dpmf'] = $this->db->get('dpmf')->result_array();

        $this->form_validation->set_rules('no_urut', 'No Urut', 'required|trim');
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('jurusan', 'Jurusan', 'alpha_numeric_spaces');
        $this->form_validation->set_rules('fakultas', 'Fakultas', 'required|alpha_numeric_spaces');
        $this->form_validation->set_rules('visi', 'Visi', 'required|trim');
        $this->form_validation->set_rules('misi', 'Misi', 'required|trim');
        if (empty($_FILES['foto']['name'])) {
            $this->form_validation->set_rules('foto', 'Foto Paslon', 'required');
        }
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/admin_header', $data);
            $this->load->view('templates/admin_sidebar', $data);
            $this->load->view('templates/admin_topbar');
            $this->load->view('admin/dpmf', $data);
            $this->load->view('templates/admin_footer');
        } else {
            $no_urut = $this->input->post('no_urut');
            $nama = $this->input->post('nama');
            $jurusan = $this->input->post('jurusan');
            $fakultas = $this->input->post('fakultas');
            $visi = $this->input->post('visi');
            $misi = $this->input->post('misi');

            $data = [
                'no_urut' => $no_urut,
                'nama' => $nama,
                'jurusan' => $jurusan,
                'fakultas' => $fakultas,
                'visi' => $visi,
                'misi' => $misi
            ];

            $upload_image = $_FILES['foto']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']     = '4096';
                $config['upload_path'] = './assets/img/foto_calon/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('foto')) {
                    $data['foto'] = $upload_image;
                } else {
                    echo $this->upload->display_errors();
                    die;
                }
            }
            $this->db->insert('dpmf', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil ditambahkan !</div>');
            redirect('Admin/dpmf');
        }
    }

    public function editDpmf($id)
    {
        $dpmf = $this->db->get_where('dpmf', ['id' => $id])->row_array();

        $no_urut = $this->input->post('no_urut');
        $nama = $this->input->post('nama');
        $jurusan = $this->input->post('jurusan');
        $fakultas = $this->input->post('fakultas');
        $visi = $this->input->post('visi');
        $misi = $this->input->post('misi');

        $data = [
            'no_urut' => $no_urut,
            'nama' => $nama,
            'jurusan' => $jurusan,
            'fakultas' => $fakultas,
            'visi' => $visi,
            'misi' => $misi
        ];

        $upload_image = $_FILES['foto']['name'];

        if ($upload_image) {
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size']     = '4096';
            $config['upload_path'] = './assets/img/foto_calon/';

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('foto')) {
                $old_image = $dpmf['foto'];
                if ($old_image != 'default.png') {
                    unlink(FCPATH . 'assets/img/foto_calon/' . $old_image);
                }
                $image = $this->upload->data('file_name');
                $data['foto'] = $image;
            } else {
                echo $this->upload->display_errors();
                die;
            }
        }

        $this->db->set($data);
        $this->db->where('id', $id);
        $this->db->update('dpmf');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil diubah !</div>');
        redirect('Admin/dpmf');
    }

    public function deleteDpmf($id)
    {
        $dpmf = $this->db->get_where('dpmf', ['id' => $id])->row_array();
        if ($dpmf['foto'] != "default.png") {
            unlink(FCPATH . 'assets/img/foto_calon/' . $dpmf['foto']);
        }
        $this->db->where('id', $id);
        $this->db->delete('dpmf');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil dihapus !</div>');
        redirect('Admin/dpmf');
    }

    public function hasilvoting()
    {
        $data['title'] = 'Hasil Voting';
        $data['user'] = $this->db->get_where('user', ['npm' => $this->session->userdata('npm')])->row_array();
        $data['presiden'] = $this->db->get('presiden')->result_array();
        $data['dpmu'] = $this->db->get('dpmu')->result_array();
        $data['gubernur'] = $this->db->get('gubernur')->result_array();
        $data['dpmf'] = $this->db->get('dpmf')->result_array();

        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/admin_sidebar', $data);
        $this->load->view('templates/admin_topbar', $data);
        $this->load->view('admin/hasilvoting', $data);
        $this->load->view('templates/admin_footer');
    }
}
