<?php

class table extends CI_Controller
{


    public function index()
    {

        $data['page_title'] = "Table";
        $data['page_name'] = "table-us";


        $data["test"] = $this->db->select('id,firstname,lastname,city')->from('test')->get()->result_array();


        $this->load->view('template', $data);
    }

    public function add()
    {

        $data['page_title'] = "Table Ajouter";
        $data['page_name'] = "table-add";


        $this->load->view('template', $data);

    }


    public function insert()
    {

    if (isset($_POST['firstname'])) {
            $post_data = $_POST;
            $result = $this->db->insert('test', $post_data);
            if ($result) {
                $this->session->set_flashdata('message', 'Succefully Created  Info.');
            } else {
                $this->session->set_flashdata('message', "An error occurred while inserting data.");
            }
            redirect('table', 'refresh');
        }
    }


    public function delete($id)
    {





        if ($id != '') {
            $this->db->where('id', $id);
            $result = $this->db->delete('test');
            if ($result) {
                $this->session->set_flashdata('message', "An sucess inserted.");
            } else {
                $this->session->set_flashdata('message', "An error occurred while inserting data.");
            }
            redirect(base_url('table'));
        }


    }
    public function view_update($id) {
        if ($id != '') {
            $this->db->where('id', $id);
            $row['info'] = $this->db->get('test')->row_array();
        }
        $data['page_name'] = $this->load->view('view_update', $row, true);
        $this->load->view('template', $data);
    }



    public function table_update($id)
    {


        if ($id != '') {
            $this->db->where('id', $id);
            $row = $this->db->get('test')->row_array();
        }

        echo json_encode(array($row));

    }


    public function update()
    {
        if (isset($_POST['id'])) {
       $update_data = $_POST;
       $id = $update_data['id'];
     //  unset($update_data['id']);

       $this->db->where('id', $id);
      $this->db->update('test', $update_data);

            redirect('table', 'refresh');
     }
    }


}