<?php
defined( 'BASEPATH' ) or exit( 'No direct script access allowed' );

class Home extends CI_Controller {

	/**
	 */
	public function index() {
		$this->load->model( 'UserAuth' );
		$user = $this->session->userdata( 'user' );
		$role = $this->session->userdata( 'role' );

		$data = array(
			'role' => 'anonymous',
		);
		if ( $role !== null ) {
			$data['role'] = $role;
		}

		if ( $role === 'Resturant' ) {
			$this->load->view( 'resturant/resturant_menu', $data );
		} else {
			$this->load->view( 'customer/food_menu', $data );
		}
	}

	public function menu_items( $pgNo = 0 ) {
		$this->load->model( 'Menu' );
		header( 'Content-Type: application/json' );
		$user    = $this->session->userdata( 'user' );
		$user_id = ( $user !== null ) ? $user->id : null;
		echo json_encode( $this->Menu->getItems( $user_id, $pgNo ) );
	}
}
