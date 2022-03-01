<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Categorie extends CI_Controller
{
    public function insertion() {
        $this->load->view('categorie_insertion.php');
    }

    public function insert(){
        $data['categorie_name'] = $this->input->post('categorie_name');
        $data['Budget'] = $this->input->post('budget_mensuel');
        $this->load->Model('CategorieModel');
        $this->CategorieModel->insert($data['categorie_name'],$data['Budget']);
        $this->load->view('index.php');
    }
}