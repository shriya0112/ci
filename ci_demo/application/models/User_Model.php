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
class User_Model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }
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
        $this->db->where('is_deleted', '1');
        $query = $this->db->get('users');
        if ($query->num_rows()==1) {
            return true;
        } else {
            return false;
        }
    }
    /**
    * Insert data into database
    * @param  string $table_name
    * @param  array  $insert_array [key value pair to be inserted]
    */
    public function insert($table_name, $insert_array = [])
    {
        return $this->db->insert($table_name, $insert_array);
    }
    /**
    * Update data into database
    * @param  string $table_name
    * @param  array  $update_array [key value pair to be updated]
    * @param  array $where_array
    */
    public function update($table_name, $update_array = [], $where_array = [])
    {
        $this->db->where($where_array);
        return $this->db->update($table_name, $update_array);
    }
    /**
    * Select data from database
    * @param  array  $array
    * @param  string $table_name
    * @return Result Object
    */
    public function select($array = [], $table_name, $where_array = [])
    {
        $this->db->select($array);
        $this->db->where($where_array);
        $query = $this->db->get($table_name);
        return $query->result_array();
    }
   
}
