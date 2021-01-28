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

		$data            = array( 'orders' => array() );
		$data['page_no'] = $pgNo;

		if ( $role === 'Customer' ) {
			// View Customer
			$orders         = $this->OrderModel->getById( $user->id, $pgNo - 1 );
			$data['orders'] = $orders;

			$this->load->view( 'customer/customer_orders', $data );
		} elseif ( $role === 'Resturant' ) {
			$data['orders'] = array();
			$status         = isset( $_GET['status'] ) ? $_GET['status'] : 'Pending';
			$data['status'] = $status;
			$orders         = $this->OrderModel->getByResturnant( $user->id, $pgNo - 1, $status );
			$data['orders'] = $orders;

			$this->load->view( 'resturant/resturant_orders', $data );

		} else {
			// Show Unauthorized Message if user is not defined
			$err_msg = 'You don\'t Have permission to access this resource. To Visit Home <a href="' . base_url() . '">Click Here</a>';
			show_error( $err_msg, 401, 'Unauthorized Access' );
		}

	}

	public function status( $id = -1, $status = 'Pending' ) {
		$user = $this->session->userdata( 'user' );
		$role = $this->session->userdata( 'role' );

		if ( $user === null ) {
			redirect( '/login' );
			return true;
		}

		$this->load->model( 'OrderModel' );
		$ret = $this->OrderModel->setStatus( $user->id, $id, $status );

		if ( $ret === 401 ) {
			// Show Unauthorized Message if user is not the creator
			$err_msg = 'You don\'t Have permission to access this resource. To Visit Home <a href="' . base_url() . '">Click Here</a>';
			show_error( $err_msg, 401, 'Unauthorized Access' );
		} else {
			redirect( '/orders' );
		}

	}
	/*
	// Following Code is REST API for fetching orders
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
	*/

}
