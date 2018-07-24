<?php 
class Pms_model extends CI_Model
{
    public function is_valid_user($email, $password)
    {
        $this->db->select('email,password');
        $this->db->where('email', $email);
        $this->db->where('password', $password);
        $query = $this->db->get('admin_info');
        if ($query->num_rows()==1) {
            return true;
        } else {
            return false;
        }
    }
    public function is_unique_category($category_name)
    {
        $this->db->select('name');
        $this->db->where('name', $category_name);
        $query=$this->db->get('product_categories');
        if ($query->num_rows()>0) {
            return false;
        } else {
            return true;
        }
    }
    public function is_unique_subcategory($subcategory_name)
    {
        $this->db->select('name');
        $this->db->where('name', $subcategory_name);
        $query=$this->db->get('product_subcategories');
        if ($query->num_rows()>0) {
            return false;
        } else {
            return true;
        }
    }
    public function update_profile($name, $email, $gender, $dob, $address, $mobile_number)
    {
        $this->db->set('name', $name);
        $this->db->set('gender', $gender);
        $this->db->set('dob', $dob);
        $this->db->set('address', $address);
        $this->db->set('mobile_number', $mobile_number);

        $this->db->where('email', $email);
        $this->db->update('admin_info');
    }
    public function insert_category($category_name, $category_description)
    {
        $this->db->insert('product_categories', ['name'=>$category_name, 'description' =>$category_description]);
    }
    public function insert_subcategory($category_name, $subcategory_name, $category_description)
    {
        $this->db->insert('product_subcategories', ['pc_id'=>$category_name,'name'=>$subcategory_name, 'description' =>$category_description]);
    }
    public function insert_product($category_id, $subcategory_id, $product_name, $description, $image_name, $actual_price, $discount_in_percentage, $final_price, $seller_name, $brand_name)
    {
        $this->db->insert('product_information', ['pc_id'=>$category_id,'psc_id'=>$subcategory_id,'name'=>$product_name, 'description' =>$description,'image_name'=>$image_name,'actual_price'=>$actual_price,'discount_in_percentage'=>$discount_in_percentage,'final_price'=>$final_price,'seller_name'=>$seller_name,'brand_name'=>$brand_name]);
    }
    public function update_category($data, $pc_id)
    {
        $this->db->set($data);
        $this->db->where("pc_id", $pc_id);
        $this->db->update("product_categories", $data);
    }
    public function update_subcategory($data, $psc_id)
    {
        $this->db->set($data);
        $this->db->where("psc_id", $psc_id);
        $this->db->update("product_subcategories", $data);
    }

    public function get_categories()
    {
        $this->db->select('pc_id,name');
        $query = $this->db->get('product_categories');
        if ($query->num_rows() >= 1) {
            $data = $query->result();

            return $data;
        }
    }

    public function get_categories_select_box()
    {
        $query = $this->db->get('product_categories');
        if ($query->num_rows() >= 1) {
            foreach ($query->result_array() as $row) {
                $data[$row['pc_id']]=$row['name'];
            }

            return $data;
        }
    }

    public function get_allcategories_details()
    {
        $this->db->select('pc_id,name,description');
        $query=$this->db->get('product_categories');

        return $query;
    }


    public function get_allsubcategories_details()
    {
        $this->db->select('pc.name as pcn,psc.name ,psc_id,psc.description');
        $this->db->from('product_subcategories as psc');
        $this->db->join('product_categories as pc', 'psc.pc_id = pc.pc_id');
        $query = $this->db->get();

        return $query;
    }
    


    public function get_allproducts_details()
    {
        $this->db->select('pc.name as pcn,psc.name as pscn,pi.name ,p_id,pi.description,final_price,seller_name,image_name');
        $this->db->from('product_information as pi');
        $this->db->join('product_subcategories as psc', 'psc.psc_id = pi.psc_id', 'inner');
        $this->db->join('product_categories as pc', 'pc.pc_id = pi.pc_id', 'inner');
        $query = $this->db->get();

        return $query;
    }
    //fill your cities dropdown depending on the selected city
    public function getSubcategoriesByCategory($cat_id)
    {
        $this->db->select('psc_id,name');
        $this->db->from('product_subcategories');
        $this->db->where('pc_id', $cat_id);
        $query = $this->db->get();
        return $query->result();
    }
    public function get_subcategories()
    {
        $query = $this->db->get('product_subcategories');
        if ($query->num_rows() >= 1) {
            foreach ($query->result_array() as $row) {
                $data[$row['psc_id']]=$row['name'];
            }

            return $data;
        }
    }
}
