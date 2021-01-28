<?php
defined( 'BASEPATH' ) or exit( 'No direct script access allowed' );

/**
 * Order Model Class: For the order table
 *
 * @version 0.1.0
 * @author Navonil Das
 */
class OrderModel extends CI_Model {

	/**
	 * Insert Customer Order item to DB.
	 *
	 * @param array $orders Array of Orders dictonary.
	 *
	 * @return void
	 */
	public function create( $orders = array() ) {
		// Insert Bulk orders
		$this->db
			->insert_batch( 'food_order', $orders );
	}

	/**
	 * Get Orders By user ID for Customer.
	 *
	 * @param int $user_id User ID.
	 * @param int $pgNo Page Number.
	 *
	 * @return void
	 */
	public function getById( $user_id, $pgNo = 0 ) {
		$items_per_page = 15;

		return $this->db
			->select( 'food_order.status,food_order.quantity,food.name,food.price,food_order.id' )
			->from( 'food_order' )
			->join( 'food', 'food.id = food_order.food_id' )
			->where( 'food_order.user_id', $user_id )
			->order_by( 'food_order.created_at', 'DESC' )
			->limit( $items_per_page, $pgNo * $items_per_page )
			->get()
			->result();
	}

	/**
	 * Get Orders By Resturant.
	 *
	 * @param int $user_id Resturant User ID.
	 * @param int $pgNo Page Number.
	 * @param int $status Orders Status.
	 *
	 * @return void
	 */
	public function getByResturnant( $user_id, $pgNo = 0, $status = 'Pending' ) {
		$items_per_page = 15;

		return $this->db
			->select( 'food_order.status,food_order.quantity,food.name,food.price,food_order.id,food_order.created_at' )
			->from( 'food_order' )
			->join( 'food', 'food.id = food_order.food_id' )
			->where( 'food.created_by', $user_id )
			->where( 'status', $status )
			->order_by( 'food_order.created_at', 'DESC' )
			->limit( $items_per_page, $pgNo * $items_per_page )
			->get()
			->result();

		// Alternative SQL
		// $off = $pgNo * 10;
		// $sql = "SELECT * FROM food_order INNER JOIN food ON food.id = food_order.food_id WHERE food.created_by = $user_id  LIMIT 10 OFFSET $off";
		// return $this->db
		// ->query( $sql )
		// ->result();
	}

	/**
	 * Update Order status.
	 *
	 * @param int $user_id Resturant User ID.
	 * @param int $pgNo Page Number.
	 * @param int $status Orders Status.
	 *
	 * @return void
	 */
	public function setStatus( $user_id, $id, $status ) {
		// Join food & order to check if food is created by user
		// SELECT * from food INNER JOIN food_order ON food_order.food_id = food.id WHERE food_order.id = $id AND food.created_by = $user_id
		$res = $this->db
			->select( 'food.id' )
			->from( 'food' )
			->join( 'food_order', 'food_order.food_id = food.id' )
			->where( 'food.created_by', $user_id )
			->where( 'food_order.id', $id )
			->get()
			->result();

		if ( count( $res ) > 0 ) {
			// if user has created the menu item (food) then he can change the status
			// Update Status
			$this->db
				->from( 'food_order' )
				->set( 'status', $status )
				->where( 'id', $id )
				->update();
			return true;
		}

		// Send unauthorized;
		return 401;
	}
}
