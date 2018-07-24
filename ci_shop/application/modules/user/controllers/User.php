<?php 
/**
 *
 */
class User extends MX_Controller
{
    /**
     * Constructor Function
     */
    public function __construct()
    {
        $this->load->helper(array('url','encryption'));
        //  $this->output->enable_profiler(TRUE);
        $this->load->library('session');
        $this->load->model('User_Model');
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
            redirect('user/home', 'refresh');
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
                $this->load->view('loginform');
            } else {
                //Fetching values from post arrays if data is properly validated
                $email=$this->input->post('email');
                $password=sha1($this->input->post('password'));
                //Calling is_valid_user function from Pms_model class by providing email and password fetched from post array
                if ($user_valid=$this->User_Model->isValidUser($email, $password)) {
                    //If is_valid_user function returns true saving data to userdata array
                    $userdata=array('email'=>$email,'password'=>$password);
                    //assigning userdata array to session variable by calling set_userdata method of session class to allow backward compatiblity
                    $this->session->set_userdata($userdata);
                    //redirecting to home
                    redirect('user/home', 'refresh');
                } else {
                    // Set message
                    $this->session->set_flashdata('loginFailed', 'Email Or Password Is Incorrect');
                    redirect('user');
                }
            }
        }
    }

    /**
     * [home description]
     * @return [type] [description]
     */
    public function home()
    {
        if (!isset($this->session->email)) {
            redirect('user', 'refresh');
        } else {
            $data['title'] = "HOME";
            $data['product_info'] = $this->User_Model->select(['product_id','name','description','price','cover_image','selling_price'], 'product_info');
            
            $this->load->view('header', $data);

        $this->load->view('navigation');
            $this->load->view('shop', $data);
            $this->load->view('footer');
        }
    }
    /**
     * [logout description]
     * @return [type] [description]
     */
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('user');
    }
    
}
