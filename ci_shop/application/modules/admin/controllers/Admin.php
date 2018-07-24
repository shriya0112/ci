<?php 
/**
 * Admin Class
 *
 * @package
 * @subpackage
 * @category
 * @DateOfCreation    1-July-2018
 * @DateOfDeprecated
 * @ShortDescription
 * @LongDescription   This class manages user at admin access level
 */
class Admin extends MX_Controller
{
    public function __construct()
    {
        $this->load->helper(array('url','encryption'));
        $this->load->database();
        $this->load->library('session');
        $this->load->model('Admin_Model');
    }
    /**
     * @DateOfCreation     1-July-2018
     * @DateOfDeprecated
     * @ShortDescription   This function checks the login credentials and after successful authentication redirects to home page
     * @LongDescription
     */
    public function index()
    {
        if (isset($this->session->email)) {
            redirect('admin/home', 'refresh');
        } else {
            //Loading The form helper
            $this->load->helper('form');
            // Initializes the form_validation library class
            $this->load->library('form_validation');
            //Setting Rules for input fields by calling set_rules method of form_validation library class
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'required');

            if ($this->form_validation->run() == false) {
                $data['title'] = 'Login Page';
                //Loading login Form with error messages if data is not properly validated
                $this->load->view('header', $data);
                $this->load->view('pages/loginform');
            //  $this->load->view('footer');
            } else {
                //Fetching values from post arrays if data is properly validated
                $email=$this->input->post('email');
                $password=sha1($this->input->post('password'));
                //Calling is_valid_user function from Pms_model class by providing email and password fetched from post array
                if ($user_valid=$this->Admin_Model->isValidUser($email, $password)) {
                    //If is_valid_user function returns true saving data to userdata array
                    $userdata=array('email'=>$email,'password'=>$password);
                    //assigning userdata array to session variable by calling set_userdata method of session class to allow backward compatiblity
                    $this->session->set_userdata($userdata);
                    //redirecting to home
                    redirect('admin/home', 'refresh');
                } else {
                    // Set message
                    $this->session->set_flashdata('loginFailed', 'Email Or Password Is Incorrect');
                    redirect('admin');
                }
            }
        }
    }
    /**
     * @DateOfCreation     1-July-2018
     * @DateOfDeprecated
     * @ShortDescription   Displays The Admin Dashboard
     * @LongDescription
     */
    public function home()
    {
        if (isset($this->session->email)) {
            $data['title'] = 'Admin Dashboard';
            $this->load->view('header', $data);
            $this->load->view('navigation');
        } else {
            redirect('admin');
        }
    }
    /**
     * @DateOfCreation     1-July-2018
     * @DateOfDeprecated
     * @ShortDescription   This function destroys the current session and redirects to login page
     * @LongDescription
     */
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('admin/');
    }
    /**
     * @DateOfCreation     1-July-2018
     * @DateOfDeprecated
     * @ShortDescription   This function displays the list of all availble user
     * @LongDescription
     */
    public function showuserlist()
    {
        $table_name = "user_info";
        $array = array('user_id','name','email','mobile_number');
        $data['user_info'] = $this->Admin_Model->select($array, $table_name);
        $data['title']="User Information";
        $this->load->view('header', $data);
        $this->load->view('navigation');
        $this->load->view('user_info', $data);
        $this->load->view('footer');
    }
    /**
     * @DateOfCreation     1-July-2018
     * @DateOfDeprecated
     * @ShortDescription   Display form for updating data if id availble other form for data insertion is displayed
     * @LongDescription
     * @param string $user_id [description]
     */
    public function addOrUpdateData($user_id = '')
    {
        $this->load->helper('form');
        $data['user_id'] = $user_id;
        $data['user_info'] = [];

        if ($user_id != '') {
            $data['title']="Update User";
            $array = array('user_id','name','email','mobile_number');
            $table_name = "user_info";
            $where_array = array('user_id' => aes256decrypt($user_id));
            $data['user_info'] = $this->Admin_Model->select($array, $table_name, $where_array);
        } else {
            $data['title'] = 'Add User';
        }

        if ($this->validateUserData($user_id) == false) {
            $this->load->view('header', $data);
            $this->load->view('navigation');
            $this->load->view('update_user', $data);
            $this->load->view('footer');
        } else {
            $name = $this->input->post('name');
            $email = $this->input->post('email');
            $mobileNumber = $this->input->post('mobileNumber');
            if ($user_id=='') {
                $table_name = "user_info";
                $password = $this->input->post('password');
                $insert_array = [ 'name' => $name, 'email' => $email,'password' => sha1($password),'mobile_number' => $mobileNumber ];
                $this->Admin_Model->insert($table_name, $insert_array);
                redirect('admin/showuserlist');
            } else {
                $table_name = "user_info";
                $update_array = ['name' => $name,'email'=>$email,'mobile_number' => $mobileNumber ];
                $where_array = array('user_id' => aes256decrypt($user_id));
                $user_id = aes256decrypt($user_id);
                if ($is_unique_email = $this->Admin_Model->is_unique_email($email, $user_id)) {
                    $this->Admin_Model->update($table_name, $update_array, $where_array);
                    redirect('admin/showuserlist');
                } else {
                    $this->session->set_flashdata('error', 'Email Already Exists');
                    redirect('admin/addOrUpdateData/'.aes256encrypt($user_id));
                }
            }
        }
    }
    /**
     * @DateOfCreation     1-July-2018
     * @DateOfDeprecated
     * @ShortDescription    Delete user information from dataBase
     * @LongDescription
     * @param  string $user_id [User Encrypted Id]
     */
    public function delete($user_id = '')
    {
        $table_name = "user_info";
        $where_array = array('user_id' => aes256decrypt($user_id) );
        $this->Admin_Model->delete($table_name, $where_array);
        redirect('admin/showuserlist');
    }
    /**
     * @DateOfCreation     1-July-2018
     * @DateOfDeprecated
     * @ShortDescription   Show User data From Database
     * @LongDescription
     * @param  string $user_id [User Encrypted Id]
     */
    public function showUserData($user_id = '')
    {
        $array = array('user_id','name','email','mobile_number');
        $table_name = "user_info";
        $where_array = array('user_id' => aes256decrypt($user_id) );
        $data['user_info'] = $this->Admin_Model->select($array, $table_name, $where_array);
        $this->load->view('header', $data);
        $this->load->view('navigation');
        $this->load->view('view_user', $data);
        $this->load->view('footer');
    }
    /**
     * @DateOfCreation     1-July-2018
     * @DateOfDeprecated
     * @ShortDescription   Validate the user form
     * @LongDescription
     * @param  string $user_id [User Encrypted Id]
     * @return [boolean]       [true or false]
     */
    public function validateUserData($user_id)
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Name', 'required');
        if ($user_id == '') :
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[user_info.email]');
        $this->form_validation->set_rules('password', 'Password', 'required', array('required' => 'You must provide a %s.'));
        $this->form_validation->set_rules('confirmPassword', 'Password Confirmation', 'required'); else:
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        endif;
        $this->form_validation->set_rules('mobileNumber', 'Mobile Number', 'required');

        if ($this->form_validation->run() == false) {
            return false;
        } else {
            return true;
        }
    }
}
