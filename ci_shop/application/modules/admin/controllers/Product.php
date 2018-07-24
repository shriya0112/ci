<?php 
/**
* Product Controller
*/
class Product extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url','encryption'));
        $this->load->library('session');
        $this->load->model('Product_Model');
    }
    /**
     * @DateOfCreation     1-July-2018
     * @DateOfDeprecated
     * @ShortDescription   Show Product List
     * @LongDescription
     */
    public function index()
    {
        $table_name = "product_info";
        $array = array('product_id','name','description','price','discount','selling_price');
        $data['product_info'] = $this->Product_Model->select($array, $table_name);
        $data['title']="Product List";
        $this->load->view('header', $data);
        $this->load->view('navigation');
        $this->load->view('products/productList', $data);
    }
    /**
     * @DateOfCreation     1-July-2018
     * @DateOfDeprecated
     * @ShortDescription   Add product to the database if id not specified otherwise update code
     * @LongDescription
     * @param string $product_id
     */
    public function AddOrUpdateProduct($product_id = '')
    {
        $this->load->helper('form');
        $data['product_id'] = $product_id;
        $data['product_info'] = [];
        if ($product_id != '') {
            $data['title']="Update Product Details";
            $array = array('product_id','name','description','price','discount','selling_price');
            $table_name = "product_info";
            $where_array = array('product_id' => aes256decrypt($product_id));
            $data['product_info'] = $this->Product_Model->select($array, $table_name, $where_array);
        } else {
            $data['title'] = 'Add Product Details';
        }

        if ($this->validateProductData($product_id) == false) {
            $this->load->view('header', $data);
            $this->load->view('navigation');
            $this->load->view('products/addOrUpdateProduct', $data);
            $this->load->view('footer');
            $this->load->view('cs_validation/Product_validate', $data);
        } else {
            $name = $this->input->post('name');
            $price = $this->input->post('price');
            $discount = $this->input->post('discount');
            $final_price = $price - ($price * $discount/100);
            if (isset($product_id)&& $product_id!='') {
                $table_name = 'product_info';
                $update_array = ['name' => $name,'price'=>$price,'discount'=>$discount,'selling_price'=>$final_price];
                $where_array=['product_id' => aes256decrypt($product_id)];
                if ($this->Product_Model->update($table_name, $update_array, $where_array)) {
                    redirect('admin/product/');
                }
            } else {
                $table_name = 'product_info';
                $insert_array = ['name' => $name,'price'=>$price,'discount'=>$discount,'selling_price'=>$final_price];
                if ($this->Product_Model->insert($table_name, $insert_array)) {
                    redirect('admin/product/');
                }
            }
        }
    }
    /**
     * @DateOfCreation     1-July-2018
     * @DateOfDeprecated
     * @ShortDescription   Delete the product from database
     * @LongDescription
     * @param string $product_id
     */
    public function DeleteProductData($product_id = '')
    {
        $table_name = "product_info";
        $where_array = array('product_id' => aes256decrypt($product_id) );
        $this->Product_Model->delete($table_name, $where_array);
        redirect('admin/product/ShowProductList');
    }
    /**
     * @DateOfCreation     1-July-2018
     * @DateOfDeprecated
     * @ShortDescription   Show product from the database of the product id specified
     * @LongDescription
     * @param string $product_id
     */
    public function ShowProductData($product_id = '')
    {
        $array = array('product_id','name','description','price','discount','selling_price');
        $table_name = "product_info";
        $where_array = array('product_id' => aes256decrypt($product_id) );
        $data['product_info'] = $this->Product_Model->select($array, $table_name, $where_array);
        $this->load->view('header', $data);
        $this->load->view('navigation');
        $this->load->view('products/viewSingleProductInfo', $data);
        $this->load->view('footer');
    }
    /**
     * @DateOfCreation     1-July-2018
     * @DateOfDeprecated
     * @ShortDescription   Validate the product form
     * @LongDescription
     * @param  string $user_id [User Encrypted Id]
     * @return [boolean]       [true or false]
     */
    public function validateProductData($product_id)
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('price', 'Price', 'trim|required|numeric');
        $this->form_validation->set_rules('discount', 'Discount', 'trim|required|numeric|greater_than[0]|less_than[100]');
        if ($this->form_validation->run() == false) {
            return false;
        } else {
            return true;
        }
    }
}
