<?php
defined( 'BASEPATH' ) or exit( 'No direct script access allowed' );

/**
 * Cart Controller Class: For the cart page. (/cart)
 *
 * @version 0.1.0
 * @author Navonil Das
 */
class Cart extends CI_Controller {

	/**
	 * Method check if user is Customer and if user is not register redirect to login page.
	 *
	 * @return UserAuth User object if user is logged in
	 */
	private function _only_for_customer() {
		// Get Role and User Object
		$user = $this->session->userdata( 'user' );
		$role = $this->session->userdata( 'role' );

		// For Unregistered Author redirect to login
		if ( $user === null ) {
			redirect( '/login' );
			return null;
		}

		// if Registered User is not customer show unauthorized message (401).
		if ( $role !== 'Customer' ) {
			// Show Unauthorized Message if user is not customer
			$err_msg = 'You don\'t Have permission to access this resource. To Visit Home <a href="' . base_url() . '">Click Here</a>';
			show_error( $err_msg, 401, 'Unauthorized Access' );
			return null;
		}

		// Return User Object
		return $user;
	}

	/**
	 * Controller to Add Food Item into the cart.
	 *
	 * @param $food_id Food Item id
	 *
	 * @return void
	 */
	public function add( $food_id = -1 ) {
		$user = $this->_only_for_customer();

		if ( $user === null || $food_id === -1 ) {
			return;
		}

		// Load CartModel
		$this->load->model( 'CartModel' );

		// Create an cart item
		$cart = array(
			'food_id'  => $food_id,
			'user_id'  => $user->id,
			'quantity' => 1,
		);

		// Add Item to DB
		$this->CartModel->create( $cart );

		// Redirect to Home Page
		redirect( '/' );
	}

	/**
	 * Controller to: Delete Food Item From Cart.
	 *
	 * @param $id Food Item id
	 *
	 * @return void
	 */
	function delete( $id = -1 ) {
		// Only Accept Customer
		$user = $this->_only_for_customer();

		if ( $user === null ) {
			return;
		}
		// Load Model & delete item
		$this->load->model( 'CartModel' );

		// Set Content Type as JSON
		header( 'Content-Type: application/json' );

		// catch databse errors.
		try {
			$this->CartModel->delete( $user->id, $id );
			// send status done.
			echo json_encode( array( 'done' => true ) );
		} catch ( \Exception $th ) {

			// send datbase error.
			echo json_encode( array( 'error' => $th->getMessage() ) );
		}
	}

	/**
	 * Controller to: Update The Quantity in cart.
	 *
	 * @param int $id Cart Item id
	 * @param int $val The Change in quantiy
	 *
	 * @return void
	 */
	function quantity( $id = -1, $val = null ) {
		// if invalid request is sent
		if ( $id == -1 || $val == null ) {
			redirect( '/cart/view' );
			return;
		}

		// For Customers
		$user = $this->_only_for_customer();

		if ( $user === null ) {
			return;
		}

		// Load Model & Update the Quantity
		$this->load->model( 'CartModel' );
		$this->CartModel->changeQuantity( $user->id, $id, $val );

		// Redirect to Cart
		redirect( '/cart/view' );
	}

	/**
	 * Controller to: View items on Cart.
	 *
	 * @param array $menu Food Menu Item
	 *
	 * @return void
	 */
	public function view() {
		// For Checking Customer
		$user = $this->_only_for_customer();

		if ( $user === null ) {
			return;
		}

		// Load Model
		$this->load->model( 'CartModel' );

		// Check if
		$checkout         = $this->session->userdata( 'checkout' );
		$data             = array();
		$data['cart']     = $this->CartModel->get( $user->id );
		$data['checkout'] = ( $checkout != null ) ? true : false;

		$this->session->unset_userdata( 'checkout' );

		$this->load->view( 'customer/view_cart', $data );

	}

	/**
	 * Controller To: Checkout from cart.
	 *
	 * @return void
	 */
	public function checkout() {
		// For Customer
		$user = $this->_only_for_customer();

		if ( $user === null ) {
			return;
		}

		// Load Models
		$this->load->model( 'CartModel' );
		$this->load->model( 'OrderModel' );

		// Get Cart items by user id
		$items = $this->CartModel->get( $user->id );
		// Create orders array
		$orders = array();
		// insert cart item to order array
		foreach ( $items as $obj ) {
			array_push(
				$orders,
				array(
					'food_id'  => $obj->food_id,
					'user_id'  => $obj->user_id,
					'quantity' => $obj->quantity,
				)
			);
		}

		// Insert Orders array to DB.
		if ( count( $orders ) > 0 ) {
			$this->OrderModel->create( $orders );
		}
		// Delete Items from cart by user id.
		$this->CartModel->delete_all( $user->id );
		// Set Session checkout
		$this->session->set_userdata( array( 'checkout' => true ) );
		// Redirect to cart.
		redirect( '/cart/view' );
	}

}
