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

	public function getByResturnant( $user_id, $pgNo = 0 ) {
		$off = $pgNo * 10;
		$sql = "SELECT * FROM food_order INNER JOIN food ON food.id = food_order.food_id WHERE food.created_by = $user_id  LIMIT 10 OFFSET $off";
		return $this->db
				->query( $sql )
				->result();
	}
}
