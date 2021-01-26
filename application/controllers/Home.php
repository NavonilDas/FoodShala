<?php
defined( 'BASEPATH' ) or exit( 'No direct script access allowed' );

class Home extends CI_Controller {

	/**
	 */
	public function index() {
		$this->load->model( 'UserAuth' );
		$user = $this->session->userdata( 'user' );
		$data = array(
			'role' => 'anonymous',
		);
		if ( $user !== null ) {
			$type = $this->UserAuth->getUserRole( $user->id );
			if ( $type !== null ) {
				$data['role'] = $type->type;
			}
		}
		if ( $data['role'] === 'Resturant' ) {
			echo 'x';
		} else {
			$this->load->view( 'food_menu', $data );
		}
	}
}
