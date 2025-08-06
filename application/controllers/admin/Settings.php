<?php class Settings extends CI_Controller {

public function __construct() 
{   
    parent::__construct();
    $this->load->model('admin/Productmodel');
    $this->load->model('admin/Storemodel');
    $this->load->model('Homemodel');
    $this->load->model('Cartmodel');

}

public function index()
{
    $controller = $this->router->fetch_class(); // Gets the current controller name
    $method = $this->router->fetch_method();   // Gets the current method name
    $data['controller'] = $controller;
    $logged_in_store_id = $this->session->userdata('logged_in_store_id'); //echo $logged_in_store_id;exit;
    $role_id = $this->session->userdata('roleid'); // Role id of logged in user
    $user_id = $this->session->userdata('loginid'); // Loged in user id
    $store_details = $this->Commonmodel->get_admin_details_by_store_id($user_id);
    //  print_r($store_details);exit;
    $data['Name'] = $store_details->Name;
    // print_r($data['Name']);exit;
    // $data['userAddress'] = $store_details->userAddress;
    $data['support_no'] = $store_details->UserPhoneNumber;
    $data['support_email'] = $store_details->userEmail;
    // $data['profileimg'] = $store_details->profileimg;
    $data['todayDate'] = date('m-d-Y');
    $data['todayTime'] = date('H:i:s');

        
        //print_r($store_details);exit;
        $this->db->select('store_opening_time,store_closing_time');
        $this->db->from('store');
        $this->db->where('store_id', $logged_in_store_id);
        $query = $this->db->get();
        $row = $query->row();
        if (!empty($row->today_opening_time) && !empty($row->today_closing_time)) {
            $opening_time = $row->today_opening_time;
            $closing_time = $row->today_closing_time;
        } else {
            $opening_time = $row->store_opening_time;
            $closing_time = $row->store_closing_time;
        }
   
    $data['openingTime'] = $opening_time;
    $data['closingTime'] = $closing_time;
    $this->load->view('admin/includes/header',$data);
    $this->load->view('admin/includes/owner-dashboard',$data);
    $this->load->view('admin/settings',$data);
    $this->load->view('admin/includes/footer',$data);
}



public function coupon(){
    $controller = $this->router->fetch_class(); // Gets the current controller name
	$method = $this->router->fetch_method();   // Gets the current method name
	$data['controller'] = $controller;
	$logged_in_store_id = $this->session->userdata('logged_in_store_id'); //echo $logged_in_store_id;exit;
	$role_id = $this->session->userdata('roleid'); // Role id of logged in user
	$user_id = $this->session->userdata('loginid'); // Loged in user id
    $store_details = $this->Commonmodel->get_admin_details_by_store_id($user_id);
    $data['coupon']=$this->Productmodel->listcoupon();
    $data['Name'] = $store_details->Name;
        // $data['userAddress'] = $store_details->userAddress;
    $data['support_no'] = $store_details->UserPhoneNumber;
    $data['support_email'] = $store_details->userEmail;
    $this->load->view('admin/includes/header',$data);
    $this->load->view('admin/catalog/coupon',$data);
    $this->load->view('admin/includes/footer');
}




public function addcoupon(){
 $this->load->library('form_validation');
 $this->form_validation->set_error_delimiters('', '');  
 $this->form_validation->set_rules('coupon_code', 'code', 'required');
 $this->form_validation->set_rules('coupon_type', 'type', 'required');
 $this->form_validation->set_rules('coupon_value', 'value', 'required');

 if($this->form_validation->run() == FALSE) 
{

    $response = [
	            'success' => false,
				'errors' => [
				'coupon_code' => form_error('coupon_code'),
                'coupon_type' => form_error('coupon_type'),
                'coupon_value' => form_error('coupon_value'),
				]
				];

				echo json_encode($response);
}
else
{
                $data = array(
                    'code' => $this->input->post('coupon_code'),
                    'discount_type' => $this->input->post('coupon_type'),
                    'discount_value' =>$this->input->post('coupon_value'),
                    'status' => 1,
                );
                 
                $this->Productmodel->insert_coupon_translation($data);
                // print_r($data);exit;
                echo json_encode(['success' => 'success']);
}
}

public function deletecoupon()
{
    $id=$this->input->post('id');
    // echo $id; exit;
    $this->Productmodel->DeleteCoupon($id);
    echo json_encode(['success' => 'success']);
}

// apply coupon from website


public function applycoupon() {
    $this->load->helper('cookie'); // ✅ Load cookie helper
    $token = $this->input->cookie('guest_token');
    $this->load->library('form_validation');
    $this->form_validation->set_error_delimiters('', '');  
    $this->form_validation->set_rules('coupons_code', 'Coupon Code', 'required');

    if ($this->form_validation->run() == FALSE)
    {
        echo json_encode([
            'success' => false,
            'errors' => [
            'coupons_code' => form_error('coupons_code'),
            ]
        ]);
    } 
     else 
    {
        $coupon_code = $this->input->post('coupons_code'); 
        $total_price = $this->input->post('total_price');
        // echo $total_price;
        $is_valid = $this->Productmodel->VerifyCoupon($coupon_code,$total_price); 
        // print_r($is_valid);
        // print_r($is_valid);exit;
        if($is_valid)
        {
// echo $discount;
           if ($is_valid['discount_type'] == 'percentage') 
           {
              $discount = ($total_price * $is_valid['discount_value']) / 100; 
            //   echo $discount;    
           } 
           else 
           {
              $discount = $is_valid['discount_value'];
           }

       

            $final_amount = max($total_price - $discount, 0);
            $discount_value = $is_valid['discount_value'];
            $check_coupon_code = $this->db->where('user_token', $token)->get('customers')->row_array();
            $sumofprice=$this->Cartmodel->getsumofprice($token);


    if ($check_coupon_code && $check_coupon_code['coupon_code'] == $discount_value) {
        echo json_encode([
            'success' => false,
            'message' => 'Discount code ' . $coupon_code . ' is already applied.'
        ]);
        return;
    }

    // ✅ Not applied yet, insert into DB
    $datas = [
        'user_token'   => $token,
        // 'name'         => null,
        // 'email'        => null,
        // 'password'     => null,
        // 'phone'        => null,
        // 'address'      => null,
        // 'city'         => null,
        // 'state'        => null,
        // 'postal_code'  => null,
        // 'country'      => null,
        'coupon_code'  => $discount_value, // use the code, not discount_value
        'is_active'    => 0,
        'created_at'   => date('Y-m-d H:i:s'),
        'updated_at'   => date('Y-m-d H:i:s')
    ];

    $this->Productmodel->update_coupon_code($datas, $token);

    echo json_encode([
        'success' => 'success',
        'message' => 'Coupon applied successfully!',
        'discount' => $discount,
        'final_amount' => $final_amount,
        'total_price' => $sumofprice

    ]);
    
    } 
        else
        {
            
            echo json_encode([
                'success' => false,
                'message' => 'Discount code '.$coupon_code.' is not available.'
            ]);
       } 


    }
}

public function slider()
{
    $controller = $this->router->fetch_class(); // Gets the current controller name
    $method = $this->router->fetch_method();   // Gets the current method name
    $data['controller'] = $controller;
    $logged_in_store_id = $this->session->userdata('logged_in_store_id'); //echo $logged_in_store_id;exit;
    $role_id = $this->session->userdata('roleid'); // Role id of logged in user
    $user_id = $this->session->userdata('loginid'); // Loged in user id
     $store_details = $this->Commonmodel->get_admin_details_by_store_id($user_id);
    //  print_r($store_details);exit;
    $data['Name'] = $store_details->Name;
    $data['slider']=$this->Productmodel->listslider();
    // print_r($data['slider']);exit;
    // $data['userAddress'] = $store_details->userAddress;
    $data['support_no'] = $store_details->UserPhoneNumber;
     $data['support_email'] = $store_details->userEmail;
    $this->load->view('admin/includes/header',$data);
    $this->load->view('admin/catalog/slider',$data);
    $this->load->view('admin/includes/footer');
}

public function shipping()
{
    $controller = $this->router->fetch_class(); // Gets the current controller name
    $method = $this->router->fetch_method();   // Gets the current method name
    $data['controller'] = $controller;
    $logged_in_store_id = $this->session->userdata('logged_in_store_id'); //echo $logged_in_store_id;exit;
    $role_id = $this->session->userdata('roleid'); // Role id of logged in user
    $user_id = $this->session->userdata('loginid'); // Loged in user id
     $store_details = $this->Commonmodel->get_admin_details_by_store_id($user_id);
     $data['shipping']=$this->Productmodel->listshipping();
    //  print_r($store_details);exit;
    $data['Name'] = $store_details->Name;
    // print_r($data['Name']);exit;
    // $data['userAddress'] = $store_details->userAddress;
    $data['support_no'] = $store_details->UserPhoneNumber;
     $data['support_email'] = $store_details->userEmail;
    $this->load->view('admin/includes/header',$data);
    $this->load->view('admin/catalog/shipping',$data);
    $this->load->view('admin/includes/footer');  
}
// website state dropdown change update the shipping rate to db
public function update_shipping_rate()
{
    $shipping_id=$this->input->post('id');
    $shipping_rate=$this->input->post('rate');
    echo $shipping_id;
    echo $shipping_rate;
    $this->Productmodel->update_shipping_rate($shipping_id,$shipping_rate);
    echo json_encode(['success' => 'success']);
}

public function editstoreTime()
{
    $store_id = $this->session->userdata('logged_in_store_id');
    $data=array(
    'today_opening_time' => $this->input->post('opening_time'),
    'today_closing_time' => $this->input->post('closing_time'),
    );
    $this->Ordermodel->EditStoreTime($data, $store_id);
    echo json_encode(['success' => 'success']);
        
}

// public function ordershow()
// {

// }

public function vieworders()
{
$order_id=$this->input->post('hidden_order_id');
// print_r($order_id);
$orderdetails=$this->Productmodel->vieworder($order_id);
// print_r($orderdetails);
$html = '';
$total_price = 0;
foreach ($orderdetails as $item) 
{
    $html .= '<tr>';
    // $html .= '<td>' . htmlspecialchars($item['order_id']) . '</td>';
     $html .= '<td><img src="' . base_url('uploads/product/' . $item['image']) . '" alt="Product Image" width="80" height="80"></td>';
    $html .= '<td>' . htmlspecialchars($item['product_name']) . '</td>';
    $html .= '<td>' . htmlspecialchars($item['quantity']) . '</td>';
    $html .= '<td>' . htmlspecialchars($item['price']) . '</td>';
    $html .= '<td>'.htmlspecialchars($item['amount']) . '</td>';
    $html .= '</tr>';
    $total_price = $item['total_price'];
    // $html .= '<button class="btn btn-primary">' . htmlspecialchars($item['total_price']) . '</button>';   
}
echo json_encode(['success' => 'success',  'html' => $html, 'total_price'=> $total_price]);

}

public function addslider()
{
$this->load->library('form_validation');
$this->form_validation->set_error_delimiters('', '');  
if (empty($_FILES['slider_photo']['name'])) 
    {
     $this->form_validation->set_rules('slider_photo', 'Image', 'required');
           
    }
$this->form_validation->set_rules('slider_title', 'Title', 'required');
$this->form_validation->set_rules('slider_subtitle', 'SubTItle', 'required');
if($this->form_validation->run() == FALSE) 
{

    $response = [
	 'success' => false,
	 'errors' => 
    [
	 'slider_title' => form_error('slider_title'),
     'slider_subtitle' => form_error('slider_subtitle'),
     'slider_photo' => form_error('slider_photo'),
	]
	];		
	echo json_encode($response);
}
else
{
$this->load->library('upload');
$this->load->library('image_lib');               
$upload_images = [];            
if (!empty($_FILES['slider_photo']['name'])) 
{
    $config['upload_path']   = './uploads/slider/';
    $config['allowed_types'] = 'jpg|jpeg|png|webp';
    $config['file_name']     = time() . '_1';        
    $this->upload->initialize($config);          
    if ($this->upload->do_upload('slider_photo')) 
{
    $upload_data = $this->upload->data();
     // Resize image
    $resize['image_library']  = 'gd2';
    $resize['source_image']   = $upload_data['full_path'];
    $resize['maintain_ratio'] = TRUE;
    $resize['width']          = 500;
    $resize['height']         = 500;
    $this->image_lib->initialize($resize);
    $this->image_lib->resize();
     $this->image_lib->clear();     
    // After upload loop...
    $category_img = isset($upload_images[1]) ? $upload_images[1] : null;
    $category_img = $upload_data['file_name']; // from upload result
}
} 
else 
{
$upload_images[1] = $this->input->post('imagehidden1'); // fallback if needed
}
                

    $data = array
    (
        'title' => $this->input->post('slider_title'),
        'description' => $this->input->post('slider_subtitle'),
        'image' => $category_img,
    );
            // $this->db->where('', $data['category_name']);
            // $query = $this->db->get('categories');
        
            // if ($query->num_rows() > 0) {
            //     echo json_encode(['success' => false, 'errors' => 'category exists']);
            // } 
            // else{
                $this->Productmodel->insert_slider_translation($data);
                echo json_encode(['success' => 'success']);
            // }
               // print_r($data);exit;
              
        }
}

public function editslider()
{
$slider_id=$this->input->post('id');
$edit_slider=$this->Productmodel->get_slider_by_id($slider_id);   //print_r( $edit_category);exit;

        if (!$edit_slider || !is_array($edit_slider)) 
        {
            echo json_encode([
                'success' => false,
                'message' => 'Invalid enquiry_details data.'
            ]);
            return;
        }
        $result = [
            'title' => $edit_slider['title'],
            'description' => $edit_slider['description'], //If admin store id default 0 
            'image' => $edit_slider['image'],
        ];

        // print_r($result); exit;
        echo json_encode([
            'success' => 'success',
            'data' => $result
        ]);
}

public function updateslider(){
$id=$this->input->post('hidden_slider_id'); 
    // echo $id;exit;
$this->load->library('form_validation'); 
$this->form_validation->set_error_delimiters('', '');    
$this->form_validation->set_rules('slider_title', 'title', 'required');
$this->form_validation->set_rules('slider_subtitle', 'Subtitle', 'required');
if ($this->form_validation->run() == FALSE) 
{
    $response = [
        'success' => false,
        'errors' => [
        'slider_title' => form_error('slider_title'),
        'slider_subtitle' => form_error('slider_subtitle'),
            // 'userfile' => form_error('userfile'),
        ]
    ];
    echo json_encode($response);
}
else
{
    $this->load->library('upload');
    $this->load->library('image_lib');
    
    $upload_images = [];
    
    if (!empty($_FILES['slider_photo']['name'])) {
        $config['upload_path']   = './uploads/slider/';
        $config['allowed_types'] = 'jpg|jpeg|png|webp';
        $config['file_name']     = time() . '_1';
    
        $this->upload->initialize($config);
    
        if ($this->upload->do_upload('slider_photo')) {
            $upload_data = $this->upload->data();
    
            // Resize image
            $resize['image_library']  = 'gd2';
            $resize['source_image']   = $upload_data['full_path'];
            $resize['maintain_ratio'] = TRUE;
            $resize['width']          = 500;
            $resize['height']         = 500;
    
            $this->image_lib->initialize($resize);
            $this->image_lib->resize();
            $this->image_lib->clear();
    
          // After upload loop...
          $slider_image = $upload_data['file_name']; // ✅ Correct string
        }
    } else {
        $slider_image = $this->input->post('existing_slider_photo'); // ✅ Also a string now
    }
    
    $data = array(
        'title' => $this->input->post('slider_title'),
        'description' => $this->input->post('slider_subtitle'),
        'image' => $slider_image,
    );
    $this->Productmodel->update_slider($id, $data);
 

    echo json_encode(['success' => 'success','data'=>$data]);
}
}

public function deleteslider()
{
$id=$this->input->post('deleteslider');
$this->Productmodel->DeleteSlider($id);
echo json_encode(['success' => 'success']);
}

public function contactus(){
$controller = $this->router->fetch_class(); // Gets the current controller name
    $method = $this->router->fetch_method();   // Gets the current method name
    $data['controller'] = $controller;
    $logged_in_store_id = $this->session->userdata('logged_in_store_id'); //echo $logged_in_store_id;exit;
    $role_id = $this->session->userdata('roleid'); // Role id of logged in user
    $user_id = $this->session->userdata('loginid'); // Loged in user id
    $store_details = $this->Commonmodel->get_admin_details_by_store_id($user_id);
    //  print_r($store_details);exit;
    $data['Name'] = $store_details->Name;
    // print_r($data['Name']);exit;
    // $data['userAddress'] = $store_details->userAddress;
    $data['support_no'] = $store_details->UserPhoneNumber;
    $data['support_email'] = $store_details->userEmail;  
    $data['contactus']=$this->Productmodel->listcontactus();
    // print_r($data['contactus']);
     $this->load->view('admin/includes/header',$data);
    $this->load->view('admin/catalog/contactus',$data);
    $this->load->view('admin/includes/footer',$data);  
}

public function deletecontact()
{
$id=$this->input->post('deletecontact');
// echo $id;
$this->Productmodel->Deletecontactus($id);
echo json_encode(['success' => 'success']);
}
}