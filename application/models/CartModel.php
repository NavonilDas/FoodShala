<?php
defined( 'BASEPATH' ) or exit( 'No direct script access allowed' );

/**
 * Cart Model Class: For the cart table
 *
 * @version 0.1.0
 * @author Navonil Das
 */
class CartModel extends CI_Model {

	/**
	 * Insert Food item to Cart in DB.
	 *
	 * @param array $cart Cart item.
	 *
	 * @return void
	 */
	public function create( $cart ) {
		// insert cart to DB.
		$this->db->insert( 'cart', $cart );
	}

	/**
	 * Get The list of all the items in cart.
	 *
	 * @param int $user_id User id.
	 *
	 * @return void
	 */
	public function get( $user_id ) {
		// Get The List of cart items from DB.
		return $this->db
					->from( 'cart' )
					->join( 'food', 'food.id =  cart.food_id' )
					->where( 'cart.user_id', $user_id )
					->get()
					->result();

		// Alternative using SQL
		// return $this->db
		// ->query( "SELECT * from cart INNER JOIN food ON  WHERE " )
		// ->result();
	}

	/**
	 * Update the quantity of item in the cart.
	 *
	 * @param int $user_id User id.
	 * @param int $id Cart id.
	 * @param int $val Change in Quantity.
	 *
	 * @return void
	 */
	public function changeQuantity( $user_id, $id, $val ) {
		// Query to update in DB
		$this->db
			->from( 'cart' )
			->set( 'quantity', 'quantity + ' . $val, false )
			->where( 'food_id', $id )
			->where( 'user_id', $user_id )
			->update();

		// Alternative using SQL
		// $this->db
		// ->query("UPDATE cart SET quantity = quantity+1 WHERE food_id = $id AND user_id = $user_id");
	}

	/**
	 * Delete item from the cart.
	 *
	 * @param int $user_id User id.
	 * @param int $id Cart id.
	 *
	 * @return void
	 *
	 * @throws Exception Database Error
	 */
	public function delete( $user_id, $id ) {
		$this->db
			->from( 'cart' )
			->where( 'user_id', $user_id )
			->where( 'food_id', $id )
			->delete();

		// Get Database Errors if there is error throw exception.
		$errors = $this->db->error();
		if ( isset( $errors['code'] ) && $errors['code'] !== 0 && $errors['message'] !== '' ) {
			throw new Exception( $errors['message'] );
		}
	}
	/**
	 * Delete all the items from cart.
	 *
	 * @param int $user_id User id.
	 *
	 * @return void
	 */
	public function delete_all( $user_id ) {
		$this->db
			->from( 'cart' )
			->where( 'user_id', $user_id )
			->delete();
	}
}
