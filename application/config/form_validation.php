<?php

$config = array(
    'login' => array(
        array(
            'field' => 'email',
            'rules' => 'required|valid_email|max_length[100]'
        ),
        array(
            'field' => 'pass',
            'rules' => 'required|min_length[4]|max_length[12]'
        )
    ),
    'register' => array(
        array(
            'field' => 'first',
            'rules' => 'required|min_length[2]|max_length[20]'
        ),
        array(
            'field' => 'last',
            'rules' => 'required|min_length[2]|max_length[20]'
        ),
        array(
            'field' => 'email',
            'rules' => 'required|valid_email|max_length[100]'
        ),
        array(
            'field' => 'pass',
            'rules' => 'required|min_length[4]|max_length[12]'
        )
    )
);
?>
