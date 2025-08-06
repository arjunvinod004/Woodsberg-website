<?php class Order extends CI_Controller {
public function __construct() 
{   
    parent::__construct();
    $this->load->model('admin/Productmodel');
    $this->load->model('admin/Storemodel');
    $this->load->model('Homemodel');
}

public function index()
{
$this->load->helper('cookie'); // ✅ Load cookie helper
$token = $this->input->cookie('guest_token');
$controller = $this->router->fetch_class(); // Gets the current controller name
$method = $this->router->fetch_method();   // Gets the current method name
$data['controller'] = $controller;
// echo $controller;
$logged_in_store_id = $this->session->userdata('logged_in_store_id'); //echo $logged_in_store_id;exit;
$role_id = $this->session->userdata('roleid'); // Role id of logged in user
$user_id = $this->session->userdata('loginid'); // Loged in user id
$store_details = $this->Commonmodel->get_admin_details_by_store_id($user_id);
$data['shipping']=$this->Productmodel->listshipping();
$data['orders']=$this->Productmodel->listorders();

// print_r($data['orders']);
    //  print_r($store_details);exit;
$data['Name'] = $store_details->Name;
    // print_r($data['Name']);exit;
    // $data['userAddress'] = $store_details->userAddress;
$data['support_no'] = $store_details->UserPhoneNumber;
$data['support_email'] = $store_details->userEmail;
$this->load->view('admin/includes/header',$data);
 $this->load->view('admin/includes/owner-dashboard',$data);
$this->load->view('admin/catalog/orders',$data);
$this->load->view('admin/includes/footer',$data);
}

}
?>