<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Ltd_company extends CI_Controller {
  	public function __construct()
	{	parent::__construct();
		$this->load->model('company_model');
		$this->load->model('search');
		$this->load->library('session');
		$this->load->helper('form');
  	}
	
/* 	public function countComplist(){
		$company_details = $this->company_model->pendingCompanyList($user_session['id']);
		foreach($company_details as $company_detail){
			
		}
	} */
 	public function index(){
		if($this->session->userdata('logged_in')){
			$user_session = $this->session->userdata('logged_in');
			$data['user_session']=$user_session;
			$data['company_id'] = $this->session->userdata('company_id');
			//var_dump($data['company_id']);die;
			$companyList = $this->company_model->companyList($user_session['id']);
			$company_details = $this->company_model->pendingCompanyList($user_session['id']); 
			$count=0;
			foreach($company_details as $company_det){
				if($company_det->state_id != 6)	{
					$count=1;
				}
			}
			$company_list_make = $this->company_model->pendingCompanyList1($user_session['id']); 
			$company_detail  = $this->company_model->companyById();
			$data['tab_status'] = $this->session->userdata('tab_status');	
			$data['counts'] = 	$count;
			$data['order_status'] = $this->session->userdata('order_status');				
			$data['companyList']=$companyList;
			$data['session_data']=$data['user_session'];
			$data['company_details']=$company_details;
			$data['company_list_make']=$company_list_make;
			$data['company_detail']=$company_detail;
			$this->load->view('ltd_company',$data);
		}else{
			$this->load->view('login');
		}
	}

	/*public function Brochure(){
		echo "Brochure";
	 	$array["username"] = trim($this->input->post('username'));
		$array["useremail"] = trim($this->input->post('useremail'));
		$to = $array["useremail"]; 
		$header = 'From: The London Office<contact@thelondonoffice.com>' . "\r\n" .
					'Bcc: Admin Copy<admincopy@thelondonoffice.com>,<contact@thelondonoffice.com>' . "\r\n";
		$header .= 'MIME-Version: 1.0'."\r\n";
		$header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$subject = "The London Office > Brochure Request";
		$msg =	"<p style='font-size: 12pt; font-family: Calibri; margin: 6px 0px;'>Hello ".$array["username"]."</p>";
		$msg .= "<p style='font-size: 12pt; font-family: Calibri; margin: 6px 0px;'>Thank you for your interest in The London Office.</p>";
		$msg .= "<p style='font-size: 12pt; font-family: Calibri; margin: 6px 0px;'>Please use the links below to download our brochure and service information sheets."."</p>";
		$msg .= "<p style='font-size: 12pt; font-family: Calibri; margin: 6px 0px;'><li type='square'><a href='https://thelondonoffice.com/admin/uploads/pdf/BROCHURE_ABOUT_LOW_RES.PDF'>About The London Office</a></li>"."</p>";
		$msg .= "<p style='font-size: 12pt; font-family: Calibri; margin: 6px 0px;'><li type='square'><a href='https://thelondonoffice.com/admin/uploads/pdf/BROCHURE_REGISTERED_LOW_RES.PDF'>Registered Office Address</a></li>"."</p>";
		$msg .= "<p style='font-size: 12pt; font-family: Calibri; margin: 6px 0px;'><li type='square'><a href='https://thelondonoffice.com/admin/uploads/pdf/BROCHURE_DIRECTOR_LOW_RES.PDF'>Director Service Address</a></li>"."</p>";
		$msg .= "<p style='font-size: 12pt; font-family: Calibri; margin: 6px 0px;'><li type='square'><a href='https://thelondonoffice.com/admin/uploads/pdf/BROCHURE_BUSINESS_LOW_RES.PDF'>Virtual Business Address</a></li>"."</p>";
		$msg .= "<p style='font-size: 12pt; font-family: Calibri; margin: 6px 0px;'><li type='square'><a href='https://thelondonoffice.com/admin/uploads/pdf/BROCHURE_TELEPHONE_LOW_RES.PDF'>Telephone Answering Service</a></li>"."</p>";
		$msg .= "<p style='font-size: 12pt; font-family: Calibri; margin: 6px 0px;'>Should you need any further information or would like to discuss our service please do not hesitate to call our sales team on 020 7183 3787."."</p>";
		$msg .= "<p style='font-size: 12pt; font-family: Calibri; margin: 6px 0px;'>Best regards,"."</p>";
		$msg .= "<p style='font-size: 12pt; font-family: Calibri; margin: 6px 0px;'>The London Office"."</p>";
		$msg .= "<p style='font-size: 12pt; font-family: Calibri; margin: 6px 0px;'>85 Great Portland Street"."</p>";
		$msg .= "<p style='font-size: 12pt; font-family: Calibri; margin: 6px 0px;'>First Floor"."</p>";
		$msg .= "<p style='font-size: 12pt; font-family: Calibri; margin: 6px 0px;'>London"."</p>";
		$msg .= "<p style='font-size: 12pt; font-family: Calibri; margin: 6px 0px;'>W1W 7LT"."</p>";
		
		$msg .= "<p style='font-size: 12pt; font-family: Calibri; margin: 6px 0px;'>Tel: +44 (0)207 183 3787 "."</p>";
		$msg .= "<p style='font-size: 12pt; font-family: Calibri; margin: 6px 0px;'>Email: mail@thelondonoffice.com"."</p>";
		$msg .= "<p style='font-size: 12pt; font-family: Calibri; margin: 6px 0px;'>Web: thelondonoffice.com"."</p>";
		$msg .= "<p style='font-size: 12pt; font-family: Calibri; margin: 6px 0px;'>Skype: theoffice.support"."</p>";
		
		$msg .= "<p style='font-size: 12pt; font-family: Calibri; margin: 6px 0px;'>Disclaimer"."</p>";
		$msg .= "<p style='font-size: 12pt; font-family: Calibri; margin: 6px 0px;'>E-mails and any attachments from The London Office are confidential."."</p>";
		$msg .= "<p style='font-size: 12pt; font-family: Calibri; margin: 6px 0px;'>If you are not the intended recipient, please notify the sender immediately by replying to the e-mail, and then delete it without making copies or using it in any way."."<br><br>";
		$msg .= "Although any attachments to the message will have been checked for viruses before transmission, you are urged to carry out your own virus check before opening "."</p>";
		$msg .= "<p style='font-size: 12pt; font-family: Calibri; margin: 6px 0px;'>attachments, since The Registered Office  accepts no responsibility for loss or damage caused by software viruses.</p>";
		if(mail($to,$subject,$msg,$header))
			redirect('index','refresh' );
		else 
			echo "error";
	} */
	
	public function director_show(){
		$table_name = $_POST["director_show"]['table'];
		$record_id = $_POST["director_show"]['record_id'];
		$this->db->select ( '*' );
		$this->db->from ( $table_name);
		$this->db->where('id', $record_id);
		$query_order = $this->db->get ();
		$order = $query_order->row();
		echo json_encode($order);
	}
	
public function sec_corp_show(){
		$table_name = $_POST["director_show"]['table'];
		$record_id = $_POST["director_show"]['record_id'];
		$this->db->select ( '*' );
		$this->db->from ( $table_name);
		$this->db->where('id', $record_id);
		$query_order = $this->db->get ();
		$order = $query_order->row();
		echo json_encode($order);
	}
	
public function psc_corp_show(){
		$table_name = $_POST["director_show"]['table'];
		$record_id = $_POST["director_show"]['record_id'];
		$this->db->select ( '*' );
		$this->db->from ( $table_name);
		$this->db->where('id', $record_id);
		$query_order = $this->db->get ();
		$order = $query_order->row();
		echo json_encode($order);
	}
	
	
 public function director_corp_show(){
		$table_name = $_POST["director_show"]['table'];
		$record_id = $_POST["director_show"]['record_id'];
		$this->db->select ( '*' );
		$this->db->from ( $table_name);
		$this->db->where('id', $record_id);
		$query_order = $this->db->get ();
		$order = $query_order->row();
		echo json_encode($order);
	}
	/*update the information as per the */
	public function updateOrderInfo(){
		$details_array = array(
			'id' => trim($this->input->get_post('user_id')),
			'first_name' => trim($this->input->get_post('user_name')),
			'last_name' => trim($this->input->get_post('user_last_name')),
			'email' => trim($this->input->get_post('user_email')),
			'ph_no' => trim($this->input->get_post('user_daytime_contact')),
			'mobile' => trim($this->input->get_post('user_contact')),
		);
		$malling_array = array(
			'id' => trim($this->input->get_post('mailing_id')),
			'street' => trim($this->input->get_post('delivery_street')),
			'city' => trim($this->input->get_post('delivery_city')),
			'country' => trim($this->input->get_post('delivery_state')),
			'postcode' => trim($this->input->get_post('delivery_zip')),
			'county' => trim($this->input->get_post('delivery_country')),
		);
		$billing_array = array(
			'id' => trim($this->input->get_post('billing_id')),
			'billing_name' => trim($this->input->get_post('billing_name')),
			'street' => trim($this->input->get_post('billing_street')),
			'city' => trim($this->input->get_post('billing_city')),
			'country' => trim($this->input->get_post('billing_country_code')),
			'postcode' => trim($this->input->get_post('billing_zip')),
			'county' => trim($this->input->get_post('billing_country')),
			
		);
		$company_array = array(
				'id' => trim($this->input->get_post('comp_id')),
				'company_name' => trim($this->input->get_post('company_name')),
				'trading' => trim($this->input->get_post('trading_name')),
				'director1' => trim($this->input->get_post('director_name1')),
				'dir1_last_name' => trim($this->input->get_post('director_last1')),
				'director2' => trim($this->input->get_post('director_name2')),
				'dir2_last_name' => trim($this->input->get_post('director_last2')),
				'director3' => trim($this->input->get_post('director_name3')),
				'dir3_last_name' => trim($this->input->get_post('director_last3')),
				'director4' => trim($this->input->get_post('director_name4')),
				'dir4_last_name' => trim($this->input->get_post('director_last4')),
		); 
		$update_user = $this->company_model->updateUser($details_array);
		$updateMallingAddress = $this->company_model->updateMallingAddress($malling_array);  
		$updateBillingAddress = $this->company_model->updateBillingAddress($billing_array);  
		$updateCompanyAddress = $this->company_model->updateCompanyAddress($company_array);
		if($update_user || $updateMallingAddress || $updateBillingAddress || $updateCompanyAddress){
			$to = "jasdeep.tuffgeekers@gmail.com";
			$header = 'From: The London Office<noreply@thelondonoffice.com>' . "\r\n";
			$header .= 'MIME-Version: 1.0' . "\r\n";
			$header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$subject = "Updated order info";
			$message ="updated";
			if(mail($to, $subject, $message,$header))
				redirect(base_url('/ltd_company'),'refresh');
			else 
				echo "false";
		}else{
			echo "error updating order info";
		}
		redirect(base_url('/ltd_company'),'refresh'); 
	}
	public function company_sic(){
		$session_data = $this->session->userdata ( 'logged_in' );
		$user_id = $session_data['id'];
		$company_id = $this->session->userdata('company_id');
		$sic = $_POST['sic'];
		$sic1 = $_POST['sic1'];
		$sic2 = $_POST['sic2'];
		$sic3 = $_POST['sic3'];
		
	    $create_time = date ( 'Y-m-d h:i:s' );
		$company_details = $this->company_model->pendingCompanyList($user_id);
		$comp_exist = $this->company_model->getCompanySIC();
		
		if($comp_exist){
			foreach($company_details as $company_detail){
				$data = array(
					'sic_code'=>$sic,
					'sic_code1'=>$sic1,
					'sic_code2'=>$sic2,
					'sic_code3'=>$sic3,
					'company_id'=>$company_id,
					'update_user_id'=>$user_id,
					'update_time'=>$create_time
					
					);
				$upDateSic = $this->company_model->upDateSic($data);
				//var_dump($upDateSic);die("if");
			}
		}else{
			foreach($company_details as $company_detail){
				$data = array(
					'sic_code'=>$sic,
					'sic_code1'=>$sic1,
					'sic_code2'=>$sic2,
					'sic_code3'=>$sic3,
					'company_id'=>$company_id,
					'create_user_id'=>$user_id,
					'create_time'=>$create_time
					);
				$this->db->insert('tbl_sic_code', $data);
			}
		}
		redirect(base_url('/ltd_company'),'refresh');
	}
	
	public function my_details_your_details(){
		$session_data = $this->session->userdata ( 'logged_in' );
		$array = array(
			'id' => trim($this->input->post('user_id')),
			'first_name' => trim($this->input->post('user_name')),
			'last_name' => trim($this->input->post('user_last_name')),
			'email' => trim($this->input->post('user_email')),
			'ph_no' => trim($this->input->post('user_daytime_contact')),
			'mobile' => trim($this->input->post('user_contact')),
		);
		$user_id =$this->input->post('user_id');
		$updateuser_data = $this->company_model->getuserdata($user_id);
		$updatedUser = $this->company_model->getUserUpdateData($user_id,$array);
		
		//var_dump($updateuser_data,$updatedUser);die;
			$to = "officemanager@thelondonoffice.com";
			$header = 'From: The London Office<noreply@thelondonoffice.com>' . "\r\n";
			$header .= 'MIME-Version: 1.0' . "\r\n";
			$header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			
			$subject ="Update > ".$updateuser_data['email'];
				//$new_msg ="Company name: ".$_POST ["user_company"]."<br>";
				$message ="Time of update: ".date ( "h:i:s")."<br>";
				$message .="Date of update:".date ( "Y-m-d")."<br>";
				$message .="What was updated:"."<br>";
		
		 foreach($updatedUser as $updatedMail)
			 {
			  $message .= $updatedMail."<br>";
			 
			 }
			if(mail($to, $subject, $message,$header))
			{
				$updateUser = $this->company_model->updateUser($array);
				if($updateUser){
					redirect(base_url('/ltd_company'),'refresh');
					}
			}
		
	}

	public function my_details_billing_address(){
		$session_data = $this->session->userdata ( 'logged_in' );
		$user_id = $session_data['id'];
		$updateduser = $this->company_model->getuserdata($user_id);
		$array = array(
			//'id' => trim($this->input->post('billing_id')),
			'billing_name' => trim($this->input->post('billing_name')),
			'street' => trim($this->input->post('billing_street')),
			'city' => trim($this->input->post('billing_city')),
			'country' => trim($this->input->post('billing_country_code')),
			'postcode' => trim($this->input->post('billing_zip')),
			'county' => trim($this->input->post('add_country')),
			'create_user_id' => $session_data['id'],
			
		);
		
		$billing_id = $this->input->post('billing_id');
		$updatedMails = $this->company_model->getbilling($billing_id,$array);
		
			$to = "officemanager@thelondonoffice.com";
			$header = 'From: The London Office<noreply@thelondonoffice.com>' . "\r\n";
			$header .= 'MIME-Version: 1.0' . "\r\n";
			$header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			
			$subject ="Update > ".$updateduser['email'];
				//$new_msg ="Company name: ".$_POST ["user_company"]."<br>";
				$message ="Time of update: ".date ( "h:i:s")."<br>";
				$message .="Date of update:".date ( "Y-m-d")."<br>";
				$message .="What was updated:"."<br>";
			 foreach($updatedMails as $updatedMail)
			 {
			  $message .= $updatedMail."<br>";
			 
			 }
			if(mail($to, $subject, $message,$header))
			{
				$updateUser = $this->company_model->updateBillingAddress($array);
				if($updateUser){
					redirect(base_url('/ltd_company'),'refresh');
					}
			}
		
		
		
	}
   public function my_details_mail_address(){
		$session_data = $this->session->userdata ( 'logged_in' );
		//$company_id = $this->session->userdata('company_id');
		$user_id = $session_data['id'];
		$updateduser = $this->company_model->getuserdata($user_id);
		
		$array = array(
			//'id' => trim($this->input->post('mailing_id')),
			'street' => trim($this->input->post('delivery_street')),
			'city' => trim($this->input->post('delivery_city')),
			'country' => trim($this->input->post('delivery_state')),
			'postcode' => trim($this->input->post('delivery_zip')),
			'county' => trim($this->input->post('add_company_location_popup')),
			'create_user_id' => $session_data['id'],
		);
		$mailing_id = $this->input->post('mailing_id');
		$updatedMails = $this->company_model->getMailling($mailing_id,$array);
		
			$to = "officemanager@thelondonoffice.com";
			$header = 'From: The London Office<noreply@thelondonoffice.com>' . "\r\n";
			$header .= 'MIME-Version: 1.0' . "\r\n";
			$header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			
			$subject ="Update > ".$updateduser['email'];
				//$new_msg ="Company name: ".$_POST ["user_company"]."<br>";
				$message ="Time of update: ".date ( "h:i:s")."<br>";
				$message .="Date of update:".date ( "Y-m-d")."<br>";
				$message .="What was updated:"."<br>";
			 foreach($updatedMails as $updatedMail)
			 {
			  $message .= $updatedMail."<br>";
			 
			 }
			if(mail($to, $subject, $message,$header))
			{
				$updateUser = $this->company_model->updateMallingAddress($array);
				if($updateUser){
					redirect(base_url('/ltd_company'),'refresh');
					}
			}
	}
	
	
   public function addAltEmail() { 
   	$session_data = $this->session->userdata ( 'logged_in' );
	$company_id = $this->session->userdata('company_id');
	$user_id = $session_data['id'];
	$create_time = date ( 'Y-m-d h:i:s' );
	$alt_email = trim($this->input->post('alternate_email'));

	
	$this->db->select ( '*' );
	$this->db->from ( 'tbl_user');
	$search_string = "(tbl_user.email LIKE '".$alt_email."')";
	$this->db->where ( $search_string );
	$query_email = $this->db->get ();
	$emails = $query_email->row();
	if(!$emails){
	$this->db->select ( '*' );
		$this->db->from ( 'tbl_alt_email');
		$this->db->where('create_user_id', $user_id);
		$query_order = $this->db->get ();
		$emails = $query_order->row();
	
		if($emails){
	
		
			if(empty($emails->email_2 ) || $emails->email_2 == '')
			{
		
				$data_email = array(
					'email_2' => trim($this->input->post('alternate_email')),
				);
			
				$this->db->where ( 'create_user_id', $user_id);
				$this->db->update ( 'tbl_alt_email', $data_email );
				
			}
			elseif(empty($emails->email_3 ) || $emails->email_3 == '' )
			{
			
				$data_email = array(
					'email_3' => trim($this->input->post('alternate_email')),
				);
				$this->db->where ( 'create_user_id', $user_id);
				$this->db->update ( 'tbl_alt_email', $data_email );
			}
			elseif(empty($emails->email_4 ) || $emails->email_4 == '' )
			{
		
				$data_email = array(
					'email_4' => trim($this->input->post('alternate_email')),
				);
				$this->db->where ( 'create_user_id', $user_id);
				$this->db->update ( 'tbl_alt_email', $data_email );
			}
			
			
	}else{
	
		$data_email = array(
					'company_id'=>$company_id,
					'create_user_id'=>$user_id ,
					'email_2' => trim($this->input->post('alternate_email')),
					'create_time'=>$create_time
				);
	
		$this->db->insert('tbl_alt_email', $data_email);
	}
	}else{
		echo "Email already exist";
	}
		redirect(base_url('/ltd_company'),'refresh');
	}
	
	public function alterEmail(){
		$session_data = $this->session->userdata ( 'logged_in' );
		$array['email']= $this->input->post('email');
		$array['number']= $this->input->post('number');
		$array['company_id']= $this->input->post('company_id');
		$array['create_user_id']= $session_data['id'];
		$getuserdata = $this->company_model->getuserdata($session_data['id']);
		//var_dump($getuserdata);die('da'); 
		$array['email_primary']= $getuserdata['email'];
		//var_dump($array);die('sas');
		$make_primary = $array['email'];
		
		$arr = array(
			'id' => $session_data['id'],
			'email' => $make_primary,
		);
		$updateUser = $this->company_model->updateUser($arr);
		//$getAltEmail = $this->company_model->getAltEmail();
		if($updateUser){
			$updateEmail = $this->company_model->updateEmail($array);
			if($updateUser){
				echo "1";
			}else{
				echo "error";
			}
			
		}else{
			echo "error";
		}
	}
	
	public function updatePassword(){
		$array = array(
			'id'=> $this->input->post('id'),
			'password'=> md5($this->input->post('password')),
		);
		$updateUser = $this->company_model->updateUser($array);
		if($updateUser){
			echo "1";
		}else{
			echo "0";
		}
	}
	
	public function mail_formation_preference(){
		$session_data = $this->session->userdata ( 'logged_in' );
		$array = array(
			'officail_mail_option1' => $this->input->post('officail_mail_option1'),
			'officail_mail_option2' => $this->input->post('officail_mail_option2'),
			'business_mail_option1' => $this->input->post('business_mail_option1'),
			'business_mail_option2' => $this->input->post('business_mail_option2'),
			'create_user_id' => $session_data['id'],
		);
		
		$selectMailPreferences = $this->company_model->selectMailPreferences($array);
		//var_dump($selectMailPreferences);die("Gfd");
		if($selectMailPreferences == 0){
			$insertMailPreferences = $this->company_model->insertMailPreferences($array);
			if($insertMailPreferences){
				echo "1";
			}else{
				echo "0";
			}
		}else{
			$updateMailPreferences = $this->company_model->updateMailPreferences($array);
			if($updateMailPreferences){
				echo "1";
			}else{
				echo "0";
			}
		}
		
		/* if($updateMailPreferences){
			echo "1";
		}else{
			echo "0";
		} */
	}
	
	public function call_handling_preference(){
		$session_data = $this->session->userdata ( 'logged_in' );
		$array = array(
			'call_handling_option1' => $this->input->post('call_handling_option1'),
			'call_handling_option2' => $this->input->post('call_handling_option2'),
			'create_user_id' => $session_data['id'],
		);
		$selectMailPreferences = $this->company_model->selectMailPreferences($array);
		
		if($selectMailPreferences == 0){
			$insertMailPreferences = $this->company_model->insertMailPreferences($array);
			if($insertMailPreferences){
				echo "1";
			}else{
				echo "0";
			}
		}else{
			$updateMailPreferences = $this->company_model->updateMailPreferences($array);
			if($updateMailPreferences){
				echo "1";
			}else{
				echo "0";
			}
		}
		
	}
	
	public function hot_desk(){
		$array = array(
			"book_company_name"=> $this->input->post('book_company_name'),
			"date_book"=> $this->input->post('date_book'),
			"book_office"=> $this->input->post('book_office'),
			"book_time"=> $this->input->post('book_time'),
			"book_meeting_desk"=> $this->input->post('book_meeting_desk'),
			"book_personal_assistance"=> $this->input->post('book_personal_assistance'),
		);
		//var_dump($array);
		
		$to = 'jasdeep.tuffgeekers@gmail.com,officemanager@thelondonoffice.com';		
		$header = 'From:The London Office<mail@thelondonoffice.com>' . "\r\n";
		$header .= 'MIME-Version: 1.0'."\r\n";
		$header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$subject = "Office manager >". $array["book_company_name"];
		
		$new_msg = 'Company Name : '. $array["book_company_name"]."<br><br>";
		$new_msg .= 'Booking Date : '. $array["date_book"]."<br><br>";
		$new_msg .= 'Office : '. $array["book_office"]."<br><br>";
		$new_msg .= 'Time : '. $array["book_time"]."<br><br>";
		$new_msg .= 'Desk : '. $array["book_meeting_desk"]."<br><br>";
		$new_msg .= 'Personal Assistance : '. $array["book_personal_assistance"]."<br><br>";
		if (mail ($to,$subject,$new_msg,$header )) {
			echo "1";
		}else {
			echo "0";
		}
	}
	
	public function remove_email(){
		$session_data = $this->session->userdata('logged_in');
		$arr["email"] = $this->input->post("email");
		$arr["field"] = $this->input->post("field");
		$arr["id"] = $this->input->post("id");
		$arr["create_user_id"] = $session_data["id"];
		if($arr["field"] == "email_2")
			$arr["email_2"] = "";
		else if($arr["field"] == "email_3")
			$arr["email_3"] = "";
		else if($arr["field"] == "email_4")
			$arr["email_4"] = "";
		$remove_email = $this->company_model->remove_email($arr);
		if($remove_email){
			echo "1";
		}else{
			echo "0";
		}
	}
	////update company_number in comoany table
	public function add_company_number(){
	$arr['id'] = $this->session->userdata('company_id');
	$arr['company_number'] = $this->input->post("company_number");
	$updateCompanyAddress = $this->company_model->updateCompanyAddress($arr);
	if($updateCompanyAddress)
	{
		$arr1['company_id'] = $this->session->userdata('company_id');
        $arr1['company_number'] = $this->input->post("company_number");
	    $inserdata = $this->company_model->company_data($arr1);
	 //var_dump($inserdata);die();
	 $res = array('Status'=>'1','message'=>'Profile Updated successfully');
	}
	else
	{
	 $res = array('Status'=>'0','message'=>'Database error');
	}
	echo json_encode($res);
}  

	public function update_company_number_data(){
	$arr['company_id'] = $this->session->userdata('company_id');
	$get_data = $this->company_model->Get_company_data($arr['company_id']);
	$company_number = $get_data['company_number'];
	//var_dump($company_number);die();
	//echo 'http://data.companieshouse.gov.uk/doc/company/'.$company_number.'.json';
	//die();
	 $qr = file_get_contents('http://data.companieshouse.gov.uk/doc/company/'.$company_number.'.json');
	 $data = json_decode($qr);
	$primaryTopic= $data->primaryTopic; 
	$primaryTopic= $primaryTopic->IncorporationDate;
	$newDate = date("Y-m-d", strtotime($primaryTopic));
     $arr['incorporation_date']= $newDate;
	$update_data = $this->company_model->update_company_data($arr);
	//var_dump($update_data);die();
	if($update_data)
	{
	 $res = array('Status'=>'1','message'=>'Profile Updated successfully');
	} 
	else 
	{
	 $res = array('Status'=>'0','message'=>'error');
	}
	echo json_encode($res);
} 
}

