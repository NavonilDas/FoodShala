<?php
defined( 'BASEPATH' ) or exit( 'No direct script access allowed' );

class Orders extends CI_Controller {

	public function index() {
		$user = $this->session->userdata( 'user' );
		$role = $this->session->userdata( 'role' );

		if ( $user === null ) {
			redirect( '/login' );
			return true;
		}
		parse_str( $_SERVER['QUERY_STRING'], $_GET );
		$pgNo = isset( $_GET['page'] ) ? (int) $_GET['page'] : 0;
		$pgNo = ( $pgNo < 1 ) ? 1 : $pgNo;

		$this->load->model( 'OrderModel' );

		$data = array( 'orders' => array() );
		$data['page_no'] = $pgNo;
		
		if ( $role === 'Customer' ) {
			// View Customer
			$orders         = $this->OrderModel->getById( $user->id, $pgNo - 1 );
			$data['orders'] = $orders;
			
			$this->load->view( 'customer_orders', $data );
		} elseif ( $role === 'Resturant' ) {

		} else {
			redirect( '/401' );
		}

	}

	public function customer( $pgNo = 0 ) {
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
		$this->load->model( 'OrderModel' );
		$orders = $this->OrderModel->getById( $user->id, $pgNo );
		header( 'Content-Type: application/json' );
		echo json_encode( $orders );
	}

	public function resturant( $pgNo = 0 ) {
		$user = $this->session->userdata( 'user' );
		$role = $this->session->userdata( 'role' );

		if ( $user === null ) {
			redirect( '/login' );
			return true;
		}

		if ( $role !== 'Resturant' ) {
			redirect( '/401' );
			return true;
		}
		$this->load->model( 'OrderModel' );
		$orders = $this->OrderModel->getByResturnant( $user->id, $pgNo );
		header( 'Content-Type: application/json' );
		echo json_encode( $orders );
	}

	// public function

}
