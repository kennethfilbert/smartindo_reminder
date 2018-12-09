<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UserModel extends CI_Model{
	public function __construct(){
		parent::__construct();
	}

	public function login($data) {

	$condition = "adm_user =" . "'" . $data['adm_user'] . "' AND " . "adm_pass =" . "'" . $data['adm_pass'] . "'";
	$this->db->select('*');
	$this->db->from('tbl_admin');
	$this->db->where($condition);
	$this->db->limit(1);
	$query = $this->db->get();

	if ($query->num_rows() == 1) {
		return true;
		} else {
		return false;
		}
	}

	public function setSession($sessionId){
		$data=array(
				'session_id'=>$sessionId
		);
		
		$this->db->where('session_id', NULL);
		$this->db->update('login_tracker',$data);
	}

	public function unsetSession(){
		$data=array(
				'session_id'=>NULL
		);
		$this->db->update('login_tracker',$data);
	}



	public function getUserInfo($username){
		$condition = "adm_user =" . "'" . $username . "'";
		$this->db->select('*');
		$this->db->from('tbl_admin');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();

			if ($query->num_rows() == 1) {
				return $query->result();
			} else {
				return false;
			}
		}

	public function insertNewAdmin($data){
		//check whether email already exist
		$condition = "adm_email =" . "'" . $data['adm_email'] . "'";
		$this->db->select('*');
		$this->db->from('tbl_admin');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			$this->db->insert('tbl_admin', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		} else {
			return false;
		}
	}

	public function editAdmin($id, $newData){
		$condition = "id_admin =" . "'" . $id . "'";
		$this->db->set($newData);
		$this->db->where($condition);
		$this->db->update('tbl_admin');
		if ($this->db->affected_rows() > 0) {
			return true;
		} 
		else {
			return false;
		}
	}

	public function deleteAdmin($id){
		$condition = "id_admin =" . "'" . $id . "'";
		$this->db->where($condition);
		$this->db->delete('tbl_admin');
	}

	public function insertNewClient($data){
		//check whether email already exist
		$condition = "client_email =" . "'" . $data['client_email'] . "'";
		$this->db->select('*');
		$this->db->from('tbl_client');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			$this->db->insert('tbl_client', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		} else {
			return false;
		}
	}

	public function editClient($id, $newData){
		$condition = "id_client =" . "'" . $id . "'";
		$this->db->set($newData);
		$this->db->where($condition);
		$this->db->update('tbl_client');
		if ($this->db->affected_rows() > 0) {
			return true;
		} 
		else {
			return false;
		}
	}

	public function deleteClient($id){
		$condition = "id_client =" . "'" . $id . "'";
		$this->db->where($condition);
		$this->db->delete('tbl_client');
	}

	public function addNewPayment($data){
		if($data['id_client'] == NULL){
			return false;
		}
		else{
			$this->db->insert('tbl_payment_mtc', $data);
			return true;
		}
		//$this->db->insert('tbl_payment_mtc', $data);
				
	}

	public function setActive($email){
		$data = array(
			'client_active' => 1
		);

		$this->db->where('client_email', $email);
		$this->db->update('tbl_client', $data);
	}

	public function addToExpiry($date, $id){
		$data = array(
			'exp_date' => $date,
			'id_client' =>$id
		);
		$condition = "id_client =" . "'" . $id . "'";
		$this->db->where($condition);
		$this->db->delete('expiry_system');

		$this->db->insert('expiry_system', $data);
	}


	public function deletePayment($id){
		$condition = "id_payment =" . "'" . $id . "'";
		$this->db->where($condition);
		$this->db->delete('tbl_payment_mtc');
	}

	/*public function loginChanger($loggedInAmount){
		
		$loginData = array(
			'login_amount' => $loggedInAmount,
			'last_login' => date("Y-m-d H:i:s")
		);
		$this->db->where('login_amount', 0);
		$this->db->update('login_tracker', $loginData);
		
		return $loggedInAmount;
		
	}

	public function logoutChanger($loggedInAmount){
		$data = array(
			'login_amount' => $loggedInAmount-1,
		);
		$this->db->where('login_amount', 1);
		$this->db->update('login_tracker', $data);
	}*/


}

?>