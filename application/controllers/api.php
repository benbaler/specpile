<?php

if ( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

$post = json_decode( file_get_contents( 'php://input' ), TRUE );

if ( count( $_POST ) == 0 && count( $post ) > 0 ) {
    $_POST = $post;
}

require APPPATH.'libraries/REST_Controller.php';


class Api extends REST_Controller {

    /**
     * [user_get description]
     *
     * @return [type] [description]
     */


    public function user_get() {
        if ( !$this->get( 'id' ) ) {
            $this->response( $this->_error( 'User is not valid' ), 400 );
        }
        $this->load->model( 'users_m' );
        $user = $this->users_m->getUserById( $this->get( 'id' ) );
        if ( $user ) {
            $this->response( $user, 200 ); // 200 being the HTTP response code
        }
        else {
            $this->response( $this->_error( 'User not exists' ), 404 );
        }
    }

    /**
     * [user_post description]
     *
     * @return [type] [description]
     */
    public function user_post( $p_action ) {
        switch ( $p_action ) {
        case 'login' :  $this->_userLogin();
            break;
        case 'signup' :  $this->_userSignup();
            break;
        }

        $this->response( $this->_error( 'Action is not valid' ), 404 );
    }

    public function user_put() {
    }

    public function users_get() {
        $this->load->model( 'users_m' );
        $users = $this->users_m->getAll();
        if ( $users ) {
            $this->response( $users, 200 );
        }
        else {
            $this->response( NULL, 404 );
        }
    }

    public function categories_get() {
        $this->load->model( 'categories_m' );
        $categories = $this->categories_m->get_all();
        if ( $categories ) {
            $this->response( $categories, 200 );
        }
        else {
            $this->response( NULL, 404 );
        }
    }

    public function product_get() {
        $this->load->model( 'icecat_m' );

        $product = $this->icecat_m->getProductById( $this->get( 'id' ) );

        if ( $product ) {

            $product['name'] = ucwords($product['name']);
            $product['company'] = ucwords($product['company']);
            $product['category'] = ucwords($product['category']);

            $feaures = array();

            foreach($product['features'] as $specs){
                foreach ($specs as $spec => $option) {
                    $features[ucwords($spec)] = ucwords($option);
                }
            }

            //$product['features'] = $features;

            $this->response( $product, 200 );
        }
        else {
            $this->response( $this->_error( 'No results' ), 404 );
        }
    }

    // add product
    public function product_post() {
        // TODO: user must be logged in to add a product
        // TODO: user authorizations for adding categories, brands etc.

        $this->load->library( 'form_validation' );

        if ( $this->form_validation->run( 'addProduct' ) == TRUE ) {

            $this->load->model( array( 'categories_m', 'brands_m', 'products_m' ) );
            $userId = $this->session->userdata( 'id' );

            $categoryId = $this->categories_m->addCategoryByName( trim( $this->post( 'category' ) ), $userId );
            $brandId = $this->brands_m->addBrandByName( trim( $this->post( 'brand' ) ), $userId );
            $productId = $this->products_m->addProductByName( trim( $this->post( 'product' ) ), $categoryId, $brandId, $userId );

            $this->response( array( 'id' => $productId ), 200 );
        }

        $this->response( $this->_error( 'Fields are not valid' ), 404 );
    }

    public function products_get() {
        $this->load->model( 'icecat_m' );

        $category = $this->get( 'category' ) ? array( $this->get( 'category' ) ) : array( 'smartphones', 'tablets', 'cameras' );
        
        $products = $this->icecat_m->getProductsByQueryAndLimit( urldecode( str_replace( '/\s+/', '.*', $this->get( 'term' ) ) ) , 20, $category );
        // echo $this->get('term');
        // echo str_replace( '+', '.*', urldecode($this->get( 'term' ) ) );
        // $products = $this->icecat_m->getProductsByQueryAndLimit( urldecode( str_replace( '+', '\+', $this->get( 'term' ) ) ) , 20, $category );
        // $products = $this->icecat_m->getProductsByQueryAndLimit( $this->_str_replace($this->get( 'term' )) , 20, $category );

        if ( $products ) {
            $names = array();

            foreach ( $products as $product ) {
                $names[$product['_id']->__toString()] = $product['name'];
            }

            $names = array_unique( $names );
            $keys = array_keys( $names );

            $results = array();

            foreach ( $products as $product ) {
                if ( in_array( $product['_id']->__toString(), $keys ) ) {
                    $results[] = array(
                        'label' => $product['name'],
                        'image' => $this->icecat_m->getImageByIdAndUrl( $product['_id']->__toString(), $product['image'] )
                    );
                }
            }

            $this->response( array_slice( $results, 0, 10 ), 200 );
        }
        else {
            $this->response( $this->_error( 'No results' ), 404 );
        }
    }

    public function search_get() {
        $this->load->model( 'icecat_m' );

        $products = $this->icecat_m->getProductsByQueryAndLimit( urldecode( str_replace( '/\s+/', '.*', $this->get( 'query' ) ) ), 5000 );
        // $products = $this->icecat_m->getProductsByQueryAndLimit( $this->_str_replace( $this->get( 'query' ) ), 5000 );

        if ( $products ) {
            $results = array();
            foreach ( $products as $product ) {

                $flag = false;

                foreach ( $results as $p ) {
                    if ( $p['name'] == ucwords( character_limiter( $product['name'], 15 ) ) ) {
                        $flag = true;
                    }
                }

                if ( $flag == false ) {
                    $results[] = array(
                        '_id' => $product['_id']->__toString(),
                        'name' => ucwords( character_limiter( $product['name'], 15 ) ),
                        'category_name' => ucwords( $product['category'] ),
                        'brand_name' => ucwords( $product['company'] ),
                        'image' => $this->icecat_m->getImageByIdAndUrl( $product['_id']->__toString(), $product['image'] )
                    );
                }
            }

            $results = array_slice( $results, 0, 100 );

            $this->response( $results, 200 );
        } else {
            $this->response( $this->_error( 'No results' ), 404 );
        }

        // $this->load->model('products_m');
        // if ($this->get('query')) {
        //     $results = $this->products_m->getProductsByQuery($this->get('query'));
        //     // foreach ($results as $i => &$arr) {
        //     //     foreach ($arr as $j => &$value) {
        //     //         if ($j == '_id') {
        //     //             $arr['id'] = (string)$value;
        //     //         }
        //     //     }
        //     // }
        //     //$results = array(array('id' => 1, 'name' => 'iPhone', 'category_id' => 1, 'brand_id' => 1),array('id' => 2, 'name' => 'iPhone', 'category_id' => 1, 'brand_id' => 1));

        //     if (is_array($results)) {
        //         $this->response($results, 200);
        //     }
        //     else {
        //         $data = array(
        //             'error' => array(
        //                 'message' => 'no results for your query',
        //                 'type' => 'search',
        //                 'code' => '1'
        //             )
        //         );

        //         $this->response($data, 404);
        //     }
        // } else {
        //     $data = array(
        //         'error' => array(
        //             'message' => 'query is not valid',
        //             'type' => 'search',
        //             'code' => '2'
        //         )
        //     );

        //     $this->response($data, 404);
        // }
    }

    public function option_post() {
        if ( $this->get( 'action' ) == 'product' ) {
            $this->load->library( 'form_validation' );

            if ( $this->form_validation->run( 'addOptionProduct' ) == TRUE ) {
                $this->load->model( array( 'products_m', 'options_m' ) );

                $userId = $this->session->userdata( 'id' );

                $specId = $this->post( 'spec_id' );
                $productId = $this->post( 'product_id' );

                $product = $this->products_m->getProductById( $productId );

                if ( !$product ) {
                    $this->response( $this->_error( 'Product is not valid' ), 404 );
                }

                $optionId = $this->options_m->addOptionByName( trim( $this->post( 'name' ) ), $specId, $userId );

                $this->products_m->addOptionById( $optionId, $productId, $userId );

                $this->response( array( '_id' => $optionId ), 200 );
            }

            $this->response( $this->_error( 'Fields are not valid' ), 404 );
        }

        if ( $this->get( 'action' ) == 'spec' ) {
            $this->response( 'success', 200 );
        }

        $this->response( $this->_error( 'Action is not valid' ), 404 );

    }




    public function option_put() {
        if ( $this->get( 'action' ) == 'product' ) {
            // TODO: fix put!!!

            $this->load->library( 'form_validation' );

            if ( $this->form_validation->run( 'addOptionProduct' ) == TRUE ) {
                $this->load->model( array( 'products_m', 'options_m' ) );

                $userId = $this->session->userdata( 'id' );

                $specId = $this->input->post( 'spec_id' );
                $productId = $this->input->post( 'product_id' );
                $optionId = $this->get( 'id' );

                $product = $this->products_m->getProductById( $productId );

                if ( !$product ) {
                    $this->response( $this->_error( 'Product is not valid' ), 404 );
                }

                $option = $this->options_m->getOptionById( $optionId );

                if ( !$option ) {
                    $this->response( $this->_error( 'Option is not valid' ), 404 );
                }

                $this->products_m->addOptionById( $optionId, $productId, $userId );

                $this->response( array( '_id' => $optionId ), 200 );
            }

            $this->response( $this->_error( 'Fields are not valid' ), 404 );
        }

        if ( $this->get( 'action' ) == 'spec' ) {
            $this->response( 'success', 200 );
        }

        $this->response( $this->_error( 'Action is not valid' ), 404 );
    }










    public function spec_post() {
        $this->load->library( 'form_validation' );

        if ( $this->form_validation->run( 'addSpec' ) == TRUE ) {
            $this->load->model( array( 'specs_m', 'categories_m' ) );

            $userId = $this->session->userdata( 'id' );
            $categoryId = $this->post( 'category_id' );

            $category = $this->categories_m->getCategoryById( $categoryId );

            if ( !$category ) {
                $this->response( $this->_error( 'Category is not valid' ), 404 );
            }

            $specId = $this->specs_m->addSpecByName( trim( $this->post( 'name' ) ), $categoryId, $userId );

            $this->categories_m->addSpecById( $specId, $categoryId, $userId );

            $this->response( array( '_id' => $specId ), 200 );
        }

        $this->response( $this->_error( 'Fields are not valid' ), 404 );

    }







    public function spec_put() {
        if ( $this->get( 'action' ) == 'product' ) {
            $this->load->library( 'form_validation' );

            if ( $this->form_validation->run( 'updateSpecProduct' ) == TRUE ) {
                $this->load->model( array( 'specs_m', 'categories_m' ) );

                $userId = $this->session->userdata( 'id' );
                $categoryId = $this->input->post( 'category_id' );
                $specId = $this->get( 'id' );

                $category = $this->categories_m->getCategoryById( $categoryId );

                if ( !$category ) {
                    $this->response( $this->_error( 'Category is not valid' ), 404 );
                }

                $spec = $this->specs_m->getSpecByIdAndCategoryId( $specId, $categoryId );

                if ( !$spec ) {
                    $this->response( $this->_error( 'Specification is not valid' ), 404 );
                }

                $this->specs_m->updateSpecName( trim( $this->input->post( 'name' ) ), $specId, $userId );

                $this->response( array( '_id' => $specId ), 200 );
            }

            $this->response( $this->_error( 'Fields are not valid' ), 404 );
        }

        $this->response( $this->_error( 'Action is not valid' ), 404 );
    }











    private function _productNewOption() {
        $this->response( 'success', 200 );
    }




    private function _error( $p_msg ) {
        return array(
            'error' => array(
                'message' => $p_msg
            )
        );
    }

    private function _userLogin() {
        $this->load->model( array( 'users_m' ) );
        $this->load->library( 'form_validation' );

        if ( $this->form_validation->run( 'login' ) == TRUE ) {
            $email = trim( strtolower( $this->post( 'email' ) ) );
            $pass = $this->post( 'pass' );

            $user = $this->users_m->login( $email, $pass );

            if ( $user ) {
                $this->users_m->setSession( $user );
                $this->response( array( 'success' => true ), 200 );
            } else {
                $this->response( $this->_error( 'Email and password combination are not match' ), 404 );
            }
        }

        $this->response( $this->_error( 'Field are not valid' ), 404 );
    }

    private function _userSignup() {
        $this->load->model( array( 'users_m' ) );
        $this->load->library( 'form_validation' );

        if ( $this->form_validation->run( 'register' ) == TRUE ) {
            $first = trim( ucfirst( $this->post( 'first' ) ) );
            $last = trim( ucfirst( $this->post( 'last' ) ) );
            $email = trim( strtolower( $this->post( 'email' ) ) );
            $pass = $this->post( 'pass' );

            $success = $this->users_m->register( $first, $last, $email, $pass );

            if ( $success ) {
                $this->response( array( 'success' => true ), 200 );

            } else {
                $this->response( $this->_error( 'Email is already exists' ), 404 );
            }
        }

        $this->response( $this->_error( 'Fields are not valid' ), 404 );
    }

    public function schem_get() {
        ini_set( 'memory_limit', '1024M' );

        if ( in_array( $this->get( 'category' ), array( 'smartphones', 'tablets', 'cameras' ) ) ) {
            $category = $this->get( 'category' );

            $this->load->model( 'icecat_m' );


            if ( file_exists( 'temp/'.$category.'/template.html' ) ) {
                $arr = unserialize( file_get_contents( 'temp/'.$category.'/template.html' ) );
            }

            if ( !isset( $arr ) ) {
                $arr = $this->icecat_m->getTemplateByCategory( $category );
                file_put_contents( 'temp/'.$category.'/template.html', serialize( $arr ) );
            }

            foreach ( $arr as &$specs ) {
                foreach ( $specs as &$options ) {
                    usort( $options, array( $this, '_compareRef' ) );
                }
            }

            $this->response( $arr, 200 );


        } else {

        }
        $this->response( $this->_error( 'No schem for this category' ), 404 );
    }

    private function _compareRef( $a, $b ) {
        return strnatcmp( $a, $b );
    }























    public function compare_get() {
        $this->load->model( array( 'icecat_m' ) );

        $p1 = $this->icecat_m->getProductByNameAndCategory( urldecode( $this->get( 'product1' ) ), array( $this->get( 'category' ) ) );
        $p2 = $this->icecat_m->getProductByNameAndCategory( urldecode( $this->get( 'product2' ) ), array( $this->get( 'category' ) ) );

        if ( $p1 && $p2 ) {
            $arr = $this->_compare( $p1['_id']->__toString(), $p2['_id']->__toString(), $this->get( 'category' ) );
            //$arr = array($p1,$p2);
            $this->response( $arr, 200 );
        } else {
            $this->response( $this->_error( 'No products found to compare' ), 404 );
        }
    }

    private function _compare( $id1, $id2, $category = 'smartphones' ) {
        ini_set( 'memory_limit', '1024M' );


        $this->load->model( 'icecat_m' );


        if ( file_exists( 'temp/'.$category.'/template.html' ) ) {
            $arr = unserialize( file_get_contents( 'temp/'.$category.'/template.html' ) );
        }

        if ( !isset( $arr ) ) {
            $arr = $this->icecat_m->getTemplateByCategory( $category );
            file_put_contents( 'temp/'.$category.'/template.html', serialize( $arr ) );
        }

        $product1 = $this->icecat_m->getProductById($id1);
        $product2 = $this->icecat_m->getProductById($id2);

        $data = array(
            'product1_id' => $product1['_id']->__toString(),
            'product1_name' => $product1['name'],
            'product1_category' => $product1['category'],
            'product1_company' => $product1['company'],
            'product1_image' => $this->icecat_m->getImageByIdAndUrl( $product1['_id']->__toString(), $product1['image'] ),

            'product2_id' => $product2['_id']->__toString(),
            'product2_name' => $product2['name'],
            'product2_category' => $product2['category'],
            'product2_company' => $product2['company'],
            'product2_image' => $this->icecat_m->getImageByIdAndUrl( $product2['_id']->__toString(), $product2['image'] ),

            'features' => array()
        );


        foreach ( $arr as $feature => $specs ) {
            if ( isset( $product1['features'][$feature] ) || isset( $product2['features'][$feature] ) ) {
                $data['features'][$feature] = array();
            }

            foreach ( $specs as $spec => $options ) {
                usort( $options, array( $this, '_compareRef' ) );


                if ( isset( $product1['features'][$feature][$spec] ) || isset( $product2['features'][$feature][$spec] ) ) {
                    $data['features'][$feature][$spec] = array();

                    $options1 = $options2 = array();

                    if ( isset( $product1['features'][$feature][$spec] ) ) {
                        if ( !is_array( $product1['features'][$feature][$spec] ) ) {
                            $data['features'][$feature][$spec][] = array( 'option' => $product1['features'][$feature][$spec], 'color' => $this->_color( array_search( $product1['features'][$feature][$spec], $options ), count( $options ) ), 'rating' => $this->_rating( array_search( $product1['features'][$feature][$spec], $options ), count( $options ) ) );
                        } else {
                            $options1 = $product1['features'][$feature][$spec];
                        }
                    } else {
                        $data['features'][$feature][$spec][] = array( 'option' => '-', 'color' => 'whitesmoke', 'rating' => 20 );
                    }

                    if ( isset( $product2['features'][$feature][$spec] ) ) {
                        if ( !is_array( $product2['features'][$feature][$spec] ) ) {
                            $data['features'][$feature][$spec][] = array( 'option' => $product2['features'][$feature][$spec], 'color' => $this->_color( array_search( $product2['features'][$feature][$spec], $options ), count( $options ) ), 'rating' => $this->_rating( array_search( $product2['features'][$feature][$spec], $options ), count( $options ) ) );
                        } else {
                            $options2 = $product2['features'][$feature][$spec];
                        }
                    } else {
                        $data['features'][$feature][$spec][] = array( 'option' => '-', 'color' => 'whitesmoke', 'rating' => 20 );
                    }

                    $this->_options( $options, $options1, $options2, $data['features'][$feature][$spec] );

                }

            }
        }

        return $data;

    }

    private function _rating( $p_pos, $p_count ) {
        $p_count = $p_count == 1 ? 2 : $p_count;
        $percentage = $p_pos * ( 1/( $p_count-1 ) );

        return $percentage > 0.2 ? round($percentage,2) * 100 : 20;
    }


    private function _color( $p_pos, $p_count ) {
        $p_count = $p_count == 1 ? 2 : $p_count;
        $percentage = $p_pos * ( 1/( $p_count-1 ) );

        // echo $percentage.'<br/>';

        if ( $percentage < 0.5 ) {
            // echo floor( 255 * $percentage * 2 ).'<br/>';
            $color = 'rgb(255,'.floor( 255 * $percentage * 2 ).',0)';
        }else {
            // echo floor( 255 * ( $percentage * 2 - 1 ) ).'<br/>';
            $color = 'rgb('.( 255 - floor( 255 * ( $percentage * 2 - 1 ) ) ).',255,0)';
        }

        return $color;
    }

    private function _options( $options, $options1, $options2, &$arr ) {
        $o1 = $o2 = array();
        foreach ( $options as $key => $option ) {
            if ( in_array( $option, $options1 ) || in_array( $option, $options2 ) ) {
                if ( in_array( $option, $options1 ) ) {
                    $o1[] =  array( 'option' => $option, 'color' => $this->_color( count( $options1 )-1, count( $options ) ) , 'rating' => $this->_rating( count( $options1 )-1, count( $options ) ) );
                } else {
                    $o1[] = array( 'option' => '-', 'color' => 'whitesmoke', 'rating' => '20' );
                }

                if ( in_array( $option, $options2 ) ) {
                    $o2[] =  array( 'option' => $option, 'color' => $this->_color( count( $options2 )-1, count( $options ) ) , 'rating' => $this->_rating( count( $options2 )-1, count( $options ) ) );
                } else {
                    $o2[] = array( 'option' => '-', 'color' => 'whitesmoke', 'rating' => '20'  );
                }
            }
        }
        if ( count( $options1 ) > 0 )
            $arr[] = $o1;
        if ( count( $options2 ) > 0 )
            $arr[] = $o2;
    }

    private function _str_replace($p_str)
    {
        // $from = array(
        //     '(', ')', '+','"'
        // );

        // $to = array(
        //     '.*', '.*', '.*', '\"'
        // );

        // // die(str_replace($from, $to, html_entity_decode(urldecode($p_str))));
        // return str_replace($from, $to, html_entity_decode(urldecode($p_str)));
        return html_entity_decode(urldecode($p_str));
    }
}

?>
