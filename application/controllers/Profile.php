<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('npm')) {
            redirect('auth');
        }
    }

    public function index()
    {
        $data['title'] = 'My Profile';
        $data['user'] = $this->db->get_where('user', ['npm' => $this->session->userdata('npm')])->row_array();
        $this->load->view('templates/admin_header', $data);
        if ($this->session->userdata('role_id') == 1) {
            $this->load->view('templates/admin_sidebar');
        } else {
            $this->load->view('templates/user_sidebar');
        }
        $this->load->view('templates/admin_topbar', $data);
        $this->load->view('profile/index', $data);
        $this->load->view('templates/admin_footer');
    }
}
