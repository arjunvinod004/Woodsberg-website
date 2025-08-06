<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	
	public function __construct()
	{
		parent::__construct();
		require('Common.php');
		$this->load->model('admin/Productmodel');
		$this->load->model('admin/Storemodel');
		$this->load->model('Homemodel');
		if (!$this->session->userdata('login_status')) {
			redirect(login);
		}
	}
	public function index()
	{
		$controller = $this->router->fetch_class(); // Gets the current controller name
		$method = $this->router->fetch_method();   // Gets the current method name
		$data['controller'] = $controller;
		$data['store_id'] = $this->session->userdata('logged_in_store_id');
		$role_id = $this->session->userdata('roleid'); // Role id of logged in user
		$user_id = $this->session->userdata('loginid'); // Loged in user id
		$logged_in_store_id = $this->session->userdata('logged_in_store_id'); //echo $logged_in_store_id;exit;
		$store_details = $this->Commonmodel->get_admin_details_by_store_id($user_id);
		$data['Name'] = $store_details->Name;
		// print_r($data['Name']);exit;
		// $data['userAddress'] = $store_details->userAddress;
		$data['support_no'] = $store_details->UserPhoneNumber;
		$data['support_email'] = $store_details->userEmail;
		// $data['profileimg'] = $store_details->profileimg;
		$this->load->view('admin/includes/header',$data);
		$this->load->view('admin/includes/owner-dashboard',$data);
		$this->load->view('admin/catalog/reports',$data);
		$this->load->view('admin/includes/footer');
		// $this->load->model('website/Homemodel');
	
		// if($role_id == 1 || $role_id == 2) { //Admin and Shop owner

		// }
		
	}

	public function getRetailReport(){
	$date= $this->input->post('date');
	$name= $this->input->post('name');
	$phone= $this->input->post('phone');

	$rt = $this->Homemodel->getRetailReport($date, 'rt', $name, $phone);
    $ws = $this->Homemodel->getRetailReport($date, 'ws', $name, $phone);
    $bb = $this->Homemodel->getRetailReport($date, 'bb', $name, $phone);
	$exp=$this->Homemodel->getRetailReport($date, 'exp', $name, $phone);
  $data = array('rt' => $rt , 'ws' => $ws , 'bb' => $bb, 'exp' => $exp);
  $formattedDate = date('d-m-Y', strtotime($date));
    $html = '<tr>';
    $html .= '<td>' . $formattedDate . '</td>';
    $html .= '<td>₹ ' . $data['rt'] . '</td>';
    $html .= '<td>₹ ' .$data['ws'] . '</td>';
    $html .= '<td>₹ ' . $data['bb'] . '</td>';
	$html .= '<td>₹ ' . $data['exp'] . '</td>';
    $html .= '</tr>';
	echo json_encode(['success' => 'success',  'html' => $html]);
	//  print_r($html);

	// echo json_encode($data);
	}


// 	public function getRetailReportname(){
// 	$date= $this->input->post('date');
// 	$name= $this->input->post('name');
// 	$rt = $this->Homemodel->getRetailReportname($name, 'rt', $date);
//     $ws = $this->Homemodel->getRetailReportname($name, 'ws', $date);
//     $bb = $this->Homemodel->getRetailReportname($name, 'bb', $date);
//   $data = array('rt' => $rt , 'ws' => $ws , 'bb' => $bb );
//  $formattedDate = date('d-m-Y', strtotime($date));
//     $html = '<tr>';
//     $html .= '<td>' . $formattedDate . '</td>';
//     $html .= '<td>₹ ' . $data['rt'] . '</td>';
//     $html .= '<td>₹ ' .$data['ws'] . '</td>';
//     $html .= '<td>₹ ' . $data['bb'] . '</td>';
//     $html .= '</tr>';
// 	echo json_encode(['success' => 'success',  'html' => $html]);
// 	//  print_r($html);

// 	// echo json_encode($data);
// 	}

// 		public function getRetailReportphone(){
// 	$date= $this->input->post('date');
// 	$name= $this->input->post('name');
// 	$phone= $this->input->post('phone');
// 	$rt = $this->Homemodel->getRetailReportphone($name, 'rt', $date, $phone);
//     $ws = $this->Homemodel->getRetailReportphone($name, 'ws', $date, $phone);
//     $bb = $this->Homemodel->getRetailReportphone($name, 'bb', $date, $phone);
//   $data = array('rt' => $rt , 'ws' => $ws , 'bb' => $bb );
//  $formattedDate = date('d-m-Y', strtotime($date));
//     $html = '<tr>';
//     $html .= '<td>' . $formattedDate . '</td>';
//     $html .= '<td>₹ ' . $data['rt'] . '</td>';
//     $html .= '<td>₹ ' .$data['ws'] . '</td>';
//     $html .= '<td>₹ ' . $data['bb'] . '</td>';
//     $html .= '</tr>';
// 	echo json_encode(['success' => 'success',  'html' => $html]);
// 	//  print_r($html);

// 	// echo json_encode($data);
// 	}

}