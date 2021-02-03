<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('npm')) {
            redirect('auth');
        } else {
            if ($this->session->userdata('role_id') == 1) {
                redirect('admin');
            }
            $user = $this->db->get_where('user', ['npm' => $this->session->userdata('npm')])->row_array();
            if (!($user['is_active'] == 1)) {
                redirect('auth/verify');
            } else {
                if ($user['presiden'] == 1 && $user['dpmu'] == 1 && $user['gubernur'] == 1 && $user['dpmf'] == 1) {
                    redirect('auth/done');
                }
            }
        }
    }

    public function index()
    {
        $data = [
            'title' => 'Pemira UNILA 2020'
        ];
        $data['user'] = $this->db->get_where('user', ['npm' => $this->session->userdata('npm')])->row_array();

        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/user_sidebar');
        $this->load->view('templates/admin_topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/admin_footer');
    }

    public function Presiden()
    {
        $data = [
            'title' => 'Pilih Presiden'
        ];
        $data['user'] = $this->db->get_where('user', ['npm' => $this->session->userdata('npm')])->row_array();
        if ($data['user']['presiden'] != 0) {
            redirect('user/done');
        }
        $data['presiden'] = $this->db->get('presiden')->result_array();

        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/user_sidebar');
        $this->load->view('templates/admin_topbar', $data);
        $this->load->view('user/presiden', $data);
        $this->load->view('templates/admin_footer');
    }

    public function detailPresiden($id)
    {
        $data['title'] = 'Pilih Presiden';
        $data['user'] = $this->db->get_where('user', ['npm' => $this->session->userdata('npm')])->row_array();
        if ($data['user']['presiden'] != 0) {
            redirect('user/done');
        }
        $data['presiden'] = $this->db->get_where('presiden', ['id' => $id])->row_array();

        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/user_sidebar');
        $this->load->view('templates/admin_topbar', $data);
        $this->load->view('user/detailpresiden', $data);
        $this->load->view('templates/admin_footer');
    }

    public function pilihPresiden($id)
    {
        $data['user'] = $this->db->get_where('user', ['npm' => $this->session->userdata('npm')])->row_array();
        if ($data['user']['presiden'] != 0) {
            redirect('user/done');
        }
        $npm = $this->session->userdata('npm');
        $presiden = $this->db->get_where('presiden', ['id' => $id])->row_array();
        $suara = $this->db->get('suara')->result_array();
        foreach ($suara as $s) {
            if (password_verify($npm, $s['npm'])) {
                $key = $s['npm'];
            }
        }

        $this->db->set(['presiden' => $presiden['no_urut']]);
        $this->db->where('npm', $key);
        $this->db->update('suara');

        $this->db->set(['presiden' => 1]);
        $this->db->where('npm', $npm);
        $this->db->update('user');

        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Berhasil Memilih !</div>');
        redirect('user');
    }

    public function dpmu()
    {
        $data = [
            'title' => 'Pilih DPM U'
        ];
        $data['user'] = $this->db->get_where('user', ['npm' => $this->session->userdata('npm')])->row_array();
        if ($data['user']['dpmu'] != 0) {
            redirect('user/done');
        }
        $result = $this->db->get_where('dpmu', ['fakultas' => $data['user']['fakultas']]);
        $data['dpmu'] = $result->result_array();
        if ($result->num_rows() > 0) {
            $this->load->view('templates/admin_header', $data);
            $this->load->view('templates/user_sidebar');
            $this->load->view('templates/admin_topbar', $data);
            $this->load->view('user/dpmu', $data);
            $this->load->view('templates/admin_footer');
        } else {
            $npm = $this->session->userdata('npm');
            $this->db->set(['dpmu' => 1]);
            $this->db->where('npm', $npm);
            $this->db->update('user');
            $this->load->view('templates/admin_header', $data);
            $this->load->view('templates/user_sidebar');
            $this->load->view('templates/admin_topbar', $data);
            $this->load->view('user/kosong', $data);
            $this->load->view('templates/admin_footer');
        }
    }

    public function detailDpmu($id)
    {
        $data['title'] = 'Pilih DPM U';
        $data['user'] = $this->db->get_where('user', ['npm' => $this->session->userdata('npm')])->row_array();
        if ($data['user']['dpmu'] != 0) {
            redirect('user/done');
        }
        $data['dpmu'] = $this->db->get_where('dpmu', ['id' => $id])->row_array();

        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/user_sidebar');
        $this->load->view('templates/admin_topbar', $data);
        $this->load->view('user/detaildpmu', $data);
        $this->load->view('templates/admin_footer');
    }

    public function pilihDpmu($id)
    {
        $data['user'] = $this->db->get_where('user', ['npm' => $this->session->userdata('npm')])->row_array();
        if ($data['user']['dpmu'] != 0) {
            redirect('user/done');
        }
        $npm = $this->session->userdata('npm');
        $dpmu = $this->db->get_where('dpmu', ['id' => $id])->row_array();
        $suara = $this->db->get('suara')->result_array();
        foreach ($suara as $s) {
            if (password_verify($npm, $s['npm'])) {
                $key = $s['npm'];
            }
        }

        $this->db->set(['dpmu' => $dpmu['fakultas'] . $dpmu['no_urut']]);
        $this->db->where('npm', $key);
        $this->db->update('suara');

        $this->db->set(['dpmu' => 1]);
        $this->db->where('npm', $npm);
        $this->db->update('user');

        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Berhasil Memilih !</div>');
        redirect('user');
    }

    public function gubernur()
    {
        $data = [
            'title' => 'Pilih Gubernur'
        ];
        $data['user'] = $this->db->get_where('user', ['npm' => $this->session->userdata('npm')])->row_array();
        if ($data['user']['gubernur'] != 0) {
            redirect('user/done');
        }
        $result = $this->db->get_where('gubernur', ['dapil' => $data['user']['fakultas']]);
        $data['gubernur'] = $result->result_array();
        if ($result->num_rows() > 0) {
            $this->load->view('templates/admin_header', $data);
            $this->load->view('templates/user_sidebar');
            $this->load->view('templates/admin_topbar', $data);
            $this->load->view('user/gubernur', $data);
            $this->load->view('templates/admin_footer');
        } else {
            $npm = $this->session->userdata('npm');
            $this->db->set(['gubernur' => 1]);
            $this->db->where('npm', $npm);
            $this->db->update('user');
            $this->load->view('templates/admin_header', $data);
            $this->load->view('templates/user_sidebar');
            $this->load->view('templates/admin_topbar', $data);
            $this->load->view('user/kosong', $data);
            $this->load->view('templates/admin_footer');
        }
    }

    public function detailGubernur($id)
    {
        $data['title'] = 'Pilih Gubernur';
        $data['user'] = $this->db->get_where('user', ['npm' => $this->session->userdata('npm')])->row_array();
        if ($data['user']['gubernur'] != 0) {
            redirect('user/done');
        }
        $data['gubernur'] = $this->db->get_where('gubernur', ['id' => $id])->row_array();

        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/user_sidebar');
        $this->load->view('templates/admin_topbar', $data);
        $this->load->view('user/detailGubernur', $data);
        $this->load->view('templates/admin_footer');
    }

    public function pilihGubernur($id)
    {
        $data['user'] = $this->db->get_where('user', ['npm' => $this->session->userdata('npm')])->row_array();
        if ($data['user']['gubernur'] != 0) {
            redirect('user/done');
        }
        $npm = $this->session->userdata('npm');
        $gubernur = $this->db->get_where('gubernur', ['id' => $id])->row_array();
        $suara = $this->db->get('suara')->result_array();
        foreach ($suara as $s) {
            if (password_verify($npm, $s['npm'])) {
                $key = $s['npm'];
            }
        }

        $this->db->set(['gubernur' => $gubernur['dapil'] . $gubernur['no_urut']]);
        $this->db->where('npm', $key);
        $this->db->update('suara');

        $this->db->set(['gubernur' => 1]);
        $this->db->where('npm', $npm);
        $this->db->update('user');

        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Berhasil Memilih !</div>');
        redirect('user');
    }

    public function dpmf()
    {
        $data = [
            'title' => 'Pilih DPM F'
        ];
        $data['user'] = $this->db->get_where('user', ['npm' => $this->session->userdata('npm')])->row_array();
        if ($data['user']['dpmf'] != 0) {
            redirect('user/done');
        }
        $result = $this->db->get_where('dpmf', ['fakultas' => $data['user']['fakultas'], 'jurusan' => $data['user']['jurusan']]);
        $data['dpmf'] = $result->result_array();
        if ($result->num_rows() > 0) {
            $this->load->view('templates/admin_header', $data);
            $this->load->view('templates/user_sidebar');
            $this->load->view('templates/admin_topbar', $data);
            $this->load->view('user/dpmf', $data);
            $this->load->view('templates/admin_footer');
        } else {
            $npm = $this->session->userdata('npm');
            $this->db->set(['dpmf' => 1]);
            $this->db->where('npm', $npm);
            $this->db->update('user');
            $this->load->view('templates/admin_header', $data);
            $this->load->view('templates/user_sidebar');
            $this->load->view('templates/admin_topbar', $data);
            $this->load->view('user/kosong', $data);
            $this->load->view('templates/admin_footer');
        }
    }

    public function detailDpmf($id)
    {
        $data['title'] = 'Pilih DPM U';
        $data['user'] = $this->db->get_where('user', ['npm' => $this->session->userdata('npm')])->row_array();
        if ($data['user']['dpmf'] != 0) {
            redirect('user/done');
        }
        $data['dpmf'] = $this->db->get_where('dpmf', ['id' => $id])->row_array();

        $this->load->view('templates/admin_header', $data);
        $this->load->view('templates/user_sidebar');
        $this->load->view('templates/admin_topbar', $data);
        $this->load->view('user/detaildpmf', $data);
        $this->load->view('templates/admin_footer');
    }

    public function pilihDpmf($id)
    {
        $data['user'] = $this->db->get_where('user', ['npm' => $this->session->userdata('npm')])->row_array();
        if ($data['user']['dpmf'] != 0) {
            redirect('user/done');
        }
        $npm = $this->session->userdata('npm');
        $dpmf = $this->db->get_where('dpmf', ['id' => $id])->row_array();
        $suara = $this->db->get('suara')->result_array();
        foreach ($suara as $s) {
            if (password_verify($npm, $s['npm'])) {
                $key = $s['npm'];
            }
        }

        $this->db->set(['dpmf' => $dpmf['fakultas'] . $dpmf['jurusan'] . $dpmf['no_urut']]);
        $this->db->where('npm', $key);
        $this->db->update('suara');

        $this->db->set(['dpmf' => 1]);
        $this->db->where('npm', $npm);
        $this->db->update('user');

        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Berhasil Memilih !</div>');
        redirect('user');
    }

    public function done()
    {
        $data = [
            'title' => 'Pemira UNILA 2020'
        ];
        $data['user'] = $this->db->get_where('user', ['npm' => $this->session->userdata('npm')])->row_array();

        $this->load->view('user/done', $data);
    }
}
