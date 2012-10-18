<?php

$config = array(
    'login' => array(
        array(
            'field' => 'email',
            'rules' => 'required|valid_email|max_length[100]'
        ),
        array(
            'field' => 'pass',
            'rules' => 'required|min_length[6]|max_length[20]'
        )
    ),
    'signup' => array(
        array(
            'field' => 'username',
            'rules' => 'required'
        ),
        array(
            'field' => 'password',
            'rules' => 'required'
        ),
        array(
            'field' => 'passconf',
            'rules' => 'required'
        ),
        array(
            'field' => 'email',
            'rules' => 'required'
        )
    )
);
?>
