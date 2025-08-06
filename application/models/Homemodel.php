<?php
class Homemodel extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function listcategories() {
        $query = $this->db->get('categories');
        return $query->result_array();
    }
    public function getseasonaloffer() {
        $this->db->where('is_seasonaloffer', 1);
        $query = $this->db->get('product');
        return $query->result_array();
    }

    public function updatePaymentStatus($order_id) {
    $this->db->where('order_no', $order_id);  // 🔴 Add this line
    $this->db->set('is_paid', 1);
    $this->db->set('payment_status', 'success');
        return $this->db->update('orders');
    }
 
    // public function getcurrentstock($product_id) {
    //     $this->db->select('stock');
    //     $this->db->where('product_id', $product_id);
    //     $query = $this->db->get('product');
    //     if ($query->num_rows() > 0) {
    //         return $query->row()->stock; // Return the stock value
    //     } else {
    //         return 0; // Return 0 if no stock found
    //     }
    // }

     public function getCurrentStock($product_id) {
            $this->db->select('(SUM(pu_qty) - SUM(sl_qty)) as bal_qty');
            $this->db->from('store_stock');
            $this->db->where('product_id', $product_id);
            $query = $this->db->get();
            $result = $query->row_array();   
            $stock = $result['bal_qty'] ?? 0;
          return ($stock < 0) ? 0 : $stock;
        }

    public function getbestseller() {
        $this->db->where('is_bestseller', 1);
        $query = $this->db->get('product');
        return $query->result_array();
    }

    public function getsubcategories() {
        $query = $this->db->get('subcategories');
        return $query->result_array();
    }
    
    public function gethome() {
        // $this->db->limit(12);
        $this->db->where('is_home', 1);
        // $this->db->where('ttype', 0);
        $query = $this->db->get('product');
        return $query->result_array();
    }

        public function getexport() {
        // $this->db->limit(12);
        $this->db->where('is_home', 1);
         $this->db->where('export_price !=', ''); // Ensures export_price is not empty
        // $this->db->where('ttype', 1);
        $query = $this->db->get('product');
        return $query->result_array();
    }

  

   public function gettestimonial() {
        $query = $this->db->get('testimonials');
        return $query->result_array();
   } 

   public function listbrand() {
        $query = $this->db->get('brands');
        return $query->result_array();
   }
   public function getCategoriesproducts($category_id,$subcategory_id) {
        $this->db->where('category_id', $category_id);
       if ($subcategory_id) {
    $this->db->where('subcategory_id', $subcategory_id);
}
        $query = $this->db->get('product');
        // echo $this->db->last_query();
        return $query->result_array();
   }

   public function getcategoryproducts($category_id) {
        $this->db->where('export_price !='); // Assuming 'ttype' is used to filter export products
        $this->db->where('category_id', $category_id);
        $query = $this->db->get('product');
        // echo $this->db->last_query();
        return $query->result_array();
   }

   public function getExportcategory($category_id) {
        $this->db->where('category_id', $category_id);
        $query = $this->db->get('categories');
        return $query->row_array();
   }

   public function getCategoryById($category_id) {
        $this->db->where('category_id', $category_id);
        $query = $this->db->get('categories');
        return $query->row_array();
   }

   public function getsubCategoryById($sub_category_id) {
     $this->db->where('id', $sub_category_id);
        $query = $this->db->get('subcategories');
        return $query->row_array();  
   }

//    public function getcartcount($guest_token){
//     $this->db->select_sum('quantity');
//     $this->db->where('guest_token', $guest_token);
//     $query = $this->db->get('cart');
//     return $query->row()->quantity ?? 0;
//    }

public function cartproducts($guest_token) {
    $this->db->select('product_id, quantity, price');
    $this->db->where('guest_token', $guest_token);
    $query = $this->db->get('cart');
    return $query->result_array(); // Safe, returns full list
}

public function listheadercategories(){
$this->db->select('*');
$this->db->from('categories');
$this->db->where('is_header', 1);
$query = $this->db->get();
return $query->result_array();
}

public function listfootercategories(){
$this->db->select('*');
$this->db->from('categories');
$this->db->where('is_footer', 1);
$query = $this->db->get();
return $query->result_array();
}

public function getstore(){
$this->db->select('store_name,store_desc,store_email,store_phone,store_address');
$this->db->from('store');
$query = $this->db->get();
return $query->result_array();
}


public function get_product_by_categoryid($id) {
    $this->db->where('category_id', $id);
    $query = $this->db->get('product');
    // echo $this->db->last_query();
    return $query->result_array();
}

public function get_product_by_catsubid($id,$sub_category_id,$order_type) {
    // echo $id;
    // echo $sub_category_id;

    // if( $order_type == 'rt' || $order_type == 'b2b' || $order_type == 'wholesale') {
    //     $this->db->where('ttype', 0);  // where product type
    // } elseif ($order_type == 'exp') {
    //     $this->db->where('ttype', 1);  // where product type
    // }
    $this->db->where('category_id', $id);
    $this->db->where('subcategory_id', $sub_category_id);
    $query = $this->db->get('product');
    return $query->result_array();
}

public function get_all_product() {
    $query = $this->db->get('product');
    return $query->result_array();
}
// get the export categories and subcategory from product table
public function get_all_export($category_id,$sub_category_id) {
    $this->db->where('export_price !=', ''); // Ensures export_price is not empty',1);
    $this->db->where('category_id', $category_id);
    $this->db->where('subcategory_id', $sub_category_id);
    $query = $this->db->get('product');
    return $query->result_array();
}

// get the export categories from product table
public function has_export_products($category_id) 
{  
$this->db->where('category_id', $category_id);
$this->db->where('export_price !=', ''); // Ensures export_price is not empty', 1);
$query = $this->db->get('product');
return $query->num_rows() > 0;
}



public function inserttoken($data){
$this->db->insert('customers', $data);
return $this->db->insert_id();
}




// public function getCustomerByTokenOrEmail($token, $email) {
//     $this->db->where('user_token', $token);
//     if ($email) {
//         $this->db->or_where('email', $email);
//     }
//     $query = $this->db->get('customers'); // Replace 'customers' with your table name
//     return $query->row();
// }

// public function updatecustomer($data, $token) {
//     $this->db->where('user_token', $token);
//     return $this->db->update('customers', $data); // Replace 'customers' with your table name
// }

// public function insertCustomer($data) {
//     return $this->db->insert('customers', $data); // Replace 'customers' with your table name
// }

public function updatecustomer($data,$user_token){
$this->db->where('user_token',$user_token);
$this->db->update('customers', $data);
// return $this->db->insert_id();

// echo $this->db->last_query();


// return $this->db->affected_rows();
}
public function getRetailReport($date , $order_type , $name = null, $phone = null) {
    // If no date provided, use today's date

    $this->db->select_sum('total_amount');
    $this->db->from('orders');
    $this->db->where('order_date', $date); // always filter by date
    $this->db->where('order_type', $order_type);
    if (!empty($name)) {
        $this->db->like('name', $name);
    }
    if (!empty($phone)) {
        $this->db->like('phone', $phone);
    }

    $query = $this->db->get();

    if ($query->num_rows() > 0) {
        return $query->row()->total_amount ?? 0;
    } else {
        return 0;
    }
}


// public function getRetailReportname($name, $order_type, $date) {
//     $this->db->select_sum('total_amount');
//     $this->db->from('orders');
//     $this->db->where('order_date', $date);
//     $this->db->where('order_type', $order_type);
//     $this->db->where('name', $name);
//     $query = $this->db->get();

//     if ($query->num_rows() > 0) {
//         return $query->row()->total_amount ?? 0;
//     } else {
//         return 0;
//     }
// }


// public function getRetailReportphone($phone, $order_type, $date,$name) {
//     $this->db->select_sum('total_amount');
//     $this->db->from('orders');
//     $this->db->where('order_date', $date);
//     $this->db->where('order_type', $order_type);
//     $this->db->where('phone', $phone);
//     $this->db->where('name', $name);
//     $query = $this->db->get();
    
//     if ($query->num_rows() > 0) {
//         return $query->row()->total_amount ?? 0;
//     } else {
//         return 0;
//     }
// }


public function getproductdetails($id) {
    $this->db->where('product_id', $id);
    $query = $this->db->get('product');
    return $query->result_array();
}

public function searchProduct($search) {

    $this->db->select('*'); 
    $this->db->from('product');

    if (!empty($search)) {
    $this->db->where("LOWER(product_name) LIKE", "%" . strtolower($search) . "%");
    }
    // $this->db->order_by("product.product_id", "desc"); 
    $query = $this->db->get();
    return $query->result();  

}

// public function searchProduct($search) {
//     $this->db->select('*'); 
//     $this->db->from('product');

//     if (!empty($search)) {
//         $this->db->like('LOWER(product_name)', strtolower($search));
//     }

//     $query = $this->db->get();
//     $products = $query->result();

//     // Now manually fetch category data for each product
//     foreach ($products as &$product) {
//         $category = $this->getCategoryBysearchId($product->category_id);
//         $product->category = $category; // Attach category object to product
//     }

//     return $products;
// }

public function getcategoryBysearchId($search) {
    $this->db->select('*');
    $this->db->from('categories');
     if (!empty($search)) {
    $this->db->where("LOWER(category_name) LIKE", "%" . strtolower($search) . "%");
    }
    $query = $this->db->get();
    return $query->result_array();
   
}
// $this->db->select('*'); 
// 		$this->db->from('product');
// 		if (!empty($search)) {
// 		$this->db->where("LOWER(product_name) LIKE", "%" . strtolower($search) . "%");
// 		}
// 		// $this->db->order_by("product.product_id", "desc"); 
// 		$query = $this->db->get();
// 		 echo $this->db->last_query();
// 		return $query->result();  // Returns an array of results



public function getslider() {
    $this->db->select('*');
    $this->db->from('slider');
    $this->db->order_by("id", "desc");
    $query = $this->db->get();
    return $query->result_array();
}

public function insert_contact_details($data) {
    $this->db->insert('contact', $data);
    return $this->db->insert_id();
}

// public function cartitems() {
//     $this->db->select('*');
//     $query = $this->db->get('cart');
//     return $query->result_array();
// }
}


?>