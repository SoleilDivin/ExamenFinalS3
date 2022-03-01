<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class CategorieModel extends CI_Model
{
    public function insert($type_categorie,$Budget){
        $tmp = array();
        $this->db->query("Insert into categorie(type_categorie) values('".$type_categorie."')");
        $query = $this->db->query("select id_categorie from categorie order by id_categorie desc limit  1");
        $tmp = $query->row_array();
        $this->db->query("Insert into budget(date_budget, montant_budget, id_categorie) values(now(),$Budget,'".$tmp['id_categorie']."')");
    }
    public function getById($id){
        $query = $this->db->query("Select * from categorie where id_categorie = '".$id."'");
        return $query->result_array();
    }
    public function chartData(){
      $query =  $this->db->query("select sum(budget.montant_budget) as total,
       extract(YEAR from budget.date_budget) as Year,
       extract(Month from budget.date_budget) as Month,
       budget.id_categorie,
       c.type_categorie
from budget join categorie c on budget.id_categorie = c.id_categorie
group by extract(YEAR from budget.date_budget),extract(Month from budget.date_budget),budget.id_categorie,c.type_categorie;");
        return $query->result_array();
    }
}
?>