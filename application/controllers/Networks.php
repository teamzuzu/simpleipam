<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Networks extends CI_Controller {

    function __construct() {
        parent::__construct();
        
        //helper
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->helper('myip');
        
        //library
	$this->load->library('session');
        $this->load->library('pagination');

        //model
        $this->load->model('Ipam');
    }


	public function index()
	{
        $data["host_name"]="";    //this is form in header
        $data["network_name"]="";

        //pagination settings
        $config['base_url'] = site_url("networks/search/NIL");
        $config['total_rows'] = $this->db->count_all('networks');
        $data['total_rows'] = $config['total_rows'];
        $config['per_page'] = "5";
        $config["uri_segment"] = 4;
        $choice = $config["total_rows"]/$config["per_page"];
        $config["num_links"] = floor($choice);

        // integrate bootstrap pagination
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = 'Prev';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = 'Next';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);

        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        
        // get networks list
        $data['networks'] = $this->Ipam->get_networks($config["per_page"], $data['page'], NULL);
        
        $data['pagination'] = $this->pagination->create_links();

        $data['total_rows'] = $config['total_rows'];
        $data['start'] = $data['page'] + 1;
        $data['end'] = $data['start'] + $config['per_page'] - 1 ;

	$data['title'] = 'SimpleIPAM Networks';
	$this->load->view('template/header', $data);
	$this->load->view('networks_view', $data );
	$this->load->view('template/footer' );
    }
    

    function search()
    {
        $data["host_name"]="";    //this is form in header
        $search = ($this->input->post("network_name"))? $this->input->post("network_name") : "NIL";
        $search = ($this->uri->segment(3)) ? $this->uri->segment(3) : $search;
        $search= urldecode($search);

        
        empty($search) ? $data["network_name"]="" : $data["network_name"]=$search;
        if($search == "NIL" ){ $data["network_name"]=""; }


        // pagination settings
        $config = array();
        $config['base_url'] = site_url("networks/search/$search");
        $config['total_rows'] = $this->Ipam->get_networks_count($search);
        $config['per_page'] = "5";
        $config["uri_segment"] = 4;
        $choice = $config["total_rows"]/$config["per_page"];
        $config["num_links"] = floor($choice);

        // integrate bootstrap pagination
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = 'Prev';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = 'Next';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $this->pagination->initialize($config);

        $data['page'] = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        // get netwroks list
        $data['networks'] = $this->Ipam->get_networks($config['per_page'], $data['page'], $search);

        $data['pagination'] = $this->pagination->create_links();

        $data['total_rows'] = $config['total_rows'];
        $data['start'] = $data['page'] + 1;
        $data['end'] = $data['start'] + $config['per_page'] - 1 ;


        //load view
	$data['title'] = 'SimpleIPAM Networks';
	$this->load->view('template/header', $data);
	$this->load->view('networks_view', $data );
	$this->load->view('template/footer' );
    }

	
	public function networks_add(){
        	$this->_validate();
		$data = array(
		  'network' => $this->input->post('network'),
		  'cidr' => $this->input->post('cidr'),
		  'note' => $this->input->post('note'),
		);
		$insert = $this->Ipam->networks_add($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_edit($id){
		$data = $this->Ipam->networks_get_by_id($id);
		echo json_encode($data);
	}


	public function networks_update(){
        	$this->_validate();
	$data = array(
		'networks' => $this->input->post('networks'),
		'cidr' => $this->input->post('cidr'),
		'note' => $this->input->post('note'),
		);
	$this->Ipam->networks_update(array('id' => $this->input->post('id')), $data);
	echo json_encode(array("status" => TRUE));
	}


	public function networks_delete($id){
		$this->Ipam->networks_delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}


    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
 
        if($this->input->post('network') == '')
        {
            $data['inputerror'][] = 'network';
            $data['error_string'][] = 'Network is required';
            $data['status'] = FALSE;
        }


        $cidr=$this->input->post('cidr');
        if (!is_numeric($cidr))
        {
            $data['inputerror'][] = 'cidr';
            $data['error_string'][] = 'Cidr must be number';
            $data['status'] = FALSE;
        }
        if($cidr == '')
        {
            $data['inputerror'][] = 'cidr';
            $data['error_string'][] = 'Cidr is required';
            $data['status'] = FALSE;
        }

        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }

}
