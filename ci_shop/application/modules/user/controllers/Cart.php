<?php 
class Cart extends MX_Controller
{
    /**
     * Constructor Function
     */
    public function __construct()
    {
        $this->load->helper(array('url','encryption'));
        //$this->output->enable_profiler(TRUE);
        $this->load->library('session');
        $this->load->model(array('User_Model','Cart_Model'));
    }
    /**
     * [index description]
     * @return [type] [description]
     */
    public function index()
    {
        //get user id with the help of email
        $result =$this->User_Model->select(['user_id'], 'user_info', ['email'=>$this->session->email]);
        //get value of user id from result array and save in variable
        foreach ($result as $key) {
            $user_id = $key['user_id'];
        }
        //specify joins
        $joins = array(array( 'table' => 'product_info', 'condition' => 'product_info.product_id = cart_info.product_id where user_id = \''.$user_id.'\'', 'jointype' => 'INNER'));
        //call method to get value from database by applying joins
        $data['result'] = $this->Cart_Model->get_joins('cart_info', ['user_id','description','product_info.product_id','cover_image','selling_price','name','cart_id','quantity'], $joins);
        $this->load->view('header');
        $this->load->view('navigation');
        //load cart view alongwith data
        $this->load->view('cart', $data);
        $this->load->view('footer');
    }
    /**
     * [add description]
     * @param string $product_id [description]
     */
    public function add($product_id = '')
    {
        //get user id to apply as a foreign key in cart info
        $result =$this->User_Model->select(['user_id'], 'user_info', ['email'=>$this->session->email]);
        foreach ($result as $key) {
            $user_id = $key['user_id'];
        }
        //decrypt product id to apply as a foreign key in cart info
        $product_id = $this->input->post('product_id')?aes256decrypt($this->input->post('product_id')):aes256decrypt($product_id);
        //on adding we set minimum quantity to 1
        $quantity = ($this->input->post('quantity')>0) ? $this->input->post('quantity'): 1;

        if($this->input->post('product_id'))
        {
            $this->Cart_Model->update('cart_info', ['user_id' =>$user_id, 'product_id' => $product_id,'quantity'=>$quantity],['user_id'=>$user_id,'product_id'=>$product_id]);
        }
        else if ($this->Cart_Model->insert('cart_info', ['user_id' =>$user_id, 'product_id' => $product_id,'quantity'=>$quantity])) {
            redirect('user/cart', 'refresh');
        }
    }
    /**
     * [delete description]
     * @return [type] [description]
     */
    public function delete()
    {
        $product_id = $this->input->post('product_id')?aes256decrypt($this->input->post('product_id')):'';
        $result =$this->User_Model->select(['user_id'], 'user_info', ['email'=>$this->session->email]);
        foreach ($result as $key) {
            $user_id = $key['user_id'];
        }
        $this->Cart_Model->delete('cart_info',['user_id'=>$user_id,'product_id'=>$product_id]);
    }
}
