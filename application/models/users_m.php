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
    public function login($p_email, $p_pass) {
        return current($this->_get(array(
                    'email' => $p_email,
                    'pass' => $this->_salt($p_pass)
                )));
    }

    /**
     * register user
     *
     * @param string  $p_username
     * @param string  $p_email
     * @param string  $p_pass
     * @return boolean
     */
    public function register($p_first, $p_last, $p_email, $p_pass) {
        if ($this->getUserByEmail($p_email)) {
            return FALSE;
        } else {
            $datetime = $this->mongo_db->date();

            /* create new user */
            $this->_set(array(
                    'first' => $p_first,
                    'last' => $p_last,
                    'email' => $p_email,
                    'pass' => $this->_salt($p_pass),
                    'role' => 'regular',
                    'picture_url' => $this->getGravatar($p_email, 30),
                    'active' => true,
                    'validated' => false,

                    'version' => $datetime,
                    'history' => array(
                        array(
                            'version' => $datetime,
                            'first' => $p_first,
                            'last' => $p_last,
                            'email' => $p_email,
                            'pass' => $this->_salt($p_pass),
                            'role' => 'regular',
                            'picture_url' => $this->getGravatar($p_email, 30),
                            'active' => true,
                            'validated' => false
                        )
                    )


                ));

            /*
             * TODO: user have to validate email
             */

            return TRUE;
        }
    }

    public function getUserById($p_id) {
        return current($this->_get($p_id));
    }

    public function getUserByEmail($p_email) {
        return current($this->_get(array('email' => $p_email)));
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
        return $this->mongo_db->where($p_key, new MongoId($p_values))
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

    public function getGravatar($p_email, $p_size) {
        $default = 'http://www.smore.com/s/images/default-profile-large.jpg';
        return "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $p_email ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $p_size;
    }

    public function setSession($p_userData) {
        $data = array(
            'id' => $p_userData['_id'],
            'first' => $p_userData['first'],
            'last' => $p_userData['last'],
            'email' => $p_userData['email'],
            'role' => $p_userData['role'],
            'picture_url' => $p_userData['picture_url'],
            'logged_in' => TRUE,
            'active' => $p_userData['active'],
            'validated' => $p_userData['validated']
        );

        $this->session->set_userdata($data);

    }
}

?>
