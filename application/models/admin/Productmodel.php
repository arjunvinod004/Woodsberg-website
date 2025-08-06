<?php
class Productmodel extends CI_Model {

    // Insert into products table
    public function insert_product_translation($data) {
        $this->db->insert('product', $data);
        return $this->db->insert_id(); // Return inserted product ID
    }

	public function get_product_id($data) {
		$this->db->select('product_id');
		$this->db->from('product');
		$this->db->where('product_name', $data['product_name']);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->row()->product_id; // Return the product_id
		}
		return null; // Return null if no product found
	}

	public function insert_product_stock($stock, $product_id, $logged_in_store_id) {
		$data = array(
			'product_id' => $product_id,
			'pu_qty' => $stock,
			 'sl_qty' => 0,
			'tr_date' => date('Y-m-d'),
			 'ttype' => 'SK',
			'created_by' => $logged_in_store_id,
			'created_date' => date('Y-m-d H:i:s'),
			'modified_by' => $logged_in_store_id,
			'modified_date' => date('Y-m-d H:i:s'),
		);
		$this->db->insert('store_stock', $data);
		return $this->db->insert_id(); // Return inserted stock ID
	}


	public function updated_stock($id, $stock, $update_product_stock = false) {
		$data = array(
			'stock' => $stock,
			
			'modified_date' => date('Y-m-d H:i:s')
		);
		$this->db->where('product_id', $id);
		$this->db->update('store_stock', $data);
		return true; // Return true on success
	}

	public function insert_brand_translation($data) {
		$this->db->insert('brands', $data);
		return $this->db->insert_id(); // Return inserted product ID
	}

	public function insert_slider_translation($data) {
		$this->db->insert('slider', $data);
		return $this->db->insert_id(); // Return inserted product ID
	}

	public function listslider() {
		$this->db->select('*');
		$this->db->from('slider');
		$this->db->order_by("id", "desc");
		$query = $this->db->get();
		return $query->result_array();
	}


	public function getCategoryName($id) {
		$this->db->select('category_name_en');
		$this->db->from('categories');
		$this->db->where('category_id', $id);
		$query = $this->db->get();
		$row = $query->row(); // <- fixed
		return $row ? $row->category_name_en : 'Unknown';
	}

    public function listcategories() {
        $this->db->select('*');
		$this->db->from('categories');
		//$this->db->where('is_active', 1);
        //$this->db->where('language', 'en');
		$this->db->order_by("category_id", "desc");
		$query = $this->db->get();
		return $query->result_array();
    }

	public function listsubcategories() {
        $this->db->select('*');
		$this->db->from('subcategories');
		//$this->db->where('is_active', 1);
        //$this->db->where('language', 'en');
		$this->db->order_by("id", "desc");
		$query = $this->db->get();
		return $query->result_array();
    }
    


	// public function listproducts() {
    //     $this->db->select('*');
	// 	$this->db->from('product');
	// 	//$this->db->where('is_active', 1);
    //     //$this->db->where('language', 'en');
	// 	$this->db->order_by("product_id", "desc");
	// 	$query = $this->db->get();
	// 	return $query->result_array();
    // }

	public function delete_product($id) {
		$this->db->where('product_id', $id);
		$this->db->delete('product');
	}

	public function listproducts($offset, $limit) {
		$this->db->select('product.*, categories.category_name_en'); // Select all product fields and category name
		$this->db->from('product');
		$this->db->join('categories', 'product.category_id = categories.category_id', 'left'); // Left join with category
		$this->db->order_by("product.product_id", "desc");
		$this->db->limit($limit, $offset);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function getOrderNo() {
        $this->db->select('token_id');
	    $this->db->from('token_generation');
		$this->db->where('id ', 1);
		$query = $this->db->get();
        $result = $query->result_array();
        return $token_id = $result[0]['token_id'];
    }


	public function list_products(){
		$this->db->select('*');
		$this->db->from('product');
		$this->db->order_by("product_id", "desc");
		$query = $this->db->get();
		return $query->result_array();

	}

	public function get_categories_by_id($id) {
		$this->db->select('*');
		$this->db->from('categories');
		$this->db->where('category_id', $id);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function get_subcategories_by_id($id) {
		$this->db->select('*');
		$this->db->from('subcategories');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->row_array();
	}
	

    public function update_categories($id, $data) {
        $this->db->where('category_id', $id);
        $this->db->update('categories', $data);
        return true;
    }

	public function update_subcategories($id, $data) {
		$this->db->where('id', $id);
        $this->db->update('subcategories', $data);
        return true;
	}


	public function update_product($id, $data) {
        $this->db->where('product_id', $id);
        $this->db->update('product', $data);
        return true;
    }

	public function update_testimonial($id, $data) {
		$this->db->where('id', $id);
		$this->db->update('testimonials', $data);
		return true;
	}

	public function update_brand($id, $data) {
		$this->db->where('id', $id);
		$this->db->update('brands', $data);
		return true;
	}


	public function getNextOrderIndex()
{
    $this->db->select_max('order_index');
    $query = $this->db->get('categories'); // your table name
    $row = $query->row();
    return ($row->order_index ?? 0) + 1;
}


public function getNextOrderIndexsubcategories()
{
    $this->db->select_max('order_index');
    $query = $this->db->get('subcategories'); // your table name
    $row = $query->row();
    return ($row->order_index ?? 0) + 1;
}

public function update_coupon_code($data,$token) {
	$this->db->where('user_token',$token);
	$this->db->update('customers', $data);
	return $this->db->insert_id();
}


   

	public function DeleteCategory($id){
		$this->db->select('*');
		$this->db->where('category_id',$id );
		$this->db->delete('categories');
   
	}

    public function insert_categories_translation($data) {
        $this->db->insert('categories', $data);
        return $this->db->insert_id();
    }

	public function insert_testimonial_translation($data) {
		$this->db->insert('testimonials', $data);
		return $this->db->insert_id();
	}

	public function insert_subcategories_translation($data){
		$this->db->insert('subcategories', $data);
        return $this->db->insert_id();
	}


	
	public function get_product_by_id($id){
	    $this->db->select('*');
		$this->db->from('product');
		$this->db->where('product_id',$id );
		$query = $this->db->get();
		return $query->row_array();
	}

	public function get_testimonial_by_id($id){
		$this->db->select('*');
		$this->db->from('testimonials');
		$this->db->where('id',$id );
		$query = $this->db->get();
		return $query->row_array();
	}

	public function listtestimonial(){
		$this->db->select('*');
		$this->db->from('testimonials');
		$this->db->order_by("id", "desc");
		$query = $this->db->get();
		return $query->result_array();
	}

	public function listbrand(){
		$this->db->select('*');
		$this->db->from('brands');
		$this->db->order_by("id", "desc");
		$query = $this->db->get();
		return $query->result_array();
	}
	

	public function shopAssignedProductsByadminKeyUpSearch($search = null)
	{
		$this->db->select('*'); 
		$this->db->from('product');
		if (!empty($search)) {
			$this->db->like('LOWER(product_name)', strtolower($search)); // Case-insensitive search
		}
		$this->db->order_by("product.product_id", "desc"); 
		$query = $this->db->get();
		// echo $this->db->last_query();
		return $query->result();  // Returns an array of results
	}


	public function getStoreProductsCountbyadmin($store_id) {
        $this->db->select('product_id'); // Select only the store_product_id
        $this->db->from('product'); // Your table name
        $this->db->where('store_id', $store_id); // Condition for store_id
        return $this->db->count_all_results(); 
    }

	public function update_category_order_index($category_id , $order_index) {
		$this->db->where('category_id', $category_id);
		$this->db->update('categories', array('order_index' => $order_index));
	}

	public function update_subcategory_order_index($subcategory_id , $order_index) {
		$this->db->where('id', $subcategory_id);
		$this->db->update('subcategories', array('order_index' => $order_index));
	}


	public function get_subcategory($id) {
		$this->db->select('*');
		$this->db->from('subcategories');
		$this->db->where('category_id', $id);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_brand_by_id($id) {
		$this->db->select('*');
		$this->db->from('brands');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function delete_testimonial($id) {
		$this->db->where('id', $id);
		$this->db->delete('testimonials');
	}	

    public function delete_subcategory($id) {
		$this->db->where('id', $id);
		$this->db->delete('subcategories');
	}

	public function delete_brand($id) {
		$this->db->where('id', $id);
		$this->db->delete('brands');
	}
  public function insert_coupon_translation($data) {
		$this->db->insert('coupon_code', $data);
		return $this->db->insert_id(); // Return inserted product ID
	}


	public function listcoupon(){
		$this->db->select('*');
		$this->db->from('coupon_code');
		$this->db->order_by("id", "desc");
		$query = $this->db->get();
		return $query->result_array();
	}

	public function deleteCoupon($id) {
		$this->db->where('id', $id);
		$this->db->delete('coupon_code');
		return true;
	}

	public function VerifyCoupon($code){
	// $this->db->where('token', $token);
	 $this->db->select('code, discount_type, discount_value');
	$this->db->from('coupon_code');
	$this->db->where('code', $code);
	$query = $this->db->get();
	// echo $this->db->last_query();
	return $query->row_array();
	}

	public function getcategoryCount($id){
		$this->db->select('id'); // Select only the store_product_id
		$this->db->where('store_id', $id);
        $this->db->from('categories'); // Your table name
        return $this->db->count_all_results(); 
	}

	public function getsubcategoryCount($id){
		$this->db->select('id'); // Select only the store_product_id
		$this->db->where('store_id', $id);
        $this->db->from('subcategories'); // Your table name
        return $this->db->count_all_results(); 
	}

	public function getPaginatedSubcategories($limit, $offset, $store_id) 
{
    $this->db->where('store_id', $store_id);
    $this->db->limit($limit, $offset);
	// echo $this->db->last_query();
    $query = $this->db->get('subcategories'); // Adjust the table name if needed
    return $query->result();
}

public function getPaginatedProducts($limit, $offset, $store_id)
 {
    $this->db->where('store_id', $store_id);
    $this->db->limit($limit, $offset); // limit: 10, offset: 20 (starts at 21st record)
    $query = $this->db->get('product');
    return $query->result_array();
}

public function listshipping(){
	$this->db->select('*');
	$this->db->from('shipping_charges');
	$this->db->order_by("id", "desc");
	$query = $this->db->get();
	return $query->result_array();
}

public function update_shipping_rate($id,$rate) {
	$this->db->where('id', $id);
	$this->db->update('shipping_charges', array('shipping_charge' => $rate));
}

public function getweightcalc($token) {
    // Get full_weight and quantity from the cart table for the given guest token
    $this->db->select('full_weight');
    $this->db->from('cart');
    $this->db->where('guest_token', $token);
    $query = $this->db->get();

    $totalGrams = 0;
	// $totalGrams = 0;

foreach ($query->result() as $row) {
    if (preg_match('/([\d.]+)\s*(kg|g)/i', $row->full_weight, $matches)) {
        $weight = (float)$matches[1];
        $unit = strtolower($matches[2]);
        $qty = isset($row->quantity) ? (int)$row->quantity : 1;

        // Convert to grams
        if ($unit === 'kg') {
            $weightInGrams = $weight * 1000;
        } elseif ($unit === 'g') {
            $weightInGrams = $weight;
        } else {
            continue; // Skip unknown units
        }

        // Multiply by quantity
        $totalGrams += $weightInGrams * $qty;
    }
}

// Format the total weight back to full readable form
if ($totalGrams >= 1000) {
    $totalWeightFormatted = number_format($totalGrams / 1000, 2) . 'kg';
} else {
    $totalWeightFormatted = $totalGrams . 'g';
}

return $totalWeightFormatted;

	
//     foreach ($query->result() as $row) {
//     // Extract numeric weight and unit (e.g., 200g → 200 and 'g')
//     if (preg_match('/(\d+)([a-zA-Z]+)/', $row->full_weight, $matches)) {
//         $weight = (int)$matches[1];
//         $unit = strtolower($matches[2]);

//         // Convert to grams
//         if ($unit === 'kg') {
//             $weightInGrams = $weight * 1000;
//         } elseif ($unit === 'g') {
//             $weightInGrams = $weight;
//         } else {
//             continue; // Unknown unit, skip this row
//         }

//         // Add to total (no quantity involved)
//         $totalGrams += $weightInGrams;
//     }
// }

//     // Convert total grams into kg and g
//     $kg = floor($totalGrams / 1000);
//     $g = $totalGrams % 1000;
// 	$kgDecimal = $totalGrams / 1000;
//     return "$kgDecimal kg";
	
}

public function getweightcalcinwishlist($token) {
	// Get full_weight and quantity from the cart table for the given guest token
	$this->db->select('full_weight');
	$this->db->from('wishlist');
	$this->db->where('guest_token', $token);
	$query = $this->db->get();

	 $totalGrams = 0;
	
    foreach ($query->result() as $row) {
    // Extract numeric weight and unit (e.g., 200g → 200 and 'g')
    if (preg_match('/(\d+)([a-zA-Z]+)/', $row->full_weight, $matches)) {
        $weight = (int)$matches[1];
        $unit = strtolower($matches[2]);

        // Convert to grams
        if ($unit === 'kg') {
            $weightInGrams = $weight * 1000;
        } elseif ($unit === 'g') {
            $weightInGrams = $weight;
        } else {
            continue; // Unknown unit, skip this row
        }

        // Add to total (no quantity involved)
        $totalGrams += $weightInGrams;
    }
}

    // Convert total grams into kg and g
    $kg = floor($totalGrams / 1000);
    $g = $totalGrams % 1000;
	$kgDecimal = $totalGrams / 1000;
    return "$kgDecimal kg";
	
}

public function listorders() 
{
    $this->db->select('o.id,c.name,o.total_amount,c.phone, o.order_type,o.order_no');
    $this->db->from('orders AS o ');
    $this->db->join('customers As c', 'o.customer_id = c.id');
    $this->db->order_by("o.id", "desc");
    $query = $this->db->get();
	// echo $this->db->last_query();
    return $query->result_array();
}

public function vieworder($order_id)
{
	$this->db->select('od.id,p.product_name,od.quantity,od.price,od.amount,od.total_price,od.order_type,p.image,od.order_id');
	$this->db->from('order_items as od');
	$this->db->where('order_id', $order_id);
	$this->db->join('product as p', 'od.product_id = p.product_id');
	$this->db->order_by("od.id", "desc");
	$query = $this->db->get();
	return $query->result_array();
}

public function get_slider_by_id($id) {
	$this->db->where('id', $id);
	$query = $this->db->get('slider');
	return $query->row_array();
}

public function update_slider($id, $data) 
{
	$this->db->where('id', $id);
	$this->db->update('slider', $data);
}

public function DeleteSlider($id) 
{
    $this->db->where('id', $id);
	$this->db->delete('slider');
}

public function listcontactus(){
	$this->db->select('*');
	$this->db->from('contact');
	// $this->db->order_by("id", "desc");
	$query = $this->db->get();
	return $query->result_array();
}

public function Deletecontactus($id){
	$this->db->where('id', $id);
	$this->db->delete('contact');
}


public function getordertype($token){
	$this->db->select('order_type');
	$this->db->from('customers');
	$this->db->where('user_token', $token);
	$query = $this->db->get();
	 $row = $query->row_array();
    return $row ? $row['order_type'] : null;
	// return $query->row_array();
}

}
?>