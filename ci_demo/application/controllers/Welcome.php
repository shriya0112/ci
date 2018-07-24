<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url','form'));
        $this->load->database();
        $this->load->library('session');
    }
    /**
    * @DateOfCreation
    * @DateOfDeprecated
    * @ShortDescription    Loading the login form
    * @LongDescription
    */
    public function login()
    {
        if (isset($this->session->email)) {
            redirect('welcome/myaccount', 'refresh');
        } else {
            $this->load->view('includes/header');
            $this->load->view('pages/loginform');
        }
    }
    /**
    * @DateOfCreation
    * @DateOfDeprecated
    * @ShortDescription    Handling the submit event on login form
    * @LongDescription
    */
    public function loginSubmit()
    {
        if (isset($this->session->email)) {
            redirect('welcome/myaccount', 'refresh');
        } else {
            if ($this->loginValidate() == false) {
                $this->load->view('includes/header');
                $this->load->view('pages/loginform');
            } else {
                //Fetching values from post arrays if data is properly validated
                $email=$this->input->post('email');
                $password=sha1($this->input->post('password'));
                $this->load->model('User_Model');
                //Calling is_valid_user function from Pms_model class by providing email and password fetched from post array
                if ($user_valid=$this->User_Model->isValidUser($email, $password)) {
                    $this->session->email = $email;
                    redirect('welcome/myaccount', 'refresh');
                } else {
                    // Set message
                    $this->session->set_flashdata('loginFailed', 'Email Or Password Is Incorrect');
                    redirect('welcome/login');
                }
            }
        }
    }
    /**
    * @DateOfCreation     16-July-2018
    * @DateOfDeprecated
    * @ShortDescription   Validate the login form
    * @LongDescription
    */
    public function loginValidate()
    {
        if (isset($this->session->email)) {
            redirect('welcome/myaccount', 'refresh');
        } else {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'required', array('required' => 'You must provide a %s.'));
            if ($this->form_validation->run() == false) {
                return false;
            } else {
                return true;
            }
        }
    }
    /**
    * @DateOfCreation     16-July-2018
    * @DateOfDeprecated
    * @ShortDescription   Load the register form
    * @LongDescription
    */
    public function register()
    {
        if (isset($this->session->email)) {
            redirect('welcome/myaccount', 'refresh');
        } else {
            $this->load->view('includes/header');
            $this->load->view('pages/registerform');
        }
    }
    /**
    * @DateOfCreation     16-July-2018
    * @DateOfDeprecated
    * @ShortDescription   Validate the register form
    * @LongDescription
    */
    public function registerValidate()
    {
        if (isset($this->session->email)) {
            redirect('welcome/myaccount', 'refresh');
        } else {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('firstname', 'First Name', 'required');
            $this->form_validation->set_rules('lastname', 'Last Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
            $this->form_validation->set_rules('password', 'Password', 'required', array('required' => 'You must provide a %s.'));
            $this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required|matches[password]');
            if ($this->form_validation->run() == false) {
                return false;
            } else {
                return true;
            }
        }
    }
    /**
    * @DateOfCreation     16-July-2018
    * @DateOfDeprecated
    * @ShortDescription   Handling the submit event on register form
    * @LongDescription
    */
    public function registerSubmit()
    {
        if (isset($this->session->email)) {
            redirect('welcome/myaccount', 'refresh');
        } else {
            if ($this->registerValidate() == false) {
                $this->load->view('includes/header');
                $this->load->view('pages/registerform');
            } else {
                //Fetching values from post arrays if data is properly validated
                $firstname = $this->input->post('firstname');
                $lastname = $this->input->post('lastname');
                $email=$this->input->post('email');
                $password=sha1($this->input->post('password'));
                $this->load->model('User_Model');
                //If is_valid_user function returns true saving data to userdata array
                $userdata=array('firstname'=>$firstname,'lastname'=>$lastname,'email'=>$email,'password'=>$password);
                if ($this->User_Model->insert('users', $userdata)) {
                    $this->session->set_userdata($userdata);
                    //redirecting to home
                    redirect('welcome/myaccount', 'refresh');
                } else {
                    // Set message
                    $this->session->set_flashdata('loginFailed', 'Email Or Password Is Incorrect');
                    redirect('welcome/login');
                }
            }
        }
    }
    /**
    * @DateOfCreation     16-July-2018
    * @DateOfDeprecated
    * @ShortDescription   This function destroy the session and redirect to login
    * @LongDescription
    */
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('welcome/login');
    }
    /**
    * @DateOfCreation     16-July-2018
    * @DateOfDeprecated
    * @ShortDescription   This function shows change password form
    * @LongDescription
    */
    public function changePassword()
    {
        if (!isset($this->session->email)) {
            redirect('welcome/login', 'refresh');
        } else {
            $this->load->view('includes/header');
            $this->load->view('includes/navigation');
            $this->load->view('pages/changepasswordform');
        }
    }
    /**
    * @DateOfCreation     16-July-2018
    * @DateOfDeprecated
    * @ShortDescription   Handling the submit event on change password form
    * @LongDescription
    */
    public function changePasswordSubmit()
    {
        if (!isset($this->session->email)) {
            redirect('welcome/login', 'refresh');
        } else {
            if ($this->changePasswordValidate() == false) {
                $this->load->view('includes/header');
                $this->load->view('includes/navigation');
                $this->load->view('pages/changepasswordform');
            } else {
                $email = $this->session->email;
                $password = sha1($this->input->post('oldpassword'));
                $this->load->model('User_Model');
                if ($user_valid=$this->User_Model->isValidUser($email, $password)) {
                    $newpassword = sha1($this->input->post('newpassword'));
                    $update_array=array('password'=>$newpassword);
                    $where_array= array('email'=>$email);

                    $this->User_Model->update('users', $update_array, $where_array);
                    redirect('welcome/myaccount', 'refresh');
                } else {
                    $this->session->set_flashdata('changePasswordFailed', 'Password Is Incorrect');
                    redirect('welcome/changePassword');
                }
            }
        }
    }
    /**
    * @DateOfCreation     16-July-2018
    * @DateOfDeprecated
    * @ShortDescription   This function validates change password form
    * @LongDescription
    */
    public function changePasswordValidate()
    {
        if (!isset($this->session->email)) {
            redirect('welcome/login', 'refresh');
        } else {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('oldpassword', 'Old Password', 'required', array('required' => 'You must provide a %s.'));
            $this->form_validation->set_rules('newpassword', 'Password', 'required', array('required' => 'You must provide a %s.'));
            $this->form_validation->set_rules('newpassconf', 'Password Confirmation', 'trim|required|matches[newpassword]');
            if ($this->form_validation->run() == false) {
                return false;
            } else {
                return true;
            }
        }
    }
    /**
    * @DateOfCreation     16-July-2018
    * @DateOfDeprecated
    * @ShortDescription   This function define myaccount details and myaccount update functionality
    * @LongDescription
    */
    public function myaccount()
    {
        if (!isset($this->session->email)) {
            redirect('welcome/login', 'refresh');
        } else {
            $this->load->view('includes/header');
            $this->load->view('includes/navigation');
            $this->load->model('User_Model');
            $email = $this->session->email;
            $data['myaccountdetails'] = $this->User_Model->select(['firstname','lastname','email'], 'users', ['email'=>$email]);
            $this->load->view('pages/myaccount', $data);
            $this->load->view('includes/footer');
        }
    }
    /**
    * @DateOfCreation     16-July-2018
    * @DateOfDeprecated
    * @ShortDescription   Handling the submit event on myaccount details
    * @LongDescription
    */
    public function myaccountSubmit()
    {
        if (!isset($this->session->email)) {
            redirect('welcome/login', 'refresh');
        } else {
            if ($this->myaccountValidate() == false) {
                $this->load->view('includes/header');
                $this->load->view('includes/navigation');
                $this->load->model('User_Model');
                $email = $this->session->email;
                $data['myaccountdetails'] = $this->User_Model->select(['firstname','lastname','email'], 'users', ['email'=>$email]);

                $this->load->view('pages/myaccount', $data);
                $this->load->view('includes/footer');
            } else {
                $email = $this->session->email;
                //Fetching values from post arrays if data is properly validated
                $firstname=$this->input->post('firstname');
                $lastname=$this->input->post('lastname');
                $this->load->model('User_Model');
                $update_array=array('firstname'=>$firstname,'lastname'=>$lastname);
                $where_array= array('email'=>$email);
                $this->session->set_userdata(array('firstname'=>$firstname,'lastname'=>$lastname,'email'=>$email));
                $this->User_Model->update('users', $update_array, $where_array);
                //redirecting to home
                redirect('welcome/myaccount', 'refresh');
            }
        }
    }
    /**
     * @DateOfCreation     16-July-2018
     * @DateOfDeprecated
     * @ShortDescription   This function validates myaccount details
     * @LongDescription
     */
    public function myaccountValidate()
    {
        if (!isset($this->session->email)) {
            redirect('welcome/login', 'refresh');
        } else {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('firstname', 'First Name', 'required');
            $this->form_validation->set_rules('lastname', 'Last Name', 'required');
            if ($this->form_validation->run() == false) {
                return false;
            } else {
                return true;
            }
        }
    }

}
