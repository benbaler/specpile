<?php
/**
 * Description of users_m
 *
 * @author Ben
 */


class Users_m extends CI_Model {

    private $collection = 'users';

    /**
     * login user
     *
     * @param string  $p_email
     * @param string  $p_pass
     * @return array
     */
    public function login($p_data) {
        return $this->_get(array(
            'email' => $p_data['email'],
            'pass' => $this->_salt($p_data['pass'])
            ));
    }

    /**
     * register user
     *
     * @param string  $p_username
     * @param string  $p_email
     * @param string  $p_pass
     * @return boolean
     */
    public function register($p_data) {
        /* check if username or email already exists */
        if ($this->_exists($p_data['email'], 'email') == FALSE) {

            /* create new user */
            $this->_set(array(
                'first' => $p_data['first'],
                'last' => $p_data['last'],
                'email' => $p_data['email'],
                'pass' => $this->_salt($p_data['pass']),
                'role' => 'regular',
                'picture_url' => $this->get_gravatar($p_data['email'], 30),
                ));

            /*
             * TODO: user have to validate email
             */

            return TRUE;
        }

        return FALSE;
    }

    /**
     * check if email exists
     *
     * @param string  $p_email
     * @return boolean
     */
    public function check_if_email_exists($p_email) {
        return $this->_exists($p_email, 'email');
    }

    /**
     * retrive user object from users collection with specific values or key, value pair
     *
     * @param array   $p_values
     * @param string  $p_key
     * @return array
     */
    private function _get($p_values, $p_key = '_id') {
        if (is_array($p_values)) {
            return $this->mongo_db->where($p_values)
            ->get($this->collection);
        }
        return $this->mongo_db->where($p_key, $p_values)
        ->get($this->collection);
    }

    private function _set($p_values, $p_key = NULL) {
        return $this->mongo_db->insert($this->collection,
            is_array($p_values) ? $p_values : array($p_key => $p_values));
    }

    /**
     * check if values or key, value pair exists in users collection
     *
     * @param string  $p_values
     * @param string  $p_key
     * @return boolean
     */
    private function _exists($p_values, $p_key = '_id') {
        return count($this->_get($p_values, $p_key)) == 0 ? FALSE : TRUE;
    }

    /**
     * salting password and return its md5
     *
     * @param string  $p_pass
     * @return string
     */
    private function _salt($p_pass) {
        return md5($p_pass . 'salt');
    }           

    public function get_gravatar($p_email, $p_size){
        $default = 'https://fbcdn-profile-a.akamaihd.net/static-ak/rsrc.php/v2/yL/r/HsTZSDw4avx.gif';
        return "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $p_email ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $p_size;
    }

}

?>
