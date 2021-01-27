<?php
defined( 'BASEPATH' ) or exit( 'No direct script access allowed' );

class OrderModel extends CI_Model {

	public function create( $orders = array() ) {
		$this->db
			->insert_batch( 'food_order', $orders );
	}

	public function getById( $user_id, $pgNo = 0 ) {
		return $this->db
			->select( 'food_order.status,food_order.quantity,food.name,food.price,food_order.id' )
			->from( 'food_order' )
			->join( 'food', 'food.id = food_order.food_id' )
			->where( 'food_order.user_id', $user_id )
			->order_by( 'food_order.created_at', 'DESC' )
			->limit( 15, $pgNo * 15 )
			->get()
			->result();
	}

	public function getByResturnant( $user_id, $pgNo = 0, $status = 'Pending' ) {
		return $this->db
			->select( 'food_order.status,food_order.quantity,food.name,food.price,food_order.id,food_order.created_at' )
			->from( 'food_order' )
			->join( 'food', 'food.id = food_order.food_id' )
			->where( 'food.created_by', $user_id )
			->where( 'status', $status )
			->order_by( 'food_order.created_at', 'DESC' )
			->limit( 15, $pgNo * 15 )
			->get()
			->result();
		// $off = $pgNo * 10;
		// $sql = "SELECT * FROM food_order INNER JOIN food ON food.id = food_order.food_id WHERE food.created_by = $user_id  LIMIT 10 OFFSET $off";
		// return $this->db
		// ->query( $sql )
		// ->result();
	}

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
			$this->db
				->from( 'food_order' )
				->set( 'status', $status )
				->where( 'id', $id )
				->update();
			return true;
		}else return 401;
	}
}
