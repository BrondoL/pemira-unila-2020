<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pages extends CI_Controller
{
    public function index()
    {
        $data = [
            'title' => 'Home'
        ];
        $this->load->view('templates/pages_header', $data);
        $this->load->view('templates/pages_navbar');
        $this->load->view('pages/index', $data);
        $this->load->view('templates/pages_footer');
    }
}
