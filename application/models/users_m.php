<?php
/**
 * Description of users_m
 *
 * @author Ben
 */
class Users_m extends CI_Model {

    private $users_collection = 'users';

    public function __construct() {
        parent::__construct();

        $this->load->library('Mongo_db');
    }

    /**
     * login user
     * @param string $p_email
     * @param string $p_pass
     * @return array
     */
    public function login($p_email, $p_pass) {
        return $this->_get(array(
                    'email' => $p_email,
                    'pass' => $this->_salt($p_pass)));
    }

    /**
     * register user
     * @param string $p_username
     * @param string $p_email
     * @param string $p_pass
     * @return boolean
     */
    public function register($p_username, $p_email, $p_pass) {
        /* check if username or email already exists */
        if ($this->_exists(array(
                    'username' => $p_username,
                    'email' => $p_email)) == FALSE) {

            /* create new user */
            $this->_set(array(
                'username' => $p_username,
                'email' => $p_email,
                'pass' => $this->_salt($p_pass)));

            /*
             * TODO: user have to validate email
             */
            
            return TRUE;
        }

        return FALSE;
    }

    /**
     * check if email exists
     * @param string $p_email
     * @return boolean
     */
    public function check_if_email_exists($p_email) {
        return $this->_exists($p_email, 'email');
    }

    /**
     * check if username exists
     * @param string $p_username
     * @return boolean
     */
    public function check_id_username_exists($p_username) {
        return $this->_exists($p_username, 'username');
    }

    /**
     * retrive user object from users collection with specific values or key, value pair
     * @param array $p_values
     * @param string $p_key
     * @return array
     */
    private function _get($p_values /* can be an array or a string */, $p_key = '_id') {
        if (is_array($p_values)) {
            return $this->mongo_db->where($p_values)
                            ->get($this->users_collection);
        }
        return $this->mongo_db->where($p_key, $p_values)
                        ->get($this->users_collection);
    }

    private function _set($p_values, $p_key) {
            return $this->mongo_db->insert($this->users_collection, 
                    is_array($p_values) ? $p_values : array($p_key => $p_values));
    }

    /**
     * check if values or key, value pair exists in users collection
     * @param array $p_values
     * @param string $p_key
     * @return boolean
     */
    private function _exists($p_values /* can be an array or a string */, $p_key) {
        if (is_array($p_values)) {
            foreach ($p_values as $key => $value) {
                /* check if value was found */
                if (empty($this->_get($value, $key)) == FALSE) {
                    return TRUE;
                }
            }
        } else {
            /* check if value was found */
            return empty($this->_get($p_values, $p_key)) ? FALSE : TRUE;
        }

        return FALSE;
    }

    /**
     * salting password and return its md5
     * @param string $p_pass
     * @return string
     */
    private function _salt($p_pass) {
        return md5($p_pass . 'salt');
    }

}

?>
