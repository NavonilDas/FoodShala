<?php
defined( 'BASEPATH' ) or exit( 'No direct script access allowed' );

class Cart extends CI_Controller {

	private function _only_for_customer() {
		$user = $this->session->userdata( 'user' );
		$role = $this->session->userdata( 'role' );

		if ( $user === null ) {
			redirect( '/login' );
			return true;
		}

		if ( $role !== 'Customer' ) {
			redirect( '/401' );
			return true;
		}
		return $user;
	}

	/**
	 */
	public function add( $food_id = -1 ) {
		$user = $this->_only_for_customer();

		if ( $user === true ) {
			return;
		}

		$this->load->model( 'CartModel' );
		$cart = array(
			'food_id'  => $food_id,
			'user_id'  => $user->id,
			'quantity' => 1,
		);
		$this->CartModel->create( $cart );
		redirect( '/' );
	}

	function delete( $id = -1 ) {
		$user = $this->_only_for_customer();

		if ( $user === true ) {
			return;
		}

		echo $id;
	}

	function quantity( $id = -1, $val = -1 ) {
		if ( $id == -1 || $val == -1 ) {
			redirect( '/cart/view' );
			return;
		}

		$user = $this->_only_for_customer();

		if ( $user === true ) {
			return;
		}
		$this->load->model( 'CartModel' );
		$this->CartMode->changeQuantity( $user->id, $id, $val );
	}

	/**
	 */
	public function view() {
		$user = $this->_only_for_customer();

		if ( $user === true ) {
			return;
		}

		$this->load->model( 'CartModel' );
		$data         = array();
		$data['cart'] = $this->CartModel->get( $user->id );

		$this->load->view( 'view_cart', $data );

	}
}
