<?php
defined( 'BASEPATH' ) or exit( 'No direct script access allowed' );

/**
 * Home Controller Class: Controller For the route /
 *
 * @version 0.1.0
 * @author Navonil Das
 */
class Home extends CI_Controller {

	/**
	 * Index Page For the route /.
	 *
	 * @return void
	 */
	public function index() {
		// Get User Data & Role
		$user = $this->session->userdata( 'user' );
		$role = $this->session->userdata( 'role' );

		// Set Default Role
		$data = array(
			'role' => 'anonymous',
		);

		// if role is present update role
		if ( $role !== null ) {
			$data['role'] = $role;
		}

		// if role is resturant then show resturant menu (Menu Created by the user)
		if ( $role === 'Resturant' ) {
			$this->load->view( 'resturant/resturant_menu', $data );
		} else {
			// Show all the Food items available
			$this->load->view( 'customer/food_menu', $data );
		}
	}

}
