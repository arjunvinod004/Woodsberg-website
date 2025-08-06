<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Homemodel');
        $this->load->model('Cartmodel');
        $this->load->model('admin/Productmodel');
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->library('email'); // ✅ Load the email library
        // print_r($this->session->userdata());
 
    }

    //Is whatsapp not enabled redirected to order listing page
    //Order type delivery and pickup checkout
    //Order type dining checkout

    public function clear() {
        echo "clear session";
        $this->session->sess_destroy();
    }


//     public function index() {
//     $this->load->helper('cookie'); // ✅ Load cookie helper

//     // Get token from cookie
//     $token = $this->input->cookie('guest_token');

//     // Set default order type in session
//     if (empty($this->session->userdata('order-type'))) {   
//         $this->session->set_userdata('order-type', 'rt');
//     }

//     $data['ordertype'] = $this->session->userdata('order-type');

//     // If token doesn't exist, generate new token and store in cookie and database
//     if (!$token) {
//         $token = bin2hex(random_bytes(8)); // Generate 16-character token
//         set_cookie('guest_token', $token, 3600 * 24); // 1 day validity

//         // Insert new guest user into customers table
//         $datas = [
//             'user_token'   => $token,
//             'name'         => null,
//             'email'        => null,
//             'password'     => null,
//             'phone'        => null,
//             'address'      => null,
//             'city'         => null,
//             'state'        => null,
//             'postal_code'  => null,
//             'country'      => null,
//             'order_type'   => $this->session->userdata('order-type'),
//             'is_active'    => 0,
//             'created_at'   => date('Y-m-d H:i:s'),
//             'updated_at'   => date('Y-m-d H:i:s')
//         ];
//         $this->Homemodel->inserttoken($datas);
//     }

//     // Load dynamic data for the homepage
//     $data['cartitems']       = $this->Cartmodel->cartitems($token);
//     $data['sumofprice']      = $this->Cartmodel->getsumofprice($token);
//     $data['cart']            = $this->Cartmodel->cartproducts($token);
//     $data['categories']      = $this->Homemodel->listcategories();
//     $data['subcategories']   = $this->Homemodel->getsubcategories();
//     $data['seasonaloffer']   = $this->Homemodel->getseasonaloffer();
//     $data['bestseller']      = $this->Homemodel->getbestseller();
//     $data['home']            = $this->Homemodel->gethome();
//     $data['testimonial']     = $this->Homemodel->gettestimonial();
//     $data['brands']          = $this->Homemodel->listbrand();
//     $data['headercategory']  = $this->Homemodel->listheadercategories();
//     $data['footercategory']  = $this->Homemodel->listfootercategories();
//     $data['slider']          = $this->Homemodel->getslider();
//     $data['store']           = $this->Homemodel->getstore();

//     // Load views
//     $this->load->view('website/header', $data);
//     $this->load->view('website/home', $data);
//     $this->load->view('website/footer', $data);
// }


//    public function index() {
//     $this->load->helper('cookie');

//     // Step 1: Set order type early
//     if (empty($this->session->userdata('order-type'))) {
//         $this->session->set_userdata('order-type', 'rt');
//     }
//     $order_type = $this->session->userdata('order-type');
//     $data['ordertype'] = $order_type;

//     // Step 2: Handle guest token
//     $token = $this->input->cookie('guest_token');

//     // ✅ Fallback to session if cookie is not available immediately
//     if (!$token && $this->session->userdata('guest_token')) {
//         $token = $this->session->userdata('guest_token');
//     }

//     // ✅ Generate only if neither cookie nor session has token
//     if (!$token) {
//         $token = bin2hex(random_bytes(8));
//         set_cookie('guest_token', $token, 3600 * 24);
//         $this->session->set_userdata('guest_token', $token); // store in session as fallback

//         // Insert into DB
//         $datas = [
//             'user_token'   => $token,
//             'name'         => null,
//             'email'        => null,
//             'password'     => null,
//             'phone'        => null,
//             'address'      => null,
//             'city'         => null,
//             'state'        => null,
//             'postal_code'  => null,
//             'country'      => null,
//             'order_type'   => $order_type,
//             'is_active'    => 0,
//             'created_at'   => date('Y-m-d H:i:s'),
//             'updated_at'   => date('Y-m-d H:i:s')
//         ];
//         $this->Homemodel->inserttoken($datas);
//     } else {
//         // If token exists, make sure it's not already in DB
//         $exists = $this->db->where('user_token', $token)
//                            ->get('customers')
//                            ->num_rows();
//         if ($exists === 0) {
//             $datas = [
//                 'user_token'   => $token,
//                 'name'         => null,
//                 'email'        => null,
//                 'password'     => null,
//                 'phone'        => null,
//                 'address'      => null,
//                 'city'         => null,
//                 'state'        => null,
//                 'postal_code'  => null,
//                 'country'      => null,
//                 'order_type'   => $order_type,
//                 'is_active'    => 0,
//                 'created_at'   => date('Y-m-d H:i:s'),
//                 'updated_at'   => date('Y-m-d H:i:s')
//             ];
//             $this->Homemodel->inserttoken($datas);
//         }
//     }

//     // Load homepage data
//     $data['cartitems']       = $this->Cartmodel->cartitems($token);
//     $data['sumofprice']      = $this->Cartmodel->getsumofprice($token);
//     $data['cart']            = $this->Cartmodel->cartproducts($token);
//     $data['categories']      = $this->Homemodel->listcategories();
//     $data['subcategories']   = $this->Homemodel->getsubcategories();
//     $data['seasonaloffer']   = $this->Homemodel->getseasonaloffer();
//     $data['bestseller']      = $this->Homemodel->getbestseller();
//     $data['home']            = $this->Homemodel->gethome();
//     $data['testimonial']     = $this->Homemodel->gettestimonial();
//     $data['brands']          = $this->Homemodel->listbrand();
//     $data['headercategory']  = $this->Homemodel->listheadercategories();
//     $data['footercategory']  = $this->Homemodel->listfootercategories();
//     $data['slider']          = $this->Homemodel->getslider();
//     $data['store']           = $this->Homemodel->getstore();

//     // Views
//     $this->load->view('website/header', $data);
//     $this->load->view('website/home', $data);
//     $this->load->view('website/footer', $data);
// }


    public function index() {
        
    // Get token from cookie
  
    $this->load->helper('cookie'); // ✅ Load cookie helper
    $token = $this->input->cookie('guest_token');
    // echo $token;
    //   if (!$token && isset($_COOKIE['guest_token'])) {
    //     $token = $_COOKIE['guest_token'];
    // }
    //    echo $token;
    
    if (empty($this->session->userdata('order-type'))) 
    {   
        $this->session->set_userdata('order-type', 'rt');

    }
    //  echo "Order Type: " . $this->session->userdata('order-type');

    $data['ordertype'] = $this->session->userdata('order-type');

   // print_r($data['ordertype']); // will print 'bb'

if (empty($token)) {
    $token = bin2hex(random_bytes(8));
    set_cookie('guest_token', $token, 86400); // 1 day = 86400 seconds
}
        $data['cartitems'] = $this->Cartmodel->cartitems($token);
        $data['sumofprice']=$this->Cartmodel->getsumofprice($token);
        $data['cart']= $this->Cartmodel->cartproducts($token);
        $data['categories']=$this->Homemodel->listcategories();
        $data['subcategories']=$this->Homemodel->getsubcategories();
        $data['seasonaloffer']=$this->Homemodel->getseasonaloffer();
        $data['bestseller']=$this->Homemodel->getbestseller();
        $data['home']=$this->Homemodel->gethome();
        $data['testimonial']=$this->Homemodel->gettestimonial();
        $data['brands']=$this->Homemodel->listbrand();
        $data['headercategory']=$this->Homemodel->listheadercategories();
        $data['footercategory']=$this->Homemodel->listfootercategories();
        $data['slider']=$this->Homemodel->getslider();
        // print_r($data['slider']);

        $data['store']=$this->Homemodel->getstore();
        $this->db->where('user_token', $token);
        $query = $this->db->get('customers');
       //echo $token; $query->num_rows();exit;
        if ($query->num_rows() === 0) {
            // Insert only if not exists
            $datas = [
                'user_token'   => $token,
                'name'         => null,
                'email'        => null,
                'password'     => null,
                'phone'        => null,
                'address'      => null,
                'city'         => null,
                'state'        => null,
                'postal_code'  => null,
                'country'      => null,
                 'order_type'   =>$this->session->userdata('order-type'),
                'is_active'    => 0,
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s')
            ];
            $this->Homemodel->inserttoken($datas);
        }

        //   print_r($data['home']);
        $this->load->view('website/header', $data);
        $this->load->view('website/home',$data);
        $this->load->view('website/footer', $data);
    }
    
    
    public function wholesale()
{
    $this->load->helper('cookie');

    // ✅ Step 1: Set session order-type first
    if (empty($this->session->userdata('order-type'))) {
        $this->session->set_userdata('order-type', 'ws');
    }
    $order_type = $this->session->userdata('order-type');
    $data['ordertype'] = $order_type;

    // print_r($data['ordertype']);

    // ✅ Step 2: Get guest token from cookie or fallback to session
    $token = $this->input->cookie('guest_token');
    // print_r($token);
    if (!$token && $this->session->userdata('guest_token')) {
        $token = $this->session->userdata('guest_token');
    }

    // ✅ Step 3: If still no token, generate and insert
    if (!$token) {
        $token = bin2hex(random_bytes(8));
        set_cookie('guest_token', $token, 3600 * 24);
        $this->session->set_userdata('guest_token', $token); // Save as fallback

        // Insert into DB
        $datas = [
            'user_token'   => $token,
            'name'         => null,
            'email'        => null,
            'password'     => null,
            'phone'        => null,
            'address'      => null,
            'city'         => null,
            'state'        => null,
            'postal_code'  => null,
            'country'      => null,
            'order_type'   => $order_type,
            'is_active'    => 0,
            'created_at'   => date('Y-m-d H:i:s'),
            'updated_at'   => date('Y-m-d H:i:s')
        ];
        $this->Homemodel->inserttoken($datas);
    } else {
        // ✅ Step 4: If token exists, ensure no duplicate DB insert
        $exists = $this->db->where('user_token', $token)->get('customers')->num_rows();
        if ($exists === 0) {
            $datas = [
                'user_token'   => $token,
                'name'         => null,
                'email'        => null,
                'password'     => null,
                'phone'        => null,
                'address'      => null,
                'city'         => null,
                'state'        => null,
                'postal_code'  => null,
                'country'      => null,
                'order_type'   => $order_type,
                'is_active'    => 0,
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s')
            ];
            $this->Homemodel->inserttoken($datas);
        }
    }

    // ✅ Step 5: Load page data
    $data['categories']      = $this->Homemodel->listcategories();
    $data['home']            = $this->Homemodel->gethome();
    $data['subcategories']   = $this->Homemodel->getsubcategories();
    $data['headercategory']  = $this->Homemodel->listheadercategories();
    $data['footercategory']  = $this->Homemodel->listfootercategories();
    $data['cart']            = $this->Cartmodel->cartproducts($token);
    $data['store']           = $this->Homemodel->getstore();

    // ✅ Step 6: Render wholesale view
    $this->load->view('website/header', $data);
    $this->load->view('website/wholesale', $data);
    $this->load->view('website/footer', $data);
}


    public function B2B()
    {   
        $this->load->helper('cookie'); // ✅ Load cookie helper
        $token = $this->input->cookie('guest_token');
         echo $token;
        // echo "B2B"; exit;
     
     if (empty($this->session->userdata('order-type'))) 
    {
        $this->session->set_userdata('order-type', 'bb');
    }
 
    
    //  echo "Order Type: " . $this->session->userdata('order-type');

     $data['ordertype'] = $this->session->userdata('order-type');
     //print_r($data['ordertype']); // will print 'bb'
      
    if (!$token) 
    {
        $token = bin2hex(random_bytes(8)); // 16-char token (not 32, unless you use 16 bytes)
        set_cookie('guest_token', $token, 3600 * 24 ); // 1 days
    };
        $data['categories']=$this->Homemodel->listcategories();
        $data['home']=$this->Homemodel->gethome();
        $data['cart']= $this->Cartmodel->cartproducts($token);
        $data['subcategories']=$this->Homemodel->getsubcategories();
        $data['headercategory']=$this->Homemodel->listheadercategories();
        $data['footercategory']=$this->Homemodel->listfootercategories();
        $data['store']=$this->Homemodel->getstore();
        $this->load->view('website/header', $data);
        $this->load->view('website/b2b',$data);
        $this->load->view('website/footer',$data);
        $this->db->where('user_token', $token);
        $query = $this->db->get('customers');
       //echo $token; $query->num_rows();exit;
         if ($query->num_rows() === 0) 
           {
            // Insert only if not exists
            $datas = [
                'user_token'   => $token,
                'name'         => null,
                'email'        => null,
                'password'     => null,
                'phone'        => null,
                'address'      => null,
                'city'         => null,
                'state'        => null,
                'postal_code'  => null,
                'country'      => null,
                'is_active'    => 0,
                'order_type'   => $data['ordertype'],
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s')
            ];
            $this->Homemodel->inserttoken($datas);
            }   
    }


// export website
public function Export() {
    // $this->load->helper('cookie');
    // $this->load->library('session');

    // 🔐 Avoid echo/print here, it can break sessions/cookies

    // Generate/set session

        $this->load->helper('cookie'); // ✅ Load cookie helper
        $token = $this->input->cookie('guest_token');

        // echo $token;
        // echo "B2B"; exit;
     
     if (empty($this->session->userdata('order-type'))) 
    {
        $this->session->set_userdata('order-type', 'exp');
    }
    //  echo "Order Type: " . $this->session->userdata('order-type');

     $data['ordertype'] = $this->session->userdata('order-type');
      
    if (!$token) 
    {
        $token = bin2hex(random_bytes(8)); // 16-char token (not 32, unless you use 16 bytes)
        set_cookie('guest_token', $token, 3600 * 24 ); // 1 days
    };

    // if (empty($this->session->userdata('order-type'))) {
    //     $this->session->set_userdata('order-type', 'exp');
    // }

    // $data['ordertype'] = $this->session->userdata('order-type');

    // // Get token from cookie
    // $token = $this->input->cookie('guest_token');
    // if (!$token) {
    //     $token = bin2hex(random_bytes(8));
    //     set_cookie('guest_token', $token, 3600 * 24); // 1 day
    // }

    // Cart and other data
    $data['cartitems']     = $this->Cartmodel->cartitems($token);
    $data['sumofprice']    = $this->Cartmodel->getsumofprice($token);
    $data['cart']          = $this->Cartmodel->cartproducts($token);
    $data['categories']    = $this->Homemodel->listcategories();
    $data['subcategories'] = $this->Homemodel->getsubcategories();
    $data['seasonaloffer'] = $this->Homemodel->getseasonaloffer();
    $data['bestseller']    = $this->Homemodel->getbestseller();
    $data['home']          = $this->Homemodel->getexport();
    $data['testimonial']   = $this->Homemodel->gettestimonial();
    $data['brands']        = $this->Homemodel->listbrand();
    $data['headercategory']= $this->Homemodel->listheadercategories();
    $data['footercategory']= $this->Homemodel->listfootercategories();
    $data['store']         = $this->Homemodel->getstore();
    $data['slider']        = $this->Homemodel->getslider();
// get the export categories from product table
    $categories = $this->Homemodel->listcategories();
     $category_ids_with_export = [];
     foreach ($categories as $category) {
        $category_id = $category['category_id'];
          $category_name = $category['category_name'];
        $has_export = $this->Homemodel->has_export_products($category_id);

        // If the category has export products, add its ID to the array
        if ($has_export) {
            $category_ids_with_export[] =[
            'id' => $category_id,
            'name' => $category_name
        ];
        }

        $data['category_ids_with_export'] = $category_ids_with_export;
    }

    //  echo "<pre>"; print_r($category_ids_with_export); echo "</pre>";

    // Check if token exists in DB
    $this->db->where('user_token', $token);
    $query = $this->db->get('customers');
    if ($query->num_rows() === 0) {
        $datas = [
            'user_token'   => $token,
            'name'         => null,
            'email'        => null,
            'password'     => null,
            'phone'        => null,
            'address'      => null,
            'city'         => null,
            'state'        => null,
            'postal_code'  => null,
            'country'      => null,
            'is_active'    => 0,
            'order_type'   => $data['ordertype'],
            'created_at'   => date('Y-m-d H:i:s'),
            'updated_at'   => date('Y-m-d H:i:s')
        ];
        $this->Homemodel->inserttoken($datas);
    }

    // Finally render views
    $this->load->view('website/header', $data);
    $this->load->view('website/export', $data);
    $this->load->view('website/footer', $data);
}

    


    // public function test1(){
    //     $data['categories']=$this->Homemodel->listcategories();
    //     $data['home']=$this->Homemodel->gethome();
    //     $data['subcategories']=$this->Homemodel->getsubcategories();
    //     $token = $this->input->cookie('guest_token');
    //     // echo $token; exit;
    //     // $data['cartcount']=$this->Homemodel->getcartcount($token);
    //     $data['cart']= $this->Homemodel->cartproducts($token);
    //     // $data['cartitems']=$this->Homemodel->cartitems();
    //     // print_r($data['cart']);
    //     // echo $data['cartcount'];
    //     $this->load->view('website/carttest',$data);
    // }


    public function productpage($id){
    $token = $this->input->cookie('guest_token');
    $data['headercategory']=$this->Homemodel->listheadercategories();
    $data['footercategory']=$this->Homemodel->listfootercategories();
    $data['store']=$this->Homemodel->getstore();
    $data['subcategories']=$this->Homemodel->getsubcategories();
    $data['productdetails']=$this->Homemodel->getproductdetails($id);
    $data['ordertype'] = $this->session->userdata('order-type');

    $data['cart']= $this->Cartmodel->cartproducts($token);
    // print_r($data['productdetails']);
    $this->load->view('website/header', $data);
    $this->load->view('website/productdetails',$data);
    $this->load->view('website/footer',$data);

    }
    

public function getCategoriesproducts(){
    $category_id = $this->input->post('category_id');
    //  print_r($category_id);
    $subcategory_id = $this->input->post('subcategory_id');
    // print_r($subcategory_id);
    $products = $this->Homemodel->getCategoriesproducts($category_id, $subcategory_id);
    $this->session->userdata('order-type'); 
    // echo  $this->session->userdata('order-type');
    //echo "Order Type: " . $this->session->userdata('order-type');

    $data['ordertype'] = $this->session->userdata('order-type');
    // print_r($products);
     $token = $this->input->cookie('guest_token');
     $cart= $this->Cartmodel->cartproducts($token);
    $html = '';
    
    if (count($products) > 0) {
   foreach ($products as $product) {
    $price= '';
    if ($data['ordertype'] == 'ws') {
            $price = $product['wholesale_price'];
        } elseif ($data['ordertype'] == 'rt') {
            $price = $product['retail_price'];
        } elseif ($data['ordertype'] == 'bb') {
            $price = $product['franchise_price'];
        }
        //  else {
        //     $price = 0;
        // }

    // Determine quantity from cart
    $quantity = 1;
    foreach ($cart as $item) {
        if ($item['product_id'] == $product['product_id']) {
            $quantity = $item['quantity'];
            break;
        }

        //  $seasonal_percentage = $product['seasonal_percentage'];
        // $final_price = $price;

        // if ($seasonal_percentage) {
        //     $discount = ($price * $seasonal_percentage) / 100;
        //     $final_price = $price - $discount;
        // }
    }

    $html .= '<div class="col-6 col-sm-6 col-md-6 col-lg-3 mt-4 product-item">';
    $html .= '<div class="service-box">';
    $html .= '<div class="project-grid-style2">';
    $html .= '<div class="project-details">';
    $html .= '<img src="' . base_url() . 'uploads/product/' . $product['image'] . '" alt="product" class="product__image-img" width="190" height="150">';
    $html .= '<div class="portfolio-post-border"></div>';
    $html .= '</div>'; // .project-details

    $html .= '<div class="portfolio-title text-center">';
    $html .= '<div class="portfolio-link">';
    $html .= '<a href="' . base_url('details/' . $product['product_id']) . '" class="product__details-name text-decoration-none">' . $product['product_name'] . '</a>';
    $html .= '</div>';
//    $html .= '<p class="price-cart" data-price="' . $final_price . '">';
// $html .= 'RS ' . $final_price;

// if ($seasonal_percentage) {
//     $html .= '<span class="text-decoration-line-through ms-2" style="font-size: 14px;">';
//     $html .= 'RS ' . $price;
//     $html .= '</span>';
// }

// $html .= '</p>';
    $html .= '<p class="price-cart" data-price="' .  $price . '">₹' .  $price . '</p>';

    // Quantity section
    $html .= '<div class="d-flex align-items-center px-2 qty-area justify-content-center">';
    $html .= '<button class="btn btn-sm p-1 decrement-btn" data-product-id="' . $product['product_id'] . '">−</button>';
    $html .= '<span data-qty>' . $quantity . '</span>';
    $html .= '<button class="btn btn-sm p-1 increment-btn" data-product-id="' . $product['product_id'] . '">+</button>';
    $html .= '</div>'; // .qty-area

    // Add to Cart form
    $html .= '<form method="post" id="add_cart_form" enctype="multipart/form-data">';
    $html .= '<input type="hidden" id="cart_product_id"  name="cart_product_id" value="' . $product['product_id'] . '">';
    $html .= '<input type="hidden" id="quantity" name="quantity" value="' . $quantity . '" class="qty-input">';
    // $html.= ' <input
    //                   type="hidden"
    //                   id="price"
    //                 value="' . (isset($final_price) ? $final_price : $price) . '"
    //                   class="qty-price"
    //                 />';
    $html .= '<input type="hidden" id="price" name="price" value="' .  $price . '" class="qty-price">';
    $html .= '  <input type="hidden" id="product_weight" value="' . $product['weight'] . '" >';
    $html .= '  <input type="hidden" id="product_kg_g" value="' . $product['kg_g'] . '" >';
    //  $html .= '<input type="hidden" id="product_price" value="' . (isset($final_price) ? $final_price : $price) . '">';

    $html .= '<input type="hidden" id="product_price"  name="product_price" value="' .  $price . '" >';

    $html .= '<div class="d-flex justify-content-center gap-2 mt-3 product">';
    if ($product['out_of_stock'] == 1) {
        $html .= '<button type="button" class="btn btn-sm out-of-stock  d-flex align-items-center gap-1" disabled>';
        $html .= 'Out of Stock';
        $html .= '</button>';
    } else {
        $html .= '<button type="submit" class="btn btn-sm d-flex align-items-center gap-1" title="Add to Cart">';
        $html .= '<i class="fas fa-shopping-cart"></i> Add to Cart';
        $html .= '</button>';
    }

    $html .= '<button type="button" class="btn btn-sm d-flex align-items-center gap-1" id="wishlist_button">';
    $html .= '<i class="fas fa-heart"></i> Wishlist';
    $html .= '</button>';
    $html .= '</div>'; // .product
    $html .= '</form>';

    $html .= '</div>'; // .portfolio-title
    $html .= '</div>'; // .project-grid-style2
    $html .= '</div>'; // .service-box
    $html .= '</div>'; // .col
}

    } else {
        $html .= '<div class="col-md-12 col-sm-12 col-xs-12"><h4>No products found</h4></div>';
    }

    // Always return JSON only
    echo json_encode([
        'success' => true,
        'html' => $html
    ]);
}



public function category(){
$category_id = $this->input->post('category_id');
$data['selected_category_id'] = $category_id;
$data['headercategory']=$this->Homemodel->listheadercategories();
$data['footercategory']=$this->Homemodel->listfootercategories();
$data['subcategories']=$this->Homemodel->getsubcategories();
$data['store']=$this->Homemodel->getstore();
$category = $this->Homemodel->getCategoryById($category_id); // Create this method if not present
$data['selected_category_name'] = $category ? $category['category_name'] : 'Products';
//  echo $category_id; echo "here"; exit;
$data['categories']=$this->Homemodel->listcategories();
$data['subcategories']=$this->Homemodel->getsubcategories();
$data['products'] = $this->Homemodel->getcategoryproducts($category_id);
$token= $this->input->cookie('guest_token');
$data['cart']= $this->Homemodel->cartproducts($token);
$data['ordertype'] = $this->session->userdata('order-type');
// print_r($data['ordertype']);
//  print_r($data['products']); exit;
$this->load->view('website/header',$data);
$this->load->view('website/productspage',$data);
$this->load->view('website/footer',$data);
}

public function exportcategory(){
$category_id = $this->input->post('category_id');
$data['selected_category_id'] = $category_id;
$data['headercategory']=$this->Homemodel->listheadercategories();
$data['footercategory']=$this->Homemodel->listfootercategories();
$data['subcategories']=$this->Homemodel->getsubcategories();
$data['store']=$this->Homemodel->getstore();
$category = $this->Homemodel->getCategoryById($category_id); // Create this method if not present
$data['selected_category_name'] = $category ? $category['category_name'] : 'Products';
//  echo $category_id; echo "here"; exit;
$data['categories']=$this->Homemodel->listcategories();
$data['subcategories']=$this->Homemodel->getsubcategories();
$data['products'] = $this->Homemodel->getcategoryproducts($category_id);
$token= $this->input->cookie('guest_token');
$data['cart']= $this->Homemodel->cartproducts($token);
$data['ordertype'] = $this->session->userdata('order-type');
$this->load->view('website/header',$data);
$this->load->view('website/exportcategory',$data);
$this->load->view('website/footer',$data);
// print_r($category_id);

}



public function contact(){
$data['ordertype'] = $this->session->userdata('order-type');
$data['headercategory']=$this->Homemodel->listheadercategories();
$data['footercategory']=$this->Homemodel->listfootercategories();
$data['store']=$this->Homemodel->getstore();
$data['subcategories']=$this->Homemodel->getsubcategories();
$this->load->view('website/header', $data);
$this->load->view('website/contact',$data);
$this->load->view('website/footer', $data);
}





public function checkout(){
// $order_type = $this->session->userdata('order-type');
// echo $order_type;
$this->load->helper('cookie'); // ✅ Load cookie helper
$token = $this->input->cookie('guest_token');
// print_r($token);
 $data['weightcalculation']=$this->Productmodel->getweightcalc($token);
$data['customerdetails']= $this->db->where('user_token', $token)->get('customers')->row_array();
$data['sumofprice']=$this->Cartmodel->getsumofprice($token);
$data['sumofpricewishlist']=$this->Cartmodel->getsumofpricewishlist($token);
$data['shipping']=$this->Productmodel->listshipping();
$data['couponcode']=$data['customerdetails']['coupon_code'];

// print_r($data['couponcode']);


// $data['shipping']= $this->db->where('user_token', $token)->get('customers')->row_array();
// print_r($data['shipping']);
$data['headercategory']=$this->Homemodel->listheadercategories();
$data['footercategory']=$this->Homemodel->listfootercategories();
$data['store']=$this->Homemodel->getstore();
$data['subcategories']=$this->Homemodel->getsubcategories();
$data['cart']= $this->Cartmodel->cartproducts($token);
$data['wishlist']=$this->Cartmodel->getwishlists($token);
// print_r($data['wishlist']);
//$data['ordertype'] = $this->session->userdata('order-type');
$data['ordertype'] = $this->Productmodel->getordertype($token);
// print_r($data['ordertype']);
$this->load->view('website/header', $data);
$this->load->view('website/checkout',$data);
 $this->load->view('website/footer', $data);  
}

public function addcontact(){
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('', '');  
            $this->form_validation->set_rules('contact_name', 'name', 'required');
            $this->form_validation->set_rules('contact_email', 'email', 'required');
            $this->form_validation->set_rules('contact_desc', 'description', 'required');
            $this->form_validation->set_rules('contact_phone', 'phone', 'required|regex_match[/^\d{10}$/]');



			if($this->form_validation->run() == FALSE) 
			{

                $response = [
					'success' => false,
					'errors' => [
					'contact_name' => form_error('contact_name'),
                    'contact_email' => form_error('contact_email'),
                    'contact_desc' => form_error('contact_desc'),
                    'contact_phone' => form_error('contact_phone'),
					]
				];
			
				echo json_encode($response);
			}
			else
			{
                $data = array(
                    'name' => $this->input->post('contact_name'),
                    'email' => $this->input->post('contact_email'),
                    'description' => $this->input->post('contact_desc'),
                    'phone_no' => $this->input->post('contact_phone'),
                );
                // print_r($data);exit;
                $this->Homemodel->insert_contact_details($data);
                echo json_encode(['success' => 'success']);
        } 
}



public function addusercheckout()
{        
        $total_amount = $this->input->post('total_amount');
        $order_type = $this->session->userdata('order-type');
        // print_r($order_type);

        $this->load->helper('cookie'); // ✅ Load cookie helper
        $token = $this->input->cookie('guest_token');
        if (!$token)
        {
        $token = bin2hex(random_bytes(8)); // 16-char token (not 32, unless you use 16 bytes)
        set_cookie('guest_token', $token, 3600 * 24 * 24); // 30 days
        }

    //$order_type = $this->Productmodel->getordertype($token); // get order type from session like ws,rt,bb
    //  print_r($order_type);
   if($order_type == 'ws' || $order_type == 'bb'|| $order_type == 'exp') {
            // Validation rules for WS/BB orders - only company name and phone required
            $this->form_validation->set_rules('checkout_company_name', 'Company Name', 'required');
            $this->form_validation->set_rules('checkout_userphone', 'Phone', 'required|regex_match[/^\d{10}$/]');
            $this->form_validation->set_rules('checkout_username', 'name', 'required');
            $this->form_validation->set_rules('checkout_useremail', 'email', 'required|valid_email');
            
            
            
            
        } else {
            // Validation rules for RT orders - all fields required
            $this->form_validation->set_rules('checkout_username', 'First Name', 'required');
            $this->form_validation->set_rules('checkout_useremail', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('checkout_userphone', 'Phone', 'required|regex_match[/^\d{10}$/]');
            $this->form_validation->set_rules('checkout_usercity', 'City', 'required');
            $this->form_validation->set_rules('checkout_userpostcode', 'Postcode', 'required');
            $this->form_validation->set_rules('checkout_usercountry', 'Country', 'required');
            $this->form_validation->set_rules('checkout_useraddress', 'Address', 'required');
            $this->form_validation->set_rules('state', 'State', 'required');
        }
        // echo $token; exit;
       
                        
        if($this->form_validation->run() == FALSE) 
        {

            $errors = array();
            
            if($order_type == 'ws' || $order_type == 'bb' || $order_type == 'exp') {
                $errors['checkout_company_name'] = form_error('checkout_company_name');
                $errors['checkout_userphone'] = form_error('checkout_userphone');
                $errors['checkout_useremail'] = form_error('checkout_useremail');
                $errors['checkout_userphone'] = form_error('checkout_userphone');
                $errors['checkout_username'] = form_error('checkout_username');
            } else {
                $errors['checkout_username'] = form_error('checkout_username');
                $errors['checkout_useremail'] = form_error('checkout_useremail');
                $errors['checkout_userphone'] = form_error('checkout_userphone');
                $errors['checkout_usercity'] = form_error('checkout_usercity');
                $errors['checkout_userpostcode'] = form_error('checkout_userpostcode');
                $errors['checkout_usercountry'] = form_error('checkout_usercountry');
                $errors['checkout_useraddress'] = form_error('checkout_useraddress');
                $errors['state'] = form_error('state');
            }
            echo json_encode([
                'success' => false,
                'errors' => $errors
            ]);

        }


        else
        {   
            
        // Determine name field based on order type
    $name = '';
    if($order_type == 'ws' || $order_type == 'bb') {
        $name = $this->input->post('checkout_company_name');
    } else {
        $name = $this->input->post('checkout_username');
    }
            $data = array(
            'user_token'   => $token,
            'name'         => $name,
            'email'        => $this->input->post('checkout_useremail')?: null,
            'password'     => 0,
            'phone'        => $this->input->post('checkout_userphone')?: null,
            'address'      => $this->input->post('checkout_useraddress')?: null,
            'city'         => $this->input->post('checkout_usercity')?: null,
            'state'        => 'kerala',
            'postal_code'  => $this->input->post('checkout_userpostcode')?: null,
            'country'      => $this->input->post('checkout_usercountry')?: null,
            'is_active'    => 1,
            'created_at'   => date('Y-m-d H:i:s'),
            'updated_at'   => date('Y-m-d H:i:s')
            );
             $this->Homemodel->updatecustomer($data,$token);

           

             //$this->db->insert('customers', $data);           

                $data['customerdetails']= $this->db->where('user_token', $token)->get('customers')->row_array();
                // $sumofprice=$this->Cartmodel->getsumofprice($token);
                $customer_id=$data['customerdetails']['id'];
                $customer_name=$data['customerdetails']['name'];
                $customer_phone=$data['customerdetails']['phone'];
                $customer_email=$data['customerdetails']['email'] ?: '';
                $this->db->where('customer_id', $customer_id);
                $existing_order = $this->db->get('orders')->row_array();
                $orderno = 'ORD' . date('dm') .strtoupper(substr($token, -2));   
              // $order_type = $this->Productmodel->getordertype($token);         
                $this->db->insert('orders', 
                [
                        'order_no'=> $orderno,
                        'customer_id'    => $customer_id,
                        'total_amount'   => $total_amount,
                        'status'         => 0,
                        'order_date'     => date('Y-m-d H:i:s'),
                        'delivery_date'  => 0,
                        'payment_status' => 0,
                        'order_type'     =>$order_type,
                        'name'=>$customer_name,
                        'phone'=>$customer_phone
                ]);
                     $order_id = $this->db->insert_id();
 
            $cart_items = $this->Cartmodel->cartitems($token);

            foreach ($cart_items as $item) 
            {
               $product_id = $item['product_id'];
               $quantity   = $item['quantity'];
               $price      = $item['product_price'];
               $amount     = $item['price'];

            $this->db->insert('order_items',
            [
             'order_id'     => $orderno,
             'product_id'   => $product_id,
             'quantity'     => $quantity,
             'price'   => $price,
             'amount'    => $amount,
             'total_price'  => $total_amount,
             'order_type'   => $order_type
              ]);


            $this->db->insert('store_stock',
            [
                'product_id' => $product_id,
                'tr_date' => date('Y-m-d '),
                'order_id' => $orderno,
                'ttype'=> 'SL',
                'pu_qty' => 0,
                'sl_qty'   => $quantity,
                 'created_by' => 0,
                 'created_date' => date('Y-m-d H:i:s'),
                 'modified_by' => 0,
                'modified_date' => date('Y-m-d H:i:s')
                
            ]);

            
  
            }

$cartitems = $this->Cartmodel->cartitems($token);


            
if ($order_type == 'rt') {

$query = http_build_query([
    'order_id' => $orderno,
    'amount'   => $total_amount,
    'cust_id'  => $customer_id,
    'cust_name' => $customer_name,
    'cust_phone' => $customer_phone,
    'cust_email' => $customer_email,
    
]);

$checkout_url = base_url("Payment/index.php?".$query);
echo json_encode([
    'success' => 'success',
    'message' => 'Order placed',
    'redirect_url' => $checkout_url,
    'cartitems' => $cartitems
    
    // 'query' => $query,
]); 
    return;
} 
else{
  $this->session->unset_userdata('order-type');
$this->db->where('guest_token', $token)->delete('cart');
$this->db->where('guest_token', $token)->delete('wishlist');
delete_cookie('guest_token');
// ✅ 2. Create new guest token
$new_token = bin2hex(random_bytes(8));
$cookie = [
    'name'     => 'guest_token',
    'value'    => $new_token,
    'expire'   => 3600 * 24 * 30,
    'path'     => '/woodsberg/',
    'secure'   => TRUE,
    'httponly' => TRUE
];
$this->input->set_cookie($cookie);  
echo json_encode([
        'success' => 'success',
        'ordertype' => $order_type,
        'new_token' => $new_token,
        'message' => ' order handled successfully.',
    ]);
    return;
}     

            


             
            // echo "here";

// ✅ 1. Clear cart/wishlist/session


// ✅ 3. Send JSON response to frontend
// echo json_encode([
//     'success'   => 'success',
//     'data'      => $data,
//     'message'   => 'Order placed successfully',
//     'ordertype' => $order_type,
//     'new_token' => $new_token
// ]);

}

}



 public function handlePaymentResponse()
{

$order_type = $this->session->userdata('order-type');
$this->load->helper('cookie'); // ✅ Load cookie helper
$token = $this->input->cookie('guest_token');
//✅ Update status
$order_id = $this->input->post('order_id');
$status = $this->input->post('status');
    // Split the response using '|'
    $parts = explode('|', $status);
    // Extract necessary fields
    $txn_status = strtolower(trim($parts[1] ?? ''));  // e.g., 'success', 'user aborted'
    if ($txn_status === 'success' && $order_id) {
        $this->Homemodel->updatePaymentStatus($order_id);
    } 
}  

public function clearPaymentSession(){
$order_type = $this->session->userdata('order-type');
        $this->load->helper('cookie'); // ✅ Load cookie helper
        $token = $this->input->cookie('guest_token');
        // echo $token; exit;
$this->session->unset_userdata('order-type');
$this->db->where('guest_token', $token)->delete('cart');
$this->db->where('guest_token', $token)->delete('wishlist');
delete_cookie('guest_token');
// ✅ 2. Create new guest token
$new_token = bin2hex(random_bytes(8));
$cookie = [
    'name'     => 'guest_token',
    'value'    => $new_token,
    'expire'   => 3600 * 24 * 30,
    'path'     => '/woodsberg/',
    'secure'   => TRUE,
    'httponly' => TRUE
];
$this->input->set_cookie($cookie);

echo json_encode([
    'success'   => 'success',
    'message'   => 'Payment session cleared successfully',
    'ordertype' => $order_type,
    'new_token' => $new_token
]);




// print_r($order_type);
}

}
?>