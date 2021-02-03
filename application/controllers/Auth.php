<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function index()
    {
        if ($this->session->userdata('npm')) {
            redirect('/');
        } else {
            $this->form_validation->set_rules('npm', 'NPM', 'required|trim');
            $this->form_validation->set_rules('password', 'Password', 'required|trim');
            if ($this->form_validation->run() == false) {
                $data = [
                    'title' => 'Login Page'
                ];
                $this->load->view('templates/auth_header', $data);
                $this->load->view('auth/login');
                $this->load->view('templates/auth_footer');
            } else {
                $this->_login();
            }
        }
    }

    private function _login()
    {
        $npm = $this->input->post('npm', true);
        $password = $this->input->post('password', true);
        $user = $this->db->get_where('user', ['npm' => $npm])->row_array();
        if ($user) {
            if (password_verify($password, $user['password'])) {
                $data = [
                    'npm' => $user['npm'],
                    'role_id' => $user['role_id']
                ];
                $this->session->set_userdata($data);
                if ($user['role_id'] == 1) {
                    redirect('admin');
                } else {
                    redirect('auth/verify');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password Salah !</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Akun tidak ditemukan !</div>');
            redirect('auth');
        }
    }

    public function verify()
    {
        $npm = $this->session->userdata['npm'];
        $user = $this->db->get_where('user', ['npm' => $npm])->row_array();

        if ($user['is_active'] != 1) {
            $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
            $this->form_validation->set_rules('email', 'Email', 'required|trim');
            $this->form_validation->set_rules('jurusan', 'Jurusan', 'required|alpha_numeric_spaces');
            $this->form_validation->set_rules('fakultas', 'Fakultas', 'required|alpha_numeric_spaces');
            if (empty($_FILES['foto']['name'])) {
                $this->form_validation->set_rules('foto', 'Foto Selfie', 'required');
            }
            if ($this->form_validation->run() == false) {
                $data = [
                    'title' => 'Verifikasi Profile'
                ];
                $this->load->view('templates/pages_header', $data);
                $this->load->view('templates/pages_navbar');
                $this->load->view('pages/verifikasi', $data);
                $this->load->view('templates/pages_footer');
            } else {
                $nama = $this->input->post('nama', true);
                $email = $this->input->post('email', true);
                $fakultas = $this->input->post('fakultas', true);
                $jurusan = $this->input->post('jurusan', true);
                $data = [
                    'nama' => $nama,
                    'email' => $email,
                    'fakultas' => $fakultas,
                    'jurusan' => $jurusan
                ];
                $upload_image = $_FILES['foto']['name'];

                if ($upload_image) {
                    $config['allowed_types'] = 'gif|jpg|png|jpeg';
                    $config['max_size']     = '1024';
                    $config['upload_path'] = './assets/img/profile/';

                    $this->load->library('upload', $config);

                    if ($this->upload->do_upload('foto')) {
                        $data['foto'] = $upload_image;
                        $suara['npm'] = password_hash($this->session->userdata('npm'), PASSWORD_DEFAULT);
                        $this->db->insert('suara', $suara);

                        $data['is_active'] = 1;
                        $this->db->set($data);
                        $this->db->where('npm', $this->session->userdata('npm'));
                        $this->db->update('user');
                        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Verifikasi Berhasil!</div>');
                        redirect('user');
                    } else {
                        $error = array('error' => $this->upload->display_errors());
                        $data = [
                            'title' => 'Verifikasi Profile'
                        ];
                        $data['error'] = $error;
                        $this->load->view('templates/pages_header', $data);
                        $this->load->view('templates/pages_navbar');
                        $this->load->view('pages/verifikasi', $data);
                        $this->load->view('templates/pages_footer');
                    }
                }
            }
        } else {
            redirect('/');
        }
    }

    public function done()
    {
        $data = [
            'title' => 'Pemira UNILA 2020'
        ];
        $data['user'] = $this->db->get_where('user', ['npm' => $this->session->userdata('npm')])->row_array();

        $this->load->view('user/done', $data);
    }

    public function logout()
    {
        $this->session->unset_userdata('npm');
        $this->session->unset_userdata('role_id');
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You have been logout!</div>');
        redirect('/');
    }
}
