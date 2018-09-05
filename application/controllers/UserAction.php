<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserAction extends CI_Controller {

	public function __construct(){
		parent::__construct();
        
        $this->load->library('session');
		$this->load->library('form_validation');
		$this->load->model('UserModel');
		$this->load->model('DataModel');
	}

	public function index()
	{
		$data = array();
		$data['js'] = $this->load->view('include/script.php', NULL, TRUE);
		$data['css'] = $this->load->view('include/style.php', NULL, TRUE);
		if($this->session->userdata('isUserLoggedIn')){
			$this->load->view('loginpage', $data);
		}
		else{
			$this->load->view('loginpage', $data);
		}
		
	}

	public function homepage(){
		$data = array();
		$data['js'] = $this->load->view('include/script.php', NULL, TRUE);
		$data['css'] = $this->load->view('include/style.php', NULL, TRUE);
		if($this->session->userdata('isUserLoggedIn')){
			$this->load->view('homepage', $data);
		}
		else{
			$data['error_msg'] = "Your session has expired. Please log in again.";
			$this->load->view('loginpage', $data);
		}
		
	}

	public function manageAdmin(){
		$data = array();
		$data['js'] = $this->load->view('include/script.php', NULL, TRUE);
        $data['css'] = $this->load->view('include/style.php', NULL, TRUE);
		$data['admins'] = $this->DataModel->getAdmins();
		if($this->session->userdata('isUserLoggedIn')){
			$this->load->view('manageadmin', $data);
		}
		else{
			$data['error_msg'] = "Your session has expired. Please log in again.";
			$this->load->view('loginpage', $data);
		}
		
	}

	public function addAdmin(){
		$data = array();
		$data['js'] = $this->load->view('include/script.php', NULL, TRUE);
		$data['css'] = $this->load->view('include/style.php', NULL, TRUE);
		if($this->session->userdata('isUserLoggedIn')){
			$this->load->view('addadmin', $data);
		}
		else{
			$data['error_msg'] = "Your session has expired. Please log in again.";
			$this->load->view('loginpage', $data);
		}
		
	}

	public function manageClient(){
		$data = array();
		$data['js'] = $this->load->view('include/script.php', NULL, TRUE);
        $data['css'] = $this->load->view('include/style.php', NULL, TRUE);
		$data['clients'] = $this->DataModel->getClients();
		if($this->session->userdata('isUserLoggedIn')){
			$this->load->view('manageclient', $data);
		}
		else{
			$data['error_msg'] = "Your session has expired. Please log in again.";
			$this->load->view('loginpage', $data);
		}
		
	}

	public function addClient($adminID){
		$data = array();
		$data['js'] = $this->load->view('include/script.php', NULL, TRUE);
        $data['css'] = $this->load->view('include/style.php', NULL, TRUE);
		$data['loggedInAdmin'] = $adminID;
		if($this->session->userdata('isUserLoggedIn')){
			$this->load->view('addclient', $data);
		}
		else{
			$data['error_msg'] = "Your session has expired. Please log in again.";
			$this->load->view('loginpage', $data);
		}
		
	}

	public function managePaymentMtc(){
		$data= array();
		$data['js'] = $this->load->view('include/script.php', NULL, TRUE);
        $data['css'] = $this->load->view('include/style.php', NULL, TRUE);
		$data['payments'] = $this->DataModel->getPayments();
		if($this->session->userdata('isUserLoggedIn')){
			$this->load->view('managepaymentmtc', $data);
		}
		else{
			$data['error_msg'] = "Your session has expired. Please log in again.";
			$this->load->view('loginpage', $data);
		}
        
	}

	public function addPayment($adminID){
		$data= array();
		$data['js'] = $this->load->view('include/script.php', NULL, TRUE);
        $data['css'] = $this->load->view('include/style.php', NULL, TRUE);
		$data['loggedInAdmin'] = $adminID;
		if($this->session->userdata('isUserLoggedIn')){
			$this->load->view('inputpaymentmtc', $data);
		}
		else{
			$data['error_msg'] = "Your session has expired. Please log in again.";
			$this->load->view('loginpage', $data);
		}
        
	}

	public function login(){
			$data = array();

			$data['js'] = $this->load->view('include/script.php', NULL, TRUE);
	        $data['css'] = $this->load->view('include/style.php', NULL, TRUE);
	        if($this->session->userdata('success_msg')){
	            $data['success_msg'] = $this->session->userdata('success_msg');
	            $this->session->unset_userdata('success_msg');
	        }
	        if($this->session->userdata('error_msg')){
	            $data['error_msg'] = $this->session->userdata('error_msg');
	            $this->session->unset_userdata('error_msg');
	        }

	         $this->form_validation->set_rules('username', 'username', 'required');
	         $this->form_validation->set_rules('password', 'password', 'required');	

	         

			         if($this->form_validation->run() == FALSE){
			         	if(isset($this->session->userdata['isUserLoggedIn'])){
							$this->load->view('homepage', $data);
						}else{
							$this->load->view('loginpage', $data);
						}
						} else {
			         	$loginData = array(
			         		'adm_user' => $this->input->post('username'),
			         		'adm_pass' => md5($this->input->post('password'))
			         		);

			         	$result = $this->UserModel->login($loginData);

			         	if($result==TRUE){
			         		$screenName = $this->input->post('username');
			         		$result = $this->UserModel->getUserInfo($screenName);
			         		$sessionData = array(
			         				'id' => $result[0]->id_admin,
			         				'username' => $result[0]->admin_name,
			         				'email' => $result[0]->adm_email,
			         		);

			         		$this->session->set_userdata('isUserLoggedIn', $sessionData);
			         		$loggedInUser = $sessionData;
			         		$this->load->view('homepage', $data);

			         	}
			         	else{
			         		$data['error_msg'] = 'Invalid username / password';
			         		$this->load->view('loginpage', $data);
			         	}
			         
				}
		}	

		public function logout(){
	        $this->session->unset_userdata('isUserLoggedIn');
	        $this->session->unset_userdata('userId');
	        $this->session->sess_destroy();
	        redirect(base_url(), 'refresh');
    	}

    	public function addNewAdmin(){
    		$data = array();

			$data['js'] = $this->load->view('include/script.php', NULL, TRUE);
	        $data['css'] = $this->load->view('include/style.php', NULL, TRUE);

	        if($this->session->userdata('success_msg')){
	            $data['success_msg'] = $this->session->userdata('success_msg');
	            $this->session->unset_userdata('success_msg');
	        }
	        if($this->session->userdata('error_msg')){
	            $data['error_msg'] = $this->session->userdata('error_msg');
	            $this->session->unset_userdata('error_msg');
	        }

	        $this->form_validation->set_rules('name', 'Username', 'required');
	        $this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('conf_password', 'confirm password', 'required|matches[password]');

			if($this->form_validation->run() == FALSE){
				$this->load->view('addadmin', $data);
			}
			else{
				$data = array(
					'admin_name' => $this->input->post('name'),
					'adm_user' => $this->input->post('username'),
					'adm_email' => $this->input->post('email'),
					'adm_pass' => md5($this->input->post('password')),
					'active' => $this->input->post('active')

				);

				$result = $this->UserModel->insertNewAdmin($data);
				if($result == TRUE){
					$data['success_msg'] = "Admin added succesfully";
					redirect(base_url('index.php/UserAction/manageadmin'));
				}
				else{
					$data['error_msg'] = 'Email already exists';
					redirect(base_url('index.php/UserAction/addadmin'));
				}
			}

    	}

    	public function editAdmin($id){
    		$data = array();

			$data['js'] = $this->load->view('include/script.php', NULL, TRUE);
	        $data['css'] = $this->load->view('include/style.php', NULL, TRUE);
	        $data['editing'] = $this->DataModel->getAdminById($id);

	        if($this->session->userdata('success_msg')){
	            $data['success_msg'] = $this->session->userdata('success_msg');
	            $this->session->unset_userdata('success_msg');
	        }
	        if($this->session->userdata('error_msg')){
	            $data['error_msg'] = $this->session->userdata('error_msg');
	            $this->session->unset_userdata('error_msg');
	        }
	        $this->form_validation->set_rules('name', 'Username', 'required');
	        $this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('conf_password', 'confirm password', 'required|matches[password]');

	        //var_dump($data['editing']);

	        if($this->form_validation->run() == FALSE){
				$this->load->view('editadmin', $data);
			}
			else{
				$newData = array(
					'admin_name' => $this->input->post('name'),
					'adm_user' => $this->input->post('username'),
					'adm_email' => $this->input->post('email'),
					'adm_pass' => md5($this->input->post('password')),
					'active' => $this->input->post('active')

				);
				$result = $this->UserModel->editAdmin($id, $newData);

				if($result == TRUE){
					$data['success_msg'] = "Admin edited succesfully";
					redirect(base_url('index.php/UserAction/manageadmin'));
				}
				else{
					$data['error_msg'] = 'Something went wrong';
					redirect(base_url('index.php/UserAction/editadmin'));
				}
			}

			//$this->load->view('editadmin', $data);
    	}

    	public function addNewClient($id){
    		$data = array();
			$data['js'] = $this->load->view('include/script.php', NULL, TRUE);
	        $data['css'] = $this->load->view('include/style.php', NULL, TRUE);

	        //var_dump($id);
	        //var_dump($_SESSION);

	        if($this->session->userdata('success_msg')){
	            $data['success_msg'] = $this->session->userdata('success_msg');
	            $this->session->unset_userdata('success_msg');
	        }
	        if($this->session->userdata('error_msg')){
	            $data['error_msg'] = $this->session->userdata('error_msg');
	            $this->session->unset_userdata('error_msg');
	        }
	 

	        $this->form_validation->set_rules('name', 'Username', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required');
			$this->form_validation->set_rules('nominal_tgh', 'Number', 'required');

			if($this->form_validation->run() == FALSE){
				$this->load->view('addclient', $data);
			}
			else{
				$data = array(
					'client_name' => $this->input->post('name'),
					'client_email' => $this->input->post('email'),
					'nominal_tgh' => $this->input->post('nominal_tgh'),
					'client_active' => $this->input->post('active'),
					'hostname' => 'localhost',
					'host_user' => 'root',
					'host_pass' => '',
					'id_admin' => $id

				);

				$result = $this->UserModel->insertNewClient($data);
				if($result == TRUE){
					$data['success_msg'] = "Client added succesfully";
					redirect(base_url('index.php/UserAction/manageclient'));
				}
				else{
					$data['error_msg'] = 'Email already exists';
					redirect(base_url('index.php/UserAction/addclient'));
				}
			}

    	}

    	public function editClient($id){
    		$data = array();

			$data['js'] = $this->load->view('include/script.php', NULL, TRUE);
	        $data['css'] = $this->load->view('include/style.php', NULL, TRUE);
	        $data['editing'] = $this->DataModel->getClientById($id);

	        if($this->session->userdata('success_msg')){
	            $data['success_msg'] = $this->session->userdata('success_msg');
	            $this->session->unset_userdata('success_msg');
	        }
	        if($this->session->userdata('error_msg')){
	            $data['error_msg'] = $this->session->userdata('error_msg');
	            $this->session->unset_userdata('error_msg');
	        }
	        $this->form_validation->set_rules('name', 'Username', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required');
			$this->form_validation->set_rules('nominal_tgh', 'Number', 'required');

	        //var_dump($data['editing']);

	        if($this->form_validation->run() == FALSE){
				$this->load->view('editclient', $data);
			}
			else{
				$newData = array(
					'client_name' => $this->input->post('name'),
					'client_email' => $this->input->post('email'),
					'nominal_tgh' => $this->input->post('nominal_tgh'),
					'client_active' => $this->input->post('active')

				);
				$result = $this->UserModel->editClient($id, $newData);

				if($result == TRUE){
					$data['success_msg'] = "Admin edited succesfully";
					redirect(base_url('index.php/UserAction/manageclient'));
				}
				else{
					$data['error_msg'] = 'Something went wrong';
					redirect(base_url('index.php/UserAction/editclient'));
				}
			}

			//$this->load->view('editadmin', $data);
    	}


    	public function addNewPayment($id){
    		$data = array();
			$data['js'] = $this->load->view('include/script.php', NULL, TRUE);
	        $data['css'] = $this->load->view('include/style.php', NULL, TRUE);

	        //var_dump($id);
	        //var_dump($_SESSION);

	        if($this->session->userdata('success_msg')){
	            $data['success_msg'] = $this->session->userdata('success_msg');
	            $this->session->unset_userdata('success_msg');
	        }
	        if($this->session->userdata('error_msg')){
	            $data['error_msg'] = $this->session->userdata('error_msg');
	            $this->session->unset_userdata('error_msg');
	        }
	 

	        $this->form_validation->set_rules('client_id', 'Number', 'required');
			$this->form_validation->set_rules('payment_date', 'Date', 'required');

			if($this->form_validation->run() == FALSE){
				$this->load->view('inputpaymentmtc', $data);
			}
			else{
				$clientData = $this->DataModel->getClientById($this->input->post('client_id'));
				//var_dump($clientData);
				$data = array(
					'id_client' => $clientData['id_client'],
					'nominal_tgh' => $clientData['nominal_tgh'],
					'payment_date' => $this->input->post('payment_date'),
					'id_admin' => $id

				);

				 //var_dump($data);
				$result = $this->UserModel->addNewPayment($data);
				$expiry = $this->UserModel->addToExpiry($data['payment_date'], $data['id_client']);

				if($result == TRUE && $expiry == TRUE){

					$data['success_msg'] = "Payment data added succesfully";
					redirect(base_url('index.php/UserAction/managepaymentmtc'));
				}
				else{
					$data['error_msg'] = 'ID does not exist';
					redirect(base_url('index.php/UserAction/addpayment/'.$data['id_client']));
				}
			}

    	}

    	public function checkEmail(){
    		$data = array();
			$data['js'] = $this->load->view('include/script.php', NULL, TRUE);
	        $data['css'] = $this->load->view('include/style.php', NULL, TRUE);


	        $data['max'] = $this->DataModel->getMaxPayment();
	        $data['payments'] = $this->DataModel->getPayments();


	        $max = implode("", $data['max'][0]);

	        $date = date('Y/m/d');

	        //$date = date('j', strtotime($test));

	        //$day = (int)$date;

	        $interval = date_diff(date_create($max), date_create($date));
	        //var_dump($interval);

	        $intervalAmount= $interval->format('%R%a');
	        
	        $emailData = $this->DataModel->getClientEmail($max);
	       	$nameData = $this->DataModel->getClientName($max);
	       	$amountData = $this->DataModel->getPaymentAmount($max);
	       	$emailAddress= implode("", $emailData[0]);
	       	$clientName = implode("", $nameData[0]);
	       	$paymentAmount = implode("", $amountData[0]);

	        if($intervalAmount >= -15 && $intervalAmount <= 0){
	        	

	        	//echo $emailAddress;

	        	$subject = "Invoice";

	        	$message = "
	        		<html>
	        			<head>
	        				<title>INVOICE</title>
	        			</head>
	        			<body>
	        				<p>Jakarta ".date('d M Y')."</p>
	        				<br>
	        				<p>Kepada Yth: </p>
	        				".$clientName."
	        				<br>Di tempat <br>
	        				<br>
	        				<table>
								<tr>
									<th>No</th>
									<th>Keterangan</th>
									<th>Nominal></th>
								</tr>
								<tr>
									<td>1</td>
									<td>Monthly maintenance fee</td>
									<td>".$paymentAmount." </td>
								</tr>
								<tr>
									<td colspan='2'> TOTAL </td>
									<td>".$paymentAmount." </td>
								</tr>
							</table>
							<br>
							<p>Hormat Kami,</p>

							<p>WASNITI</p>
							<p>Direktur</p>


							<p>Pembayaran dapat ditransfer ke rekening: </p>
							<p>BANK : BCA</p>
							<p>A/C	: 701-506-5958</p>
							<p>A/N	: SMARTINDO TECHNOLOGY, PT</p>

						</body>
					</html>";

					$headers = "MIME-Version: 1.0" . "\r\n";
					$headers = "Content-type:text/html;charset=UTF-8" . "\r\n";

	        	mail($emailAddress, $subject, $message, $headers);

	        	/*$config = array(
	        			'protocol' => 'smtp',
	        			'smtp_host' => 'ssl://smtp.googlemail.com',
	        			'smtp_port' => 465,
	        			'smtp_user' => 'kennethfi$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	        			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";',
	        			'mailtype' => 'html',
	        			'charset' => 'iso-8859-1',
	        			'wordwrap' => TRUE
	        		);
	        	$this->load->library('email', $config);
	        	
	        	$this->email->from('kennethfilbert343@gmail.com', 'Smartindo');
	        	$this->email->to($emailText);
	        	//$this->email->cc('another@example.com');
	        	//$this->email->bcc('and@another.com');
	        	
	        	$this->email->subject('Test Email');
	        	$this->email->message('Hahaahahahhahahaha');
	        	
	        	$this->email->send();
	        	
	        	echo $this->email->print_debugger();*/



	        }
	        	
	        elseif ($intervalAmount > 0) {
	         	$subject = "Invoice";

	        	$message = "
	        		<html>
	        			<head>
	        				<title>Surat Keterlambatan Pembayaran</title>
	        			</head>
	        			<body>
	        				<p>Jakarta ".date('d M Y')."</p>
	        				<br>
	        				<p>Kepada Yth: </p>
	        				".$clientName."<br>
	        				Di tempat <br>

	        				<p> Dengan surat ini kami ingin mengingatkan bahwa pembayaran anda, yakni: </p>

	        				<table>
								<tr>
									<th>No</th>
									<th>Keterangan</th>
									<th>Nominal></th>
								</tr>
								<tr>
									<td>1</td>
									<td>Monthly maintenance fee</td>
									<td>".$paymentAmount." </td>
								</tr>
								<tr>
									<td colspan='2'> TOTAL </td>
									<td>".$paymentAmount." </td>
								</tr>
							</table>

	        				<p> telah jatuh tempo pada hari ini. Mohon segera selesaikan pembayaran. </p>

							<br>
							<p>Hormat Kami,</p>

							<p>WASNITI</p>
							<p>Direktur</p>


							<p>Pembayaran dapat ditransfer ke rekening: </p>
							<p>BANK : BCA</p>
							<p>A/C	: 701-506-5958</p>
							<p>A/N	: SMARTINDO TECHNOLOGY, PT</p>

						</body>
					</html>";

					$headers = "MIME-Version: 1.0" . "\r\n";
					$headers = "Content-type:text/html;charset=UTF-8" . "\r\n";

	        	mail($emailAddress, $subject, $message, $headers);
	         } 


        	$this->load->view('managepaymentmtc', $data);
    	}


    	public function deleteAdmin($id){
    		$this->UserModel->deleteAdmin($id);
    		redirect(base_url('index.php/UserAction/manageadmin'));
    	}

    	public function deleteClient($id){
    		$this->UserModel->deleteClient($id);
    		redirect(base_url('index.php/UserAction/manageclient'));
    	}

    	public function deletePayment($id){
    		$this->UserModel->deletePayment($id);
    		redirect(base_url('index.php/UserAction/managepaymentmtc'));
    	}

	}

?>
