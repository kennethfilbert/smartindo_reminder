<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DataModel extends CI_Model{
	public function __construct(){
		parent::__construct();
	}

	public function getAdmins(){
		$this->db->select('*');
		$this->db->from('tbl_admin');
		$query = $this->db->get();

		return $query->result_array();
	}

	public function getClients(){
		$this->db->select('*');
		$this->db->from('tbl_client');
		$this->db->join('tbl_admin', 'tbl_admin.id_admin = tbl_client.id_admin');
		$query = $this->db->get();

		return $query->result_array();
	}

	public function getPayments(){
		$this->db->select('*');
		$this->db->from('tbl_payment_mtc');
		$this->db->join('tbl_client', 'tbl_client.id_client = tbl_payment_mtc.id_client');
		$this->db->join('tbl_admin', 'tbl_admin.id_admin = tbl_payment_mtc.id_admin');
		$query = $this->db->get();

		return $query->result_array();
	}

	public function getMaxPayment(){
		$this->db->select_max('payment_date');
		$query = $this->db->get('tbl_payment_mtc');

		return $query->result_array();
	}


	public function getClientEmail($date){
		$this->db->select('client_email');
		$this->db->from('tbl_client');
		$this->db->join('tbl_payment_mtc', 'tbl_payment_mtc.id_client = tbl_client.id_client');
		$this->db->like('payment_date', $date);
		$this->db->limit(1);
		$query = $this->db->get();

		return $query->result_array();
	}

	public function getClientName($date){
		$this->db->select('client_name');
		$this->db->from('tbl_client');
		$this->db->join('tbl_payment_mtc', 'tbl_payment_mtc.id_client = tbl_client.id_client');
		$this->db->like('payment_date', $date);
		$this->db->limit(1);
		$query = $this->db->get();

		return $query->result_array();
	}

	public function getPaymentAmount($date){
		$this->db->select('nominal_tgh');
		$this->db->from('tbl_payment_mtc');
		$this->db->like('payment_date', $date);
		$this->db->limit(1);
		$query = $this->db->get();

		return $query->result_array();
	}

	public function getClientById($id){
		$this->db->select('*');
		$this->db->from('tbl_client');
		$this->db->where('id_client', $id);
		$this->db->limit(1);
		$query = $this->db->get();

		return $query->row_array();
	}

	public function getAdminById($id){
		$this->db->select('*');
		$this->db->from('tbl_admin');
		$this->db->where('id_admin', $id);
		$this->db->limit(1);
		$query = $this->db->get();

		return $query->row_array();
	}

	public function getLoginNumber(){
		$this->db->select('login_amount');
		$this->db->from('login_tracker');
		$this->db->limit(1);

		$query = $this->db->get();

		return $query->row_array();
	}

	

}