<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends MX_Controller
{

/**
* Index Page for this controller.
*
* Maps to the following URL
*       http://example.com/index.php/welcome
*   - or -
*       http://example.com/index.php/welcome/index
*   - or -
* Since this controller is set as the default controller in
* config/routes.php, it's displayed at http://example.com/
*
* So any other public methods not prefixed with an underscore will
* map to /index.php/welcome/<method_name>
* @see https://codeigniter.com/user_guide/general/urls.html
*/
    public function __construct()
    {
        $this->load->model('User_model');
        $this->load->library('session');
        $this->load->helper(array('url','encryption'));
    }
    /**
   
    * Show List Of Users
    */
    public function index()
    {
        $table_name = "users";
        $array = array('id','name','email','mobile_number');
        $data['user_info'] = $this->User_model->select($array, $table_name);
        $data['title']="User Information";
        $this->load->view('templates/header', $data);
        $this->load->view('user_info', $data);
        $this->load->view('templates/footer');
    }
    /**
    * Display update user information form and update user info in database on successfull submit of form
    * @param  string $user_id [User Encrypted Id]
    */
    public function addOrUpdateData($user_id = '')
    {
        $this->load->helper('form');
        $data['user_id'] = $user_id;
        $data['user_info'] = [];

        if ($user_id != '') {
            $data['title']="Update User";
            $array = array('id','name','email','mobile_number');
            $table_name = "users";
            $where_array = array('id' => aes256decrypt($user_id));
            $data['user_info'] = $this->User_model->select($array, $table_name, $where_array);
        } else {
            $data['title'] = 'Add User';
        }

        if ($this->validateUserData($user_id) == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('update_user', $data);
            $this->load->view('templates/footer');
        } else {
            $name = $this->input->post('name');
            $email = $this->input->post('email');
            $mobileNumber = $this->input->post('mobileNumber');
            if ($user_id=='') {
                $table_name = "users";
                $password = $this->input->post('password');
                $insert_array = [ 'name' => $name, 'email' => $email,'password' => sha1($password),'mobile_number' => $mobileNumber ];
                $this->User_model->insert($table_name, $insert_array);
            } else {
                $table_name = "users";
                $update_array = ['name' => $name,'email'=>$email,'mobile_number' => $mobileNumber ];
                $where_array = array('id' => aes256decrypt($user_id));
                $user_id = aes256decrypt($user_id);
                if($is_unique_email = $this->User_model->is_unique_email($email,$user_id))
                {
            
                    $this->User_model->update($table_name, $update_array, $where_array);
                    redirect('user');
                }
                else
                {  
        
                    $this->session->set_flashdata('error', 'Email Already Exists');
                    redirect('user/addOrUpdateData/'.aes256encrypt($user_id));
                }
                
            }
        }
    }
    /**
    * Delete user information from dataBase
    * @param  string $user_id [User Encrypted Id]
    */
    public function delete($user_id = '')
    {
        $table_name = "users";
        $where_array = array('id' => aes256decrypt($user_id) );
        $this->User_model->delete($table_name, $where_array);
        redirect('user');
    }
    /**
    * Show User data From Database
    * @param  string $user_id [User Encrypted Id]
    */
    public function showUserData($user_id = '')
    {
        $array = array('id','name','email','mobile_number');
        $table_name = "users";
        $where_array = array('id' => aes256decrypt($user_id) );
        $data['user_info'] = $this->User_model->select($array, $table_name, $where_array);
        $this->load->view('templates/header', $data);
        $this->load->view('view_user', $data);
        $this->load->view('templates/footer');
    }

    /**
    * [validateFiels description]
    * @param  [type] $user_id [description]
    * @return [type]          [description]
    */
    public function validateUserData($user_id)
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Name', 'required');
        if ($user_id == '') :
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'required', array('required' => 'You must provide a %s.'));
        $this->form_validation->set_rules('confirmPassword', 'Password Confirmation', 'required');
        else:
       $this->form_validation->set_rules('email', 'Email','required|valid_email');
        endif;
        $this->form_validation->set_rules('mobileNumber', 'Mobile Number', 'required');

        if ($this->form_validation->run() == false) {
            return false;
        } else {
            return true;
        }
    }
   
}
