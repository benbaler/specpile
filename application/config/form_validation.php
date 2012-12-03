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
    ),
    'addProduct' => array(
        array('field' => 'category',
              'rules' => 'required|min_length[1]|max_length[50]'
        ),
        array('field' => 'brand',
              'rules' => 'required|min_length[1]|max_length[50]'
        ),
        array('field' => 'product',
              'rules' => 'required|min_length[1]|max_length[50]'
        )
    ),
    'addSpec' => array(
        array('field' => 'name',
              'rules' => 'required|min_length[1]|max_length[50]'
        ),
        array('field' => 'category_id',
              'rules' => 'required|length[24]'
        )
    ),
    'addOptionProduct' => array(
        array('field' => 'name',
              'rules' => 'required|min_length[1]|max_length[50]'
        ),
        array('field' => 'spec_id',
              'rules' => 'required|length[24]'
        ),
        array('field' => 'product_id',
              'rules' => 'required|length[24]'
        )
    )
);
?>
