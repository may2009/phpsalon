<?php
class Test_model extends CI_Model
{

    public function select_usr_model()
    {
        $query=$this->db->get('test');
        return $query->result();
    }

    public function insert_tst_model($data)
    {
        $query=$this->db->insert('test',$data);
        return $query->result();
    }
}