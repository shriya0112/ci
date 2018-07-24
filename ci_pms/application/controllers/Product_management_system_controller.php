<?php 
class Product_management_system_controller extends CI_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url'); //Loading The Url helper to work with url
        $this->load->library('session'); //Initializes the session
        $this->load->database(); //Initializes the database
    }
/**
* [index description]
* @return [type] [description]
*/
public function index()
{
$this->load->library('form_validation'); // Initializes the form_validation library class
//Setting Rules for input fields by calling set_rules method of form_validation library class
$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
$this->form_validation->set_rules('password', 'Password', 'required|min_length[5]|max_length[10]');
//Applying Rules on input fields by calling run method of form_validation library class if rules are not properly validated display error messages
if ($this->form_validation->run() == false) {
    $data['title'] = 'Login Page';
//Loading login Form with error messages if data is not properly validated
    $this->load->view('templates/Header', $data);
    $this->load->view('templates/Header_top', $data);
    $this->load->view('pages/Login');
    $this->load->view('templates/Footer');
    $this->load->view('pages/cs_validation/Login_validate');
} else {
//Fetching values from post arrays if data is properly validated
    $email=$this->input->post('email');
    $password=md5($this->input->post('password'));
    /* Setting Rules With Callback Method To Check If UserName Exists*/
    $this->form_validation->set_rules('email', 'Email', 'required');
    $this->form_validation->set_rules('password', 'Password', 'required|max_length[10]|callback_user_valid', ['user_valid'=>'Email Or Password Is Incorrect']);
// Initialising the model class
    $this->load->model('Pms_model');
    if ($this->form_validation->run()== false) {
        $data['title'] = 'Login Page';
//loading Login Form with database related error messages
        $this->load->view('templates/Header', $data);
        $this->load->view('pages/Login');
    }
//Calling is_valid_user function from Pms_model class by providing email and password fetched from post array
    if ($user_valid=$this->Pms_model->is_valid_user($email, $password)) {
//If is_valid_user function returns true saving data to userdata array
        $userdata=array('email'=>$email,'password'=>$password);
//assigning userdata array to session variable by calling set_userdata method of session class to allow backward compatiblity
        $this->session->set_userdata($userdata);
//redirecting to home
        redirect('pms/home', 'refresh');
    }
}
}

/**
* [logout description]
* @return [type] [description]
*/
public function logout()
{
$this->session->sess_destroy(); // To destroy session
redirect('pms', 'refresh'); // Redirect to login page
}

/**
* [home description]
* @return [type] [description]
*/
public function home()
{
if (isset($this->session->email)) { //Checking Session Is Set Or Not
    $data['title'] = 'Home Page';
// Initializes the url helper class
    $this->load->view('templates/Header', $data);
    $this->load->view('templates/Header_bottom');
    $this->load->model('Pms_model');
    $data['categories'] = $this->Pms_model->get_categories();
    $data['products'] = $this->Pms_model->get_allproducts_details();
    $this->load->view('pages/Home', $data);
} else {
// if session is not set redirecting to login
    redirect('pms', 'refresh');
}
}
/* **********************************************************************************************************************************************************************
Category Related Methods
********************************************************************************************************************************************************************** */
public function add_category()
{
//Checking Session Is Set Or Not
    if (isset($_SESSION['email'])) {
        $data['title'] = 'Add Category Page';
// Initializes the url and form helper class
        $this->load->helper(['url','form']);
        $this->load->view('templates/Header', $data);
// Initializes the Form_validation library class
        $this->load->library('form_validation');
//Setting Validation Rules
        $this->form_validation->set_rules('name', 'Category Name', 'required|trim');
//Setting Error Message Element Location
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if ($this->form_validation->run() == false) {
//Loading add category Form with error messages if data is not properly validated
            $this->load->view('templates/Header_bottom');
            $this->load->view('pages/Add_category_view');
        } else {
            $category_name = strip_tags($this->input->post('name', true));
            $category_description = strip_tags($this->input->post('description', true));
            $this->form_validation->set_rules(
                'name',
                'Category Name',
                'required|callback_unique_category_name',
                ['unique_category_name'=>'Category Already Exists Please Try Again']
                );
            $this->load->model('Pms_model');
            if ($this->form_validation->run()== false) {
                $data['title'] = 'Add Category Page';

//loading Login Form with database related error messages
                $this->load->view('templates/Header', $data);
                $this->load->view('templates/Header_bottom');
                $this->load->view('pages/Add_category_view');
            }
            if ($unique_category_name=$this->Pms_model->is_unique_category($category_name)) {
                $this->Pms_model->insert_category($category_name, $category_description);
                redirect('pms/home', 'refresh');
            }
        }
    } else {
// if session is not set redirecting to login
        redirect('pms', 'refresh');
    }
}
public function update_category()
{
//Checking Session Is Set Or Not
    if (isset($_SESSION['email'])) {
        $data['title'] = 'Update Category';
// Initializes the url and form helper class
        $this->load->helper(['url','form']);
        $this->load->view('templates/Header', $data);
        $pc_id = $this->uri->segment('3');
        $this->db->select('pc_id,name,description');
        $query = $this->db->get_where("product_categories", array("pc_id"=>$pc_id));
        $data['records'] = $query->result();
        $data['pc_id'] = $pc_id;
// Initializes the Form_validation library class
        $this->load->library('form_validation');
//Setting Validation Rules
        $this->form_validation->set_rules('name', 'Category Name', 'required|trim');
//Setting Error Message Element Location
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if ($this->form_validation->run() == false) {
//Loading add category Form with error messages if data is not properly validated
            $this->load->view('templates/Header_bottom');
            $this->load->view('pages/Update_category_view', $data);
            $this->load->view('templates/Footer');
        } else {
            $this->db->select('pc_id,name,description');
            $query = $this->db->get_where("product_categories", array("pc_id"=>$pc_id));
            $data['records'] = $query->result();
            $data['pc_id'] = $pc_id;
            $category_name = strip_tags($this->input->post('name', true));
            $category_description = strip_tags($this->input->post('description', true));
            $this->form_validation->set_rules(
                'name',
                'Category Name',
                'required|callback_unique_category_name',
                ['unique_category_name'=>'Category Already Exists Please Try Again']
                );
            $this->load->model('Pms_model');
            if ($this->form_validation->run()== false) {
//loading Login Form with database related error messages
                $this->load->view('templates/Header');
                $this->load->view('templates/Header_bottom');
                $this->load->view('pages/Update_category_view', $data);
            }
            if ($unique_category_name=$this->Pms_model->is_unique_category($category_name)) {
                $data = array(
                    'name' => $category_name,
                    'description' => $category_description
                    );
                $this->Pms_model->update_category($data, $pc_id);
                redirect('pms/home', 'refresh');
            }
        }
    } else {
// if session is not set redirecting to login
        redirect('pms', 'refresh');
    }
}
// Method To Display User Details
public function show_all_categories()
{
    if (isset($_SESSION['email'])) {
        $this->load->library('table');
        $data['title'] = 'View Categories';
        $this->load->view('templates/Header', $data);
        $this->load->view('templates/Header_top');

//Loading add category Form with error messages if data is not properly validated
        $this->load->view('templates/Header_bottom');
        $this->load->view('pages/View_all_categories', array());
    } else {
//if session is not set redirecting to login
        redirect('pms', 'refresh');
    }
}
public function categories_data()
{
    if (isset($_SESSION['email'])) {
// Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $this->load->model('Pms_model');
        $categories = $this->Pms_model->get_allcategories_details();
        $data = array();
        foreach ($categories->result() as $r) {
            $nestedData=[];
            $nestedData[] = $r->name;
            $nestedData[] = $r->description;
            $nestedData[] ='<a href='.base_url('index.php/pms/cupdate/').$r->pc_id.'><button class="btn btn-success" ><span class="fa fa-pencil"></span></button></a>
            <a href='.base_url('index.php/pms/cupdate/').$r->pc_id.'><button class="btn btn-danger"><span class="fa fa-trash-o"></span></button></a>
            <a href='.base_url('index.php/pms/cupdate/').$r->pc_id.'><button class="btn btn-info" ><span class="fa fa-eye"></span></button></a>';
            $data[] = $nestedData;
        }
        $output = array(
            "draw" => $draw,
            "recordsTotal" => $categories->num_rows(),
            "recordsFiltered" => $categories->num_rows(),
            "data" => $data
            );

        echo json_encode($output);
        exit();
    } else {
    }
}
/*  **********************************************************************************************************************************************************************
Sub-Category Related Methods
********************************************************************************************************************************************************************** */
public function add_subcategory()
{
    if (isset($_SESSION['email'])) {
        $this->load->helper(['url','form']);
        $this->load->library('form_validation');
//Setting Validation Rules
        $this->form_validation->set_rules('pc_name', 'Category Name', 'required|is_natural_no_zero', ['is_natural_no_zero'=>'Please Select A Category']);
        $this->form_validation->set_rules('name', 'Sub-Category Name', 'required|trim');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Add Sub-Category';
            $this->load->view('templates/Header', $data);
            $this->load->view('templates/Header_bottom');
            $this->load->model('Pms_model');
            $data['product_categories']=$this->Pms_model->get_categories();
            $this->load->view('pages/Add_subcategory_view', $data);
        } else {
            $category_name = strip_tags($this->input->post('pc_name', true));
            $subcategory_name = strip_tags($this->input->post('name', true));
            $subcategory_description = strip_tags($this->input->post('description', true));
            $this->form_validation->set_rules(
                'name',
                'Sub-Category Name',
                'required|callback_unique_subcategory_name',
                ['unique_subcategory_name'=>'Sub-Category Already Exists Please Try Again']
                );
            $this->load->model('Pms_model');
            if ($this->form_validation->run()== false) {
//loading Login Form with database related error messages
                $this->load->view('templates/Header');
                $data['product_categories']=$this->Pms_model->get_categories();
                $this->load->view('pages/Add_subcategory_view', $data);
            }
            if ($unique_subcategory_name=$this->Pms_model->is_unique_subcategory($subcategory_name)) {
                $this->Pms_model->insert_subcategory($category_name, $subcategory_name, $subcategory_description);
                redirect('pms/home', 'refresh');
            }
        }
    } else {
// if session is not set redirecting to login
        redirect('pms', 'refresh');
    }
}
public function update_subcategory()
{
    if (isset($_SESSION['email'])) {
        $this->load->helper(['url','form']);
        $this->load->library('form_validation');
//Setting Validation Rules
        $this->form_validation->set_rules('pc_name', 'Category Name', 'required|is_natural_no_zero', ['is_natural_no_zero'=>'Please Select A Category']);
        $this->form_validation->set_rules('name', 'Sub-Category Name', 'required|trim');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Update Sub-Category';
            $this->load->view('templates/Header', $data);
            $psc_id = $this->uri->segment('3');
            $data['psc_id'] = $psc_id;

            $this->load->view('templates/Header_bottom');
            $this->load->model('Pms_model');
            $data['product_categories']=$this->Pms_model->get_categories();
            $this->load->view('pages/Update_subcategory_view', $data);
        } else {
            $psc_id = $this->uri->segment('3');
            $data['psc_id'] = $psc_id;
            $this->db->select('pc_id,name,description');
            $query = $this->db->get_where("product_subcategories", array("psc_id"=>$psc_id));
            $data['records'] = $query->result();
            $category_name = strip_tags($this->input->post('pc_name', true));
            $subcategory_name = strip_tags($this->input->post('name', true));
            $subcategory_description = strip_tags($this->input->post('description', true));
            $this->form_validation->set_rules('name', 'Sub-Category Name', 'required|callback_unique_subcategory_name', ['unique_subcategory_name'=>'Sub-Category Already Exists Please Try Again']);
            $this->load->model('Pms_model');
            if ($this->form_validation->run()== false) {
                $data['title'] = 'Update Sub-Category';
//loading Login Form with database related error messages
                $this->load->view('templates/Header', $data);
                $this->load->view('templates/Header_bottom');
                $data['product_categories']=$this->Pms_model->get_categories();
                $this->load->view('pages/Update_subcategory_view', $data);
            }
            if ($unique_subcategory_name=$this->Pms_model->is_unique_subcategory($subcategory_name)) {
                $data = array( 'pc_id' => $category_name, 'name' => $subcategory_name ,  'description' => $subcategory_description );
                $this->Pms_model->update_subcategory($data, $psc_id);
                redirect('pms/home', 'refresh');
            }
        }
    } else {
// if session is not set redirecting to login
        redirect('pms', 'refresh');
    }
}
public function buildSubcategoryByCategoryForHome($id)
{
//set selected country id from POST
    $category_id=$id;
    $this->load->model('Pms_model');
//run the query for the cities we specified earlier
    $data['product_subcategories']=$this->Pms_model->getSubcategoriesByCategory($category_id);
    $output = "<option value='0'>Select Sub-Category</option>";
    foreach ($data['product_subcategories'] as $row) {
        if ($row->psc_id > 0) {
//here we build a dropdown item line for each query result
            $output .= "<option value='".$row->psc_id."'>".$row->name."</option>";
        }
    }
    echo $output;
}

//call to fill the second dropdown with the subcategories
public function buildSubcategoryByCategory($id)
{
//set selected country id from POST
    $category_id=$id;
    $this->load->model('Pms_model');
//run the query for the cities we specified earlier
    $data['product_subcategories']=$this->Pms_model->getSubcategoriesByCategory($category_id);
    $output = "<option value='0'>Select Sub-Category</option>";
    foreach ($data['product_subcategories'] as $row) {
        if ($row->psc_id > 0) {
//here we build a dropdown item line for each query result
            $output .= "<option value='".$row->psc_id."'>".$row->name."</option>";
        }
    }
    echo $output;
}
// Method To Display All Sub-categories
public function show_all_subcategories()
{
    if (isset($_SESSION['email'])) {
        $this->load->library('table');
        $data['title'] = 'View Sub-Categories';
        $this->load->view('templates/Header', $data);
//Loading add category Form with error messages if data is not properly validated
        $this->load->view('templates/Header_bottom');
        $this->load->view('pages/View_all_subcategories', array());
    } else {
//if session is not set redirecting to login
        redirect('pms', 'refresh');
    }
}
public function subcategories_data()
{
    if (isset($_SESSION['email'])) {
// Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $this->load->model('Pms_model');
        $categories = $this->Pms_model->get_allsubcategories_details();
        $data = array();
        foreach ($categories->result() as $r) {
            $nestedData=[];
            $nestedData[] = $r->pcn;

            $nestedData[] = $r->name;
            $nestedData[] = $r->description;
            $nestedData[] ='<a href='.base_url('index.php/pms/scupdate/').$r->psc_id.'><button class="btn btn-success" ><span class="fa fa-pencil"></span></button></a>
            <a href='.base_url('index.php/pms/cupdate/').$r->psc_id.'><button class="btn btn-danger"><span class="fa fa-trash-o"></span></button></a>
            <a href='.base_url('index.php/pms/cupdate/').$r->psc_id.'><button class="btn btn-info" ><span class="fa fa-eye"></span></button></a>';
            $data[] = $nestedData;
        }
        $output = array(
            "draw" => $draw,
            "recordsTotal" => $categories->num_rows(),
            "recordsFiltered" => $categories->num_rows(),
            "data" => $data
            );
        echo json_encode($output);
        exit();
    } else {
    }
}
/* **********************************************************************************************************************************************************************
User-Profile Related Methods
********************************************************************************************************************************************************************** */
// Method To Display User Details
public function show_my_profile()
{
    if (isset($_SESSION['email'])) {
        $this->load->library('table');
        $data['title'] = 'My Profile';
        $this->load->view('templates/Header', $data);
//Loading add category Form with error messages if data is not properly validated
        $this->load->view('templates/Header_bottom');
        $this->load->view('pages/My_profile');
        $this->load->view('templates/Footer');
        $this->load->view('pages/cs_validation/CategoryTable_Validate.php');
    } else {
//if session is not set redirecting to login
        redirect('pms', 'refresh');
    }
}
// Method To Update User Profile
public function update_user_profile()
{
    if (isset($_SESSION['email'])) {
        $this->load->helper('form');
//Initializes the Form_validation library class
        $this->load->library('form_validation');
//Setting Validation Rules
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim');
        $this->form_validation->set_rules('gender', 'Gender', 'required|trim');
        $this->form_validation->set_rules('dob', 'Date of Birth', 'required|trim');
        $this->form_validation->set_rules('address', 'Address', 'required|trim');
        $this->form_validation->set_rules('mobile_number', 'Mobile Number', 'required|trim');
//Setting Error Message Element Location
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Update Profile';
            $this->load->view('templates/Header', $data);
//Loading add category Form with error messages if data is not properly validated
            $this->load->view('templates/Header_bottom');
            $this->load->view('pages/Update_profile');
            $this->load->view('templates/Footer');
            $this->load->view('pages/cs_validation/Profile_validate');
        } else {
            $name = strip_tags($this->input->post('name', true));
            $gender=strip_tags($this->input->post('gender', true));
            $dob = strip_tags($this->input->post('dob', true));
            $address=strip_tags($this->input->post('address', true));
            $mobile_number = strip_tags($this->input->post('mobile_number', true));
            $email=$this->session->email;
            $this->load->model('Pms_model');
            $this->Pms_model->update_profile($name, $email, $gender, $dob, $address, $mobile_number);
            redirect('pms/home', 'refresh');
        }
    } else {
//if session is not set redirecting to login
        redirect('pms', 'refresh');
    }
}
/* **********************************************************************************************************************************************************************
Product Related Methods
********************************************************************************************************************************************************************** */
public function add_product()
{
//Checking Session Is Set Or Not
    if (isset($_SESSION['email'])) {
//Initializes the url and form helper class
        $this->load->helper(['url','form']);
//Initializes the Form_validation library class
        $this->load->library('form_validation');
//Setting Validation Rules
        $this->form_validation->set_rules('name', 'Product Name', 'required|trim');
        $this->form_validation->set_rules('pc_name', 'Category Name', 'required|is_natural_no_zero', ['is_natural_no_zero'=>'Please Select Category']);
        $this->form_validation->set_rules('psc_name', 'Sub-Category Name', 'required|is_natural_no_zero', ['is_natural_no_zero'=>'Please Select Sub-Category']);
        $this->form_validation->set_rules('image_name1', 'Image Name', 'callback_do_upload');
        $this->form_validation->set_rules('actual_price', 'Actual Price', 'required|is_natural|trim');
        $this->form_validation->set_rules('discount_in_percentage', 'Discount Percentage', 'required|is_natural|trim');
        $this->form_validation->set_rules('brand_name', 'Brand Name', 'required|trim');
        $this->form_validation->set_rules('seller_name', 'Seller Name', 'required|trim');
//Setting Error Message Element Location
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Add Product';
//Loading add category Form with error messages if data is not properly validated
            $this->load->view('templates/Header', $data);
            $this->load->view('templates/Header_bottom');
            $this->load->model('Pms_model');
            $data['product_categories']=$this->Pms_model->get_categories_select_box();
            $this->load->view('pages/Add_product_view', $data);
//$this->load->view('templates/Footer');
//  $this->load->view('pages/cs_validation/Product_validate');
        } else {
            $category_id = strip_tags($this->input->post('pc_name', true));
            $subcategory_id = strip_tags($this->input->post('psc_name', true));
            $product_name = strip_tags($this->input->post('name', true));
            $description = strip_tags($this->input->post('description', true));
            $image_name = basename($_FILES["image_name1"]["name"]);
            $actual_price = strip_tags($this->input->post('actual_price', true));
            $discount_in_percentage = strip_tags($this->input->post('discount_in_percentage', true));
            $final_price = strip_tags($this->input->post('final_price', true));
            $seller_name = strip_tags($this->input->post('seller_name', true));
            $brand_name = strip_tags($this->input->post('brand_name', true));
            $this->load->model('Pms_model');
            $this->Pms_model->insert_product($category_id, $subcategory_id, $product_name, $description, $image_name, $actual_price, $discount_in_percentage, $final_price, $seller_name, $brand_name);
            redirect('pms/home', 'refresh');
        }
    } else {
//if session is not set redirecting to login
        redirect('pms', 'refresh');
    }
}
public function update_product()
{
//Initializes the url and form helper class
    $this->load->helper(['url','form']);

//Initializes the Form_validation library class
    $this->load->library('form_validation');
//Setting Validation Rules
    $this->form_validation->set_rules('name', 'Product Name', 'required|trim');
    $this->form_validation->set_rules('pc_name', 'Category Name', 'required|is_natural_no_zero', ['is_natural_no_zero'=>'Please Select Category']);
    $this->form_validation->set_rules('psc_name', 'Sub-Category Name', 'required|is_natural_no_zero', ['is_natural_no_zero'=>'Please Select Sub-Category']);
    $this->form_validation->set_rules('actual_price', 'Actual Price', 'required|is_natural|trim');
    $this->form_validation->set_rules('discount_in_percentage', 'Discount Percentage', 'required|is_natural|trim');
    $this->form_validation->set_rules('brand_name', 'Brand Name', 'required|trim');
    $this->form_validation->set_rules('seller_name', 'Seller Name', 'required|trim');
//Setting Error Message Element Location
    $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
    if ($this->form_validation->run() == false) {
        $data['title'] = 'Update Product';
//Loading add category Form with error messages if data is not properly validated
        $this->load->view('templates/Header', $data);
        $this->load->view('templates/Header_bottom');
        $this->load->model('Pms_model');
        $p_id = $this->uri->segment('3');
        $data['p_id'] = $p_id;
        $data['product_categories']=$this->Pms_model->get_categories();
        $this->load->view('pages/Update_product_view', $data);
    }
}

//Function to Verify And Upload Files Or Images Into The Directory
public function do_upload()
{
    $config['upload_path']          = './uploads/';
    $config['allowed_types']        = 'gif|jpg|png|jpeg';
    $config['max_size']             = 25000;
    $config['max_width']            = 2824;
    $config['max_height']           = 9666;
    $this->load->helper(['url','form']);
    $this->load->library('upload', $config);
    if (! $this->upload->do_upload('image_name1')) {
        $error = array('error' => $this->upload->display_errors());
        $this->form_validation->set_message('do_upload', $error['error']);
        return false;
    } else {
        $data = array('upload_data' => $this->upload->data());
        return true;
    }
}
public function show_all_products()
{
    if ($_SESSION['email']) {
        $data['title']="Show Product";
        $this->load->view('templates/Header', $data);
        $this->load->view('templates/Header_bottom');
        $this->load->view('pages/View_all_products', array());
    } else {
        redirect('pms', 'refresh');
    }
}
public function product_data()
{
    if (isset($_SESSION['email'])) {
// Datatables Variables
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $this->load->model('Pms_model');
        $products = $this->Pms_model->get_allproducts_details();
        $data = array();
        foreach ($products->result() as $r) {
            $nestedData=[];
            $nestedData[] = $r->pcn;
            $nestedData[] = $r->pscn;
            $nestedData[] = $r->name;
            $nestedData[] = $r->seller_name;
            $nestedData[] = $r->final_price;
            $nestedData[] ='<a href='.base_url('index.php/pms/pupdate/').$r->p_id.'><button class="btn btn-success" ><span class="fa fa-pencil"></span></button></a>
            <a href='.base_url('index.php/pms/cupdate/').$r->p_id.'><button class="btn btn-danger"><span class="fa fa-trash-o"></span></button></a>
            <a href='.base_url('index.php/pms/cupdate/').$r->p_id.'><button class="btn btn-info" ><span class="fa fa-eye"></span></button></a>';
            $data[] = $nestedData;
        }
        $output = array(
            "draw" => $draw,
            "recordsTotal" => $products->num_rows(),
            "recordsFiltered" => $products->num_rows(),
            "data" => $data
            );
        echo json_encode($output);
        exit();
    } else {
    }
}
}
