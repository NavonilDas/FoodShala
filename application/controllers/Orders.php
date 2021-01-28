<?php
defined( 'BASEPATH' ) or exit( 'No direct script access allowed' );

/**
 * Orders Controller Class: For the /order route
 *
 * @version 0.1.0
 * @author Navonil Das
 */
class Orders extends CI_Controller {

	/**
	 * Get The list of orders different for both customer and resturant.
	 *
	 * @return void
	 */
	public function index() {
		// Get user and role from session
		$user = $this->session->userdata( 'user' );
		$role = $this->session->userdata( 'role' );

		// unregistered user redirect to login
		if ( $user === null ) {
			redirect( '/login' );
			return true;
		}

		// Parse the Query String
		parse_str( $_SERVER['QUERY_STRING'], $_GET );

		// Get the page number from query parameter of url.
		$pgNo = isset( $_GET['page'] ) ? (int) $_GET['page'] : 0;
		$pgNo = ( $pgNo < 1 ) ? 1 : $pgNo;

		// Load Model
		$this->load->model( 'OrderModel' );

		// Set the data that needs to be sent to view
		$data            = array( 'orders' => array() );
		$data['page_no'] = $pgNo;

		// Depending upon role change the view
		if ( $role === 'Customer' ) {
			// View Customer

			// Get The list of orders, Ordered by customer.
			$orders         = $this->OrderModel->getById( $user->id, $pgNo - 1 );
			$data['orders'] = $orders;

			// Show the customer orders page
			$this->load->view( 'customer/customer_orders', $data );
		} elseif ( $role === 'Resturant' ) {
			// Get the order status from query parameter.
			$status         = isset( $_GET['status'] ) ? $_GET['status'] : 'Pending';
			$data['status'] = $status;

			// Get Orders which came for the resturant.
			$orders         = $this->OrderModel->getByResturnant( $user->id, $pgNo - 1, $status );
			$data['orders'] = $orders;

			// Show Resturant Orders page.
			$this->load->view( 'resturant/resturant_orders', $data );

		} else {
			// For other users.
			// Show Unauthorized Message if user is not defined
			$err_msg = 'You don\'t Have permission to access this resource. To Visit Home <a href="' . base_url() . '">Click Here</a>';
			show_error( $err_msg, 401, 'Unauthorized Access' );
		}

	}

	/**
	 * Update the status of the order by resturant.
	 *
	 * @param int $id Order Id.
	 * @param string $status Order Status.
	 *
	 * @return void
	 */
	public function status( $id = -1, $status = 'Pending' ) {
		// Get User role and user object from session.
		$user = $this->session->userdata( 'user' );
		$role = $this->session->userdata( 'role' );

		// if user is not logged in or is not a resturant redirect to login.
		if ( $user === null || $role !== 'Resturant') {
			redirect( '/login' );
			return true;
		}

		// Load the order model.
		$this->load->model( 'OrderModel' );

		// Update the status of the order.
		$ret = $this->OrderModel->setStatus( $user->id, $id, $status );

		// if user is not the one whom order is requested then show unauthorized.
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
