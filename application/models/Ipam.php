<?php
class Ipam extends CI_Model {
  var $table = 'networks';

  public function __construct() {
    parent::__construct();
    $this->load->database();
  }

  function get_all_networks() {
    $this->db->order_by("networks", 'ASC');
    $query = $this->db->get("networks");
    return $query->result_array();
  }

  function get_networks($limit, $start, $st = NULL){
    $network_order = " order by CAST(substr(trim(network),1,instr(trim(network),'.')-1) AS INTEGER), CAST(substr(substr(trim(network),length(substr(trim(network),1,instr(trim(network),'.')))+1,length(network)) ,1, instr(substr(trim(network),length(substr(trim(network),1,instr(trim(network),'.')))+1,length(network)),'.')-1) AS INTEGER), CAST(substr(substr(trim(network),length(substr(substr(trim(network),length(substr(trim(network),1,instr(trim(network),'.')))+1,length(network)) ,1, instr(substr(trim(network),length(substr(trim(network),1,instr(trim(network),'.')))+1,length(network)),'.')))+length(substr(trim(network),1,instr(trim(network),'.')))+1,length(network)) ,1, instr(substr(trim(network),length(substr(substr(trim(network),length(substr(trim(network),1,instr(trim(network),'.')))+1,length(network)) ,1, instr(substr(trim(network),length(substr(trim(network),1,instr(trim(network),'.')))+1,length(network)),'.')))+length(substr(trim(network),1,instr(trim(network),'.')))+1,length(network)),'.')-1) AS INTEGER), CAST(substr(trim(network),length(substr(substr(trim(network),length(substr(substr(trim(network),length(substr(trim(network),1,instr(trim(network),'.')))+1,length(network)) ,1, instr(substr(trim(network),length(substr(trim(network),1,instr(trim(network),'.')))+1,length(network)),'.')))+length(substr(trim(network),1,instr(trim(network),'.')))+1,length(network)) ,1, instr(substr(trim(network),length(substr(substr(trim(network),length(substr(trim(network),1,instr(trim(network),'.')))+1,length(network)) ,1, instr(substr(trim(network),length(substr(trim(network),1,instr(trim(network),'.')))+1,length(network)),'.')))+length(substr(trim(network),1,instr(trim(network),'.')))+1,length(network)),'.')))+ length(substr(trim(network),1,instr(trim(network),'.')))+length(substr(substr(trim(network),length(substr(trim(network),1,instr(trim(network),'.')))+1,length(network)) ,1, instr(substr(trim(network),length(substr(trim(network),1,instr(trim(network),'.')))+1,length(network)),'.')))+1,length(trim(network))) AS INTEGER) ";
    if ($st == "NIL") $st = "";
    $sql = " select * from networks where network like '%$st%' or note like '%$st%'";
    $sql_limit = " limit " . $start . ", " . $limit;
	  $sql = "$sql $network_order $sql_limit";
	  $query = $this->db->query($sql);
    return $query->result_array();
  }

  function get_networks_count($st = NULL){
    if ($st == "NIL") $st = "";
    $sql = "select * from networks where network like '%$st%' or note like '%$st%'";
    $query = $this->db->query($sql);
    return $query->num_rows();
  }

  function networks_search($str) {
    $str = urldecode($str); // for japanese
    $this->db->like('network', "$str");
    $this->db->or_like('note', $str);
    $this->db->order_by("network", "ASC");
    $query = $this->db->get('networks');

    if ($query->num_rows() <= 0) {
      return;
    }

    return $query->result_array();
  }

	public function networks_get_by_id($id){
    $this->db->from("networks");
 	  $this->db->where('id',$id);
   	  $query = $this->db->get();
	  return $query->row();
	}

	public function networks_add($data){
    $this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function networks_update($where, $data){
    $this->db->update("networks", $data, $where);
		return $this->db->affected_rows();
	}

	public function networks_delete_by_id($id){
    $this->db->where('id', $id);
		$this->db->delete($this->table);
	}

  function get_all_hosts(){
    $query = $this->db->get("hosts");
    return $query->result_array();
  }

  function get_hosts($limit, $start, $st = NULL){
    $host_order = " order by CAST(substr(trim(address),1,instr(trim(address),'.')-1) AS INTEGER), CAST(substr(substr(trim(address),length(substr(trim(address),1,instr(trim(address),'.')))+1,length(address)) ,1, instr(substr(trim(address),length(substr(trim(address),1,instr(trim(address),'.')))+1,length(address)),'.')-1) AS INTEGER), CAST(substr(substr(trim(address),length(substr(substr(trim(address),length(substr(trim(address),1,instr(trim(address),'.')))+1,length(address)) ,1, instr(substr(trim(address),length(substr(trim(address),1,instr(trim(address),'.')))+1,length(address)),'.')))+length(substr(trim(address),1,instr(trim(address),'.')))+1,length(address)) ,1, instr(substr(trim(address),length(substr(substr(trim(address),length(substr(trim(address),1,instr(trim(address),'.')))+1,length(address)) ,1, instr(substr(trim(address),length(substr(trim(address),1,instr(trim(address),'.')))+1,length(address)),'.')))+length(substr(trim(address),1,instr(trim(address),'.')))+1,length(address)),'.')-1) AS INTEGER), CAST(substr(trim(address),length(substr(substr(trim(address),length(substr(substr(trim(address),length(substr(trim(address),1,instr(trim(address),'.')))+1,length(address)) ,1, instr(substr(trim(address),length(substr(trim(address),1,instr(trim(address),'.')))+1,length(address)),'.')))+length(substr(trim(address),1,instr(trim(address),'.')))+1,length(address)) ,1, instr(substr(trim(address),length(substr(substr(trim(address),length(substr(trim(address),1,instr(trim(address),'.')))+1,length(address)) ,1, instr(substr(trim(address),length(substr(trim(address),1,instr(trim(address),'.')))+1,length(address)),'.')))+length(substr(trim(address),1,instr(trim(address),'.')))+1,length(address)),'.')))+ length(substr(trim(address),1,instr(trim(address),'.')))+length(substr(substr(trim(address),length(substr(trim(address),1,instr(trim(address),'.')))+1,length(address)) ,1, instr(substr(trim(address),length(substr(trim(address),1,instr(trim(address),'.')))+1,length(address)),'.')))+1,length(trim(address))) AS INTEGER) ";
    if ($st == "NIL") $st = "";
    $sql1 = " select * from hosts where address like '%$st%' ";
    $sql2 = " or host like '%$st%' or note like '%$st%' or mac like '%$st%'";
        $sql_limit = " limit " . $start . ", " . $limit;
        $sql = "$sql1 $sql2 $host_order $sql_limit";
    $query = $this->db->query($sql);
    return $query->result_array();
  }

  function get_hosts_count($st = NULL){
    if ($st == "NIL") $st = "";
    $sql1 = "select * from hosts where address like '%$st%' ";
        $sql2 = " or host like '%$st%' or note like '%$st%' or mac like '%$st%'";
        $sql = "$sql1 $sql2";
    $query = $this->db->query($sql);
    return $query->num_rows();
  }

  function hosts_search($str) {
    $str = urldecode($str); // for japanese
    $this->db->like('address', "$str");
        $this->db->or_like('host', $str);
    $this->db->or_like('note', $str);
        $this->db->or_like('mac', $str);
        $this->db->order_by("hosts", "ASC");
    $query = $this->db->get('hosts');

    if ($query->num_rows() <= 0) {
      return;
    }
    return $query->result_array();
  }


	public function hosts_get_by_id($id){
    $this->db->from("hosts");
		$this->db->where('id',$id);
		$query = $this->db->get();
    return $query->row();
	}

	public function hosts_add($data){
    $this->db->insert("hosts", $data);
    return $this->db->insert_id();
	}

	public function hosts_update($where, $data){
    $this->db->update("hosts", $data, $where);
    return $this->db->affected_rows();
	}

	public function hosts_delete_by_id($id){
    $this->db->where('id', $id);
    $this->db->delete("hosts");
	}

  private function _get_datatables_query(){
    $this->db->from($this->table);
    $i = 0;
    foreach ($this->column_search as $item){
      if($_POST['search']['value']) // if datatable send POST for search
            {
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. 
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
        if(isset($_POST['order'])){
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }
        else if(isset($this->order)){
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
  }


  function get_datatables(){
    $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get("hosts");
        return $query->result();
    }
}
