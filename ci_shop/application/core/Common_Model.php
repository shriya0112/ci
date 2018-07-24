<?php 

class Common_model extends CI_Model
{
    /**
    * Loads The Database
    */
    public function __construct()
    {
        $this->load->database();
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
    * Delete data from database
    * @param  string $table_name
    * @param  array $where_array
    */
    public function delete($table_name, $where_array)
    {
        $this->db->delete($table_name, $where_array);
    }
    /**
     * checks the uniqueness of email while update
     * @param  [string] $email [user email ]
     * @param  [type]  $user_id [id of the user ]
     * @return boolean          [either return true or false]
     */
    public function is_unique_email($email, $user_id)
    {
        $this->db->select('email');
        $this->db->where('email', $email);
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('user_info');
        $result_array = $query->result_array();
        if ($query->num_rows()>0) {
            //if user email and new email is same or not modified returns true  
            foreach ($result_array as $key) {
                # code...
                if ($key['email'] == $email) {
                    return true;
                }
            }
        } else {
            $this->db->select('email');
            $this->db->where('email', $email);
            $query = $this->db->get('user_info');
            //if email exists and belongs to someone else account return false
            if ($query->num_rows()>0) {
                return false;
            } else {
                return true;
            }
        }
    }
/**
 * [get_joins description]
 * @param  [type] $table   [description]
 * @param  [type] $columns [description]
 * @param  [type] $joins   [description]
 * @return [type]          [description]
 */
    public function get_joins($table, $columns, $joins)
{
    $this->db->select($columns)->from($table);
    if (is_array($joins) && count($joins) > 0)
    {
        foreach($joins as $k => $v)
        {
            $this->db->join($v['table'], $v['condition'], $v['jointype']);
        }
    }
    return $this->db->get()->result_array();
}
}
