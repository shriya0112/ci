<?php 

/**
* Admin_Model
*
* @package
* @subpackage
* @category                Model
* @DateOfCreation          5 April 2018 11:29 AM
* @DateOfDeprecated
* @ShortDescription        contains method to check user is vaild or not
* @LongDescription
*/
class Admin_Model extends Common_Model
{
    /**
    * @DateOfCreation        5 April 2018 11:47 AM
    * @DateOfDeprecated
    * @ShortDescription      to check user is vaild or not
    * @LongDescription
    * @param1                 string  $email User Email
    * @param2                 string  $password User Password
    * @return                 boolean Either True or False
    */
    public function isValidUser($email, $password)
    {
        $this->db->select('email,password');
        $this->db->where('email', $email);
        $this->db->where('password', $password);
        $this->db->where('type', 'admin');
        $query = $this->db->get('user_info');
        if ($query->num_rows()==1) {
            return true;
        } else {
            return false;
        }
    }
}
